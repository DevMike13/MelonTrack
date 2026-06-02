<div class="relative overflow-hidden bg-white">
    <div class="fixed right-0 top-0 h-screen w-[25vw] lg:w-[30vw] xl:w-[35vw] pointer-events-none z-0">
        <div class="h-full w-full bg-[url('../../public/images/melon-right-bg.png')] bg-no-repeat bg-contain bg-right opacity-100"></div>
    </div>

    <div class="relative z-10 bg-transparent">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 xl:grid-cols-2 gap-5 mb-8 items-stretch">
            <div class="flex flex-col justify-center w-full h-full bg-white rounded-2xl border border-[#356744] p-4 lg:p-6">
                <div class="flex items-center gap-3 mb-5">
                    <img 
                        src="{{ asset('images/leaf-icon.png') }}" 
                        alt="Leaf Icon"
                        class="w-10 h-10 object-contain bg-white rounded-md shadow-sm rotate-[40deg]"
                    >
                    <h6 class="font-semibold text-[#2b6444] text-lg">
                        Crop Overview
                    </h6>
                </div>
                <div class="flex flex-col md:flex-row items-center gap-3 mb-5">
                    <p class="text-[#2b6444] text-sm font-regular">
                        Japanese musk melon requires controlled environmental conditions to achieve premium quality. Optimal growth depends on balanced soil nutrients, stable temperature, proper humidity, and precise irrigation. Each growth stage demands specific care to ensure consistent fruit development and high sugar content.
                    </p>
                    <img 
                        src="{{ asset('images/grower-img-overview.png') }}" 
                        alt="Grower Overview"
                        class="w-28 h-28 md:w-32 md:h-32 object-contain bg-white rounded-lg shadow-sm shrink-0"
                    >
                </div>
            </div>

            <div class="flex flex-col justify-center w-full h-full bg-white rounded-2xl border border-[#356744] p-4 lg:p-6">
                <div class="flex items-center gap-3 mb-5">
                    <svg 
                        xmlns="http://www.w3.org/2000/svg" 
                        fill="none" 
                        viewBox="0 0 24 24" 
                        stroke-width="1.5" 
                        stroke="currentColor" 
                        class="w-10 h-10 text-[#2b6444] rounded-md shadow-sm p-1"
                    >
                    <path 
                        stroke-linecap="round" 
                        stroke-linejoin="round" 
                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" 
                    />
                    </svg>
                    <h6 class="font-semibold text-[#2b6444] text-lg">
                        Harvesting Inidcations
                    </h6>
                </div>
                <div class="flex flex-col md:flex-row items-center gap-3 mb-5">
                    <p class="text-[#2b6444] text-sm font-regular">
                        Melons are ready for harvest based on measurable and visual indicators. Monitoring system data such as sugar level and environmental consistency helps determine the ideal harvest time to maximize quality and market value.
                    </p>
                    <img 
                        src="{{ asset('images/grower-img-harvesting.png') }}" 
                        alt="Grower Overview"
                        class="w-28 h-28 md:w-32 md:h-32 object-contain bg-white rounded-lg shadow-sm shrink-0"
                    >
                </div>

                <div class="grid grid-cols-3 sm:grid-cols-3 md:grid-cols-3 xl:grid-cols-5 gap-2">

                    {{-- Card 1 --}}
                    <div class="flex flex-col justify-center items-center bg-white border border-gray-200 rounded-xl p-2 text-center shadow-sm hover:shadow-md transition gap-2">
                        
                        <div class="w-14 h-14 flex items-center justify-center bg-[#f3efee] rounded-full shadow-sm">
                            <span class="text-sm font-bold text-[#2b6444]">
                                Brix
                            </span>
                        </div>
                        
                        <p class="text-xs font-semibold text-gray-700">Brix Level</p>
                        <p class="text-[0.60rem] font-light text-gray-400">(12-18 °Bx)</p>
                    </div>

                    {{-- Card 2 --}}
                    <div class="flex flex-col justify-center items-center bg-white border border-gray-200 rounded-xl p-2 text-center shadow-sm hover:shadow-md transition gap-2">
                        <div class="w-14 h-14 flex items-center justify-center bg-[#f3efee] rounded-full">
                            <img 
                                src="{{ asset('images/ruler-icon.png') }}" 
                                class="w-8 h-8 object-contain"
                                alt="Card Icon"
                            >
                        </div>
                        <p class="text-xs font-semibold text-gray-700">Fruit Size</p>
                        <p class="text-[0.60rem] font-light text-gray-400">(1.6-1.8 kg)</p>
                    </div>

                    {{-- Card 3 --}}
                    <div class="flex flex-col justify-center items-center bg-white border border-gray-200 rounded-xl p-2 text-center shadow-sm hover:shadow-md transition gap-2">
                        <div class="w-14 h-14 flex items-center justify-center bg-[#f3efee] rounded-full">
                            <img 
                                src="{{ asset('images/yield-icon.png') }}" 
                                class="w-8 h-8 object-contain"
                                alt="Card Icon"
                            >
                        </div>
                        <p class="text-xs font-semibold text-gray-700">Netting</p>
                        <p class="text-[0.60rem] font-light text-gray-400">Well Developed</p>
                    </div>

                    {{-- Card 4 --}}
                    <div class="flex flex-col justify-center items-center bg-white border border-gray-200 rounded-xl p-2 text-center shadow-sm hover:shadow-md transition gap-2">
                        <div class="w-14 h-14 flex items-center justify-center bg-[#f3efee] rounded-full">
                            <svg 
                                xmlns="http://www.w3.org/2000/svg" 
                                fill="none" 
                                viewBox="0 0 24 24" 
                                stroke-width="1.5" 
                                stroke="currentColor" 
                                class="w-10 h-10 text-[#2b6444] rounded-md shadow-sm p-1"
                            >
                            <path 
                                stroke-linecap="round" 
                                stroke-linejoin="round" 
                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" 
                            />
                            </svg>
                        </div>
                        <p class="text-xs font-semibold text-gray-700">Days after Poolination</p>
                        <p class="text-[0.60rem] font-light text-gray-400">55 - 70 Days</p>
                    </div>

                    {{-- Card 5 --}}
                    <div class="flex flex-col justify-center items-center bg-white border border-gray-200 rounded-xl p-2 text-center shadow-sm hover:shadow-md transition gap-2">
                        <div class="w-14 h-14 flex items-center justify-center bg-[#f3efee] rounded-full">
                            <img 
                                src="{{ asset('images/leaf-icon.png') }}" 
                                class="w-8 h-8 object-contain"
                                alt="Card Icon"
                            >
                        </div>
                        <p class="text-xs font-semibold text-gray-700">Steam Near Fruit</p>
                        <p class="text-[0.60rem] font-light text-gray-400">Slightly Dried</p>
                    </div>

                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 xl:grid-cols-1 gap-5 mb-8 items-stretch">
            <div class="flex flex-col justify-center w-full h-full bg-white rounded-2xl border border-[#356744] p-4 lg:p-6">
                <div class="flex items-center gap-3 mb-5">
                    <img 
                        src="{{ asset('images/leaf-icon-soil.png') }}" 
                        alt="Leaf Icon"
                        class="w-10 h-10 object-contain"
                    >
                    <h6 class="font-semibold text-[#2b6444] text-lg">
                        Stage - Based Guidelines
                    </h6>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-0 w-full mb-5">

                    {{-- Item 1 --}}
                    <div class="flex items-center justify-between p-4">
                        <img src="{{ asset('images/phase-1.png') }}" class="w-44 h-44 object-contain">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 text-gray-500 shrink-0"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </div>

                    {{-- Item 2 --}}
                    <div class="flex items-center justify-between p-4">
                        <img src="{{ asset('images/phase-2.png') }}" class="w-44 h-44 object-contain">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 text-gray-500 shrink-0"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </div>

                    {{-- Item 3 --}}
                    <div class="flex items-center justify-between p-4">
                        <img src="{{ asset('images/phase-3.png') }}" class="w-44 h-44 object-contain">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 text-gray-500 shrink-0"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </div>

                    {{-- Item 4 --}}
                    <div class="flex items-center justify-between p-4">
                        <img src="{{ asset('images/phase-4.png') }}" class="w-44 h-44 object-contain">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 text-gray-500 shrink-0"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </div>

                    {{-- Item 5 --}}
                    <div class="flex items-center justify-between p-4">
                        <img src="{{ asset('images/phase-5.png') }}" class="w-44 h-44 object-contain">
                    </div>

                </div>
            </div>
        </div>

         <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 xl:grid-cols-2 gap-5 mb-8 items-stretch">
            <div class="flex flex-col justify-center w-full h-full bg-white rounded-2xl border border-[#356744] p-4 lg:p-6">
                <div class="flex items-center gap-3 mb-5">
                    <svg class="w-10 h-10 text-[#2b6444] p-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 3v1.5M4.5 8.25H3m18 0h-1.5M4.5 12H3m18 0h-1.5m-15 3.75H3m18 0h-1.5M8.25 19.5V21M12 3v1.5m0 15V21m3.75-18v1.5m0 15V21m-9-1.5h10.5a2.25 2.25 0 0 0 2.25-2.25V6.75a2.25 2.25 0 0 0-2.25-2.25H6.75A2.25 2.25 0 0 0 4.5 6.75v10.5a2.25 2.25 0 0 0 2.25 2.25Zm.75-12h9v9h-9v-9Z" />
                    </svg>

                    <h6 class="font-semibold text-[#2b6444] text-lg">
                        Hardware Tutorial
                    </h6>
                </div>

                <div class="w-full">
                    <video
                        class="w-full h-[260px] md:h-[320px] lg:h-[380px] rounded-xl shadow-sm border border-gray-200 object-cover"
                        controls
                        autoplay
                        muted
                        loop
                    >
                        <source src="{{ asset('videos/crop-overview.mp4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                
            </div>

            <div class="flex flex-col justify-center w-full h-full bg-white rounded-2xl border border-[#356744] p-4 lg:p-6">
                <div class="flex items-center gap-3 mb-5">
                    <svg class="w-10 h-10 text-[#2b6444] p-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                    </svg>

                    <h6 class="font-semibold text-[#2b6444] text-lg">
                        Web Application Usage
                    </h6>
                </div>

                <div class="w-full">
                    <video
                        class="w-full h-[260px] md:h-[320px] lg:h-[380px] rounded-xl shadow-sm border border-gray-200 object-cover"
                        controls
                        autoplay
                        muted
                        loop
                    >
                        <source src="{{ asset('videos/crop-overview.mp4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                
            </div>
        </div>
    </div>
</div>
