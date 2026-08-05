<?php

namespace App\Filament\Staff\Resources\AidApplicationResource\Pages;

use App\Filament\Staff\Resources\AidApplicationResource;
use Filament\Resources\Pages\EditRecord;

class EditAidApplication extends EditRecord
{
    protected static string $resource = AidApplicationResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if ($data['status'] !== 'Pending') {
            $data['reviewed_by'] = auth()->id();
            $data['reviewed_at'] = now();
        }
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
