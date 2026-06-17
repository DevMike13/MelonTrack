<div class="relative overflow-hidden">

    <div class="fixed right-0 top-0 h-screen w-[35%] pointer-events-none z-0">
        <div class="h-full w-full bg-[url('../../public/images/melon-right-bg.png')] bg-no-repeat bg-cover bg-right opacity-100"></div>
    </div>

    <div class="relative z-10 space-y-6">

        {{-- SUMMARY CARDS --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-5">

            <div class="bg-white border border-[#356744] rounded-2xl p-5">
                <p class="text-xs text-gray-500">Active Cycles</p>
                <h3 class="text-2xl font-semibold text-[#356744]">{{ $activeCycles }}</h3>
            </div>

            <div class="bg-white border border-gray-200 rounded-2xl p-5">
                <p class="text-xs text-gray-500">Completed Cycles</p>
                <h3 class="text-2xl font-semibold">{{ $completedCycles }}</h3>
            </div>

            <div class="bg-white border border-gray-200 rounded-2xl p-5">
                <p class="text-xs text-gray-500">Upcoming Harvests</p>
                <h3 class="text-2xl font-semibold">{{ $upcomingHarvests }}</h3>
            </div>

            <div class="bg-white border border-gray-200 rounded-2xl p-5">
                <p class="text-xs text-gray-500">Average Brix</p>
                <h3 class="text-2xl font-semibold">
                    {{ number_format($averageBrix ?? 0, 1) }}
                </h3>
            </div>

            <div class="bg-white border border-gray-200 rounded-2xl p-5">
                <p class="text-xs text-gray-500">Total Yield</p>
                <h3 class="text-2xl font-semibold">
                    {{ number_format($totalYield ?? 0, 1) }} kg
                </h3>
            </div>

            <div class="bg-white border border-gray-200 rounded-2xl p-5">
                <p class="text-xs text-gray-500">Pending Milestones</p>
                <h3 class="text-2xl font-semibold">{{ $pendingMilestones }}</h3>
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
                                    <td class="px-3 py-4 font-semibold w-40 align-top bg-transparent sticky left-0 z-50 border-r">
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

                                        <div class="relative w-[1728px] h-40 overflow-visible">

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

                                            {{-- MILESTONES --}}
                                            @php
                                                $milestones = $cycle->milestones->sortBy('scheduled_date')->values();
                                            @endphp
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

                                                    $topOffset = -35 + ($index * 20);
                                                    $milestoneDays = $milestoneCompleted ? $milestoneScheduled->diffInDays($milestoneCompleted) : 0;
                                                @endphp

                                                {{-- MILESTONE WRAPPER CONTAINER --}}
                                                <div
                                                    class="absolute group z-10 hover:z-30"
                                                    style="
                                                        left: {{ $position }}%;
                                                        @if($milestoneWidth) width: {{ $milestoneWidth }}%; @endif
                                                        top: calc(50% + {{ $topOffset }}px);
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

    </div>
</div>