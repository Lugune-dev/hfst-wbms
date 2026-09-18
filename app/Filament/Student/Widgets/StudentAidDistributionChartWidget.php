<?php

namespace App\Filament\Student\Widgets;

use App\Models\AidApplication;
use Filament\Widgets\ChartWidget;

class StudentAidDistributionChartWidget extends ChartWidget
{
    protected static ?int $sort = 3;
    protected ?string $heading = 'Ufuatiliaji wa Misaada Yangu (My Aid Request Breakdown)';
    protected ?string $description = 'Mgawanyo wa maombi ya misaada ya ada, vitabu, sare na makazi';
    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $student = auth()->user()->student;

        $approved = 0;
        $pending  = 0;
        $rejected = 0;

        if ($student) {
            $approved = AidApplication::where('student_id', $student->id)->where('status', 'Approved')->count();
            $pending  = AidApplication::where('student_id', $student->id)->where('status', 'Pending')->count();
            $rejected = AidApplication::where('student_id', $student->id)->where('status', 'Rejected')->count();
        }

        // Demo data if brand new student account
        if ($approved === 0 && $pending === 0 && $rejected === 0) {
            $approved = 2;
            $pending  = 1;
            $rejected = 0;
        }

        return [
            'datasets' => [
                [
                    'label'           => 'Idadi ya Maombi',
                    'data'            => [$approved, $pending, $rejected],
                    'backgroundColor' => [
                        'rgba(46, 125, 50, 0.85)',   // Approved (Emerald)
                        'rgba(246, 178, 25, 0.85)',  // Pending (Gold)
                        'rgba(220, 38, 38, 0.85)',   // Rejected (Red)
                    ],
                    'borderRadius'    => 8,
                ],
            ],
            'labels' => [
                'Yaliyoidhinishwa (Approved)',
                'Yanayochakatwa (Pending)',
                'Yasiyokubaliwa (Rejected)',
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
