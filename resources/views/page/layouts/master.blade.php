<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ecommerce-Beta</title>
    <base href="{{ asset('/') }}">
    <link rel="stylesheet" href="page/css/main.css">
    <link rel="stylesheet" href="page/plugins/bootstrap.min.css">
    <link rel="stylesheet" href="page/plugins/font-awesome-4.7.0/css/font-awesome.min.css">
    @yield('styles')
</head>
<body>
<main>
    @include('page.layouts.header')
    <div class="main-page">
        @yield('main')
    </div>
    @include('page.layouts.footer')
</main>
<script src="page/plugins/jquery-3.4.1.min.js"></script>
<script src="page/js/thanh.js"></script>
@yield('scripts')
</body>
</html>
