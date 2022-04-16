<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description"
          content="">
    <meta name="keywords"
          content="">
    <meta name="author" content="">
    <title>@yield('title') | {{ env('APP_NAME') }}</title>

    @include('panels.styles')

</head>

<body data-topbar="light" data-layout="horizontal">
<div id="layout-wrapper">
    @include('partials.menu')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    @yield('content')
                </div>
            </div>
        </div>

        @include("partials/footer")
    </div>
</div>

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

@include('panels.scripts')

</body>

</html>
