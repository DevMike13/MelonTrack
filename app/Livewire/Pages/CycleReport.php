<?php

namespace App\Livewire\Pages;

use App\Models\Harvests;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\Component;

class CycleReport extends Component
{
    #[Url()]
    public $selectedYear;
    public $cycleData = [];
    public $years = [];

    public function mount()
    {
        $this->loadYears();
        // $this->selectedYear = now()->year; // Default to current year
        $this->getHarvestCountDataForYear($this->selectedYear ?: now()->year); // Load initial data
    }

    public function loadYears()
    {
        $this->years = collect(DB::table('harvests')->select(DB::raw('YEAR(date_harvested) as year'))->distinct()->get())
            ->map(function ($year) {
                return ['name' => $year->year, 'id' => $year->year];
            })->toArray();
    }

    public function getHarvestCountDataForYear($year)
    {
        // Validate the year parameter
        if (!is_numeric($year) || $year < 2000) {
            // You can handle this error as needed
            $this->cycleData = [];
            return;
        }

        // Get the harvest count for each cycle in the specified year
        $harvestData = Harvests::selectRaw('cycles.cycle_no as CycleNo, SUM(harvests.harvest_count) as HarvestCount')
            ->join('cycles', 'harvests.cycle_id', '=', 'cycles.id')
            ->whereYear('date_harvested', $year) // Filter by the selected year
            ->groupBy('cycles.cycle_no')
            ->orderBy('cycles.cycle_no') // Order by cycle number
            ->get();

        // Format the data for use in your view or chart
        $this->cycleData = $harvestData->map(function ($item) {
            return [
                'CycleNo' => 'Cycle ' . $item->CycleNo, // Cycle number
                'Value' => $item->HarvestCount, // Total harvest count for that cycle
            ];
        })->toArray();
    }

    public function updatedSelectedYear($value)
    {
        // Fetch new cycle data based on the selected year
        $this->getHarvestCountDataForYear($value);
        $this->dispatch('refreshChart', ['cycleData' => json_encode($this->cycleData)]);
        $this->dispatch('reload');
    }

    public function render()
    {
        return view('livewire.pages.cycle-report');
    }
}
