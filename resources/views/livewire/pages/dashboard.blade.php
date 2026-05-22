<div>
    <div class="flex flex-col-reverse lg:flex-row justify-between">
        <h4 class="mt-auto mb-2 font-semibold">Parameter Monitoring</h4>

        <div class="w-full max-w-sm mb-3 ml-auto">
            <x-native-select
                label="Tray Number"
                {{-- placeholder="Select tray number" --}}
                {{-- :options="['B1', 'B2', 'B3', 'B4']" --}}
                :options="[
                    ['name' => 'Tray 1',  'id' => 'B1'],
                    ['name' => 'Tray 2', 'id' => 'B2'],
                    ['name' => 'Tray 3',   'id' => 'B3'],
                    ['name' => 'Tray 4',    'id' => 'B4'],
                ]"
                option-label="name"
                option-value="id"
                wire:model.live="selectedBoard"
            />
        </div>
    </div>
    <div class="flex justify-center items-center flex-col lg:flex-row">
        <div class="grid grid-cols-3 gap-2 w-full place-items-stretch">
            <div class="h-full flex flex-col justify-between bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <div class="flex justify-center items-center w-full pt-5">
                   <img src="{{ asset('images/soil-moist-new-icon.png') }}" alt="" class="w-16 h-16">
                </div>
                <div class="p-4 md:p-5">
                    <div class="flex flex-col justify-center items-center gap-4">
                        <h1 class="text-sm text-center">Soil Moisture</h1>
                        @if ($selectedBoard == 'B1')
                            <h3 class="text-2xl font-bold text-gray-800 dark:text-white">
                                {{ number_format((float) $soilMoistureData, 2, '.', ',') }}
                            </h3>
                        @elseif($selectedBoard == 'B2')
                            <h3 class="text-2xl font-bold text-gray-800 dark:text-white">
                                {{ number_format((float) $soilMoistureDataB2, 2, '.', ',') }}
                            </h3>
                        @elseif($selectedBoard == 'B3')
                            <h3 class="text-2xl font-bold text-gray-800 dark:text-white">
                                {{ number_format((float) $soilMoistureDataB3, 2, '.', ',') }}
                            </h3>
                        @elseif($selectedBoard == 'B4')
                            <h3 class="text-2xl font-bold text-gray-800 dark:text-white">
                                {{ number_format((float) $soilMoistureDataB4, 2, '.', ',') }}
                            </h3>
                        @endif
                    </div>
                </div>
            </div>

            <div class="h-full flex flex-col justify-between bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <div class="flex justify-center items-center w-full pt-5">
                   <img src="{{ asset('images/soil-ph-icon-new.png') }}" alt="" class="w-16 h-16">
                </div>
                <div class="p-4 md:p-5">
                    <div class="flex flex-col justify-center items-center gap-4">
                        <h1 class="text-sm text-center">Soil pH</h1>
                        @if ($selectedBoard == 'B1')
                            <h3 class="text-2xl font-bold text-gray-800 dark:text-white">
                                {{number_format((float) $soilPHData, 2, '.', ',')}}
                            </h3>
                        @elseif($selectedBoard == 'B2')
                            <h3 class="text-2xl font-bold text-gray-800 dark:text-white">
                                {{ number_format((float) $soilPHDataB2, 2, '.', ',') }}
                            </h3>
                        @elseif($selectedBoard == 'B3')
                            <h3 class="text-2xl font-bold text-gray-800 dark:text-white">
                                {{ number_format((float) $soilPHDataB3, 2, '.', ',') }}
                            </h3>
                        @elseif($selectedBoard == 'B4')
                            <h3 class="text-2xl font-bold text-gray-800 dark:text-white">
                                {{ number_format((float) $soilPHDataB4, 2, '.', ',') }}
                            </h3>
                        @endif
                    </div>
                </div>
            </div>

            <div class="h-full flex flex-col justify-between bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <div class="flex justify-center items-center w-full pt-5">
                   <img src="{{ asset('images/water-ph-icon-new.png') }}" alt="" class="w-16 h-16">
                </div>
                <div class="p-4 md:p-5">
                    <div class="flex flex-col justify-center items-center gap-4">
                        <h1 class="text-sm text-center">Water pH</h1>
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-white">
                            {{number_format((float) $waterPHData, 2, '.', ',')}}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-3 gap-2 w-full place-items-stretch mt-2 md:mt-0 md:ml-2">

            <div class="h-full flex flex-col justify-between bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <div class="flex justify-center items-center w-full pt-5">
                   <img src="{{ asset('images/temp-icon-new.png') }}" alt="" class="w-16 h-16">
                </div>
                <div class="p-4 md:p-5">
                    <div class="flex flex-col justify-center items-center gap-4">
                        <h1 class="text-sm text-center">Temperature</h1>
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-white">
                            {{number_format((float) $temperatureData, 2, '.', ',')}}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="h-full flex flex-col justify-between bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <div class="flex justify-center items-center w-full pt-5">
                   <img src="{{ asset('images/humid-icon-new.png') }}" alt="" class="w-16 h-16">
                </div>
                <div class="p-4 md:p-5">
                    <div class="flex flex-col justify-center items-center gap-4">
                        <h1 class="text-sm text-center">Humidity</h1>
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-white">
                            {{number_format((float) $humidityData, 2, '.', ',')}}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-3 mt-3 flex items-center text-sm text-gray-800 before:flex-1 before:border-t before:border-gray-200 before:me-6 after:flex-1 after:border-t after:border-gray-200 after:ms-6 dark:text-white dark:before:border-neutral-600 dark:after:border-neutral-600">System Status</div>
    
    <div class="w-full">
        <div class="flex justify-center items-center w-full gap-2">
            <div class="w-full lg:w-1/2 flex flex-row justify-start items-center bg-white border border-gray-200 shadow-sm rounded-xl p-4 md:p-5 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                <div class="flex justify-start items-center gap-3">
                    <div class="w-10 h-10 flex justify-center items-center">
                        <img src="{{ asset('images/master-control.png') }}" alt="" class="w-full h-auto">
                    </div>
                    <p>Master Control</p>
                </div>
                <div class="ml-auto">
                    <x-toggle left-label="Disabled" label="Enabled" wire:model="isMasterEnabled" wire:click="toggleMasterState" lg />
                    {{-- <p>{{ $fanState }}</p> --}}
                </div>
            </div>
        </div>
        <div class="flex flex-col lg:flex-row w-full gap-2 mt-3">
            <div class="w-full lg:w-1/2 flex flex-row justify-start items-center bg-white border border-gray-200 shadow-sm rounded-xl p-4 md:p-5 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                <div class="flex justify-start items-center gap-3">
                    <div class="w-10 h-10 flex justify-center items-center">
                        <img src="{{ asset('images/fan-icon.png') }}" alt="" class="w-full h-auto">
                    </div>
                    <p>Fan</p>
                </div>
                <div class="ml-auto">
                    @if ($isMasterEnabled)
                        <a href="#" wire:click.prevent="showMasterControlNotification">
                            <x-toggle left-label="Off" label="On" wire:model="isActiveFan" lg wire:click="toggleFan" :disabled="$isMasterEnabled" />
                        </a>
                    @else
                        <x-toggle 
                            left-label="Off" 
                            label="On" 
                            wire:model="isActiveFan" 
                            lg 
                            wire:click="toggleFan" 
                        />
                    @endif
                    {{-- <p>{{ $fanState }}</p> --}}
                </div>
            </div>
            <div class="w-full lg:w-1/2 flex flex-row justify-start items-center bg-white border border-gray-200 shadow-sm rounded-xl p-4 md:p-5 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                <div class="flex justify-start items-center gap-3">
                    <div class="w-10 h-10 flex justify-center items-center">
                        <img src="{{ asset('images/misting-icon.png') }}" alt="" class="w-full h-auto">
                    </div>
                    <p>Misting System</p>
                </div>
                <div class="ml-auto">
                    @if ($selectedBoard == 'B1')
                        @if ($isMasterEnabled)
                            <a href="#" wire:click.prevent="showMasterControlNotification">
                                <x-toggle 
                                    left-label="Off" 
                                    label="On" 
                                    wire:model.defer="isActiveMistingData" 
                                    lg 
                                    :disabled="true" 
                                />
                            </a>
                        @else
                            <x-toggle 
                                left-label="Off" 
                                label="On" 
                                wire:model.defer="isActiveMistingData" 
                                lg 
                                wire:click="toggleMistingB1" 
                            />
                        @endif
                    @elseif ($selectedBoard == 'B2')
                        @if ($isMasterEnabled)
                            <a href="#" wire:click.prevent="showMasterControlNotification">
                                <x-toggle 
                                    left-label="Off" 
                                    label="On" 
                                    wire:model.defer="isActiveMistingDataB2" 
                                    lg 
                                    :disabled="true" 
                                />
                            </a>
                        @else
                            <x-toggle 
                                left-label="Off" 
                                label="On" 
                                wire:model.defer="isActiveMistingDataB2" 
                                lg 
                                wire:click="toggleMistingB2" 
                            />
                        @endif
                    @elseif ($selectedBoard == 'B3')
                        @if ($isMasterEnabled)
                            <a href="#" wire:click.prevent="showMasterControlNotification">
                                <x-toggle 
                                    left-label="Off" 
                                    label="On" 
                                    wire:model.defer="isActiveMistingDataB3" 
                                    lg 
                                    :disabled="true" 
                                />
                            </a>
                        @else
                            <x-toggle 
                                left-label="Off" 
                                label="On" 
                                wire:model.defer="isActiveMistingDataB3" 
                                lg 
                                wire:click="toggleMistingB3" 
                            />
                        @endif
                    @elseif ($selectedBoard == 'B4')
                        @if ($isMasterEnabled)
                            <a href="#" wire:click.prevent="showMasterControlNotification">
                                <x-toggle 
                                    left-label="Off" 
                                    label="On" 
                                    wire:model.defer="isActiveMistingDataB4" 
                                    lg 
                                    :disabled="true" 
                                />
                            </a>
                        @else
                            <x-toggle 
                                left-label="Off" 
                                label="On" 
                                wire:model.defer="isActiveMistingDataB4" 
                                lg 
                                wire:click="toggleMistingB4" 
                            />
                        @endif
                    @endif
                </div>                
            </div>
        </div>
    
        <div class="flex flex-col lg:flex-row w-full gap-2 mt-3">
            <div class="w-full lg:w-1/2 flex flex-row justify-start items-center bg-white border border-gray-200 shadow-sm rounded-xl p-4 md:p-5 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                <div class="flex justify-start items-center gap-3">
                    <div class="w-10 h-10 flex justify-center items-center">
                        <img src="{{ asset('images/light-icon.png') }}" alt="" class="w-full h-auto">
                    </div>
                    <p>Lights</p>
                </div>
                <div class="ml-auto">
                    @if ($isMasterEnabled)
                        <a href="#" wire:click.prevent="showMasterControlNotification">
                            <x-toggle 
                                left-label="Off" 
                                label="On" 
                                wire:model.defer="isActiveLight" 
                                lg 
                                wire:click="toggleLight" 
                                :disabled="$isMasterEnabled" 
                            />
                        </a>
                    @else
                        <x-toggle 
                            left-label="Off" 
                            label="On" 
                            wire:model.defer="isActiveLight" 
                            lg 
                            wire:click="toggleLight" 
                        />
                    @endif
                    {{-- <p>{{ $lightState }}</p> --}}
                </div>                
            </div>
            <div class="w-full lg:w-1/2 flex flex-row justify-start items-center bg-white border border-gray-200 shadow-sm rounded-xl p-4 md:p-5 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                <div class="flex justify-start items-center gap-3">
                    <div class="w-10 h-10 flex justify-center items-center">
                        <img src="{{ asset('images/water-level-icon.png') }}" alt="" class="w-full h-auto">
                    </div>
                    <p>Water Level</p>
                </div>
                <div class="ml-auto">
                    <p> {{number_format($waterLevelData, 2, '.', ',')}} %</p>
                </div>
            </div>
        </div>
    </div>
</div>
