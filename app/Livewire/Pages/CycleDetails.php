<?php

namespace App\Livewire\Pages;

use App\Exports\FilteredYieldExport;
use App\Models\BrixReading;
use App\Models\CycleMilestone;
use App\Models\Cycles;
use App\Models\Harvests;
use App\Models\Shrimps;
use App\Models\YieldTracker;
use Carbon\Carbon;
use Filament\Notifications\Notification;
use Kreait\Firebase\Contract\Database;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use WireUi\Traits\Actions;

class CycleDetails extends Component
{
    use Actions;
    use WithPagination;
    protected Database $database;

    public $cycleCode;
    public $cropVariety = 'Muskmelon';
    public $plantingDate;
    public $expectedHarvestDate;
    public $actualHarvestDate;

    public $growthStage;
    public $status = 'planned';

    public $overallProgress = 0;
    public $fruitProgress = 0;

    public $currentBrix;
    public $finalBrix;

    public $yieldKg;
    public $yieldRate;

    public $notes;

    public $selectedCycleId;

    public $editCycleId;

    public $brixList = [];
    public $brixLevel;
    public $readingAt;
    public $remarks;

    public $selectedBrixId;
    public $editBrixLevel;
    public $editReadingAt;
    public $editRemarks;

    public $currentCycleCodeForBrix;
    public $currentCycleIdForBrix;


    // MILISTONE
    public $milestoneTitle;
    public $milestoneType;
    public $milestoneDate;
    public $milestoneCompleted = false;
    public $milestoneCompletedDate;

    public function mount()
    {
        $this->activeTab = session('activeTab', 'cycle');
    }

    protected function rules()
    {
        return [
            'cycleCode' => 'required',
            'cropVariety' => 'required',
            'plantingDate' => 'required|date',
            'growthStage' => 'required',
            'status' => 'required',
        ];
    }

    public function createCycle(Database $database)
    {
        if ($this->hasActiveCycle()) {
            Notification::make()
                ->title('Cannot Create Cycle')
                ->body('There is already an active cycle in progress.')
                ->danger()
                ->send();

            return;
        }
        
        $this->validate();

        $cycle = Cycles::create([
            'cycle_code' => $this->cycleCode,
            'crop_variety' => $this->cropVariety,
            'planting_date' => $this->plantingDate,
            'expected_harvest_date' => $this->expectedHarvestDate,
            'actual_harvest_date' => $this->actualHarvestDate,
            'growth_stage' => $this->growthStage,
            'status' => $this->status,
            'overall_progress' => $this->overallProgress,
            'fruit_progress' => $this->fruitProgress,
            'current_brix' => $this->currentBrix,
            'final_brix' => $this->finalBrix,
            'yield_kg' => $this->yieldKg,
            'yield_rate' => $this->yieldRate,
            'notes' => $this->notes,
        ]);

        $this->database = $database;

        $this->syncCycleToFirebase($cycle);

        Notification::make()
            ->title('Success')
            ->body('Cycle created successfully.')
            ->success()
            ->send();

        // $this->resetForm();
    }

    public function getSelectedCycle($id)
    {
        $cycle = Cycles::findOrFail($id);

        $this->selectedCycleId = $cycle->id;

        $this->cycleCode = $cycle->cycle_code;
        $this->cropVariety = $cycle->crop_variety;
        $this->plantingDate = $cycle->planting_date?->format('Y-m-d');
        $this->expectedHarvestDate = $cycle->expected_harvest_date?->format('Y-m-d');
        $this->actualHarvestDate = $cycle->actual_harvest_date?->format('Y-m-d');

        $this->growthStage = $cycle->growth_stage;
        $this->status = $cycle->status;

        $this->overallProgress = $cycle->overall_progress;
        $this->fruitProgress = $cycle->fruit_progress;

        $this->currentBrix = $cycle->current_brix;
        $this->finalBrix = $cycle->final_brix;

        $this->yieldKg = $cycle->yield_kg;
        $this->yieldRate = $cycle->yield_rate;

        $this->notes = $cycle->notes;
    }

