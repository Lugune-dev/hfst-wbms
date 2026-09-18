<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Financial Report — Hope for Students Tanzania</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #1a2332; }
        h1 { font-size: 18px; color: #13385E; margin-bottom: 0; }
        .subtitle { color: #64748b; margin-top: 2px; margin-bottom: 20px; }
        .summary-grid { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .summary-grid td { padding: 8px 12px; border: 1px solid #e2e8f0; }
        .summary-grid .label { color: #64748b; font-size: 10px; text-transform: uppercase; }
        .summary-grid .value { font-size: 16px; font-weight: bold; color: #13385E; }
        table.data { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table.data th { background: #13385E; color: #fff; padding: 6px 8px; text-align: left; font-size: 10px; }
        table.data td { padding: 6px 8px; border-bottom: 1px solid #e2e8f0; font-size: 10px; }
        .status-confirmed { color: #2E7D32; font-weight: bold; }
        .status-pending { color: #F6B219; font-weight: bold; }
        .status-failed { color: #DC2626; font-weight: bold; }
        .footer { margin-top: 30px; font-size: 9px; color: #94a3b8; text-align: center; }
    </style>
</head>
<body>
    <h1>Hope for Students Tanzania</h1>
    <p class="subtitle">Financial Report — Generated on {{ now()->format('d M Y, H:i') }}</p>

    <table class="summary-grid">
        <tr>
            <td>
                <div class="label">Total Confirmed Donations</div>
                <div class="value">TZS {{ number_format($totalConfirmed, 0) }}</div>
            </td>
            <td>
                <div class="label">Pending Donations</div>
                <div class="value">TZS {{ number_format($totalPending, 0) }}</div>
            </td>
            <td>
                <div class="label">This Month</div>
                <div class="value">TZS {{ number_format($thisMonth, 0) }}</div>
            </td>
            <td>
                <div class="label">This Year</div>
                <div class="value">TZS {{ number_format($thisYear, 0) }}</div>
            </td>
        </tr>
    </table>

    <h3>Donation Records{{ ($from || $to) ? ' (' . ($from ?: '...') . ' to ' . ($to ?: '...') . ')' : '' }}</h3>
    <table class="data">
        <thead>
            <tr>
                <th>Date</th>
                <th>Donor</th>
                <th>Amount (TZS)</th>
                <th>Method</th>
                <th>Status</th>
                <th>Allocated To</th>
            </tr>
        </thead>
        <tbody>
            @forelse($donations as $donation)
                <tr>
                    <td>{{ $donation->created_at?->format('d M Y') }}</td>
                    <td>{{ $donation->donor?->user?->name ?? 'N/A' }}</td>
                    <td>{{ number_format((float) $donation->amount, 2) }}</td>
                    <td>{{ $donation->payment_method }}</td>
                    <td class="status-{{ strtolower($donation->status) }}">{{ $donation->status }}</td>
                    <td>
                        {{ $donation->project?->name ?? ($donation->student ? $donation->student->first_name . ' ' . $donation->student->last_name : '—') }}
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">No donation records found for this period.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Hope for Students Tanzania — P.O. Box 2798, Arusha — hopeforstudentsTanzania25@gmail.com — +255747413379
    </div>
</body>
</html>
