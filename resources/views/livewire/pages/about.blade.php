<div class="relative overflow-hidden">

    {{-- Background --}}
    <div class="fixed right-0 top-0 h-screen pointer-events-none z-0 overflow-hidden">
        <img
            src="{{ asset('images/melon-right-bg.png') }}"
            alt=""
            class="h-full w-auto max-w-none object-cover object-right"
        >
    </div>

    <div class="relative z-10">

        {{-- ========================================================= --}}
        {{-- PLATFORM OVERVIEW + CONTACT US --}}
        {{-- ========================================================= --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 mb-5 items-stretch">

            {{-- Platform Overview --}}
            <div class="lg:col-span-8 bg-white rounded-2xl border border-[#356744] p-5 lg:p-6 shadow-sm">

                <div class="flex items-center gap-3 mb-4">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-9 h-9 text-[#356744] shrink-0"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9.75 3.104v5.714a2.25 2.25 0 0 1-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 0 1 4.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19 14.5M14.25 3.104c.251.023.501.05.75.082M19 14.5l-2.25 2.25m2.25-2.25-4.5 4.5m-9.5-4.5 2.25 2.25m-2.25-2.25 4.5 4.5"
                        />
                    </svg>

                    <h2 class="text-xl font-bold text-[#2b6444]">
                        Platform Overview
                    </h2>
                </div>

                <div class="space-y-3 text-sm text-gray-600 leading-relaxed">

                    <p>
                        <strong class="text-[#2b6444]">MelonTrack</strong> is an IoT
                        web-based analytics and cultivation management system designed to
                        support precision melon farming. The platform provides growers with
                        a comprehensive view of their cultivation environment through
                        real-time sensor monitoring, data analysis, and harvest forecasting.
                    </p>

                    <p>
                        By collecting and analyzing data from multiple sensors, MelonTrack
                        helps growers monitor important cultivation conditions such as
                        temperature, humidity, cocopeat moisture, pH level, electrical
                        conductivity (EC), nutrient levels, and water levels. These data
                        provide growers with useful information for monitoring crop
                        conditions and identifying potential issues during the cultivation
                        cycle.
                    </p>

                    <p>
                        MelonTrack combines sensor data with web-based analytics to support
                        informed decision-making throughout each stage of cultivation.
                        Through monitoring, cultivation guidance, cycle tracking, and
                        forecasting, the system aims to help improve crop quality, reduce
                        rejection rates, and support more efficient and sustainable
                        muskmelon production.
                    </p>

                </div>

            </div>


            {{-- Contact Us --}}
            <div class="lg:col-span-4 bg-white rounded-2xl border border-[#356744] p-5 lg:p-6 shadow-sm">

                <div class="flex items-center gap-3 mb-4">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-9 h-9 text-[#356744] shrink-0"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M8.625 9.75a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.76 9.76 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.455-.218-.9-.617-1.134C3.465 16.672 2.25 14.574 2.25 12 2.25 7.444 6.28 3.75 11.25 3.75S21 7.444 21 12Z"
                        />
                    </svg>

                    <div>
                        <h2 class="text-xl font-bold text-[#2b6444]">
                            Contact Us
                        </h2>

                        <p class="text-xs text-gray-500 mt-1">
                            We're here to help & answer your questions you might have.
                        </p>
                    </div>
                </div>

                {{-- Phone --}}
                <div class="flex items-start gap-3 mb-4">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-6 h-6 text-[#356744] shrink-0 mt-0.5"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102A1.125 1.125 0 0 0 5.872 2.25H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"
                        />
                    </svg>

                    <div class="flex flex-col text-sm text-gray-600">
                        <a
                            href="tel:+639212028907"
                            class="hover:text-[#356744] hover:underline transition"
                        >
                            0921-2028-907
                        </a>

                        <a
                            href="tel:+639812049043"
                            class="hover:text-[#356744] hover:underline transition"
                        >
                            0981-2049-043
                        </a>

                        <a
                            href="tel:+639945105708"
                            class="hover:text-[#356744] hover:underline transition"
                        >
                            0994-510-5708
                        </a>
                    </div>
                </div>


                {{-- Email --}}
                <div class="flex items-start gap-3">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-6 h-6 text-[#356744] shrink-0 mt-0.5"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M21.75 6.75v10.5A2.25 2.25 0 0 1 19.5 19.5h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"
                        />
                    </svg>

                    <div class="flex flex-col text-sm text-gray-600 break-all">
                        <a
                            href="mailto:alcancegeo@gmail.com"
                            class="hover:text-[#356744] hover:underline transition"
                        >
                            alcancegeo@gmail.com
                        </a>

                        <a
                            href="mailto:espinosaallyza27@gmail.com"
                            class="hover:text-[#356744] hover:underline transition"
                        >
                            espinosaallyza27@gmail.com
                        </a>

                        <a
                            href="mailto:floresmark23@gmail.com"
                            class="hover:text-[#356744] hover:underline transition"
                        >
                            floresmark23@gmail.com
                        </a>
                    </div>
                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- CORE FEATURES & BENEFITS --}}
        {{-- ========================================================= --}}
        <div class="bg-white rounded-2xl border border-[#356744] p-5 lg:p-6 shadow-sm mb-5">

            <div class="flex items-center gap-3 mb-5">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-9 h-9 text-[#356744]"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                    />
                </svg>

                <h2 class="text-xl font-bold text-[#2b6444]">
                    Core Features & Benefits
                </h2>
            </div>


            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">

                {{-- Precision Data --}}
                <div
                    class="rounded-2xl p-5 min-h-[170px]"
                    style="background-color: #e5f3df;"
                >
                    <div class="flex items-center gap-3 mb-4">

                        <div
                            class="w-10 h-10 rounded-full flex items-center justify-center shrink-0"
                            style="background-color: #b8dda9;"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-6 h-6 text-[#356744]"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 3v18m0-18c-3.5 2-5.5 4.5-5.5 7.5S8.5 16 12 18m0-15c3.5 2 5.5 4.5 5.5 7.5S15.5 16 12 18"
                                />
                            </svg>
                        </div>

                        <h3 class="font-semibold text-gray-800">
                            Precision Data
                        </h3>
                    </div>

                    <p class="text-sm text-gray-600 leading-relaxed">
                        Aggregated insights from multi-depth sensors and environmental
                        monitoring devices.
                    </p>
                </div>


                {{-- Smart Analytics --}}
                <div
                    class="rounded-2xl p-5 min-h-[170px]"
                    style="background-color: #e8edf3;"
                >
                    <div class="flex items-center gap-3 mb-4">

                        <div
                            class="w-10 h-10 rounded-full flex items-center justify-center shrink-0"
                            style="background-color: #c6d8e8;"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-6 h-6 text-[#356744]"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h14.25M7.5 12l3-3 2.25 2.25L16.5 7.5l3 3"
                                />
                            </svg>
                        </div>

                        <h3 class="font-semibold text-gray-800">
                            Smart Analytics
                        </h3>
                    </div>

                    <p class="text-sm text-gray-600 leading-relaxed">
                        Proactive, data-driven cycle analysis and forecasting to support
                        better cultivation decisions.
                    </p>
                </div>


                {{-- Grower's Companion --}}
                <div
                    class="rounded-2xl p-5 min-h-[170px]"
                    style="background-color: #e4f0f2;"
                >
                    <div class="flex items-center gap-3 mb-4">

                        <div
                            class="w-10 h-10 rounded-full flex items-center justify-center shrink-0"
                            style="background-color: #b9dce0;"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-6 h-6 text-[#356744]"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25A8.966 8.966 0 0 1 18 3.75c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25"
                                />
                            </svg>
                        </div>

                        <h3 class="font-semibold text-gray-800">
                            Grower's Companion
                        </h3>
                    </div>

                    <p class="text-sm text-gray-600 leading-relaxed">
                        Access practical guidance and milestone tracking from the first
                        stage of cultivation through harvesting.
                    </p>
                </div>


                {{-- Secured & Scalable --}}
                <div
                    class="rounded-2xl p-5 min-h-[170px]"
                    style="background-color: #f0eee5;"
                >
                    <div class="flex items-center gap-3 mb-4">

                        <div
                            class="w-10 h-10 rounded-full flex items-center justify-center shrink-0"
                            style="background-color: #ddd5ac;"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-6 h-6 text-[#356744]"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M16.5 10.5V6.75a4.5 4.5 0 0 0-9 0v3.75m-.75 0h10.5A2.25 2.25 0 0 1 19.5 12.75v6A2.25 2.25 0 0 1 17.25 21H6.75a2.25 2.25 0 0 1-2.25-2.25v-6A2.25 2.25 0 0 1 6.75 10.5Z"
                                />
                            </svg>
                        </div>

                        <h3 class="font-semibold text-gray-800">
                            Secured & Scalable
                        </h3>
                    </div>

                    <p class="text-sm text-gray-600 leading-relaxed">
                        Scalable sensor monitoring with secure storage and reliable
                        management of cultivation data.
                    </p>
                </div>

            </div>
        </div>

        {{-- ========================================================= --}}
        {{-- HARDWARE ECOSYSTEM + VISION --}}
        {{-- ========================================================= --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 items-stretch mb-5">

            {{-- Hardware & Sensors Ecosystem --}}
            <div class="bg-white rounded-2xl border border-[#356744] p-5 lg:p-6 shadow-sm">

                {{-- Header --}}
                <div class="flex items-center gap-3 mb-2">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-8 h-8 text-[#356744] shrink-0"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9.75 3.104v5.714a2.25 2.25 0 0 1-.659 1.591L5 14.5M14.25 3.104v5.714c0 .597.237 1.17.659 1.591L19 14.5M6.75 19.5h10.5"
                        />
                    </svg>

                    <h2 class="text-xl font-bold text-[#2b6444]">
                        Hardware & Sensors Ecosystem
                    </h2>
                </div>

                {{-- Description --}}
                <p class="text-sm text-gray-600 leading-relaxed mb-6">
                    Give a brief and clear description of the sensors used, how
                    they are integrated into the system, and how they collect and
                    interact with data from the physical environment.
                </p>


                {{-- Sensors --}}
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-5">

                    {{-- EC Sensor --}}
                    <div class="flex flex-col items-center text-center">

                        <div class="w-14 h-14 flex items-center justify-center mb-2">
                            <img
                                src="{{ asset('images/sensors/EC-Sensor.png') }}"
                                alt="EC Sensor"
                                class="w-11 h-11 object-contain"
                            >
                        </div>

                        <p class="text-xs text-gray-600 leading-tight">
                            To examine the EC level of the cocopeat
                        </p>

                    </div>


                    {{-- NPK Sensor --}}
                    <div class="flex flex-col items-center text-center">

                        <div class="w-14 h-14 flex items-center justify-center mb-2">
                            <img
                                src="{{ asset('images/sensors/NPK-Sensor.png') }}"
                                alt="EC Sensor"
                                class="w-11 h-11 object-contain"
                            >
                        </div>

                        <p class="text-xs text-gray-600 leading-tight">
                            To examine the nutrition of the cocopeat
                        </p>

                    </div>


                    {{-- pH Sensor --}}
                    <div class="flex flex-col items-center text-center">

                        <div class="w-14 h-14 flex items-center justify-center mb-2">
                            <img
                                src="{{ asset('images/sensors/pH-Sensor.png') }}"
                                alt="EC Sensor"
                                class="w-11 h-11 object-contain"
                            >
                        </div>

                        <p class="text-xs text-gray-600 leading-tight">
                            To examine the pH level of the cocopeat
                        </p>

                    </div>


                    {{-- Soil Moisture --}}
                    <div class="flex flex-col items-center text-center">

                        <div class="w-14 h-14 flex items-center justify-center mb-2">
                            <img
                                src="{{ asset('images/sensors/Moisture-Sensor.png') }}"
                                alt="EC Sensor"
                                class="w-11 h-11 object-contain"
                            >
                        </div>

                        <p class="text-xs text-gray-600 leading-tight">
                            To examine the moisture of the cocopeat
                        </p>

                    </div>


                    {{-- Temperature & Humidity --}}
                    <div class="flex flex-col items-center text-center">

                        <div class="w-14 h-14 flex items-center justify-center mb-2">
                            <img
                                src="{{ asset('images/sensors/DHT-Sensor.png') }}"
                                alt="EC Sensor"
                                class="w-11 h-11 object-contain"
                            >
                        </div>

                        <p class="text-xs text-gray-600 leading-tight">
                            To examine temperature and humidity
                        </p>

                    </div>


                    {{-- Ultrasonic / Water Level --}}
                    <div class="flex flex-col items-center text-center">

                         <div class="w-14 h-14 flex items-center justify-center mb-2">
                            <img
                                src="{{ asset('images/sensors/Ultrasonic-Sensor.png') }}"
                                alt="EC Sensor"
                                class="w-11 h-11 object-contain"
                            >
                        </div>

                        <p class="text-xs text-gray-600 leading-tight">
                            To check if the water is above or below the threshold
                        </p>

                    </div>

                </div>

            </div>


            {{-- Vision --}}
            <div class="bg-white rounded-2xl border border-[#356744] p-5 lg:p-6 shadow-sm">

                <div class="flex items-center gap-3 mb-4">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-9 h-9 text-[#356744]"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M2.25 12s3.75-6.75 9.75-6.75S21.75 12 21.75 12 18 18.75 12 18.75 2.25 12 2.25 12Z"
                        />
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                        />
                    </svg>

                    <h2 class="text-xl font-bold text-[#2b6444]">
                        Vision
                    </h2>
                </div>

                <p class="text-sm text-gray-600 leading-relaxed">
                    MelonTrack envisions helping farmers consistently produce
                    high-quality muskmelons through controlled greenhouse environments.
                    Through better management of temperature, humidity, irrigation,
                    nutrients, and other cultivation conditions, the platform supports
                    growers in optimizing fruit quality and reducing crop rejection.
                </p>

                <p class="text-sm text-gray-600 leading-relaxed mt-3">
                    By providing growers with accurate and accessible information
                    throughout the cultivation process, MelonTrack aims to improve yield,
                    support premium-quality production, and increase the market value of
                    harvested melons.
                </p>

            </div>

        </div>

        {{-- ========================================================= --}}
        {{-- SMS NOTIFICATION --}}
        {{-- ========================================================= --}}
        <div class="bg-white rounded-2xl border border-[#356744] p-5 lg:p-6 shadow-sm mb-5">

            {{-- Header --}}
            <div class="flex items-center gap-3 mb-3">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-9 h-9 text-[#356744] shrink-0"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.142-4.03 7.5-9 7.5a10.22 10.22 0 0 1-4.044-.806L3 21l1.473-4.091C3.385 15.593 3 13.844 3 12c0-4.142 4.03-7.5 9-7.5s9 3.358 9 7.5Z"
                    />
                </svg>

                <div>
                    <h2 class="text-xl font-bold text-[#2b6444]">
                        SMS Notification
                    </h2>

                    <p class="text-xs text-gray-500 mt-1">
                        Real-time sensor status alerts and notifications
                    </p>
                </div>
            </div>

            {{-- Description --}}
            <p class="text-sm text-gray-600 leading-relaxed mb-6">
                The SMS notification feature in MelonTrack is designed to immediately
                inform users when sensors fail, stop transmitting data, or show abnormal
                behavior. This allows farm personnel to respond quickly and prevent
                inaccurate monitoring results that may affect melon growth,
                environmental control, and cultivation decisions. Notifications include
                the affected sensor, issue detected, timestamp, and recommended action.
            </p>

            {{-- SMS Notification Image --}}
            {{-- <div class="mb-6 flex justify-center">
                <img
                    src="{{ asset('images/SMS.png') }}"
                    alt="MelonTrack SMS Notification"
                    class="w-48 h-auto object-contain rounded-xl"
                >
            </div> --}}


            {{-- Sensor Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">

                {{-- ================================================= --}}
                {{-- DHT11 SENSOR --}}
                {{-- ================================================= --}}
                <div class="rounded-2xl border border-gray-200 p-4">

                    <div class="flex items-center gap-3 mb-4">
                        <div
                            class="w-10 h-10 rounded-full flex items-center justify-center shrink-0"
                            style="background-color: #e5f3df;"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-6 h-6 text-[#356744]"
                            >
                                {{-- Thermometer --}}
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M8.5 13.5V5.5a2 2 0 1 1 4 0v8
                                    a4 4 0 1 1-4 0Z"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M10.5 9v6"
                                />

                                {{-- Humidity Droplet --}}
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M17.5 5.5
                                    C17.5 5.5 15 8.5 15 10.5
                                    a2.5 2.5 0 0 0 5 0
                                    c0-2-2.5-5-2.5-5Z"
                                />
                            </svg>
                        </div>

                        <div>
                            <h3 class="font-bold text-gray-800">
                                DHT11 Sensor
                            </h3>
                            <p class="text-xs text-gray-500">
                                Temperature & Humidity
                            </p>
                        </div>
                    </div>

                    {{-- Unstable --}}
                    <div
                        class="rounded-xl p-4 mb-3"
                        style="background-color: #fff8e6;"
                    >
                        <div class="flex items-center gap-2 mb-2">
                            <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                            <h4 class="text-sm font-semibold text-amber-700">
                                Unstable Reading
                            </h4>
                        </div>

                        <p class="text-xs text-gray-600 leading-relaxed">
                            <strong>MelonTrack Alert:</strong><br>
                            Sensor "DHT11" is showing unstable readings in Block __.
                            Data may be inaccurate. Please inspect the sensor condition
                            and connection.
                        </p>

                        <p class="text-xs text-gray-500 mt-2">
                            Time: [Date & Time]
                        </p>
                    </div>

                    {{-- Offline --}}
                    <div
                        class="rounded-xl p-4"
                        style="background-color: #fdecec;"
                    >
                        <div class="flex items-center gap-2 mb-2">
                            <span class="w-2 h-2 rounded-full bg-red-500"></span>
                            <h4 class="text-sm font-semibold text-red-700">
                                Sensor Offline
                            </h4>
                        </div>

                        <p class="text-xs text-gray-600 leading-relaxed">
                            <strong>MelonTrack Alert:</strong><br>
                            Sensor "DHT11" is not responding. No data received for more
                            than 30 minutes. Please check the sensor connection or
                            replace the device.
                        </p>

                        <p class="text-xs text-gray-500 mt-2">
                            Time: [Date & Time]
                        </p>
                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- PH SENSOR --}}
                {{-- ================================================= --}}
                <div class="rounded-2xl border border-gray-200 p-4">

                    <div class="flex items-center gap-3 mb-4">
                        <div
                            class="w-10 h-10 rounded-full flex items-center justify-center shrink-0"
                            style="background-color: #e4f0f2;"
                        >
                            <span class="text-sm font-bold text-[#356744]">
                                pH
                            </span>
                        </div>

                        <div>
                            <h3 class="font-bold text-gray-800">
                                pH Sensor
                            </h3>
                            <p class="text-xs text-gray-500">
                                Cocopeat pH Level
                            </p>
                        </div>
                    </div>

                    <div
                        class="rounded-xl p-4 mb-3"
                        style="background-color: #fff8e6;"
                    >
                        <div class="flex items-center gap-2 mb-2">
                            <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                            <h4 class="text-sm font-semibold text-amber-700">
                                Irregular Values
                            </h4>
                        </div>

                        <p class="text-xs text-gray-600 leading-relaxed">
                            <strong>MelonTrack Alert:</strong><br>
                            Sensor "pH Level" is generating irregular values.
                            Calibration may be required. Please inspect the sensor.
                        </p>

                        <p class="text-xs text-gray-500 mt-2">
                            Time: [Date & Time]
                        </p>
                    </div>

                    <div
                        class="rounded-xl p-4"
                        style="background-color: #fdecec;"
                    >
                        <div class="flex items-center gap-2 mb-2">
                            <span class="w-2 h-2 rounded-full bg-red-500"></span>
                            <h4 class="text-sm font-semibold text-red-700">
                                Sensor Offline
                            </h4>
                        </div>

                        <p class="text-xs text-gray-600 leading-relaxed">
                            <strong>MelonTrack Alert:</strong><br>
                            Sensor "pH Level" is not responding. No data has been
                            received. Please check the sensor connection or replace
                            the probe.
                        </p>

                        <p class="text-xs text-gray-500 mt-2">
                            Time: [Date & Time]
                        </p>
                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- EC SENSOR --}}
                {{-- ================================================= --}}
                <div class="rounded-2xl border border-gray-200 p-4">

                    <div class="flex items-center gap-3 mb-4">
                        <div
                            class="w-10 h-10 rounded-full flex items-center justify-center shrink-0"
                            style="background-color: #e8edf3;"
                        >
                            <span class="text-sm font-bold text-[#356744]">
                                EC
                            </span>
                        </div>

                        <div>
                            <h3 class="font-bold text-gray-800">
                                EC Sensor
                            </h3>
                            <p class="text-xs text-gray-500">
                                Electrical Conductivity
                            </p>
                        </div>
                    </div>

                    <div
                        class="rounded-xl p-4 mb-3"
                        style="background-color: #fff8e6;"
                    >
                        <div class="flex items-center gap-2 mb-2">
                            <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                            <h4 class="text-sm font-semibold text-amber-700">
                                Unstable Measurement
                            </h4>
                        </div>

                        <p class="text-xs text-gray-600 leading-relaxed">
                            <strong>MelonTrack Alert:</strong><br>
                            Sensor "EC Level" is showing unstable measurements.
                            Please inspect sensor calibration and nutrient solution
                            buildup.
                        </p>

                        <p class="text-xs text-gray-500 mt-2">
                            Time: [Date & Time]
                        </p>
                    </div>

                    <div
                        class="rounded-xl p-4"
                        style="background-color: #fdecec;"
                    >
                        <div class="flex items-center gap-2 mb-2">
                            <span class="w-2 h-2 rounded-full bg-red-500"></span>
                            <h4 class="text-sm font-semibold text-red-700">
                                Sensor Offline
                            </h4>
                        </div>

                        <p class="text-xs text-gray-600 leading-relaxed">
                            <strong>MelonTrack Alert:</strong><br>
                            Sensor "EC Level" is offline. No monitoring data detected.
                            Please check the device.
                        </p>

                        <p class="text-xs text-gray-500 mt-2">
                            Time: [Date & Time]
                        </p>
                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- NPK SENSOR --}}
                {{-- ================================================= --}}
                <div class="rounded-2xl border border-gray-200 p-4">

                    <div class="flex items-center gap-3 mb-4">
                        <div
                            class="w-10 h-10 rounded-full flex items-center justify-center shrink-0"
                            style="background-color: #e5f3df;"
                        >
                            <span class="text-xs font-bold text-[#356744]">
                                NPK
                            </span>
                        </div>

                        <div>
                            <h3 class="font-bold text-gray-800">
                                NPK Sensor
                            </h3>
                            <p class="text-xs text-gray-500">
                                Nutrient Monitoring
                            </p>
                        </div>
                    </div>

                    <div
                        class="rounded-xl p-4 mb-3"
                        style="background-color: #fff8e6;"
                    >
                        <div class="flex items-center gap-2 mb-2">
                            <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                            <h4 class="text-sm font-semibold text-amber-700">
                                Inconsistent Values
                            </h4>
                        </div>

                        <p class="text-xs text-gray-600 leading-relaxed">
                            <strong>MelonTrack Alert:</strong><br>
                            Sensor "NPK Nutrient" is reporting inconsistent nutrient
                            values. Please inspect the sensor and recalibrate.
                        </p>

                        <p class="text-xs text-gray-500 mt-2">
                            Time: [Date & Time]
                        </p>
                    </div>

                    <div
                        class="rounded-xl p-4"
                        style="background-color: #fdecec;"
                    >
                        <div class="flex items-center gap-2 mb-2">
                            <span class="w-2 h-2 rounded-full bg-red-500"></span>
                            <h4 class="text-sm font-semibold text-red-700">
                                Sensor Offline
                            </h4>
                        </div>

                        <p class="text-xs text-gray-600 leading-relaxed">
                            <strong>MelonTrack Alert:</strong><br>
                            Sensor "NPK Nutrient" is not responding. No nutrient data
                            received for an extended period.
                        </p>

                        <p class="text-xs text-gray-500 mt-2">
                            Time: [Date & Time]
                        </p>
                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- SOIL MOISTURE SENSOR --}}
                {{-- ================================================= --}}
                <div class="rounded-2xl border border-gray-200 p-4">

                    <div class="flex items-center gap-3 mb-4">
                        <div
                            class="w-10 h-10 rounded-full flex items-center justify-center shrink-0"
                            style="background-color: #e4f0f2;"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-6 h-6 text-[#356744]"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 3.75S6.75 9 6.75 14.25a5.25 5.25 0 0 0 10.5 0C17.25 9 12 3.75 12 3.75Z"
                                />
                            </svg>
                        </div>

                        <div>
                            <h3 class="font-bold text-gray-800">
                                Soil Moisture Sensor
                            </h3>
                            <p class="text-xs text-gray-500">
                                Cocopeat Moisture
                            </p>
                        </div>
                    </div>

                    <div
                        class="rounded-xl p-4 mb-3"
                        style="background-color: #fff8e6;"
                    >
                        <div class="flex items-center gap-2 mb-2">
                            <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                            <h4 class="text-sm font-semibold text-amber-700">
                                Abnormal Fluctuation
                            </h4>
                        </div>

                        <p class="text-xs text-gray-600 leading-relaxed">
                            <strong>MelonTrack Alert:</strong><br>
                            Sensor "Soil Moisture" is showing abnormal fluctuations.
                            Please inspect wiring and sensor placement.
                        </p>

                        <p class="text-xs text-gray-500 mt-2">
                            Time: [Date & Time]
                        </p>
                    </div>

                    <div
                        class="rounded-xl p-4"
                        style="background-color: #fdecec;"
                    >
                        <div class="flex items-center gap-2 mb-2">
                            <span class="w-2 h-2 rounded-full bg-red-500"></span>
                            <h4 class="text-sm font-semibold text-red-700">
                                Sensor Offline
                            </h4>
                        </div>

                        <p class="text-xs text-gray-600 leading-relaxed">
                            <strong>MelonTrack Alert:</strong><br>
                            Sensor "Soil Moisture" is offline. No readings received.
                            Please check sensor condition.
                        </p>

                        <p class="text-xs text-gray-500 mt-2">
                            Time: [Date & Time]
                        </p>
                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- ULTRASONIC SENSOR --}}
                {{-- ================================================= --}}
                <div class="rounded-2xl border border-gray-200 p-4">

                    <div class="flex items-center gap-3 mb-4">
                        <div
                            class="w-10 h-10 rounded-full flex items-center justify-center shrink-0"
                            style="background-color: #f0eee5;"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-6 h-6 text-[#356744]"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M8.25 6.75a7.5 7.5 0 0 0 0 10.5m3-7.5a3.75 3.75 0 0 0 0 4.5m4.5-7.5a7.5 7.5 0 0 1 0 10.5m-3-7.5a3.75 3.75 0 0 1 0 4.5"
                                />
                            </svg>
                        </div>

                        <div>
                            <h3 class="font-bold text-gray-800">
                                Ultrasonic Sensor
                            </h3>
                            <p class="text-xs text-gray-500">
                                Water Level Monitoring
                            </p>
                        </div>
                    </div>

                    <div
                        class="rounded-xl p-4 mb-3"
                        style="background-color: #fff8e6;"
                    >
                        <div class="flex items-center gap-2 mb-2">
                            <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                            <h4 class="text-sm font-semibold text-amber-700">
                                Irregular Values
                            </h4>
                        </div>

                        <p class="text-xs text-gray-600 leading-relaxed">
                            <strong>MelonTrack Alert:</strong><br>
                            Sensor "Ultrasonic" is reporting irregular values. Please
                            inspect sensor placement and calibration.
                        </p>

                        <p class="text-xs text-gray-500 mt-2">
                            Time: [Date & Time]
                        </p>
                    </div>

                    <div
                        class="rounded-xl p-4"
                        style="background-color: #fdecec;"
                    >
                        <div class="flex items-center gap-2 mb-2">
                            <span class="w-2 h-2 rounded-full bg-red-500"></span>
                            <h4 class="text-sm font-semibold text-red-700">
                                Sensor Offline
                            </h4>
                        </div>

                        <p class="text-xs text-gray-600 leading-relaxed">
                            <strong>MelonTrack Alert:</strong><br>
                            Sensor "Ultrasonic" is offline. No data received from the
                            device.
                        </p>

                        <p class="text-xs text-gray-500 mt-2">
                            Time: [Date & Time]
                        </p>
                    </div>

                </div>

            </div>


            {{-- Notification Legend --}}
            <div class="flex flex-wrap items-center gap-5 mt-5 pt-4 border-t border-gray-200">

                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                    <span class="text-xs text-gray-600">
                        Sensor requires inspection
                    </span>
                </div>

                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-red-500"></span>
                    <span class="text-xs text-gray-600">
                        Sensor is offline / not responding
                    </span>
                </div>

            </div>

        </div>

    </div>
</div>