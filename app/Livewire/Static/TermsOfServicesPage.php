<?php

namespace App\Livewire\Static;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Terms Of Services Page')]
class TermsOfServicesPage extends Component
{
    public function render()
    {
        return view('livewire.static.terms-of-services-page');
    }
}
