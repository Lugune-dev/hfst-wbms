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
        $user = auth()->user();
        $student = $user?->student;

        if (!$student && $user) {
            $names = explode(' ', $user->name, 2);
            $student = \App\Models\Student::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'first_name'      => $names[0] ?? 'Mwanafunzi',
                    'last_name'       => $names[1] ?? 'HFST',
                    'gender'          => 'Female',
                    'age'             => 16,
                    'school_id'       => 1,
                    'school'          => 'Arusha Secondary School',
                    'education_level' => 'Secondary',
                    'status'          => 'Active',
                ]
            );
        }

        $data['student_id'] = $student ? $student->id : 1;
        $data['status'] = 'Pending';

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
