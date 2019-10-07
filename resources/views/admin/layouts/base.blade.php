<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <!--[if IE]>
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <meta charset="UTF-8">
    <title>{{ $title ?? 'l2craft' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="kywords" content="">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta property="og:site_name" content="l2craft"/>
    <meta property="og:title" content="l2Craft - Калькулятор крафта Ла2"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="http://l2craft.ru"/>
    {{--<meta property="og:image" content="/theme/images/icon/share.png" />--}}
    <meta property="og:description"
          content="Калькулятор крафта позволяет расчитать все необходимые ресурсы для крафта и прикинуть потенциальную прибыль"/>

    {{--<link rel="apple-touch-icon" sizes="60x60" href="{{asset('img/icon/apple-touch-icon-57x57.png')}}">--}}
    {{--<link rel="apple-touch-icon" sizes="76x76" href="{{asset('img/icon/apple-touch-icon-76x76.png')}}">--}}
    {{--<link rel="apple-touch-icon" sizes="120x120" href="{{asset('img/icon/apple-touch-icon-120x120.png')}}">--}}
    {{--<link rel="apple-touch-icon" sizes="152x152" href="{{asset('img/icon/apple-touch-icon-152x152.png')}}">--}}

    {{--<link rel="shortcut icon" href="{{asset('img/icon/favicon.ico')}}" type="image/x-icon">--}}

    {{--<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">--}}
    {{--<link rel="stylesheet" href="{{asset('css/bootstrap-theme.min.css')}}">--}}
    {{--<link rel="stylesheet" href="{{asset('css/main.min.css')}}">--}}

    {{--<link rel="stylesheet" href="{{asset('js/owl-carousel/owl.carousel.css')}}">--}}
    {{--<link rel="stylesheet" href="{{asset('js/owl-carousel/owl.theme.css')}}">--}}

    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome pathAdminAsset -->
    <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/AdminLTE.min.css') }}">

    @stack('styles')
    @stack('head-scripts')

</head>
<body>
<main class="main" role="main">
    <div class="wrapper">
        <div class="container-fluid">


            @yield('content')

        </div>
    </div>
</main>

</body>
</html>