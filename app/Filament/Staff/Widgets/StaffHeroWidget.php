<?php

namespace App\Filament\Staff\Widgets;

use App\Models\Student;
use App\Models\Project;
use App\Models\AidApplication;
use Filament\Widgets\Widget;

class StaffHeroWidget extends Widget
{
    protected static ?int $sort = 0;
    protected int | string | array $columnSpan = 'full';
    protected string $view = 'filament.staff.widgets.staff-hero';

    public function getHeroData(): array
    {
        return [
            'total_students'   => Student::count(),
            'active_students'  => Student::where('status', 'Active')->count(),
            'graduated'        => Student::where('status', 'Graduated')->count(),
            'pending_aid'     => AidApplication::where('status', 'Pending')->count(),
            'active_projects' => Project::where('status', 'Active')->count(),
        ];
    }
}
