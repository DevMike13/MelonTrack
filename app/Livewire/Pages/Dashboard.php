<?php

namespace App\Livewire\Pages;

use App\Models\BrixReading;
use App\Models\CycleMilestone;
use App\Models\Cycles;
use App\Models\Harvests;
use App\Models\Notifications;
use Kreait\Firebase\Database;
use Livewire\Component;

class Dashboard extends Component
{
     
    protected Database $database;

    public $tempratureReading;
    public $tempratureMinReading;
    public $tempratureMaxReading;
    
    public $humidityReading;
    public $humidityMinReading;
    public $humidityMaxReading;
    
    public $soilMoistureReading;
    public $soilMoistureMinReading;
    public $soilMoistureMaxReading;
    
    public $ecLevelReading;
    public $ecLevelMinReading;
    public $ecLevelMaxReading;
    
    public $pHLevelReading;
    public $pHLevelMinReading;
    public $pHLevelMaxReading;

    public $nitrogenReading;
    public $nitrogenMinReading;
    public $nitrogenMaxReading;

    public $phosphorusReading;
    public $phosphorusMinReading;
    public $phosphorusMaxReading;

    public $potassiumReading;
    public $potassiumMinReading;
    public $potassiumMaxReading;

    public $chartLabels = [];
    public $chartData = [];

    public $customStartDate;
    public $customEndDate;
    public $maxDateTime;
    public string $chartDateRange = '';

    public $selectedCycleDetails;
    

    protected $listeners = [
        'updateTemperature' => 'handleTemperatureUpdate',
        'updateMinTemperature' => 'handleMinTemperatureUpdate',
        'updateMaxTemperature' => 'handleMaxTemperatureUpdate',


        'updateHumidity' => 'handleHumidityUpdate',
        'updateMinHumidity' => 'handleMinHumidityUpdate',
        'updateMaxHumidity' => 'handleMaxHumidityUpdate',


        'updateSoilMoisture' => 'handleSoilMoistureUpdate',
        'updateMinSoilMoisture' => 'handleMinSoilMoistureUpdate',
        'updateMaxSoilMoisture' => 'handleMaxSoilMoistureUpdate',


        'updateECLevel' => 'handleECLevelUpdate',
        'updateMinECLevel' => 'handleMinECLevelUpdate',
        'updateMaxECLevel' => 'handleMaxECLevelUpdate',

        'updatepHLevel' => 'handlepHLevelUpdate',
        'updateMinpHLevel' => 'handleMinpHLevelUpdate',
        'updateMaxpHLevel' => 'handleMaxpHLevelUpdate',

        'updateNitrogen' => 'handleNitrogenUpdate',
        'updateMinNitrogen' => 'handleMinNitrogenUpdate',
        'updateMaxNitrogen' => 'handleMaxNitrogenUpdate',

        'updatePhosphorus' => 'handlePhosphorusUpdate',
        'updateMinPhosphorus' => 'handleMinPhosphorusUpdate',
        'updateMaxPhosphorus' => 'handleMaxPhosphorusUpdate',

        'updatePotassium' => 'handlePotassiumUpdate',
        'updateMinPotassium' => 'handleMinPotassiumUpdate',
        'updateMaxPotassium' => 'handleMaxPotassiumUpdate',
    ];


