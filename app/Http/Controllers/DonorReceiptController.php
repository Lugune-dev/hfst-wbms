<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;

class DonorReceiptController extends Controller
{
    public function show(Request $request, Donation $donation)
    {
        // Ensure only the donor who made this donation can view the receipt
        $donor = auth()->user()->donor;

        if (!$donor || $donation->donor_id !== $donor->id) {
            abort(403, 'Unauthorized');
        }

        if ($donation->status !== 'Confirmed') {
            abort(404, 'Receipt only available for confirmed donations.');
        }

        return view('donor.receipt', compact('donation'));
    }
}
