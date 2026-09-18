<?php

namespace App\Filament\Donor\Widgets;

use Filament\Widgets\ChartWidget;

class DonorImpactDistributionChartWidget extends ChartWidget
{
    protected static ?int $sort = 3;
    protected ?string $heading = 'Mgawanyo wa Athari ya Michango (Impact Allocation)';
    protected ?string $description = 'Jinsi michango yako inavyogawanywa kusaidia wanafunzi';
    protected int | string | array $columnSpan = ['md' => 1, 'xl' => 1];

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label'           => 'Mgawanyo wa Mchango (%)',
                    'data'            => [55, 25, 12, 8],
                    'backgroundColor' => [
                        '#13385E', // Ada za Wanafunzi (Deep Blue)
                        '#2E7D32', // Vitabu na Sare (Emerald)
                        '#F6B219', // Vifaa vya Madarasa (Gold)
                        '#0ea5e9', // Afya na Lishe (Sky Blue)
                    ],
                ],
            ],
            'labels' => [
                'Ada za Masomo (Tuition - 55%)',
                'Vitabu & Sare (Scholastic - 25%)',
                'Miradi ya Madarasa (Classrooms - 12%)',
                'Afya & Lishe (Welfare - 8%)',
            ],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
