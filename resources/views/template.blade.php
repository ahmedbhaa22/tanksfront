<!DOCTYPE html>
<html lang="en">

<head>
    @if (App::isLocale('en'))
        <title>Arabia Tanks | @yield('title')</title>
    @else
        <title>العربية للخزانات | @yield('title')</title>
    @endif

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- styles -->
        {!! Html::style('public/css/style-en.css') !!}
        @if (App::isLocale('ar'))
            {!! Html::style('public/css/style-ar.css') !!}
        @endif

    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('public/img/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('public/img/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('public/img/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('public/img/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('public/img/favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('public/img/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('public/img/favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('public/img/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('public/img/favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('public/img/favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('public/img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('public/img/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/img/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('public/img/favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="thie-color" content="#ffffff">
        {!! Html::script('public/js/jquery.js') !!}
        {!! Html::script('public/js/bootstrap.js') !!}
    <script>
        var base_url = '{{url('/')}}';
    </script>

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-125135187-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-125135187-1');
        </script>
</head>

<body>

    <!-- Load Header -->
    @include('partials._header')


    <!-- Content will be here -->
    @yield('content')


    <!-- Load Footer -->
    <footer>
        @include('partials._newsletter')
        @include('partials._footer')
    </footer>

    {!! Html::script('public/js/scripts.js') !!}

    <!-- Here you can add custom scripts -->
    @yield('bottom_scripts')
</body>

</html>