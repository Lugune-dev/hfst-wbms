<?php

namespace App\Filament\Donor\Widgets;

use App\Models\Donation;
use App\Models\Student;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DonorStatsWidget extends BaseWidget
{
    protected ?string $heading = 'Your Giving Impact';
    protected ?string $description = 'Thank you for empowering Tanzanian students!';

    protected function getStats(): array
    {
        $donor = auth()->user()->donor;

        if (!$donor) {
            return [
                Stat::make('No Profile Found', '—')
                    ->description('Please contact admin to link your donor account.')
                    ->color('danger'),
            ];
        }

        $totalDonated = Donation::where('donor_id', $donor->id)
            ->where('status', 'Confirmed')
            ->sum('amount');

        $donationsCount = Donation::where('donor_id', $donor->id)
            ->where('status', 'Confirmed')
            ->count();

        $pendingDonations = Donation::where('donor_id', $donor->id)
            ->where('status', 'Pending')
            ->count();

        $sponsoredStudents = Donation::where('donor_id', $donor->id)
            ->where('status', 'Confirmed')
            ->whereNotNull('student_id')
            ->distinct('student_id')
            ->count('student_id');

        return [
            Stat::make('Total Donated', 'TZS ' . number_format($totalDonated, 0))
                ->description('All your confirmed contributions')
                ->color('success'),

            Stat::make('Confirmed Donations', $donationsCount)
                ->description('Number of times you have donated')
                ->color('primary'),

            Stat::make('Students Sponsored', $sponsoredStudents)
                ->description('Lives you have directly touched')
                ->color('info'),

            Stat::make('Pending Donations', $pendingDonations)
                ->description('Awaiting confirmation')
                ->color('warning'),
        ];
    }
}
