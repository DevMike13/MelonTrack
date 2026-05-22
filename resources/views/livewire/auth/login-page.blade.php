<div class="flex justify-center md:flex h-auto">
    <div class="hidden md:block w-1/2 h-screen sticky top-0 bg-cover bg-center relative" style="background-image: url('{{ asset('images/login-banner.jpg') }}');">
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="absolute inset-0 flex flex-col items-center justify-center text-center text-white px-10">
            
            <h1 class="text-4xl font-semibold">
                MelonTrack
            </h1>

            <p class="mt-4 text-sm text-white/80 max-w-md">
                Your smarter way to monitor, analyze, and maximize melon growth and quality in real-time.
            </p>

        </div>
    </div>
    <div class="md:w-[50%] h-screen flex flex-col justify-center items-center px-20 gap-3 bg-green-200">
        <form wire:submit.prevent="login" class="w-full max-w-sm flex flex-col justify-center items-center px-10 py-10 bg-white rounded-xl">
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
