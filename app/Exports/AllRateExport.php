<?php

namespace App\Exports;

use App\Models\Rate;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AllRateExport implements FromCollection, WithHeadings, WithStyles
{
    protected $startDate;
    protected $endDate;

    public function __construct(Carbon $startDate, Carbon $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function headings(): array
    {
        return [
            __("grade"),
            __("score"),
            __("quality"),
            __("date"),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow() + 2;
        $sheet->setCellValue("A{$lastRow}", __("app.name") . " - " . __("title"));
        $sheet->mergeCells("A{$lastRow}:Z{$lastRow}");
        $sheet->getStyle("A{$lastRow}")->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 12,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ]);
    }
    public function collection()
    {
        $schoolId = Auth::user()->school_id;

        $rates = Rate::select('grade', 'score', 'created_at')
            ->where('school_id', $schoolId)
            ->whereBetween('created_at', [$this->startDate->copy()->startOfDay(), $this->endDate->copy()->endOfDay()])
            ->orderBy('grade', 'asc')
            ->get()
            ->map(function ($rate) {
                $rate->created_at = Carbon::parse($rate->created_at)->format('d-m-Y');

                if ($rate->score == 0) {
                    $rate->rate = __("report.bad");
                    $rate->score = "0";
                } elseif ($rate->score < 50) {
                    $rate->rate = __("report.bad");
                } elseif ($rate->score <= 75) {
                    $rate->rate = __("report.good");
                } else {
                    $rate->rate = __("report.excellent");
                }

                return $rate;
            });

        return $rates->map(function ($rate) {
            return [
                (int) $rate->grade,
                (int) $rate->score,
                (string) $rate->rate,
                (string) $rate->created_at,
            ];
        });
    }
}
