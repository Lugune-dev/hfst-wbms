<?php

namespace App\Filament\Admin\Resources\DonorResource\Pages;

use App\Filament\Admin\Resources\DonorResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDonor extends ViewRecord
{
    protected static string $resource = DonorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
