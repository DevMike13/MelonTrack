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

    public $Nitrogen2;
    public $MinNitrogen2;
    public $MaxNitrogen2;

    public $Phosphorus2;
    public $MinPhosphorus2;
    public $MaxPhosphorus2;

    public $Potassium2;
    public $MinPotassium2;
    public $MaxPotassium2;

    public $SoilMoisture2;
    public $MinSoilMoisture2;
    public $MaxSoilMoisture2;

    public $WaterLevel;
    public $MinWaterLevel;
    public $MaxWaterLevel;

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

        // NPK Sensor 2
        'updateNitrogen2' => 'handleNitrogen2Update',
        'updateMinNitrogen2' => 'handleMinNitrogen2Update',
        'updateMaxNitrogen2' => 'handleMaxNitrogen2Update',

        'updatePhosphorus2' => 'handlePhosphorus2Update',
        'updateMinPhosphorus2' => 'handleMinPhosphorus2Update',
        'updateMaxPhosphorus2' => 'handleMaxPhosphorus2Update',

        'updatePotassium2' => 'handlePotassium2Update',
        'updateMinPotassium2' => 'handleMinPotassium2Update',
        'updateMaxPotassium2' => 'handleMaxPotassium2Update',

        // Soil Moisture Sensor 2
        'updateSoilMoisture2' => 'handleSoilMoisture2Update',
        'updateMinSoilMoisture2' => 'handleMinSoilMoisture2Update',
        'updateMaxSoilMoisture2' => 'handleMaxSoilMoisture2Update',

        // Water Level
        'updateWaterLevel' => 'handleWaterLevelUpdate',
        'updateMinWaterLevel' => 'handleMinWaterLevelUpdate',
        'updateMaxWaterLevel' => 'handleMaxWaterLevelUpdate',
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


            // Soil Moisture 2
            $this->SoilMoisture2 = $this->database->getReference('SoilMoisture2/SensorValue')->getSnapshot()->getValue();
            $this->MinSoilMoisture2 = $this->database->getReference('SoilMoisture2/Min')->getSnapshot()->getValue();
            $this->MaxSoilMoisture2 = $this->database->getReference('SoilMoisture2/Max')->getSnapshot()->getValue();

            // Water Level
            $this->WaterLevel = $this->database->getReference('WaterLevel/SensorValue')->getSnapshot()->getValue();
            $this->MinWaterLevel = $this->database->getReference('WaterLevel/Min')->getSnapshot()->getValue();
            $this->MaxWaterLevel = $this->database->getReference('WaterLevel/Max')->getSnapshot()->getValue();

            // NPK Sensor 2
            $this->Nitrogen2 = $this->database->getReference('Nitrogen2/SensorValue')->getSnapshot()->getValue();
            $this->MinNitrogen2 = $this->database->getReference('Nitrogen2/Min')->getSnapshot()->getValue();
            $this->MaxNitrogen2 = $this->database->getReference('Nitrogen2/Max')->getSnapshot()->getValue();

            $this->Phosphorus2 = $this->database->getReference('Phosphorus2/SensorValue')->getSnapshot()->getValue();
            $this->MinPhosphorus2 = $this->database->getReference('Phosphorus2/Min')->getSnapshot()->getValue();
            $this->MaxPhosphorus2 = $this->database->getReference('Phosphorus2/Max')->getSnapshot()->getValue();

            $this->Potassium2 = $this->database->getReference('Potassium2/SensorValue')->getSnapshot()->getValue();
            $this->MinPotassium2 = $this->database->getReference('Potassium2/Min')->getSnapshot()->getValue();
            $this->MaxPotassium2 = $this->database->getReference('Potassium2/Max')->getSnapshot()->getValue();


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

    public function handleSoilMoisture2Update($soilMoisture2)
    {
        $this->SoilMoisture2 = $soilMoisture2;
    }

    public function handleMinSoilMoisture2Update($minSoilMoisture2)
    {
        $this->MinSoilMoisture2 = $minSoilMoisture2;
    }

    public function handleMaxSoilMoisture2Update($maxSoilMoisture2)
    {
        $this->MaxSoilMoisture2 = $maxSoilMoisture2;
    }

    public function handleWaterLevelUpdate($waterLevel)
    {
        $this->WaterLevel = $waterLevel;
    }

    public function handleMinWaterLevelUpdate($minWaterLevel)
    {
        $this->MinWaterLevel = $minWaterLevel;
    }

    public function handleMaxWaterLevelUpdate($maxWaterLevel)
    {
        $this->MaxWaterLevel = $maxWaterLevel;
    }

    public function handleNitrogen2Update($nitrogen2)
    {
        $this->Nitrogen2 = $nitrogen2;
    }

    public function handleMinNitrogen2Update($minNitrogen2)
    {
        $this->MinNitrogen2 = $minNitrogen2;
    }

    public function handleMaxNitrogen2Update($maxNitrogen2)
    {
        $this->MaxNitrogen2 = $maxNitrogen2;
    }

    public function handlePhosphorus2Update($phosphorus2)
    {
        $this->Phosphorus2 = $phosphorus2;
    }

    public function handleMinPhosphorus2Update($minPhosphorus2)
    {
        $this->MinPhosphorus2 = $minPhosphorus2;
    }

    public function handleMaxPhosphorus2Update($maxPhosphorus2)
    {
        $this->MaxPhosphorus2 = $maxPhosphorus2;
    }

    public function handlePotassium2Update($potassium2)
    {
        $this->Potassium2 = $potassium2;
    }

    public function handleMinPotassium2Update($minPotassium2)
    {
        $this->MinPotassium2 = $minPotassium2;
    }

    public function handleMaxPotassium2Update($maxPotassium2)
    {
        $this->MaxPotassium2 = $maxPotassium2;
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
                    'soil_moisture2' => round($items->avg('soil_moisture2'), 2),
                    'water_level' => round($items->avg('water_level'), 2),
                    'ec_level' => round($items->avg('ec_level'), 2),
                    'ph_level' => round($items->avg('ph_level'), 2),
                    'nitrogen' => round($items->avg('nitrogen'), 2),
                    'phosphorus' => round($items->avg('phosphorus'), 2),
                    'potassium' => round($items->avg('potassium'), 2),

                    'nitrogen2' => round($items->avg('nitrogen2'), 2),
                    'phosphorus2' => round($items->avg('phosphorus2'), 2),
                    'potassium2' => round($items->avg('potassium2'), 2),
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
                'soil_moisture2' => $readings->pluck('soil_moisture2')->values(),
                'water_level' => $readings->pluck('water_level')->values(),
                'ec_level' => $readings->pluck('ec_level')->values(),
                'ph_level' => $readings->pluck('ph_level')->values(),
                'nitrogen' => $readings->pluck('nitrogen')->values(),
                'phosphorus' => $readings->pluck('phosphorus')->values(),
                'potassium' => $readings->pluck('potassium')->values(),
                'nitrogen2' => $readings->pluck('nitrogen2')->values(),
                'phosphorus2' => $readings->pluck('phosphorus2')->values(),
                'potassium2' => $readings->pluck('potassium2')->values(),
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

            'SoilMoisture2' => $this->SoilMoisture2,
            'MinSoilMoisture2' => $this->MinSoilMoisture2,
            'MaxSoilMoisture2' => $this->MaxSoilMoisture2,

            'WaterLevel' => $this->WaterLevel,
            'MinWaterLevel' => $this->MinWaterLevel,
            'MaxWaterLevel' => $this->MaxWaterLevel,

            'Nitrogen2' => $this->Nitrogen2,
            'MinNitrogen2' => $this->MinNitrogen2,
            'MaxNitrogen2' => $this->MaxNitrogen2,

            'Phosphorus2' => $this->Phosphorus2,
            'MinPhosphorus2' => $this->MinPhosphorus2,
            'MaxPhosphorus2' => $this->MaxPhosphorus2,

            'Potassium2' => $this->Potassium2,
            'MinPotassium2' => $this->MinPotassium2,
            'MaxPotassium2' => $this->MaxPotassium2,

            'recentNotifications' => $recentNotifications,
            'totalHarvestedMelons' => $totalHarvestedMelons,
        ]);
    }
}