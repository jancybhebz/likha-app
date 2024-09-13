<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - Trust Seals</title>
</head>
<body>
    <h1>Trust Seals</h1>
    <form action="{{ route('admin.trustseals.store') }}" method="POST">
        @csrf
        <label for="manufacturer_name">Manufacturer Name:</label>
        <input type="text" id="manufacturer_name" name="manufacturer_name" required>
        <button type="submit">Generate Trust Seal</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>Manufacturer Name</th>
                <th>Authenticity Number</th>
                <th>QR Code</th>
            </tr>
        </thead>
        <tbody>
            @foreach($trustSeals as $trustSeal)
                <tr>
                    <td>{{ $trustSeal->manufacturer_name }}</td>
                    <td>{{ $trustSeal->authenticity_number }}</td>
                    <td><img src="{{ asset($trustSeal->qr_code_path) }}" alt="QR Code" /></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
