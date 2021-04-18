<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js', env('REDIRECT_HTTPS')) }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css', env('REDIRECT_HTTPS')) }}" rel="stylesheet">
</head>
<body>
    <section id="top">
        <h1 id="title">Memory</h1>
        <h2 id="quote">Without memory, there is no culture. 
            <br>Without memory, there would be no civilization, no society, no future.
            <br>-- Elie Wiesel</h2>
    </section>

    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
