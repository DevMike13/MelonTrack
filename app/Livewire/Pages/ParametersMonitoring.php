<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Kreait\Firebase\Contract\Database;

class ParametersMonitoring extends Component
{
    protected Database $database;
    public $phData;
    public $phTresholdData;
    public $setPHTresholdValue;

    public $doData;
    public $doTresholdData;
    public $setDOTresholdValue;

    public $alData;
    public $alTresholdData;
    public $setALTresholdValue;

    public $wTempData;
    public $wTempTresholdData;
    public $setWTTresholdValue;

    protected $listeners = [
        'updatePhLevel' => 'handlePhLevelUpdate',
        'updateDOLevel' => 'handleDoLevelUpdate',
        'updateALLevel' => 'handleAlLevelUpdate',
        'updateWTLevel' => 'handleWtLevelUpdate'
    ];


    public function mount(Database $database)
    {
        $this->database = $database;
        $this->fetchData();
        
    }

    public function fetchData()
    {
        try {
            // PH
            $referencePH = $this->database->getReference('pHLevel/phLevel');  // Example path
            $snapshotPH = $referencePH->getSnapshot();
            $this->phData = $snapshotPH->getValue();

            $referencePHTresh = $this->database->getReference('pHLevel/Treshold');  // Example path
            $snapshotPHTresh = $referencePHTresh->getSnapshot();
            $this->phTresholdData = $snapshotPHTresh->getValue();

            // DISSOLVED OXYGEN
            $referenceDO = $this->database->getReference('DissolvedOxygen/DO');  // Example path
            $snapshotDO = $referenceDO->getSnapshot();
            $this->doData = $snapshotDO->getValue();

            $referenceDOTresh = $this->database->getReference('DissolvedOxygen/Treshold');  // Example path
            $snapshotDOTresh = $referenceDOTresh->getSnapshot();
            $this->doTresholdData = $snapshotDOTresh->getValue();

            // ALKALINITY LEVEL
            $referenceAL = $this->database->getReference('AlkalinityLevel/AL');  // Example path
            $snapshotAL = $referenceAL->getSnapshot();
            $this->alData = $snapshotAL->getValue();

            $referenceALTresh = $this->database->getReference('AlkalinityLevel/Treshold');  // Example path
            $snapshotALTresh = $referenceALTresh->getSnapshot();
            $this->alTresholdData = $snapshotALTresh->getValue();

            // WATER TEMPERATURE
            $referenceWT = $this->database->getReference('WaterTemperature/Temperature');  // Example path
            $snapshotWT = $referenceWT->getSnapshot();
            $this->wTempData = $snapshotWT->getValue();

            $referenceWTTresh = $this->database->getReference('WaterTemperature/Treshold');  // Example path
            $snapshotWTTresh = $referenceWTTresh->getSnapshot();
            $this->wTempTresholdData = $snapshotWTTresh->getValue();


        } catch (\Exception $e) {
            $this->phData = 'Error: ' . $e->getMessage();
        }
    }

    public function handlePhLevelUpdate($phLevel)
    {
        $this->phData = $phLevel;
    }

    public function handleDoLevelUpdate($doLevel)
    {
        $this->doData = $doLevel;
    }

    public function handleAlLevelUpdate($alLevel)
    {
        $this->alData = $alLevel;
    }

    public function handleWtLevelUpdate($wtLevel)
    {
        $this->wTempData = $wtLevel;
    }

    public function setPHTreshold(Database $database){
        $this->database = $database;
        try {
            // Set pH threshold
            $referencePHTresh = $this->database->getReference('pHLevel/Treshold');
            $thresholdValue = (float) $this->setPHTresholdValue;
            $referencePHTresh->set($thresholdValue); 
            $this->dispatch('reload');
        } catch (\Exception $e) {
            // Handle error
            return response()->json(['error' => 'Error setting data: ' . $e->getMessage()], 500);
        }
    }

    public function setDOTreshold(Database $database){
        $this->database = $database;
        try {
            // Set pH threshold
            $referenceDOTresh = $this->database->getReference('DissolvedOxygen/Treshold');
            $thresholdValue = (float) $this->setDOTresholdValue;
            $referenceDOTresh->set($thresholdValue); 
            $this->dispatch('reload');
        } catch (\Exception $e) {
            // Handle error
            return response()->json(['error' => 'Error setting data: ' . $e->getMessage()], 500);
        }
    }

    public function setALTreshold(Database $database){
        $this->database = $database;
        try {
            // Set pH threshold
            $referenceALTresh = $this->database->getReference('AlkalinityLevel/Treshold');
            $thresholdValue = (float) $this->setALTresholdValue;
            $referenceALTresh->set($thresholdValue); 
            $this->dispatch('reload');
        } catch (\Exception $e) {
            // Handle error
            return response()->json(['error' => 'Error setting data: ' . $e->getMessage()], 500);
        }
    }

    public function setWTTreshold(Database $database){
        $this->database = $database;
        try {
            // Set pH threshold
            $referenceWTTresh = $this->database->getReference('WaterTemperature/Treshold');
            $thresholdValue = (float) $this->setWTTresholdValue;
            $referenceWTTresh->set($thresholdValue); 
            $this->dispatch('reload');
        } catch (\Exception $e) {
            // Handle error
            return response()->json(['error' => 'Error setting data: ' . $e->getMessage()], 500);
        }
    }

    public function render()
    {
        return view('livewire.pages.parameters-monitoring', [
            'pHLevel' => $this->phData,
            'pHTreshold' => $this->phTresholdData,
            'DissolvedOxygen' => $this->doData,
            'DOTreshold' => $this->doTresholdData,
            'AlkalinityLevel' => $this->alData,
            'ALTreshold' => $this->alTresholdData,
            'WaterTemperature' => $this->wTempData,
            'WTTreshold' => $this->wTempTresholdData
        ]);
    }
}
