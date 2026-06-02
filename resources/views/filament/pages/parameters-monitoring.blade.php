<x-filament-panels::page>
    <wireui:scripts />
    @livewireStyles
    @livewireScripts
    @vite(['resources/css/custom.css', 'resources/css/app.css', 'resources/js/app.js'])

    <livewire:pages.parameters-monitoring />

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
    
        
    </script>
    <script>
        window.addEventListener('reload', event => {
            window.location.reload();
        })
    </script>
</x-filament-panels::page>
