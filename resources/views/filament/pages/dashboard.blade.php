<x-filament-panels::page>
    <wireui:scripts />
    @livewireStyles
    @livewireScripts
    @vite(['resources/css/custom.css', 'resources/css/app.css', 'resources/js/app.js'])

    <div class="mb-6">
        <h1 class="text-3xl font-bold flex items-center gap-2">
            Welcome back,
            <span class="text-[#356744]">
                {{ auth()->user()->name }}!
            </span>
            <img 
                src="{{ asset('images/leaf-icon.png') }}" 
                alt="Leaf Icon"
                class="w-10 h-10 object-contain bg-white rounded-md shadow-sm rotate-[40deg]"
            >
        </h1>

        <p class="text-gray-500 mt-1">
            Here's what's happening in your farm today.
        </p>
    </div>

    <livewire:pages.dashboard />

    <script type="module">
        import { initializeApp } from 'https://www.gstatic.com/firebasejs/10.14.1/firebase-app.js'

        import { getAuth } from 'https://www.gstatic.com/firebasejs/10.14.1/firebase-auth.js'
        import { getFirestore } from 'https://www.gstatic.com/firebasejs/10.14.1/firebase-firestore.js'
        import { getDatabase, ref, onValue } from 'https://www.gstatic.com/firebasejs/10.14.1/firebase-database.js';
        
        // Initialize Firebase (replace with your Firebase config)
        var apiKey = "{{ env('API_KEY_FRB')}}";
        var authDomain = "{{ env('AUTH_DOMAIN')}}";
        var databaseURL = "https://melontrack-6846a-default-rtdb.asia-southeast1.firebasedatabase.app";
        var projectId = "{{ env('PROJECT_ID_FRB') }}";
        var storageBucket = "{{ env('STORAGE_BUCKET_FRB') }}";
        var messagingSenderId = "{{ env('MESSAGING_SENDER_ID_FRB') }}";
        var appId = "{{ env('APP_ID_FRB') }}";
       
        // Initialize Firebase (replace with your Firebase config)
        const firebaseConfig = {
            apiKey: apiKey,
            authDomain: authDomain,
            databaseURL: databaseURL,
            projectId: projectId,
            storageBucket: storageBucket,
            messagingSenderId: messagingSenderId,
            appId: appId
        };
        
    
        // Initialize Firebase app and database
        const app = initializeApp(firebaseConfig);

        const database = getDatabase(app);
    
        // Listen for real-time updates on Temperature
        const temperatureRef = ref(database, 'Temperature/SensorValue');
        onValue(temperatureRef, (snapshot) => {
            const temperature = snapshot.val();
            console.log('Temperature: ', temperature);
            // Trigger Livewire update (assuming you have a Livewire listener)
            Livewire.dispatch('updateTemperature', { temperature: temperature});
        });
        const temperatureMinRef = ref(database, 'Temperature/Min');
        onValue(temperatureMinRef, (snapshot) => {
            const temperatureMin = snapshot.val();
            console.log('Temperature Min: ', temperatureMin);
            // Trigger Livewire update (assuming you have a Livewire listener)
            Livewire.dispatch('updateMinTemperature', { minTemperature: temperatureMin});
        });
        const temperatureMaxRef = ref(database, 'Temperature/Max');
        onValue(temperatureMaxRef, (snapshot) => {
            const temperatureMax = snapshot.val();
            console.log('Temperature Max: ', temperatureMax);
            // Trigger Livewire update (assuming you have a Livewire listener)
            Livewire.dispatch('updateMaxTemperature', { maxTemperature: temperatureMax});
        });

        // Listen for real-time updates on Humidity
        const humidityRef = ref(database, 'Humidity/SensorValue');
        onValue(humidityRef, (snapshot) => {
            const humidity = snapshot.val();
            console.log('Humidity: ', humidity);
            // Trigger Livewire update (assuming you have a Livewire listener)
            Livewire.dispatch('updateHumidity', { humidity: humidity});
        });
        const humidityMinRef = ref(database, 'Humidity/Min');
        onValue(humidityMinRef, (snapshot) => {
            const humidityMin = snapshot.val();
            console.log('Humidity Min: ', humidityMin);
            // Trigger Livewire update (assuming you have a Livewire listener)
            Livewire.dispatch('updateMinHumidity', { minHumidity: humidityMin});
        });
        const humidityMaxRef = ref(database, 'Humidity/Max');
        onValue(humidityMaxRef, (snapshot) => {
            const humidityMax = snapshot.val();
            console.log('Humidity Max: ', humidityMax);
            // Trigger Livewire update (assuming you have a Livewire listener)
            Livewire.dispatch('updateMaxHumidity', { maxHumidity: humidityMax});
        });


        // Listen for real-time updates on Soil Moisture
        const soilMoistureRef = ref(database, 'SoilMoisture/SensorValue');
        onValue(soilMoistureRef, (snapshot) => {
            const soilMoisture = snapshot.val();
            console.log('Soil Moisture: ', soilMoisture);
            // Trigger Livewire update (assuming you have a Livewire listener)
            Livewire.dispatch('updateSoilMoisture', { soilMoisture: soilMoisture});
        });
        const soilMoistureMinRef = ref(database, 'SoilMoisture/Min');
        onValue(soilMoistureMinRef, (snapshot) => {
            const soilMoistureMin = snapshot.val();
            console.log('Soil Moisture Min: ', soilMoistureMin);
            // Trigger Livewire update (assuming you have a Livewire listener)
            Livewire.dispatch('updateMinSoilMoisture', { minSoilMoisture: soilMoistureMin});
        });
        const soilMoistureMaxRef = ref(database, 'SoilMoisture/Max');
        onValue(soilMoistureMaxRef, (snapshot) => {
            const soilMoistureMax = snapshot.val();
            console.log('Soil Moisture Max: ', soilMoistureMax);
            // Trigger Livewire update (assuming you have a Livewire listener)
            Livewire.dispatch('updateMaxSoilMoisture', { maxSoilMoisture: soilMoistureMax});
        });

        // Listen for real-time updates on EC Level
        const ecLevelRef = ref(database, 'ECLevel/SensorValue');
        onValue(ecLevelRef, (snapshot) => {
            const eclevel = snapshot.val();
            console.log('EC Level: ', eclevel);
            // Trigger Livewire update (assuming you have a Livewire listener)
            Livewire.dispatch('updateECLevel', { ecLevel: eclevel});
        });
        const ecLevelMinRef = ref(database, 'ECLevel/Min');
        onValue(ecLevelMinRef, (snapshot) => {
            const eclevelMin = snapshot.val();
            console.log('EC Level Min: ', eclevelMin);
            // Trigger Livewire update (assuming you have a Livewire listener)
            Livewire.dispatch('updateMinECLevel', { minECLevel: eclevelMin});
        });
        const ecLevelMaxRef = ref(database, 'ECLevel/Max');
        onValue(ecLevelMaxRef, (snapshot) => {
            const eclevelMax = snapshot.val();
            console.log('EC Level Max: ', eclevelMax);
            // Trigger Livewire update (assuming you have a Livewire listener)
            Livewire.dispatch('updateMaxECLevel', { maxECLevel: eclevelMax});
        });

        // Listen for real-time updates on pH Level
        const pHLevelRef = ref(database, 'pHLevel/SensorValue');
        onValue(pHLevelRef, (snapshot) => {
            const pHlevel = snapshot.val();
            console.log('pH Level: ', pHlevel);
            // Trigger Livewire update (assuming you have a Livewire listener)
            Livewire.dispatch('updatepHLevel', { pHLevel: pHlevel});
        });
        const pHLevelMinRef = ref(database, 'pHLevel/Min');
        onValue(pHLevelMinRef, (snapshot) => {
            const pHlevelMin = snapshot.val();
            console.log('pH Level Min: ', pHlevelMin);
            // Trigger Livewire update (assuming you have a Livewire listener)
            Livewire.dispatch('updateMinpHLevel', { minpHLevel: pHlevelMin});
        });
        const pHLevelMaxRef = ref(database, 'pHLevel/Max');
        onValue(pHLevelMaxRef, (snapshot) => {
            const pHlevelMax = snapshot.val();
            console.log('pH Level Max: ', pHlevelMax);
            // Trigger Livewire update (assuming you have a Livewire listener)
            Livewire.dispatch('updateMaxpHLevel', { maxpHLevel: pHlevelMax});
        });
        
        // Listen for real-time updates on Nitrogen
        const nitrogenRef = ref(database, 'Nitrogen/SensorValue');
        onValue(nitrogenRef, (snapshot) => {
            const nitrogen = snapshot.val();
            console.log('Nitrogen: ', nitrogen);
            Livewire.dispatch('updateNitrogen', { nitrogen: nitrogen});
        });
        const nitrogenMinRef = ref(database, 'Nitrogen/Min');
        onValue(nitrogenMinRef, (snapshot) => {
            const nitrogenMin = snapshot.val();
            console.log('Nitrogen Min: ', nitrogenMin);
            Livewire.dispatch('updateMinNitrogen', { minNitrogen: nitrogenMin});
        });
        const nitrogenMaxRef = ref(database, 'Nitrogen/Max');
        onValue(nitrogenMaxRef, (snapshot) => {
            const nitrogenMax = snapshot.val();
            console.log('Nitrogen Max: ', nitrogenMax);
            Livewire.dispatch('updateMaxNitrogen', { maxNitrogen: nitrogenMax});
        });


        // Listen for real-time updates on Phosphorus
        const phosphorusRef = ref(database, 'Phosphorus/SensorValue');
        onValue(phosphorusRef, (snapshot) => {
            const phosphorus = snapshot.val();
            console.log('Phosphorus: ', phosphorus);
            Livewire.dispatch('updatePhosphorus', { phosphorus: phosphorus});
        });
        const phosphorusMinRef = ref(database, 'Phosphorus/Min');
        onValue(phosphorusMinRef, (snapshot) => {
            const phosphorusMin = snapshot.val();
            console.log('Phosphorus Min: ', phosphorusMin);
            Livewire.dispatch('updateMinPhosphorus', { minPhosphorus: phosphorusMin});
        });
        const phosphorusMaxRef = ref(database, 'Phosphorus/Max');
        onValue(phosphorusMaxRef, (snapshot) => {
            const phosphorusMax = snapshot.val();
            console.log('Phosphorus Max: ', phosphorusMax);
            Livewire.dispatch('updateMaxPhosphorus', { maxPhosphorus: phosphorusMax});
        });
        

        // Listen for real-time updates on Potassium
        const potassiumRef = ref(database, 'Potassium/SensorValue');
        onValue(potassiumRef, (snapshot) => {
            const potassium = snapshot.val();
            console.log('Potassium: ', potassium);
            Livewire.dispatch('updatePotassium', { potassium: potassium});
        });
        const potassiumMinRef = ref(database, 'Potassium/Min');
        onValue(potassiumMinRef, (snapshot) => {
            const potassiumMin = snapshot.val();
            console.log('Potassium Min: ', potassiumMin);
            Livewire.dispatch('updateMinPotassium', { minPotassium: potassiumMin});
        });
        const potassiumMaxRef = ref(database, 'Potassium/Max');
        onValue(potassiumMaxRef, (snapshot) => {
            const potassiumMax = snapshot.val();
            console.log('Potassium Max: ', potassiumMax);
            Livewire.dispatch('updateMaxPotassium', { maxPotassium: potassiumMax});
        });


        // ============================
        // Soil Moisture 2
        // ============================

        const soilMoisture2Ref = ref(database, 'SoilMoisture2/SensorValue');
        onValue(soilMoisture2Ref, (snapshot) => {
            Livewire.dispatch('updateSoilMoisture2', {
                soilMoisture2: snapshot.val()
            });
        });

        const soilMoisture2MinRef = ref(database, 'SoilMoisture2/Min');
        onValue(soilMoisture2MinRef, (snapshot) => {
            Livewire.dispatch('updateMinSoilMoisture2', {
                minSoilMoisture2: snapshot.val()
            });
        });

        const soilMoisture2MaxRef = ref(database, 'SoilMoisture2/Max');
        onValue(soilMoisture2MaxRef, (snapshot) => {
            Livewire.dispatch('updateMaxSoilMoisture2', {
                maxSoilMoisture2: snapshot.val()
            });
        });


        // ============================
        // Water Level
        // ============================

        const waterLevelRef = ref(database, 'WaterLevel/SensorValue');
        onValue(waterLevelRef, (snapshot) => {
            Livewire.dispatch('updateWaterLevel', {
                waterLevel: snapshot.val()
            });
        });

        const waterLevelMinRef = ref(database, 'WaterLevel/Min');
        onValue(waterLevelMinRef, (snapshot) => {
            Livewire.dispatch('updateMinWaterLevel', {
                minWaterLevel: snapshot.val()
            });
        });

        const waterLevelMaxRef = ref(database, 'WaterLevel/Max');
        onValue(waterLevelMaxRef, (snapshot) => {
            Livewire.dispatch('updateMaxWaterLevel', {
                maxWaterLevel: snapshot.val()
            });
        });


        // ============================
        // Nitrogen 2
        // ============================

        const nitrogen2Ref = ref(database, 'Nitrogen2/SensorValue');
        onValue(nitrogen2Ref, (snapshot) => {
            Livewire.dispatch('updateNitrogen2', {
                nitrogen2: snapshot.val()
            });
        });

        const nitrogen2MinRef = ref(database, 'Nitrogen2/Min');
        onValue(nitrogen2MinRef, (snapshot) => {
            Livewire.dispatch('updateMinNitrogen2', {
                minNitrogen2: snapshot.val()
            });
        });

        const nitrogen2MaxRef = ref(database, 'Nitrogen2/Max');
        onValue(nitrogen2MaxRef, (snapshot) => {
            Livewire.dispatch('updateMaxNitrogen2', {
                maxNitrogen2: snapshot.val()
            });
        });


        // ============================
        // Phosphorus 2
        // ============================

        const phosphorus2Ref = ref(database, 'Phosphorus2/SensorValue');
        onValue(phosphorus2Ref, (snapshot) => {
            Livewire.dispatch('updatePhosphorus2', {
                phosphorus2: snapshot.val()
            });
        });

        const phosphorus2MinRef = ref(database, 'Phosphorus2/Min');
        onValue(phosphorus2MinRef, (snapshot) => {
            Livewire.dispatch('updateMinPhosphorus2', {
                minPhosphorus2: snapshot.val()
            });
        });

        const phosphorus2MaxRef = ref(database, 'Phosphorus2/Max');
        onValue(phosphorus2MaxRef, (snapshot) => {
            Livewire.dispatch('updateMaxPhosphorus2', {
                maxPhosphorus2: snapshot.val()
            });
        });


        // ============================
        // Potassium 2
        // ============================

        const potassium2Ref = ref(database, 'Potassium2/SensorValue');
        onValue(potassium2Ref, (snapshot) => {
            Livewire.dispatch('updatePotassium2', {
                potassium2: snapshot.val()
            });
        });

        const potassium2MinRef = ref(database, 'Potassium2/Min');
        onValue(potassium2MinRef, (snapshot) => {
            Livewire.dispatch('updateMinPotassium2', {
                minPotassium2: snapshot.val()
            });
        });

        const potassium2MaxRef = ref(database, 'Potassium2/Max');
        onValue(potassium2MaxRef, (snapshot) => {
            Livewire.dispatch('updateMaxPotassium2', {
                maxPotassium2: snapshot.val()
            });
        });
    </script>

    <script>
        window.addEventListener('reload', event => {
            window.location.reload();
        })
    </script>
</x-filament-panels::page>
