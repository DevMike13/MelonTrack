<div class="relative overflow-hidden bg-white">
    
    <div class="fixed right-0 top-0 h-screen w-[25vw] lg:w-[30vw] xl:w-[35vw] pointer-events-none z-0">
        <div class="h-full w-full bg-[url('../../public/images/melon-right-bg.png')] bg-no-repeat bg-contain bg-right opacity-100"></div>
    </div>

    <div class="relative z-10 bg-transparent w-full">
        <div>
            <div class="w-full flex justify-end items-center mb-3">
                <x-button icon="plus-sm" positive label="Create New Cycle" onclick="$openModal('newCycle')"/>
            </div>
        </div>

        {{-- CYCLE CARD --}}
        <div class="flex flex-col justify-start items-start">
            <h4 class="font-lg font-semibold mb-3">Active Cycle</h4>

            @if($activeCycle)
                <div class="flex flex-col w-full border border-gray-500 rounded-xl overflow-hidden">

                    <div class="w-full grid grid-cols-7 bg-[#e1eeda] p-4">

                        {{-- LEFT: ICON + TITLE --}}
                        <div class="col-span-2">
                            <div class="flex items-center gap-3">
                                <img 
                                    src="{{ asset('images/leaf-icon-soil.png') }}" 
                                    class="w-12 h-12 object-contain bg-[#75bd6f] rounded-full p-2"
                                >
                                <div>
                                    <h6 class="font-semibold text-[#2b6444] text-lg">
                                        {{ $activeCycle->cycle_code }}
                                    </h6>
                                    <span class="inline-flex items-center gap-2 px-2 py-1 rounded-full bg-gray-100 text-xs font-medium text-gray-700">
    
                                        {{-- ping dot --}}
                                        <span class="relative flex h-2 w-2">
                                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75
                                                {{ $activeCycle->status === 'ongoing' ? 'bg-blue-500' : 'bg-gray-400' }}">
                                            </span>
                                            <span class="relative inline-flex rounded-full h-2 w-2
                                                {{ $activeCycle->status === 'ongoing' ? 'bg-blue-600' : 'bg-gray-500' }}">
                                            </span>
                                        </span>

                                        {{ ucfirst(str_replace('_', ' ', $activeCycle->status)) }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="mt-2">
                                <x-button
                                    xs
                                    rounded
                                    info
                                    icon="pencil"
                                    label="Edit"
                                    wire:click="getSelectedCycle({{ $activeCycle->id }})"
                                    onclick="$openModal('editCycle')"
                                />

                                <x-button
                                    xs
                                    rounded
                                    icon="x"
                                    negative
                                    label="Delete"
                                    wire:click="deleteCycleConfirmation({{ $activeCycle->id }}, '{{ $activeCycle->cycle_code }}')"
                                />
                            </div>
                            
                        </div>

                        <div>
                            <p class="text-xs text-gray-600">Variety</p>
                            <p class="font-semibold">{{ $activeCycle->crop_variety }}</p>
                        </div>

                        <div>
                            <p class="text-xs text-gray-600">Planting Date</p>
                            <p class="font-semibold">{{ $activeCycle->planting_date?->format('F d, Y') }}</p>
                        </div>

                        {{-- STAGE --}}
                        <div>
                            <p class="text-xs text-gray-600">Growth Stage</p>
                            <p class="font-semibold capitalize">
                                {{ str_replace('_', ' ', $activeCycle->growth_stage) }}
                            </p>
                        </div>

                        @php
                            $brix = $activeCycle->current_brix;
                            $isOptimal = $brix !== null && $brix >= 12 && $brix <= 18;
                        @endphp

                        @php
                            $maxBrix = 15;
                            $brixValue = $activeCycle->current_brix ?? 0;

                            $percentage = min(100, ($brixValue / $maxBrix) * 100);
                        @endphp
                        {{-- BRIX --}}
                        <div class="col-span-2 flex flex-row justify-between">
                            <div>
                                <p class="text-xs text-gray-600">Brix Level</p>
                                <div class="flex items-center gap-2">
                                    <p class="font-semibold text-green-700 text-lg">
                                        {{ $activeCycle->current_brix !== null 
                                            ? number_format($activeCycle->current_brix, 1) 
                                            : '--' 
                                        }} °Brix
                                    </p>

                                    @if($activeCycle->current_brix)
                                        @php
                                            $isOptimal = $activeCycle->current_brix >= 12 && $activeCycle->current_brix <= 18;
                                        @endphp

                                        <span class="px-2 py-1 text-2xs rounded-full font-semibold
                                            {{ $isOptimal ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }}">
                                            {{ $isOptimal ? 'Optimal' : 'Not Optimal' }}
                                        </span>
                                    @endif

                                    
                                </div>
                            </div>
                            <div class="relative flex items-center justify-center w-16 h-16">
                                <div class="donut"
                                    style="--percent: {{ $percentage }}; --color: {{ $isOptimal ? '#22c55e' : '#699973' }};">
                                </div>

                                <div class="absolute text-[10px] font-semibold text-gray-700">
                                    {{ number_format($percentage, 0) }}%
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- PROGRESS BAR SECTION --}}
                    <div class="p-4 bg-white grid grid-cols-3 gap-4">

                        <div>
                            <p class="text-xs text-gray-500 mb-1">Overall Progress</p>

                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-[#417151] h-2 rounded-full"
                                    style="width: {{ $activeCycle->overall_progress }}%">
                                </div>
                            </div>

                            <div class="mt-2 space-y-1 flex flex-row justify-between items-center">
                                <div>

                                    <p class="text-2xs text-gray-500">Current Timeline</p>
                                    <p class="text-xs font-semibold text-gray-800">
                                        {{ \Carbon\Carbon::parse($activeCycle->planting_date)->format('M d, Y') }}
                                        → Today
                                    </p>
                                </div>

                                <div>
                                    <p class="text-2xs text-gray-500">Expected Milestone</p>
                                    <p class="text-xs font-semibold text-gray-800">
                                        {{ $activeCycle->expected_harvest_date
                                            ? \Carbon\Carbon::parse($activeCycle->expected_harvest_date)->format('M d, Y')
                                            : 'Not set' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <p class="text-xs text-gray-500 mb-1">Fruit Development Stage</p>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-[#417151] h-2 rounded-full"
                                    style="width: {{ $activeCycle->fruit_progress }}%">
                                </div>
                            </div>

                            <div class="mt-2 space-y-1 flex flex-row justify-between items-center">
                                <div>

                                    <p class="text-2xs text-gray-500">Current Timeline</p>
                                    <p class="text-xs font-semibold text-gray-800">
                                        {{ \Carbon\Carbon::parse($activeCycle->planting_date)->format('M d, Y') }}
                                        → Today
                                    </p>
                                </div>

                                <div>
                                    <p class="text-2xs text-gray-500">Expected Milestone</p>
                                    <p class="text-xs font-semibold text-gray-800">
                                        {{ $activeCycle->expected_harvest_date
                                            ? \Carbon\Carbon::parse($activeCycle->expected_harvest_date)->format('M d, Y')
                                            : 'Not set' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <p class="text-xs text-gray-500 mb-1">Record Sugar Level (°Bx)</p>
                            <div class="w-full flex justify-center mt-2">
                                <x-button icon="plus-circle" label="Add New Reading" class="w-full max-w-60" wire:click="openBrixModal({{ $activeCycle->id }}, '{{ $activeCycle->cycle_code }}')" onclick="$openModal('brixModal')" />
                                    <x-button
                                        xs
                                        rounded
                                        warning
                                        icon="flag"
                                        label="Add Milestone"
                                        wire:click="openMilestoneModal({{ $activeCycle->id }})"
                                        onclick="$openModal('milestoneModal')"
                                    />
                            </div>                           
                        </div>

                    </div>

                </div>
            @else
                <div class="p-4 text-gray-500 border border-gray-400 border-dashed w-full rounded-lg py-20">
                    <p class="italic text-center">No active cycle found.</p> 
                </div
            @endif
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 xl:grid-cols-1 gap-5 mb-8 mt-5">
            <div class="flex flex-col justify-between w-full h-full bg-white rounded-2xl border border-[#356744] p-4 lg:p-6">

                <div class="flex items-center gap-3 mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>

                    <h6 class="font-semibold text-[#2b6444] text-md">
                        Upcoming Milestone
                    </h6>
                </div>

                <div class="overflow-x-auto overflow-y-visible bg-white rounded-xl border border-gray-300 p-4 relative">
                    <div class="relative overflow-visible">
                        <table class="min-w-full text-xs border-collapse table-fixed overflow-visible">

                            {{-- HEADER --}}
                            <thead>
                                <tr class="bg-gray-100 text-gray-600">
                                    <th class="text-left px-3 py-2 w-40">Cycle</th>

                                    @foreach(range(1, 12) as $month)
                                        <th class="text-center px-2 py-2 w-28 min-w-[110px]">
                                            {{ \Carbon\Carbon::create()->month($month)->format('M') }}
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
                                    $cycleStart = (($start->dayOfYear - 1) / $daysInYear) * 100;
                                    $cycleEnd = (($end->dayOfYear - 1) / $daysInYear) * 100;

                                    $cycleWidth = max(1, $cycleEnd - $cycleStart);
                                    $cycleDays = max(1, $start->diffInDays($end));
                                @endphp

                                <tr class="border-t hover:bg-gray-50">

                                    {{-- CYCLE INFO --}}
                                    <td class="px-3 py-4 font-semibold w-40 align-top bg-white sticky left-0 z-10 border-r">
                                        {{ $cycle->cycle_code }}

                                        <div class="text-[10px] text-gray-500">
                                            {{ $cycle->crop_variety }}
                                        </div>

                                        <div class="text-[10px] text-gray-400 mt-1">
                                            {{ $start->format('M d') }} - {{ $end->format('M d') }}
                                        </div>
                                    </td>

                                    {{-- TIMELINE --}}
                                    <td colspan="12" class="p-0 overflow-visible">

                                        <div class="relative w-full h-40 overflow-visible">

                                            {{-- MONTH GRID --}}
                                            <div class="absolute inset-0 grid grid-cols-12">
                                                @foreach(range(1, 12) as $m)
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

                                            {{-- MILESTONES --}}
                                            @php
                                                $milestones = $cycle->milestones->sortBy('scheduled_date')->values();
                                            @endphp
                                            @foreach($milestones as $index => $milestone)

                                                @php
                                                    $date = \Carbon\Carbon::parse($milestone->scheduled_date, $tz);

                                                    $daysInYearMilestone = $date->isLeapYear() ? 366 : 365;

                                                    $cycleTotalDays = max(1, $start->diffInDays($end));
                                                    $offsetDays = max(0, $start->diffInDays($date));

                                                    // $position = $cycleStart + (($offsetDays / $cycleTotalDays) * $cycleWidth);
                                                    $position = (($date->dayOfYear - 1) / $daysInYear) * 100;

                                                    $topOffset = -35 + ($index * 20);
                                                @endphp

                                                @php
                                                    $scheduled = \Carbon\Carbon::parse($milestone->scheduled_date, $tz);

                                                    $completed = $milestone->completed_date
                                                        ? \Carbon\Carbon::parse($milestone->completed_date, $tz)
                                                        : null;

                                                    $milestoneDays = $completed
                                                        ? $scheduled->diffInDays($completed)
                                                        : 0; // or 1 if you prefer minimum visible duration
                                                @endphp

                                                <div class="text-xs text-gray-500">
                                                    {{ $milestoneDays }} days
                                                </div>

                                                <div
                                                    class="absolute group z-20"
                                                    style="
                                                        left: {{ $position }}%;
                                                        top: calc(50% + {{ $topOffset }}px);
                                                        transform: translate(-50%, -50%);
                                                    "
                                                >

                                                    <div class="relative flex items-center">

                                                        @if($milestone->completed)

                                                            {{-- COMPLETED MILESTONE --}}
                                                            <div class="h-4 w-12 rounded-full {{ $milestone->color }} cursor-pointer"></div>

                                                            <div class="absolute inset-0 flex items-center justify-center cursor-pointer">
                                                                <span class="text-[9px] font-semibold text-white px-1 truncate">
                                                                    {{ ucfirst(str_replace('_', ' ', $milestone->type)) }}
                                                                </span>
                                                            </div>

                                                        @else

                                                            {{-- PENDING MILESTONE --}}
                                                            <div class="w-4 h-4 rounded-full border-2 border-gray-400 bg-white shadow"></div>

                                                        @endif

                                                        {{-- TOOLTIP --}}
                                                        <div
                                                            class="absolute left-1/2 bottom-7 -translate-x-1/2
                                                                hidden group-hover:block
                                                                bg-gray-900 text-white
                                                                text-xs rounded-lg shadow-xl
                                                                px-3 py-2 min-w-[220px]
                                                                whitespace-normal z-50"
                                                        >

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
                                                                    {{ \Carbon\Carbon::parse($milestone->scheduled_date)->format('M d, Y') }}
                                                                </div>

                                                                <div>
                                                                    <span class="text-gray-400">Status:</span>

                                                                    @if($milestone->completed)
                                                                        <span class="text-green-400">Completed</span>
                                                                    @else
                                                                        <span class="text-yellow-400">Pending</span>
                                                                    @endif
                                                                </div>

                                                                @if($milestone->completed_date)
                                                                    <div>
                                                                        <span class="text-gray-400">Completed Date:</span>
                                                                        {{ \Carbon\Carbon::parse($milestone->completed_date)->format('M d, Y') }}
                                                                    </div>
                                                                @endif

                                                                <div>
                                                                    <span class="text-gray-400">Created:</span>
                                                                    {{ $milestone->created_at?->format('M d, Y h:i A') }}
                                                                </div>

                                                            </div>

                                                            <div class="absolute top-full left-1/2 -translate-x-1/2">
                                                                <div class="w-0 h-0
                                                                    border-l-[6px] border-l-transparent
                                                                    border-r-[6px] border-r-transparent
                                                                    border-t-[6px] border-t-gray-900">
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
                

                @if($activeCycle && $activeCycle->expected_harvest_date)

                    @php
                        $today = \Carbon\Carbon::now();
                        $harvest = \Carbon\Carbon::parse($activeCycle->expected_harvest_date);
                        $daysLeft = $today->diffInDays($harvest, false);

                        $isOverdue = $daysLeft < 0;
                        $isNear = $daysLeft >= 0 && $daysLeft <= 7;
                    @endphp

                    <div class="flex flex-col gap-3 mt-3">

                        <div>
                            <p class="text-xs text-gray-500">Expected Harvest Date</p>
                            <p class="text-lg font-bold text-gray-800">
                                {{ $harvest->format('F d, Y') }}
                            </p>
                        </div>

                        <div class="flex items-center gap-2">
                            <span class="px-2 py-1 text-xs rounded-full font-semibold
                                @if($isOverdue)
                                    bg-red-100 text-red-600
                                @elseif($isNear)
                                    bg-yellow-100 text-yellow-700
                                @else
                                    bg-green-100 text-green-700
                                @endif
                            ">
                                @if($isOverdue)
                                    Overdue
                                @elseif($isNear)
                                    Near Harvest
                                @else
                                    On Track
                                @endif
                            </span>

                            <span class="text-sm text-gray-600">
                                @if($isOverdue)
                                    {{ abs($daysLeft) }} days overdue
                                @else
                                    {{ $daysLeft }} days remaining
                                @endif
                            </span>
                        </div>

                        <div class="mt-2">
                            <p class="text-xs text-gray-500 mb-1">Cycle Progress</p>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-[#417151] h-2 rounded-full"
                                    style="width: {{ $activeCycle->overall_progress }}%">
                                </div>
                            </div>
                        </div>

                    </div>

                @else
                    <p class="text-xs text-gray-400 italic">
                        No upcoming milestone set
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
                            $brixReading = $this->latestBrixReading;
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
                        $history = $this->recentBrixReadings;
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
        {{-- CYCLE TABLE --}}
        {{-- <div class="mt-3">
            <div class="flex flex-col">
                <div class="-m-1.5 overflow-x-auto">
                    <div class="p-1.5 min-w-full inline-block align-middle">
                        <div>
                            @if (count($cycleLists) == 0)
                                <h1 class="text-center font-normal text-lg mt-5 italic text-gray-500">No data available.</h1>
                            @else
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-3 text-left">Cycle Code</th>
                                            <th class="px-4 py-3 text-left">Crop</th>
                                            <th class="px-4 py-3 text-left">Planting Date</th>
                                            <th class="px-4 py-3 text-left">Expected Harvest</th>
                                            <th class="px-4 py-3 text-left">Stage</th>
                                            <th class="px-4 py-3 text-left">Progress</th>
                                            <th class="px-4 py-3 text-left">Brix</th>
                                            <th class="px-4 py-3 text-left">Status</th>
                                            <th class="px-4 py-3 text-left">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse($cycleLists as $cycle)
                                            <tr class="border-b">

                                                <td class="px-4 py-3 font-semibold">
                                                    {{ $cycle->cycle_code }}
                                                </td>

                                                <td class="px-4 py-3">
                                                    {{ $cycle->crop_variety }}
                                                </td>

                                                <td class="px-4 py-3">
                                                    {{ $cycle->planting_date?->format('M d, Y') }}
                                                </td>

                                                <td class="px-4 py-3">
                                                    {{ $cycle->expected_harvest_date?->format('M d, Y') }}
                                                </td>

                                                <td class="px-4 py-3 capitalize">
                                                    {{ str_replace('_',' ', $cycle->growth_stage) }}
                                                </td>

                                                <td class="px-4 py-3">
                                                    {{ $cycle->overall_progress }}%
                                                </td>

                                                <td class="px-4 py-3">
                                                    @if($cycle->current_brix)
                                                        <span class="text-green-600 font-semibold">
                                                            {{ $cycle->current_brix }} °Brix
                                                        </span>
                                                    @else
                                                        <span class="text-gray-400">-</span>
                                                    @endif
                                                </td>

                                                <td class="px-4 py-3">

                                                    @switch($cycle->status)

                                                        @case('planned')
                                                            <span class="px-3 py-1 bg-gray-500 text-white rounded-full text-xs">
                                                                Planned
                                                            </span>
                                                        @break

                                                        @case('ongoing')
                                                            <span class="px-3 py-1 bg-blue-500 text-white rounded-full text-xs">
                                                                Ongoing
                                                            </span>
                                                        @break

                                                        @case('ready_for_harvest')
                                                            <span class="px-3 py-1 bg-yellow-500 text-white rounded-full text-xs">
                                                                Ready for Harvest
                                                            </span>
                                                        @break

                                                        @case('harvested')
                                                            <span class="px-3 py-1 bg-purple-500 text-white rounded-full text-xs">
                                                                Harvested
                                                            </span>
                                                        @break

                                                        @case('completed')
                                                            <span class="px-3 py-1 bg-green-600 text-white rounded-full text-xs">
                                                                Completed
                                                            </span>
                                                        @break

                                                        @case('cancelled')
                                                            <span class="px-3 py-1 bg-red-600 text-white rounded-full text-xs">
                                                                Cancelled
                                                            </span>
                                                        @break

                                                    @endswitch

                                                </td>

                                                <td class="px-4 py-3">

                                                    <div class="flex gap-2">

                                                        <x-button
                                                            xs
                                                            info
                                                            label="Edit"
                                                            wire:click="getSelectedCycle({{ $cycle->id }})"
                                                            onclick="$openModal('editCycle')"
                                                        />

                                                        <x-button
                                                            xs
                                                            negative
                                                            label="Delete"
                                                            wire:click="deleteCycleConfirmation({{ $cycle->id }}, '{{ $cycle->cycle_code }}')"
                                                        />

                                                        <x-button
                                                            xs
                                                            warning
                                                            label="Brix"
                                                            wire:click="openBrixModal({{ $cycle->id }}, '{{ $cycle->cycle_code }}')"
                                                            onclick="$openModal('brixModal')"
                                                        />

                                                    </div>

                                                </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center py-5">
                                                    No cycle records found.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>

    <x-modal blur name="newCycle" persistent align="center" max-width="lg">
        <x-card title="Create New Cycle">
            
            <div class="space-y-4">

                <x-input
                    label="Cycle Code"
                    wire:model.defer="cycleCode"
                    placeholder="CYCLE-001"
                />

                <x-input
                    label="Crop Variety"
                    wire:model.defer="cropVariety"
                />

                <div class="grid grid-cols-2 gap-4">
                    <x-datetime-picker
                        label="Planting Date"
                        without-time
                        wire:model.defer="plantingDate"
                    />

                    <x-datetime-picker
                        label="Expected Harvest Date"
                        without-time
                        wire:model.defer="expectedHarvestDate"
                    />
                </div>
                

                <x-select
                    label="Status"
                    wire:model.defer="status"
                    :options="[
                        ['id'=>'planned','name'=>'Planned'],
                        ['id'=>'ongoing','name'=>'Ongoing'],
                        ['id'=>'ready_for_harvest','name'=>'Ready For Harvest'],
                        ['id'=>'harvested','name'=>'Harvested'],
                        ['id'=>'completed','name'=>'Completed'],
                        ['id'=>'cancelled','name'=>'Cancelled']
                    ]"
                    option-label="name"
                    option-value="id"
                />

                <x-select
                    label="Growth Stage"
                    wire:model.defer="growthStage"
                    :options="[
                        ['id'=>'seedling','name'=>'Seedling'],
                        ['id'=>'transplanting','name'=>'Transplanting'],
                        ['id'=>'vegetative','name'=>'Vegetative'],
                        ['id'=>'flowering','name'=>'Flowering'],
                        ['id'=>'pollination','name'=>'Pollination'],
                        ['id'=>'fruit_set','name'=>'Fruit Set'],
                        ['id'=>'fruit_development','name'=>'Fruit Development'],
                        ['id'=>'ripening','name'=>'Ripening']
                    ]"
                    option-label="name"
                    option-value="id"
                />

                <div class="grid grid-cols-2 gap-4">
                    <x-inputs.number
                        label="Overall Progress"
                        wire:model.defer="overallProgress"
                    />

                    <x-inputs.number
                        label="Fruit Progress"
                        wire:model.defer="fruitProgress"
                    />
                </div>

                <x-textarea
                    label="Notes"
                    wire:model.defer="notes"
                />

            </div>

            <x-slot name="footer" class="flex justify-end gap-x-4">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button primary label="Save" wire:click="createCycle" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>

    <x-modal blur name="editCycle" persistent align="center" max-width="lg">
        <x-card title="Edit Cycle">

            <div class="space-y-4">

                <x-input
                    label="Cycle Code"
                    wire:model.defer="cycleCode"
                    disabled
                />

                <x-input
                    label="Crop Variety"
                    wire:model.defer="cropVariety"
                />

                <div class="grid grid-cols-2 gap-4">
                    <x-datetime-picker
                        label="Planting Date"
                        without-time
                        wire:model.defer="plantingDate"
                    />

                    <x-datetime-picker
                        label="Expected Harvest Date"
                        without-time
                        wire:model.defer="expectedHarvestDate"
                    />
                </div>

                <x-select
                    label="Status"
                    wire:model.defer="status"
                    :options="[
                        ['id'=>'planned','name'=>'Planned'],
                        ['id'=>'ongoing','name'=>'Ongoing'],
                        ['id'=>'ready_for_harvest','name'=>'Ready For Harvest'],
                        ['id'=>'harvested','name'=>'Harvested'],
                        ['id'=>'completed','name'=>'Completed'],
                        ['id'=>'cancelled','name'=>'Cancelled']
                    ]"
                    option-label="name"
                    option-value="id"
                />

                <x-select
                    label="Growth Stage"
                    wire:model.defer="growthStage"
                    :options="[
                        ['id'=>'seedling','name'=>'Seedling'],
                        ['id'=>'transplanting','name'=>'Transplanting'],
                        ['id'=>'vegetative','name'=>'Vegetative'],
                        ['id'=>'flowering','name'=>'Flowering'],
                        ['id'=>'pollination','name'=>'Pollination'],
                        ['id'=>'fruit_set','name'=>'Fruit Set'],
                        ['id'=>'fruit_development','name'=>'Fruit Development'],
                        ['id'=>'ripening','name'=>'Ripening']
                    ]"
                    option-label="name"
                    option-value="id"
                />

                <div class="grid grid-cols-2 gap-4">
                    <x-inputs.number
                        label="Overall Progress"
                        wire:model.defer="overallProgress"
                    />

                    <x-inputs.number
                        label="Fruit Progress"
                        wire:model.defer="fruitProgress"
                    />
                </div>

                <x-inputs.number
                    label="Current Brix"
                    wire:model.defer="currentBrix"
                />

                <div class="p-3 bg-gray-100 rounded">
                    <div class="text-sm text-gray-600">Latest Brix</div>
                    <div class="text-xl font-bold text-green-600">
                        {{ $currentBrix ?? '-' }} °Brix
                    </div>
                </div>

                <x-textarea
                    label="Notes"
                    wire:model.defer="notes"
                />

            </div>

            <x-slot name="footer">
                <div class="flex justify-end gap-3">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button primary label="Update" wire:click="updateCycle" />
                </div>
            </x-slot>

        </x-card>
    </x-modal>
    
    <x-modal blur name="brixModal" persistent align="center" max-width="lg">
        <x-card title="Brix Readings">

            {{-- Add new Brix --}}
            <div class="space-y-3 border-b pb-4 mb-4">

                <x-inputs.number
                    label="Brix Level"
                    wire:model.defer="brixLevel"
                />

                <x-datetime-picker
                    label="Reading Date"
                    wire:model.defer="readingAt"
                />

                <x-textarea
                    label="Remarks"
                    wire:model.defer="remarks"
                />

                <x-button primary label="Add Brix" wire:click="saveBrix" />
            </div>

            {{-- Brix History --}}
            <div class="space-y-2 max-h-64 overflow-y-auto">

                @forelse($brixList ?? [] as $brix)
                    <div class="flex justify-between items-center p-2 border rounded">

                        <div>
                            <div class="font-semibold">
                                {{ $brix->brix_level }} °Brix
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ \Carbon\Carbon::parse($brix->reading_at)->format('M d, Y • h:i A') }}
                            </div>
                        </div>

                        {{-- <div class="flex gap-2">

                            <x-button xs info label="Edit"
                                wire:click="getSelectedBrix({{ $brix->id }})"
                            />

                            <x-button xs negative label="Delete"
                                wire:click="deleteBrixConfirmation({{ $brix->id }})"
                            />
                        </div> --}}

                    </div>
                @empty
                    <p class="text-center text-gray-400">No Brix readings yet.</p>
                @endforelse

            </div>

            <x-slot name="footer">
                <div class="flex justify-end">
                    <x-button flat label="Close" x-on:click="close" />
                </div>
            </x-slot>

        </x-card>
    </x-modal>

    <x-modal blur name="milestoneModal" persistent align="center" max-width="lg">
        <x-card title="Create Cycle Milestone">

            <div class="space-y-4">

                <x-input
                    label="Title"
                    wire:model.defer="milestoneTitle"
                    placeholder="e.g. First Pollination"
                />

                <x-select
                    label="Type"
                    wire:model.defer="milestoneType"
                    :options="[
                        ['id'=>'greenhouse_transfer','name'=>'Greenhouse Transfer'],
                        ['id'=>'pruning','name'=>'Pruning'],
                        ['id'=>'pollination','name'=>'Pollination'],
                        ['id'=>'fruit_set','name'=>'Fruit Set'],
                        ['id'=>'harvest','name'=>'Harvest'],
                        ['id'=>'other','name'=>'Other']
                    ]"
                    option-label="name"
                    option-value="id"
                />

                <x-datetime-picker
                    label="Scheduled Date"
                    wire:model.defer="milestoneDate"
                    without-time
                />

                <x-checkbox
                    label="Mark as Completed"
                    wire:model.live="milestoneCompleted"
                />

                @if($milestoneCompleted)
                    <x-datetime-picker
                        label="Completed Date"
                        wire:model.defer="milestoneCompletedDate"
                        without-time
                    />
                @endif

            </div>

            <x-slot name="footer">
                <div class="flex justify-end gap-3">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button primary label="Save Milestone" wire:click="createMilestone" />
                </div>
            </x-slot>

        </x-card>
    </x-modal>
</div>
