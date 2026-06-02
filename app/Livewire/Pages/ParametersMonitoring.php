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

    public $chartLabels = [];
    public $chartData = [];

    

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
        'updateMaxpHLevel' => 'handleMaxpHLevelUpdate'
    ];


    public function mount(Database $database)
    {
        $this->database = $database;
        $this->fetchData();
        $this->loadChartData();
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

    public function loadChartData()
    {
        $data = DB::table('daily_sensor_data')
            ->orderBy('reading_date')
            ->get();

        $this->chartLabels = $data
            ->pluck('reading_date')
            ->map(fn($d) => date('g A', strtotime($d)))
            ->toArray();

        $this->chartData = [
            'temperature' => $data->pluck('temperature')->toArray(),
            'humidity' => $data->pluck('humidity')->toArray(),
            'soil_moisture' => $data->pluck('soil_moisture')->toArray(),
            'ec_level' => $data->pluck('ec_level')->toArray(),
            'ph_level' => $data->pluck('ph_level')->toArray(),
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
            'MaxpHLevel' => $this->pHLevelMaxReading
        ]);
    }
}
