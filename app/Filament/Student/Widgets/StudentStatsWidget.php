<?php

namespace App\Filament\Student\Widgets;

use Filament\Widgets\Widget;

class StudentStatsWidget extends Widget
{
    protected static ?int $sort = 1;
    protected int | string | array $columnSpan = 'full';
    protected string $view = 'filament.student.widgets.student-stats';
}
