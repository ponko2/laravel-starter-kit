<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title') - App Name</title>
        @section('styles')
            <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
        @show
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="@yield('body-class')">
        <div class="container">
            @yield('content')
        </div>
        @section('scripts')
            <script src="{{ elixir('js/main.js') }}"></script>
        @show
    </body>
</html>
