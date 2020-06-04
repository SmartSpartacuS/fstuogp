<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta name="csrf_token" content="{{csrf_token()}}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Halaman @yield('judul')</title>
    <link rel="apple-touch-icon" href="{{ asset('toolsAdmin/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('toolsAdmin/images/ico/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('toolsAdmin/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('toolsAdmin/css/bootstrap-extended.css') }}">
    @yield('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('toolsAdmin/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('toolsAdmin/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('toolsAdmin/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('toolsAdmin/css/themes/semi-dark-layout.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('toolsAdmin/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('toolsAdmin/css/core/colors/palette-gradient.css') }}">
    
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('toolsAdmin/css/plugins/tour/tour.css') }}"> --}}
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    {{-- <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css"> --}}
    <!-- END: Custom CSS-->

</head>