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
                            Welcone to <span class="text-[#316943]">MelonTrack</span>
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
            <div class="relative w-full md:w-1/2 flex justify-center overflow-hidden">
                
                <form wire:submit.prevent="login" class="w-full h-fit max-w-sm flex flex-col justify-center items-center px-10 py-10 bg-white z-10 rounded-xl mt-10">
                    <div class="flex flex-col justify-center items-center mb-8">
                        <h1 class="font-semibold text-lg">Login to your account</h1>
                        <p class="text-sm">Access your MelonTrack dashboard</p>
                    </div>
                    <div class="w-full flex flex-col justify-center items-center">
                        <div class="space-y-4 w-[90%] md:w-full">
                            <div class="relative">
                                <x-input icon="user" label="Email Address" placeholder="Enter email" wire:model="email" class="py-3"/>
                                <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-2 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                                </div>
                            </div>
                            
                            <div class="relative">
                                <x-inputs.password icon="key" label="Password" placeholder="Enter password" class="py-3" wire:model="password"/>
                                <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-2 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                                </div>
                            </div>
                            <div class="flex justify-between items-center">
                                <x-checkbox id="right-label" label="Remember me" wire:model.defer="model" />
                                <a href="{{ route('password.request') }}" class="underline text-sm">Forgot password?</a>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="w-[90%] md:w-full py-2 px-4 mt-5 inline-flex justify-center items-center gap-x-2 text-base font-medium border border-transparent bg-[#346844] text-white hover:bg-[#346844] disabled:opacity-50 disabled:pointer-events-none rounded-xl">
                        Login
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                        </svg>
                    </button>

                    <div class="relative w-[90%] md:w-full my-4">
                        <hr class="border-gray-300" />

                        <span class="absolute left-1/2 -translate-x-1/2 bg-white px-4 text-sm text-gray-500 -top-3">
                            Or
                        </span>
                    </div>

                    <a href="{{ route('register') }}" class="w-[90%] md:w-full py-2 px-4 inline-flex justify-center items-center gap-x-2 text-base font-medium border border-[#346844] bg-[#346844]/10 text-[#346844] hover:bg-[#346844]/10 disabled:opacity-50 disabled:pointer-events-none rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                        </svg>
                        Create New Account
                    </a>

                    <div class="flex flex-col text-sm">
                        <a href="{{ route('account.resend-verification') }}" class="mt-2 mx-auto">Haven’t verified yet?</a>
                    </div>
                </form>
                
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
                            src="{{ asset('images/analytics-icon.png') }}" 
                            alt="Icon"
                            class="w-12 h-12 object-contain"
                        >
                    </div>
                    <div>
                        <h3 class="font-semibold text-black text-sm">Data You Can Trust</h3>
                        <p class="text-xs text-gray-500 -mt-1">
                            Accurate - Timely - Actionable
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
                Welcone to <span class="text-[#316943]">MelonTrack</span>
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
            <form wire:submit.prevent="login" class="mx-auto border border-[#316943] w-full h-fit max-w-sm flex flex-col justify-center items-center px-5 py-5 bg-white/50 z-10 rounded-xl">
                <div class="flex flex-col justify-center items-center mb-8">
                    <h1 class="font-semibold text-lg">Login to your account</h1>
                    <p class="text-sm">Access your MelonTrack dashboard</p>
                </div>
                <div class="w-full flex flex-col justify-center items-center">
                    <div class="space-y-4 w-[90%] md:w-full">
                        <div class="relative">
                            <x-input icon="user" label="Email Address" placeholder="Enter email" wire:model="email" class="py-3"/>
                            <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-2 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                            </div>
                        </div>
                        
                        <div class="relative">
                            <x-inputs.password icon="key" label="Password" placeholder="Enter password" class="py-3" wire:model="password"/>
                            <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-2 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <x-checkbox id="right-label" label="Remember me" wire:model.defer="model" />
                            <a href="{{ route('password.request') }}" class="underline text-sm">Forgot password?</a>
                        </div>
                    </div>
                </div>
                <button type="submit" class="w-[90%] md:w-full py-2 px-4 mt-5 inline-flex justify-center items-center gap-x-2 text-base font-medium border border-transparent bg-[#346844] text-white hover:bg-[#346844] disabled:opacity-50 disabled:pointer-events-none rounded-xl">
                    Login
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                    </svg>
                </button>

                <div class="relative w-[90%] md:w-full my-4">
                    <hr class="border-gray-300" />

                    <span class="absolute left-1/2 -translate-x-1/2 bg-white px-4 text-sm text-gray-500 -top-3">
                        Or
                    </span>
                </div>

                <a href="{{ route('register') }}" class="w-[90%] md:w-full py-2 px-4 inline-flex justify-center items-center gap-x-2 text-base font-medium border border-[#346844] bg-[#346844]/10 text-[#346844] hover:bg-[#346844]/10 disabled:opacity-50 disabled:pointer-events-none rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                    </svg>
                    Create New Account
                </a>

                <div class="flex flex-col text-sm">
                    <a href="{{ route('account.resend-verification') }}" class="mt-2 mx-auto">Haven’t verified yet?</a>
                </div>
            </form>
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

        <div class="w-full h-fit z-10 bg-[#f1f6e2] rounded-2xl border border-[#346844] mx-auto p-2">
    
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

                <!-- CARD 3 -->
                <div class="flex items-center gap-2 p-2">
                    <div class="w-14 h-14 flex-shrink-0 flex items-center justify-center rounded-full bg-[#f1f6e2]">
                        <img src="{{ asset('images/analytics-icon.png') }}"
                            class="w-8 h-8 object-contain"
                            alt="">
                    </div>
                    <div class="leading-tight">
                        <h3 class="font-semibold text-black text-sm">Data You Can Trust</h3>
                        <p class="text-xs text-gray-500">Accurate - Timely - Actionable</p>
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
