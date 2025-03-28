<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Add Bootstrap for styling (if needed) -->
    <link rel="stylesheet" href="{{ asset('public/backend/assets/css/app.min.css') }}">
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
    <script src="{{ asset('public/backend/assets/js/app.min.js') }}"></script>
</body>
</html>
