<?php

namespace App\Filament\Student\Resources\AidApplicationResource\Pages;

use App\Filament\Student\Resources\AidApplicationResource;
use Filament\Resources\Pages\ListRecords;

class ListAidApplications extends ListRecords
{
    protected static string $resource = AidApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make()
                ->label('Submit New Application'),
        ];
    }
}
