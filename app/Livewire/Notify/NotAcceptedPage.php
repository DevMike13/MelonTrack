<?php

namespace App\Livewire\Notify;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NotAcceptedPage extends Component
{
    public function mount()
    {
        $user = Auth::user();

        if ($user && $user->is_approved) {
            return redirect()->route('filament.ibroccogreens-admin.pages.dashboard'); 
            // or route('filament.admin.pages.dashboard') if using Filament's dashboard
        }
    }
    
    public function render()
    {
        return view('livewire.notify.not-accepted-page');
    }
}
