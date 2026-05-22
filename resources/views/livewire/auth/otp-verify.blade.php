<div class="w-full h-svh flex justify-center items-center">
    <div class="max-w-md mx-auto mt-10 shadow-lg p-10 rounded-xl">
        
        <img src="{{ asset('images/iBroccoGreensLogo.png') }}" alt="" class="h-4 w-auto mx-auto mb-5">
        
        <h2 class="text-lg font-bold text-center mb-5">Verify Your Email</h2>

        <form wire:submit.prevent="verify" class="space-y-4">
            {{-- <input type="text" wire:model="otp" maxlength="6" class="w-full border p-2 rounded" placeholder="Enter OTP"> --}}
            <div class="flex gap-x-3" data-hs-pin-input="">
                @foreach(range(0, 5) as $index)
                    <input type="text" maxlength="1" wire:model.lazy="otp.{{ $index }}" class="block w-9.5 text-center border-gray-200 rounded-md sm:text-sm [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="⚬" data-hs-pin-input-item="">
                @endforeach
            </div>
            @if (session('error'))
                <div class="text-red-500 my-2 flex justify-center items-center italic text-xs">{{ session('error') }}</div>
            @endif
            @if ($resendMessage)
                <div class="text-green-500 my-2 flex justify-center items-center italic text-xs">{{ $resendMessage }}</div>
            @endif
            <button type="submit"
                wire:target="verify"
                wire:loading.attr="disabled"
                class="w-full mx-auto px-4 py-2 bg-green-500 text-white rounded-full flex items-center justify-center text-sm">

                {{-- Show only when not loading --}}
                <span wire:loading.remove wire:target="verify">
                    Verify
                </span>

                {{-- Show spinner and text inline when loading --}}
                <span wire:loading.flex wire:target="verify" class="items-center gap-2">
                    <svg class="w-4 h-4 animate-spin text-white" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                stroke="currentColor" stroke-width="4" />
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8v8H4z" />
                    </svg>
                    Verifying...
                </span>
            </button>

        </form>
        <button wire:click="resendOtp" class="mt-4 text-sm text-blue-600 underline">
            Resend OTP
        </button>
    </div>
</div>