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
        var databaseURL = "https://pondguard-e6c97-default-rtdb.firebaseio.com";
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
    
        // Listen for real-time updates on pH Level
        const phRef = ref(database, 'pHLevel/phLevel');
        onValue(phRef, (snapshot) => {
            const phLevel = snapshot.val();
            console.log('pH Level: ', phLevel);
            // Trigger Livewire update (assuming you have a Livewire listener)
            Livewire.dispatch('updatePhLevel', { phLevel: phLevel});
        });
    
        // Repeat for other parameters (DO, AL, WT)
        const doRef = ref(database, 'DissolvedOxygen/DO');
        onValue(doRef, (snapshot) => {
            const doLevel = snapshot.val();
            console.log('Dissolved Oxygen: ', doLevel);
            Livewire.dispatch('updateDOLevel', { doLevel: doLevel});
        });
    
        const alRef = ref(database, 'AlkalinityLevel/AL');
        onValue(alRef, (snapshot) => {
            const alLevel = snapshot.val();
            console.log('Alkalinity Level: ', alLevel);
            Livewire.dispatch('updateALLevel', { alLevel: alLevel});
        });
    
        const wtRef = ref(database, 'WaterTemperature/Temperature');
        onValue(wtRef, (snapshot) => {
            const wtLevel = snapshot.val();
            console.log('Water Temperature: ', wtLevel);
            Livewire.dispatch('updateWTLevel', { wtLevel: wtLevel});
        });
    </script>
    <script>
        window.addEventListener('reload', event => {
            window.location.reload();
        })
    </script>
</x-filament-panels::page>
