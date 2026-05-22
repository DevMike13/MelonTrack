<div>
    <div class="flex justify-between items-center flex-col gap-5 lg:flex-row lg:gap-2">
        <div class="w-full lg:w-1/2 flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
            <div class="bg-gray-100 border-b rounded-t-xl py-3 px-4 md:py-4 md:px-5 dark:bg-neutral-900 dark:border-neutral-700 flex justify-between items-center">
                <p class="mt-1 text-sm text-gray-500 dark:text-neutral-500">
                    pH Level
                </p>
                <div>
                    <p class="text-xs mb-2">Current TR: <span class="inline-flex items-center gap-x-1.5 px-2 rounded-full text-xs font-medium bg-yellow-500 text-white">{{$phTresholdData}}</span></p>
                    <a href="#" onclick="$openModal('phlevelmodal')" class="text-xs bg-blue-600 px-2 py-1 rounded-lg text-white">Set Threshhold Range</a>
                </div>
            </div>
            <div class="p-4 md:p-5">
                <div class="flex justify-center items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512" width="24" height="24">
                        <path d="M400 320c0 88.37-55.63 144-144 144s-144-55.63-144-144c0-94.83 103.23-222.85 134.89-259.88a12 12 0 0118.23 0C296.77 97.15 400 225.17 400 320z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/>
                        <path d="M344 328a72 72 0 01-72 72" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/>
                    </svg>
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-white">
                        {{number_format($phData, 2, '.', ',')}}
                    </h3>
                </div>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
            <div class="bg-gray-100 border-b rounded-t-xl py-3 px-4 md:py-4 md:px-5 dark:bg-neutral-900 dark:border-neutral-700 flex justify-between items-center">
                <p class="mt-1 text-sm text-gray-500 dark:text-neutral-500">
                    Dissolved Oxygen
                </p>
                <div>
                    <p class="text-xs mb-2">Current TR: <span class="inline-flex items-center gap-x-1.5 px-2 rounded-full text-xs font-medium bg-yellow-500 text-white">{{$doTresholdData}}mg/L</span></p>
                    <a href="#" onclick="$openModal('domodal')" class="text-xs bg-blue-600 px-2 py-1 rounded-lg text-white">Set Threshhold Range</a>
                </div>
            </div>
            <div class="p-4 md:p-5">
                <div class="flex justify-center items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512" width="24" height="24">
                        <path d="M321.89 171.42C233 114 141 155.22 56 65.22c-19.8-21-8.3 235.5 98.1 332.7 77.79 71 197.9 63.08 238.4-5.92s18.28-163.17-70.61-220.58zM173 253c86 81 175 129 292 147" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/>
                    </svg>                      
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-white">
                        {{number_format($doData, 2, '.', ',')}}mg/L
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <div class="flex justify-between items-center flex-col lg:flex-row gap-5 lg:gap-2 mt-5">
        <div class="w-full lg:w-1/2 flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
            <div class="bg-gray-100 border-b rounded-t-xl py-3 px-4 md:py-4 md:px-5 dark:bg-neutral-900 dark:border-neutral-700 flex justify-between items-center">
                <p class="mt-1 text-sm text-gray-500 dark:text-neutral-500">
                    Alkalinity Level
                </p>
                <div>
                    <p class="text-xs mb-2">Current TR: <span class="inline-flex items-center gap-x-1.5 px-2 rounded-full text-xs font-medium bg-yellow-500 text-white">{{$alTresholdData}}ppm</span></p>
                    <a href="#" onclick="$openModal('almodal')" class="text-xs bg-blue-600 px-2 py-1 rounded-lg text-white">Set Threshhold Range</a>
                </div>
            </div>
            <div class="p-4 md:p-5">
                <div class="flex justify-center items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512" width="24" height="24">
                        <circle cx="256" cy="184" r="120" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/>
                        <circle cx="344" cy="328" r="120" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/>
                        <circle cx="168" cy="328" r="120" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/>
                    </svg>
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-white">
                        {{number_format($alData, 2, '.', ',')}}ppm
                    </h3>
                </div>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
            <div class="bg-gray-100 border-b rounded-t-xl py-3 px-4 md:py-4 md:px-5 dark:bg-neutral-900 dark:border-neutral-700 flex justify-between items-center">
                <p class="mt-1 text-sm text-gray-500 dark:text-neutral-500">
                    Water Temperature
                </p>
                <div>
                    <p class="text-xs mb-2">Current TR: <span class="inline-flex items-center gap-x-1.5 px-2 rounded-full text-xs font-medium bg-yellow-500 text-white">{{$wTempTresholdData}}°C</span></p>
                    <a href="#" onclick="$openModal('wtmodal')" class="text-xs bg-blue-600 px-2 py-1 rounded-lg text-white">Set Threshhold Range</a>
                </div>
            </div>
            <div class="p-4 md:p-5">
                <div class="flex justify-center items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512" width="24" height="24">
                        <path d="M307.72 302.27a8 8 0 01-3.72-6.75V80a48 48 0 00-48-48h0a48 48 0 00-48 48v215.52a8 8 0 01-3.71 6.74 97.51 97.51 0 00-44.19 86.07A96 96 0 00352 384a97.49 97.49 0 00-44.28-81.73zM256 112v272" fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32"/>
                        <circle cx="256" cy="384" r="48"/>
                    </svg>                      
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-white">
                        {{$wTempData}}°C
                    </h3>
                </div>
            </div>
        </div>
    </div>
    
    <x-modal blur name="phlevelmodal" persistent align="center" max-width="sm">
        <x-card title="Set New pH Level Treshold">
            
            <x-input right-icon="shield-exclamation" label="Treshold Value" placeholder="Ex: 5.5" wire:model="setPHTresholdValue" />
            <x-slot name="footer" class="flex justify-end gap-x-4">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button primary label="Save" wire:click="setPHTreshold" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>

    <x-modal blur name="domodal" persistent align="center" max-width="sm">
        <x-card title="Set New Dissolved Oxygen Treshold">
            <x-input right-icon="shield-exclamation" label="Treshold Value" placeholder="Ex: 0.4mg/L" wire:model="setDOTresholdValue"/>
            <x-slot name="footer" class="flex justify-end gap-x-4">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button primary label="Save" wire:click="setDOTreshold" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>

    <x-modal blur name="almodal" persistent align="center" max-width="sm">
        <x-card title="Set New Alkalinity Level Treshold">
            <x-input right-icon="shield-exclamation" label="Treshold Value" placeholder="Ex: 80ppm"  wire:model="setALTresholdValue"/>
            <x-slot name="footer" class="flex justify-end gap-x-4">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button primary label="Save" wire:click="setALTreshold" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>

    <x-modal blur name="wtmodal" persistent align="center" max-width="sm">
        <x-card title="Set New Water Temperature Treshold">
            <x-input right-icon="shield-exclamation" label="Treshold Value" placeholder="Ex: 28°C"  wire:model="setWTTresholdValue"/>
            <x-slot name="footer" class="flex justify-end gap-x-4">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button primary label="Save" wire:click="setWTTreshold" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>
</div>
