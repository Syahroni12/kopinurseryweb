<?php

namespace App\Exports;

use App\Models\Monicontrolling;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TemperatureHumidityExport implements FromCollection
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Return the collection of data.
     */
    public function collection()
    {
        return collect($this->data);
    }

    /**
     * Define headings for the Excel file.
     */
    public function headings(): array
    {
        return [
            'No',
            'Tanggal',
            'Rata-rata Suhu',
            'Rata-rata Kelembaban',
        ];
    }

    /**
     * Map data to each row in Excel.
     */
    public function map($row): array
    {
        static $number = 0;
        $number++;

        return [
            $number,
            $row['tanggal'],
            number_format($row['avg_temperature'], 2),
            number_format($row['avg_humidity'], 2),
        ];
    }

    /**
     * Apply custom styles to the Excel file.
     */
    public function styles(Worksheet $sheet)
    {
        // Header style
        $sheet->getStyle('A1:D1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => Color::COLOR_WHITE],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FF4CAF50'],
            ],
        ]);

        // Borders
        $sheet->getStyle('A1:D' . ($sheet->getHighestRow()))
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN)
            ->setColor(new Color(Color::COLOR_BLACK));

        return [];
    }
}
