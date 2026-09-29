<div 
    x-data="{ open: false }"
    x-on:toggle-custom-sidebar.window="open = !open"
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

    {{-- ===================================================== --}}
    {{-- EXISTING FIREBASE NOTIFICATIONS --}}
    {{-- ===================================================== --}}
    @foreach ($notifications as $notification)

        <div
            wire:key="notification-{{ $notification->id }}"
            class="p-3 rounded shadow text-sm
                {{ $notification->is_read
                    ? 'bg-gray-100 dark:bg-gray-800'
                    : 'bg-green-50 border border-green-200 dark:bg-gray-800'
                }}"
        >

            <div class="flex items-start justify-between gap-3">

                <div class="flex-1">

                    <p class="{{ !$notification->is_read ? 'font-semibold' : '' }}">
                        {{ $notification->message }}
                    </p>

                    <span class="block text-xs text-gray-500 mt-1">
                        {{ $notification->created_at->format('M d, Y h:i A') }}
                        -
                        {{ $notification->created_at->diffForHumans() }}
                    </span>

                </div>

                {{-- UNREAD DOT --}}
                @if(!$notification->is_read)
                    <span
                        class="w-2 h-2 bg-green-600 rounded-full flex-shrink-0 mt-2"
                        title="Unread"
                    ></span>
                @endif

            </div>

            {{-- MARK AS READ --}}
            @if(!$notification->is_read)

                <div class="flex justify-end mt-2">

                    <button
                        type="button"
                        wire:click="markNotificationAsRead({{ $notification->id }})"
                        class="text-xs text-[#356744] hover:underline"
                    >
                        Mark as read
                    </button>

                </div>

            @endif

        </div>

    @endforeach


    {{-- ===================================================== --}}
    {{-- USER DELETE NOTIFICATIONS --}}
    {{-- ===================================================== --}}
    @foreach ($deleteNotifications as $notification)

        <div
            wire:key="delete-notification-{{ $notification->id }}"
            class="p-3 rounded shadow text-sm
                {{ $notification->is_read
                    ? 'bg-gray-100 dark:bg-gray-800'
                    : 'bg-green-50 border border-green-200 dark:bg-gray-800'
                }}"
        >

            <div class="flex items-start justify-between gap-3">

                <div class="flex-1">

                    <p class="{{ !$notification->is_read ? 'font-semibold' : '' }}">
                        {{ $notification->message }}
                    </p>

                    <span class="block text-xs text-gray-500 mt-1">
                        {{ $notification->created_at->format('M d, Y h:i A') }}
                        -
                        {{ $notification->created_at->diffForHumans() }}
                    </span>

                </div>

                {{-- UNREAD DOT --}}
                @if(!$notification->is_read)
                    <span
                        class="w-2 h-2 bg-green-600 rounded-full flex-shrink-0 mt-2"
                        title="Unread"
                    ></span>
                @endif

            </div>

            {{-- MARK AS READ --}}
            @if(!$notification->is_read)

                <div class="flex justify-end mt-2">

                    <button
                        type="button"
                        wire:click="markDeleteNotificationAsRead({{ $notification->id }})"
                        class="text-xs text-[#356744] hover:underline"
                    >
                        Mark as read
                    </button>

                </div>

            @endif

        </div>

    @endforeach


    {{-- ===================================================== --}}
        {{-- NO NOTIFICATIONS --}}
        {{-- Only show when BOTH tables are empty --}}
        {{-- ===================================================== --}}
        @if($notifications->isEmpty() && $deleteNotifications->isEmpty())

            <div class="flex flex-col items-center justify-center py-10 text-center">

                <x-heroicon-o-bell-slash
                    class="w-8 h-8 text-gray-400 mb-2"
                />

                <p class="text-sm text-gray-500">
                    No notifications
                </p>

            </div>

        @endif

    </div>
</div>
