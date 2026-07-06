<?php

namespace App\Livewire\Pages;

use App\Exports\SensorReadingsExport;
use App\Models\Activity;
use App\Models\Cycles;
use App\Models\DailySensorData;
use App\Models\SensorDatas;
use App\Models\YieldTracker;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class DailyReport extends Component
{
    public $selectedYear;
    public $selectedMonth;

    public $years = [];
    public $months = [];

    public $chartLabels = [];
    public $chartData = [];

    public $activities = [];

    public $cycleSummary = [];

    public function mount()
    {
        $this->selectedYear = now('Asia/Manila')->year;
        $this->selectedMonth = now('Asia/Manila')->month;

        $this->years = DailySensorData::selectRaw('YEAR(reading_date) as year')
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year')
            ->toArray();

        if (empty($this->years)) {
            $this->years = [now('Asia/Manila')->year];
        }

        $this->months = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December',
        ];

        $this->loadChartData();
    }

    public function updatedSelectedYear()
    {
        $this->loadChartData();
    }

    public function updatedSelectedMonth()
    {
        $this->loadChartData();
    }

    public function loadChartData()
    {
        $data = DailySensorData::query()
            ->selectRaw("
                DATE(reading_date) as reading_day,
                ROUND(AVG(temperature), 2) as temperature,
                ROUND(AVG(humidity), 2) as humidity,
                ROUND(AVG(soil_moisture), 2) as soil_moisture,
                ROUND(AVG(soil_moisture2), 2) as soil_moisture2,
                ROUND(AVG(water_level), 2) as water_level,
                ROUND(AVG(ec_level), 2) as ec_level,
                ROUND(AVG(ph_level), 2) as ph_level,
                ROUND(AVG(nitrogen), 2) as nitrogen,
                ROUND(AVG(phosphorus), 2) as phosphorus,
                ROUND(AVG(potassium), 2) as potassium,
                ROUND(AVG(nitrogen2), 2) as nitrogen2,
                ROUND(AVG(phosphorus2), 2) as phosphorus2,
                ROUND(AVG(potassium2), 2) as potassium2
            ")
            ->whereYear('reading_date', $this->selectedYear)
            ->whereMonth('reading_date', $this->selectedMonth)
            ->groupBy('reading_day')
            ->orderBy('reading_day')
            ->get();

        $this->chartLabels = $data->map(fn ($row) =>
            Carbon::parse($row->reading_day)->format('M d')
        )->toArray();

        $this->chartData = [
            'temperature' => $data->pluck('temperature')->toArray(),
            'humidity' => $data->pluck('humidity')->toArray(),
            'soil_moisture' => $data->pluck('soil_moisture')->toArray(),
            'soil_moisture2' => $data->pluck('soil_moisture2')->toArray(),
            'water_level' => $data->pluck('water_level')->toArray(),
            'ec_level' => $data->pluck('ec_level')->toArray(),
            'ph_level' => $data->pluck('ph_level')->toArray(),
            'nitrogen' => $data->pluck('nitrogen')->toArray(),
            'phosphorus' => $data->pluck('phosphorus')->toArray(),
            'potassium' => $data->pluck('potassium')->toArray(),
            'nitrogen2' => $data->pluck('nitrogen2')->toArray(),
            'phosphorus2' => $data->pluck('phosphorus2')->toArray(),
            'potassium2' => $data->pluck('potassium2')->toArray(),
        ];

        $this->activities = Activity::with('cycle')
            ->whereYear('created_at', $this->selectedYear)
            ->whereMonth('created_at', $this->selectedMonth)
            ->latest()
            ->get();

        $this->cycleSummary = [
            'created' => Cycles::whereYear('created_at', $this->selectedYear)
                ->whereMonth('created_at', $this->selectedMonth)
                ->count(),

            'completed' => Cycles::where('status', 'completed')
                ->whereYear('actual_harvest_date', $this->selectedYear)
                ->whereMonth('actual_harvest_date', $this->selectedMonth)
                ->count(),

            'ongoing' => Cycles::where('status', 'ongoing')->count(),
        ];

        $this->dispatch('monthlyChartUpdated', [
            'labels' => $this->chartLabels,
            'data' => $this->chartData,
        ]);
    }
    
    public function render()
    {
        return view('livewire.pages.daily-report');
    }
}
