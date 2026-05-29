<div class="relative overflow-hidden">

    <div class="fixed right-0 top-0 h-screen w-[35%] pointer-events-none z-0">
        <div class="h-full w-full bg-[url('../../public/images/melon-right-bg.png')] bg-no-repeat bg-cover bg-right opacity-100"></div>
    </div>

    <div class="relative z-10">
        {{-- FILTER --}}
        <div class="flex justify-between items-start flex-col gap-2 mb-8">
            <h6>Time Range</h6>

            <div class="flex flex-wrap items-center gap-2 bg-gray-300 py-2 px-3 rounded-full">
                @php
                    $filters = ['Live', '24H', '7D', '30D', 'Custom'];
                @endphp

                @foreach ($filters as $filter)
                    <button
                        wire:click="$set('activeFilter', '{{ $filter }}')"
                        class="px-4 py-1.5 rounded-full text-sm font-medium transition
                            {{ $activeFilter === $filter
                                ? 'bg-[#356744] text-white'
                                : 'bg-gray-100 hover:bg-gray-200 text-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700'
                            }}"
                    >
                        {{ $filter }}
                    </button>
                @endforeach
            </div>
        </div>

        {{-- CARDS --}}
        <div class="grid grid-cols-5 space-x-5 mb-8">
            {{-- TEMPERATURE CARD --}}
            <div class="bg-[#e1eedb] border border-[#356744] px-5 py-5 rounded-2xl flex flex-col gap-5">
                <div class="flex flex-row justify-between items-center">
                    <div class="w-14 h-14 bg-[#c1ebbf] flex items-center justify-center overflow-hidden rounded-full">
                        <img 
                            src="{{ asset('images/humidity-icon.png') }}" 
                            alt=""
                            class="max-w-9 max-h-9 object-contain"
                        >
                    </div>
                    <div>
                        <p class="font-semibold text-[#376a44] text-sm">Temperature</p>
                        <p class="text-2xl">26.8°C</p>
                    </div>
                </div>
                <div class="flex flex-row justify-center items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                    </svg>
                    <p class="text-xs">1.2°C than yesterday</p>

                </div>
            </div>

            {{-- HUMIDITY CARD --}}
            <div class="bg-blue-100/50 border border-blue-500 px-5 py-5 rounded-2xl flex flex-col gap-5">
                <div class="flex flex-row justify-between items-center">
                    <div class="w-14 h-14 bg-[#cfdfe9] flex items-center justify-center overflow-hidden rounded-full">
                        <img 
                            src="{{ asset('images/humidity-icon.png') }}" 
                            alt=""
                            class="max-w-9 max-h-9 object-contain"
                        >
                    </div>
                    <div>
                        <p class="font-semibold text-blue-600 text-sm">Humidity</p>
                        <p class="text-2xl">65%</p>
                    </div>
                </div>
                <div class="flex flex-row justify-center items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                    </svg>
                    <p class="text-xs">3% than yesterday</p>

                </div>
            </div>

            {{-- SOIL MOISTURE CARD --}}
            <div class="bg-[#dde7e9] border border-[#dde7e9] px-5 py-5 rounded-2xl flex flex-col gap-5">
                <div class="flex flex-row justify-between items-center">
                    <div class="w-14 h-14 bg-[#eadcdb] flex items-center justify-center overflow-hidden rounded-full">
                        <img 
                            src="{{ asset('images/soil-moisture-icon.png') }}" 
                            alt=""
                            class="max-w-9 max-h-9 object-contain"
                        >
                    </div>
                    <div>
                        <p class="font-semibold text-gray-400 text-sm">Soil Moisture</p>
                        <p class="text-2xl">62%</p>
                    </div>
                </div>
                <div class="flex flex-row justify-center items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                    </svg>
                    <p class="text-xs">2% than yesterday</p>

                </div>
            </div>

            {{-- EC CARD --}}
            <div class="bg-[#e9e6dd] border border-[#e9e6dd] px-5 py-5 rounded-2xl flex flex-col gap-5">
                <div class="flex flex-row justify-between items-center">
                    <div class="w-14 h-14 bg-[#e7e8db] flex items-center justify-center overflow-hidden rounded-full">
                        <img 
                            src="{{ asset('images/ec-icon.png') }}" 
                            alt=""
                            class="max-w-9 max-h-9 object-contain"
                        >
                    </div>
                    <div>
                        <p class="font-semibold text-[#b5a86c] text-sm">EC Level</p>
                        <p class="text-2xl">2.0%</p>
                    </div>
                </div>
                <div class="flex flex-row justify-center items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                    </svg>
                    <p class="text-xs">1.2% than yesterday</p>

                </div>
            </div>

            {{-- PH CARD --}}
            <div class="bg-[#e3e6eb] border border-[#e3e6eb] px-5 py-5 rounded-2xl flex flex-col gap-5">
                <div class="flex flex-row justify-between items-center">
                    <div class="w-14 h-14 bg-[#b79dcb] flex items-center justify-center overflow-hidden rounded-full">
                        <img 
                            src="{{ asset('images/ec-icon.png') }}" 
                            alt=""
                            class="max-w-9 max-h-9 object-contain"
                        >
                    </div>
                    <div>
                        <p class="font-semibold text-[#ac82aa] text-sm">pH Level</p>
                        <p class="text-2xl">6.1</p>
                    </div>
                </div>
                <div class="flex flex-row justify-center items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                    </svg>
                    <p class="text-xs">1.1than yesterday</p>

                </div>
            </div>
        </div>

        <div wire:ignore class="w-[100%] h-96 mb-8">
            <canvas id="allSensorsChart"></canvas>
        </div>

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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('livewire:init', () => {

            const labels = [
                '1 AM','2 AM','3 AM','4 AM','5 AM','6 AM',
                '7 AM','8 AM','9 AM','10 AM','11 AM','12 PM',
                '1 PM','2 PM','3 PM','4 PM','5 PM','6 PM',
                '7 PM','8 PM','9 PM','10 PM','11 PM','12 AM'
            ];

            const temperatureData  = [24,25,24,26,27,28,29,30,31,32,33,34,33,32,31,30,29,28,27,26,25,24,24,23];
            const humidityData     = [80,82,81,83,85,87,88,86,84,82,80,78,77,76,75,74,73,72,71,70,72,74,76,78];
            const soilMoistureData = [60,61,62,63,64,65,66,65,64,63,62,61,60,59,60,61,62,63,64,65,66,65,64,63];
            const ecLevelData      = [1.1,1.2,1.2,1.3,1.4,1.5,1.6,1.6,1.5,1.4,1.3,1.4,1.5,1.6,1.7,1.8,1.7,1.6,1.5,1.4,1.3,1.2,1.1,1.0];
            const phLevelData      = [6.2,6.3,6.2,6.4,6.5,6.6,6.5,6.4,6.3,6.2,6.1,6.2,6.3,6.4,6.5,6.6,6.5,6.4,6.3,6.2,6.1,6.2,6.3,6.2];

            const chart = new Chart(document.getElementById('allSensorsChart'), {
                type: 'line',
                data: {
                    labels,
                    datasets: [
                        {
                            label: 'Temperature (°C)',
                            data: temperatureData,
                            borderColor: '#FF5722',
                            yAxisID: 'yTemp',
                            tension: 0,
                            pointRadius: 0
                        },
                        {
                            label: 'Humidity (%)',
                            data: humidityData,
                            borderColor: '#00BCD4',
                            yAxisID: 'yHumidity',
                            tension: 0,
                            pointRadius: 0
                        },
                        {
                            label: 'Soil Moisture (%)',
                            data: soilMoistureData,
                            borderColor: '#4CAF50',
                            yAxisID: 'ySoil',
                            tension: 0,
                            pointRadius: 0
                        },
                        {
                            label: 'EC Level',
                            data: ecLevelData,
                            borderColor: '#9C27B0',
                            yAxisID: 'yEC',
                            tension: 0,
                            pointRadius: 0
                        },
                        {
                            label: 'pH Level',
                            data: phLevelData,
                            borderColor: '#795548',
                            yAxisID: 'yPH',
                            tension: 0,
                            pointRadius: 0
                        }
                    ]
                },

                options: {
                    responsive: true,
                    maintainAspectRatio: false,

                    interaction: {
                        mode: 'index',
                        intersect: false
                    },

                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    },

                    scales: {
                        x: {
                            grid: { display: false },
                            ticks: {
                                font: {
                                    size: 10   // smaller X labels
                                }
                            }
                        },

                        // =========================
                        // TEMPERATURE AXIS (RED)
                        // =========================
                        yTemp: {
                            type: 'linear',
                            position: 'left',
                            ticks: {
                                color: '#FF5722',
                                font: { size: 10 }
                            },
                            title: {
                                display: true,
                                text: 'Temp (°C)',
                                color: '#FF5722'
                            },
                            grid: {
                                drawOnChartArea: true
                            }
                        },

                        // =========================
                        // HUMIDITY AXIS (CYAN)
                        // =========================
                        yHumidity: {
                            type: 'linear',
                            position: 'right',
                            ticks: {
                                color: '#ffffff',
                                font: { size: 10 }
                            },
                            title: {
                                display: true,
                                text: 'Humidity (%)',
                                color: '#ffffff'
                            },
                            grid: {
                                drawOnChartArea: false
                            }
                        },

                        // =========================
                        // SOIL AXIS (GREEN)
                        // =========================
                        ySoil: {
                            type: 'linear',
                            position: 'right',
                            offset: true,
                            ticks: {
                                color: '#000000',
                                font: { size: 10 }
                            },
                            title: {
                                display: true,
                                text: 'Soil (%)',
                                color: '#000000'
                            },
                            grid: {
                                drawOnChartArea: false
                            }
                        },

                        // =========================
                        // EC AXIS (PURPLE)
                        // =========================
                        yEC: {
                            type: 'linear',
                            position: 'left',
                            offset: true,
                            ticks: {
                                color: '#9C27B0',
                                font: { size: 10 }
                            },
                            title: {
                                display: true,
                                text: 'EC Level',
                                color: '#9C27B0'
                            },
                            grid: {
                                drawOnChartArea: false
                            }
                        },

                        // =========================
                        // pH AXIS (BROWN)
                        // =========================
                        yPH: {
                            type: 'linear',
                            position: 'left',
                            offset: true,
                            ticks: {
                                color: '#795548',
                                font: { size: 10 }
                            },
                            title: {
                                display: true,
                                text: 'pH Level',
                                color: '#795548'
                            },
                            grid: {
                                drawOnChartArea: false
                            }
                        }
                    }
                }
            });

        });
    </script>
</div>
