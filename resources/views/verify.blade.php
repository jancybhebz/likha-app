<!DOCTYPE html>
<html>
<head>
    <title>Verify Trust Seal</title>
</head>
<body>
    <form action="{{ route('verify.submit') }}" method="POST">
        @csrf
        <label for="authenticity_number">Authenticity Number:</label>
        <input type="text" id="authenticity_number" name="authenticity_number" required>
        <button type="submit">Verify</button>
    </form>
    @if(session('error'))
        <p>{{ session('error') }}</p>
    @endif
</body>
</html>
