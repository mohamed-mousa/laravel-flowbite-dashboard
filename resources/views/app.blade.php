<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{app()->getLocale() == 'ar'? 'rtl' : 'ltr'}}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Nunito&family=Noto+Kufi+Arabic&display=swap" rel="stylesheet">
    {{--
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&family=Noto+Kufi+Arabic&display=swap"
        rel="stylesheet" /> --}}

    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>

<body class="bg-gray-50 dark:bg-gray-800">
    @inertia

</body>

</html>