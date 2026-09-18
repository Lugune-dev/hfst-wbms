<?php

namespace App\Exports;

use App\Models\Donor;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DonorsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection(): Collection
    {
        return Donor::query()->with('user')->latest()->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Phone',
            'Organization',
            'Donor Type',
            'Country',
            'Total Donated (TZS)',
        ];
    }

    public function map($donor): array
    {
        return [
            $donor->user?->name,
            $donor->user?->email,
            $donor->phone,
            $donor->organization_name,
            $donor->donor_type,
            $donor->country,
            number_format((float) $donor->total_donated, 2),
        ];
    }
}
