<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\Widget;

class AdminWelcomeWidget extends Widget
{
    protected static ?int $sort = 0;
    protected int | string | array $columnSpan = 'full';
    protected string $view = 'filament.admin.widgets.admin-welcome';
}
