<!doctype html>
<html lang="en">

<head>
    <title>ساير | لوحة التحكم</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="Lucid Bootstrap 4x Admin Template">
    <meta name="author" content="WrapTheme, design by: ThemeMakker.com">

    <link rel="icon" href="{{ url('dashboard/sayer.jpeg') }}" type="image/x-icon">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="{{ url('dashboard') }}/assets-{{ App()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('dashboard') }}/assets-{{ App()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}/vendor/font-awesome/css/font-awesome.min.css">

    {{--  <link href="{{ asset(mix('laratrust.css', 'vendor/laratrust')) }}" rel="stylesheet">  --}}
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <link rel="stylesheet" href="{{ url('dashboard') }}/assets-{{ App()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}/vendor/chartist/css/chartist.min.css">
    <link rel="stylesheet" href="{{ url('dashboard') }}/assets-{{ App()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css">
    <link rel="stylesheet" href="{{ url('dashboard') }}/assets-{{ App()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}/vendor/toastr/toastr.min.css">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ url('dashboard') }}/assets-{{ App()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}/css/main.css">
    <link rel="stylesheet" href="{{ url('dashboard') }}/assets-{{ App()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}/css/color_skins.css">
    @if(App()->getLocale() == 'ar')
        <link href="https://fonts.googleapis.com/css?family=Cairo:400,700" rel="stylesheet">
        <style>
            body, h1, h2, h3, h4, h5, h6, a, li, label, input, span, button th, td, p ,tr{
                font-family: 'Cairo', sans-serif !important;
            }
            .edit-margin-cancel-button {
                margin: 7px;
            }
        </style>
    @endif

    @stack('css')
</head>
<body class="theme-cyan {{ App()->getLocale() == 'en' ? '' : 'rtl' }}">

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30">
            <img src="{{ url('dashboard') }}/sayer_logo_light.png" width="80" height="80" alt="Lucid">
        </div>
        <p>@lang('admin.please_wait')...</p>
    </div>
</div>
<!-- Overlay For Sidebars -->

<div id="wrapper">

    <nav class="navbar navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-btn">
                <button type="button" class="btn-toggle-offcanvas"><i class="lnr lnr-menu fa fa-bars"></i></button>
            </div>

            <div class="navbar-brand">
                <a href=""><img src="{{ url('dashboard') }}/sayer.jpeg" style="width: 95px;height: 36px" alt="Lucid Logo" class="img-responsive logo"></a>
            </div>

            <div class="navbar-right">
                <form id="navbar-search" class="navbar-form search-form">
                    <input value="" class="form-control" placeholder="@lang('admin.search_here')..." type="text">
                    <button type="button" class="btn btn-default"><i class="icon-magnifier"></i></button>
                </form>

                <div id="navbar-menu">
                    <ul class="nav navbar-nav">
{{--                        <li><a href="app-events.html" class="icon-menu d-none d-sm-block d-md-none d-lg-block"><i class="icon-calendar"></i></a></li>--}}
{{--                        <li><a href="app-chat.html" class="icon-menu d-none d-sm-block"><i class="icon-bubbles"></i></a></li>--}}
{{--                        <li><a href="app-inbox.html" class="icon-menu d-none d-sm-block"><i class="icon-envelope"></i><span class="notification-dot"></span></a></li>--}}
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown"><i class="icon-globe"></i></a>
                            <ul class="dropdown-menu user-menu menu-icon animated bounceIn" style="text-align: {{ App()->getLocale() == 'ar' ? 'right' : 'left' }}">
                                <li class="menu-heading">@lang('admin.main_languages')</li>
                                <li><a href="{{ route('dashboard.lang','ar') }}"><span>Arabic</span></a></li>
{{--                                <li><a href="{{ route('dashboard.lang','en') }}"><span>English</span></a></li>--}}
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                                <i class="icon-bell"></i>
                                <span class="notification-dot"></span>
                            </a>
                            <ul class="dropdown-menu notifications animated shake">
                                <li class="header"><strong>You have 4 new Notifications</strong></li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <div class="media">
                                            <div class="media-left">
                                                <i class="icon-info text-warning"></i>
                                            </div>
                                            <div class="media-body">
                                                <p class="text">Campaign <strong>Holiday Sale</strong> is nearly reach budget limit.</p>
                                                <span class="timestamp">10:00 AM Today</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <div class="media">
                                            <div class="media-left">
                                                <i class="icon-like text-success"></i>
                                            </div>
                                            <div class="media-body">
                                                <p class="text">Your New Campaign <strong>Holiday Sale</strong> is approved.</p>
                                                <span class="timestamp">11:30 AM Today</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <div class="media">
                                            <div class="media-left">
                                                <i class="icon-pie-chart text-info"></i>
                                            </div>
                                            <div class="media-body">
                                                <p class="text">Website visits from Twitter is 27% higher than last week.</p>
                                                <span class="timestamp">04:00 PM Today</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <div class="media">
                                            <div class="media-left">
                                                <i class="icon-info text-danger"></i>
                                            </div>
                                            <div class="media-body">
                                                <p class="text">Error on website analytics configurations</p>
                                                <span class="timestamp">Yesterday</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="footer"><a href="javascript:void(0);" class="more">See all notifications</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown"><i class="icon-equalizer"></i></a>
                            <ul class="dropdown-menu user-menu menu-icon animated bounceIn">
                                <li class="menu-heading">ACCOUNT SETTINGS</li>
                                <li><a href="javascript:void(0);"><i class="icon-note"></i> <span>Basic</span></a></li>
                                <li><a href="javascript:void(0);"><i class="icon-equalizer"></i> <span>Preferences</span></a></li>
                                <li><a href="javascript:void(0);"><i class="icon-lock"></i> <span>Privacy</span></a></li>
                                <li><a href="javascript:void(0);"><i class="icon-bell"></i> <span>Notifications</span></a></li>
                                <li class="menu-heading">BILLING</li>
                                <li><a href="javascript:void(0);"><i class="icon-credit-card"></i> <span>Payments</span></a></li>
                                <li><a href="javascript:void(0);"><i class="icon-printer"></i> <span>Invoices</span></a></li>
                                <li><a href="javascript:void(0);"><i class="icon-refresh"></i> <span>Renewals</span></a></li>
                            </ul>
                        </li>
                        <li><a href="{{ route('dashboard.logout') }}" class="icon-menu"><i class="icon-login"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    @include('dashboard.includes._aside')

    <div id="main-content">
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>

</div>

<!-- Javascript -->
<script src="{{ url('dashboard') }}/assets-{{ App()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}/bundles/libscripts.bundle.js"></script>
<script src="{{ url('dashboard') }}/assets-{{ App()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}/bundles/vendorscripts.bundle.js"></script>

<script src="{{ url('dashboard') }}/assets-{{ App()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}/vendor/toastr/toastr.js"></script>
<script src="{{ url('dashboard') }}/assets-{{ App()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}/bundles/chartist.bundle.js"></script>
<script src="{{ url('dashboard') }}/assets-{{ App()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}/bundles/knob.bundle.js"></script> <!-- Jquery Knob-->

<script src="{{ url('dashboard') }}/assets-{{ App()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}/bundles/mainscripts.bundle.js"></script>
<script src="{{ url('dashboard') }}/assets-{{ App()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}/js/index.js"></script>
@stack('js')
</body>
</html>
