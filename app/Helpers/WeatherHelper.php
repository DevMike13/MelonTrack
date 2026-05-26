<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

if (!function_exists('get_lucban_weather')) {
    function get_lucban_weather()
    {
        return Cache::remember('weather_lucban', 600, function () {
            return Http::get('https://api.open-meteo.com/v1/forecast', [
                'latitude' => 14.1133,
                'longitude' => 121.5563,
                'current_weather' => true,
            ])->json('current_weather');
        });
    }
}

if (!function_exists('weather_icon')) {
    function weather_icon($code)
    {
        return match (true) {
            in_array($code, [0]) => '☀️',
            in_array($code, [1, 2]) => '🌤',
            in_array($code, [3]) => '☁️',
            in_array($code, [51, 53, 55, 61, 63, 65]) => '🌧',
            default => '🌡',
        };
    }
}

if (!function_exists('weather_label')) {
    function weather_label($code)
    {
        return match (true) {

            in_array($code, [0]) => 'Clear Sky',
            in_array($code, [1]) => 'Mainly Clear',
            in_array($code, [2]) => 'Partly Cloudy',
            in_array($code, [3]) => 'Overcast',

            in_array($code, [45, 48]) => 'Foggy',

            in_array($code, [51, 53, 55]) => 'Drizzle',
            in_array($code, [61, 63, 65]) => 'Rain',

            in_array($code, [71, 73, 75]) => 'Snow',

            in_array($code, [80, 81, 82]) => 'Rain Showers',

            in_array($code, [95]) => 'Thunderstorm',

            default => 'Unknown',
        };
    }
}