<?php

namespace App\Filament\Admin\Widgets;

use App\Models\AidApplication;
use App\Models\Donation;
use App\Models\Student;
use Filament\Widgets\Widget;

class PendingActionsWidget extends Widget
{
    protected static ?int $sort = 5;
    protected int | string | array $columnSpan = 1;
    protected string $view = 'filament.admin.widgets.pending-actions';

    public function getPendingData(): array
    {
        return [
            [
                'label' => 'Aid Applications Pending',
                'count' => AidApplication::where('status', 'Pending')->count(),
                'color' => 'bg-yellow-500',
                'icon'  => 'heroicon-o-inbox-stack',
                'url'   => '/admin/aid-applications',
            ],
            [
                'label' => 'Donations Unconfirmed',
                'count' => Donation::where('status', 'Pending')->count(),
                'color' => 'bg-blue-500',
                'icon'  => 'heroicon-o-currency-dollar',
                'url'   => '/admin/donations',
            ],
            [
                'label' => 'Students Dropped Out',
                'count' => Student::where('status', 'Dropped')->count(),
                'color' => 'bg-red-500',
                'icon'  => 'heroicon-o-x-circle',
                'url'   => '/admin/students',
            ],
        ];
    }
}