    public function hasActiveCycle(): bool
    {
        return Cycles::whereIn('status', [
            'ongoing',
            'ready_for_harvest',
            'planned'
        ])->exists();
    }
    
    public function updateCycle(Database $database)
    {
        $this->validate();

        $cycle = Cycles::findOrFail($this->selectedCycleId);

        $cycle->update([
            'cycle_code' => $this->cycleCode,
            'crop_variety' => $this->cropVariety,
            'planting_date' => $this->plantingDate,
            'expected_harvest_date' => $this->expectedHarvestDate,
            'actual_harvest_date' => $this->actualHarvestDate,
            'growth_stage' => $this->growthStage,
            'status' => $this->status,
            'overall_progress' => $this->overallProgress,
            'fruit_progress' => $this->fruitProgress,
            'current_brix' => $this->currentBrix,
            'final_brix' => $this->finalBrix,
            'yield_kg' => $this->yieldKg,
            'yield_rate' => $this->yieldRate,
            'notes' => $this->notes,
        ]);

        $this->database = $database;

        $this->syncCycleToFirebase($cycle->fresh());

        Notification::make()
            ->title('Updated')
            ->body('Cycle updated successfully.')
            ->success()
            ->send();
    }


    public function deleteCycle($id)
    {
        Cycles::findOrFail($id)->delete();

        Notification::make()
            ->title('Deleted')
            ->body('Cycle deleted successfully.')
            ->success()
            ->send();
    }

    public function deleteCycleConfirmation($id, $code)
    {
        $this->dialog()->confirm([
            'title' => 'Delete Cycle?',
            'description' => "Delete cycle {$code} permanently?",
            'acceptLabel' => 'Yes delete',
            'method' => 'deleteCycle',
            'params' => $id
        ]);
    }

    public function openBrixModal($cycleId, $cycleCode)
    {
        $this->currentCycleIdForBrix = $cycleId;
        $this->currentCycleCodeForBrix = $cycleCode;

        $this->loadBrixList($cycleId);
    }

    public function loadBrixList($cycleId)
    {
        $this->brixList = BrixReading::where('cycle_id', $cycleId)
            ->latest()
            ->get();
    }

    public function getLatestBrixReadingProperty()
    {
        return BrixReading::where('cycle_id', $this->activeCycle?->id)
            ->latest('reading_at')
            ->first();
    }

    public function getRecentBrixReadingsProperty()
    {
        $cycleId = $this->activeCycle?->id;

        $latestId = BrixReading::where('cycle_id', $cycleId)
            ->latest('reading_at')
            ->value('id');

        return BrixReading::where('cycle_id', $cycleId)
            ->when($latestId, fn ($q) => $q->where('id', '!=', $latestId))
            ->latest('reading_at')
            ->get();
    }

    public function saveBrix()
    {
        $this->validate([
            'brixLevel' => 'required|numeric',
            'readingAt' => 'required|date',
        ]);

        BrixReading::create([
            'cycle_id' => $this->currentCycleIdForBrix,
            'brix_level' => $this->brixLevel,
            'reading_at' => Carbon::parse($this->readingAt)->timezone('Asia/Manila'),
            'remarks' => $this->remarks,
        ]);

        // 🔥 Always update latest cycle Brix
        $latestBrix = BrixReading::where('cycle_id', $this->currentCycleIdForBrix)
            ->latest()
            ->first();

        Cycles::where('id', $this->currentCycleIdForBrix)
            ->update([
                'current_brix' => $latestBrix?->brix_level
            ]);

        $this->loadBrixList($this->currentCycleIdForBrix);

        $this->reset(['brixLevel', 'readingAt', 'remarks']);

        Notification::make()
            ->title('Saved')
            ->body('Brix reading added successfully.')
            ->success()
            ->send();
    }

