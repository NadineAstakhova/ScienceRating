<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>@yield('title')</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('app-assets/images/ico/apple-icon-60.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('app-assets/images/ico/apple-icon-76.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('app-assets/images/ico/apple-icon-120.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('app-assets/images/ico/apple-icon-152.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('app-assets/images/ico/favicon.ico')}}">
    <link rel="shortcut icon" type="image/png" href="{{asset('app-assets/images/ico/favicon-32.png')}}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap.css')}}">
    <!-- font icons-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/fonts/icomoon.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/fonts/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/pace.css')}}">
    <!-- END VENDOR CSS-->
    <!-- BEGIN ROBUST CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/app.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/colors.css')}}">
    <!-- END ROBUST CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/colors/palette-gradient.css')}}">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('/css/style.css')}}">
    <!-- END Custom CSS-->
    @yield('header')
</head>
<body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">

<!-- navbar-fixed-top-->
<nav class="header-navbar navbar navbar-with-menu navbar-fixed-top navbar-semi-dark navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav">
                <li class="nav-item mobile-menu hidden-md-up float-xs-left"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5 font-large-1"></i></a></li>
                <li class="nav-item"><a href="index.html" class="navbar-brand nav-link">ДонНУ</a></li>
                <li class="nav-item hidden-md-up float-xs-right"><a data-toggle="collapse" data-target="#navbar-mobile" class="nav-link open-navbar-container"><i class="icon-ellipsis pe-2x icon-icon-rotate-right-right"></i></a></li>
            </ul>
        </div>
        <div class="navbar-container content container-fluid">
            <div id="navbar-mobile" class="collapse navbar-toggleable-sm">
                <ul class="nav navbar-nav">
                    <li class="nav-item hidden-sm-down"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5">         </i></a></li>
                </ul>
                <ul class="nav navbar-nav float-xs-right">
                    <li class="dropdown dropdown-language nav-item">
                        <a id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle nav-link">
                            @if (App\Http\Middleware\LocaleMiddleware::getLocale() == 'ru')
                                <i class="flag-icon flag-icon-ru"></i><span class="selected-language">Русский</span></a>
                            @elseif(App\Http\Middleware\LocaleMiddleware::getLocale() == 'uk')
                                <i class="flag-icon flag-icon-ua"></i><span class="selected-language">Українська</span></a>
                            @endif
                        <div aria-labelledby="dropdown-flag" class="dropdown-menu">
                            <a href="{{@getLangURI('ru')}}" class="dropdown-item"><i class="flag-icon flag-icon-ru"></i> Русский</a>
                            <a href="{{@getLangURI('uk')}}" class="dropdown-item"><i class="flag-icon flag-icon-ua"></i> Українська</a>
                        </div>
                    </li>
                    <li class="dropdown dropdown-user nav-item">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link dropdown-user-link"><span class="avatar avatar-online">
                    <img src="../app-assets/images/portrait/small/avatar-s-1.png" alt="avatar"><i></i></span>
                            <span class="user-name">{{Auth::user()->username}}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{url(App\Http\Middleware\LocaleMiddleware::getLocale()."/infoProfileMethodist")}}" class="dropdown-item"><i class="icon-head"></i>{{ trans('messages.update_profile')}}</a>
                            <a href="#" class="dropdown-item"><i class="icon-calendar5"></i> Calender</a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ url(App\Http\Middleware\LocaleMiddleware::getLocale().'/auth/logout')}}" class="dropdown-item"><i class="icon-power3"></i> Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<div data-scroll-to-active="true" class="main-menu menu-fixed menu-dark menu-accordion menu-shadow">
    <div class="main-menu-content">
        <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
            <li class=" nav-item">
                <a href="{{url(App\Http\Middleware\LocaleMiddleware::getLocale()."/admin")}}">
                    <i class="icon-home3"></i>
                    <span data-i18n="nav.form_layouts.form_layout_basic" class="menu-title">Dashboard</span>
                </a>
            </li>

            <li class=" nav-item">
                <a href="#">
                    <i class="icon-user"></i>
                    <span data-i18n="nav.page_layouts.main" class="menu-title">{{ trans('messages.methodists')}}</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a href="{{url(App\Http\Middleware\LocaleMiddleware::getLocale()."/methodistList")}}" data-i18n="nav.page_layouts.1_column" class="menu-item">
                            <i class="icon-list"></i>
                            <span data-i18n="nav.project.main" class="menu-title">Список</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url(App\Http\Middleware\LocaleMiddleware::getLocale()."/createMethodistPage")}}" data-i18n="nav.page_layouts.2_columns"
                           class="menu-item">
                            <i class="icon-user-plus"></i>
                            <span data-i18n="nav.project.main" class="menu-title">{{ trans('messages.create')}}</span>
                        </a>
                    </li>

                </ul>
            </li>

            <li class=" nav-item">
                <a href="#">
                    <i class="icon-study"></i>
                    <span data-i18n="nav.project.main" class="menu-title">{{ trans('messages.profs')}}</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a href="{{url(App\Http\Middleware\LocaleMiddleware::getLocale()."/professorList")}}" data-i18n="nav.page_layouts.1_column" class="menu-item">
                            <i class="icon-list"></i>
                            <span data-i18n="nav.project.main" class="menu-title">Список</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url(App\Http\Middleware\LocaleMiddleware::getLocale()."/createProfessorPage")}}" data-i18n="nav.page_layouts.2_columns" class="menu-item">
                            <i class="icon-user-plus"></i>
                            <span data-i18n="nav.project.main" class="menu-title">{{ trans('messages.create')}}</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
@yield('content')
<footer class="footer footer-static footer-light navbar-border" style="position: fixed; bottom: 0; width: 100%;">
    <p class="clearfix text-muted text-sm-center mb-0 px-2"><span class="float-md-left d-xs-block d-md-inline-block">Copyright  &copy; 2018 <a href="" target="_blank" class="text-bold-800 grey darken-2">Nadiia Astakhova </a>, All rights reserved. </span></p>
</footer>

<!-- BEGIN VENDOR JS-->
<script src="../app-assets/js/core/libraries/jquery.min.js" type="text/javascript"></script>
<script src="../app-assets/vendors/js/ui/tether.min.js" type="text/javascript"></script>
<script src="../app-assets/js/core/libraries/bootstrap.min.js" type="text/javascript"></script>
<script src="../app-assets/vendors/js/ui/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
<script src="../app-assets/vendors/js/ui/unison.min.js" type="text/javascript"></script>
<script src="../app-assets/vendors/js/ui/blockUI.min.js" type="text/javascript"></script>
<script src="../app-assets/vendors/js/ui/jquery.matchHeight-min.js" type="text/javascript"></script>
<script src="../app-assets/vendors/js/ui/screenfull.min.js" type="text/javascript"></script>
<script src="../app-assets/vendors/js/extensions/pace.min.js" type="text/javascript"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<script src="../app-assets/vendors/js/charts/chart.min.js" type="text/javascript"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN ROBUST JS-->
<script src="../app-assets/js/core/app-menu.js" type="text/javascript"></script>
<script src="../app-assets/js/core/app.js" type="text/javascript"></script>
<!-- END ROBUST JS-->
<!-- BEGIN PAGE LEVEL JS-->
<script src="../app-assets/js/scripts/pages/dashboard-lite.js" type="text/javascript"></script>
<!-- END PAGE LEVEL JS-->
</body>
</html>
