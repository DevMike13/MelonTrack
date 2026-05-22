<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class VerifyAccountButton extends Component
{
    public function gotoVerifyPage(){
        return redirect()->route('verify.account');
    }

    public function render()
    {
        return view('livewire.verify-account-button');
    }
}
