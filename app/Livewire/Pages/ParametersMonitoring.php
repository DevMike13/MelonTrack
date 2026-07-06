<?php

namespace App\Livewire\Pages;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Kreait\Firebase\Contract\Database;

class ParametersMonitoring extends Component
{
    protected Database $database;

    public string $activeFilter = 'Live';
    
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


    public function mount(Database $database)
    {
        $this->database = $database;
        $this->fetchData();
        $this->loadChartData();
        $this->maxDateTime = now('Asia/Manila')->format('Y-m-d H:i:s');
    }

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

    public function updatedActiveFilter()
    {
        $this->loadChartData();

        $this->dispatch('updateChart', [
            'labels' => $this->chartLabels,
            'data' => $this->chartData,
            'mode' => 'all',
        ]);
    }

    public function applyCustomFilter()
    {
        $this->activeFilter = 'Custom';
        $this->loadChartData();

        $this->dispatch('updateChart', [
            'labels' => $this->chartLabels,
            'data' => $this->chartData,
            'mode' => 'all',
        ]);
    }

    public function loadChartData()
    {
        $query = DB::table('daily_sensor_data');

        if ($this->activeFilter === 'Live') {
            // Today hourly data
            $data = $query
                ->selectRaw("
                    DATE_FORMAT(reading_date, '%Y-%m-%d %H:00:00') as grouped_date,
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
                ->whereDate('reading_date', now('Asia/Manila')->toDateString())
                ->groupBy('grouped_date')
                ->orderBy('grouped_date')
                ->get();

            $this->chartDateRange = 'Today - ' . now('Asia/Manila')->format('F d, Y');
        }

        elseif ($this->activeFilter === 'Yesterday') {
            $start = now('Asia/Manila')->subDay()->startOfDay();
            $end = now('Asia/Manila')->subDay()->endOfDay();

            $data = $query
                ->selectRaw("
                    DATE_FORMAT(reading_date, '%Y-%m-%d %H:00:00') as grouped_date,
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
                ->whereBetween('reading_date', [
                    $start->format('Y-m-d H:i:s'),
                    $end->format('Y-m-d H:i:s'),
                ])
                ->groupBy('grouped_date')
                ->orderBy('grouped_date')
                ->get();

            $this->chartDateRange = 'Yesterday - ' . $start->format('F d, Y');
        }

        elseif ($this->activeFilter === '7D') {
            $start = now('Asia/Manila')->subDays(7)->startOfDay();
            $end = now('Asia/Manila')->endOfDay();

            $data = $query
                ->selectRaw("
                    DATE(reading_date) as date_only,
                    CASE 
                        WHEN HOUR(reading_date) < 12 THEN 'AM'
                        ELSE 'PM'
                    END as half_day,
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
                ->whereBetween('reading_date', [
                    $start->format('Y-m-d H:i:s'),
                    $end->format('Y-m-d H:i:s'),
                ])
                ->groupBy('date_only', 'half_day')
                ->orderBy('date_only')
                ->orderByRaw("FIELD(half_day, 'AM', 'PM')")
                ->get();

            $this->chartDateRange = $start->format('M d, Y') . ' - ' . $end->format('M d, Y');
        }

        elseif ($this->activeFilter === '30D') {

            $start = now('Asia/Manila')->subDays(30)->startOfDay();
            $end = now('Asia/Manila')->endOfDay();

            // Last 30 days, average per day
            $data = $query
                ->selectRaw("
                    DATE(reading_date) as grouped_date,
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
                ->whereBetween('reading_date', [
                    $start->format('Y-m-d H:i:s'),
                    $end->format('Y-m-d H:i:s'),
                ])
                ->groupBy('grouped_date')
                ->orderBy('grouped_date')
                ->get();

            $this->chartDateRange =
                $start->format('M d, Y') . ' - ' . $end->format('M d, Y');
        }

        else {
            if (!$this->customStartDate || !$this->customEndDate) {
                $data = collect();
                $this->chartDateRange = 'Custom range not set';
            } else {
                $start = \Carbon\Carbon::parse($this->customStartDate, 'Asia/Manila');
                $end = \Carbon\Carbon::parse($this->customEndDate, 'Asia/Manila');

                $data = $query
                    ->selectRaw("
                        DATE_FORMAT(reading_date, '%Y-%m-%d %H:00:00') as grouped_date,
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
                    ->whereBetween('reading_date', [
                        $start->format('Y-m-d H:i:s'),
                        $end->format('Y-m-d H:i:s'),
                    ])
                    ->groupBy('grouped_date')
                    ->orderBy('grouped_date')
                    ->get();

                $this->chartDateRange = $start->format('M d, Y h:i A') . ' - ' . $end->format('M d, Y h:i A');
            }
        }

        $this->chartLabels = $data->map(function ($row) {
            if ($this->activeFilter === 'Live' || $this->activeFilter === 'Yesterday' || $this->activeFilter === 'Custom') {
                return date('M d, g A', strtotime($row->grouped_date));
            }

            if ($this->activeFilter === '7D') {
                return date('M d', strtotime($row->date_only)) . ' ' . 
                    ($row->half_day === 'AM' ? '12AM-12PM' : '12PM-12AM');
            }

            if ($this->activeFilter === '30D') {
                return date('M d', strtotime($row->grouped_date));
            }

            return '';
        })->toArray();

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
    }

    public function render()
    {
        return view('livewire.pages.parameters-monitoring', [
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

            'ChartDateRange' => $this->chartDateRange,
        ]);
    }
}
