<div class="flex items-center gap-3 px-3 py-2 text-sm leading-none">

    <!-- ICON + LABEL -->
    {{-- <div class="flex flex-col items-center justify-center text-center leading-tight min-w-[40px]"> --}}
        <span class="text-3xl leading-none">{{ $icon }}</span>

      
    {{-- </div> --}}

    <!-- TEMP + LOCATION -->
    <div class="flex flex-col justify-center leading-tight">
        <div class="font-medium text-gray-900 dark:text-white leading-none">
            {{ $temp }}°C
        </div>

        <div class="text-[10px] text-gray-500 leading-none">
            Lucban
        </div>

        <div class="text-[8px] text-gray-500 leading-none">
            {{ $label }}
        </div>
    </div>

</div>