    public function deleteBrix($id)
    {
        $brix = BrixReading::findOrFail($id);
        $cycleId = $brix->cycle_id;

        $brix->delete();

        // update latest after delete
        $latest = BrixReading::where('cycle_id', $cycleId)
            ->latest()
            ->first();

        Cycles::where('id', $cycleId)
            ->update([
                'current_brix' => $latest?->brix_level
            ]);

        $this->loadBrixList($cycleId);

        Notification::make()
            ->title('Deleted')
            ->body('Brix removed.')
            ->success()
            ->send();
    }

    public function getSelectedBrix($id)
    {
        $brix = BrixReading::findOrFail($id);

        $this->selectedBrixId = $brix->id;
        $this->editBrixLevel = $brix->brix_level;
        $this->editReadingAt = $brix->reading_at;
        $this->editRemarks = $brix->remarks;
    }

    public function updateBrix()
    {
        $brix = BrixReading::findOrFail($this->selectedBrixId);

        $brix->update([
            'brix_level' => $this->editBrixLevel,
            'reading_at' => $this->editReadingAt,
            'remarks' => $this->editRemarks,
        ]);

        $this->loadBrixList($brix->cycle_id);

        Notification::make()
            ->title('Updated')
            ->body('Brix updated.')
            ->success()
            ->send();
    }


    public function deleteBrixConfirmation($id)
    {
        $this->dialog()->confirm([
            'title' => 'Delete Brix?',
            'description' => 'This will remove the reading.',
            'method' => 'deleteBrix',
            'params' => $id
        ]);
    }

    public function syncCycleToFirebase($cycle)
    {
        try {

            $this->database
                ->getReference('/active_cycle')
                ->set([

                    'id' => $cycle->id,

                    'cycle_code' => $cycle->cycle_code,

                    'crop_variety' => $cycle->crop_variety,

                    'planting_date' => $cycle->planting_date?->format('Y-m-d'),

                    'growth_stage' => $cycle->growth_stage,

                    'status' => $cycle->status,

                    'overall_progress' => $cycle->overall_progress,

                    'fruit_progress' => $cycle->fruit_progress,

                    'current_brix' => $cycle->current_brix,

                    'updated_at' => now()->toDateTimeString()

                ]);

        } catch (\Exception $e) {

            Notification::make()
                ->title('Firebase Error')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    public function getActiveCycleProperty()
    {
        return Cycles::whereIn('status', [
            'ongoing',
            'ready_for_harvest',
            'planned'
        ])->latest()->first();
    }

    public function getCompletedCyclesProperty()
    {
        return Cycles::whereIn('status', [
            'completed',
            'harvested',
            'cancelled'
        ])
        ->latest()
        ->get();
    }

    public function openMilestoneModal($cycleId)
    {
        $this->resetMilestoneFields();

        $this->selectedCycleId = $cycleId;
    }

    private function resetMilestoneFields()
    {
        $this->milestoneTitle = null;
        $this->milestoneType = null;
        $this->milestoneDate = null;
        $this->milestoneCompleted = false;
        $this->milestoneCompletedDate = null;
    }

    public function createMilestone()
    {
        $this->validate([
            'milestoneTitle' => 'required|string',
            'milestoneType' => 'required',
            'milestoneDate' => 'required|date',
        ]);

        CycleMilestone::create([
            'cycle_id' => $this->selectedCycleId,
            'title' => $this->milestoneTitle,
            'type' => $this->milestoneType,
            'scheduled_date' => $this->milestoneDate,
            'completed' => $this->milestoneCompleted,
            'completed_date' => $this->milestoneCompletedDate,
        ]);

        $this->resetMilestoneFields();
    }

    public function render()
    {
        return view('livewire.pages.cycle-details', [
            'cycleLists' => Cycles::with('milestones')->latest()->get(),
            'activeCycle' => $this->activeCycle,
            'completedCycles' => $this->completedCycles,
        ]);
    }
}
