<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title> @stack('title')</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">

    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/custom-style.css') }}" rel="stylesheet" />

    @stack('css')
</head>
<body class="login">
    <div class="d-flex" id="wrapper">
    <div id="page-content-wrapper">
        <div class="text-center">
            <img src="{{ asset('assets/images/logo-lg.png') }}">
        </div>
        <!-- Page content-->
        <div class="container text-center">