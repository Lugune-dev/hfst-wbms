<?php

namespace App\Filament\Student\Widgets;

use Filament\Widgets\Widget;

class StudentWelcomeWidget extends Widget
{
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';
    protected string $view = 'filament.student.widgets.student-welcome';
}
