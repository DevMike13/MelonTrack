<?php

namespace App\Http\Responses;

use Filament\Http\Responses\Auth\Contracts\LogoutResponse as LogoutResponseContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LogoutResponse implements LogoutResponseContract
{
    public function toResponse($request): RedirectResponse
    {
        $user = auth()->user();

        if ($user) {
    
            $user->update([
                'is_online' => false,
            ]);
        }

        return redirect()->route('home');
    }
}