    public function fetchData()
    {
        try {
            // Temperature
            $referenceTemperature = $this->database->getReference('Temperature/SensorValue');  
            $snapshotTemperature = $referenceTemperature->getSnapshot();
            $this->tempratureReading = $snapshotTemperature->getValue();
            // Min Temperature
            $referenceMinTemperature = $this->database->getReference('Temperature/Min');  
            $snapshotMinTemperature = $referenceMinTemperature->getSnapshot();
            $this->tempratureMinReading = $snapshotMinTemperature->getValue();
             // Max Temperature
            $referenceMaxTemperature = $this->database->getReference('Temperature/Max');  
            $snapshotMaxTemperature = $referenceMaxTemperature->getSnapshot();
            $this->tempratureMaxReading = $snapshotMaxTemperature->getValue();


            // Humidity
            $referenceHumidity = $this->database->getReference('Humidity/SensorValue');  
            $snapshotHumidity = $referenceHumidity->getSnapshot();
            $this->humidityReading = $snapshotHumidity->getValue();
            // Min Humidity
            $referenceMinHumidity = $this->database->getReference('Humidity/Min');  
            $snapshotMinHumidity = $referenceMinHumidity->getSnapshot();
            $this->humidityMinReading = $snapshotMinHumidity->getValue();
            // Max Humidity
            $referenceMaxHumidity = $this->database->getReference('Humidity/Max');  
            $snapshotMaxHumidity = $referenceMaxHumidity->getSnapshot();
            $this->humidityMaxReading = $snapshotMaxHumidity->getValue();
            

             // Soil Moisture
            $referenceSoilMoisture = $this->database->getReference('SoilMoisture/SensorValue');  
            $snapshotSoilMoisture = $referenceSoilMoisture->getSnapshot();
            $this->soilMoistureReading = $snapshotSoilMoisture->getValue();
            // Min Soil Moisture
            $referenceMinSoilMoisture = $this->database->getReference('SoilMoisture/Min');  
            $snapshotMinSoilMoisture = $referenceMinSoilMoisture->getSnapshot();
            $this->soilMoistureMinReading = $snapshotMinSoilMoisture->getValue();
            // Max Soil Moisture
            $referenceMaxSoilMoisture = $this->database->getReference('SoilMoisture/Max');  
            $snapshotMaxSoilMoisture = $referenceMaxSoilMoisture->getSnapshot();
            $this->soilMoistureMaxReading = $snapshotMaxSoilMoisture->getValue();


            // EC Level
            $referenceECLevel = $this->database->getReference('ECLevel/SensorValue');  
            $snapshotECLevel = $referenceECLevel->getSnapshot();
            $this->ecLevelReading = $snapshotECLevel->getValue();
            // Min EC Level
            $referenceMinECLevel = $this->database->getReference('ECLevel/Min');  
            $snapshotMinECLevel = $referenceMinECLevel->getSnapshot();
            $this->ecLevelMinReading = $snapshotMinECLevel->getValue();
            // Max EC Level
            $referenceMaxECLevel = $this->database->getReference('ECLevel/Max');  
            $snapshotMaxECLevel = $referenceMaxECLevel->getSnapshot();
            $this->ecLevelMaxReading = $snapshotMaxECLevel->getValue();

            // pH Level
            $referencepHLevel = $this->database->getReference('pHLevel/SensorValue');  
            $snapshotpHLevel = $referencepHLevel->getSnapshot();
            $this->pHLevelReading = $snapshotpHLevel->getValue();
            // Min pH Level
            $referenceMinpHLevel = $this->database->getReference('pHLevel/Min');  
            $snapshotMinpHLevel = $referenceMinpHLevel->getSnapshot();
            $this->pHLevelMinReading = $snapshotMinpHLevel->getValue();
            // Max pH Level
            $referenceMaxpHLevel = $this->database->getReference('pHLevel/Max');  
            $snapshotMaxpHLevel = $referenceMaxpHLevel->getSnapshot();
            $this->pHLevelMaxReading = $snapshotMaxpHLevel->getValue();

            // Nitrogen
            $referenceNitrogen = $this->database->getReference('Nitrogen/SensorValue');  
            $snapshotNitrogen = $referenceNitrogen->getSnapshot();
            $this->nitrogenReading = $snapshotNitrogen->getValue();
            // Min Nitrogen
            $referenceMinNitrogen = $this->database->getReference('Nitrogen/Min');  
            $snapshotMinNitrogen = $referenceMinNitrogen->getSnapshot();
            $this->nitrogenMinReading = $snapshotMinNitrogen->getValue();
            // Max Nitrogen
            $referenceMaxNitrogen = $this->database->getReference('Nitrogen/Max');  
            $snapshotMaxNitrogen = $referenceMaxNitrogen->getSnapshot();
            $this->nitrogenMaxReading = $snapshotMaxNitrogen->getValue();

            // Phosphorus
            $referencePhosphorus = $this->database->getReference('Phosphorus/SensorValue');  
            $snapshotPhosphorus = $referencePhosphorus->getSnapshot();
            $this->phosphorusReading = $snapshotPhosphorus->getValue();
            // Min Phosphorus
            $referenceMinPhosphorus = $this->database->getReference('Phosphorus/Min');  
            $snapshotMinPhosphorus = $referenceMinPhosphorus->getSnapshot();
            $this->phosphorusMinReading = $snapshotMinPhosphorus->getValue();
            // Max Phosphorus
            $referenceMaxPhosphorus = $this->database->getReference('Phosphorus/Max');  
            $snapshotMaxPhosphorus = $referenceMaxPhosphorus->getSnapshot();
            $this->phosphorusMaxReading = $snapshotMaxPhosphorus->getValue();

            // Potassium
            $referencePotassium = $this->database->getReference('Potassium/SensorValue');  
            $snapshotPotassium = $referencePotassium->getSnapshot();
            $this->potassiumReading = $snapshotPotassium->getValue();
            // Min Potassium
            $referenceMinPotassium = $this->database->getReference('Potassium/Min');  
            $snapshotMinPotassium = $referenceMinPotassium->getSnapshot();
            $this->potassiumMinReading = $snapshotMinPotassium->getValue();
            // Max Potassium
            $referenceMaxPotassium = $this->database->getReference('Potassium/Max');  
            $snapshotMaxPotassium = $referenceMaxPotassium->getSnapshot();
            $this->potassiumMaxReading = $snapshotMaxPotassium->getValue();


        } catch (\Exception $e) {
            $this->tempratureReading = 'Error: ' . $e->getMessage();
        }
    }

