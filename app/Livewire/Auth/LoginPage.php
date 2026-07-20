<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Title;
use Livewire\Component;
use WireUi\Traits\Actions;

#[Title('Login Page')]
class LoginPage extends Component
{
    use Actions;
    
    public $email;
    public $password;

    public function login()
    {
        $this->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|min:8|max:255',
        ]);

        if (!auth()->attempt([
            'email' => $this->email,
            'password' => $this->password,
        ])) {
            $this->notification()->error(
                title: 'Error!',
                description: 'Invalid credentials'
            );

            return;
        }

        request()->session()->regenerate();

        $user = auth()->user();

        if (!$user->is_verified) {
            $this->logoutUser();

            $this->notification()->error(
                title: 'Error!',
                description: 'Your account is not verified.'
            );

            return;
        }

        if ($user->status === 'Inactive') {
            $this->logoutUser();

            $this->notification()->error(
                title: 'Error!',
                description: 'Your account is inactive.'
            );

            return;
        }

        if ($user->role === 'user' && !$user->is_approved) {
            $this->logoutUser();

            $this->notification()->error(
                title: 'Error!',
                description: 'Your account is pending approval.'
            );

            return;
        }

        $user->update([
            'is_online' => true,
        ]);

        return redirect()->route('filament.admin.pages.dashboard');
    }

    private function logoutUser(): void
    {
        auth()->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }
    
    public function render()
    {
        return view('livewire.auth.login-page');
    }
}
