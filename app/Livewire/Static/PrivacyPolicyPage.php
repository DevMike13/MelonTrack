<?php

namespace App\Livewire\Static;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Privacy Policy Page')]
class PrivacyPolicyPage extends Component
{
    public function render()
    {
        return view('livewire.static.privacy-policy-page');
    }
}
