<div 
    x-data="{ open: false }"
    x-on:toggle-custom-sidebar.window="
        open = !open;
        if (open) {
            $nextTick(() => {
                $wire.markAsRead().then(() => {
                    Livewire.dispatch('notificationsRead');
                });
            });
        }
    "
    x-show="open"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 translate-x-full"
    x-transition:enter-end="opacity-100 translate-x-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-x-0"
    x-transition:leave-end="opacity-0 translate-x-full"
    x-cloak
    class="fixed top-0 right-0 z-[9999] w-full max-w-[500px] h-screen bg-white dark:bg-gray-900 shadow-xl border-l"
>
    <div class="p-4 flex justify-between items-center border-b">
        <h2 class="text-lg font-semibold">Notifications</h2>
        <div class="flex items-center gap-2">
            <button 
                wire:click="clearAll" 
                class="text-xs text-red-600 hover:underline"
            >
                Clear All
            </button>
            <button @click="open = false">
                <x-heroicon-o-x-mark class="w-5 h-5" />
            </button>
        </div>
    </div>
    <div class="p-4 space-y-3 overflow-y-auto h-[calc(100%-64px)]">
        @forelse ($notifications as $notification)
            <div class="bg-gray-100 dark:bg-gray-800 p-3 rounded shadow text-sm">
                {{ $notification->message }}
                <span class="block text-xs text-gray-500 mt-1">
                    {{ $notification->created_at->format('M d, Y h:i A') }} - 
                    {{ $notification->created_at->diffForHumans() }}
                </span>
            </div>
        @empty
            <p class="text-sm text-gray-500">No notifications</p>
        @endforelse
    </div>
</div>
