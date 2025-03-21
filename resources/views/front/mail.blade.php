<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
</head>
<body>
    <h1>Password Reset Request</h1>
    <p>Hello, {{ $details['name'] }}</p> <!-- Assuming 'name' is part of the details array -->
    <p>You requested a password reset. Click the link below to reset your password:</p>
    <a href="{{ $details['reset_link'] }}">Reset Password</a> <!-- Assuming 'reset_link' is part of the details array -->
</body>
</html>
