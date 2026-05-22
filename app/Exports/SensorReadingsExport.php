<?php

namespace App\Exports;

use App\Models\DailySensorData;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Events\AfterSheet;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class SensorReadingsExport implements FromCollection, WithHeadings, WithStyles, WithEvents, WithTitle
{
    use Exportable;

    protected $date;
    protected $board;

    public function __construct($date, $board)
    {
        $this->date  = $date;
        $this->board = $board;
    }

    public function collection()
    {
        $soilData = DailySensorData::whereDate('reading_date', $this->date)
            ->where('board', $this->board)
            ->get()
            ->keyBy(fn($row) => Carbon::parse($row->reading_date)->format('Y-m-d H:i'));

        $waterData = DailySensorData::whereDate('reading_date', $this->date)
            ->where('board', 'B5')
            ->get()
            ->keyBy(fn($row) => Carbon::parse($row->reading_date)->format('Y-m-d H:i'));

        $tempHumidData = DailySensorData::whereDate('reading_date', $this->date)
            ->where('board', 'B1')
            ->get()
            ->keyBy(fn($row) => Carbon::parse($row->reading_date)->format('Y-m-d H:i'));

        // Merge all timestamps
        $allTimes = collect()
            ->merge($soilData->keys())
            ->merge($waterData->keys())
            ->merge($tempHumidData->keys())
            ->unique()
            ->sort();

        $rows = new Collection();

        foreach ($allTimes as $timeKey) {
            $soil = $soilData->get($timeKey);
            $water = $waterData->get($timeKey);
            $tempHumid = $tempHumidData->get($timeKey);

            $dateTime = Carbon::parse(
                $soil->reading_date ?? $water->reading_date ?? $tempHumid->reading_date
            );

            $rows->push([
                $soil ? number_format((float) $soil->soil_moisture, 2) : null,
                $soil ? number_format((float) $soil->soil_ph, 2) : null,
                $water ? number_format((float) $water->water_ph, 2) : null,
                $tempHumid ? number_format((float) $tempHumid->temperature, 2) : null,
                $tempHumid ? number_format((float) $tempHumid->humidity, 2) : null,
                $dateTime->format('M. d, Y'),
                $dateTime->format('h:i A'),
            ]);
        }

        return $rows;
    }


    public function headings(): array
    {
        return [
            'Soil Moisture',
            'Soil pH',
            'Water pH',
            'Temperature (°C)',
            'Humidity (%)',
            'Date',
            'Time',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                foreach (range('A', $sheet->getHighestColumn()) as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }

                $sheet->getStyle('A1:' . $sheet->getHighestColumn() . $sheet->getHighestRow())
                    ->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('A1:' . $sheet->getHighestColumn() . $sheet->getHighestRow())
                    ->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
            }
        ];
    }

    public function title(): string
    {
        return 'Sensor Data';
    }
}
