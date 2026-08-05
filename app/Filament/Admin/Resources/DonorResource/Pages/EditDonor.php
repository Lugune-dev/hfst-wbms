<?php

namespace App\Filament\Admin\Resources\DonorResource\Pages;

use App\Filament\Admin\Resources\DonorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDonor extends EditRecord
{
    protected static string $resource = DonorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
