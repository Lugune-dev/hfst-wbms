<?php

namespace App\Filament\Donor\Widgets;

use App\Models\Donation;
use Filament\Widgets\Widget;

class DonorRecentDonationsWidget extends Widget
{
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 'full';
    protected string $view = 'filament.donor.widgets.recent-donations';

    public function getRecentDonations()
    {
        $donor = auth()->user()->donor;
        if (!$donor) return collect();

        return Donation::where('donor_id', $donor->id)
            ->with(['student', 'project'])
            ->latest()
            ->take(5)
            ->get();
    }
}
