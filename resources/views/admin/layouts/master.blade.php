<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ecommerce-Beta</title>
    <base href="{{ asset('/') }}">
    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="admin/vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="admin/vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="admin/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="admin/vendors/selectFX/css/cs-skin-elastic.css">

    @yield('styles')

    <link rel="stylesheet" href="admin/assets/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
</head>
<body>
<aside id="left-panel" class="left-panel">
    @include('admin.layouts.sidebar')
</aside>
<div id="right-panel" class="right-panel">
    @include('admin.layouts.header')
    @include('admin.layouts.breadcrumb')
    @yield('main')
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="admin/vendors/jquery/dist/jquery.min.js"></script>
<script src="admin/vendors/tinymce/tinymce.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
@yield('ajax')
<script src="admin/vendors/popper.js/dist/umd/popper.min.js"></script>
<script src="admin/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="admin/assets/js/main.js"></script>
@yield('scripts')
</body>
</html>
