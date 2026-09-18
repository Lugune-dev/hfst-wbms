<?php

namespace App\Filament\Teacher\Widgets;

use Filament\Widgets\Widget;

class TeacherWelcomeWidget extends Widget
{
    protected static ?int $sort = 1;
    protected int | string | array $columnSpan = 'full';
    protected string $view = 'filament.teacher.widgets.teacher-welcome';
}
