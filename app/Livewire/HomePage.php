<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;
use Kreait\Firebase\Contract\Database;


#[Title('Home')]
class HomePage extends Component
{
    protected Database $database;
    public $data;

    public function mount(Database $database)
    {
        $this->database = $database;
        $this->fetchData();
        
    }

    public function fetchData()
    {
        try {
            $reference = $this->database->getReference('TEST');  // Example path
            $snapshot = $reference->getSnapshot();
            $this->data = $snapshot->getValue();
        } catch (\Exception $e) {
            $this->data = 'Error: ' . $e->getMessage();
        }
    }
    
    public function render()
    {
        return view('livewire.home-page', [
            'data' => $this->data,
        ]);
    }
}
