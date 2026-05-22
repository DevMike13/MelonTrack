<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
        'otp_code',
        'email_verified_at',
        'otp_expires_at',
        'otp_verified_at',
        'is_approved',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function canLogin(): bool
    // {
    //     return ! is_null($this->email_verified_at)
    //         && $this->is_approved
    //         && $this->status === 'Active';
    // }

    public function canAccessPanel(Panel $panel): bool
    {
        if (is_null($this->email_verified_at)) {
            return false;
        }
    
        if ($this->status !== 'Active') {
            return false;
        }

        return true;
    }



    // public function canAccessPanel(Panel $panel): bool
    // {
    //     return true;
    // }
}
