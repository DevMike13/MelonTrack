<?php

namespace App\Livewire\Filament;

use App\Models\Notifications;
use App\Models\DeleteNotification;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CustomNotification extends Component
{
    public $notifications = [];
    public $deleteNotifications = [];

    public function mount()
    {
        $this->loadNotifications();
    }

    public function loadNotifications()
    {
        // EXISTING FIREBASE NOTIFICATIONS
        $this->notifications = Notifications::latest()
            ->take(10)
            ->get();

        // USER DELETE NOTIFICATIONS
        $this->deleteNotifications = DeleteNotification::latest()
            ->take(10)
            ->get();
    }

    public function markNotificationAsRead($id)
    {
        $notification = Notifications::findOrFail($id);

        $notification->update([
            'is_read' => true
        ]);

        $this->loadNotifications();

        $this->dispatch('notificationsRead');
    }

    public function markDeleteNotificationAsRead($id)
    {
        $notification = DeleteNotification::findOrFail($id);

        $notification->update([
            'is_read' => true
        ]);

        $this->loadNotifications();

        $this->dispatch('notificationsRead');
    }

    public function clearAll()
    {
        DB::table('notifications')->delete();

        DeleteNotification::query()->delete();

        $this->notifications = [];
        $this->deleteNotifications = [];

        $this->dispatch('notificationsRead');
    }

    public function render()
    {
        return view('livewire.filament.custom-notification');
    }
}