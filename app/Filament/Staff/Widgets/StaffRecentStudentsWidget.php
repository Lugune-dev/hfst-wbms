<?php

namespace App\Filament\Staff\Widgets;

use App\Models\Student;
use Filament\Widgets\Widget;

class StaffRecentStudentsWidget extends Widget
{
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 2;
    protected string $view = 'filament.staff.widgets.recent-students';

    public function getRecentStudents()
    {
        return Student::latest()->take(8)->get();
    }
}
