<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>@yield('title')</title>
</head>
<body>
    <header class="header">
        <h1 class="NameSite">Check IP</h1>
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>