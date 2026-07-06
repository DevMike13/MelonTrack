<div class="relative overflow-hidden bg-white">

    <div class="fixed right-0 top-0 h-screen w-[25vw] lg:w-[30vw] xl:w-[35vw] pointer-events-none z-0">
        <div class="h-full w-full bg-[url('../../public/images/melon-right-bg.png')] bg-no-repeat bg-contain bg-right opacity-100"></div>
    </div>

    <div class="relative z-10 bg-transparent">
        {{-- FILTER --}}
        <div class="flex justify-between items-center lg:items-start flex-col md:flex-row gap-2 mb-8">
            <div>
                <h6>Time Range</h6>

                <div class="flex flex-nowrap sm:flex-wrap items-center gap-1 sm:gap-2 bg-gray-300 py-2 px-2 sm:px-3 rounded-full overflow-x-auto max-w-full">
                    @php
                        $filters = ['Live', 'Yesterday', '7D', '30D', 'Custom'];
                    @endphp

                    @foreach ($filters as $filter)
                        <button
                            wire:click="$set('activeFilter', '{{ $filter }}')"
                            class="shrink-0 whitespace-nowrap px-3 sm:px-4 py-1.5 rounded-full text-xs sm:text-sm font-medium transition
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
            @if($activeFilter === 'Custom')
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mt-4 w-full max-w-3xl">
                    <x-datetime-picker
                        label="Start Date"
                        placeholder="Select start date"
                        wire:model.defer="customStartDate"
                        parse-format="YYYY-MM-DD HH:mm:ss"
                        display-format="MMM DD, YYYY hh:mm A"
                        max="{{ $maxDateTime }}"
                        interval="60"
                        without-timezone
                    />

                    <x-datetime-picker
                        label="End Date"
                        placeholder="Select end date"
                        wire:model.defer="customEndDate"
                        parse-format="YYYY-MM-DD HH:mm:ss"
                        display-format="MMM DD, YYYY hh:mm A"
                        min="{{ $customStartDate }}"
                        max="{{ $maxDateTime }}"
                        interval="60"
                        without-timezone
                    />

                    <div class="flex items-end">
                        <button
                            type="button"
                            wire:click="applyCustomFilter"
                            wire:loading.attr="disabled"
                            wire:target="applyCustomFilter"
                            class="w-full px-4 py-2 rounded-lg bg-[#356744] text-white text-sm font-medium disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2"
                        >
                            <span wire:loading.remove wire:target="applyCustomFilter">
                                Apply
                            </span>

                            <span wire:loading wire:target="applyCustomFilter" class="flex items-center justify-center gap-2">
                                <svg class="animate-spin w-4 h-4 inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" class="opacity-25"/>
                                    <path fill="currentColor" class="opacity-75" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"/>
                                </svg>

                                <span>Loading...</span>
                            </span>
                        </button>
                    </div>
                </div>
            @endif
        </div>

        {{-- CARDS --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-3 gap-5 mb-8 items-stretch">

            {{-- TEMPERATURE CARD --}}
            <div class="bg-[#e1eedb] border border-[#356744] p-4 sm:p-5 rounded-2xl flex flex-col gap-4 h-full">
                <div class="flex items-center justify-between gap-3">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 bg-[#c1ebbf] flex items-center justify-center overflow-hidden rounded-full shrink-0">
                        <img
                            src="{{ asset('images/humidity-icon.png') }}"
                            alt=""
                            class="w-8 h-8 object-contain"
                        >
                    </div>

                    <div class="text-right min-w-0">
                        <p class="font-semibold text-[#376a44] text-xs sm:text-sm">Temperature</p>
                        <p class="text-lg sm:text-2xl font-semibold">
                            {{ number_format($Temperature, 1, '.', ',') }} °C
                        </p>
                    </div>
                </div>

                <div class="flex items-center justify-center gap-2 text-xs">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 sm:size-5 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                    </svg>
                    <p>1.2°C than yesterday</p>
                </div>
            </div>

            {{-- HUMIDITY CARD --}}
            <div class="bg-blue-100/50 border border-blue-500 p-4 sm:p-5 rounded-2xl flex flex-col gap-4 h-full">
                <div class="flex items-center justify-between gap-3">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 bg-[#cfdfe9] flex items-center justify-center overflow-hidden rounded-full shrink-0">
                        <img
                            src="{{ asset('images/humidity-icon.png') }}"
                            alt=""
                            class="w-8 h-8 object-contain"
                        >
                    </div>

                    <div class="text-right min-w-0">
                        <p class="font-semibold text-blue-600 text-xs sm:text-sm">Humidity</p>
                        <p class="text-lg sm:text-2xl font-semibold">
                            {{ number_format($Humidity, 1, '.', ',') }}%
                        </p>
                    </div>
                </div>

                <div class="flex items-center justify-center gap-2 text-xs">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 sm:size-5 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                    </svg>
                    <p>3% than yesterday</p>
                </div>
            </div>

            {{-- SOIL MOISTURE CARD --}}
            <div class="bg-[#dde7e9] border border-[#dde7e9] p-4 sm:p-5 rounded-2xl flex flex-col gap-4 h-full">
                <div class="flex items-center justify-between gap-3">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 bg-[#eadcdb] flex items-center justify-center overflow-hidden rounded-full shrink-0">
                        <img
                            src="{{ asset('images/soil-moisture-icon.png') }}"
                            alt=""
                            class="w-8 h-8 object-contain"
                        >
                    </div>

                    <div class="text-right min-w-0">
                        <p class="font-semibold text-gray-500 text-xs sm:text-sm">Soil Moisture</p>
                        <p class="text-lg sm:text-2xl font-semibold">
                            {{ number_format($SoilMoisture, 1, '.', ',') }}%
                        </p>
                    </div>
                </div>

                <div class="flex items-center justify-center gap-2 text-xs">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 sm:size-5 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                    </svg>
                    <p>2% than yesterday</p>
                </div>
            </div>

            {{-- EC CARD --}}
            <div class="bg-[#e9e6dd] border border-[#e9e6dd] p-4 sm:p-5 rounded-2xl flex flex-col gap-4 h-full">
                <div class="flex items-center justify-between gap-3">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 bg-[#e7e8db] flex items-center justify-center overflow-hidden rounded-full shrink-0">
                        <img
                            src="{{ asset('images/ec-icon.png') }}"
                            alt=""
                            class="w-8 h-8 object-contain"
                        >
                    </div>

                    <div class="text-right min-w-0">
                        <p class="font-semibold text-[#b5a86c] text-xs sm:text-sm">EC Level</p>
                        <p class="text-lg sm:text-2xl font-semibold">
                            {{ number_format($ECLevel, 1, '.', ',') }}%
                        </p>
                    </div>
                </div>

                <div class="flex items-center justify-center gap-2 text-xs">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 sm:size-5 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                    </svg>
                    <p>1.2% than yesterday</p>
                </div>
            </div>

            {{-- PH CARD --}}
            <div class="bg-[#e3e6eb] border border-[#e3e6eb] p-4 sm:p-5 rounded-2xl flex flex-col gap-4 h-full">
                <div class="flex items-center justify-between gap-3">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 bg-[#b79dcb] flex items-center justify-center overflow-hidden rounded-full shrink-0">
                        <img
                            src="{{ asset('images/ph-icon.png') }}"
                            alt=""
                            class="w-8 h-8 object-contain"
                        >
                    </div>

                    <div class="text-right min-w-0">
                        <p class="font-semibold text-[#ac82aa] text-xs sm:text-sm">pH Level</p>
                        <p class="text-lg sm:text-2xl font-semibold">
                            {{ number_format($pHLevel, 1, '.', ',') }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center justify-center gap-2 text-xs">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 sm:size-5 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                    </svg>
                    <p>1.1 than yesterday</p>
                </div>
            </div>

            {{-- NPK CARD --}}
            <div class="bg-green-100/60 border border-green-500 p-4 sm:p-5 rounded-2xl flex flex-col gap-4 h-full">
                <div class="flex items-center justify-between gap-3">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 bg-green-200 flex items-center justify-center overflow-hidden rounded-full shrink-0">
                        <img
                            src="{{ asset('images/leaf-icon.png') }}"
                            alt=""
                            class="w-8 h-8 object-contain"
                        >
                    </div>

                    <div class="text-right min-w-0">
                        <p class="font-semibold text-green-700 text-xs sm:text-sm">NPK Level</p>

                        <div class="flex justify-between gap-2 text-sm sm:text-base font-semibold">
    
                            <div class="bg-green-200 text-green-800 px-3 py-1 rounded-lg">
                                N: {{ number_format($Nitrogen, 1, '.', ',') }}
                            </div>

                            <div class="bg-amber-200 text-amber-800 px-3 py-1 rounded-lg">
                                P: {{ number_format($Phosphorus, 1, '.', ',') }}
                            </div>

                            <div class="bg-red-200 text-red-800 px-3 py-1 rounded-lg">
                                K: {{ number_format($Potassium, 1, '.', ',') }}
                            </div>

                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-center gap-2 text-xs">
                    <p>Nitrogen • Phosphorus • Potassium</p>
                </div>
            </div>
        </div>

        {{-- <div wire:ignore class="w-[100%] h-96 mb-8">
            <canvas id="allSensorsChart"></canvas>
        </div> --}}

        <div class="w-full overflow-x-auto md:overflow-x-visible mb-8 bg-white rounded-2xl border border-[#356744] p-3 lg:p-8">
            {{-- <select wire:model="selectedParameter" class="mb-4 px-3 py-2 border rounded">
                <option value="all">All Parameters</option>
                <option value="temperature">Temperature</option>
                <option value="humidity">Humidity</option>
                <option value="soil_moisture">Soil Moisture</option>
                <option value="ec_level">EC Level</option>
                <option value="ph_level">pH Level</option>
            </select> --}}
            <div class="mb-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-1">
                {{-- <h6 class="font-semibold text-[#356744]">Sensor Graph</h6> --}}
                <h6 class="font-semibold text-[#356744]">
                    @if($activeFilter === 'Live')
                        Sensor Graph - Today Hourly Data
                    @elseif($activeFilter === 'Yesterday')
                        Sensor Graph - Yesterday Hourly Data
                    @elseif($activeFilter === '7D')
                        Sensor Graph - Average Every 12 Hours
                    @elseif($activeFilter === '30D')
                        Sensor Graph - Average Everyday
                    @else
                        Sensor Graph
                    @endif
                </h6>
                <p class="text-xs sm:text-sm text-gray-500">
                    Showing: {{ $ChartDateRange }}
                </p>
            </div>
            <div class="overflow-x-auto">
                <div
                    id="chartContainer"
                    wire:ignore
                    class="h-[300px] sm:h-[350px] lg:h-[450px] xl:h-[500px]"
                    style="min-width: 1500px;"
                >
                    <canvas id="allSensorsChart"></canvas>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-3 gap-5 mb-8">
            <div class="w-full h-full max-h-72 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100 bg-white rounded-2xl border border-[#356744] p-4 lg:p-6">
                <h6 class="mb-5 font-semibold">Parameters Status</h6>
                @php
                    $tempStatus =
                        $Temperature < $MinTemperature ? 'low' :
                        ($Temperature > $MaxTemperature ? 'high' : 'optimal');

                    $tempStatusText = match($tempStatus) {
                        'optimal' => 'Temperature is in optimal range',
                        'low' => 'Temperature is below optimal range',
                        'high' => 'Temperature is above optimal range',
                    };
                @endphp

                

                <div class="flex flex-row items-center gap-3 border-b-[1px] border-gray-700 py-3">

                    {{-- ICON (UNCHANGED) --}}
                    @if($tempStatus === 'optimal')
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 text-green-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>

                    @elseif($tempStatus === 'low')
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 text-blue-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>

                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 text-red-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                        </svg>
                    @endif

                    {{-- VALUES + STATUS TEXT --}}
                    <div class="flex flex-col items-start leading-tight">

                        <div class="flex justify-start items-start gap-2">
                            <span class="font-semibold
                                {{ $tempStatus === 'optimal' ? 'text-green-500' : '' }}
                                {{ $tempStatus === 'low' ? 'text-blue-500' : '' }}
                                {{ $tempStatus === 'high' ? 'text-red-500' : '' }}">
                                {{ number_format($Temperature, 1, '.', ',') }} °C
                            </span>

                        </div>

                        {{-- STATUS TEXT --}}
                        <span class="text-xs mt-1
                            {{ $tempStatus === 'optimal' ? 'text-green-600' : '' }}
                            {{ $tempStatus === 'low' ? 'text-blue-500' : '' }}
                            {{ $tempStatus === 'high' ? 'text-red-500' : '' }}">
                            {{ $tempStatusText }}
                        </span>
                        @php
                            use Carbon\Carbon;

                            $lastChecked = Carbon::now('Asia/Manila')->subMinutes(10);
                        @endphp
                        <span class="text-xs mt-1 text-gray-600 font-semibold">
                            Last Checked: <span class="italic font-light">{{ $lastChecked->format('h:i A, F d, Y') }}</span> 
                        </span>

                    </div>

                </div>

                @php
                    $humidityStatus =
                        $Humidity < $MinHumidity ? 'low' :
                        ($Humidity > $MaxHumidity ? 'high' : 'optimal');

                    $humidityStatusText = match($humidityStatus) {
                        'optimal' => 'Humidity is in optimal range',
                        'low' => 'Humidity is below optimal range',
                        'high' => 'Humidity is above optimal range',
                    };

                
                    $humidityLastChecked = Carbon::now('Asia/Manila')->subMinutes(10);
                @endphp


                <div class="flex flex-row items-center gap-3 border-b-[1px] border-gray-700 py-3">

                    {{-- ICON (UNCHANGED) --}}
                    @if($humidityStatus === 'optimal')
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 text-green-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>

                    @elseif($humidityStatus === 'low')
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 text-blue-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>

                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 text-red-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                        </svg>
                    @endif


                    {{-- VALUE + TEXT --}}
                    <div class="flex flex-col items-start leading-tight">

                        <span class="font-semibold
                            {{ $humidityStatus === 'optimal' ? 'text-green-500' : '' }}
                            {{ $humidityStatus === 'low' ? 'text-blue-500' : '' }}
                            {{ $humidityStatus === 'high' ? 'text-red-500' : '' }}">
                            {{ number_format($Humidity, 1, '.', ',') }} %
                        </span>

                        <span class="text-xs mt-1
                            {{ $humidityStatus === 'optimal' ? 'text-green-600' : '' }}
                            {{ $humidityStatus === 'low' ? 'text-blue-500' : '' }}
                            {{ $humidityStatus === 'high' ? 'text-red-500' : '' }}">
                            {{ $humidityStatusText }}
                        </span>

                        <span class="text-xs mt-1 text-gray-600 font-semibold">
                            Last Checked:
                            <span class="italic font-light">
                                {{ $humidityLastChecked->format('h:i A, F d, Y') }}
                            </span>
                        </span>

                    </div>

                </div>

                @php
                    $soilStatus =
                        $SoilMoisture < $MinSoilMoisture ? 'low' :
                        ($SoilMoisture > $MaxSoilMoisture ? 'high' : 'optimal');

                    $soilStatusText = match($soilStatus) {
                        'optimal' => 'Soil Moisture is in optimal range',
                        'low' => 'Soil Moisture is below optimal range',
                        'high' => 'Soil Moisture is above optimal range',
                    };

                    $soilLastChecked = Carbon::now('Asia/Manila')->subMinutes(10);
                @endphp


                <div class="flex flex-row items-center gap-3 border-b-[1px] border-gray-700 py-3">

                    {{-- ICON (UNCHANGED) --}}
                    @if($soilStatus === 'optimal')
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 text-green-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>

                    @elseif($soilStatus === 'low')
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 text-blue-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>

                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 text-red-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 1 0 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                        </svg>
                    @endif


                    {{-- VALUE + TEXT --}}
                    <div class="flex flex-col items-start leading-tight">

                        <span class="font-semibold
                            {{ $soilStatus === 'optimal' ? 'text-green-500' : '' }}
                            {{ $soilStatus === 'low' ? 'text-blue-500' : '' }}
                            {{ $soilStatus === 'high' ? 'text-red-500' : '' }}">
                            {{ number_format($SoilMoisture, 1, '.', ',') }} %
                        </span>

                        <span class="text-xs mt-1
                            {{ $soilStatus === 'optimal' ? 'text-green-600' : '' }}
                            {{ $soilStatus === 'low' ? 'text-blue-500' : '' }}
                            {{ $soilStatus === 'high' ? 'text-red-500' : '' }}">
                            {{ $soilStatusText }}
                        </span>

                        <span class="text-xs mt-1 text-gray-600 font-semibold">
                            Last Checked:
                            <span class="italic font-light">
                                {{ $soilLastChecked->format('h:i A, F d, Y') }}
                            </span>
                        </span>

                    </div>

                </div>

                @php
                    $ecStatus =
                        $ECLevel < $MinECLevel ? 'low' :
                        ($ECLevel > $MaxECLevel ? 'high' : 'optimal');

                    $ecStatusText = match($ecStatus) {
                        'optimal' => 'EC Level is in optimal range',
                        'low' => 'EC Level is below optimal range',
                        'high' => 'EC Level is above optimal range',
                    };

                    $ecLastChecked = Carbon::now('Asia/Manila')->subMinutes(10);
                @endphp

                <div class="flex flex-row items-center gap-3 border-b-[1px] border-gray-700 py-3">

                    {{-- ICON (UNCHANGED) --}}
                    @if($ecStatus === 'optimal')
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 text-green-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>

                    @elseif($ecStatus === 'low')
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 text-blue-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>

                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 text-red-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                        </svg>
                    @endif

                    {{-- VALUE + STATUS --}}
                    <div class="flex flex-col items-start leading-tight">

                        <div class="flex justify-start items-start gap-2">
                            <span class="font-semibold
                                {{ $ecStatus === 'optimal' ? 'text-green-500' : '' }}
                                {{ $ecStatus === 'low' ? 'text-blue-500' : '' }}
                                {{ $ecStatus === 'high' ? 'text-red-500' : '' }}">
                                {{ number_format($ECLevel, 1, '.', ',') }}
                            </span>
                        </div>

                        {{-- STATUS TEXT --}}
                        <span class="text-xs mt-1
                            {{ $ecStatus === 'optimal' ? 'text-green-600' : '' }}
                            {{ $ecStatus === 'low' ? 'text-blue-500' : '' }}
                            {{ $ecStatus === 'high' ? 'text-red-500' : '' }}">
                            {{ $ecStatusText }}
                        </span>

                        {{-- LAST CHECKED --}}
                        <span class="text-xs mt-1 text-gray-600 font-semibold">
                            Last Checked:
                            <span class="italic font-light">
                                {{ $ecLastChecked->format('h:i A, F d, Y') }}
                            </span>
                        </span>

                    </div>
                </div>

                @php
                    $phStatus =
                        $pHLevel < $MinpHLevel ? 'low' :
                        ($pHLevel > $MaxpHLevel ? 'high' : 'optimal');

                    $phStatusText = match($phStatus) {
                        'optimal' => 'pH Level is in optimal range',
                        'low' => 'pH Level is below optimal range',
                        'high' => 'pH Level is above optimal range',
                    };

                    $phLastChecked = Carbon::now('Asia/Manila')->subMinutes(10);
                @endphp

                <div class="flex flex-row items-center gap-3 border-b-[1px] border-gray-700 py-3">

                    {{-- ICON (UNCHANGED) --}}
                    @if($phStatus === 'optimal')
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 text-green-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>

                    @elseif($phStatus === 'low')
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 text-blue-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>

                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 text-red-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                        </svg>
                    @endif

                    {{-- VALUE + STATUS --}}
                    <div class="flex flex-col items-start leading-tight">

                        <div class="flex justify-start items-start gap-2">
                            <span class="font-semibold
                                {{ $phStatus === 'optimal' ? 'text-green-500' : '' }}
                                {{ $phStatus === 'low' ? 'text-blue-500' : '' }}
                                {{ $phStatus === 'high' ? 'text-red-500' : '' }}">
                                {{ number_format($pHLevel, 1, '.', ',') }}
                            </span>
                        </div>

                        {{-- STATUS TEXT --}}
                        <span class="text-xs mt-1
                            {{ $phStatus === 'optimal' ? 'text-green-600' : '' }}
                            {{ $phStatus === 'low' ? 'text-blue-500' : '' }}
                            {{ $phStatus === 'high' ? 'text-red-500' : '' }}">
                            {{ $phStatusText }}
                        </span>

                        {{-- LAST CHECKED --}}
                        <span class="text-xs mt-1 text-gray-600 font-semibold">
                            Last Checked:
                            <span class="italic font-light">
                                {{ $phLastChecked->format('h:i A, F d, Y') }}
                            </span>
                        </span>

                    </div>
                </div>

                @php
                    $npkStatus = 'optimal';

                    $npkStatusText = 'NPK readings received successfully';

                    $npkLastChecked = Carbon::now('Asia/Manila')->subMinutes(10);
                @endphp

                <div class="flex flex-row items-center gap-3 border-b-[1px] border-gray-700 py-3">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="size-6 text-green-500">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>

                    <div class="flex flex-col items-start leading-tight">

                        <div class="flex flex-wrap gap-2">
                            <span class="font-semibold text-green-500">
                                N: {{ number_format($Nitrogen, 1, '.', ',') }}
                            </span>

                            <span class="font-semibold text-amber-500">
                                P: {{ number_format($Phosphorus, 1, '.', ',') }}
                            </span>

                            <span class="font-semibold text-red-500">
                                K: {{ number_format($Potassium, 1, '.', ',') }}
                            </span>
                        </div>

                        <span class="text-xs mt-1 text-green-600">
                            {{ $npkStatusText }}
                        </span>

                        <span class="text-xs mt-1 text-gray-600 font-semibold">
                            Last Checked:
                            <span class="italic font-light">
                                {{ $npkLastChecked->format('h:i A, F d, Y') }}
                            </span>
                        </span>

                    </div>
                </div>
                
            </div>

            <div class="col-span-1 md:col-span-2 w-full h-full max-h-72 overflow-y-auto bg-white rounded-2xl border border-[#356744] p-4 lg:p-6">

                <h6 class="mb-5 font-semibold">Sensor Devices</h6>

                <table class="w-full text-sm">
                    <thead class="text-left text-xs text-gray-500 uppercase tracking-wider">
                        <tr>
                            <th class="px-5 py-3 font-medium">Sensor</th>
                            <th class="px-5 py-3 font-medium">Status</th>
                            <th class="px-5 py-3 font-medium">Last Update</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">

                        {{-- Temperature --}}
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-5 py-3 font-medium text-gray-800">Temperature</td>
                            <td class="px-5 py-3">
                                <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-green-50 text-green-600 ring-1 ring-green-200">
                                    ● Online
                                </span>
                            </td>
                            <td class="px-5 py-3 text-gray-500">{{ Carbon::now('Asia/Manila')->format('h:i A, F d, Y') }}</td>
                        </tr>

                        {{-- Humidity --}}
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-5 py-3 font-medium text-gray-800">Humidity</td>
                            <td class="px-5 py-3">
                                <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-red-50 text-red-600 ring-1 ring-red-200">
                                    ● Offline
                                </span>
                            </td>
                            <td class="px-5 py-3 text-gray-500">{{ Carbon::now('Asia/Manila')->format('h:i A, F d, Y') }}</td>
                        </tr>

                        {{-- Soil Moisture --}}
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-5 py-3 font-medium text-gray-800">Soil Moisture</td>
                            <td class="px-5 py-3">
                                <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-green-50 text-green-600 ring-1 ring-green-200">
                                    ● Online
                                </span>
                            </td>
                            <td class="px-5 py-3 text-gray-500">{{ Carbon::now('Asia/Manila')->format('h:i A, F d, Y') }}</td>
                        </tr>

                        {{-- EC Level --}}
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-5 py-3 font-medium text-gray-800">EC Level</td>
                            <td class="px-5 py-3">
                                <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-green-50 text-green-600 ring-1 ring-green-200">
                                    ● Online
                                </span>
                            </td>
                            <td class="px-5 py-3 text-gray-500">{{ Carbon::now('Asia/Manila')->format('h:i A, F d, Y') }}</td>
                        </tr>

                        {{-- pH Level --}}
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-5 py-3 font-medium text-gray-800">pH Level</td>
                            <td class="px-5 py-3">
                                <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-green-50 text-green-600 ring-1 ring-green-200">
                                    ● Online
                                </span>
                            </td>
                            <td class="px-5 py-3 text-gray-500">{{ Carbon::now('Asia/Manila')->format('h:i A, F d, Y') }}</td>
                        </tr>

                        {{-- NPK Sensor --}}
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-5 py-3 font-medium text-gray-800">NPK Sensor</td>
                            <td class="px-5 py-3">
                                <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-green-50 text-green-600 ring-1 ring-green-200">
                                    ● Online
                                </span>
                            </td>
                            <td class="px-5 py-3 text-gray-500">
                                {{ Carbon::now('Asia/Manila')->format('h:i A, F d, Y') }}
                            </td>
                        </tr>

                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        let chart;

        function buildDatasets(data, mode) {
            const datasets = [];

            const colors = {
                temperature: '#FF5722',
                humidity: '#00BCD4',
                soil_moisture: '#4CAF50',
                soil_moisture2: '#10B981',
                water_level: '#3B82F6',
                ec_level: '#9C27B0',
                ph_level: '#795548',
                nitrogen: '#22C55E',
                phosphorus: '#F59E0B',
                potassium: '#EF4444',
                nitrogen2: '#84CC16',
                phosphorus2: '#F97316',
                potassium2: '#DC2626',
            };

            const labels = {
                temperature: 'Temperature',
                humidity: 'Humidity',
                soil_moisture: 'Soil Moisture',
                soil_moisture2: 'Soil Moisture 2',
                water_level: 'Water Level',
                ec_level: 'EC Level',
                ph_level: 'pH Level',
                nitrogen: 'Nitrogen',
                phosphorus: 'Phosphorus',
                potassium: 'Potassium',
                nitrogen2: 'Nitrogen 2',
                phosphorus2: 'Phosphorus 2',
                potassium2: 'Potassium 2',
            };

            const units = {
                temperature: '°C',
                humidity: '%',
                soil_moisture: '%',
                soil_moisture2: '%',
                water_level: '%',
                ec_level: '',
                ph_level: '',
                nitrogen: ' ppm',
                phosphorus: ' ppm',
                potassium: ' ppm',
                nitrogen2: ' ppm',
                phosphorus2: ' ppm',
                potassium2: ' ppm',
            };

            if (mode === 'all') {
                Object.keys(data).forEach(key => {
                    datasets.push({
                        label: labels[key],
                        data: data[key],
                        borderColor: colors[key],
                        tension: 0,
                        pointRadius: 0
                    });
                });
            } else {
                datasets.push({
                    label: labels[mode],
                    data: data[mode],
                    borderColor: colors[mode],
                    tension: 0,
                    pointRadius: 0
                });
            }

            return datasets;
        }

        document.addEventListener('livewire:init', () => {

            const ctx = document.getElementById('allSensorsChart');

            if (!ctx) return;

            chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($chartLabels ?? []),
                    datasets: buildDatasets(@json($chartData ?? []), 'all')
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
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    const label = context.dataset.label || '';
                                    // const value = context.parsed.y;
                                    const value = Number(context.parsed.y).toFixed(2);

                                    if (label.includes('Temperature')) {
                                        return `${label}: ${value}°C`;
                                    }

                                    if (
                                        label.includes('Humidity') ||
                                        label.includes('Soil Moisture') ||
                                        label.includes('Water Level')
                                    ) {
                                        return `${label}: ${value}%`;
                                    }

                                    if (label.includes('EC Level') || label.includes('pH Level')) {
                                        return `${label}: ${value}`;
                                    }

                                    if (
                                        label.includes('Nitrogen') ||
                                        label.includes('Phosphorus') ||
                                        label.includes('Potassium')
                                    ) {
                                        return `${label}: ${value} ppm`;
                                    }

                                    return `${label}: ${value}`;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: { display: false },
                            ticks: {
                                autoSkip: false,
                                maxRotation: 45,
                                minRotation: 45,
                                font: {
                                    size: 10
                                }
                            }
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            Livewire.on('updateChart', (payload) => {
                const data = payload[0];

                chart.data.labels = data.labels;
                chart.data.datasets = buildDatasets(data.data, data.mode);
                chart.update();
            });

        });
    </script>
    {{-- <script>
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
                            label: 'Temperature',
                            data: temperatureData,
                            borderColor: '#FF5722',
                            tension: 0,
                            pointRadius: 0
                        },
                        {
                            label: 'Humidity',
                            data: humidityData,
                            borderColor: '#00BCD4',
                            tension: 0,
                            pointRadius: 0
                        },
                        {
                            label: 'Soil Moisture',
                            data: soilMoistureData,
                            borderColor: '#4CAF50',
                            tension: 0,
                            pointRadius: 0
                        },
                        {
                            label: 'EC Level',
                            data: ecLevelData,
                            borderColor: '#9C27B0',
                            tension: 0,
                            pointRadius: 0
                        },
                        {
                            label: 'pH Level',
                            data: phLevelData,
                            borderColor: '#795548',
                            tension: 0,
                            pointRadius: 0
                        }
                    ]
                },

                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: true,

                    interaction: {
                        mode: 'index',
                        intersect: false
                    },

                    plugins: {
                        legend: {
                            position: 'bottom'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.dataset.label || '';
                                    const value = context.parsed.y;

                                    if (label.includes('Temperature')) {
                                        return `${label}: ${value}°C`;
                                    }

                                    if (label.includes('Humidity') || label.includes('Soil Moisture')) {
                                        return `${label}: ${value}%`;
                                    }

                                    if (label.includes('EC Level')) {
                                        return `${label}: ${value}`;
                                    }

                                    if (label.includes('pH Level')) {
                                        return `${label}: ${value}`;
                                    }

                                    return `${label}: ${value}`;
                                }
                            }
                        }
                    },

                    scales: {
                        x: {
                            grid: { display: false }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: ''
                            }
                        }
                    }

                    // scales: {
                    //     x: {
                    //         grid: { display: false },
                    //         ticks: {
                    //             font: {
                    //                 size: 10   // smaller X labels
                    //             }
                    //         }
                    //     },

                    //     // =========================
                    //     // TEMPERATURE AXIS (RED)
                    //     // =========================
                    //     yTemp: {
                    //         type: 'linear',
                    //         position: 'left',
                    //         ticks: {
                    //             color: '#FF5722',
                    //             font: { size: 10 }
                    //         },
                    //         title: {
                    //             display: true,
                    //             text: 'Temp (°C)',
                    //             color: '#FF5722'
                    //         },
                    //         grid: {
                    //             drawOnChartArea: true
                    //         }
                    //     },

                    //     // =========================
                    //     // HUMIDITY AXIS (CYAN)
                    //     // =========================
                    //     yHumidity: {
                    //         type: 'linear',
                    //         position: 'right',
                    //         ticks: {
                    //             color: '#ffffff',
                    //             font: { size: 10 }
                    //         },
                    //         title: {
                    //             display: true,
                    //             text: 'Humidity (%)',
                    //             color: '#ffffff'
                    //         },
                    //         grid: {
                    //             drawOnChartArea: false
                    //         }
                    //     },

                    //     // =========================
                    //     // SOIL AXIS (GREEN)
                    //     // =========================
                    //     ySoil: {
                    //         type: 'linear',
                    //         position: 'right',
                    //         offset: true,
                    //         ticks: {
                    //             color: '#000000',
                    //             font: { size: 10 }
                    //         },
                    //         title: {
                    //             display: true,
                    //             text: 'Soil (%)',
                    //             color: '#000000'
                    //         },
                    //         grid: {
                    //             drawOnChartArea: false
                    //         }
                    //     },

                    //     // =========================
                    //     // EC AXIS (PURPLE)
                    //     // =========================
                    //     yEC: {
                    //         type: 'linear',
                    //         position: 'left',
                    //         offset: true,
                    //         ticks: {
                    //             color: '#9C27B0',
                    //             font: { size: 10 }
                    //         },
                    //         title: {
                    //             display: true,
                    //             text: 'EC Level',
                    //             color: '#9C27B0'
                    //         },
                    //         grid: {
                    //             drawOnChartArea: false
                    //         }
                    //     },

                    //     // =========================
                    //     // pH AXIS (BROWN)
                    //     // =========================
                    //     yPH: {
                    //         type: 'linear',
                    //         position: 'left',
                    //         offset: true,
                    //         ticks: {
                    //             color: '#795548',
                    //             font: { size: 10 }
                    //         },
                    //         title: {
                    //             display: true,
                    //             text: 'pH Level',
                    //             color: '#795548'
                    //         },
                    //         grid: {
                    //             drawOnChartArea: false
                    //         }
                    //     }
                    // }
                }
            });

        });
    </script> --}}
</div>
