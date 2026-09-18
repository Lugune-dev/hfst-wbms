<?php

namespace App\Filament\Staff\Widgets;

use Filament\Widgets\Widget;

class StaffWelcomeWidget extends Widget
{
    protected static ?int $sort = 0;
    protected int | string | array $columnSpan = 'full';
    protected string $view = 'filament.staff.widgets.staff-welcome';
}