    public function handleTemperatureUpdate($temperature)
    {
        $this->tempratureReading = $temperature;
    }
    public function handleMinTemperatureUpdate($minTemperature)
    {
        $this->tempratureMinReading = $minTemperature;
    }
    public function handleMaxTemperatureUpdate($maxTemperature)
    {
        $this->tempratureMaxReading = $maxTemperature;
    }

    public function handleHumidityUpdate($humidity)
    {
        $this->humidityReading = $humidity;
    }
    public function handleMinHumidityUpdate($minHumidity)
    {
        $this->humidityMinReading = $minHumidity;
    }
    public function handleMaxHumidityUpdate($maxHumidity)
    {
        $this->humidityMaxReading = $maxHumidity;
    }

    public function handleSoilMoistureUpdate($soilMoisture)
    {
        $this->soilMoistureReading = $soilMoisture;
    }
    public function handleMinSoilMoistureUpdate($minSoilMoisture)
    {
        $this->soilMoistureMinReading = $minSoilMoisture;
    }
    public function handleMaxSoilMoistureUpdate($maxSoilMoisture)
    {
        $this->soilMoistureMaxReading = $maxSoilMoisture;
    }

    public function handleECLevelUpdate($ecLevel)
    {
        $this->ecLevelReading = $ecLevel;
    }
    public function handleMinECLevelUpdate($minECLevel)
    {
        $this->ecLevelMinReading = $minECLevel;
    }
    public function handleMaxECLevelUpdate($maxECLevel)
    {
        $this->ecLevelMaxReading = $maxECLevel;
    }

    public function handlepHLevelUpdate($pHLevel)
    {
        $this->pHLevelReading = $pHLevel;
    }
    public function handleMinpHLevelUpdate($minpHLevel)
    {
        $this->pHLevelMinReading = $minpHLevel;
    }
    public function handleMaxpHLevelUpdate($maxpHLevel)
    {
        $this->pHLevelMaxReading = $maxpHLevel;
    }

    public function handleNitrogenUpdate($nitrogen)
    {
        $this->nitrogenReading = $nitrogen;
    }
    public function handleMinNitrogenUpdate($minNitrogen)
    {
        $this->nitrogenMinReading = $minNitrogen;
    }
    public function handleMaxNitrogenUpdate($maxNitrogen)
    {
        $this->nitrogenMaxReading = $maxNitrogen;
    }

    public function handlePhosphorusUpdate($phosphorus)
    {
        $this->phosphorusReading = $phosphorus;
    }
    public function handleMinPhosphorusUpdate($minPhosphorus)
    {
        $this->phosphorusMinReading = $minPhosphorus;
    }
    public function handleMaxPhosphorusUpdate($maxPhosphorus)
    {
        $this->phosphorusMaxReading = $maxPhosphorus;
    }

