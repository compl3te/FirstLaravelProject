<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
</head>
<body>
    <header class="header">
        <h1 class="NameSite">Check IP</h1>
    </header>

    <main>
        @yield('content')
    </main>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script type="module" src="{{ asset('js/script.js') }}"></script>
</body>
</html>