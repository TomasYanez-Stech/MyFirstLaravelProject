<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', "My First Laravel Project")</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app" class="d-flex flex-column h-screen justify-content-between">
        <header>
            @include("partials.nav")
        </header>
        <main class="py-4">
            @yield('content')
        </main>

        <footer class="bg-dark text-center text-white-50 py-3 shadow">
            {{ config("app.name") }} Copyright | {{ date("Y") }} 
        </footer>
    </div>
</body>
</html>