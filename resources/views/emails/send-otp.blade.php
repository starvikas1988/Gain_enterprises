<!DOCTYPE html>
<html>
<head>
    <title>Your OTP</title>
</head>
<body>
    <h2>Hello {{ $name ?? 'User' }},</h2>
    
    <p>Welcome from the <strong>GainEnterprise</strong> team.</p>
    
    <p>Your OTP code is: <strong>{{ $otp }}</strong></p>
    
    <p>This code will expire in 10 minutes.</p>
</body>
</html>
