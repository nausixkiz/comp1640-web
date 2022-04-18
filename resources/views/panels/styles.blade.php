<!--- Favicon -->
<link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">

@stack('vendor-styles')

<!-- third party css -->
<link href="{{ asset( mix('css/plugins.css')) }}" rel="stylesheet"/>
<!-- Bootstrap Css -->
<link href="{{ asset( mix('css/bootstrap-custom.css') ) }}" id="bootstrap-style" rel="stylesheet" type="text/css"/>
<!-- Icons Css -->
<link href="{{ asset( mix('css/icons.css') ) }}" rel="stylesheet" type="text/css"/>
<!-- App Css-->
<link href="{{ asset( mix('css/app.css') ) }}" id="app-style" rel="stylesheet" type="text/css"/>

@laravelViewsStyles(laravel-views,tailwindcss,livewire)

@stack('page-styles')

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-226191143-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-226191143-1');
</script>
