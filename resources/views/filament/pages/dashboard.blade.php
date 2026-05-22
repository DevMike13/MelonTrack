<x-filament-panels::page>
    <wireui:scripts />
    @livewireStyles
    @livewireScripts
    @vite(['resources/css/custom.css', 'resources/css/app.css', 'resources/js/app.js'])

    <livewire:pages.dashboard />

    {{-- <script type="module">
        import { initializeApp } from 'https://www.gstatic.com/firebasejs/10.14.1/firebase-app.js'

        import { getAuth } from 'https://www.gstatic.com/firebasejs/10.14.1/firebase-auth.js'
        import { getFirestore } from 'https://www.gstatic.com/firebasejs/10.14.1/firebase-firestore.js'
        import { getDatabase, ref, onValue } from 'https://www.gstatic.com/firebasejs/10.14.1/firebase-database.js';

        var apiKey = "{{ env('API_KEY_FRB')}}";
        var authDomain = "{{ env('AUTH_DOMAIN')}}";
        var databaseURL = "https://ibroccogreens-223d1-default-rtdb.asia-southeast1.firebasedatabase.app";
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
    
        const app = initializeApp(firebaseConfig);

        const database = getDatabase(app);
        
        // Listen to Soil Moisture
        const soilMoistureRef = ref(database, 'SensorReadings/SoilMoisture');
        onValue(soilMoistureRef, (snapshot) => {
            const soilMoistureLevel = snapshot.val();
            console.log('Soil Moisture Level: ', soilMoistureLevel);
            Livewire.dispatch('updateSoilMoistureLevel', { soilMoistureLevel: soilMoistureLevel});
        });

        // Listen to Soil PH
        const soilPHRef = ref(database, 'SensorReadings/SoilPH');
        onValue(soilPHRef, (snapshot) => {
            const soilPHLevel = snapshot.val();
            console.log('Soil PH Level: ', soilPHLevel);
            Livewire.dispatch('updateSoilPHLevel', { soilPHLevel: soilPHLevel});
        });

        // Listen to Water PH
        const waterPHRef = ref(database, 'SensorReadings/WaterPH');
        onValue(waterPHRef, (snapshot) => {
            const waterPHLevel = snapshot.val();
            console.log('Water PH Level: ', waterPHLevel);
            Livewire.dispatch('updateWaterPHLevel', { waterPHLevel: waterPHLevel});
        });

        // Listen to Temperature
        const temperatureRef = ref(database, 'SensorReadings/Temperature');
        onValue(temperatureRef, (snapshot) => {
            const temperatureLevel = snapshot.val();
            console.log('Temperature Level: ', temperatureLevel);
            Livewire.dispatch('updateTemperatureLevel', { temperatureLevel: temperatureLevel});
        });

        // Listen to Humidity
        const humidityRef = ref(database, 'SensorReadings/Humidity');
        onValue(humidityRef, (snapshot) => {
            const humidityLevel = snapshot.val();
            console.log('Humidity Level: ', humidityLevel);
            Livewire.dispatch('updateHumidityLevel', { humidityLevel: humidityLevel});
        });
        
        // Listen to Air Flow
        const airFlowRef = ref(database, 'SensorReadings/AirFlow');
        onValue(airFlowRef, (snapshot) => {
            const airFlowLevel = snapshot.val();
            console.log('Air Flow Level: ', airFlowLevel);
            Livewire.dispatch('updateAirFlowLevel', { airFlowLevel: airFlowLevel});
        });

        // Listen to Fan State
        const fanRef = ref(database, 'System/Fan');
        onValue(fanRef, (snapshot) => {
            const fanState = snapshot.val();
            console.log('Fan State: ', fanState);
            Livewire.dispatch('updateFanState', { fanState });
        });

        // Listen to Light State
        const lightRef = ref(database, 'System/Light');
        onValue(lightRef, (snapshot) => {
            const lightState = snapshot.val();
            console.log('Light State: ', lightState);
            Livewire.dispatch('updateLightState', { lightState });
        });

        // Listen to Misting System
        const mistingSystemRef = ref(database, 'System/MistingSystem');
        onValue(mistingSystemRef, (snapshot) => {
            const mistingSystem = snapshot.val();
            console.log('Misting System: ', mistingSystem);
            Livewire.dispatch('updateMistingSystem', { mistingSystem });
        });

        // Listen to Water Level
        const waterLevelRef = ref(database, 'System/WaterLevel');
        onValue(waterLevelRef, (snapshot) => {
            const waterLevel = snapshot.val();
            console.log('Water Level: ', waterLevel);
            Livewire.dispatch('updateWaterLevel', { waterLevel });
        });
    </script> --}}

    <script type="module">
        import { initializeApp } from 'https://www.gstatic.com/firebasejs/10.14.1/firebase-app.js'
        import { getAuth } from 'https://www.gstatic.com/firebasejs/10.14.1/firebase-auth.js'
        import { getFirestore } from 'https://www.gstatic.com/firebasejs/10.14.1/firebase-firestore.js'
        import { getDatabase, ref, onValue } from 'https://www.gstatic.com/firebasejs/10.14.1/firebase-database.js';
    
        var apiKey = "{{ env('API_KEY_FRB')}}";
        var authDomain = "{{ env('AUTH_DOMAIN')}}";
        var databaseURL = "https://ibroccogreens-223d1-default-rtdb.asia-southeast1.firebasedatabase.app";
        var projectId = "{{ env('PROJECT_ID_FRB') }}";
        var storageBucket = "{{ env('STORAGE_BUCKET_FRB') }}";
        var messagingSenderId = "{{ env('MESSAGING_SENDER_ID_FRB') }}";
        var appId = "{{ env('APP_ID_FRB') }}";
    
        const firebaseConfig = {
            apiKey: apiKey,
            authDomain: authDomain,
            databaseURL: databaseURL,
            projectId: projectId,
            storageBucket: storageBucket,
            messagingSenderId: messagingSenderId,
            appId: appId
        };
    
        const app = initializeApp(firebaseConfig);
        const database = getDatabase(app);
    
        let currentBoard = 'B1'; // Default value
    
        function listenToBoard(board) {
            // Update currentBoard reference
            currentBoard = board;
    
            // Base path
            const basePath = `${board}/`;
            
             // Listen to Master State
            const masterRef = ref(database, 'System/MasterControll');
            onValue(masterRef, (snapshot) => {
                const masterState = snapshot.val();
                console.log('Master State: ', masterState);
                Livewire.dispatch('updateMasterState', { masterState });
            });

            // Soil Moisture
            const soilMoistureRef = ref(database, 'B1/SoilMoisture');
            onValue(soilMoistureRef, (snapshot) => {
                const soilMoistureLevel = snapshot.val();
                console.log('Soil Moisture Level: ', soilMoistureLevel);
                Livewire.dispatch('updateSoilMoistureLevel', { soilMoistureLevel });
            });

            // Soil Moisture B2
            const soilMoistureRefB2 = ref(database, 'B2/SoilMoisture');
            onValue(soilMoistureRefB2, (snapshot) => {
                const soilMoistureLevelB2 = snapshot.val();
                console.log('Soil Moisture Level B2: ', soilMoistureLevelB2);
                Livewire.dispatch('updateSoilMoistureLevelB2', { soilMoistureLevelB2 });
            });

            // Soil Moisture B3
            const soilMoistureRefB3 = ref(database, 'B3/SoilMoisture');
            onValue(soilMoistureRefB3, (snapshot) => {
                const soilMoistureLevelB3 = snapshot.val();
                console.log('Soil Moisture Level B3: ', soilMoistureLevelB3);
                Livewire.dispatch('updateSoilMoistureLevelB3', { soilMoistureLevelB3 });
            });

            // Soil Moisture B4
            const soilMoistureRefB4 = ref(database, 'B4/SoilMoisture');
            onValue(soilMoistureRefB4, (snapshot) => {
                const soilMoistureLevelB4 = snapshot.val();
                console.log('Soil Moisture Level B4: ', soilMoistureLevelB4);
                Livewire.dispatch('updateSoilMoistureLevelB4', { soilMoistureLevelB4 });
            });
    
            // Soil PH
            const soilPHRef = ref(database, 'B1/SoilPH');
            onValue(soilPHRef, (snapshot) => {
                const soilPHLevel = snapshot.val();
                console.log('Soil PH Level: ', soilPHLevel);
                Livewire.dispatch('updateSoilPHLevel', { soilPHLevel });
            });

            // Soil PH B2
            const soilPHRefB2 = ref(database, 'B2/SoilPH');
            onValue(soilPHRefB2, (snapshot) => {
                const soilPHLevelB2 = snapshot.val();
                console.log('Soil PH Level B2: ', soilPHLevelB2 );
                Livewire.dispatch('updateSoilPHLevelB2', { soilPHLevelB2 });
            });

            // Soil PH B3
            const soilPHRefB3 = ref(database, 'B3/SoilPH');
            onValue(soilPHRefB3, (snapshot) => {
                const soilPHLevelB3 = snapshot.val();
                console.log('Soil PH Level B3: ', soilPHLevelB3 );
                Livewire.dispatch('updateSoilPHLevelB3', { soilPHLevelB3 });
            });

            // Soil PH B4
            const soilPHRefB4 = ref(database, 'B4/SoilPH');
            onValue(soilPHRefB4, (snapshot) => {
                const soilPHLevelB4 = snapshot.val();
                console.log('Soil PH Level B4: ', soilPHLevelB4 );
                Livewire.dispatch('updateSoilPHLevelB4', { soilPHLevelB4 });
            });
    
            // Water PH
            const waterPHRef = ref(database, 'B5/WaterPH');
            onValue(waterPHRef, (snapshot) => {
                const waterPHLevel = snapshot.val();
                console.log('Water PH Level: ', waterPHLevel);
                Livewire.dispatch('updateWaterPHLevel', { waterPHLevel });
            });
    
            // Temperature
            const temperatureRef = ref(database, 'B1/Temperature');
            onValue(temperatureRef, (snapshot) => {
                const temperatureLevel = snapshot.val();
                console.log('Temperature Level: ', temperatureLevel);
                Livewire.dispatch('updateTemperatureLevel', { temperatureLevel });
            });
    
            // Humidity
            const humidityRef = ref(database, 'B1/Humidity');
            onValue(humidityRef, (snapshot) => {
                const humidityLevel = snapshot.val();
                console.log('Humidity Level: ', humidityLevel);
                Livewire.dispatch('updateHumidityLevel', { humidityLevel });
            });
    
            // Listen to Fan State
            const fanRef = ref(database, 'System/Fan');
            onValue(fanRef, (snapshot) => {
                const fanState = snapshot.val();
                console.log('Fan State: ', fanState);
                Livewire.dispatch('updateFanState', { fanState });
            });

            // Listen to Light State
            const lightRef = ref(database, 'System/Light');
            onValue(lightRef, (snapshot) => {
                const lightState = snapshot.val();
                console.log('Light State: ', lightState);
                Livewire.dispatch('updateLightState', { lightState });
            });

            // Listen to Misting B1
            const mistingRef = ref(database, 'B1/Misting');
            onValue(mistingRef, (snapshot) => {
                const mistingB1 = snapshot.val();
                console.log('Misting B1: ', mistingB1);
                Livewire.dispatch('updateMisting', { mistingB1 });
            });

            // Listen to Misting B2
            const mistingB2Ref = ref(database, 'B2/Misting');
            onValue(mistingB2Ref, (snapshot) => {
                const mistingB2 = snapshot.val();
                console.log('Misting B2: ', mistingB2);
                Livewire.dispatch('updateMistingB2', { mistingB2 });
            });

            // Listen to Misting B3
            const mistingB3Ref = ref(database, 'B3/Misting');
            onValue(mistingB3Ref, (snapshot) => {
                const mistingB3 = snapshot.val();
                console.log('Misting B3: ', mistingB3);
                Livewire.dispatch('updateMistingB3', { mistingB3 });
            });

            // Listen to Misting B4
            const mistingB4Ref = ref(database, 'B4/Misting');
            onValue(mistingB4Ref, (snapshot) => {
                const mistingB4 = snapshot.val();
                console.log('Misting B4: ', mistingB4);
                Livewire.dispatch('updateMistingB4', { mistingB4 });
            });

            // Listen to Water Level
            const waterLevelRef = ref(database, 'System/WaterLevel');
            onValue(waterLevelRef, (snapshot) => {
                const waterLevel = snapshot.val();
                console.log('Water Level: ', waterLevel);
                Livewire.dispatch('updateWaterLevel', { waterLevel });
            });

           
        }
    
        listenToBoard(currentBoard);

        document.addEventListener("livewire:initialized", () => {
            Livewire.on("board-changed", ({ board }) => {
                console.log("Board changed to:", board);
                listenToBoard(board); 
            });
        });
    </script>
    
   
    <script>
        window.addEventListener('reload', event => {
            window.location.reload();
        })
    </script>
</x-filament-panels::page>
