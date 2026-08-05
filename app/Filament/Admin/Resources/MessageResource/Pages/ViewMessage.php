<?php

namespace App\Filament\Admin\Resources\MessageResource\Pages;

use App\Filament\Admin\Resources\MessageResource;
use Filament\Resources\Pages\ViewRecord;

class ViewMessage extends ViewRecord
{
    protected static string $resource = MessageResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Auto-mark as read when admin views the message
        $this->record->update(['is_read' => true, 'read_at' => now()]);
        return $data;
    }
}
