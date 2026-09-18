<?php

namespace App\Filament\Staff\Pages;

use App\Exports\ProjectsExport;
use App\Exports\StudentsExport;
use App\Models\AidApplication;
use App\Models\Project;
use App\Models\Student;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Maatwebsite\Excel\Facades\Excel;

class ReportsPage extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-chart-bar';
    protected string $view = 'filament.staff.pages.reports-page';
    protected static ?string $navigationLabel = 'Reports';
    protected static ?string $title = 'Ripoti za Wanafunzi na Miradi';
    protected static string|\UnitEnum|null $navigationGroup = '2. Usimamizi wa Miradi';
    protected static ?int $navigationSort = 3;

    public function getStudentSummary(): array
    {
        return [
            'total'     => Student::count(),
            'active'    => Student::where('status', 'Active')->count(),
            'graduated' => Student::where('status', 'Graduated')->count(),
            'dropped'   => Student::where('status', 'Dropped')->count(),
        ];
    }

    public function getProjectSummary(): array
    {
        return [
            'total'  => Project::count(),
            'active' => Project::where('status', 'Active')->count(),
            'budget' => Project::sum('budget'),
            'funded' => Project::sum('current_funding'),
        ];
    }

    public function getAidSummary(): array
    {
        return [
            'pending'  => AidApplication::where('status', 'Pending')->count(),
            'approved' => AidApplication::where('status', 'Approved')->count(),
            'rejected' => AidApplication::where('status', 'Rejected')->count(),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('export_students_excel')
                ->label('Wanafunzi (Excel)')
                ->icon('heroicon-o-academic-cap')
                ->color('primary')
                ->action(fn () => Excel::download(new StudentsExport(), 'wanafunzi-' . now()->format('Y-m-d') . '.xlsx')),

            Action::make('export_projects_excel')
                ->label('Miradi (Excel)')
                ->icon('heroicon-o-briefcase')
                ->color('warning')
                ->action(fn () => Excel::download(new ProjectsExport(), 'miradi-' . now()->format('Y-m-d') . '.xlsx')),
        ];
    }
}
