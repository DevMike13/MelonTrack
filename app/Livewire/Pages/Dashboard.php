<?php

namespace App\Livewire\Pages;

use App\Models\SensorDatas;
use Carbon\Carbon;
use Filament\Notifications\Notification;
use Livewire\Component;
use Kreait\Firebase\Contract\Database;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;

class Dashboard extends Component
{
    protected Database $database;
    
    public $soilMoistureData;
    public $soilPHData;
    public $waterPHData;
    public $temperatureData;
    public $humidityData;

    public $soilMoistureDataB2;
    public $soilPHDataB2;

    public $soilMoistureDataB3;
    public $soilPHDataB3;

    public $soilMoistureDataB4;
    public $soilPHDataB4;
    
    public $fanState;
    public bool $isActiveFan;

    public $lightState;
    public bool $isActiveLight;

    public $mistingData;
    public bool $isActiveMistingData;

    public $mistingDataB2;
    public bool $isActiveMistingDataB2;

    public $mistingDataB3;
    public bool $isActiveMistingDataB3;

    public $mistingDataB4;
    public bool $isActiveMistingDataB4;

    public $waterLevelData;

    #[Url()]
    public $selectedBoard;

    public $masterState;
    public bool $isMasterEnabled;

    protected $listeners = [
        'updateSoilMoistureLevel' => 'handleSoilMoistureLevelUpdate',
        'updateSoilPHLevel' => 'handleSoilPHLevelUpdate',
        'updateSoilMoistureLevelB2' => 'handleSoilMoistureLevelUpdateB2',
        'updateSoilPHLevelB2' => 'handleSoilPHLevelUpdateB2',
        'updateSoilMoistureLevelB3' => 'handleSoilMoistureLevelUpdateB3',
        'updateSoilPHLevelB3' => 'handleSoilPHLevelUpdateB3',
        'updateSoilMoistureLevelB4' => 'handleSoilMoistureLevelUpdateB4',
        'updateSoilPHLevelB4' => 'handleSoilPHLevelUpdateB4',
        'updateWaterPHLevel' => 'handleWaterPHLevelUpdate',
        'updateTemperatureLevel' => 'handleTemperatureLevelUpdate',
        'updateHumidityLevel' => 'handleHumidityLevelUpdate',
        'updateFanState' => 'handleFanStateUpdate',
        'updateLightState' => 'handleLightStateUpdate',
        'updateMisting' => 'handleMistingUpdate',
        'updateMistingB2' => 'handleMistingB2Update',
        'updateMistingB3' => 'handleMistingB3Update',
        'updateMistingB4' => 'handleMistingB4Update',
        'updateWaterLevel' => 'handleWaterLevelUpdate',
        'updateMasterState' => 'handleMasterStateUpdate',
    ];

    public $phLevelData = [];
    public $doLevelData = [];
    public $alLevelData=[];
    public $wtLevelData=[];

    public function mount(Database $database)
    {
        $this->database = $database;
        // $this->getLightState();
        // $this->selectedBoard = "B1";
        if (!$this->selectedBoard) {
            $this->selectedBoard = "B1";
        }
        $this->fetchData();
        
        // $this->getFanState();
        // $this->getPhLevelDataForCurrentWeek();
        // $this->getDOLevelDataForCurrentWeek();
        // $this->getAlLevelDataForCurrentWeek();
        // $this->getWtDataForCurrentWeek();
        
    }

    public function getPhLevelDataForCurrentWeek()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $phData = SensorDatas::selectRaw('DAYNAME(reading_date) as Day, ph_level as Value')
            ->whereIn('id', function ($query) use ($startOfWeek, $endOfWeek) {
                $query->selectRaw('MAX(id)')
                    ->from('sensor_datas')
                    ->whereBetween('reading_date', [$startOfWeek, $endOfWeek])
                    ->groupByRaw('DATE(reading_date)');
            })
            ->orderByRaw('FIELD(Day, "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday")')
            ->get();

