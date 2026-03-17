<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>WHOLESALE - คลังสินค้าเอกการยาง</title>
    <meta name="author" content="codepixer">
    <meta name="description" content="">
    <meta name="keywords" content="">
    @include('/backend/layouts/css')
</head>

<body>
    @include('frontend/layouts/navbar-customer/navbar-left')
    <!-- Main content -->
    <div class="main-content" id="panel">
        @include('frontend/layouts/navbar-customer/header')
        @yield('content')
    </div>
    @include('/frontend/layouts/js')
</body>

</html>
