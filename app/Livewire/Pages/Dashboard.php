<?php

namespace App\Livewire\Pages;

use App\Models\BrixReading;
use App\Models\CycleMilestone;
use App\Models\Cycles;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $activeCycles = Cycles::where('status', 'ongoing')->count();

        $completedCycles = Cycles::where('status', 'completed')->count();

        $upcomingHarvests = Cycles::whereNull('actual_harvest_date')
            ->whereDate('expected_harvest_date', '>=', now('Asia/Manila'))
            ->count();

        $averageBrix = Cycles::whereNotNull('current_brix')->avg('current_brix');

        $totalYield = Cycles::whereNotNull('yield_kg')->sum('yield_kg');

        $pendingMilestones = CycleMilestone::where('completed', false)->count();

        $activeCycle = Cycles::with('milestones')
            ->where('status', 'ongoing')
            ->latest()
            ->first();

        $cycleLists = Cycles::with('milestones')
            ->where('status', 'ongoing')
            ->get();

        $upcomingMilestones = CycleMilestone::with('cycle')
            ->where('completed', false)
            ->whereDate('scheduled_date', '>=', now('Asia/Manila'))
            ->orderBy('scheduled_date')
            ->limit(5)
            ->get();

        $latestBrixReading = $activeCycle
            ? BrixReading::where('cycle_id', $activeCycle->id)
                ->latest('reading_at')
                ->first()
            : null;

        $recentBrixReadings = BrixReading::with('cycle')
            ->latest('reading_at')
            ->limit(5)
            ->get();

        $recentHarvests = Cycles::whereNotNull('actual_harvest_date')
            ->latest('actual_harvest_date')
            ->limit(5)
            ->get();

        return view('livewire.pages.dashboard', [
            'activeCycles' => $activeCycles,
            'completedCycles' => $completedCycles,
            'upcomingHarvests' => $upcomingHarvests,
            'averageBrix' => $averageBrix,
            'totalYield' => $totalYield,
            'pendingMilestones' => $pendingMilestones,
            'activeCycle' => $activeCycle,
            'upcomingMilestones' => $upcomingMilestones,
            'recentBrixReadings' => $recentBrixReadings,
            'recentHarvests' => $recentHarvests,
            'cycleLists' => $cycleLists,
            'latestBrixReading' => $latestBrixReading,
        ]);
    }
}