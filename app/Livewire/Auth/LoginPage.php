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

        // Attempt login
        if (!auth()->attempt([
            'email' => $this->email,
            'password' => $this->password
        ])) {

            $this->notification()->error(
                $title = 'Error!',
                $description = 'Invalid credentials'
            );

            return;
        }

        $user = auth()->user();

        // Check if verified
        if (!$user->is_verified) {

            auth()->logout();

            $this->notification()->error(
                $title = 'Error!',
                $description = 'Your account is not verified.'
            );

            return;
        }

        // Check account status
        if ($user->status === 'Inactive') {

            auth()->logout();

            $this->notification()->error(
                $title = 'Error!',
                $description = 'Your account is inactive.'
            );

            return;
        }

        // Optional: Check approval for normal users
        if ($user->role === 'user' && !$user->is_approved) {

            auth()->logout();

            $this->notification()->error(
                $title = 'Error!',
                $description = 'Your account is pending approval.'
            );

            return;
        }

        $user->update([
            'is_online' => true,
        ]);
        
        // Redirect admin
        if ($user->role === 'admin') {
            return redirect()->route('filament.admin.pages.dashboard');
        }

        // Redirect normal user
        if ($user->role === 'user') {
            return redirect()->route('filament.admin.pages.dashboard');
        }

        return redirect()->intended();
    }
    
    public function render()
    {
        return view('livewire.auth.login-page');
    }
}
