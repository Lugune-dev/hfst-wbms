<?php

namespace App\Exports;

use App\Models\Project;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProjectsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection(): Collection
    {
        return Project::query()->withCount('students')->latest()->get();
    }

    public function headings(): array
    {
        return [
            'Project Name',
            'Status',
            'Budget (TZS)',
            'Current Funding (TZS)',
            'Funded %',
            'Students Assigned',
            'Start Date',
            'End Date',
        ];
    }

    public function map($project): array
    {
        return [
            $project->name,
            $project->status,
            number_format((float) $project->budget, 2),
            number_format((float) $project->current_funding, 2),
            $project->funding_percentage . '%',
            $project->students_count,
            optional($project->start_date)->format('Y-m-d'),
            optional($project->end_date)->format('Y-m-d'),
        ];
    }
}
