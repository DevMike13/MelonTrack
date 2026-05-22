<?php

namespace App\Livewire\Auth;

use App\Mail\SendOtpMail;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Account Verification')]
class OtpVerify extends Component
{
    public $email;
    public $otp = [];
    public $resendMessage;

    public function mount()
    {
        $this->email = request()->query('email');
    }

    public function verify()
    {
        $user = User::where('email', $this->email)->first();

        $enteredOtp = implode('', $this->otp);

        if (!$user || !$user->otp_code || now()->gt($user->otp_expires_at)) {
            session()->flash('error', 'OTP expired or invalid.');
            return;
        }

        // dd($enteredOtp);

        if ($enteredOtp == $user->otp_code) {
            $user->email_verified_at = now();
            $user->otp_code = null;
            $user->otp_expires_at = null;
            $user->save();

            Auth::login($user);

            return redirect(Filament::getUrl());
        }

        session()->flash('error', 'Incorrect OTP.');
    }

    public function resendOtp()
    {
        $user = User::where('email', $this->email)->first();

        if ($user) {
            $otp = rand(100000, 999999);
            $user->update([
                'otp_code' => $otp,
                'otp_expires_at' => now()->addMinutes(10),
            ]);

            Mail::to($user->email)->send(new SendOtpMail($otp));

            $this->resendMessage = 'A new OTP has been sent to your email.';
        }
    }
    
    public function render()
    {
        return view('livewire.auth.otp-verify');
    }
}
