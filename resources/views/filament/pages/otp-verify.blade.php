<x-filament-panels::page>
    <form wire:submit.prevent="submit" class="space-y-4 max-w-md mx-auto">
        {{ $this->form }}

        <x-filament::button type="submit" class="w-full">
            Verify OTP
        </x-filament::button>
    </form>
</x-filament-panels::page>
