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

                        @php
                            // Fetch loaded milestones collection directly from relationship
                            $cycleMilestones = $activeCycle->milestones;
                            $totalCount = $cycleMilestones->count();
                            $completedCount = $cycleMilestones->where('completed', true)->count();

                            // Dynamically compute progress percentage on the fly
                            $milestoneProgress = $totalCount > 0 
                                ? round(($completedCount / $totalCount) * 100) 
                                : 0;

                            // Find the single next upcoming pending milestone sequentially
                            $uncompletedMilestone = $cycleMilestones->where('completed', false)->first();

                            // Calculate Days left context for display
                            $today = \Carbon\Carbon::now()->startOfDay();
                            $nextMilestoneDate = $uncompletedMilestone ? \Carbon\Carbon::parse($uncompletedMilestone->scheduled_date)->startOfDay() : null;
                            $daysLeft = $nextMilestoneDate ? $today->diffInDays($nextMilestoneDate, false) : null;
                        @endphp

                        {{-- COLUMN 1: TRACKING MILESTONES PROGRESS --}}
                        <div>
                            <div class="flex justify-between items-center mb-1">
                                <p class="text-xs text-gray-500">Milestone Progression</p>
                                <span class="text-[10px] font-bold text-gray-600 bg-gray-100 px-1.5 py-0.5 rounded">
                                    {{ $completedCount }}/{{ $totalCount }} Done
                                </span>
                            </div>

                            <div class="w-full bg-gray-200 rounded-full h-2">
                                {{-- This bar now updates instantly whenever a milestone changes status --}}
                                <div class="bg-blue-600 h-2 rounded-full transition-all duration-300"
                                    style="width: {{ $milestoneProgress }}%">
                                </div>
                            </div>

                            <div class="mt-2 space-y-1 flex flex-row justify-between items-center">
                                <div>
                                    <p class="text-2xs text-gray-500">Current Stage</p>
                                    <p class="text-xs font-semibold text-gray-800 capitalize">
                                        {{ str_replace('_', ' ', $activeCycle->growth_stage ?? 'N/A') }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-2xs text-gray-500">Target Milestone</p>
                                    <p class="text-xs font-semibold text-blue-600 truncate max-w-[120px]">
                                        {{ $uncompletedMilestone ? ucfirst(str_replace('_', ' ', $uncompletedMilestone->type)) : 'All Cleared!' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- COLUMN 2: FIELD/FRUIT PRODUCTION ESTIMATION --}}
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Fruit Development Progress</p>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-[#417151] h-2 rounded-full"
                                    style="width: {{ $activeCycle->fruit_progress ?? 0 }}%">
                                </div>
                            </div>

                            <div class="mt-2 space-y-1 flex flex-row justify-between items-center">
                                <div>
                                    <p class="text-2xs text-gray-500">Planting Timestamp</p>
                                    <p class="text-xs font-semibold text-gray-800">
                                        {{ $activeCycle->planting_date ? $activeCycle->planting_date->format('M d, Y') : 'N/A' }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-2xs text-gray-500">Expected Harvest</p>
                                    <p class="text-xs font-semibold text-gray-800">
                                        {{ $activeCycle->expected_harvest_date ? $activeCycle->expected_harvest_date->format('M d, Y') : 'Not set' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- COLUMN 3: LIVE ACTIONS TRIGGER MODULE --}}
                        <div class="grid grid-cols-2 gap-2 border-l border-gray-100 pl-2">
                            <div class="w-full flex flex-col justify-center items-center text-center">
                                <p class="text-2xs text-gray-400 mb-1.5 font-medium">Record Sugar Level (Bx)</p>
                                <x-button
                                    xs
                                    rounded
                                    icon="plus-circle"
                                    label="Add Brix"
                                    wire:click="openBrixModal({{ $activeCycle->id }}, '{{ $activeCycle->cycle_code }}')"
                                    onclick="$openModal('brixModal')"
                                    class="w-full !text-[11px]"
                                />
                            </div>

                            <div class="w-full flex flex-col justify-center items-center text-center">
                                <p class="text-2xs text-gray-400 mb-1.5 font-medium">
                                    Record Milestone
                                </p>
                                
                                @if($uncompletedMilestone)
                                    <x-button
                                        xs
                                        rounded
                                        primary
                                        icon="check-circle"
                                        label="Complete Latest"
                                        wire:click="editMilestone({{ $uncompletedMilestone->id }})"
                                        onclick="$openModal('editMilestoneModal')"
                                        class="w-full !text-[11px]"
                                    />
                                @else
                                    <x-button
                                        xs
                                        rounded
                                        warning
                                        icon="flag"
                                        label="New Milestone"
                                        wire:click="openMilestoneModal({{ $activeCycle->id }})"
                                        onclick="$openModal('createMilestoneModal')"
                                        class="w-full !text-[11px]"
                                    />
                                @endif
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
                        <table class="w-max text-xs border-collapse table-fixed overflow-visible">

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
                                    <td colspan="12" class="p-0 overflow-visible">

                                        <div
                                            class="relative w-[1728px] overflow-visible"
                                            style="height: {{ $timelineHeight }}px;"
                                        >

                                            {{-- MONTH GRID --}}
                                            <div class="absolute inset-0 grid grid-cols-12 z-10">
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

                                            
                                           @foreach($milestones as $index => $milestone)

                                                @php
                                                    $tz = 'Asia/Manila';
                                                    $milestoneScheduled = \Carbon\Carbon::parse($milestone->scheduled_date, $tz)->startOfDay();
                                                    $milestoneCompleted = $milestone->completed_date
                                                        ? \Carbon\Carbon::parse($milestone->completed_date, $tz)->endOfDay()
                                                        : null;

                                                    // Total operational timeline days of the gray bar
                                                    $cycleTotalDays = max(1, $start->diffInDays($end));

                                                    // 1. CALCULATE POSITION (Where it starts inside the gray bar)
                                                    $offsetDays = max(0, $start->diffInDays($milestoneScheduled));
                                                    $positionFraction = $offsetDays / $cycleTotalDays;
                                                    $position = $cycleStart + ($positionFraction * $cycleWidth);
                                                    $position = max(0, min(100, $position)); // Safety bounds

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

                    <div class="flex flex-col gap-4 mt-3">

                        {{-- MILESTONE METRIC CARD CONTAINER --}}
                        @if($hasMilestone)
                            <div class="p-3 bg-gray-50 border border-gray-200 rounded-xl">
                                <div class="flex items-center justify-between mb-1">
                                    <p class="text-[10px] uppercase font-semibold tracking-wider text-gray-400">Next Target Milestone</p>
                                    
                                    {{-- Status Pill --}}
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

                                {{-- Milestone Name & Color Dot --}}
                                <div class="flex items-center gap-2 my-1">
                                    <div class="w-2.5 h-2.5 rounded-full {{ $nextMilestone->color }}"></div>
                                    <p class="text-sm font-bold text-gray-800 truncate">
                                        {{ ucfirst(str_replace('_', ' ', $nextMilestone->type )) }}
                                        
                                    </p>
                                </div>

                                {{-- Timeline Tracking Text --}}
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

                        {{-- PROGRESS TRACKERS SECTION --}}
                        <div class="space-y-3">
                            {{-- 1. Milestone Task Count Bar --}}
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

                            {{-- 2. Master Cycle Overall Linear Estimation Bar --}}
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

                    </div>

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

    <x-modal blur name="createMilestoneModal" persistent align="center" max-width="lg">
        <x-card title="Create Cycle Milestone">

            <div class="space-y-4" x-data="{ isNewCompleted: @entangle('newMilestoneCompleted') }">

                {{-- <x-input
                    label="Title"
                    wire:model.defer="newMilestoneTitle"
                    placeholder="e.g. First Pollination"
                /> --}}
                <x-input
                    label="Title"
                    readonly
                    wire:model="newMilestoneTitle"
                />

                <x-select
                    label="Type"
                    wire:model.live="newMilestoneType"
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
                    wire:model.defer="newMilestoneScheduledDate"
                    without-time
                />

                <div wire:key="new-checkbox-container">
                    <x-checkbox
                        id="create_milestone_completed_checkbox"
                        label="Mark as Completed"
                        x-model="isNewCompleted"
                    />
                </div>

                <div wire:key="new-datepicker-container" x-show="isNewCompleted" x-cloak>
                    <x-datetime-picker
                        label="Completed Date"
                        wire:model.defer="newMilestoneCompletedDate"
                        without-time
                    />
                </div>

                @if($newMilestoneType === 'harvest' && $newMilestoneCompleted)
                    <x-inputs.number
                        label="Total Harvested Melons"
                        wire:model.defer="harvestCount"
                        min="1"
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

    <x-modal blur name="editMilestoneModal" persistent align="center" max-width="lg">
        <x-card title="Update / Complete Milestone">

            <div class="space-y-4">
                <x-input
                    label="Title"
                    readonly
                    wire:model.defer="editMilestoneTitle"
                    placeholder="e.g. First Pollination"
                />

                <x-select
                    label="Type"
                    wire:model.live="editMilestoneType"
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
                    wire:model.defer="editMilestoneDate"
                    without-time
                />

               
                <x-checkbox
                    id="edit_milestone_completed_checkbox"
                    label="Mark as Completed"
                    wire:model.live="editMilestoneCompleted"
                />
                

                @if($editMilestoneCompleted)
                    <x-datetime-picker
                        label="Completed Date"
                        wire:model.defer="editMilestoneCompletedDate"
                        without-time
                    />
                @endif

                @if($editMilestoneType === 'harvest' && $editMilestoneCompleted)
                    <x-inputs.number
                        label="Total Harvested Melons"
                        wire:model.defer="editHarvestCount"
                        min="1"
                    />
                @endif
                
            </div>

            <x-slot name="footer">
                <div class="flex justify-end gap-3">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button success label="Update Milestone" wire:click="updateMilestone" x-on:click="close" />
                </div>
            </x-slot>

        </x-card>
    </x-modal>

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
                                    if (label === 'Humidity' || label === 'Soil Moisture') return `${label}: ${value}%`;
                                    if (['Nitrogen', 'Phosphorus', 'Potassium'].includes(label)) return `${label}: ${value} ppm`;

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
