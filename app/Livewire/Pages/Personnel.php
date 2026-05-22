<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Cycles;
use App\Models\Harvests;
use App\Models\Samplings;
use App\Models\Shrimps;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Hash;
use Kreait\Firebase\Contract\Database;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Personnel extends Component
{
    use Actions;
    use WithPagination;

    public $name;
    // public $address;
    public $email;
    public $status = 'Active'; 
    public $password;
    public $password_confirmation;

    public $selectedPersonnelId;
    public $editName;
    public $editEmail;
    public $editStatus = 'Active';

    public function createNewPersonnel(){
        
        $this->validate([ 
            'name' => 'required|max:255',
            'email'=> 'required|email',
            'password' => 'required|min:8|confirmed'
        ]);

        $newPersonnel = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'role' => 'user',
            'password' => Hash::make($this->password),
            'status' => $this->status,
        ]);

        Notification::make()
            ->title('Success!')
            ->body('Personnel has been created.')
            ->success()
            ->send();
        

        $this->dispatch('reload');
        return redirect()->back();
    }

    public function cancelCreate(){
        $this->name = "";
        $this->email = "";
    }

    // EDIT
    public function getSelectedPersonnel($id){
        $personnel = User::findOrFail($id);

        if($personnel && $id){
            $this->selectedPersonnelId = $id;
            $this->editName = $personnel->name;
            $this->editEmail = $personnel->email;
            $this->editStatus = $personnel->status ?? 'Active';
        }
    }

    public function editSelectedPersonnel($id){
        if($this->selectedPersonnelId){
            $this->validate([ 
                'editName' => 'required|max:255',
                'editEmail'=> 'required|email',
            ]);
    
            $personnel = User::findOrFail($id);
    
            $personnel->update([
                'name' => $this->editName,
                'email' => $this->editEmail,
                'status' => $this->editStatus,
            ]);

            Notification::make()
                ->title('Success!')
                ->body('Personnel details has been updated.')
                ->success()
                ->send();

            $this->cancelEdit();
            $this->dispatch('reload');

            return redirect()->back();
        }
    }

    public function editPersonnelConfirmation($id){
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => "Do you want to edit this personnel with ID No. ".  html_entity_decode('<span class="text-red-600 underline">' . $id . '</span>') . " ?",
            'acceptLabel' => 'Yes, update it',
            'method'      => 'editSelectedPersonnel',
            'icon'        => 'error',
            'params'      => $id
        ]);
    }

    public function cancelEdit(){
        $this->editName = "";
        $this->editEmail = "";
    }

    // DELETE
    public function deletePersonnel($id){
        $personnel = User::findOrFail($id);
        $personnel->delete();

        Notification::make()
            ->title('Success!')
            ->body('Personnel has been deleted.')
            ->success()
            ->send();

        $this->dispatch('reload');

        return redirect()->back();
    }

    public function deletePersonnelConfirmation($id, $personnelName){
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => "Do you want to remove this personnel Name: ".  html_entity_decode('<span class="text-red-600 underline">' . $personnelName . '</span>') . " ?",
            'acceptLabel' => 'Yes, delete it',
            'method'      => 'deletePersonnel',
            'icon'        => 'error',
            'params'      => $id
        ]);
    }

    public function approvePersonnel($id)
    {
        $personnel = User::findOrFail($id);

        $personnel->update([
            'is_approved' => true,
        ]);

        Notification::make()
            ->title('Approved!')
            ->body('Personnel account has been approved successfully.')
            ->success()
            ->send();

        $this->dispatch('reload');
        return redirect()->back();
    }

    public function approvePersonnelConfirmation($id, $personnelName)
    {
        $this->dialog()->confirm([
            'title'       => 'Approve Personnel?',
            'description' => "Do you want to approve the account of: " . 
                            html_entity_decode('<span class="text-green-600 underline">' . $personnelName . '</span>') . " ?",
            'acceptLabel' => 'Yes, approve',
            'method'      => 'approvePersonnel',
            'icon'        => 'success',
            'params'      => $id,
        ]);
    }


    public function render()
    {
        // $personnelLists = User::where('role', 'user')->get();
        $personnelLists = User::all();
        return view('livewire.pages.personnel', [
            'personnelLists' => $personnelLists
        ]);
    }
}
