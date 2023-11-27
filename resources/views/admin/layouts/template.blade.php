<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body>
    <div class="drawer drawer-mobile lg:drawer-open p-0">
        <input id="drawer-toggle" type="checkbox" class="drawer-toggle" />
        @include('admin.layouts.header')
        <div class="drawer-content overflow-x-hidden bg-base-200 pt-[10vh]">
            <div class="px-6 py-6 min-h-[90vh] overflow-x-hidden">
                @yield('content')
            </div>
        </div> 
        @include('admin.layouts.sidebar')
    </div>
</body>
</html>