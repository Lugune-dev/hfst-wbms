<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Receipt – HFST</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f8fafc; color: #1a202c; }
        .receipt { max-width: 600px; margin: 40px auto; background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.1); }
        .receipt-header { background: linear-gradient(135deg, #13385E, #1e5080); color: white; padding: 32px; text-align: center; }
        .receipt-header h1 { font-size: 24px; font-weight: 700; }
        .receipt-header p { margin-top: 4px; opacity: 0.85; font-size: 14px; }
        .receipt-logo { font-size: 48px; margin-bottom: 12px; }
        .receipt-body { padding: 32px; }
        .receipt-title { text-align: center; margin-bottom: 24px; }
        .receipt-title h2 { font-size: 18px; color: #2E7D32; font-weight: 600; }
        .receipt-title p { color: #6b7280; font-size: 13px; margin-top: 4px; }
        .detail-row { display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #f3f4f6; }
        .detail-row:last-child { border-bottom: none; }
        .detail-label { color: #6b7280; font-size: 14px; }
        .detail-value { font-weight: 600; color: #1a202c; font-size: 14px; text-align: right; }
        .amount-row { background: #f0fdf4; border-radius: 8px; padding: 16px; margin: 20px 0; text-align: center; }
        .amount-row .label { color: #166534; font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; }
        .amount-row .amount { font-size: 36px; font-weight: 800; color: #15803d; margin-top: 4px; }
        .badge { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; background: #dcfce7; color: #166534; }
        .receipt-footer { background: #f8fafc; padding: 20px 32px; text-align: center; border-top: 1px solid #e5e7eb; }
        .receipt-footer p { font-size: 12px; color: #9ca3af; line-height: 1.6; }
        .print-btn { display: block; width: 100%; background: #13385E; color: white; border: none; padding: 14px; font-size: 16px; font-weight: 600; cursor: pointer; margin-top: 24px; border-radius: 8px; }
        @media print { .print-btn { display: none; } body { background: white; } .receipt { box-shadow: none; } }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="receipt-header">
            <div class="receipt-logo">💙</div>
            <h1>Hope for Students Tanzania</h1>
            <p>Official Donation Receipt</p>
        </div>

        <div class="receipt-body">
            <div class="receipt-title">
                <h2>✅ Donation Confirmed</h2>
                <p>Receipt #{{ str_pad($donation->id, 6, '0', STR_PAD_LEFT) }}</p>
            </div>

            <div class="amount-row">
                <div class="label">Total Amount</div>
                <div class="amount">TZS {{ number_format($donation->amount, 0) }}</div>
            </div>

            <div class="detail-row">
                <span class="detail-label">Donor Name</span>
                <span class="detail-value">{{ $donation->donor->user->name ?? '—' }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Email</span>
                <span class="detail-value">{{ $donation->donor->user->email ?? '—' }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Payment Method</span>
                <span class="detail-value">{{ $donation->payment_method }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Transaction Reference</span>
                <span class="detail-value">{{ $donation->transaction_id }}</span>
            </div>
            @if($donation->student)
            <div class="detail-row">
                <span class="detail-label">Beneficiary Student</span>
                <span class="detail-value">{{ $donation->student->first_name }} {{ $donation->student->last_name }}</span>
            </div>
            @endif
            @if($donation->project)
            <div class="detail-row">
                <span class="detail-label">Project</span>
                <span class="detail-value">{{ $donation->project->name }}</span>
            </div>
            @endif
            <div class="detail-row">
                <span class="detail-label">Date</span>
                <span class="detail-value">{{ $donation->created_at->format('d M Y, H:i') }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Status</span>
                <span class="detail-value"><span class="badge">{{ $donation->status }}</span></span>
            </div>

            <button class="print-btn" onclick="window.print()">🖨️ Print Receipt</button>
        </div>

        <div class="receipt-footer">
            <p>
                Thank you for your generous support! This receipt is your official record of donation to<br>
                <strong>Hope for Students Tanzania (HFST)</strong>.<br>
                For inquiries: info@hfst.or.tz | www.hfst.or.tz
            </p>
        </div>
    </div>
</body>
</html>
