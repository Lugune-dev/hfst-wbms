<?php

namespace App\Filament\Student\Resources\AidApplicationResource\Pages;

use App\Filament\Student\Resources\AidApplicationResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateAidApplication extends CreateRecord
{
    protected static string $resource = AidApplicationResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $student = auth()->user()->student;

        if ($student) {
            $data['student_id'] = $student->id;
        }

        $data['status'] = 'Pending';

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
