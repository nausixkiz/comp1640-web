<!--- Favicon -->
<link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">

@stack('vendor-styles')

<!-- Bootstrap Css -->
<link href="{{ asset( mix('css/bootstrap-custom.css') ) }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{ asset( mix('css/icons.css') ) }}" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{ asset( mix('css/app.css') ) }}" id="app-style" rel="stylesheet" type="text/css" />
<!-- third party css -->
<link href="{{ asset( mix('css/plugins.css')) }}" rel="stylesheet"/>
@stack('page-styles')
