<div class="space-y-6">

    <div>
        <h1 class="text-2xl font-bold text-black">
            Monthly Records
        </h1>
        <p class="text-sm text-gray-500">
            Average daily sensor readings by selected month.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mt-8">

        {{-- Cycles Created --}}
        <div class="bg-gradient-to-br from-green-50 to-white border border-green-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition">
            <div class="flex items-start justify-between">

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-green-700">
                        Cycles Created
                    </p>

                    <h3 class="text-3xl font-bold text-gray-900 mt-2">
                        {{ $cycleSummary['created'] ?? 0 }}
                    </h3>

                    <p class="text-xs text-gray-500 mt-3 leading-relaxed">
                        New crop cycles started during the selected month.
                    </p>
                </div>

                <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6 text-green-700"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 4v16m8-8H4"/>
                    </svg>
                </div>

            </div>
        </div>

        {{-- Completed --}}
        <div class="bg-gradient-to-br from-blue-50 to-white border border-blue-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition">
            <div class="flex items-start justify-between">

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-blue-700">
                        Cycles Completed
                    </p>

                    <h3 class="text-3xl font-bold text-gray-900 mt-2">
                        {{ $cycleSummary['completed'] ?? 0 }}
                    </h3>

                    <p class="text-xs text-gray-500 mt-3 leading-relaxed">
                        Crop cycles successfully harvested and finished.
                    </p>
                </div>

                <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6 text-blue-700"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 13l4 4L19 7"/>
                    </svg>
                </div>

            </div>
        </div>

        {{-- Ongoing --}}
        <div class="bg-gradient-to-br from-amber-50 to-white border border-amber-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition">
            <div class="flex items-start justify-between">

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-amber-700">
                        Ongoing Cycles
                    </p>

                    <h3 class="text-3xl font-bold text-gray-900 mt-2">
                        {{ $cycleSummary['ongoing'] ?? 0 }}
                    </h3>

                    <p class="text-xs text-gray-500 mt-3 leading-relaxed">
                        Active crop cycles currently being monitored.
                    </p>
                </div>

                <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6 text-amber-700"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 6v6l4 2"/>
                    </svg>
                </div>

            </div>
        </div>

    </div>

    <div class="bg-white border border-[#356744] rounded-2xl p-5">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">

            <div>
                <label class="text-xs font-semibold text-gray-600">Year</label>
                <select wire:model.live="selectedYear"
                    class="w-full mt-1 rounded-lg border-gray-300 text-sm">
                    @foreach($years as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="text-xs font-semibold text-gray-600">Month</label>
                <select wire:model.live="selectedMonth"
                    class="w-full mt-1 rounded-lg border-gray-300 text-sm">
                    @foreach($months as $number => $month)
                        <option value="{{ $number }}">{{ $month }}</option>
                    @endforeach
                </select>
            </div>

        </div>

        @if(count($chartLabels))

            <div class="overflow-x-auto">
                <div id="monthlyChartWrapper" wire:ignore class="h-[450px]" style="min-width: 1400px;">
                    <canvas id="monthlyRecordsChart"></canvas>
                </div>
            </div>

        @else

            <div class="h-[350px] border border-dashed rounded-xl flex flex-col items-center justify-center bg-gray-50">
                <h3 class="font-semibold text-gray-600">No Records Found</h3>
                <p class="text-sm text-gray-400">
                    No sensor readings for this selected month.
                </p>
            </div>

        @endif

    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div class="mt-8">

            <div class="flex items-center justify-between mb-4">
                <div>
                    <h2 class="text-lg font-semibold text-black">
                        Monthly Sensor Records
                    </h2>

                    <p class="text-sm text-gray-500">
                        Daily average readings for {{ $months[$selectedMonth] }} {{ $selectedYear }}
                    </p>
                </div>
            </div>

            @if(count($chartLabels))

                <div class="overflow-x-auto border rounded-xl">

                    <table class="min-w-full text-sm">

                        <thead class="bg-[#356744] text-white">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs">Date</th>
                                <th class="px-4 py-3 text-center text-xs">Temperature</th>
                                <th class="px-4 py-3 text-center text-xs">Humidity</th>
                                <th class="px-4 py-3 text-center text-xs">Soil Moisture</th>
                                <th class="px-4 py-3 text-center text-xs">Soil Moisture 2</th>
                                <th class="px-4 py-3 text-center text-xs">Water Level</th>
                                <th class="px-4 py-3 text-center text-xs">EC</th>
                                <th class="px-4 py-3 text-center text-xs">pH</th>
                                <th class="px-4 py-3 text-center text-xs">Nitrogen</th>
                                <th class="px-4 py-3 text-center text-xs">Phosphorus</th>
                                <th class="px-4 py-3 text-center text-xs">Potassium</th>
                                <th class="px-4 py-3 text-center text-xs">Nitrogen 2</th>
                                <th class="px-4 py-3 text-center text-xs">Phosphorus 2</th>
                                <th class="px-4 py-3 text-center text-xs">Potassium 2</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">

                            @foreach($chartLabels as $index => $label)

                                <tr class="hover:bg-gray-50">

                                    <td class="px-2 py-3 font-medium text-xs">
                                        {{ $label }}
                                    </td>

                                    <td class="px-4 py-3 text-center text-xs">
                                        {{ $chartData['temperature'][$index] }} °C
                                    </td>

                                    <td class="px-4 py-3 text-center text-xs">
                                        {{ $chartData['humidity'][$index] }} %
                                    </td>

                                    <td class="px-4 py-3 text-center text-xs">
                                        {{ $chartData['soil_moisture'][$index] }} %
                                    </td>

                                    <td class="px-4 py-3 text-center text-xs">
                                        {{ $chartData['soil_moisture2'][$index] }} %
                                    </td>

                                    <td class="px-4 py-3 text-center text-xs">
                                        {{ $chartData['water_level'][$index] }} %
                                    </td>

                                    <td class="px-4 py-3 text-center text-xs">
                                        {{ $chartData['ec_level'][$index] }}
                                    </td>

                                    <td class="px-4 py-3 text-center text-xs">
                                        {{ $chartData['ph_level'][$index] }}
                                    </td>

                                    <td class="px-4 py-3 text-center text-xs">
                                        {{ $chartData['nitrogen'][$index] }}
                                    </td>

                                    <td class="px-4 py-3 text-center text-xs">
                                        {{ $chartData['phosphorus'][$index] }}
                                    </td>

                                    <td class="px-4 py-3 text-center text-xs">
                                        {{ $chartData['potassium'][$index] }}
                                    </td>

                                    <td class="px-4 py-3 text-center text-xs">
                                        {{ $chartData['nitrogen2'][$index] }}
                                    </td>

                                    <td class="px-4 py-3 text-center text-xs">
                                        {{ $chartData['phosphorus2'][$index] }}
                                    </td>

                                    <td class="px-4 py-3 text-center text-xs">
                                        {{ $chartData['potassium2'][$index] }}
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="border rounded-xl p-10 text-center text-gray-500">
                    No monthly records available.
                </div>

            @endif

        </div>

        <div class="mt-8">

            <div class="mb-4">
                <h2 class="text-lg font-semibold text-black">
                    Monthly Activities
                </h2>

                <p class="text-sm text-gray-500">
                    Activities for {{ $months[$selectedMonth] }} {{ $selectedYear }}
                </p>
            </div>

            @if(count($activities))

                <div class="overflow-x-auto border rounded-xl">
                    <table class="min-w-full text-sm">
                        <thead class="bg-[#356744] text-white">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs">Date</th>
                                <th class="px-4 py-3 text-left text-xs">Performed By</th>
                                <th class="px-4 py-3 text-left text-xs">Cycle</th>
                                <th class="px-4 py-3 text-left text-xs">Type</th>
                                <th class="px-4 py-3 text-left text-xs">Title</th>
                                <th class="px-4 py-3 text-left text-xs">Description</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">
                            @foreach($activities as $activity)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 whitespace-nowrap text-xs">
                                        {{ $activity->created_at->format('M d, Y h:i A') }}
                                    </td>

                                    <td class="px-4 py-3 text-xs">
                                        <div class="flex items-center gap-2">
                                            <div class="w-6 h-6 min-w-6 min-h-6 aspect-square shrink-0 rounded-full bg-[#356744] text-white flex items-center justify-center font-semibold text-xs leading-none">
                                                {{ strtoupper(substr($activity->user?->name ?? 'S', 0, 1)) }}
                                            </div>

                                            <div>
                                                <p class="font-medium text-gray-800 italic">
                                                    {{ $activity->user?->name ?? 'System' }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-4 py-3 text-xs">
                                        {{ $activity->cycle?->cycle_code ?? '--' }}
                                    </td>

                                    <td class="px-4 py-3 capitalize text-xs">
                                        {{ str_replace('_', ' ', $activity->type) }}
                                    </td>

                                    <td class="px-4 py-3 font-semibold text-xs">
                                        {{ $activity->title }}
                                    </td>

                                    <td class="px-4 py-3 text-xs">
                                        {{ $activity->description ?? '--' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            @else
                <div class="border rounded-xl p-10 text-center text-gray-500">
                    No activities available for this month.
                </div>
            @endif

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        let monthlyChart = null;

        function buildMonthlyDatasets(data) {
            return [
                {
                    label: 'Temperature',
                    data: data.temperature,
                    borderColor: '#FF5722',
                    tension: 0,
                    pointRadius: 2,
                },
                {
                    label: 'Humidity',
                    data: data.humidity,
                    borderColor: '#00BCD4',
                    tension: 0,
                    pointRadius: 2,
                },
                {
                    label: 'Soil Moisture',
                    data: data.soil_moisture,
                    borderColor: '#4CAF50',
                    tension: 0,
                    pointRadius: 2,
                },
                {
                    label: 'Soil Moisture 2',
                    data: data.soil_moisture2,
                    borderColor: '#10B981',
                    tension: 0,
                    pointRadius: 2,
                },
                {
                    label: 'Water Level',
                    data: data.water_level,
                    borderColor: '#3B82F6',
                    tension: 0,
                    pointRadius: 2,
                },
                {
                    label: 'EC Level',
                    data: data.ec_level,
                    borderColor: '#9C27B0',
                    tension: 0,
                    pointRadius: 2,
                },
                {
                    label: 'pH Level',
                    data: data.ph_level,
                    borderColor: '#795548',
                    tension: 0,
                    pointRadius: 2,
                },
                {
                    label: 'Nitrogen',
                    data: data.nitrogen,
                    borderColor: '#22C55E',
                    tension: 0,
                    pointRadius: 2,
                },
                {
                    label: 'Phosphorus',
                    data: data.phosphorus,
                    borderColor: '#F59E0B',
                    tension: 0,
                    pointRadius: 2,
                },
                {
                    label: 'Potassium',
                    data: data.potassium,
                    borderColor: '#EF4444',
                    tension: 0,
                    pointRadius: 2,
                },
                {
                    label: 'Nitrogen 2',
                    data: data.nitrogen2,
                    borderColor: '#84CC16',
                    tension: 0,
                    pointRadius: 2,
                },
                {
                    label: 'Phosphorus 2',
                    data: data.phosphorus2,
                    borderColor: '#F97316',
                    tension: 0,
                    pointRadius: 2,
                },
                {
                    label: 'Potassium 2',
                    data: data.potassium2,
                    borderColor: '#DC2626',
                    tension: 0,
                    pointRadius: 2,
                },
            ];
        }

        function renderMonthlyChart(labels, data) {
            const canvas = document.getElementById('monthlyRecordsChart');

            if (!canvas) return;

            if (monthlyChart) {
                monthlyChart.destroy();
            }

            document.getElementById('monthlyChartWrapper').style.width =
                Math.max(1400, labels.length * 60) + 'px';

            monthlyChart = new Chart(canvas, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: buildMonthlyDatasets(data),
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    },
                    plugins: {
                        legend: {
                            position: 'bottom',
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    const label = context.dataset.label;
                                    const value = Number(context.parsed.y).toFixed(2);

                                    if (label === 'Temperature') return `${label}: ${value}°C`;
                                    if (['Humidity', 'Soil Moisture', 'Soil Moisture 2', 'Water Level'].includes(label)) {
                                        return `${label}: ${value}%`;
                                    }

                                    if (['Nitrogen', 'Phosphorus', 'Potassium', 'Nitrogen 2', 'Phosphorus 2', 'Potassium 2'].includes(label)) {
                                        return `${label}: ${value} ppm`;
                                    }

                                    return `${label}: ${value}`;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: { display: false },
                            ticks: {
                                autoSkip: false,
                                maxTicksLimit: 20,
                                maxRotation: 45,
                                minRotation: 45,
                            }
                        },
                        y: {
                            beginAtZero: true,
                        }
                    }
                }
            });
        }

        document.addEventListener('livewire:init', () => {
            renderMonthlyChart(@json($chartLabels), @json($chartData));

            Livewire.on('monthlyChartUpdated', (payload) => {
                setTimeout(() => {
                    renderMonthlyChart(payload[0].labels, payload[0].data);
                }, 100);
            });
        });
    </script>

</div>