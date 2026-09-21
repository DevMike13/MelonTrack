<x-filament-panels::page>
    <wireui:scripts />
    @livewireStyles
    @livewireScripts
    @vite(['resources/css/custom.css', 'resources/css/app.css', 'resources/js/app.js'])

    <div class="mb-6 z-10">
        <h1 class="text-3xl font-bold flex items-center gap-2">
            <svg 
                xmlns="http://www.w3.org/2000/svg" 
                fill="none" 
                viewBox="0 0 24 24" 
                stroke-width="1.5" 
                stroke="currentColor"
                class="w-8 h-8 text-[#356744]"
            >
                <path 
                    stroke-linecap="round" 
                    stroke-linejoin="round" 
                    d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" 
                />
            </svg>
            <span class="text-[#356744]">
                About MelonTrack
            </span>
        </h1>
    </div>

    <livewire:pages.about />
    
</x-filament-panels::page>
