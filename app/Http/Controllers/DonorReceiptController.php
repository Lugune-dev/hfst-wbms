<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class DonorReceiptController extends Controller
{
    public function show(Request $request, Donation $donation)
    {
        $user = auth()->user();

        // Check authorization: Admin, Staff, or the Owner Donor
        $isAuthorized = false;

        if ($user) {
            if ($user->hasRole(['admin', 'staff'])) {
                $isAuthorized = true;
            } elseif ($user->donor && $donation->donor_id === $user->donor->id) {
                $isAuthorized = true;
            }
        }

        // Allow receipt access if verification token matches or recently donated in session
        if (!$isAuthorized) {
            $sessionDonationId = session('recent_donation_id');
            $refToken = $request->query('ref');

            if ($sessionDonationId == $donation->id || ($refToken && $refToken === $donation->transaction_id)) {
                $isAuthorized = true;
            }
        }

        if (!$isAuthorized) {
            abort(403, 'Unauthorized access to this receipt.');
        }

        if ($request->has('pdf')) {
            $pdf = Pdf::loadView('donor.receipt', compact('donation'));
            return $pdf->download('HFST-Receipt-' . $donation->transaction_id . '.pdf');
        }

        return view('donor.receipt', compact('donation'));
    }
}
