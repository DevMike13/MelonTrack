<?php

namespace App\Livewire\Pages;

use App\Exports\FilteredYieldExport;
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

    public $activeTab = 'cycle';

    public $currentCycleNo;
    
    public $cycleNo;
    // public $microgreenType;
    public $startDate;
    public $endDate;
    public $phase;
    public $trays;
    public $notes;
   
    public $selectedCycleId;
    public $editCycleNo;
    // public $editMicrogreenType;
    public $editStartDate;
    public $editEndDate;
    public $editPhase;
    public $editTrays;
    public $editNotes;
    public $status;

    public bool $hasCycle = false;
    public $currentCycleNoForYield;

    // YIELD
    public $currentCycleIDYield;
    public $cycleNoYield;
    public $trayYield;
    public $yieldPerTrayYield;
    public $dateYield;

    public $selectedCycleYieldId;
    public $editCycleNoYield;
    public $editTrayYield;
    public $editYieldPerTrayYield;
    public $editDateYield;

    // FILTER YIELD
    #[Url()]
    public $selectedCycleNoFilter;
    public $cycleNoOptions = [];

    public $filteredYieldLists = [];

    protected $queryString = ['activeTab'];

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
        session(['activeTab' => $tab]);
    }

    public function mount()
    {
        $this->activeTab = session('activeTab', 'cycle');

        $latestCycle = Cycles::latest('cycle_no')->first();

        if ($latestCycle) {
            $this->hasCycle = true;
            $this->currentCycleNoForYield = $latestCycle->cycle_no;
        } else {
            $this->hasCycle = false;
        }

        $this->cycleNoOptions = Cycles::orderBy('cycle_no', 'desc')
            ->get()
            ->map(fn($cycle) => [
                'id' => $cycle->cycle_no,
                'name' => 'Cycle ' . $cycle->cycle_no
            ])
            ->toArray();
        if ($this->selectedCycleNoFilter) {
            $selectedCycle = Cycles::where('cycle_no', $this->selectedCycleNoFilter)->first();

            if ($selectedCycle) {
                $this->filteredYieldLists = YieldTracker::where('cycle_id', $selectedCycle->id)->get();
            } else {
                $this->filteredYieldLists = collect(); 
            }
        } else {
            $currentCycle = Cycles::where('status', 'current')->first();

            if (!$currentCycle) {
                $currentCycle = Cycles::where('status', 'completed')
                    ->orderByDesc('end_date')
                    ->first();
            }

            if ($currentCycle) {
                $this->selectedCycleNoFilter = $currentCycle->cycle_no;
                $this->filteredYieldLists = YieldTracker::where('cycle_id', $currentCycle->id)->get();
            } else {
                $this->filteredYieldLists = collect();
            }
        }
        $this->phase = 'germination';
    }

    public function updatedSelectedCycleNoFilter()
    {
        $selectedCycle = Cycles::where('cycle_no', $this->selectedCycleNoFilter)->first();

        $this->filteredYieldLists = $selectedCycle
            ? YieldTracker::where('cycle_id', $selectedCycle->id)->get()
            : collect();

        $this->dispatch('updateChart', $this->filteredYieldLists);
        $this->dispatch('reload');
    }

    public function getCycleNumber(Database $database){
        $latestCycle = Cycles::latest('cycle_no')->first();
        $this->cycleNo = $latestCycle ? $latestCycle->cycle_no + 1 : 1;

        $this->database = $database;
        $this->fetchFirebaseCurrentCycle();
    }

    public function getCurrentCycleNumber(){

        $latestCycle = Cycles::latest('cycle_no')->first();

        $this->currentCycleNoForYield = $latestCycle->cycle_no;
        $this->currentCycleIDYield = $latestCycle->id;
    }

    public function getCurrentCycleNumberError(){
        Notification::make()
            ->title('Error!')
            ->body('No cycles found. Please create a cycle first.')
            ->danger()
            ->send();
    }

    public function createNewCycle(Database $database){
        
        $this->validate([ 
            'cycleNo' => 'required|integer',
            'startDate' => 'required|date',
            // 'microgreenType' => 'required',
            'phase' => 'required',
            'trays' => 'required|integer'
        ]);

        if ($this->cycleNo > 1) {

            $this->createCycleConfirmation($this->cycleNo);

        } else {
            $this->saveCycle($database);
        }
        

    }

    public function saveCycle(Database $database)
    {
        // Get the latest cycle based on cycle_no
        $previousCycle = Cycles::latest('cycle_no')->first();

        // Check if there is a previous cycle and if it meets the conditions
        if ($previousCycle && $previousCycle->status == 'completed' && $previousCycle->end_date != null) {
            // Create a new cycle
            $newCycle = Cycles::create([
                'cycle_no' => $this->cycleNo,
                // 'microgreen_type' => $this->microgreenType,
                'start_date' => $this->startDate,
                'end_date' => Carbon::parse($this->startDate)->addDays(7),
                'trays' => $this->trays,
                'phase' => $this->phase,
                'notes' => $this->notes,
                'status' => 'current',
            ]);

            $this->database = $database;
            $this->setFirebaseCurrentCycleNo();

            // Success notification
            Notification::make()
                ->title('Success!')
                ->body('Cycle has been created.')
                ->success()
                ->send();
        } 
        // Handle the case where there's no previous cycle or an active cycle exists
        else if (!$previousCycle) {
            // If no previous cycle, create a new cycle directly
            $newCycle = Cycles::create([
                'cycle_no' => $this->cycleNo,
                // 'microgreen_type' => $this->microgreenType,
                'start_date' => $this->startDate,
                'end_date' => Carbon::parse($this->startDate)->addDays(7),
                'trays' => $this->trays,
                'phase' => $this->phase,
                'notes' => $this->notes,
                'status' => 'current',
            ]);

            $this->database = $database;
            $this->setFirebaseCurrentCycleNo();

            Notification::make()
                ->title('Success!')
                ->body('First cycle has been created.')
                ->success()
                ->send();
        } else {
            // Error notification when an active cycle already exists
            Notification::make()
                ->title('Error!')
                ->body("There's an active cycle. Harvest it first before you can create a new cycle.")
                ->danger()
                ->send();
        }

        // Reload the page or component
        $this->dispatch('reload');

        // Redirect back to the previous page
        return redirect()->back();
    }


    public function createCycleConfirmation($newCycleNo){
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => "Do you want to create this cycle No. ".  html_entity_decode('<span class="text-red-600 underline">' . $newCycleNo . '</span>') . " ?",
            'acceptLabel' => 'Yes, create it',
            'method'      => 'saveCycle',
            'icon'        => 'error',
            'params'      => $newCycleNo
        ]);
    }

    public function saveCycleYield()
    {
        $this->validate([ 
            'currentCycleNoForYield' => 'required|integer',
            'trayYield' => 'required|integer',
            'yieldPerTrayYield' => 'required|integer',
            'dateYield' => 'required|date',
        ]);

        $newCycleYield = YieldTracker::create([
            'cycle_id' => $this->currentCycleIDYield,
            'cycle_no' => $this->currentCycleNoForYield,
            'tray' => $this->trayYield,
            'yield_per_tray' => $this->yieldPerTrayYield,
            'date' => $this->dateYield,
        ]);

        Notification::make()
            ->title('Success!')
            ->body('Cycle Yield has been created.')
            ->success()
            ->send();
       
        $this->dispatch('reload');

        return redirect()->back();
    }

    public function getSelectedCycle($id){
        $cycle = Cycles::findOrFail($id);

        if($cycle && $id){
            $this->selectedCycleId = $id;
            $this->editCycleNo = $cycle->cycle_no;
            $this->editStartDate = $cycle->start_date;
            // $this->editMicrogreenType = $cycle->microgreen_type;
            $this->editEndDate = $cycle->end_date;
            $this->editTrays = $cycle->trays;
            $this->editPhase = $cycle->phase;
            $this->editNotes = $cycle->notes;
            $this->status = $cycle->status;
            
        }
    }

    public function editSelectedCycle($id){
        if($this->selectedCycleId){
            $this->validate([
                'editCycleNo' => 'required|integer',
                'editStartDate' => 'required|date',
                // 'editMicrogreenType'  => 'required',
                // 'editEndDate' => 'nullable|date',
                'editTrays' => 'required|integer',
                'editPhase' => 'required',
                // 'editNotes' => 'required',
                'status' => 'required',
            ]);
    
            $cycle = Cycles::findOrFail($id);

            // $endDate = $this->status === 'completed'
            //     ? now()->format('Y-m-d') 
            //     : $this->editEndDate;
    
            $cycle->update([
                // 'microgreen_type' => $this->editMicrogreenType,
                'start_date' => $this->editStartDate,
                // 'end_date' => $endDate,
                'trays' => $this->editTrays,
                'phase' => $this->editPhase,
                'notes' => $this->editNotes,
                'status' => $this->status
            ]);

            Notification::make()
                ->title('Success!')
                ->body('Cycle has been updated.')
                ->success()
                ->send();

            $this->cancelEdit();
            $this->dispatch('reload');

            return redirect()->back();
        }
    }

    public function editCycleConfirmation($id){
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => "Do you want to edit this cycle with ID No. ".  html_entity_decode('<span class="text-red-600 underline">' . $id . '</span>') . " ?",
            'acceptLabel' => 'Yes, update it',
            'method'      => 'editSelectedCycle',
            'icon'        => 'error',
            'params'      => $id
        ]);
    }

    public function getSelectedCycleYield($id){
        $cycleYield = YieldTracker::findOrFail($id);

        if($cycleYield && $id){
            $this->selectedCycleYieldId = $id;
            $this->editCycleNoYield = $cycleYield->cycle_no;
            $this->editTrayYield = $cycleYield->tray;
            $this->editYieldPerTrayYield = $cycleYield->yield_per_tray;
            $this->editDateYield = $cycleYield->date;
        }
    }

    public function editSelectedYield($id){
        if($this->selectedCycleYieldId){
            $this->validate([
                'editCycleNoYield' => 'required|integer',
                'editTrayYield' => 'required|integer',
                'editYieldPerTrayYield'  => 'required',
                'editDateYield' => 'nullable|date',
            ]);
    
            $yield = YieldTracker::findOrFail($id);

            $yield->update([
                'cycle_no' => $this->editCycleNoYield,
                'tray' => $this->editTrayYield,
                'yield_per_tray' => $this->editYieldPerTrayYield,
                'date' => $this->editDateYield
            ]);

            Notification::make()
                ->title('Success!')
                ->body('Yield has been updated.')
                ->success()
                ->send();

            $this->cancelEditYield();
            $this->dispatch('reload');

            return redirect()->back();
        }
    }

    public function editYieldConfirmation($id){
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => "Do you want to edit this yield with ID No. ".  html_entity_decode('<span class="text-red-600 underline">' . $id . '</span>') . " ?",
            'acceptLabel' => 'Yes, update it',
            'method'      => 'editSelectedYield',
            'icon'        => 'error',
            'params'      => $id
        ]);
    }

    public function cancelEdit(){
        $this->selectedCycleId = "";
        $this->editCycleNo = "";
        $this->editStartDate = "";
        $this->editEndDate = "";
        // $this->editMicrogreenType = "";
        $this->editTrays = "";
        $this->editPhase = "";
        $this->editNotes = "";
        $this->status = "";
    }

    public function cancelEditYield(){
        $this->selectedCycleYieldId = "";
        $this->editCycleNoYield = "";
        $this->editTrayYield = "";
        $this->editYieldPerTrayYield = "";
        $this->editDateYield = "";
    }

    public function closeGraphModal(){
        $this->dispatch('reload');
    }

    public function deleteCycle($id){
        $cycle = Cycles::findOrFail($id);
        $cycle->delete();

        Notification::make()
            ->title('Success!')
            ->body('Cycle has been deleted.')
            ->success()
            ->send();

        $this->dispatch('reload');

        return redirect()->back();
    }

    public function deleteYield($id){
        $yield = YieldTracker::findOrFail($id);
        $yield->delete();

        Notification::make()
            ->title('Success!')
            ->body('Yield has been deleted.')
            ->success()
            ->send();

        $this->dispatch('reload');

        return redirect()->back();
    }

    public function deleteYieldConfirmation($id, $cycleNo){
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => "Do you want to delete this yield with Cycle No. ".  html_entity_decode('<span class="text-red-600 underline">' . $cycleNo . '</span>') . " ?",
            'acceptLabel' => 'Yes, delete it',
            'method'      => 'deleteYield',
            'icon'        => 'error',
            'params'      => $id, $cycleNo
        ]);
    }

    public function deleteCycleConfirmation($id, $cycleNo){
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => "Do you want to delete this cycle with Cycle No. ".  html_entity_decode('<span class="text-red-600 underline">' . $cycleNo . '</span>') . " ? This will delete all data such as yield data.",
            'acceptLabel' => 'Yes, delete it',
            'method'      => 'deleteCycle',
            'icon'        => 'error',
            'params'      => $id
        ]);
    }

    public function fetchFirebaseCurrentCycle()
    {
        try {
            $reference = $this->database->getReference('/CurrentCycleNo');
            $snapshot = $reference->getSnapshot();
            $this->currentCycleNo = $snapshot->getValue();

        } catch (\Exception $e) {
            $this->currentCycleNo = 'Error: ' . $e->getMessage();
        }
    }

    public function setFirebaseCurrentCycleNo(){
        try {
            $referenceCycle = $this->database->getReference('/CurrentCycleNo');
            $cycleValue = (int) $this->cycleNo;
            $referenceCycle->set($cycleValue); 

            $startDate = Carbon::parse($this->startDate);

            $this->database->getReference('/CycleStartMonth')->set($startDate->format('m'));
            $this->database->getReference('/CycleStartDay')->set($startDate->format('d'));
            $this->database->getReference('/CycleStartYear')->set($startDate->format('Y'));

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error setting data: ' . $e->getMessage()], 500);
        }
    }

    public function exportYieldsExcel()
    {
        $cycleNo = $this->selectedCycleNoFilter ?? 'Unknown';
        $date = Carbon::now()->format('Ymd_His');
        $fileName = 'yield_cycle_' . $cycleNo . '_' . $date . '.xlsx';
        return Excel::download(new FilteredYieldExport($this->filteredYieldLists), $fileName);
    }

    public function exportYieldsCsv()
    {
        return Excel::download(new FilteredYieldExport($this->filteredYieldLists), 'filtered_yields.csv', \Maatwebsite\Excel\Excel::CSV);
    }
        
    public function render()
    {
        $cycleLists = Cycles::orderBy('cycle_no', 'desc')->get();

        $yieldSums = YieldTracker::selectRaw('cycle_no, SUM(yield_per_tray) as total_yield')
            ->groupBy('cycle_no')
            ->orderBy('cycle_no')
            ->get();
        
        return view('livewire.pages.cycle-details', [
            'cycleLists' => $cycleLists,
            'yieldLists' => $this->filteredYieldLists,
            'yieldSums'  => $yieldSums,
        ]);
    }
}
