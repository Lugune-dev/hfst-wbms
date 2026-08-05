<?php

namespace App\Filament\Teacher\Widgets;

use App\Models\Student;
use App\Models\AidApplication;
use Filament\Widgets\Widget;

class TeacherHeroWidget extends Widget
{
    protected static ?int $sort = 0;
    protected int | string | array $columnSpan = 'full';
    protected string $view = 'filament.teacher.widgets.teacher-hero';

    public function getHeroData(): array
    {
        return [
            'total_students'     => Student::count(),
            'active_students'    => Student::where('status', 'Active')->count(),
            'graduated_students' => Student::where('status', 'Graduated')->count(),
            'pending_aid'        => AidApplication::where('status', 'Pending')->count(),
        ];
    }
}
