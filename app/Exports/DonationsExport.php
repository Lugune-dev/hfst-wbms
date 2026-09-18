<?php

namespace App\Exports;

use App\Models\Donation;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DonationsExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct(
        protected ?string $from = null,
        protected ?string $to = null,
    ) {
    }

    public function collection(): Collection
    {
        return Donation::query()
            ->with(['donor.user', 'student', 'project'])
            ->when($this->from, fn ($q) => $q->whereDate('created_at', '>=', $this->from))
            ->when($this->to, fn ($q) => $q->whereDate('created_at', '<=', $this->to))
            ->latest()
            ->get();
    }

    public function headings(): array
    {
        return [
            'Date',
            'Donor',
            'Amount (TZS)',
            'Payment Method',
            'Status',
            'Allocated Student',
            'Allocated Project',
            'Transaction ID',
        ];
    }

    public function map($donation): array
    {
        return [
            $donation->created_at?->format('Y-m-d H:i'),
            $donation->donor?->user?->name ?? 'N/A',
            number_format((float) $donation->amount, 2),
            $donation->payment_method,
            $donation->status,
            $donation->student ? $donation->student->first_name . ' ' . $donation->student->last_name : '',
            $donation->project?->name ?? '',
            $donation->transaction_id,
        ];
    }
}
