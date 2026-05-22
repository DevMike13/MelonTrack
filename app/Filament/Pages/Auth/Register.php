<?php

namespace App\Filament\Pages\Auth;

use App\Mail\SendOtpMail;
use App\Models\User;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Pages\Page;
use Filament\Pages\Auth\Register as BaseRegister;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Html;
use Filament\Forms\Components\Modal;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Http\Responses\Auth\Contracts\RegistrationResponse;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class Register extends \Filament\Pages\Auth\Register
{
    public $showingTermsModal = false;
    
    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getNameFormComponent(),
                        $this->getEmailFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                        $this->getRoleFormComponent(),
                        Grid::make()
                            
                            ->schema([
                                Checkbox::make('terms_accepted')
                                    ->label('I agree to the')
                                    ->required()
                                    ->extraAttributes([
                                        'class' => 'w-fit',
                                    ])
                                    ->validationAttribute('terms and conditions'),

                                Actions::make([
                                    Action::make('view_terms')
                                        ->label('Terms and Conditions')
                                        ->modalHeading('Terms and Conditions')
                                        ->modalContent(view('components.terms-conditions'))
                                        ->modalSubmitAction(false)
                                        ->link()
                                        ->extraAttributes([
                                            'class' => 'custom-tems-button-input',
                                        ])
                                        ->modalCancelActionLabel('Close'),
                                ])->columnStart(2),
                            ])
                            ->columns(2),
                    ])
                    ->statePath('data'),
            ),
        ];
    }
    
    protected function getRoleFormComponent(): Component
    {
        return Select::make('role')
            ->default('user')
            ->hidden(); 
    }

    public function openTermsModal(): void
    {
        $this->showingTermsModal = true;
    }

    public function register(): ?RegistrationResponse
    {
        $data = $this->form->getState();

        DB::beginTransaction();

        try {
            $data = $this->mutateFormDataBeforeCreate($data);

            // dd($data['password']);

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'role' => 'user',
                'is_approved' => false
            ]);

            $otp = rand(100000, 999999);
            $user->update([
                'otp_code' => $otp,
                'otp_expires_at' => now()->addMinutes(10),
            ]);

            Mail::to($user->email)->send(new SendOtpMail($otp));

            DB::commit();

            Auth::logout();

            // Manual redirect
            Redirect::to(route('otp.verify', ['email' => $user->email]))->send();
            // return redirect()->route('otp.verify', ['email' => $user->email]);


            // ✅ Add this to fix your error
            return null;
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Registration error', ['error' => $e]);
            Notification::make()
                ->title('Registration failed')
                ->body('Something went wrong. Please try again.')
                ->danger()
                ->send();

            return null;
        }
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        unset($data['terms_accepted']);
        $data['role'] = 'user';

        return $data;
    }

    protected function getViewData(): array
    {
        return [
            'showingTermsModal' => $this->showingTermsModal,
        ];
    }

}
