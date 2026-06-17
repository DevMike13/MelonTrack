<x-filament-panels::page>
    <wireui:scripts />
    @livewireStyles
    @livewireScripts
    @vite(['resources/css/custom.css', 'resources/css/app.css', 'resources/js/app.js'])

    <div class="mb-6">
        <h1 class="text-3xl font-bold flex items-center gap-2">
            Welcome back,
            <span class="text-[#356744]">
                {{ auth()->user()->name }}!
            </span>
            <img 
                src="{{ asset('images/leaf-icon.png') }}" 
                alt="Leaf Icon"
                class="w-10 h-10 object-contain bg-white rounded-md shadow-sm rotate-[40deg]"
            >
        </h1>

        <p class="text-gray-500 mt-1">
            Here's what's happening in your farm today.
        </p>
    </div>

    <livewire:pages.dashboard />

    <script>
        window.addEventListener('reload', event => {
            window.location.reload();
        })
    </script>
</x-filament-panels::page>
