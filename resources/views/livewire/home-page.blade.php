<div class="flex flex-col md:flex-row w-full h-auto lg:h-screen bg-gradient-to-r lg:pt-0 md:pt-10 from-gray-200 to-white relative overflow-hidden">
    <div class="w-full max-w-[1020px] flex flex-col items-center lg:flex-row mx-auto relative h-screen">
        
        <!-- Text content -->
        <div class="w-full flex flex-col lg:justify-center px-5 md:px-0 gap-5 relative z-10 py-10">
            {{-- <h1 class="text-3xl text-center lg:text-left md:text-5xl font-bold">iBroccoGreens</h1> --}}
            <img class="h-auto w-80 lg:mx-0 mx-auto" src="{{ asset('images/iBroccoGreensLogo.png')}} " alt="Logo">
            <p class="text-lg text-center lg:text-left lg:w-2/5">A Web-Based Parameter Monitoring and Misting Automation with Cycle Level Harvest Tracking for Calabrese Broccoli Microgreens in Vertical Soilless Farming</p>
            <a href="ibroccogreens-admin/register" class="mx-auto lg:mx-0">
                <button type="button" class="py-2 px-3 uppercase inline-flex items-center gap-x-2 text-sm font-medium rounded-lg text-white shadow-sm bg-[#639e2e] hover:bg-[#c0dac1] disabled:opacity-50 disabled:pointer-events-none">
                    Register
                </button>
            </a>
        </div>

        <!-- Image: Static on mobile, centered on lg -->
        <div class="w-full my-10 lg:my-0 lg:w-[800px] pointer-events-none z-0 relative lg:absolute lg:top-1/2 lg:-translate-y-1/2 lg:-right-[260px]">
            <img src="{{ asset('images/bg-new.png') }}" alt="" class="h-auto mx-auto lg:mx-0" style="width: 130%;">
        </div>

    </div>
</div>
