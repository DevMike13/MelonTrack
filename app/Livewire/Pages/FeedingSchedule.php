<?php

namespace App\Livewire\Pages;

use Filament\Notifications\Notification;
use Livewire\Component;
use Kreait\Firebase\Contract\Database;

class FeedingSchedule extends Component
{
    protected Database $database;
    public $timeOne;
    public $timeTwo;
    public $timeThree;
    public $timeFour;
    public $timeFive;

    public $scheduleState;
    public bool $isActiveSchedule;

    public function mount(Database $database){
        $this->database = $database;
        $this->getFeedingSchedules();
        $this->getScheduleState();
    }

    // FEEDING
    public function getScheduleState()
    {
        try {
            $reference = $this->database->getReference('/ScheduleState');
            $currentData = $reference->getValue();

            // Set the properties based on the retrieved value
            if ($currentData == 'ON') {
                $this->scheduleState = 'ON';
                $this->isActiveSchedule = true;
            } else {
                $this->scheduleState = 'OFF';
                $this->isActiveSchedule = false;
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error retrieving status: ' . $e->getMessage()], 500);
        }
    }

    public function toggleSchedule(Database $database)
    {
        $this->database = $database;
        try {
            $reference = $this->database->getReference('/ScheduleState');
            
            $currentData = $reference->getValue();
            
            if ($currentData == 'OFF') {
                $this->scheduleState = 'ON';
                $this->isActiveSchedule = true;
            } else {
                $this->scheduleState = 'OFF';
                $this->isActiveSchedule = false;
            }

            $reference->set($this->scheduleState);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error toggling status: ' . $e->getMessage()], 500);
        }
    }

    public function getFeedingSchedules()
    {
        try {
            // Fetch multiple references
            $timeOneReference = $this->database->getReference('/Schedule/TimeOne');
            $timeTwoReference = $this->database->getReference('/Schedule/TimeTwo');
            $timeThreeReference = $this->database->getReference('/Schedule/TimeThree');
            $timeFourReference = $this->database->getReference('/Schedule/TimeFour');
            $timeFiveReference = $this->database->getReference('/Schedule/TimeFive');

            $rawTimeOne = $timeOneReference->getValue();
            $rawTimeTwo = $timeTwoReference->getValue();
            $rawTimeThree = $timeThreeReference->getValue();
            $rawTimeFour = $timeFourReference->getValue();
            $rawTimeFive = $timeFiveReference->getValue();

            // Convert raw values to the desired format (e.g., "06:00")
            $this->timeOne = sprintf('%02d:00', $rawTimeOne);
            $this->timeTwo = sprintf('%02d:00', $rawTimeTwo);
            $this->timeThree = sprintf('%02d:00', $rawTimeThree);
            $this->timeFour = sprintf('%02d:00', $rawTimeFour);
            $this->timeFive = sprintf('%02d:00', $rawTimeFive);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error retrieving schedules: ' . $e->getMessage()], 500);
        }
    }


    public function editFeedingScheduleOne(Database $database)
    {
        $this->database = $database;
        try {
            $rawTime = (int)explode(':', $this->timeOne)[0];
           
            $reference = $this->database->getReference('/Schedule/TimeOne');
            $reference->set($rawTime); 

            Notification::make()
                ->title('Success!')
                ->body('Schedule has been saved!')
                ->success()
                ->send();

        } catch (\Exception $e) {
            session()->flash('error', 'Error updating schedule: ' . $e->getMessage());
        }
    }

    public function editFeedingScheduleTwo(Database $database)
    {
        $this->database = $database;
        try {
            $rawTime = (int)explode(':', $this->timeTwo)[0];
           
            $reference = $this->database->getReference('/Schedule/TimeTwo');
            $reference->set($rawTime); 

            Notification::make()
                ->title('Success!')
                ->body('Schedule has been saved!')
                ->success()
                ->send();

        } catch (\Exception $e) {
            session()->flash('error', 'Error updating schedule: ' . $e->getMessage());
        }
    }

    public function editFeedingScheduleThree(Database $database)
    {
        $this->database = $database;
        try {
            $rawTime = (int)explode(':', $this->timeThree)[0];
           
            $reference = $this->database->getReference('/Schedule/TimeThree');
            $reference->set($rawTime); 

            Notification::make()
                ->title('Success!')
                ->body('Schedule has been saved!')
                ->success()
                ->send();

        } catch (\Exception $e) {
            session()->flash('error', 'Error updating schedule: ' . $e->getMessage());
        }
    }

    public function editFeedingScheduleFour(Database $database)
    {
        $this->database = $database;
        try {
            $rawTime = (int)explode(':', $this->timeFour)[0];
           
            $reference = $this->database->getReference('/Schedule/TimeFour');
            $reference->set($rawTime); 

            Notification::make()
                ->title('Success!')
                ->body('Schedule has been saved!')
                ->success()
                ->send();

        } catch (\Exception $e) {
            session()->flash('error', 'Error updating schedule: ' . $e->getMessage());
        }
    }

    public function editFeedingScheduleFive(Database $database)
    {
        $this->database = $database;
        try {
            $rawTime = (int)explode(':', $this->timeFive)[0];
           
            $reference = $this->database->getReference('/Schedule/TimeFive');
            $reference->set($rawTime); 

            Notification::make()
                ->title('Success!')
                ->body('Schedule has been saved!')
                ->success()
                ->send();

        } catch (\Exception $e) {
            session()->flash('error', 'Error updating schedule: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.pages.feeding-schedule');
    }
}
