<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laravel 9 - Code Shotcut - How to Generate QR Code</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
</head>
<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header text-center">
                <h2>SCAN QR CODE TO ACCESS TABLE MENU</h2>
            </div>
            <div class="card-body text-center">
                {!! QrCode::size(400)->generate('https://caterer.gainenterprises.in/table/6') !!}
            </div>
        </div>
    </div>
</body>
</html>