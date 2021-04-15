<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Primary Meta Tags -->
    <title>@yield('page_title')</title>


{{--    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">--}}
{{--    <meta name="title" content="Volt - Free Bootstrap 5 Dashboard">--}}
{{--    <meta name="author" content="Themesberg">--}}
{{--    <meta name="description" content="Volt Pro is a Premium Bootstrap 5 Admin Dashboard featuring over 800 components, 10+ plugins and 20 example pages using Vanilla JS.">--}}
{{--    <meta name="keywords" content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, themesberg, themesberg dashboard, themesberg admin dashboard" />--}}
{{--    <link rel="canonical" href="https://themesberg.com/product/admin-dashboard/volt-premium-bootstrap-5-dashboard">--}}

{{--    <!-- Open Graph / Facebook -->--}}
{{--    <meta property="og:type" content="website">--}}
{{--    <meta property="og:url" content="https://demo.themesberg.com/volt-pro">--}}
{{--    <meta property="og:title" content="Volt - Free Bootstrap 5 Dashboard">--}}
{{--    <meta property="og:description" content="Volt Pro is a Premium Bootstrap 5 Admin Dashboard featuring over 800 components, 10+ plugins and 20 example pages using Vanilla JS.">--}}
{{--    <meta property="og:image" content="https://themesberg.s3.us-east-2.amazonaws.com/public/products/volt-pro-bootstrap-5-dashboard/volt-pro-preview.jpg">--}}

{{--    <!-- Twitter -->--}}
{{--    <meta property="twitter:card" content="summary_large_image">--}}
{{--    <meta property="twitter:url" content="https://demo.themesberg.com/volt-pro">--}}
{{--    <meta property="twitter:title" content="Volt - Free Bootstrap 5 Dashboard">--}}
{{--    <meta property="twitter:description" content="Volt Pro is a Premium Bootstrap 5 Admin Dashboard featuring over 800 components, 10+ plugins and 20 example pages using Vanilla JS.">--}}
{{--    <meta property="twitter:image" content="https://themesberg.s3.us-east-2.amazonaws.com/public/products/volt-pro-bootstrap-5-dashboard/volt-pro-preview.jpg">--}}

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('assets/img/favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/img/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/img/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('assets/img/favicon/site.webmanifest')}}">
    <link rel="mask-icon" href="{{asset('assets/img/favicon/safari-pinned-tab.svg')}}" color="#ffffff">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">


    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Fontawesome -->
    <link type="text/css" href="{{asset('vendor/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet">

    <!-- Sweet Alert -->
    <link type="text/css" href="{{asset('vendor/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">

    <!-- Notyf -->
    <link type="text/css" href="{{asset('vendor/notyf/notyf.min.css')}}" rel="stylesheet">

    <!-- Volt CSS -->
    <link type="text/css" href="{{asset('css/volt.css')}}" rel="stylesheet">

    <script src="{{asset('js/jquery.min.js')}}"></script>

    <!-- NOTICE: You can use the _analytics.html partial to include production code specific code & trackers -->

</head>

<body>

<!-- NOTICE: You can use the _analytics.html partial to include production code specific code & trackers -->


<x-navbar.navbar-master></x-navbar.navbar-master>

<main class="content">

    <x-topbar.topbar-master></x-topbar.topbar-master>
    @yield('session')
    <div class="py-4">
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mt-3 mb-lg-0">
                <h1 class="h4">@yield('content-heading')</h1>
            </div>
        </div>
    </div>
    @yield('content')

    <footer class="footer section py-5 align-items-md-end ">
        <div class="row">
            <div class="col-12 col-lg-6 mb-4 mb-lg-0">
                <p class="mb-0 text-center text-xl-left">Copyright ©<span class="current-year"></span> <a
                        class="text-primary fw-normal" href="#" target="_blank">Fléx</a></p>
            </div>

            <div class="col-12 col-lg-6">
                <!-- List -->
                <ul class="list-inline list-group-flush list-group-borderless text-center text-xl-right mb-0">
                    <li class="list-inline-item px-0 px-sm-2">
                        <a href="#">About</a>
                    </li>
                    <li class="list-inline-item px-0 px-sm-2">
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
</main>

<!-- Core -->
<script src="{{asset('vendor/@popperjs/core/dist/umd/popper.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/dist/js/bootstrap.min.js')}}"></script>

<!-- Vendor JS -->
<script src="{{asset('vendor/onscreen/dist/on-screen.umd.min.js')}}"></script>

<!-- Slider -->
<script src="{{asset('vendor/nouislider/distribute/nouislider.min.js')}}"></script>

<!-- Smooth scroll -->
<script src="{{asset('vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js')}}"></script>

<!-- Charts -->
<script src="{{asset('vendor/chartist/dist/chartist.min.js')}}"></script>
<script src="{{asset('vendor/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js')}}"></script>

<!-- Datepicker -->
<script src="{{asset('vendor/vanillajs-datepicker/dist/js/datepicker.min.js')}}"></script>

<!-- Sweet Alerts 2 -->
<script src="{{asset('vendor/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>

<!-- Moment JS -->
<script src="{{asset('js/moment.min.js')}}"></script>

<!-- Vanilla JS Datepicker -->
<script src="{{asset('vendor/vanillajs-datepicker/dist/js/datepicker.min.js')}}"></script>

<!-- Notyf -->
<script src="{{asset('vendor/notyf/notyf.min.js')}}"></script>

<!-- Simplebar -->
<script src="{{asset('vendor/simplebar/dist/simplebar.min.js')}}"></script>

<!-- Github buttons -->
<script async defer src="{{asset('js/buttons.js')}}"></script>

<!-- Volt JS -->
<script src="{{asset('assets/js/volt.js')}}"></script>


<script src="{{asset('js/jquery-3.3.1.slim.min.js')}}" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="{{asset('js/popper.min.js')}}" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="{{asset('js/bootstrap.min.js')}}" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>



@yield('scripts')

<script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
<script src="{{asset('js/easy-number-separator.js')}}"></script>

<!-- Datatables -->
<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">

</body>

</html>
