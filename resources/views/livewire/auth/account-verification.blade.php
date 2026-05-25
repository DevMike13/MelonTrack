<div class="relative flex justify-center h-auto">
    {{-- DESKTOP --}}
    <div class="relative w-full justify-center h-fit min-h-screen hidden md:flex flex-col gap-10">
        <div class="w-full flex justify-center h-auto z-10">
            {{-- LEFT --}}
            <div class="w-1/2 relative">
                <div class="w-full flex flex-col items-center gap-6 text-center mt-10 px-10">
                    <div class="flex justify-center items-center gap-3">
                        <img src="{{ asset('images/Logo_MelonTrack.png') }}" alt="Logo" class="w-20 h-20 object-contain">
                        <div>
                            <h1 class="text-[2.8rem] font-semibold text-[#316943]">
                                MelonTrack
                            </h1>
                            <p class="-mt-3">Smart Melon Monitoring System</p>
                        </div>
                    </div>

                    <div class="flex flex-col justify-center items-center gap-3">
                        
                        <h1 class="text-[2rem] font-semibold ">
                            Verify your <span class="text-[#316943]">Account</span>
                        </h1>
                        <p class="-mt-3 text-xs ">Your smarter way to monitor, analyze, and maximize melon growth and quality in real-time.</p>
                        
                    </div>

                    <div class="relative w-full max-w-lg my-4">
                        <hr class="border-[#316943] w-full" />

                        <img 
                            src="{{ asset('images/leaf-icon.png') }}" 
                            alt="Or Divider"
                            class="absolute left-1/2 -translate-x-1/2 bg-white px-2 -top-3 w-10 h-6 object-contain"
                        >
                    </div>

                    <div class="w-full px-6">
                        <div class="grid grid-cols-4 gap-4">

                            <!-- CARD 1 -->
                            <div class="bg-white rounded-xl py-0 px-5 flex flex-col items-center text-center">
                                <div class="w-20 h-20 flex items-center justify-center rounded-full bg-[#f1f6e2] mb-4">
                                    <img 
                                        src="{{ asset('images/real-time-icon.png') }}" 
                                        alt="Icon"
                                        class="w-12 h-12 object-contain"
                                    >
                                </div>

                                <h3 class="font-semibold text-black text-sm">Monitoring</h3>
                                <p class="text-xs text-gray-500 mt-2">
                                    Track environmental conditions and crop health 24/7
                                </p>
                            </div>

                            <!-- CARD 2 -->
                            <div class="bg-white rounded-xl py-0 px-5 flex flex-col items-center text-center">
                                <div class="w-20 h-20 flex items-center justify-center rounded-full bg-[#f1f6e2] mb-4">
                                    <img 
                                        src="{{ asset('images/data-icon.png') }}" 
                                        alt="Icon"
                                        class="w-12 h-12 object-contain"
                                    >
                                </div>

                                <h3 class="font-semibold text-black text-sm">Data-Driven Insight</h3>
                                <p class="text-xs text-gray-500 mt-2">
                                    Get accurate KPIs and analytics for better decisions
                                </p>
                            </div>

                            <!-- CARD 3 -->
                            <div class="bg-white rounded-xl py-0 px-5 flex flex-col items-center text-center">
                                <div class="w-20 h-20 flex items-center justify-center rounded-full bg-[#f1f6e2] mb-4">
                                    <img 
                                        src="{{ asset('images/alert-icon.png') }}" 
                                        alt="Icon"
                                        class="w-12 h-12 object-contain"
                                    >
                                </div>

                                <h3 class="font-semibold text-black text-sm">Smart Alerts</h3>
                                <p class="text-xs text-gray-500 mt-2">
                                    Receive SMS alert for critical challenges and recommendation
                                </p>
                            </div>

                            <!-- CARD 4 -->
                            <div class="bg-white rounded-xl py-0 px-5 flex flex-col items-center text-center">
                                <div class="w-20 h-20 flex items-center justify-center rounded-full bg-[#f1f6e2] mb-4">
                                    <img 
                                        src="{{ asset('images/yield-icon.png') }}" 
                                        alt="Icon"
                                        class="w-12 h-12 object-contain"
                                    >
                                </div>

                                <h3 class="font-semibold text-black text-sm">Better Yields</h3>
                                <p class="text-xs text-gray-500 mt-2">
                                    Improve quality, increase yield, and maximize profit
                                </p>
                            </div>

                        </div>
                    </div>
                    
                    <div class="w-full px-6 flex justify-between items-center bg-[#f1f6e2] border border-[#346844] max-w-xl rounded-lg">
                        <img 
                            src="{{ asset('images/leaf-icon-soil.png') }}" 
                            alt="Icon"
                            class="w-12 h-12 object-contain"
                        >
                        <p class="text-sm text-[#346844]">Empowering farmers with technology for a sweeter tomorrow.</p>
                    </div>
                </div>
            </div>

            {{-- RIGHT --}}
            <div class="relative w-full md:w-1/2 flex justify-center items-center overflow-hidden">
                
                <div class="h-fit flex flex-col bg-white border border-gray-200 shadow-sm rounded-xl p-4 md:p-5 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400"
                    x-data="otpVerification({{ $remainingSeconds }})"
                    x-init="startCountdown()"
                >
                    <h1 class="text-center mb-2 font-semibold">OTP Verification</h1>
                    <p class="text-center mb-8 text-xs">Enter the OTP sent to your email.</p>
                    <div class="flex gap-x-3 mb-5" data-hs-pin-input="">
                        @foreach(range(0, 5) as $index)
                            <input 
                                type="text" 
                                maxlength="1"
                                class="block w-9.5 text-center bg-transparent border-t-transparent focus:outline-none border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-[#f2f5e2] focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400  dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600" 
                                placeholder="⚬" 
                                data-hs-pin-input-item=""
                                wire:model.lazy="otp.{{ $index }}"
                            >
                        @endforeach
                    </div>
                    @if (session('error'))
                        <div>
                            <p class="text-red-500 text-xs text-center mb-5">
                                {{ session('error') }}
                            </p>
                        </div>
                    @endif
                    <a href="#" wire:click="verifyOtp" class="w-[90%] md:w-full py-2 px-4 mt-5 inline-flex justify-center items-center gap-x-2 text-base font-medium border border-transparent bg-[#346844] text-white hover:bg-[#346844] disabled:opacity-50 disabled:pointer-events-none rounded-xl">
                        <span wire:loading.remove wire:target="verifyOtp">
                            Verify
                        </span>
                    
                        <!-- Loading indicator -->
                        <span wire:loading wire:target="verifyOtp">
                            Verifying…
                        </span>
                    </a>

                    <div class="text-center mt-10">
                        <p>Didn't receive code?</p>
                        <button 
                            x-bind:disabled="countdown > 0 || loading"
                            x-on:click="resendOtp()"
                            class="hover:cursor-pointer"
                        >
                            <span x-show="!loading" 
                                    x-bind:class="countdown > 0 ? 'text-gray-500' : 'text-blue-600'">
                                Resend
                                <template x-if="countdown > 0">
                                    <span>
                                        <span class="text-gray-500"> - </span> 
                                        <span x-text="countdown" class="text-gray-500"></span>
                                        <span class="text-gray-500">s</span>
                                    </span>
                                </template>
                            </span>
                            <span x-show="loading">Sending…</span>
                        </button>
                    </div>
                </div>
                
            </div>
        </div>

        <div class="w-[90%] h-fit bg-[#f1f6e2] rounded-2xl border border-[#346844] mx-auto z-10">
            <div class="grid grid-cols-4 gap-4">
                <div class="bg-transparent rounded-xl py-0 px-5 flex items-center text-center">
                    <div class="w-20 h-20 flex items-center justify-center rounded-full bg-[#f1f6e2]">
                        <img 
                            src="{{ asset('images/pin-icon.png') }}" 
                            alt="Icon"
                            class="w-12 h-12 object-contain"
                        >
                    </div>
                    <div>
                        <h3 class="font-semibold text-black text-sm">Bukid Amara</h3>
                        <p class="text-xs text-gray-500 -mt-1">
                            Lucban Quezon
                        </p>
                    </div>
                </div>

                <div class="bg-transparent rounded-xl py-0 px-5 flex items-center text-center">
                    <div class="w-20 h-20 flex items-center justify-center rounded-full bg-[#f1f6e2]">
                        <img 
                            src="{{ asset('images/single-leaf-icon.png') }}" 
                            alt="Icon"
                            class="w-12 h-12 object-contain"
                        >
                    </div>
                    <div>
                        <h3 class="font-semibold text-black text-sm">Japanese Muskmelon</h3>
                        <p class="text-xs text-gray-500 -mt-1">
                            Premium Quality
                        </p>
                    </div>
                </div>

                <div class="bg-transparent rounded-xl py-0 px-5 flex items-center text-center">
                    <div class="w-20 h-20 flex items-center justify-center rounded-full bg-[#f1f6e2]">
                        <img 
                            src="{{ asset('images/shield-icon.png') }}" 
                            alt="Icon"
                            class="w-12 h-12 object-contain"
                        >
                    </div>
                    <div>
                        <h3 class="font-semibold text-black text-sm">Grow Smarter</h3>
                        <p class="text-xs text-gray-500 -mt-1">
                            Monitor Today, Harvest Tomorrow
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div 
            class="absolute top-0 right-0 h-full w-1/2 md:w-2/3 lg:w-1/2 bg-cover bg-center bg-no-repeat"
            style="
                background-image: url('{{ asset('images/right-bg-desktop.png') }}');
                clip-path: polygon(25% 0, 100% 0, 100% 100%, 25% 100%, 0 50%);
            "
        ></div>
    </div>

    {{-- MOBILE --}}
    <div class="relative w-full h-auto flex flex-col gap-4 px-3 py-6 md:hidden">
        <div class="flex justify-left z-10 gap-2 w-full max-w-[60%]">
            <img src="{{ asset('images/Logo_MelonTrack.png') }}" alt="Logo" class="w-12 h-12 object-contain">
                <div>
                    <h1 class="text-[1.3rem] font-semibold text-[#316943]">
                        MelonTrack
                    </h1>
                    <p class="-mt-1 text-xs">Smart Melon Monitoring System</p>
                </div>
        </div>
        <div class="flex flex-col justify-left gap-3 w-full max-w-[55%]">
                        
            <h1 class="text-[1.3rem] font-semibold ">
                Verify your <span class="text-[#316943]">Account</span>
            </h1>
            <p class="-mt-3 text-2xs ">Your smarter way to monitor, analyze, and maximize melon growth and quality in real-time.</p>
            
        </div>

        <div class="relative w-full max-w-[55%] my-4">
            <hr class="border-[#316943] w-full" />

            <img 
                src="{{ asset('images/leaf-icon.png') }}" 
                alt="Or Divider"
                class="absolute left-1/2 -translate-x-1/2 bg-white px-2 -top-3 w-10 h-6 object-contain"
            >
        </div>

        <div class="relative w-full z-10">
            <div class="mx-auto border border-[#316943] w-full h-fit max-w-sm flex flex-col justify-center items-center px-5 py-5 bg-white/50 z-10 rounded-xl"
                x-data="otpVerification({{ $remainingSeconds }})"
                x-init="startCountdown()"
            >
                <h1 class="text-center mb-2 font-semibold">OTP Verification</h1>
                <p class="text-center mb-8 text-xs">Enter the OTP sent to your email.</p>
                <div class="flex gap-x-3 mb-5" data-hs-pin-input="">
                    @foreach(range(0, 5) as $index)
                        <input 
                            type="text" 
                            maxlength="1"
                            class="block w-9.5 text-center bg-transparent border-t-transparent focus:outline-none border-b-2 border-x-transparent border-b-gray-200 sm:text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-[#f2f5e2] focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400  dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600" 
                            placeholder="⚬" 
                            data-hs-pin-input-item=""
                            wire:model.lazy="otp.{{ $index }}"
                        >
                    @endforeach
                </div>
                @if (session('error'))
                    <div>
                        <p class="text-red-500 text-xs text-center mb-5">
                            {{ session('error') }}
                        </p>
                    </div>
                @endif
                <a href="#" wire:click="verifyOtp" class="w-[90%] md:w-full py-2 px-4 mt-5 inline-flex justify-center items-center gap-x-2 text-base font-medium border border-transparent bg-[#346844] text-white hover:bg-[#346844] disabled:opacity-50 disabled:pointer-events-none rounded-xl">
                    <span wire:loading.remove wire:target="verifyOtp">
                        Verify
                    </span>
                
                    <!-- Loading indicator -->
                    <span wire:loading wire:target="verifyOtp">
                        Verifying…
                    </span>
                </a>

                <div class="text-center mt-10">
                    <p>Didn't receive code?</p>
                    <button 
                        x-bind:disabled="countdown > 0 || loading"
                        x-on:click="resendOtp()"
                        class="hover:cursor-pointer"
                    >
                        <span x-show="!loading" 
                                x-bind:class="countdown > 0 ? 'text-gray-500' : 'text-blue-600'">
                            Resend
                            <template x-if="countdown > 0">
                                <span>
                                    <span class="text-gray-500"> - </span> 
                                    <span x-text="countdown" class="text-gray-500"></span>
                                    <span class="text-gray-500">s</span>
                                </span>
                            </template>
                        </span>
                        <span x-show="loading">Sending…</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="w-full px-6 flex justify-between items-center gap-2 bg-[#f1f6e2] border border-[#346844] rounded-lg">
            <img 
                src="{{ asset('images/leaf-icon-soil.png') }}" 
                alt="Icon"
                class="w-12 h-12 object-contain"
            >
            <p class="text-xs text-[#346844]">Empowering farmers with technology for a sweeter tomorrow.</p>
        </div>

        <div class="w-full z-10">
            <div class="grid grid-cols-2 gap-4 bg-white/70 px-2 py-2 rounded-xl border border-[#316943]">

                <!-- CARD 1 -->
                <div class=" rounded-xl py-0 px-5 flex flex-col items-center text-center">
                    <div class="w-16 h-16 flex items-center justify-center rounded-full bg-[#f1f6e2] mb-4">
                        <img 
                            src="{{ asset('images/real-time-icon.png') }}" 
                            alt="Icon"
                            class="w-10 h-10 object-contain"
                        >
                    </div>

                    <h3 class="font-semibold text-black text-[0.50rem]">Monitoring</h3>
                    <p class="text-[0.50rem] text-gray-500 mt-2">
                        Track environmental conditions and crop health 24/7
                    </p>
                </div>

                <!-- CARD 2 -->
                <div class="rounded-xl py-0 px-5 flex flex-col items-center text-center">
                    <div class="w-16 h-16 flex items-center justify-center rounded-full bg-[#f1f6e2] mb-4">
                        <img 
                            src="{{ asset('images/data-icon.png') }}" 
                            alt="Icon"
                            class="w-10 h-10 object-contain"
                        >
                    </div>

                    <h3 class="font-semibold text-black text-[0.50rem]">Data-Driven Insight</h3>
                    <p class="text-[0.50rem] text-gray-500 mt-2">
                        Get accurate KPIs and analytics for better decisions
                    </p>
                </div>

                <!-- CARD 3 -->
                <div class="rounded-xl py-0 px-5 flex flex-col items-center text-center">
                    <div class="w-16 h-16 flex items-center justify-center rounded-full bg-[#f1f6e2] mb-4">
                        <img 
                            src="{{ asset('images/alert-icon.png') }}" 
                            alt="Icon"
                            class="w-10 h-10 object-contain"
                        >
                    </div>

                    <h3 class="font-semibold text-black text-[0.50rem]">Smart Alerts</h3>
                    <p class="text-[0.50rem] text-gray-500 mt-2">
                        Receive SMS alert for critical challenges and recommendation
                    </p>
                </div>

                <!-- CARD 4 -->
                <div class="rounded-xl py-0 px-5 flex flex-col items-center text-center">
                    <div class="w-16 h-16 flex items-center justify-center rounded-full bg-[#f1f6e2] mb-4">
                        <img 
                            src="{{ asset('images/yield-icon.png') }}" 
                            alt="Icon"
                            class="w-10 h-10 object-contain"
                        >
                    </div>

                    <h3 class="font-semibold text-black text-[0.50rem]">Better Yields</h3>
                    <p class="text-[0.50rem] text-gray-500 mt-2">
                        Improve quality, increase yield, and maximize profit
                    </p>
                </div>

            </div>
        </div>

        <div class="w-fit h-fit z-10 bg-[#f1f6e2] rounded-2xl border border-[#346844] mx-auto p-2">
    
            <div class="grid grid-cols-2 gap-2">

                <!-- CARD 1 -->
                <div class="flex items-center gap-2 p-2">
                    <div class="w-14 h-14 flex-shrink-0 flex items-center justify-center rounded-full bg-[#f1f6e2]">
                        <img src="{{ asset('images/pin-icon.png') }}"
                            class="w-8 h-8 object-contain"
                            alt="">
                    </div>
                    <div class="leading-tight">
                        <h3 class="font-semibold text-black text-sm">Bukid Amara</h3>
                        <p class="text-xs text-gray-500">Lucban Quezon</p>
                    </div>
                </div>

                <!-- CARD 2 -->
                <div class="flex items-center gap-2 p-2">
                    <div class="w-14 h-14 flex-shrink-0 flex items-center justify-center rounded-full bg-[#f1f6e2]">
                        <img src="{{ asset('images/single-leaf-icon.png') }}"
                            class="w-8 h-8 object-contain"
                            alt="">
                    </div>
                    <div class="leading-tight">
                        <h3 class="font-semibold text-black text-sm">Japanese Muskmelon</h3>
                        <p class="text-xs text-gray-500">Premium Quality</p>
                    </div>
                </div>

                <!-- CARD 4 -->
                <div class="flex items-center gap-2 p-2">
                    <div class="w-14 h-14 flex-shrink-0 flex items-center justify-center rounded-full bg-[#f1f6e2]">
                        <img src="{{ asset('images/shield-icon.png') }}"
                            class="w-8 h-8 object-contain"
                            alt="">
                    </div>
                    <div class="leading-tight">
                        <h3 class="font-semibold text-black text-sm">Grow Smarter</h3>
                        <p class="text-xs text-gray-500">Monitor Today, Harvest Tomorrow</p>
                    </div>
                </div>

            </div>
        </div>
        
        <div class="absolute top-0 right-0">
            <div 
                class="w-40 h-[20rem] aspect-square bg-cover bg-center bg-no-repeat"
                style="
                    background-image: url('{{ asset('images/right-bg-desktop.png') }}');
                    border-radius: 9999px 0 0 9999px;
                "
            ></div>
        </div>
    </div>
</div>

<script>
    function otpVerification(initialSeconds) {
        return {
            countdown: initialSeconds,
            loading: false,
    
            startCountdown() {
                if (this.countdown > 0) {
                    const interval = setInterval(() => {
                        if (this.countdown > 0) {
                            this.countdown--;
                        } else {
                            clearInterval(interval);
                        }
                    }, 1000);
                }
            },
    
            resendOtp() {
                if (this.countdown === 0 && !this.loading) {
                    this.loading = true;
                    @this.call('resendOtp')
                        .then((seconds) => {
                            this.countdown = {{ $resendCountdown }};
                            this.startCountdown();
                        })
                        .finally(() => {
                            this.loading = false;
                        });
                }
            }
        }
    }
</script>
<script>
    window.addEventListener('reload-page', () => {
        location.reload();
    });
</script>