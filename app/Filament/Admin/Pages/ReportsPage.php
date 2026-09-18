<?php

namespace App\Filament\Admin\Pages;

use App\Exports\DonationsExport;
use App\Exports\DonorsExport;
use App\Exports\ProjectsExport;
use App\Exports\StudentsExport;
use App\Models\Donation;
use App\Models\Donor;
use App\Models\Project;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;

class ReportsPage extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-chart-bar';
    protected string $view = 'filament.admin.pages.reports-page';
    protected static ?string $navigationLabel = 'Reports';
    protected static ?string $title = 'Reports — Financial, Students, Donors & Projects';
    protected static string|\UnitEnum|null $navigationGroup = 'Finance';
    protected static ?int $navigationSort = 5;

    public function getFinancialSummary(): array
    {
        $confirmed = Donation::where('status', 'Confirmed');

        return [
            'total_confirmed' => (clone $confirmed)->sum('amount'),
            'total_pending'   => Donation::where('status', 'Pending')->sum('amount'),
            'this_month'      => (clone $confirmed)->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->sum('amount'),
            'this_year'       => (clone $confirmed)->whereYear('created_at', now()->year)->sum('amount'),
            'count_confirmed' => (clone $confirmed)->count(),
        ];
    }

    public function getStudentSummary(): array
    {
        return [
            'total'     => Student::count(),
            'active'    => Student::where('status', 'Active')->count(),
            'graduated' => Student::where('status', 'Graduated')->count(),
            'dropped'   => Student::where('status', 'Dropped')->count(),
        ];
    }

    public function getDonorSummary(): array
    {
        return [
            'total'          => Donor::count(),
            'total_donated'  => Donation::where('status', 'Confirmed')->sum('amount'),
            'top_donors'     => Donor::withSum(['donations as confirmed_total' => fn ($q) => $q->where('status', 'Confirmed')], 'amount')
                ->with('user')
                ->orderByDesc('confirmed_total')
                ->take(5)
                ->get(),
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

    public function getRecentDonations()
    {
        return Donation::with(['donor.user', 'student', 'project'])
            ->latest()
            ->take(15)
            ->get();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('export_financial_pdf')
                ->label('Financial Report (PDF)')
                ->icon('heroicon-o-document-arrow-down')
                ->color('danger')
                ->action(function () {
                    $summary = $this->getFinancialSummary();
                    $donations = Donation::with(['donor.user', 'student', 'project'])->latest()->get();

                    $pdf = Pdf::loadView('pdf.financial-report', [
                        'totalConfirmed' => $summary['total_confirmed'],
                        'totalPending'   => $summary['total_pending'],
                        'thisMonth'      => $summary['this_month'],
                        'thisYear'       => $summary['this_year'],
                        'donations'      => $donations,
                        'from'           => null,
                        'to'             => null,
                    ]);

                    return Response::streamDownload(
                        fn () => print($pdf->output()),
                        'financial-report-' . now()->format('Y-m-d') . '.pdf'
                    );
                }),

            Action::make('export_financial_excel')
                ->label('Donations (Excel)')
                ->icon('heroicon-o-table-cells')
                ->color('success')
                ->action(fn () => Excel::download(new DonationsExport(), 'donations-' . now()->format('Y-m-d') . '.xlsx')),

            Action::make('export_students_excel')
                ->label('Students (Excel)')
                ->icon('heroicon-o-academic-cap')
                ->color('primary')
                ->action(fn () => Excel::download(new StudentsExport(), 'students-' . now()->format('Y-m-d') . '.xlsx')),

            Action::make('export_donors_excel')
                ->label('Donors (Excel)')
                ->icon('heroicon-o-heart')
                ->color('info')
                ->action(fn () => Excel::download(new DonorsExport(), 'donors-' . now()->format('Y-m-d') . '.xlsx')),

            Action::make('export_projects_excel')
                ->label('Projects (Excel)')
                ->icon('heroicon-o-briefcase')
                ->color('warning')
                ->action(fn () => Excel::download(new ProjectsExport(), 'projects-' . now()->format('Y-m-d') . '.xlsx')),
        ];
    }
}
