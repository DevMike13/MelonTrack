<?php

namespace App\Livewire\Partials;

use Livewire\Component;

class WeatherBadge extends Component
{
    public $temp;
    public $icon;
    public $label;

    public function mount()
    {
        $weather = get_lucban_weather();

        $code = $weather['weathercode'] ?? 0;

        $this->temp = $weather['temperature'] ?? '--';
        $this->icon = weather_icon($code);
        $this->label = weather_label($code);
    }

    public function render()
    {
        return view('livewire.partials.weather-badge');
    }
}
