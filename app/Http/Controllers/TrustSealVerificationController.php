<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrustSeal;


class TrustSealVerificationController extends Controller
{
    public function verify(Request $request)
    {
        // Validate the input
        $request->validate([
            'authenticity_number' => 'required|string|exists:trust_seals,authenticity_number',
        ]);

        // Fetch the trust seal by authenticity number
        $trustSeal = TrustSeal::where('authenticity_number', $request->authenticity_number)->first();

        if (!$trustSeal) {
            // Return back with error if authenticity number is invalid
            return redirect()->back()->with('error', 'Invalid authenticity number.')->withInput();
        }

        // If it's not verified yet, mark it as verified
        if (is_null($trustSeal->verified_at)) {
            $trustSeal->verified_at = now();  // Mark it verified
            $trustSeal->save();               // Save the update
        }

        // Pass the trust seal to the view to show verification details
        return view('trustseal.verified', compact('trustSeal'));
    }
}