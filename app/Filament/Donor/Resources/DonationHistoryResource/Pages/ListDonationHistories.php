<?php

namespace App\Filament\Donor\Resources\DonationHistoryResource\Pages;

use App\Filament\Donor\Resources\DonationHistoryResource;
use Filament\Resources\Pages\ListRecords;

class ListDonationHistories extends ListRecords
{
    protected static string $resource = DonationHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
