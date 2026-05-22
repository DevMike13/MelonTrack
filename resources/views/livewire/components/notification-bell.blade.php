<div 
    wire:poll.5s
    x-data 
    x-on:click="$dispatch('toggle-custom-sidebar');" 
    class="relative mr-3 cursor-pointer text-gray-600 hover:text-primary-600 dark:text-gray-300"
    title="Open Notifications"
>
    <x-heroicon-o-bell class="w-5 h-5" />
    @if($count > 0)
        <span 
            class="absolute -top-2 -right-1.5 bg-red-600 text-white text-[8px] font-bold px-1.5 py-0.5 rounded-full"
        >
            {{ $count }}
        </span>
    @endif
</div>
