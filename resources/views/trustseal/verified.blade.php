@extends('layouts.app')

@section('content')
<h2>Trust Seal Verified</h2>

@if($trustSeal)
    <p><strong>Manufacturer:</strong> {{ $trustSeal->manufacturer_name }}</p>
    <p><strong>Authenticity Number:</strong> {{ $trustSeal->authenticity_number }}</p>
    <p><strong>Verified At:</strong> {{ $trustSeal->verified_at }}</p>
    <img src="{{ asset($trustSeal->qr_code_path) }}" alt="QR Code">
@else
    <p>Trust Seal not found.</p>
@endif
@endsection
