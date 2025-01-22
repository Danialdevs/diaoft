<?php

namespace App\Exports;

use App\Models\Rate;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class GradeRateExport implements FromView, ShouldAutoSize, WithStyles
{
    protected $startDate;

    protected $endDate;

    /***
     * @param Carbon $startDate
     * @param Carbon $endDate
     */
    public function __construct(Carbon $startDate, Carbon $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow() + 2;
        $sheet->setCellValue("A{$lastRow}", __('app.name').' - '.__('title'));
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

    public function view(): View
    {
        $schoolId = Auth::user()->school_id;

        $rates = Rate::where('school_id', $schoolId)
            ->whereBetween('created_at', [$this->startDate->copy()->startOfDay(), $this->endDate->copy()->endOfDay()])
            ->get();

        return view('exports.RateExportTable', [
            'rates' => $rates,
        ]);
    }
}
