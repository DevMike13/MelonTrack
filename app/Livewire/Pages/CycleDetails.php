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
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
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


    // CREATION PROPERTIES (Changed naming keys to resolve collisions)
    public $newMilestoneTitle;
    public $newMilestoneType;
    public $newMilestoneScheduledDate;
    public $newMilestoneCompleted = false;
    public $newMilestoneCompletedDate;

    // EDIT PROPERTIES
    public $selectedMilestoneId;
    public $editMilestoneTitle;
    public $editMilestoneType;
    public $editMilestoneDate;
    public $editMilestoneCompleted = false;
    public $editMilestoneCompletedDate;


    public $harvestCount;
    public $editHarvestCount;

    public $selectedCycleDetails;

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

    public function updatedNewMilestoneType()
    {
        $this->newMilestoneTitle =
            'Milestone by ' . auth()->user()->name . ' - ' .
            ucwords(str_replace('_', ' ', $this->newMilestoneType));
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
        $cycle = Cycles::findOrFail($id);

        Cycles::withoutEvents(function () use ($cycle) {
            $cycle->delete();
        });

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


    // COMPLETED CYCLES ONLY: update without syncing historical data to /active_cycle in Firebase
    public function updateCompletedCycle()
    {
        $this->validate();

        $cycle = Cycles::whereIn('status', [
            'completed',
            'harvested',
            'cancelled'
        ])->findOrFail($this->selectedCycleId);

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

        Notification::make()
            ->title('Updated')
            ->body('Completed cycle updated successfully.')
            ->success()
            ->send();
    }

    // COMPLETED CYCLES ONLY
    public function deleteCompletedCycle($id)
    {
        $cycle = Cycles::whereIn('status', [
            'completed',
            'harvested',
            'cancelled'
        ])->findOrFail($id);

        Cycles::withoutEvents(function () use ($cycle) {
            $cycle->delete();
        });

        Notification::make()
            ->title('Deleted')
            ->body('Completed cycle deleted successfully.')
            ->success()
            ->send();
    }

    public function deleteCompletedCycleConfirmation($id, $code)
    {
        $this->dialog()->confirm([
            'title' => 'Delete Completed Cycle?',
            'description' => "Delete completed cycle {$code} permanently?",
            'acceptLabel' => 'Yes delete',
            'method' => 'deleteCompletedCycle',
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
        $this->newMilestoneTitle = null;
        $this->newMilestoneType = null;
        $this->newMilestoneScheduledDate = null;
        $this->newMilestoneCompleted = false;
        $this->newMilestoneCompletedDate = null;

        $this->selectedMilestoneId = null;
        $this->editMilestoneTitle = null;
        $this->editMilestoneType = null;
        $this->editMilestoneDate = null;
        $this->editMilestoneCompleted = false;
        $this->editMilestoneCompletedDate = null;
    }

    public function createMilestone()
    {
        // Keep your custom logic check
        $hasUncompletedMilestone = CycleMilestone::where('cycle_id', $this->selectedCycleId)
            ->where('completed', false)
            ->exists();

        if ($hasUncompletedMilestone) {
            Notification::make()
                ->title('Action Blocked')
                ->body('You cannot add a new milestone while there is an uncompleted milestone in this cycle.')
                ->danger()
                ->send();

            return;
        }

        $cycle = Cycles::findOrFail($this->selectedCycleId);
    
        $startDate = $cycle->planting_date ? Carbon::parse($cycle->planting_date)->startOfDay() : null;
        // Fallback to actual harvest date if expected harvest date isn't populated yet
        $endDate = Carbon::parse($cycle->actual_harvest_date ?? $cycle->expected_harvest_date)->endOfDay();

        try {
            $this->validate([
                'newMilestoneTitle'         => 'required|string',
                'newMilestoneType'          => 'required',
                'newMilestoneScheduledDate' => [
                    'required',
                    'date',
                    function ($attribute, $value, $fail) use ($startDate, $endDate) {
                        $date = Carbon::parse($value);
                        if ($startDate && $date->lt($startDate)) {
                            $fail("The scheduled date cannot be before the cycle's planting date (" . $startDate->format('Y-m-d') . ").");
                        }
                        if ($date->gt($endDate)) {
                            $fail("The scheduled date cannot be after the cycle's harvest date (" . $endDate->format('Y-m-d') . ").");
                        }
                    }
                ],
                'newMilestoneCompletedDate' => [
                    Rule::requiredIf($this->newMilestoneCompleted), 
                    'nullable', 
                    'date',
                    function ($attribute, $value, $fail) use ($startDate, $endDate) {
                        if (!$value) return;
                        $date = Carbon::parse($value);
                        if ($startDate && $date->lt($startDate)) {
                            $fail("The completion date cannot be before the cycle's planting date (" . $startDate->format('Y-m-d') . ").");
                        }
                        if ($date->gt($endDate)) {
                            $fail("The completion date cannot be after the cycle's harvest date (" . $endDate->format('Y-m-d') . ").");
                        }
                    }
                ],
                'harvestCount' => [
                    Rule::requiredIf($this->newMilestoneType === 'harvest' && $this->newMilestoneCompleted),
                    'nullable',
                    'integer',
                    'min:1',
                ],
            ], [
                'newMilestoneCompletedDate.required' => 'The completion date is required when marked as completed.',
                'harvestCount.required' => 'The total harvested melons is required for harvest milestones.',
            ]);
        } catch (ValidationException $e) {
            Notification::make()
                ->title('Validation Error')
                ->body(collect($e->validator->errors()->all())->first())
                ->danger()
                ->send();

            throw $e;
        }

        $milestone = CycleMilestone::create([
            'cycle_id'       => $this->selectedCycleId,
            'title'          => $this->newMilestoneTitle,
            'type'           => $this->newMilestoneType,
            'scheduled_date' => $this->newMilestoneScheduledDate,
            'completed'      => $this->newMilestoneCompleted,
            'completed_date' => $this->newMilestoneCompleted ? $this->newMilestoneCompletedDate : null,
        ]);

        if ($this->newMilestoneType === 'harvest' && $this->newMilestoneCompleted) {
            Harvests::updateOrCreate(
                [
                    'cycle_id' => $milestone->cycle_id,
                    'date_harvested' => $this->newMilestoneCompletedDate,
                ],
                [
                    'harvest_count' => $this->harvestCount,
                    'status' => 'completed',
                ]
            );

            $cycle->update([
                'status' => 'completed',
                'actual_harvest_date' => $this->newMilestoneCompletedDate,
                'overall_progress' => 100,
                'fruit_progress' => 100,
            ]);
        }

        $this->resetMilestoneFields();

        Notification::make()
            ->title('Success')
            ->body('Milestone created successfully.')
            ->success()
            ->send();
    }

    public function editMilestone($milestoneId)
    {
        $milestone = CycleMilestone::findOrFail($milestoneId);

        $this->selectedMilestoneId = $milestone->id;
        $this->selectedCycleId = $milestone->cycle_id;
        $this->editMilestoneTitle = $milestone->title;
        $this->editMilestoneType = $milestone->type;
        $this->editMilestoneDate = \Carbon\Carbon::parse($milestone->scheduled_date)->format('Y-m-d');
        $this->editMilestoneCompleted = (bool)$milestone->completed;
        $this->editMilestoneCompletedDate = $milestone->completed_date 
            ? \Carbon\Carbon::parse($milestone->completed_date)->format('Y-m-d') 
            : null;
    }

    public function updateMilestone()
    {
        $milestone = CycleMilestone::findOrFail($this->selectedMilestoneId);
        
        // Fetch the cycle related to this milestone record
        $cycle = Cycles::findOrFail($this->selectedCycleId);
        
        $startDate = $cycle->planting_date ? Carbon::parse($cycle->planting_date)->startOfDay() : null;
        $endDate = Carbon::parse($cycle->actual_harvest_date ?? $cycle->expected_harvest_date)->endOfDay();
        try {
            $this->validate([
                'editMilestoneTitle' => 'required|string',
                'editMilestoneType'  => 'required',
                'editMilestoneDate'  => [
                    'required',
                    'date',
                    function ($attribute, $value, $fail) use ($startDate, $endDate) {
                        $date = Carbon::parse($value);
                        if ($startDate && $date->lt($startDate)) {
                            $fail("The scheduled date cannot be before the cycle's planting date (" . $startDate->format('Y-m-d') . ").");
                        }
                        if ($date->gt($endDate)) {
                            $fail("The scheduled date cannot be after the cycle's harvest date (" . $endDate->format('Y-m-d') . ").");
                        }
                    }
                ],
                'editMilestoneCompletedDate' => [
                    'required_if:editMilestoneCompleted,true',
                    'nullable',
                    'date',
                    function ($attribute, $value, $fail) use ($startDate, $endDate) {
                        if (!$value) return;
                        $date = Carbon::parse($value);
                        if ($startDate && $date->lt($startDate)) {
                            $fail("The completion date cannot be before the cycle's planting date (" . $startDate->format('Y-m-d') . ").");
                        }
                        if ($date->gt($endDate)) {
                            $fail("The completion date cannot be after the cycle's harvest date (" . $endDate->format('Y-m-d') . ").");
                        }
                    }
                ],
                'editHarvestCount' => [
                    Rule::requiredIf($this->editMilestoneType === 'harvest' && $this->editMilestoneCompleted),
                    'nullable',
                    'integer',
                    'min:1',
                ],
            ], [
                'editMilestoneCompletedDate.required_if' => 'The completion date is required when marked as completed.',
                'editHarvestCount.required' => 'The total harvested melons is required for harvest milestones.',
            ]);
        } catch (ValidationException $e) {

            Notification::make()
                ->title('Validation Error')
                ->body(collect($e->validator->errors()->all())->first())
                ->danger()
                ->send();

            throw $e;
        }

        $milestone->update([
            'title'          => $this->editMilestoneTitle,
            'type'           => $this->editMilestoneType,
            'scheduled_date' => $this->editMilestoneDate,
            'completed'      => $this->editMilestoneCompleted,
            'completed_date' => $this->editMilestoneCompleted ? $this->editMilestoneCompletedDate : null,
        ]);

        if ($this->editMilestoneType === 'harvest' && $this->editMilestoneCompleted) {
            Harvests::updateOrCreate(
                [
                    'cycle_id' => $milestone->cycle_id,
                    'date_harvested' => $this->editMilestoneCompletedDate,
                ],
                [
                    'harvest_count' => $this->editHarvestCount,
                    'status' => 'completed',
                ]
            );

            $cycle->update([
                'status' => 'completed',
                'actual_harvest_date' => $this->editMilestoneCompletedDate,
                'overall_progress' => 100,
                'fruit_progress' => 100,
            ]);
        }

        $this->resetMilestoneFields();

        Notification::make()
            ->title('Updated')
            ->body('Milestone updated successfully.')
            ->success()
            ->send();
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
        return view('livewire.pages.cycle-details', [
            'cycleLists' => Cycles::with('milestones')->latest()->get(),
            'activeCycle' => $this->activeCycle,
            'completedCycles' => $this->completedCycles,
        ]);
    }
}
