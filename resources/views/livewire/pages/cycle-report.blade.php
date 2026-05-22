<div>
    <div class="flex flex-row justify-between items-center mb-5">
        <h3 class="text-gray-500 italic">Harvest Count Data for Year: <span class="font-bold text-blue-600">{{ $selectedYear ?: now()->year }}</span></h3>
        <div class="h-auto w-1/2">
            <x-native-select
                label="Select Year"
                :options="$years"
                option-label="name"
                option-value="name"
                wire:model.live="selectedYear"
            />
        </div>
    </div>
   

    
    <div class="w-full">
        <canvas id="cycleReportChart"></canvas>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        
        var cycleData = @json($cycleData);
        
        console.log(cycleData);
        
        const ctx = document.getElementById('cycleReportChart');
        const cycle = cycleData.map(item => item.CycleNo);
        const values = cycleData.map(item => item.Value);
        
        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: cycle,  // Use the day labels
                datasets: [{
                    label: 'Harvest Count',
                    data: values, 
                    borderWidth: 1,
                    tension: 0.5,
                    borderColor: '#008000',
                    backgroundColor: '#008000',
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';

                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    // Format the number with up to two decimal places and append 'ppm'
                                    label += context.parsed.y + 'Kg';
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });
        
        Livewire.on('refreshChart', (newCycleData) => {
            cycleData = newCycleData;
        });
    </script>
</div>
