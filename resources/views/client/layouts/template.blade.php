<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PROTOTYPE | CLIENT</title>
     @vite('resources/css/app.css')
</head>
<body>
    @include('client.layouts.header')
    <main class="bg-base-200">
        @yield('content')
    </main>
    @include('client.layouts.footer')
</body>
</html>