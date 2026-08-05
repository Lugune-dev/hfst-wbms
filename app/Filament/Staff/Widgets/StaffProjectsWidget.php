<?php

namespace App\Filament\Staff\Widgets;

use App\Models\Project;
use Filament\Widgets\Widget;

class StaffProjectsWidget extends Widget
{
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 1;
    protected string $view = 'filament.staff.widgets.staff-projects';

    public function getProjects()
    {
        return Project::withCount('students')->orderByDesc('created_at')->take(5)->get();
    }
}
