<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrustSeal;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function index()
    {
        // Retrieve all trust seals and pass to the view
        $trustSeals = TrustSeal::all();
        return view('admin.trust_seals.index', ['trustSeals' => $trustSeals]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'manufacturer_name' => 'required|string|max:255',
        ]);

        // Generate a unique authenticity number
        $authNumber = Str::random(10); // Or use any method to generate a unique number

        // Define QR code generation
        $qrCode = new QrCode(route('verify', $authNumber));
        $writer = new PngWriter();
        $result = $writer->write($qrCode);

        // Define path and save QR code
        $path = 'qrcodes/' . $authNumber . '.png';
        $result->saveToFile(public_path($path));

        // Create the TrustSeal record
        TrustSeal::create([
            'authenticity_number' => $authNumber,
            'qr_code_path' => $path, // Adjusted attribute name
            'manufacturer_name' => $request->manufacturer_name,
        ]);

        return redirect()->route('admin.trust_seals.index')->with('success', 'Trust Seal created successfully.');
    }
}
