<?php

namespace App\Livewire\Components;

use App\Models\Notifications;
use App\Models\DeleteNotification;
use Livewire\Component;

class NotificationBell extends Component
{
    public $count = 0;

    protected $listeners = [
        'notificationsRead' => 'resetCount'
    ];

    public function mount()
    {
        $this->updateCount();
    }

    public function updateCount()
    {
        $firebaseCount = Notifications::where('is_read', false)->count();

        $deleteCount = DeleteNotification::where('is_read', false)->count();

        $this->count = $firebaseCount + $deleteCount;
    }

    public function resetCount()
    {
        $this->updateCount();
    }

    public function render()
    {
        $this->updateCount();

        return view('livewire.components.notification-bell');
    }
}