<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.svg') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=noto-sans:400,500,700|poppins:300,400,400i,500,600" rel="stylesheet" />

    <!-- Scripts -->
    @vite('resources/js/app.js')
    
    @inertiaHead
</head>

<body class="font-sans antialiased">
    @inertia
</body>

</html>