<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title') | {{ config('app.name') }}</title>

  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />

        <!-- Vendor css (Require in all Page) -->
        <link href="{{ asset('assets/css/vendor.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Icons css (Require in all Page) -->
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- App css (Require in all Page) -->
        <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Theme Config js (Require in all Page) -->
        <script src="{{ asset('assets/js/config.js') }}"></script>
    <link href="{{ asset('assets/css/sweetalert.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
</head>

<body class="authentication-bg">

             
                    @yield('content')
                  
<!-- Scripts -->
 <!-- Vendor Javascript (Require in all Page) -->
        <script src="{{ asset('assets/js/vendor.js') }}"></script>

        <!-- App Javascript (Require in all Page) -->
        <script src="{{ asset('assets/js/app.js') }}"></script>
        <!-- Vector Map Js -->
        <script src="{{ asset('assets/vendor/jsvectormap/js/jsvectormap.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/jsvectormap/maps/world-merc.js') }}"></script>
        <script src="{{ asset('assets/vendor/jsvectormap/maps/world.js') }}"></script>

        <!-- Dashboard Js -->
        <script src="{{ asset('assets/js/pages/dashboard.analytics.js') }}"></script>

<!-- Page Specific JS File -->
</body>
</html>
