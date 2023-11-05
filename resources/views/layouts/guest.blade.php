<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
       <!-- CSS files -->
       <link href="/dist/libs/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
       <link href="/dist/css/tabler.css" rel="stylesheet"/>
       <link href="/dist/css/demo.min.css" rel="stylesheet"/>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.js" defer></script>

        @stack('scripts')
    </head>
    <body>
        <div class="row justify-content-md-center">
        <div class="col col-md-6" >
            {{ $slot }}
        </div>
    </div>
    </body>
</html>
