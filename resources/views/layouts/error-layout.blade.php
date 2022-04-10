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

<body class="">
    <div class="my-5 pt-5">
        <div class="w-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="text-center">
                            <div>
                                <h1 class="display-2 error-text fw-bold">4<i class="ri-ghost-smile-fill align-bottom text-primary mx-1"></i>4</h1>
                            </div>
                            <div>
                                <h4 class="text-uppercase mt-4">Sorry, page not found</h4>
                                <p> @yield('message')</p>
                                <div class="mt-4">
                                    <a href="{{ route('home') }}" class="btn btn-primary"><i class="ri-arrow-left-line align-bottom mr-2"></i>Back to Home</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('panels.scripts')

</body>

</html>