        $this->phLevelData = $phData->map(function ($item) {
            return [
                'Day' => substr($item->Day, 0, 3), // Shorten day name (Mon, Tue, etc.)
                'Value' => round($item->Value, 2)  // Round to 2 decimal places
            ];
        })->toArray();
    }

    public function getDOLevelDataForCurrentWeek()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        // Get only the latest dissolved oxygen level data for each day of the current week
        $doData = SensorDatas::selectRaw('DAYNAME(reading_date) as Day, dissolved_oxygen as Value')
            ->whereIn('id', function ($query) use ($startOfWeek, $endOfWeek) {
                $query->selectRaw('MAX(id)')
                    ->from('sensor_datas')
                    ->whereBetween('reading_date', [$startOfWeek, $endOfWeek])
                    ->groupByRaw('DATE(reading_date)');
            })
            ->orderByRaw('FIELD(Day, "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday")')
            ->get();

        // Format the data for use in your view or chart
        $this->doLevelData = $doData->map(function ($item) {
            return [
                'Day' => substr($item->Day, 0, 3), // Shorten day name (Mon, Tue, etc.)
                'Value' => round($item->Value, 2)  // Round to 2 decimal places
            ];
        })->toArray();
    }

    public function getAlLevelDataForCurrentWeek()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $alData = SensorDatas::selectRaw('DAYNAME(reading_date) as Day, alkalinity_level as Value')
            ->whereIn('id', function ($query) use ($startOfWeek, $endOfWeek) {
                $query->selectRaw('MAX(id)')
                    ->from('sensor_datas')
                    ->whereBetween('reading_date', [$startOfWeek, $endOfWeek])
                    ->groupByRaw('DATE(reading_date)');
            })
            ->orderByRaw('FIELD(Day, "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday")')
            ->get();

        $this->alLevelData = $alData->map(function ($item) {
            return [
                'Day' => substr($item->Day, 0, 3), // Shorten day name (Mon, Tue, etc.)
                'Value' => round($item->Value, 2)  // Round to 2 decimal places
            ];
        })->toArray();
    }

    public function getWtDataForCurrentWeek()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        // Retrieve only the latest water temperature data for each day of the current week
        $wtData = SensorDatas::selectRaw('DAYNAME(reading_date) as Day, water_temperature as Value')
            ->whereIn('id', function ($query) use ($startOfWeek, $endOfWeek) {
                $query->selectRaw('MAX(id)')
                    ->from('sensor_datas')
                    ->whereBetween('reading_date', [$startOfWeek, $endOfWeek])
                    ->groupByRaw('DATE(reading_date)');
            })
            ->orderByRaw('FIELD(Day, "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday")')
            ->get();

        // Format the data for use in the chart
        $this->wtLevelData = $wtData->map(function ($item) {
            return [
                'Day' => substr($item->Day, 0, 3),  // Shorten the day name (e.g., Mon, Tue)
                'Value' => round($item->Value, 2)   // Round to 2 decimal places
            ];
        })->toArray();
    }

    public function fetchData()
    {
        try {
        
            // SOIL MOISTURE
            $referenceSoilMoisture = $this->database->getReference("B1/SoilMoisture");
            $snapshotSoilMoisture = $referenceSoilMoisture->getSnapshot();
            $this->soilMoistureData = $snapshotSoilMoisture->getValue();

            // SOIL PH
            $referenceSoilPH = $this->database->getReference('B1/SoilPH');
            $snapshotSoilPH = $referenceSoilPH->getSnapshot();
            $this->soilPHData = $snapshotSoilPH->getValue();

            // SOIL MOISTURE B2
            $referenceSoilMoistureB2 = $this->database->getReference("B2/SoilMoisture");
            $snapshotSoilMoistureB2 = $referenceSoilMoistureB2->getSnapshot();
            $this->soilMoistureDataB2 = $snapshotSoilMoistureB2->getValue();

            // SOIL PH B2
            $referenceSoilPHB2 = $this->database->getReference('B2/SoilPH');
            $snapshotSoilPHB2 = $referenceSoilPHB2->getSnapshot();
            $this->soilPHDataB2 = $snapshotSoilPHB2->getValue();

            // SOIL MOISTURE B3
            $referenceSoilMoistureB3 = $this->database->getReference("B3/SoilMoisture");
            $snapshotSoilMoistureB3 = $referenceSoilMoistureB3->getSnapshot();
            $this->soilMoistureDataB3 = $snapshotSoilMoistureB3->getValue();

            // SOIL PH B3
            $referenceSoilPHB3 = $this->database->getReference('B3/SoilPH');
            $snapshotSoilPHB3 = $referenceSoilPHB3->getSnapshot();
            $this->soilPHDataB3 = $snapshotSoilPHB3->getValue();

            // SOIL MOISTURE B4
            $referenceSoilMoistureB4 = $this->database->getReference("B4/SoilMoisture");
            $snapshotSoilMoistureB4 = $referenceSoilMoistureB4->getSnapshot();
            $this->soilMoistureDataB4 = $snapshotSoilMoistureB4->getValue();

            // SOIL PH B4
            $referenceSoilPHB4 = $this->database->getReference('B4/SoilPH');
            $snapshotSoilPHB4 = $referenceSoilPHB4->getSnapshot();
            $this->soilPHDataB4 = $snapshotSoilPHB4->getValue();

            // SOIL WATER PH
            $referenceWaterPH = $this->database->getReference('B5/WaterPH');
            $snapshotWaterPH= $referenceWaterPH->getSnapshot();
            $this->waterPHData = $snapshotWaterPH->getValue();

            // TEMPERATURE
            $referenceTemperature = $this->database->getReference('B1/Temperature');
            $snapshotTemperature = $referenceTemperature->getSnapshot();
            $this->temperatureData = $snapshotTemperature->getValue();

            // HUMIDITY
            $referenceHumidity = $this->database->getReference('B1/Humidity');
            $snapshotHumidity = $referenceHumidity->getSnapshot();
            $this->humidityData = $snapshotHumidity->getValue();

            // FAN STATE
            $referenceFanState = $this->database->getReference('System/Fan');
            $snapshotFanState = $referenceFanState->getSnapshot();
            $this->fanState = $snapshotFanState->getValue();

            // LIGHT STATE
            $referenceLightState = $this->database->getReference('System/Light');
            $snapshotLightState = $referenceLightState->getSnapshot();
            $this->lightState = $snapshotLightState->getValue();

            // MISTING SYSTEM B1
            $referenceMisting = $this->database->getReference('B1/Misting');
            $snapshotMisting = $referenceMisting->getSnapshot();
            $this->mistingData = $snapshotMisting->getValue();

            // MISTING SYSTEM B2
            $referenceMistingB2 = $this->database->getReference('B2/Misting');
            $snapshotMistingB2 = $referenceMistingB2->getSnapshot();
            $this->mistingDataB2 = $snapshotMistingB2->getValue();

            // MISTING SYSTEM B3
            $referenceMistingB3 = $this->database->getReference('B3/Misting');
            $snapshotMistingB3 = $referenceMistingB3->getSnapshot();
            $this->mistingDataB3 = $snapshotMistingB3->getValue();

            // MISTING SYSTEM B4
            $referenceMistingB4 = $this->database->getReference('B4/Misting');
            $snapshotMistingB4 = $referenceMistingB4->getSnapshot();
            $this->mistingDataB4 = $snapshotMistingB4->getValue();

            // WATER LEVEL
            $referenceWaterLevel = $this->database->getReference('System/WaterLevel');
            $snapshotWaterLevel = $referenceWaterLevel->getSnapshot();
            $this->waterLevelData = $snapshotWaterLevel->getValue();

            // MISTING SYSTEM B4
            $referenceMaster = $this->database->getReference('System/MasterControll');
            $snapshotMaster = $referenceMaster->getSnapshot();
            $this->masterState = $snapshotMaster->getValue();

        } catch (\Exception $e) {
            $this->soilMoistureData = 'Error: ' . $e->getMessage();
        }
    }

    public function handleSoilMoistureLevelUpdate($soilMoistureLevel)
    {
        $this->soilMoistureData = $soilMoistureLevel;
    }

    // SOIL MOISTURE B2
    public function handleSoilMoistureLevelUpdateB2($soilMoistureLevelB2)
    {
        $this->soilMoistureDataB2 = $soilMoistureLevelB2;
    }

    // SOIL MOISTURE B3
    public function handleSoilMoistureLevelUpdateB3($soilMoistureLevelB3)
    {
        $this->soilMoistureDataB3 = $soilMoistureLevelB3;
    }

    // SOIL MOISTURE B4
    public function handleSoilMoistureLevelUpdateB4($soilMoistureLevelB4)
    {
        $this->soilMoistureDataB4 = $soilMoistureLevelB4;
    }

    public function handleSoilPHLevelUpdate($soilPHLevel)
    {
        $this->soilPHData = $soilPHLevel;
    }

    // SOIL PH B2
    public function handleSoilPHLevelUpdateB2($soilPHLevelB2)
    {
        $this->soilPHDataB2 = $soilPHLevelB2;
    }

    // SOIL PH B3
    public function handleSoilPHLevelUpdateB3($soilPHLevelB3)
    {
        $this->soilPHDataB3 = $soilPHLevelB3;
    }

    // SOIL PH B4
    public function handleSoilPHLevelUpdateB4($soilPHLevelB4)
    {
        $this->soilPHDataB4 = $soilPHLevelB4;
    }

    public function handleWaterPHLevelUpdate($waterPHLevel)
    {
        $this->waterPHData = $waterPHLevel;
    }

    public function handleTemperatureLevelUpdate($temperatureLevel)
    {
        $this->temperatureData = $temperatureLevel;
    }

    public function handleHumidityLevelUpdate($humidityLevel)
    {
        $this->humidityData = $humidityLevel;
    }

    public function updatedSelectedBoard($value)
    {
        $this->dispatch('board-changed', board: $value);
    }

    // SYSTEM
    public function getFanState()
    {
        try {
            $reference = $this->database->getReference('System/Fan');
            $currentData = $reference->getValue();

            if ($currentData == 'ON') {
                $this->fanState = 'ON';
                $this->isActiveFan = true;
            } else {
                $this->fanState = 'OFF';
                $this->isActiveFan = false;
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error retrieving status: ' . $e->getMessage()], 500);
        }
    }

    public function showMasterControlNotification()
    {
        Notification::make()
            ->title('Info')
            ->body('Master Control is active. You cannot toggle.')
            ->info()
            ->send();
    }


    public function toggleFan(Database $database)
    {
        if ($this->isMasterEnabled == true) {
            Notification::make()
                ->title('Info')
                ->body('Master Control is active. You cannot toggle the fan.')
                ->info()
                ->send();
            return;
        }

        $this->database = $database;
        try {
            $reference = $this->database->getReference('System/Fan');
            
            $currentData = $reference->getValue();
            
            if ($currentData == 'OFF') {
                $this->fanState = 'ON';
                $this->isActiveFan = true;
            } else {
                $this->fanState = 'OFF';
                $this->isActiveFan = false;
            }

            $reference->set($this->fanState);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error toggling status: ' . $e->getMessage()], 500);
        }
    }

    public function handleFanStateUpdate($fanState)
    {
        $this->fanState = $fanState;
        $this->isActiveFan = $fanState === 'ON';
    }

    // LIGHT
    public function getLightState()
    {
        try {
            $reference = $this->database->getReference('System/Light');
            $currentData = $reference->getValue();

            if ($currentData == 'ON') {
                $this->lightState = 'ON';
                $this->isActiveLight = true;
            } else {
                $this->lightState = 'OFF';
                $this->isActiveLight = false;
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error retrieving status: ' . $e->getMessage()], 500);
        }
    }

    public function toggleLight(Database $database)
    {
        if ($this->isMasterEnabled == true) {
            Notification::make()
                ->title('Info')
                ->body('Master Control is active. You cannot toggle the light.')
                ->info()
                ->send();
            return;
        }

        $this->database = $database;
        try {
            $reference = $this->database->getReference('System/Light');
            
            $currentData = $reference->getValue();
            
            if ($currentData == 'OFF') {
                $this->lightState = 'ON';
                $this->isActiveLight = true;
            } else {
                $this->lightState = 'OFF';
                $this->isActiveLight = false;
            }

            $reference->set($this->lightState);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error toggling status: ' . $e->getMessage()], 500);
        }
    }

    public function handleLightStateUpdate($lightState)
    {
        $this->lightState = $lightState;
        $this->isActiveLight = $lightState === 'ON';
    }

    public function getMistingB1State()
    {
        try {
            $reference = $this->database->getReference('B1/Misting');
            $currentData = $reference->getValue();

            if ($currentData == 'Active') {
                $this->mistingData = 'Active';
                $this->isActiveMistingData = true;
            } else {
                $this->mistingData = 'Inactive';
                $this->isActiveMistingData = false;
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error retrieving status: ' . $e->getMessage()], 500);
        }
    }

    public function toggleMistingB1(Database $database)
    {
        if ($this->isMasterEnabled == true) {
            Notification::make()
                ->title('Info')
                ->body('Master Control is active. You cannot toggle.')
                ->info()
                ->send();
            return;
        }

        $this->database = $database;
        try {
            $reference = $this->database->getReference('B1/Misting');
            
            $currentData = $reference->getValue();
            
            if ($currentData == 'Inactive') {
                $this->mistingData = 'Active';
                $this->isActiveMistingData = true;
            } else {
                $this->mistingData = 'Inactive';
                $this->isActiveMistingData = false;
            }

            $reference->set($this->mistingData);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error toggling status: ' . $e->getMessage()], 500);
        }
    }

    public function handleMistingUpdate($mistingB1)
    {
        $this->mistingData = $mistingB1;
        $this->isActiveMistingData = $mistingB1 === 'Active';
    }


    public function getMistingB2State()
    {
        try {
            $reference = $this->database->getReference('B2/Misting');
            $currentData = $reference->getValue();

            if ($currentData == 'Active') {
                $this->mistingDataB2 = 'Active';
                $this->isActiveMistingDataB2 = true;
            } else {
                $this->mistingDataB2 = 'Inactive';
                $this->isActiveMistingDataB2 = false;
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error retrieving status: ' . $e->getMessage()], 500);
        }
    }

    public function toggleMistingB2(Database $database)
    {
        if ($this->isMasterEnabled == true) {
            Notification::make()
                ->title('Info')
                ->body('Master Control is active. You cannot toggle.')
                ->info()
                ->send();
            return;
        }

        $this->database = $database;
        try {
            $reference = $this->database->getReference('B2/Misting');
            
            $currentData = $reference->getValue();
            
            if ($currentData == 'Inactive') {
                $this->mistingDataB2 = 'Active';
                $this->isActiveMistingDataB2 = true;
            } else {
                $this->mistingDataB2 = 'Inactive';
                $this->isActiveMistingDataB2 = false;
            }

            $reference->set($this->mistingDataB2);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error toggling status: ' . $e->getMessage()], 500);
        }
    }

    public function handleMistingB2Update($mistingB2)
    {
        $this->mistingDataB2 = $mistingB2;
        $this->isActiveMistingDataB2 = $mistingB2 === 'Active';
    }

    public function getMistingB3State()
    {
        try {
            $reference = $this->database->getReference('B3/Misting');
            $currentData = $reference->getValue();

            if ($currentData == 'Active') {
                $this->mistingDataB3 = 'Active';
                $this->isActiveMistingDataB3 = true;
            } else {
                $this->mistingDataB3 = 'Inactive';
                $this->isActiveMistingDataB3 = false;
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error retrieving status: ' . $e->getMessage()], 500);
        }
    }

    public function toggleMistingB3(Database $database)
    {
        if ($this->isMasterEnabled == true) {
            Notification::make()
                ->title('Info')
                ->body('Master Control is active. You cannot toggle.')
                ->info()
                ->send();
            return;
        }

        $this->database = $database;
        try {
            $reference = $this->database->getReference('B3/Misting');
            
            $currentData = $reference->getValue();
            
            if ($currentData == 'Inactive') {
                $this->mistingDataB3 = 'Active';
                $this->isActiveMistingDataB3 = true;
            } else {
                $this->mistingDataB3 = 'Inactive';
                $this->isActiveMistingDataB3 = false;
            }

            $reference->set($this->mistingDataB3);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error toggling status: ' . $e->getMessage()], 500);
        }
    }

    public function handleMistingB3Update($mistingB3)
    {
        $this->mistingDataB3 = $mistingB3;
        $this->isActiveMistingDataB3 = $mistingB3 === 'Active';
    }

    public function getMistingB4State()
    {
        try {
            $reference = $this->database->getReference('B4/Misting');
            $currentData = $reference->getValue();

            if ($currentData == 'Active') {
                $this->mistingDataB4 = 'Active';
                $this->isActiveMistingDataB4 = true;
            } else {
                $this->mistingDataB4 = 'Inactive';
                $this->isActiveMistingDataB4 = false;
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error retrieving status: ' . $e->getMessage()], 500);
        }
    }

    public function toggleMistingB4(Database $database)
    {
        if ($this->isMasterEnabled == true) {
            Notification::make()
                ->title('Info')
                ->body('Master Control is active. You cannot toggle.')
                ->info()
                ->send();
            return;
        }

        $this->database = $database;
        try {
            $reference = $this->database->getReference('B4/Misting');
            
            $currentData = $reference->getValue();
            
            if ($currentData == 'Inactive') {
                $this->mistingDataB4 = 'Active';
                $this->isActiveMistingDataB4 = true;
            } else {
                $this->mistingDataB4 = 'Inactive';
                $this->isActiveMistingDataB4 = false;
            }

            $reference->set($this->mistingDataB4);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error toggling status: ' . $e->getMessage()], 500);
        }
    }

    public function handleMistingB4Update($mistingB4)
    {
        $this->mistingDataB4 = $mistingB4;
        $this->isActiveMistingDataB4 = $mistingB4 === 'Active';
    }

    public function handleWaterLevelUpdate($waterLevel)
    {
        $this->waterLevelData = $waterLevel;
    }

    public function getMasterState()
    {
        try {
            $reference = $this->database->getReference('System/MasterControll');
            $currentData = $reference->getValue();

            if ($currentData == 'ON') {
                $this->masterState = 'ON';
                $this->isMasterEnabled = true;
            } else {
                $this->masterState = 'OFF';
                $this->isMasterEnabled = false;
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error retrieving status: ' . $e->getMessage()], 500);
        }
    }

    public function toggleMasterState(Database $database)
    {
        $this->database = $database;
        try {
            $reference = $this->database->getReference('System/MasterControll');
            
            $currentData = $reference->getValue();
            
            if ($currentData == 'OFF') {
                $this->masterState = 'ON';
                $this->isMasterEnabled = true;
            } else {
                $this->masterState = 'OFF';
                $this->isMasterEnabled = false;
            }

            $reference->set($this->masterState);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error toggling status: ' . $e->getMessage()], 500);
        }
    }

    public function handleMasterStateUpdate($masterState)
    {
        $this->masterState = $masterState;
        $this->isMasterEnabled = $masterState === 'ON';
    }

    public function render()
    {
        return view('livewire.pages.dashboard', [
            'soilMoisture' => $this->soilMoistureData,
            'soilMoistureB2' => $this->soilMoistureDataB2,
            'soilMoistureB3' => $this->soilMoistureDataB3,
            'soilMoistureB4' => $this->soilMoistureDataB4,
            'soilPH' => $this->soilPHData,
            'soilPHB2' => $this->soilPHDataB2,
            'soilPHB3' => $this->soilPHDataB3,
            'soilPHB4' => $this->soilPHDataB4,
            'waterPH' => $this->waterPHData,
            'temperature' => $this->temperatureData,
            'fanState' => $this->fanState,
            // 'lightState' => $this->lightState,
            'humidity' => $this->humidityData,
            'mistingSystem' => $this->mistingData,
            'waterLevel' => $this->waterLevelData,
        ]);
    }
}
