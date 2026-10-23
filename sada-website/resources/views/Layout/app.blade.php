<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="theme-color" content="#171328">
    <meta name="description" content="مساحة لمشاركة الاقتباسات واكتشاف الكلمات التي تلهمك.">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <title>@yield('title', 'صدى — كلمات تبقى في الأثر')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#100d1b] text-white antialiased">
<x-navbar :page="$page ?? ''" />


    <main>
        @yield('content')
    </main>

</body>

</html>
