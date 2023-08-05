<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{app()->getLocale() == 'ar'? 'rtl' : 'ltr'}}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#1D4ED8" />

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Nunito&family=Noto+Kufi+Arabic&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead

    <meta name="description" content="My Awesome App description">
    <link rel="icon" href="{{ asset('images/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/pwa-192x192.png') }}" sizes="180x180">
    <link rel="mask-icon" href="{{ asset('images/pwa-512x512.png') }}" color="#FFFFFF">
    <meta name="theme-color" content="#ffffff">
    <!-- PWA  -->
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
</head>

<body class="bg-gray-50 dark:bg-gray-900">
    @inertia

    <script src="{{ asset('/sw.js') }}"></script>
    <script>
        if (!navigator.serviceWorker.controller) {
        navigator.serviceWorker.register("/sw.js").then(function (reg) {
            console.log("Service worker has been registered for scope: " + reg.scope);
        });
    }
    </script>
</body>

</html>