    public function handlePotassiumUpdate($potassium)
    {
        $this->potassiumReading = $potassium;
    }
    public function handleMinPotassiumUpdate($minPotassium)
    {
        $this->potassiumMinReading = $minPotassium;
    }
    public function handleMaxPotassiumUpdate($maxPotassium)
    {
        $this->potassiumMaxReading = $maxPotassium;
    }

    public function viewCycleDetails($cycleId)
    {
        $this->selectedCycleDetails = Cycles::with([
            'milestones',
            'brixReadings',
            'harvests',
            'dailySensorData',
        ])->findOrFail($cycleId);

        $readings = $this->selectedCycleDetails->dailySensorData
            ->groupBy(fn ($reading) =>
                \Carbon\Carbon::parse($reading->reading_date)->format('Y-m-d')
            )
            ->map(function ($items, $date) {
                return [
                    'date' => $date,
                    'label' => \Carbon\Carbon::parse($date)->format('M d'),
                    'temperature' => round($items->avg('temperature'), 2),
                    'humidity' => round($items->avg('humidity'), 2),
                    'soil_moisture' => round($items->avg('soil_moisture'), 2),
                    'ec_level' => round($items->avg('ec_level'), 2),
                    'ph_level' => round($items->avg('ph_level'), 2),
                    'nitrogen' => round($items->avg('nitrogen'), 2),
                    'phosphorus' => round($items->avg('phosphorus'), 2),
                    'potassium' => round($items->avg('potassium'), 2),
                ];
            })
            ->sortBy('date')
            ->values();

        $this->dispatch('cycleDetailsLoaded', [
            'labels' => $readings->pluck('label')->values(),
            'data' => [
                'temperature' => $readings->pluck('temperature')->values(),
                'humidity' => $readings->pluck('humidity')->values(),
                'soil_moisture' => $readings->pluck('soil_moisture')->values(),
                'ec_level' => $readings->pluck('ec_level')->values(),
                'ph_level' => $readings->pluck('ph_level')->values(),
                'nitrogen' => $readings->pluck('nitrogen')->values(),
                'phosphorus' => $readings->pluck('phosphorus')->values(),
                'potassium' => $readings->pluck('potassium')->values(),
            ],
        ]);
    }

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

        // $cycleLists = Cycles::with('milestones')
        //     ->where('status', 'ongoing')
        //     ->get();

        $cycleLists = Cycles::with('milestones')->latest()->get();

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

        $recentNotifications = Notifications::latest()
            ->limit(3)
            ->get();

        $totalHarvestedMelons = Harvests::sum('harvest_count');
            

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

            'Temperature' => $this->tempratureReading,
            'MinTemperature' => $this->tempratureMinReading,
            'MaxTemperature' => $this->tempratureMaxReading,

            'Humidity' => $this->humidityReading,
            'MinHumidity' => $this->humidityMinReading,
            'MaxHumidity' => $this->humidityMaxReading,

            'SoilMoisture' => $this->soilMoistureReading,
            'MinSoilMoisture' => $this->soilMoistureMinReading,
            'MaxSoilMoisture' => $this->soilMoistureMaxReading,

            'ECLevel' => $this->ecLevelReading,
            'MinECLevel' => $this->ecLevelMinReading,
            'MaxECLevel' => $this->ecLevelMaxReading,

            'pHLevel' => $this->pHLevelReading,
            'MinpHLevel' => $this->pHLevelMinReading,
            'MaxpHLevel' => $this->pHLevelMaxReading,

            'Nitrogen' => $this->nitrogenReading,
            'MinNitrogen' => $this->nitrogenMinReading,
            'MaxNitrogen' => $this->nitrogenMaxReading,

            'Phosphorus' => $this->phosphorusReading,
            'MinPhosphorus' => $this->phosphorusMinReading,
            'MaxPhosphorus' => $this->phosphorusMaxReading,

            'Potassium' => $this->potassiumReading,
            'MinPotassium' => $this->potassiumMinReading,
            'MaxPotassium' => $this->potassiumMaxReading,

            'recentNotifications' => $recentNotifications,
            'totalHarvestedMelons' => $totalHarvestedMelons,
        ]);
    }
}