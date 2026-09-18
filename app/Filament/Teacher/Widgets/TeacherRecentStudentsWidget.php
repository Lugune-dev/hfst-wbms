<?php

namespace App\Filament\Teacher\Widgets;

use App\Models\Student;
use Filament\Widgets\Widget;

class TeacherRecentStudentsWidget extends Widget
{
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 'full';
    protected string $view = 'filament.teacher.widgets.recent-students';

    public function getRecentStudents()
    {
        return Student::latest()->take(8)->get();
    }
}
