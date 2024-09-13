<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrustSeal;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TrustSealController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'authenticity_number' => 'required|unique:trust_seals',
            'manufacturer_name' => 'required',
        ]);

        $trustSeal = new TrustSeal();
        $trustSeal->authenticity_number = $request->authenticity_number;
        $trustSeal->manufacturer_name = $request->manufacturer_name;

        // Generate QR code
        $qrCodePath = 'qrcodes/' . $request->authenticity_number . '.png';
        QrCode::size(300)->generate(route('verify', $trustSeal->authenticity_number), public_path($qrCodePath));

        $trustSeal->qr_code_path = $qrCodePath;
        $trustSeal->save();

        return redirect()->route('admin.trustseals.index')->with('success', 'Trust Seal generated successfully');
    }
}