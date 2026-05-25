<?php

namespace App\Livewire\Auth;

use App\Mail\SendOtpMail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class RegisterPage extends Component
{
    public $firstname;
    public $lastname;
    public $username;
    public $email;
    public $password;
    public $confirmPassword;

    public function register()
    {
        $this->validate([
            'firstname' => 'required|max:255',
            'lastname'  => 'required|max:255',
            'username'  => 'required|max:255|unique:users,username',

            'email'     => 'required|email|unique:users,email|max:255',

            'password'  => 'required|min:8|max:255',
            'confirmPassword' => 'required|same:password',
        ]);

        try {

            $otp = mt_rand(100000, 999999);

            $user = User::create([
                'firstname' => $this->firstname,
                'lastname'  => $this->lastname,
                'username'  => $this->username,

                // keep full name for display purposes
                'name' => $this->firstname . ' ' . $this->lastname,

                'email' => $this->email,
                'password' => Hash::make($this->password),

                'role' => 'user',
                'status' => 'Active',

                'otp_code' => $otp,
                'otp_expires_at' => now()->addMinutes(10),

                'is_verified' => false,
                'is_approved' => false,
            ]);

            Mail::to($user->email)->send(new SendOtpMail($otp));

            return redirect()->route('account.verify', [
                'user_id' => $user->id
            ]);

        } catch (\Exception $e) {

            Log::error('Registration Error: ' . $e->getMessage());

            session()->flash('error', 'Registration failed. Please try again.');
        }
    }
    
    public function render()
    {
        return view('livewire.auth.register-page');
    }
}
