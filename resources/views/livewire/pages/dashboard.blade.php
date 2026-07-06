<div class="relative overflow-hidden">

    <div class="fixed right-0 top-0 h-screen w-[35%] pointer-events-none z-0">
        <div class="h-full w-full bg-[url('../../public/images/melon-right-bg.png')] bg-no-repeat bg-cover bg-right opacity-100"></div>
    </div>

    <div class="relative z-10 space-y-6">

        {{-- SUMMARY CARDS --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4 gap-5">

            @php
                $summaryCards = [
                    [
                        'label' => 'Active cycles',
                        'value' => $activeCycles,
                        'footer' => 'All systems running well.',
                        'bg' => 'bg-[#dfeeda]',
                        'text' => 'text-[#356744]',
                        'iconBg' => 'bg-[#b8d8c1]',
                    ],
                    [
                        'label' => 'Completed cycles',
                        'value' => $completedCycles,
                        'footer' => 'Cycles successfully completed.',
                        'bg' => 'bg-blue-50',
                        'text' => 'text-blue-700',
                        'iconBg' => 'bg-blue-100',
                    ],
                    // [
                    //     'label' => 'Upcoming harvests',
                    //     'value' => $upcomingHarvests,
                    //     'footer' => 'Harvest schedule active.',
                    //     'bg' => 'bg-amber-50',
                    //     'text' => 'text-amber-700',
                    //     'iconBg' => 'bg-amber-100',
                    // ],
                    [
                        'label' => 'Average brix',
                        'value' => number_format($averageBrix ?? 0, 1),
                        'footer' => 'Sugar level average.',
                        'bg' => 'bg-purple-50',
                        'text' => 'text-purple-700',
                        'iconBg' => 'bg-purple-100',
                    ],
                    [
                        'label' => 'Harvested melons',
                        'value' => number_format($totalHarvestedMelons),
                        'footer' => 'Total melons harvested.',
                        'bg' => 'bg-green-50',
                        'text' => 'text-green-700',
                        'iconBg' => 'bg-green-100',
                    ],
                    // [
                    //     'label' => 'Pending milestones',
                    //     'value' => $pendingMilestones,
                    //     'footer' => 'Tasks waiting completion.',
                    //     'bg' => 'bg-rose-50',
                    //     'text' => 'text-rose-700',
                    //     'iconBg' => 'bg-rose-100',
                    // ],
                    
                ];
            @endphp

            @foreach($summaryCards as $card)
                <div class="{{ $card['bg'] }} rounded-2xl p-4 min-h-[130px] relative overflow-hidden">
                    <div class="relative z-10">
                        <p class="text-[11px] font-semibold {{ $card['text'] }}">
                            {{ $card['label'] }}
                        </p>

                        <h3 class="text-2xl font-bold text-gray-900 mt-2">
                            {{ $card['value'] }}
                        </h3>

                        <div class="flex items-center gap-1 mt-6 text-[9px] text-gray-600">
                            <span class="w-4 h-4 rounded-full bg-white/70 flex items-center justify-center">
                                ✓
                            </span>
                            <span>{{ $card['footer'] }}</span>
                        </div>
                    </div>

                    <div class="absolute right-3 bottom-5 w-12 h-12 rounded-full {{ $card['iconBg'] }} flex items-center justify-center">
                        <img src="{{ asset('images/leaf-icon.png') }}"
                            class="w-8 h-8 object-contain rotate-[35deg]"
                            alt="">
                    </div>
                </div>
            @endforeach

        </div>

        {{-- ENVIRONMENTAL OVERVIEW --}}
        <div class="bg-white border border-gray-200 rounded-2xl p-4 shadow-sm mb-8">

            <div class="flex items-start justify-between mb-3">
                <div>
                    <h6 class="font-semibold text-gray-800 text-sm">
                        Environmental Overview
                    </h6>

                    <p class="text-[10px] text-gray-500">
                        Real-time conditions for active cycles
                    </p>
                </div>

                <a href="{{ url('/admin/parameters-monitoring') }}"
                    class="text-[10px] px-3 py-1 rounded-full border border-[#356744] text-[#356744] hover:bg-[#356744] hover:text-white transition">
                    View All
                </a>
            </div>

            @php
                $readings = [
                    [
                        'label' => 'Temperature',
                        'value' => $Temperature !== null ? number_format($Temperature, 1) . '°C' : '--',
                        'min' => $MinTemperature !== null ? number_format($MinTemperature, 1) . '°C' : '--',
                        'max' => $MaxTemperature !== null ? number_format($MaxTemperature, 1) . '°C' : '--',
                        'color' => '#4ade80',
                        'path' => 'M2 18 C5 8, 8 22, 11 12 S17 5, 22 14',
                    ],
                    [
                        'label' => 'Humidity',
                        'value' => $Humidity !== null ? number_format($Humidity, 1) . '%' : '--',
                        'min' => $MinHumidity !== null ? number_format($MinHumidity, 1) . '%' : '--',
                        'max' => $MaxHumidity !== null ? number_format($MaxHumidity, 1) . '%' : '--',
                        'color' => '#38bdf8',
                        'path' => 'M2 14 C5 5, 8 22, 11 12 S17 7, 22 15',
                    ],
                    [
                        'label' => 'Soil Moisture',
                        'value' => $SoilMoisture !== null ? number_format($SoilMoisture, 1) . '%' : '--',
                        'min' => $MinSoilMoisture !== null ? number_format($MinSoilMoisture, 1) . '%' : '--',
                        'max' => $MaxSoilMoisture !== null ? number_format($MaxSoilMoisture, 1) . '%' : '--',
                        'color' => '#22c55e',
                        'path' => 'M2 16 C5 8, 7 18, 10 11 S16 5, 22 13',
                    ],
                    [
                        'label' => 'EC Level',
                        'value' => $ECLevel !== null ? number_format($ECLevel, 1) : '--',
                        'min' => $MinECLevel !== null ? number_format($MinECLevel, 1) : '--',
                        'max' => $MaxECLevel !== null ? number_format($MaxECLevel, 1) : '--',
                        'color' => '#f59e0b',
                        'path' => 'M2 17 C5 12, 7 20, 10 13 S16 7, 22 15',
                    ],
                    [
                        'label' => 'pH Level',
                        'value' => $pHLevel !== null ? number_format($pHLevel, 1) : '--',
                        'min' => $MinpHLevel !== null ? number_format($MinpHLevel, 1) : '--',
                        'max' => $MaxpHLevel !== null ? number_format($MaxpHLevel, 1) : '--',
                        'color' => '#f472d0',
                        'path' => 'M2 15 C5 7, 8 20, 11 12 S17 6, 22 14',
                    ],

                    [
                        'label' => 'NPK Tank 1',

                        'value' => [
                            'N' => $Nitrogen !== null ? number_format($Nitrogen, 1) : '--',
                            'P' => $Phosphorus !== null ? number_format($Phosphorus, 1) : '--',
                            'K' => $Potassium !== null ? number_format($Potassium, 1) : '--',
                        ],

                        'min' => [
                            'N' => $MinNitrogen !== null ? number_format($MinNitrogen, 1) : '--',
                            'P' => $MinPhosphorus !== null ? number_format($MinPhosphorus, 1) : '--',
                            'K' => $MinPotassium !== null ? number_format($MinPotassium, 1) : '--',
                        ],

                        'max' => [
                            'N' => $MaxNitrogen !== null ? number_format($MaxNitrogen, 1) : '--',
                            'P' => $MaxPhosphorus !== null ? number_format($MaxPhosphorus, 1) : '--',
                            'K' => $MaxPotassium !== null ? number_format($MaxPotassium, 1) : '--',
                        ],

                        'color' => '#22c55e',
                        'path' => 'M2 17 C5 10, 8 20, 11 12 S17 6, 22 14',
                    ],

                    [
                        'label' => 'NPK Tank 2',

                        'value' => [
                            'N' => $Nitrogen2 !== null ? number_format($Nitrogen2, 1) : '--',
                            'P' => $Phosphorus2 !== null ? number_format($Phosphorus2, 1) : '--',
                            'K' => $Potassium2 !== null ? number_format($Potassium2, 1) : '--',
                        ],

                        'min' => [
                            'N' => $MinNitrogen2 !== null ? number_format($MinNitrogen2, 1) : '--',
                            'P' => $MinPhosphorus2 !== null ? number_format($MinPhosphorus2, 1) : '--',
                            'K' => $MinPotassium2 !== null ? number_format($MinPotassium2, 1) : '--',
                        ],

                        'max' => [
                            'N' => $MaxNitrogen2 !== null ? number_format($MaxNitrogen2, 1) : '--',
                            'P' => $MaxPhosphorus2 !== null ? number_format($MaxPhosphorus2, 1) : '--',
                            'K' => $MaxPotassium2 !== null ? number_format($MaxPotassium2, 1) : '--',
                        ],

                        'color' => '#22c55e',
                        'path' => 'M2 17 C5 10, 8 20, 11 12 S17 6, 22 14',
                    ],

                    [
                        'label' => 'Soil Moisture 2',
                        'value' => $SoilMoisture2 !== null ? number_format($SoilMoisture2, 1).'%' : '--',
                        'min' => $MinSoilMoisture2 !== null ? number_format($MinSoilMoisture2,1).'%' : '--',
                        'max' => $MaxSoilMoisture2 !== null ? number_format($MaxSoilMoisture2,1).'%' : '--',
                        'color' => '#10b981',
                        'path' => 'M2 16 C5 8,7 18,10 11 S16 5,22 13',
                    ],

                    [
                        'label' => 'Water Level',
                        'value' => $WaterLevel !== null ? number_format($WaterLevel,1).'%' : '--',
                        'min' => $MinWaterLevel !== null ? number_format($MinWaterLevel,1).'%' : '--',
                        'max' => $MaxWaterLevel !== null ? number_format($MaxWaterLevel,1).'%' : '--',
                        'color' => '#3b82f6',
                        'path' => 'M2 14 C5 6,8 20,12 11 S17 6,22 14',
                    ],
                ];
            @endphp

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">

                @foreach($readings as $reading)
                    <div class="min-w-0 rounded-xl border border-gray-100 p-3 hover:shadow-sm transition">

                        <p class="text-[10px] font-medium text-gray-500 uppercase tracking-wide">
                            {{ $reading['label'] }}
                        </p>

                        @if(is_array($reading['value']))
                            <div class="grid grid-cols-3 gap-2 mt-2 text-center">
                                <div class="bg-green-100 rounded-lg py-2">
                                    <p class="text-[10px] text-green-700">N</p>
                                    <p class="font-bold">{{ $reading['value']['N'] }}</p>
                                </div>

                                <div class="bg-amber-100 rounded-lg py-2">
                                    <p class="text-[10px] text-amber-700">P</p>
                                    <p class="font-bold">{{ $reading['value']['P'] }}</p>
                                </div>

                                <div class="bg-red-100 rounded-lg py-2">
                                    <p class="text-[10px] text-red-700">K</p>
                                    <p class="font-bold">{{ $reading['value']['K'] }}</p>
                                </div>
                            </div>
                        @else
                            <p class="text-xl font-bold text-gray-800 mt-1">
                                {{ $reading['value'] }}
                            </p>

                            <svg viewBox="0 0 24 24" class="w-full h-10 mt-2">
                                <path
                                    d="{{ $reading['path'] }}"
                                    fill="none"
                                    stroke="{{ $reading['color'] }}"
                                    stroke-width="2.5"
                                    stroke-linecap="round"
                                />
                            </svg>
                        @endif

                        @if(is_array($reading['min']))
                            <div class="grid grid-cols-3 gap-2 mt-3 text-[9px] text-gray-500">
                                <div class="text-center">
                                    <div class="font-medium">N</div>
                                    <div>Min: {{ $reading['min']['N'] }}</div>
                                    <div>Max: {{ $reading['max']['N'] }}</div>
                                </div>

                                <div class="text-center">
                                    <div class="font-medium">P</div>
                                    <div>Min: {{ $reading['min']['P'] }}</div>
                                    <div>Max: {{ $reading['max']['P'] }}</div>
                                </div>

                                <div class="text-center">
                                    <div class="font-medium">K</div>
                                    <div>Min: {{ $reading['min']['K'] }}</div>
                                    <div>Max: {{ $reading['max']['K'] }}</div>
                                </div>
                            </div>
                        @else
                            <div class="flex justify-between items-center mt-2 text-[10px] text-gray-500">
                                <div>
                                    <span class="font-medium">Min</span><br>
                                    <span>{{ $reading['min'] }}</span>
                                </div>

                                <div class="text-right">
                                    <span class="font-medium">Max</span><br>
                                    <span>{{ $reading['max'] }}</span>
                                </div>
                            </div>
                        @endif

                    </div>
                @endforeach

            </div>

        </div>

        {{-- ACTIVE CYCLE --}}
        <div class="bg-white border border-[#356744] rounded-2xl p-5">
            <div class="flex items-center justify-between mb-4">
                <h6 class="font-semibold text-[#356744]">
                    Current Active Cycle
                </h6>

                <a
                    href="{{ url('/admin/cycle-details') }}"
                    class="flex items-center gap-1 text-[#356744] hover:text-[#2b5a3a] transition"
                    title="View Cycle Details"
                >
                    <span class="text-sm font-medium">View Details</span>

                    <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-5 h-5">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
            @if($activeCycle)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                    <div>
                        <p class="text-gray-500">Cycle Code</p>
                        <p class="font-semibold">{{ $activeCycle->cycle_code }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Crop Variety</p>
                        <p class="font-semibold">{{ $activeCycle->crop_variety }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Growth Stage</p>
                        <p class="font-semibold">{{ $activeCycle->growth_stage }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Overall Progress</p>
                        <p class="font-semibold">{{ $activeCycle->overall_progress }}%</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Fruit Progress</p>
                        <p class="font-semibold">{{ $activeCycle->fruit_progress }}%</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Expected Harvest</p>
                        <p class="font-semibold">
                            {{ optional($activeCycle->expected_harvest_date)->format('M d, Y') }}
                        </p>
                    </div>
                </div>
            @else
                <p class="text-sm text-gray-500">No active cycle found.</p>
            @endif
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
            <div class="flex flex-col justify-between w-full h-full bg-white rounded-2xl border border-[#356744] p-4 lg:p-6">

                <div class="flex items-center gap-3 mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>

                    <h6 class="font-semibold text-[#2b6444] text-md">
                        Cycle Details
                    </h6>
                </div>

                <div class="overflow-x-auto overflow-y-visible bg-white rounded-xl border border-gray-300 p-4 relative">
                    <div class="relative overflow-visible">
                        <table class="w-max text-xs border-collapse table-fixed overflow-visible">

                            {{-- HEADER --}}
                            <thead>
                                <tr class="bg-gray-100 text-gray-600">
                                    <th class="text-left px-3 py-2 w-40">Cycle</th>

                                    @php
                                        $timelineStart = $cycleLists->min('planting_date')
                                            ? \Carbon\Carbon::parse($cycleLists->min('planting_date'), 'Asia/Manila')->startOfMonth()
                                            : now('Asia/Manila')->startOfMonth();

                                        $timelineEnd = $cycleLists->max('expected_harvest_date')
                                            ? \Carbon\Carbon::parse($cycleLists->max('expected_harvest_date'), 'Asia/Manila')->endOfMonth()
                                            : now('Asia/Manila')->endOfMonth();

                                        $months = [];
                                        $monthCursor = $timelineStart->copy();

                                        while ($monthCursor <= $timelineEnd) {
                                            $months[] = $monthCursor->copy();
                                            $monthCursor->addMonth();
                                        }

                                        $totalTimelineDays = max(1, $timelineStart->diffInDays($timelineEnd));
                                    @endphp

                                    @foreach($months as $month)
                                        <th class="text-center px-2 py-2 w-28 min-w-[110px]">
                                            {{ $month->format('M Y') }}
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>

                            <tbody>

                            @foreach($cycleLists as $cycle)

                                @php
                                    $tz = 'Asia/Manila';

                                    $start = \Carbon\Carbon::parse($cycle->planting_date, $tz)->startOfDay();

                                    $end = $cycle->expected_harvest_date
                                        ? \Carbon\Carbon::parse($cycle->expected_harvest_date, $tz)->endOfDay()
                                        : now($tz);

                                    $daysInYear = $start->isLeapYear() ? 366 : 365;

                                    // Position based on Jan–Dec timeline
                                    $cycleStart = ($timelineStart->diffInDays($start) / $totalTimelineDays) * 100;
                                    $cycleEnd = ($timelineStart->diffInDays($end) / $totalTimelineDays) * 100;

                                    $cycleWidth = max(1, $cycleEnd - $cycleStart);
                                    $cycleDays = max(1, $start->diffInDays($end));
                                @endphp

                                <tr class="border-t hover:bg-gray-50">

                                    {{-- CYCLE INFO --}}
                                    <td
                                        class="px-3 py-4 font-semibold w-40 align-top bg-white sticky left-0 z-50 border-r cursor-pointer hover:bg-green-50 transition"
                                        wire:click="viewCycleDetails({{ $cycle->id }})"
                                        onclick="$openModal('cycleDetailsModal')"
                                    >
                                        {{ $cycle->cycle_code }}

                                        <div class="text-[10px] text-gray-500">
                                            {{ $cycle->crop_variety }}
                                        </div>

                                        <div class="text-[10px] text-gray-400 mt-1">
                                            {{ $start->format('M d') }} - {{ $end->format('M d') }}
                                        </div>
                                    </td>

                                    {{-- MILESTONES --}}
                                    @php
                                        $milestones = $cycle->milestones->sortBy('scheduled_date')->values();

                                        $milestoneCount = max(1, $milestones->count());
                                        $laneHeight = 28;
                                        $timelineHeight = max(180, ($milestoneCount * $laneHeight) + 90);
                                        $centerLine = $timelineHeight / 2;
                                    @endphp

                                    {{-- TIMELINE --}}
                                    <td colspan="{{ count($months) }}" class="p-0 overflow-visible">

                                        <div
                                            class="relative overflow-visible"
                                            style="
                                                width: {{ max(1, count($months)) * 144 }}px;
                                                height: {{ $timelineHeight }}px;
                                            "
                                        >

                                            {{-- MONTH GRID --}}
                                            <div
                                                class="absolute inset-0 grid z-10"
                                                style="grid-template-columns: repeat({{ count($months) }}, minmax(144px, 1fr));"
                                            >
                                                @foreach($months as $month)
                                                    <div class="border-l border-gray-200"></div>
                                                @endforeach
                                            </div>

                                            {{-- CYCLE RANGE BAR --}}
                                            <div
                                                class="absolute top-1/2 h-full -translate-y-1/2 bg-gray-300"
                                                style="
                                                    left: {{ $cycleStart }}%;
                                                    width: {{ $cycleWidth }}%;
                                                "
                                            ></div>

                                           @foreach($milestones as $index => $milestone)

                                                @php
                                                    $tz = 'Asia/Manila';
                                                    $milestoneScheduled = \Carbon\Carbon::parse($milestone->scheduled_date, $tz)->startOfDay();
                                                    $milestoneCompleted = $milestone->completed_date
                                                        ? \Carbon\Carbon::parse($milestone->completed_date, $tz)->endOfDay()
                                                        : null;

                                                    // Total operational timeline days of the gray bar
                                                    $cycleTotalDays = max(1, $start->diffInDays($end));

                                                    $offsetDays = $timelineStart->diffInDays($milestoneScheduled);
                                                    $position = ($offsetDays / $totalTimelineDays) * 100;
                                                    $position = max(0, min(100, $position));

                                                    // 2. CALCULATE DYNAMIC WIDTH (How long it stretches inside the gray bar)
                                                    if ($milestoneCompleted && $milestone->completed) {
                                                        $milestoneDurationDays = max(1, $milestoneScheduled->diffInDays($milestoneCompleted));
                                                        // What percentage of the gray bar does this milestone take up?
                                                        $widthFraction = $milestoneDurationDays / $cycleTotalDays;
                                                        $milestoneWidth = $widthFraction * $cycleWidth;
                                                    } else {
                                                        // For pending milestones or simple single-day events, use a tiny fixed dot size inside the grid
                                                        $milestoneWidth = null; 
                                                    }

                                                    $top = 45 + ($index * $laneHeight);
                                                    $milestoneDays = $milestoneCompleted ? $milestoneScheduled->diffInDays($milestoneCompleted) : 0;
                                                @endphp

                                                {{-- MILESTONE WRAPPER CONTAINER --}}
                                                <div
                                                    class="absolute group z-10 hover:z-30"
                                                    style="
                                                        left: {{ $position }}%;
                                                        @if($milestoneWidth) width: {{ $milestoneWidth }}%; @endif
                                                        top: {{ $top }}px;
                                                        /* If it has a dynamic width, don't center-translate it; let it grow naturally to the right */
                                                        transform: @if($milestoneWidth) translateY(-50%) @else translate(-50%, -50%) @endif;
                                                    "
                                                >

                                                    <div class="relative flex items-center w-full">

                                                        @if($milestone->completed)

                                                            {{-- COMPLETED MILESTONE BAR (Stretches across its specific calculated width) --}}
                                                            <div class="h-4 rounded-full {{ $milestone->color }} cursor-pointer shadow-sm @if($milestoneWidth) w-full @else w-12 @endif"></div>

                                                            <div class="absolute inset-0 flex items-center justify-center cursor-pointer pointer-events-none">
                                                                <span class="text-[9px] font-semibold text-white px-1 truncate">
                                                                    {{ ucfirst(str_replace('_', ' ', $milestone->type)) }} ({{ $milestoneDays }}d)
                                                                </span>
                                                            </div>

                                                        @else

                                                            {{-- PENDING MILESTONE (Single milestone event node point) --}}
                                                            <div class="w-4 h-4 rounded-full border-2 border-gray-400 bg-white shadow-sm cursor-pointer"></div>

                                                        @endif

                                                        {{-- TOOLTIP --}}
                                                        <div class="absolute left-1/2 top-7 -translate-x-1/2 hidden group-hover:block bg-gray-900 text-white text-xs rounded-lg shadow-xl px-3 py-2 min-w-[220px] whitespace-normal z-50">

                                                            <div class="font-semibold text-sm border-b border-gray-700 pb-1 mb-2">
                                                                {{ $milestone->title }}
                                                            </div>

                                                            <div class="space-y-1">
                                                                <div>
                                                                    <span class="text-gray-400">Type:</span>
                                                                    {{ ucfirst(str_replace('_', ' ', $milestone->type)) }}
                                                                </div>
                                                                <div>
                                                                    <span class="text-gray-400">Scheduled:</span>
                                                                    {{ $milestoneScheduled->format('M d, Y') }}
                                                                </div>
                                                                <div>
                                                                    <span class="text-gray-400">Status:</span>
                                                                    @if($milestone->completed)
                                                                        <span class="text-green-400">Completed</span>
                                                                    @else
                                                                        <span class="text-yellow-400">Ongoing</span>
                                                                    @endif
                                                                </div>
                                                                @if($milestone->completed_date)
                                                                    <div>
                                                                        <span class="text-gray-400">Completed:</span>
                                                                        {{ \Carbon\Carbon::parse($milestone->completed_date)->format('M d, Y') }}
                                                                    </div>
                                                                    <div>
                                                                        <span class="text-gray-400">Duration:</span>
                                                                        {{ $milestoneDays }} days
                                                                    </div>
                                                                @endif
                                                            </div>

                                                            <div class="absolute bottom-full left-1/2 -translate-x-1/2">
                                                                <div class="w-0 h-0
                                                                    border-l-[6px] border-l-transparent
                                                                    border-r-[6px] border-r-transparent
                                                                    border-b-[6px] border-b-gray-900">
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            @endforeach

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                            </tbody>

                        </table>
                    </div>
                    
                </div>
                {{-- MILESTONE LEGEND KEY --}}
                <div class="flex flex-wrap items-center justify-between gap-4 mb-4 p-4 bg-gray-50 rounded-xl border border-gray-200 text-xs text-gray-600 mt-5">
                    <div class="flex flex-wrap items-center gap-x-6 gap-y-2">
                        <div class="font-semibold text-gray-700 uppercase tracking-wider text-[10px] mr-1">
                            Milestone Types:
                        </div>

                        @php
                            // Pulling matching logic explicitly from your CycleMilestone Model structural attributes
                            $types = [
                                'greenhouse_transfer',
                                'pruning',
                                'pollination',
                                'fruit_set',
                                'harvest',
                                'other_event' // Fallback representation for the match 'default' statement
                            ];
                        @endphp

                        @foreach($types as $type)
                            @php
                                // Instantiate a temporary model instance to extract matching dynamic Tailwind classes safely
                                $tempMilestone = new \App\Models\CycleMilestone(['type' => $type]);
                                $colorClass = $tempMilestone->color;
                                
                                // Friendly human label transformation strings
                                $label = $type === 'other_event' 
                                    ? 'General / Other' 
                                    : ucfirst(str_replace('_', ' ', $type));
                            @endphp
                            
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 rounded-full {{ $colorClass }} shadow-sm"></div>
                                <span class="font-medium text-gray-700">{{ $label }}</span>
                            </div>
                        @endforeach
                    </div>

                    {{-- Separated Context Key Node Element --}}
                    <div class="flex items-center gap-4 pl-4 border-l border-gray-300">
                        <div class="flex items-center gap-2">
                            <div class="w-4 h-4 rounded-full border-2 border-gray-400 bg-white shadow-sm"></div>
                            <span class="text-gray-500 italic">Pending Milestone</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="h-4 w-10 rounded-full bg-gray-400 opacity-70"></div>
                            <span class="text-gray-500 italic">Cycle Duration Bar</span>
                        </div>
                    </div>
                </div>
                
                @if($activeCycle)
                    @php
                        // 1. Fetch milestones related to the active cycle
                        $allMilestones = $activeCycle->milestones ?? collect();
                        $totalMilestones = $allMilestones->count();
                        $completedCount = $allMilestones->where('completed', true)->count();
                        
                        // Calculate Milestone Completion Progress Percentage
                        $milestoneProgressPercentage = $totalMilestones > 0 
                            ? round(($completedCount / $totalMilestones) * 100) 
                            : 0;

                        // 2. Find the current/next milestone (The earliest uncompleted one)
                        $nextMilestone = $allMilestones->where('completed', false)->sortBy('scheduled_date')->first();

                        // Fallback calculations variables
                        $hasMilestone = !is_null($nextMilestone);
                        $daysLeft = 0;
                        $isOverdue = false;
                        $isNear = false;
                        $milestoneTargetDate = null;

                        if ($hasMilestone) {
                            $today = \Carbon\Carbon::now()->startOfDay();
                            $milestoneTargetDate = \Carbon\Carbon::parse($nextMilestone->scheduled_date)->startOfDay();
                            
                            // diffInDays with false modifier gives negative integers if target date is in the past
                            $daysLeft = $today->diffInDays($milestoneTargetDate, false);
                            
                            $isOverdue = $daysLeft < 0;
                            $isNear = $daysLeft >= 0 && $daysLeft <= 3; // Customized definition: 3 days window for short tasks
                        }
                    @endphp

                    {{-- <div class="flex flex-col gap-4 mt-3">

                        @if($hasMilestone)
                            <div class="p-3 bg-gray-50 border border-gray-200 rounded-xl">
                                <div class="flex items-center justify-between mb-1">
                                    <p class="text-[10px] uppercase font-semibold tracking-wider text-gray-400">Next Target Milestone</p>
                            
                                    <span class="px-2 py-0.5 text-[10px] rounded-full font-bold
                                        @if($isOverdue)
                                            bg-red-100 text-red-700
                                        @elseif($isNear)
                                            bg-amber-100 text-amber-800
                                        @else
                                            bg-blue-100 text-blue-700
                                        @endif
                                    ">
                                        @if($isOverdue) Overdue @elseif($isNear) Due Soon @else On Track @endif
                                    </span>
                                </div>

                                <div class="flex items-center gap-2 my-1">
                                    <div class="w-2.5 h-2.5 rounded-full {{ $nextMilestone->color }}"></div>
                                    <p class="text-sm font-bold text-gray-800 truncate">
                                        {{ ucfirst(str_replace('_', ' ', $nextMilestone->type )) }}
                                        
                                    </p>
                                </div>

                                <div class="text-xs text-gray-500 mt-1 flex justify-between items-center">
                                    <span>Target: <strong>{{ $milestoneTargetDate->format('M d, Y') }}</strong></span>
                                    <span class="font-medium @if($isOverdue) text-red-600 font-semibold @endif">
                                        @if($isOverdue)
                                            {{ abs($daysLeft) }} {{ Str::plural('day', abs($daysLeft)) }} overdue
                                        @elseif($daysLeft == 0)
                                            Due Today!
                                        @else
                                            {{ $daysLeft }} {{ \Illuminate\Support\Str::plural('day', $daysLeft) }} remaining
                                        @endif
                                    </span>
                                </div>
                            </div>
                        @else
                            <div class="p-3 bg-gray-50 border border-dashed border-gray-300 rounded-xl text-center">
                                <p class="text-xs text-gray-400 italic">No remaining pending milestones found</p>
                            </div>
                        @endif

                        <div class="space-y-3">
                            
                            <div>
                                <div class="flex justify-between text-[11px] text-gray-500 mb-1">
                                    <span>Milestones Cleared</span>
                                    <span class="font-semibold text-gray-700">{{ $completedCount }}/{{ $totalMilestones }} ({{ $milestoneProgressPercentage }}%)</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-1.5">
                                    <div class="bg-blue-600 h-1.5 rounded-full transition-all duration-300"
                                        style="width: {{ $milestoneProgressPercentage }}%">
                                    </div>
                                </div>
                            </div>

                            
                            <div>
                                <div class="flex justify-between text-[11px] text-gray-500 mb-1">
                                    <span>Overall Cycle Progress</span>
                                    <span class="font-semibold text-gray-700">{{ $activeCycle->overall_progress }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-1.5">
                                    <div class="bg-[#417151] h-1.5 rounded-full transition-all duration-300"
                                        style="width: {{ $activeCycle->overall_progress }}%">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div> --}}

                @else
                    <p class="text-xs text-gray-400 italic p-4 text-center">
                        No active cycle set up currently
                    </p>
                @endif

            </div>

            <div class="flex flex-col justify-center w-full h-full bg-white rounded-2xl border border-[#356744] p-4 lg:p-6">
                <div class="flex items-center gap-3 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 7.5-2.25-1.313M21 7.5v2.25m0-2.25-2.25 1.313M3 7.5l2.25-1.313M3 7.5l2.25 1.313M3 7.5v2.25m9 3 2.25-1.313M12 12.75l-2.25-1.313M12 12.75V15m0 6.75 2.25-1.313M12 21.75V19.5m0 2.25-2.25-1.313m0-16.875L12 2.25l2.25 1.313M21 14.25v2.25l-2.25 1.313m-13.5 0L3 16.5v-2.25" />
                    </svg>

                    <h6 class="font-semibold text-[#2b6444] text-md">
                        Sugar Level Testing
                    </h6>
                </div>

                <div class="flex items-start gap-4 mb-5 border border-gray-200 rounded-xl px-4 py-3 bg-gray-50">
    
                    <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="#3b7efd"
                        class="w-8 h-8 flex-shrink-0 mt-0.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                    </svg>

                    <p class="text-xs text-gray-600 leading-relaxed">
                        Sugar level is measured using a handheld refractometer.  
                        Enter the value from the fruit being tested.
                    </p>
                </div>

                <div class="flex flex-col items-start gap-4 mb-5 border border-gray-200 rounded-xl px-4 py-3 bg-gray-50">
                    <h6 class="font-semibold text-[#2b6444] text-md">Latest Reading</h6>

                    @if($activeCycle)
                        @php
                            $brixReading = $latestBrixReading;
                            $brix = $brixReading?->brix_level;
                            $isOptimal = $brix !== null && $brix >= 12 && $brix <= 18;
                        @endphp

                        <div class="flex flex-col gap-1">

                            <div class="flex items-center gap-3">
                                <p class="font-semibold text-green-700 text-lg">
                                    {{ $brix !== null ? number_format($brix, 1) : '--' }} °Bx
                                </p>

                                @if($brix !== null)
                                    <span class="px-2 py-1 text-2xs rounded-full font-semibold
                                        {{ $isOptimal ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }}">
                                        {{ $isOptimal ? 'Optimal' : 'Not Optimal' }}
                                    </span>
                                @endif
                            </div>

                            @if($brixReading)
                                <p class="text-xs text-gray-500">
                                    {{ \Carbon\Carbon::parse($brixReading->reading_at)->format('F d, Y h:i A') }}
                                </p>
                            @endif

                        </div>
                    @else
                        <p class="text-xs text-gray-400 italic">
                            No latest readings
                        </p>
                    @endif
                </div>

                <div class="flex flex-col gap-3 mb-5 border border-gray-200 rounded-xl px-4 py-3 bg-gray-50">

                    <h6 class="font-semibold text-[#2b6444] text-md">
                        Recent Readings
                    </h6>

                    @php
                        $history = $recentBrixReadings;
                    @endphp

                    @if($history->count())
                        <div class="overflow-hidden rounded-lg border border-gray-200 bg-white">

                            <table class="w-full text-xs">
                                <thead class="bg-gray-100 text-gray-600">
                                    <tr>
                                        <th class="px-3 py-2 text-left">Brix</th>
                                        <th class="px-3 py-2 text-left">Date</th>
                                        <th class="px-3 py-2 text-left">Time</th>
                                        <th class="px-3 py-2 text-left">Status</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($history as $brix)
                                        @php
                                            $isOptimal = $brix->brix_level >= 12 && $brix->brix_level <= 18;
                                        @endphp

                                        <tr class="border-t">
                                            <td class="px-3 py-2 font-semibold text-green-700">
                                                {{ number_format($brix->brix_level, 1) }} °Bx
                                            </td>

                                            <td class="px-3 py-2">
                                                {{ \Carbon\Carbon::parse($brix->reading_at)->format('M d, Y') }}
                                            </td>

                                            <td class="px-3 py-2">
                                                {{ \Carbon\Carbon::parse($brix->reading_at)->format('h:i A') }}
                                            </td>

                                            <td class="px-3 py-2">
                                                <span class="px-2 py-1 rounded-full text-2xs font-semibold
                                                    {{ $isOptimal ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }}">
                                                    {{ $isOptimal ? 'Optimal' : 'Low' }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    @else
                        <p class="text-xs text-gray-400 italic">
                            No previous readings
                        </p>
                    @endif

                </div>
                
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            {{-- RECENT HARVESTS --}}
            <div class="bg-white border border-[#356744] rounded-2xl p-5">
                <h6 class="font-semibold text-[#356744] mb-4">Recent Harvest Summary</h6>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="text-left text-xs text-gray-500 uppercase">
                            <tr>
                                <th class="py-3">Cycle</th>
                                <th class="py-3">Variety</th>
                                <th class="py-3">Final Brix</th>
                                <th class="py-3">Yield</th>
                                <th class="py-3">Harvest Date</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">
                            @forelse($recentHarvests as $cycle)
                                <tr>
                                    <td class="py-3 font-medium">{{ $cycle->cycle_code }}</td>
                                    <td class="py-3">{{ $cycle->crop_variety }}</td>
                                    <td class="py-3">{{ number_format($cycle->final_brix ?? 0, 1) }}</td>
                                    <td class="py-3">{{ number_format($cycle->yield_kg ?? 0, 1) }} kg</td>
                                    <td class="py-3">
                                        {{ optional($cycle->actual_harvest_date)->format('M d, Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-4 text-gray-500">
                                        No harvest records yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- NOTIFICATIONS --}}
            <div class="bg-white border border-gray-200 rounded-2xl p-4 shadow-sm">
                <div class="flex items-start justify-between mb-3">
                    <h6 class="font-semibold text-gray-800 text-sm">
                        Recent Notifications
                    </h6>

                    <button
                        type="button"
                        x-data
                        x-on:click="$dispatch('toggle-custom-sidebar')"
                        class="text-[10px] px-3 py-1 rounded-full border border-[#356744] text-[#356744] hover:bg-[#356744] hover:text-white transition"
                    >
                        View All
                    </button>
                </div>

                <div class="divide-y divide-gray-100">
                    @forelse($recentNotifications as $notification)
                        <div class="flex items-center gap-3 py-2">
                            <div class="w-7 h-7 rounded-full flex items-center justify-center
                                {{ $notification->is_read ? 'bg-blue-100 text-blue-600' : 'bg-red-100 text-red-600' }}">
                                @if($notification->is_read)
                                    i
                                @else
                                    !
                                @endif
                            </div>

                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-semibold text-gray-800 truncate">
                                    {{ $notification->message }}
                                </p>

                                <p class="text-[10px] text-gray-400">
                                    {{ $notification->created_at->diffForHumans() }}
                                </p>
                            </div>

                            <p class="text-[9px] text-gray-400 whitespace-nowrap">
                                {{ $notification->created_at->format('h:i A') }}
                            </p>
                        </div>
                    @empty
                        <p class="text-xs text-gray-400 italic py-4">
                            No notifications yet.
                        </p>
                    @endforelse
                </div>

                <button
                    type="button"
                    x-data
                    x-on:click="$dispatch('toggle-custom-sidebar')"
                    class="flex items-center justify-between w-full mt-3 pt-3 border-t text-xs font-semibold text-[#356744]"
                >
                    View all notifications
                    <span>→</span>
                </button>
            </div>
        </div>

    </div>

    <x-modal blur name="cycleDetailsModal" persistent align="center" max-width="6xl">
        <x-card title="Cycle Details">

            @if($selectedCycleDetails)
                <div class="space-y-6">

                    {{-- BASIC INFO --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="p-3 bg-gray-50 rounded-xl">
                            <p class="text-xs text-gray-500">Cycle Code</p>
                            <p class="font-semibold">{{ $selectedCycleDetails->cycle_code }}</p>
                        </div>

                        <div class="p-3 bg-gray-50 rounded-xl">
                            <p class="text-xs text-gray-500">Variety</p>
                            <p class="font-semibold">{{ $selectedCycleDetails->crop_variety }}</p>
                        </div>

                        <div class="p-3 bg-gray-50 rounded-xl">
                            <p class="text-xs text-gray-500">Status</p>
                            <p class="font-semibold capitalize">
                                {{ str_replace('_', ' ', $selectedCycleDetails->status) }}
                            </p>
                        </div>

                        {{-- <div class="p-3 bg-gray-50 rounded-xl">
                            <p class="text-xs text-gray-500">Growth Stage</p>
                            <p class="font-semibold capitalize">
                                {{ str_replace('_', ' ', $selectedCycleDetails->growth_stage) }}
                            </p>
                        </div> --}}
                    </div>

                    {{-- DATES --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="p-3 bg-green-50 rounded-xl">
                            <p class="text-xs text-gray-500">Planting Date</p>
                            <p class="font-semibold">
                                {{ $selectedCycleDetails->planting_date?->format('M d, Y') ?? '--' }}
                            </p>
                        </div>

                        <div class="p-3 bg-yellow-50 rounded-xl">
                            <p class="text-xs text-gray-500">Expected Harvest</p>
                            <p class="font-semibold">
                                {{ $selectedCycleDetails->expected_harvest_date?->format('M d, Y') ?? '--' }}
                            </p>
                        </div>

                        <div class="p-3 bg-red-50 rounded-xl">
                            <p class="text-xs text-gray-500">Actual Harvest</p>
                            <p class="font-semibold">
                                {{ $selectedCycleDetails->actual_harvest_date?->format('M d, Y') ?? '--' }}
                            </p>
                        </div>
                    </div>

                    {{-- BRIX READINGS --}}
                    <div>
                        <h6 class="font-semibold text-[#356744] mb-2">Brix Readings</h6>

                        <div class="overflow-hidden rounded-xl border">
                            <table class="w-full text-xs">
                                <thead class="bg-gray-100 text-gray-600">
                                    <tr>
                                        <th class="px-3 py-2 text-left">Brix Level</th>
                                        <th class="px-3 py-2 text-left">Reading Date</th>
                                        <th class="px-3 py-2 text-left">Remarks</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($selectedCycleDetails->brixReadings as $brix)
                                        <tr class="border-t">
                                            <td class="px-3 py-2 font-semibold text-green-700">
                                                {{ number_format($brix->brix_level, 1) }} °Brix
                                            </td>
                                            <td class="px-3 py-2">
                                                {{ $brix->reading_at?->format('M d, Y h:i A') }}
                                            </td>
                                            <td class="px-3 py-2">
                                                {{ $brix->remarks ?? '--' }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="px-3 py-4 text-center text-gray-400">
                                                No Brix readings found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- HARVESTS --}}
                    <div>
                        <h6 class="font-semibold text-[#356744] mb-2">Harvest Records</h6>

                        <div class="overflow-hidden rounded-xl border">
                            <table class="w-full text-xs">
                                <thead class="bg-gray-100 text-gray-600">
                                    <tr>
                                        <th class="px-3 py-2 text-left">Harvested Melons</th>
                                        <th class="px-3 py-2 text-left">Date Harvested</th>
                                        <th class="px-3 py-2 text-left">Status</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($selectedCycleDetails->harvests as $harvest)
                                        <tr class="border-t">
                                            <td class="px-3 py-2 font-semibold">
                                                {{ number_format($harvest->harvest_count) }}
                                            </td>
                                            <td class="px-3 py-2">
                                                {{ \Carbon\Carbon::parse($harvest->date_harvested)->format('M d, Y') }}
                                            </td>
                                            <td class="px-3 py-2 capitalize">
                                                {{ $harvest->status }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="px-3 py-4 text-center text-gray-400">
                                                No harvest records found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- MILESTONE TIMELINE --}}
                    <div>
                        <h6 class="font-semibold text-[#356744] mb-3">
                            Milestone Timeline
                        </h6>

                        @php
                            $cycle = $selectedCycleDetails;
                            $tz = 'Asia/Manila';

                            $start = \Carbon\Carbon::parse($cycle->planting_date, $tz)->startOfDay();

                            $end = $cycle->actual_harvest_date
                                ? \Carbon\Carbon::parse($cycle->actual_harvest_date, $tz)->endOfDay()
                                : \Carbon\Carbon::parse($cycle->expected_harvest_date, $tz)->endOfDay();

                            $months = [];
                            $monthCursor = $start->copy()->startOfMonth();

                            while ($monthCursor <= $end) {
                                $months[] = $monthCursor->copy();
                                $monthCursor->addMonth();
                            }

                            $totalDays = max(1, $start->diffInDays($end));
                            $milestones = $cycle->milestones->sortBy('scheduled_date')->values();

                            $milestoneCount = max(1, $milestones->count());
                            $laneHeight = 28;
                            $timelineHeight = max(180, ($milestoneCount * $laneHeight) + 90);
                        @endphp

                        <div class="overflow-x-auto overflow-y-visible bg-white rounded-xl border border-gray-300 p-4 relative">
                            <div class="relative overflow-visible">
                                <table class="w-max text-xs border-collapse table-fixed overflow-visible">

                                    <thead>
                                        <tr class="bg-gray-100 text-gray-600">
                                            <th class="text-left px-3 py-2 w-40">
                                                Cycle
                                            </th>

                                            @foreach($months as $month)
                                                <th class="text-center px-2 py-2 w-28 min-w-[110px]">
                                                    {{ $month->format('M Y') }}
                                                </th>
                                            @endforeach
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr class="border-t hover:bg-gray-50">

                                            {{-- CYCLE INFO --}}
                                            <td class="px-3 py-4 font-semibold w-40 align-top bg-white sticky left-0 z-50 border-r">
                                                {{ $cycle->cycle_code }}

                                                <div class="text-[10px] text-gray-500">
                                                    {{ $cycle->crop_variety }}
                                                </div>

                                                <div class="text-[10px] text-gray-400 mt-1">
                                                    {{ $start->format('M d, Y') }} - {{ $end->format('M d, Y') }}
                                                </div>
                                            </td>

                                            {{-- TIMELINE --}}
                                            <td colspan="{{ count($months) }}" class="p-0 overflow-visible">

                                                <div
                                                    class="relative overflow-visible"
                                                    style="
                                                        width: {{ max(1, count($months)) * 144 }}px;
                                                        height: {{ $timelineHeight }}px;
                                                    "
                                                >

                                                    {{-- MONTH GRID --}}
                                                    <div class="absolute inset-0 grid z-10"
                                                        style="grid-template-columns: repeat({{ count($months) }}, minmax(144px, 1fr));">
                                                        @foreach($months as $month)
                                                            <div class="border-l border-gray-200"></div>
                                                        @endforeach
                                                    </div>

                                                    {{-- CYCLE RANGE BAR --}}
                                                    <div
                                                        class="absolute top-1/2 h-full -translate-y-1/2 bg-gray-300"
                                                        style="
                                                            left: 0%;
                                                            width: 100%;
                                                        "
                                                    ></div>

                                                    {{-- MILESTONES --}}
                                                    @foreach($milestones as $index => $milestone)
                                                        @php
                                                            $milestoneScheduled = \Carbon\Carbon::parse($milestone->scheduled_date, $tz)->startOfDay();

                                                            $milestoneCompleted = $milestone->completed_date
                                                                ? \Carbon\Carbon::parse($milestone->completed_date, $tz)->endOfDay()
                                                                : null;

                                                            $offsetDays = max(0, $start->diffInDays($milestoneScheduled));
                                                            $position = ($offsetDays / $totalDays) * 100;
                                                            $position = max(0, min(100, $position));

                                                            if ($milestoneCompleted && $milestone->completed) {
                                                                $milestoneDurationDays = max(1, $milestoneScheduled->diffInDays($milestoneCompleted));
                                                                $milestoneWidth = ($milestoneDurationDays / $totalDays) * 100;
                                                            } else {
                                                                $milestoneWidth = null;
                                                            }

                                                            $top = 45 + ($index * $laneHeight);
                                                            $milestoneDays = $milestoneCompleted
                                                                ? $milestoneScheduled->diffInDays($milestoneCompleted)
                                                                : 0;
                                                        @endphp

                                                        <div
                                                            class="absolute group z-20 hover:z-50"
                                                            style="
                                                                left: {{ $position }}%;
                                                                @if($milestoneWidth) width: {{ $milestoneWidth }}%; @endif
                                                                top: {{ $top }}px;
                                                                transform: @if($milestoneWidth) translateY(-50%) @else translate(-50%, -50%) @endif;
                                                            "
                                                        >
                                                            <div class="relative flex items-center w-full">

                                                                @if($milestone->completed)
                                                                    <div class="h-4 rounded-full {{ $milestone->color }} cursor-pointer shadow-sm @if($milestoneWidth) w-full @else w-12 @endif"></div>

                                                                    <div class="absolute inset-0 flex items-center justify-center cursor-pointer pointer-events-none">
                                                                        <span class="text-[9px] font-semibold text-white px-1 truncate">
                                                                            {{ ucfirst(str_replace('_', ' ', $milestone->type)) }} ({{ $milestoneDays }}d)
                                                                        </span>
                                                                    </div>
                                                                @else
                                                                    <div class="w-4 h-4 rounded-full border-2 border-gray-400 bg-white shadow-sm cursor-pointer"></div>
                                                                @endif

                                                                {{-- TOOLTIP --}}
                                                                <div class="absolute left-1/2 top-7 -translate-x-1/2 hidden group-hover:block bg-gray-900 text-white text-xs rounded-lg shadow-xl px-3 py-2 min-w-[220px] whitespace-normal z-50">
                                                                    <div class="font-semibold text-sm border-b border-gray-700 pb-1 mb-2">
                                                                        {{ $milestone->title }}
                                                                    </div>

                                                                    <div class="space-y-1">
                                                                        <div>
                                                                            <span class="text-gray-400">Type:</span>
                                                                            {{ ucfirst(str_replace('_', ' ', $milestone->type)) }}
                                                                        </div>

                                                                        <div>
                                                                            <span class="text-gray-400">Scheduled:</span>
                                                                            {{ $milestoneScheduled->format('M d, Y') }}
                                                                        </div>

                                                                        <div>
                                                                            <span class="text-gray-400">Status:</span>
                                                                            @if($milestone->completed)
                                                                                <span class="text-green-400">Completed</span>
                                                                            @else
                                                                                <span class="text-yellow-400">Ongoing</span>
                                                                            @endif
                                                                        </div>

                                                                        @if($milestone->completed_date)
                                                                            <div>
                                                                                <span class="text-gray-400">Completed:</span>
                                                                                {{ \Carbon\Carbon::parse($milestone->completed_date)->format('M d, Y') }}
                                                                            </div>

                                                                            <div>
                                                                                <span class="text-gray-400">Duration:</span>
                                                                                {{ $milestoneDays }} days
                                                                            </div>
                                                                        @endif
                                                                    </div>

                                                                    <div class="absolute bottom-full left-1/2 -translate-x-1/2">
                                                                        <div class="w-0 h-0
                                                                            border-l-[6px] border-l-transparent
                                                                            border-r-[6px] border-r-transparent
                                                                            border-b-[6px] border-b-gray-900">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    @endforeach

                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- SENSOR CHART --}}
                    <div>
                        <h6 class="font-semibold text-[#356744] mb-2">
                            Sensor Reading Chart
                        </h6>

                        @if($selectedCycleDetails && $selectedCycleDetails->dailySensorData->isNotEmpty())

                            <div class="overflow-x-auto bg-white rounded-xl border">

                                <div
                                    id="sensorChartWrapper"
                                    class="p-4 h-[350px]"
                                    style="min-width: 3000px;"
                                >
                                    <canvas id="cycleSensorChart"></canvas>
                                </div>

                            </div>

                        @else

                            <div class="border border-dashed border-gray-300 rounded-xl h-[350px] flex flex-col items-center justify-center bg-gray-50">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-14 h-14 text-gray-300 mb-3"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.5"
                                        d="M3 3v18h18M7 14l3-3 3 2 4-5" />
                                </svg>

                                <h3 class="text-lg font-semibold text-gray-600">
                                    No Sensor Readings
                                </h3>

                                <p class="text-sm text-gray-500 mt-1 text-center max-w-sm">
                                    There are no environmental sensor readings recorded for this cycle yet.
                                    Once readings are collected, a trend chart will appear here.
                                </p>

                            </div>

                        @endif
                    </div>

                </div>
            @else
                <p class="text-sm text-gray-400">No cycle selected.</p>
            @endif

            <x-slot name="footer">
                <div class="flex justify-end">
                    <x-button flat label="Close" x-on:click="close" />
                </div>
            </x-slot>

        </x-card>
    </x-modal>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        let cycleSensorChart = null;

        function renderCycleSensorChart(labels, data) {
            const canvas = document.getElementById('cycleSensorChart');

            if (!canvas) return;

            if (cycleSensorChart) {
                cycleSensorChart.destroy();
            }

            cycleSensorChart = new Chart(canvas, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Temperature',
                            data: data.temperature,
                            borderColor: '#FF5722',
                            tension: 0,
                            pointRadius: 2,
                        },
                        {
                            label: 'Humidity',
                            data: data.humidity,
                            borderColor: '#00BCD4',
                            tension: 0,
                            pointRadius: 2,
                        },
                        {
                            label: 'Soil Moisture',
                            data: data.soil_moisture,
                            borderColor: '#4CAF50',
                            tension: 0,
                            pointRadius: 2,
                        },
                        {
                            label: 'Soil Moisture 2',
                            data: data.soil_moisture2,
                            borderColor: '#10B981',
                            tension: 0,
                            pointRadius: 2,
                        },
                        {
                            label: 'Water Level',
                            data: data.water_level,
                            borderColor: '#3B82F6',
                            tension: 0,
                            pointRadius: 2,
                        },
                        {
                            label: 'EC Level',
                            data: data.ec_level,
                            borderColor: '#9C27B0',
                            tension: 0,
                            pointRadius: 2,
                        },
                        {
                            label: 'pH Level',
                            data: data.ph_level,
                            borderColor: '#795548',
                            tension: 0,
                            pointRadius: 2,
                        },
                        {
                            label: 'Nitrogen',
                            data: data.nitrogen,
                            borderColor: '#22C55E',
                            tension: 0,
                            pointRadius: 2,
                        },
                        {
                            label: 'Phosphorus',
                            data: data.phosphorus,
                            borderColor: '#F59E0B',
                            tension: 0,
                            pointRadius: 2,
                        },
                        {
                            label: 'Potassium',
                            data: data.potassium,
                            borderColor: '#EF4444',
                            tension: 0,
                            pointRadius: 2,
                        },
                        {
                            label: 'Nitrogen 2',
                            data: data.nitrogen2,
                            borderColor: '#84CC16',
                            tension: 0,
                            pointRadius: 2,
                        },
                        {
                            label: 'Phosphorus 2',
                            data: data.phosphorus2,
                            borderColor: '#F97316',
                            tension: 0,
                            pointRadius: 2,
                        },
                        {
                            label: 'Potassium 2',
                            data: data.potassium2,
                            borderColor: '#DC2626',
                            tension: 0,
                            pointRadius: 2,
                        },
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    },
                    plugins: {
                        legend: {
                            position: 'bottom',
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    const label = context.dataset.label;
                                    const value = Number(context.parsed.y).toFixed(2);

                                    if (label === 'Temperature') return `${label}: ${value}°C`;
                                    if (['Humidity', 'Soil Moisture', 'Soil Moisture 2', 'Water Level'].includes(label)) {
                                        return `${label}: ${value}%`;
                                    }
                                    if (['Nitrogen', 'Phosphorus', 'Potassium', 'Nitrogen 2', 'Phosphorus 2', 'Potassium 2'].includes(label)) {
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
                                    size: 9
                                }
                            }
                        },
                        y: {
                            beginAtZero: true,
                        }
                    }
                }
            });
        }

        document.addEventListener('livewire:init', () => {
            Livewire.on('cycleDetailsLoaded', (payload) => {
                setTimeout(() => {
                    renderCycleSensorChart(payload[0].labels, payload[0].data);
                }, 300);
            });
        });
    </script>
</div>