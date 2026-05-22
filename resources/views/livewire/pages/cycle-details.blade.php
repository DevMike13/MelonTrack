<div>
    <div class="border-b border-gray-200 dark:border-neutral-700">
        <nav class="-mb-0.5 flex justify-center gap-x-6" aria-label="Tabs" role="tablist" aria-orientation="horizontal">
            
            <button wire:click="setActiveTab('cycle')" type="button" class="{{ $activeTab === 'cycle' ? 'hover:cursor-pointer border-[#02bf61] text-[#02bf61] font-semibold' : 'hover:cursor-pointer border-transparent text-gray-500' }} py-4 px-1 inline-flex items-center gap-x-2 border-b-2 text-sm" id="tabs-with-icons-item-1" aria-selected="true" data-hs-tab="#tabs-with-icons-1" aria-controls="tabs-with-icons-1" role="tab">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                </svg>
                  
                Cycle
            </button>
            <button wire:click="setActiveTab('yield')" type="button" class="{{ $activeTab === 'yield' ? 'hover:cursor-pointer border-[#02bf61] text-[#02bf61] font-semibold' : 'hover:cursor-pointer border-transparent text-gray-500' }} py-4 px-1 inline-flex items-center gap-x-2 border-b-2 text-sm" id="tabs-with-icons-item-1" aria-selected="true" data-hs-tab="#tabs-with-icons-1" aria-controls="tabs-with-icons-1" role="tab">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m7.875 14.25 1.214 1.942a2.25 2.25 0 0 0 1.908 1.058h2.006c.776 0 1.497-.4 1.908-1.058l1.214-1.942M2.41 9h4.636a2.25 2.25 0 0 1 1.872 1.002l.164.246a2.25 2.25 0 0 0 1.872 1.002h2.092a2.25 2.25 0 0 0 1.872-1.002l.164-.246A2.25 2.25 0 0 1 16.954 9h4.636M2.41 9a2.25 2.25 0 0 0-.16.832V12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 12V9.832c0-.287-.055-.57-.16-.832M2.41 9a2.25 2.25 0 0 1 .382-.632l3.285-3.832a2.25 2.25 0 0 1 1.708-.786h8.43c.657 0 1.281.287 1.709.786l3.284 3.832c.163.19.291.404.382.632M4.5 20.25h15A2.25 2.25 0 0 0 21.75 18v-2.625c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125V18a2.25 2.25 0 0 0 2.25 2.25Z" />
                </svg>
                  
                Yield
            </button>
        </nav>
    </div>
      
    <div class="mt-3">
        @if ($activeTab === 'cycle')
            <div class="w-full flex justify-end items-center mb-3">
                <x-button icon="plus-sm" positive label="Create New Cycle" onclick="$openModal('newCycle')" wire:click="getCycleNumber"/>
            </div>
            <div class="flex flex-col">
                <div class="-m-1.5 overflow-x-auto">
                    <div class="p-1.5 min-w-full inline-block align-middle">
                        <div>
                            @if (count($cycleLists) == 0)
                                <h1 class="text-center font-normal text-lg mt-5 italic text-gray-500">No data available.</h1>
                            @else
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Cycle No.</th>
                                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Start Date</th>
                                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">End Date</th>
                                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Trays</th>
                                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Days</th>
                                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Phase</th>
                                            {{-- <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Description</th> --}}
                                            {{-- <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Status</th> --}}
                                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cycleLists as $cycle)
                                            <tr class="odd:bg-white even:bg-gray-100 hover:bg-gray-100 dark:odd:bg-neutral-800 dark:even:bg-neutral-700 dark:hover:bg-neutral-700">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                                    
                                                    @if ($cycle->status == 'current')
                                                        <p class="text-lg font-semibold bg-green-500 w-fit px-2.5 text-white rounded-full">{{$cycle->cycle_no}}</p>
                                                    @else
                                                        <p class="w-fit px-2">{{$cycle->cycle_no}}</p>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">{{\Carbon\Carbon::parse($cycle->start_date)->format('M j, Y')}}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                                    @if ($cycle->end_date == null)
                                                        <div class="flex flex-row items-center gap-0.5 italic">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                                            </svg>
                                                            <p class="text-xs text-gray-500">Ongoing</p>
                                                        </div>
                                                    @else
                                                        {{\Carbon\Carbon::parse($cycle->end_date)->format('M j, Y')}}
                                                    @endif
                                                </td>
                                                {{-- <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">{{$cycle->description}}</td> --}}
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                                    {{ number_format($cycle->trays) }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                                    
                                                    {{-- @php
                                                        $start = \Carbon\Carbon::parse($cycle->start_date);
                                                        $today = \Carbon\Carbon::today();
                                                        
                                                        $diff = $start->diffInDays($today);
                                                        
                                                        if ($diff === 0 || $diff === 1) {
                                                            $daysSinceStart = 1;
                                                        } else {
                                                            $daysSinceStart = $diff; // so day 2 starts on the 3rd calendar day
                                                        }
                                                    
                                                        $cappedDays = min($daysSinceStart, 7);
                                                    @endphp

                                                    {{ $cappedDays }} day(s) --}}

                                                    @php
                                                        $start = \Carbon\Carbon::parse($cycle->start_date);
                                                        $today = \Carbon\Carbon::today();
                                                        $daysSinceStart = $start->diffInDays($today); // no +1, start at Day 0
                                                        $cappedDays = min($daysSinceStart, 7); // cap at 7
                                                    @endphp

                                                    {{ $cappedDays }} day(s)
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200 capitalize">
                                                    @if ($cycle->phase == 'growth phase')
                                                        Growth
                                                    @else
                                                        {{ $cycle->phase }}
                                                    @endif
                                                </td>
                                                {{-- @if ($cycle->status == 'current')
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                                        <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-500 text-white capitalize">{{$cycle->status}}</span>
                                                    </td>
                                                @else
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                                        <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-teal-500 text-white capitalize">{{$cycle->status}}</span>
                                                    </td>
                                                @endif --}}
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                    <div class="hs-dropdown relative inline-flex">
                                                        <button id="hs-dropdown-default" type="button" class="hs-dropdown-toggle py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                                            Actions
                                                            <svg class="hs-dropdown-open:rotate-180 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                                                        </button>
                                                      
                                                        <div class="hs-dropdown-menu z-50 transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full" role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-default">
                                                            <div class="p-1 space-y-0.5">
                                                                @if ($cycle->status == 'current')
                                                                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-blue-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="#" wire:click="getSelectedCycle({{ $cycle->id }})" onclick="$openModal('editCycle')">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                                        </svg>
                                                                        
                                                                        Edit
                                                                    </a>
                                                                @endif
                                                                {{-- @if ($cycle->status == 'current' && $cycle->harvest == null)
                                                                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-green-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="#" wire:click="getSelectedHarvestCycle({{ $cycle->id }})" onclick="$openModal('harvestCycle')">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.05 4.575a1.575 1.575 0 1 0-3.15 0v3m3.15-3v-1.5a1.575 1.575 0 0 1 3.15 0v1.5m-3.15 0 .075 5.925m3.075.75V4.575m0 0a1.575 1.575 0 0 1 3.15 0V15M6.9 7.575a1.575 1.575 0 1 0-3.15 0v8.175a6.75 6.75 0 0 0 6.75 6.75h2.018a5.25 5.25 0 0 0 3.712-1.538l1.732-1.732a5.25 5.25 0 0 0 1.538-3.712l.003-2.024a.668.668 0 0 1 .198-.471 1.575 1.575 0 1 0-2.228-2.228 3.818 3.818 0 0 0-1.12 2.687M6.9 7.575V12m6.27 4.318A4.49 4.49 0 0 1 16.35 15m.002 0h-.002" />
                                                                        </svg>
                                                                        Harvest Now
                                                                    </a>
                                                                @endif --}}
                                                                {{-- @if ($cycle->status != 'current') --}}
                                                                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-red-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="#" wire:click="deleteCycleConfirmation({{ $cycle->id }}, {{ $cycle->cycle_no }})">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                                        </svg>                                                                  
                                                                        Delete
                                                                    </a>
                                                                {{-- @endif --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @elseif($activeTab === 'yield')
            <div class="w-full mt-10 border-2 border-dashed rounded-md py-10 px-5">
                <div class="w-full flex flex-col lg:flex-row justify-start items-center mb-3">
                    @if($hasCycle)
                        <x-button icon="plus-sm" warning label="Add Yield" onclick="$openModal('newYield')" wire:click="getCurrentCycleNumber"/>
                    @else
                        <x-button icon="plus-sm" warning label="Add Yield" wire:click="getCurrentCycleNumberError"/>
                    @endif
                    
                    <div class="ml-auto flex flex-col md:flex-row gap-3 items-center w-full max-w-lg mt-10 lg:mt-0">
                        <div class="flex-1 -mt-6 w-full">
                            <x-native-select
                                label="Select Cycle No."
                                :options="$cycleNoOptions"
                                option-label="name"
                                option-value="id"
                                wire:model.live="selectedCycleNoFilter"
                            />
                        </div>
                    
                        {{-- <div class="flex-1">
                            <x-button class="w-full" label="Apply Filter" wire:click="applyCycleFilter" />
                        </div> --}}
                        <div class="flex-1 w-full">
                            <x-button label="Export Excel" icon="document-download" primary wire:click="exportYieldsExcel"  class="w-full" />
                            {{-- <x-button label="Export CSV" icon="document-download" wire:click="exportYieldsCsv" /> --}}
                        </div>
                    
                        <div class="flex-1 w-full">
                            <x-button class="w-full" icon="chart-square-bar" zinc label="Show Graph" onclick="$openModal('graphModal')" wire:click="getCurrentCycleNumber" />
                        </div>
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="-m-1.5 overflow-x-auto">
                        <div class="p-1.5 min-w-full inline-block align-middle">
                            <div class="border-2 border-dashed rounded-md">
                                @if (count($yieldLists) == 0)
                                    <h1 class="text-center font-normal text-lg my-5 italic text-gray-500">No Yield available.</h1>
                                @else
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Cycle No.</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Tray</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Yield Per Tray</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Date</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($yieldLists as $yield)
                                                <tr class="odd:bg-white even:bg-gray-100 hover:bg-gray-100 dark:odd:bg-neutral-800 dark:even:bg-neutral-700 dark:hover:bg-neutral-700">
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                                        <p class="w-fit px-2">{{$yield->cycle_no}}</p>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                                        <p class="w-fit px-2">{{$yield->tray}}</p>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                                        <p class="w-fit px-2">{{$yield->yield_per_tray}} g</p>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">{{\Carbon\Carbon::parse($yield->date)->format('M j, Y')}}</td>
                                                    
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                        <div class="hs-dropdown relative inline-flex">
                                                            <button id="hs-dropdown-default" type="button" class="hs-dropdown-toggle py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                                                Actions
                                                                <svg class="hs-dropdown-open:rotate-180 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                                                            </button>
                                                        
                                                            <div class="hs-dropdown-menu z-50 transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full" role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-default">
                                                                <div class="p-1 space-y-0.5">
                                                                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-blue-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="#" wire:click="getSelectedCycleYield({{ $yield->id }})" onclick="$openModal('editYield')">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                                        </svg>
                                                                        
                                                                        Edit
                                                                    </a>
                                                                    
                                                                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-red-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="#" wire:click="deleteYieldConfirmation({{ $yield->id }}, {{ $yield->cycle_no }})">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                                        </svg>                                                                  
                                                                        Delete
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    
    
    <x-modal blur name="newCycle" persistent align="center" max-width="sm">
        <x-card title="Create New Cycle">
            
            <div class="relative w-auto">
                <span class="absolute left-[4.5rem] top-[0.10rem] text-xs italic text-green-400">(This will automatically generated)</span>
                <x-input right-icon="hashtag" label="Cycle No." placeholder="Ex: 1"  wire:model="cycleNo" disabled />
            </div>
            
            {{-- <div class="mt-3">
                <x-select
                    label="Select Microgreen Type"
                    placeholder="Select Microgreen Type"
                    wire:model.defer="microgreenType"
                >
                    <x-select.user-option src="https://images.pexels.com/photos/161514/brocoli-vegetables-salad-green-161514.jpeg" label="Broccoli" value="Broccoli" />
                    <x-select.user-option src="https://images.pexels.com/photos/3283450/pexels-photo-3283450.jpeg" label="Cabbage" value="Cabbage" />
                    <x-select.user-option src="https://images.pexels.com/photos/4202257/pexels-photo-4202257.jpeg" label="Chives" value="Chives" />
                    <x-select.user-option src="https://images.pexels.com/photos/143133/pexels-photo-143133.jpeg" label="Carrot" value="Carrot" />
                    <x-select.user-option src="https://images.pexels.com/photos/1391505/pexels-photo-1391505.jpeg" label="Basil" value="Basil" />
                </x-select>
            </div> --}}

            <div class="mt-3">
                <x-datetime-picker
                    label="Start Date"
                    placeholder="Start Date"
                    parse-format="YYYY-MM-DD"
                    display-format="MMMM DD, YYYY"
                    wire:model.defer="startDate"
                    without-tips
                    :min="now()"
                    without-time
                />
            </div>

            {{-- <div class="mt-3">
                <x-datetime-picker
                    label="End Date"
                    placeholder="End Date"
                    parse-format="YYYY-MM-DD"
                    display-format="MMMM DD, YYYY"
                    wire:model.defer="endDate"
                    without-tips
                    :min="now()"
                    without-time
                />
            </div> --}}

            <div class="mt-3">
                <x-inputs.number label="Number of Trays" wire:model="trays" min="1" max="4"/>
            </div>

            <div class="mt-3">
                <x-select
                    label="Select Phase"
                    placeholder="Select one phase"
                    :options="[
                        ['name' => 'Germination',  'id' => 'germination'],
                        ['name' => 'Growth', 'id' => 'growth phase']
                    ]"
                    option-label="name"
                    option-value="id"
                    wire:model.defer="phase"
                />
            </div>
           
            <div class="mt-3">
                <x-textarea label="Notes" placeholder="write cycle notes" wire:model="notes" />
            </div>

            <x-slot name="footer" class="flex justify-end gap-x-4">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button primary label="Save" wire:click="createNewCycle" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>

    <x-modal blur name="editCycle" persistent align="center" max-width="sm">
        <x-card title="Edit Cycle">
            
            <div class="relative w-auto">
                <span class="absolute left-[4.5rem] top-[0.10rem] text-xs italic text-green-400">(This value is not changeable.)</span>
                <x-input right-icon="hashtag" label="Cycle No." placeholder="Ex: 1"  wire:model="editCycleNo" disabled />
            </div>
           
            <div class="mt-3">
                <x-datetime-picker
                    label="Start Date"
                    placeholder="Start Date"
                    parse-format="YYYY-MM-DD"
                    display-format="MMMM DD, YYYY"
                    wire:model.defer="editStartDate"
                    without-tips
                    :min="now()"
                    without-time
                />
            </div>

            {{-- <div class="mt-3">
                <x-datetime-picker
                    label="End Date"
                    placeholder="End Date"
                    parse-format="YYYY-MM-DD"
                    display-format="MMMM DD, YYYY"
                    wire:model.defer="editEndDate"
                    without-tips
                    :min="now()"
                    without-time
                />
            </div> --}}

            <div class="mt-3">
                <x-inputs.number label="Number of Trays" wire:model="editTrays" />
            </div>

            <div class="mt-3">
                <x-select
                    label="Select Phase"
                    placeholder="Select one phase"
                    :options="[
                        ['name' => 'Germination',  'id' => 'germination'],
                        ['name' => 'Growth', 'id' => 'growth phase']
                    ]"
                    option-label="name"
                    option-value="id"
                    wire:model.defer="editPhase"
                />
            </div>
            
            <div class="mt-3">
                <x-textarea label="Notes" placeholder="write cycle notes" wire:model="editNotes" />
            </div>

            <div class="mt-3">
                <x-select
                    label="Select Status"
                    placeholder="Select Status"
                    wire:model.defer="status"
                >
                    <x-select.option label="Current" value="current" />
                    <x-select.option label="Completed" value="completed" />
                </x-select>
            </div>
            
            <x-slot name="footer" class="flex justify-end gap-x-4">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" wire:click="cancelEdit" />
                    <x-button primary label="Save" wire:click="editCycleConfirmation({{ $selectedCycleId }})" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>


    {{-- YIELD --}}
    <x-modal blur name="newYield" persistent align="center" max-width="sm">
        <x-card title="Add Yield">
            <div class="relative w-auto">
                <span class="absolute left-[4.5rem] top-[0.10rem] text-xs italic text-green-400">(This will automatically fetch)</span>
                <x-input right-icon="hashtag" label="Cycle No." placeholder="Ex: 1"  wire:model="currentCycleNoForYield" disabled />
            </div>
            <div class="mt-3">
                <x-inputs.number label="Tray" wire:model="trayYield" />
            </div>
            <div class="relative w-auto mt-3">
                <span class="absolute left-[6.5rem] top-[0.10rem] text-xs italic text-green-400">(Grams)</span>
                <x-inputs.number label="Yield Per Tray" wire:model="yieldPerTrayYield" />
            </div>
            <div class="mt-3">
                <x-datetime-picker
                    label="Date"
                    placeholder="Date"
                    parse-format="YYYY-MM-DD"
                    display-format="MMMM DD, YYYY"
                    wire:model.defer="dateYield"
                    without-tips
                    :min="now()"
                    without-time
                />
            </div>
            <x-slot name="footer" class="flex justify-end gap-x-4">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button primary label="Save" wire:click="saveCycleYield" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>

    <x-modal blur name="editYield" persistent align="center" max-width="sm">
        <x-card title="Edit Yield">
            <div class="relative w-auto">
                <span class="absolute left-[4.5rem] top-[0.10rem] text-xs italic text-green-400">(This will automatically fetch)</span>
                <x-input right-icon="hashtag" label="Cycle No." placeholder="Ex: 1"  wire:model="editCycleNoYield" disabled />
            </div>
            <div class="mt-3">
                <x-inputs.number label="Tray" wire:model="editTrayYield" />
            </div>
            <div class="relative w-auto mt-3">
                <span class="absolute left-[6.5rem] top-[0.10rem] text-xs italic text-green-400">(Grams)</span>
                <x-inputs.number label="Yield Per Tray" wire:model="editYieldPerTrayYield" />
            </div>
            <div class="mt-3">
                <x-datetime-picker
                    label="Date"
                    placeholder="Date"
                    parse-format="YYYY-MM-DD"
                    display-format="MMMM DD, YYYY"
                    wire:model.defer="editDateYield"
                    without-tips
                    :min="now()"
                    without-time
                />
            </div>
            <x-slot name="footer" class="flex justify-end gap-x-4">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" wire:click="cancelEditYield" />
                    <x-button primary label="Save" wire:click="editYieldConfirmation({{ $selectedCycleYieldId }})" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>

    <x-modal blur name="graphModal" persistent align="center" max-width="4xl">
        <x-card title="">
            <canvas id="yieldLineChart" class="w-[800px] h-[500px] "></canvas>
            <x-slot name="footer" class="flex justify-end gap-x-4">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Close" x-on:click="close" wire:click="closeGraphModal" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- <script>
        
        const yieldData = @json($yieldLists);
        
        const labels = yieldData.map(item => {
            const dateObj = new Date(item.date);
            const formattedDate = dateObj.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'short',
                day: 'numeric'
            });
            return `${formattedDate} (Tray ${item.tray})`;
        });
        const yields = yieldData.map(item => item.yield_per_tray);
        
        const ctx = document.getElementById('yieldLineChart').getContext('2d');
        
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Yield Per Tray',
                    data: yields,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: true,
                    tension: 0.3,
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Yield Tracker Over Time'
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Date'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Yield (grams)'
                        },
                        beginAtZero: true
                    }
                }
            }
        });
        Livewire.on('updateChart', (newGraphData) => {
            yieldData = newGraphData;
        });
    </script> --}}
    <script>
        const yieldData = @json($yieldSums);
    
        const labels = yieldData.map(item => `Cycle ${item.cycle_no}`);
        const yields = yieldData.map(item => item.total_yield);
    
        const ctx = document.getElementById('yieldLineChart').getContext('2d');
    
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Yield per Cycle',
                    data: yields,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.4)',
                    fill: true,
                    tension: 0.3,
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' },
                    title: {
                        display: true,
                        text: 'Total Yield per Cycle'
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Cycle No.'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Total Yield (grams)'
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    
    
</div>
