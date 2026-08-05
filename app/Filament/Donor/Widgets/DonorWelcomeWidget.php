<?php

namespace App\Filament\Donor\Widgets;

use Filament\Widgets\Widget;

class DonorWelcomeWidget extends Widget
{
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';
    protected string $view = 'filament.donor.widgets.donor-welcome';
}
