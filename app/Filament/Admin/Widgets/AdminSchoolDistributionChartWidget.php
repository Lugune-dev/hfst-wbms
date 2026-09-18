<?php

namespace App\Filament\Admin\Widgets;

use App\Models\School;
use Filament\Widgets\ChartWidget;

class AdminSchoolDistributionChartWidget extends ChartWidget
{
    protected static ?int $sort = 4;
    protected ?string $heading = 'Students by Partner School (Mgawanyo wa Shule)';
    protected ?string $description = 'Active beneficiary distribution across partner institutions';
    protected int | string | array $columnSpan = ['md' => 1, 'xl' => 1];

    protected function getData(): array
    {
        $schools = School::withCount(['students' => fn ($q) => $q->where('status', 'Active')])->get();

        $labels = [];
        $data   = [];

        foreach ($schools as $school) {
            $labels[] = $school->name;
            $data[]   = $school->students_count;
        }

        // Fallback demo data if no counts yet
        if (empty($data) || array_sum($data) === 0) {
            $labels = ['Arusha Sec', 'Kikwakwaru Pri', 'Ilboru High', 'Moshi Tech'];
            $data   = [18, 14, 12, 8];
        }

        return [
            'datasets' => [
                [
                    'label'           => 'Active Students',
                    'data'            => $data,
                    'backgroundColor' => [
                        '#13385E',
                        '#2E7D32',
                        '#F6B219',
                        '#0ea5e9',
                        '#8b5cf6',
                    ],
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
