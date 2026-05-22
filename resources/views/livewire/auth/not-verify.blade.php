<div class="w-full h-svh flex justify-center items-center">
    <div class="max-w-lg lg:min-w-lg mx-auto mt-10 shadow-lg p-10 rounded-xl">
        
        <img src="{{ asset('images/iBroccoGreensLogo.png') }}" alt="" class="h-4 w-auto mx-auto mb-5">
        
        <h2 class="text-lg font-bold text-center mb-5">Verify Your Account</h2>

        <form wire:submit.prevent="sendOTP" class="space-y-4">
            <input type="text" wire:model="email" class="border w-64 p-2 rounded-lg text-sm" placeholder="Enter Email Address">
           
            @error('email')
                <div class="text-red-500 text-xs italic mt-1 text-center">{{ $message }}</div>
            @enderror
    
            <button type="submit"
                wire:target="sendOTP"
                wire:loading.attr="disabled"
                class="w-full mx-auto px-4 py-2 bg-green-500 text-white rounded-full flex items-center justify-center text-sm">

                {{-- Show only when not loading --}}
                <span wire:loading.remove wire:target="sendOTP">
                    Send OTP
                </span>

                {{-- Show spinner and text inline when loading --}}
                <span wire:loading.flex wire:target="sendOTP" class="items-center gap-2">
                    <svg class="w-4 h-4 animate-spin text-white" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                stroke="currentColor" stroke-width="4" />
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8v8H4z" />
                    </svg>
                    Sending OTP...
                </span>
            </button>
        </form>
    </div>
</div>