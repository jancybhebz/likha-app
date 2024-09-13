<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Endroid\QrCode\QrCode;

class TrustSeal extends Model
{
    use HasFactory;

    protected $fillable = [
        'authenticity_number',
        'manufacturer_name',
        'qr_code_path',
    ];
    
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
    QrCode::size(300)->generate(route('trustseal.verify', $trustSeal->authenticity_number), public_path($qrCodePath));

    $trustSeal->qr_code_path = $qrCodePath;
    $trustSeal->save();

    return redirect()->route('admin.trustseals.index')->with('success', 'Trust Seal generated successfully');
}

}
