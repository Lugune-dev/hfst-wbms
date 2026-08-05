<?php

namespace App\Filament\Student\Widgets;

use App\Models\AidApplication;
use Filament\Widgets\Widget;

class StudentAidStatusWidget extends Widget
{
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 'full';
    protected string $view = 'filament.student.widgets.aid-status';

    public function getApplications()
    {
        $student = auth()->user()->student;
        if (!$student) return collect();

        return AidApplication::where('student_id', $student->id)
            ->latest()
            ->take(5)
            ->get();
    }
}
