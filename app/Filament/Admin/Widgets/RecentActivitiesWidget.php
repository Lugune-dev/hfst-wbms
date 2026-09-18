<?php

namespace App\Filament\Admin\Widgets;

use App\Models\ActivityLog;
use Filament\Widgets\Widget;

class RecentActivitiesWidget extends Widget
{
    protected static ?int $sort = 5;
    protected int | string | array $columnSpan = 'full';
    protected string $view = 'filament.admin.widgets.recent-activities';

    public function getLogs()
    {
        return ActivityLog::latest()->take(8)->get();
    }
}
