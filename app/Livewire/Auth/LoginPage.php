<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Title;
use Livewire\Component;
use WireUi\Traits\Actions;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

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

        $key = $this->throttleKey();

        if (RateLimiter::tooManyAttempts($key, 5)) {

            $seconds = RateLimiter::availableIn($key);

            $this->notification()->error(
                title: 'Too Many Attempts',
                description: "Too many incorrect login attempts. Please wait {$seconds} seconds before trying again."
            );

            return;
        }

        if (!auth()->attempt([
            'email' => $this->email,
            'password' => $this->password,
        ])) {

            $lockoutSeconds = $this->getLockoutSeconds($key);

            RateLimiter::hit($key, $lockoutSeconds);

            // Check if this failed attempt reached the limit
            if (RateLimiter::tooManyAttempts($key, 5)) {

                Cache::increment($key . ':lockout-level');

                $this->notification()->error(
                    title: 'Too Many Attempts',
                    description: "You have reached 5 incorrect login attempts. Please wait {$lockoutSeconds} seconds before trying again."
                );

                return;
            }

            $remaining = RateLimiter::remaining($key, 5);

            $this->notification()->error(
                title: 'Error!',
                description: "Invalid credentials. {$remaining} attempt(s) remaining."
            );

            return;
        }

        RateLimiter::clear($key);
        Cache::forget($key . ':lockout-level');

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

    private function throttleKey(): string
    {
        return Str::transliterate(
            Str::lower($this->email) . '|' . request()->ip()
        );
    }

    private function getLockoutSeconds(string $key): int
    {
        $level = Cache::get($key . ':lockout-level', 0);

        return match ($level) {
            0 => 20,    // First lockout
            1 => 60,    // Second lockout
            2 => 120,   // Third lockout
            default => 300, // Fourth lockout and above
        };
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
