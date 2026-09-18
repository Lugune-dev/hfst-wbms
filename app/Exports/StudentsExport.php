<?php

namespace App\Exports;

use App\Models\Student;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudentsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection(): Collection
    {
        return Student::query()->latest()->get();
    }

    public function headings(): array
    {
        return [
            'First Name',
            'Last Name',
            'Gender',
            'Age',
            'School',
            'Education Level',
            'Status',
            'Registered On',
        ];
    }

    public function map($student): array
    {
        return [
            $student->first_name,
            $student->last_name,
            $student->gender,
            $student->age,
            $student->school,
            $student->education_level,
            $student->status,
            $student->created_at?->format('Y-m-d'),
        ];
    }
}
