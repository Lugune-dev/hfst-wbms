<?php

namespace App\Filament\Admin\Resources\HighlightResource\Pages;

use App\Filament\Admin\Resources\HighlightResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHighlights extends ListRecords
{
    protected static string $resource = HighlightResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
