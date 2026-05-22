<?php

namespace App\Livewire\Auth;

use App\Mail\SendOtpMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Account Verification')]
class NotVerify extends Component
{
    public string $email = '';

    public function sendOTP()
    {
        $this->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $this->email)->first();

        if (!$user) {
            $this->addError('email', 'This email is not registered.');
            return;
        }

        if ($user->email_verified_at) {
            $this->addError('email', 'This email is already verified.');
            return;
        }

        if ($user) {
            $otp = rand(100000, 999999);
            $user->update([
                'otp_code' => $otp,
                'otp_expires_at' => now()->addMinutes(10),
            ]);

            Mail::to($user->email)->send(new SendOtpMail($otp));
        }
        return redirect()->route('otp.verify', ['email' => $this->email]);
    }

    public function render()
    {
        return view('livewire.auth.not-verify');
    }
}
