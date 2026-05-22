<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Page Title' }}</title>
        
        @wireUiScripts
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body>
        <x-notifications />
        {{-- @livewire('partials.navbar') --}}
        {{ $slot }}
        <x-dialog z-index="z-50" blur="md" align="center" />
        {{-- @livewire('partials.footer') --}}
        @livewireScripts
    </body>
</html>
