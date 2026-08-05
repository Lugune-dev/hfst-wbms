<?php

namespace App\Filament\Teacher\Widgets;

use App\Models\Student;
use Filament\Widgets\Widget;

class TeacherRecentStudentsWidget extends Widget
{
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';
    protected string $view = 'filament.teacher.widgets.recent-students';

    public function getRecentStudents()
    {
        return Student::latest()->limit(6)->get();
    }
}
