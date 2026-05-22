<div class="w-full">
    <div class="flex flex-col lg:flex-row w-full gap-2">
        <div class="w-full lg:w-1/2 flex flex-row justify-start items-center bg-white border border-gray-200 shadow-sm rounded-xl p-4 md:p-5 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
            <div class="flex justify-start items-center gap-3">
                <div class="w-10 h-10 flex justify-center items-center">
                    <img src="{{ asset('images/Fan Speed.png') }}" alt="" class="w-full h-auto">
                </div>
                <p>Fan</p>
            </div>
            <div class="ml-auto">
                <x-toggle wire:model.defer="isActiveFeeding" lg wire:click="toggleFeeding" />
            </div>
        </div>
        <div class="w-full lg:w-1/2 flex flex-row justify-start items-center bg-white border border-gray-200 shadow-sm rounded-xl p-4 md:p-5 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
            <div class="flex justify-start items-center gap-3">
                <div class="w-10 h-10 flex justify-center items-center">
                    <img src="{{ asset('images/Wet.png') }}" alt="" class="w-full h-auto">
                </div>
                <p>Misting System</p>
            </div>
            <div class="ml-auto">
                {{-- <x-toggle wire:model.defer="isActiveFeeding" lg wire:click="toggleFeeding" /> --}}
                <p>Active</p>
            </div>
        </div>
    </div>

    <div class="flex flex-col lg:flex-row w-full gap-2 mt-3">
        <div class="w-full lg:w-1/2 flex flex-row justify-start items-center bg-white border border-gray-200 shadow-sm rounded-xl p-4 md:p-5 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
            <div class="flex justify-start items-center gap-3">
                <div class="w-10 h-10 flex justify-center items-center">
                    <img src="{{ asset('images/Light.png') }}" alt="" class="w-full h-auto">
                </div>
                <p>Lights</p>
            </div>
            <div class="ml-auto">
                <x-toggle wire:model.defer="isActiveFeeding" lg wire:click="toggleFeeding" />
            </div>
        </div>
        <div class="w-full lg:w-1/2 flex flex-row justify-start items-center bg-white border border-gray-200 shadow-sm rounded-xl p-4 md:p-5 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
            <div class="flex justify-start items-center gap-3">
                <div class="w-10 h-10 flex justify-center items-center">
                    <img src="{{ asset('images/Water.png') }}" alt="" class="w-full h-auto">
                </div>
                <p>Water Level</p>
            </div>
            <div class="ml-auto">
                {{-- <x-toggle wire:model.defer="isActiveFeeding" lg wire:click="toggleFeeding" /> --}}
                <p>70%</p>
            </div>
        </div>
    </div>

    {{-- <div class="flex flex-col lg:flex-row w-full gap-2">
        <div class="w-full lg:w-1/2 flex flex-row justify-between bg-white border border-gray-200 shadow-sm rounded-xl p-4 md:p-5 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
            <x-toggle left-label="Manual Feeding" wire:model.defer="isActiveFeeding" lg wire:click="toggleFeeding" />
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
            </svg>     
        </div>
        <div class="w-full lg:w-1/2 flex flex-row justify-between bg-white border border-gray-200 shadow-sm rounded-xl p-4 md:p-5 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
            <x-toggle left-label="Solution" wire:model.defer="isActiveSolution" lg wire:click="toggleSolution" />
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 0 1-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 0 1 4.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0 1 12 15a9.065 9.065 0 0 0-6.23-.693L5 14.5m14.8.8 1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0 1 12 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5" />
            </svg>              
        </div>
    </div>
    
    <div class="flex flex-col lg:flex-row w-full gap-2 mt-3">
        <div class="w-full lg:w-1/2 flex flex-row justify-between bg-white border border-gray-200 shadow-sm rounded-xl p-4 md:p-5 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
            <x-toggle left-label="Aerator" wire:model.defer="isActiveAerator" lg wire:click="toggleAerator"/>
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512" width="24">
                <path d="M448 256c0-106-86-192-192-192S64 150 64 256s86 192 192 192 192-86 192-192z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/>
                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M360 94.59V296M443.13 212.87L296 360M417.41 360H216M299.13 443.13l-144-144M152 416V216M68.87 299.13l144-144M94.59 152H288M212.87 68.87L360 216"/>
            </svg>
        </div>
        <div class="w-full lg:w-1/2 flex flex-row justify-between bg-white border border-gray-200 shadow-sm rounded-xl p-4 md:p-5 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
            <x-toggle left-label="Water Release" wire:model.defer="isActiveWaterRelease" lg wire:click="toggleWaterRelease"/>
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512" width="24" height="24">
                <path d="M400 320c0 88.37-55.63 144-144 144s-144-55.63-144-144c0-94.83 103.23-222.85 134.89-259.88a12 12 0 0118.23 0C296.77 97.15 400 225.17 400 320z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/>
                <path d="M344 328a72 72 0 01-72 72" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/>
            </svg>
        </div>
    </div>

    <div class="flex flex-row w-full justify-center gap-2 mt-3">
        <div class="w-full lg:w-1/2 flex flex-row justify-between bg-white border border-gray-200 shadow-sm rounded-xl p-4 md:p-5 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
            <x-toggle left-label="Water Refill" wire:model.defer="isActiveWaterRefill" lg wire:click="toggleWaterRefill"/>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 10.5h.375c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125H21M4.5 10.5H18V15H4.5v-4.5ZM3.75 18h15A2.25 2.25 0 0 0 21 15.75v-6a2.25 2.25 0 0 0-2.25-2.25h-15A2.25 2.25 0 0 0 1.5 9.75v6A2.25 2.25 0 0 0 3.75 18Z" />
            </svg>              
        </div>
    </div> --}}
</div>
