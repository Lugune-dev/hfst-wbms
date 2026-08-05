<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Donation;
use App\Models\Student;
use App\Models\Project;
use App\Models\AidApplication;
use Filament\Widgets\Widget;

class AdminHeroWidget extends Widget
{
    protected static ?int $sort = 0;
    protected int | string | array $columnSpan = 'full';
    protected string $view = 'filament.admin.widgets.admin-hero';

    public function getHeroData(): array
    {
        $totalDonations = Donation::where('status', 'Confirmed')->sum('amount');
        $activeStudents = Student::where('status', 'Active')->count();
        $pendingAid = AidApplication::where('status', 'Pending')->count();
        $activeProjects = Project::where('status', 'Active')->count();

        return [
            'total_donations' => $totalDonations,
            'active_students' => $activeStudents,
            'pending_aid' => $pendingAid,
            'active_projects' => $activeProjects,
        ];
    }
}
