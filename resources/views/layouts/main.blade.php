<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php header("Access-Control-Allow-Headers: x-requested-with"); ?>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js "></script>
    <script src="{{asset('js/modalWindow.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/index.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/filter.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/ratingTabs.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.js"></script>

    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    @yield('header')
</head>
<body>
<header>
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a href="{{Auth::check() ?
                       ((Auth::user()->type == \App\User::METHODIST) ?
                             url(App\Http\Middleware\LocaleMiddleware::getLocale().'/profile') :
                             (
                                (Auth::user()->type == \App\User::SUPER_ADMIN) ?
                                    url(App\Http\Middleware\LocaleMiddleware::getLocale().'/admin') :
                                    (
                                        (Auth::user()->type == \App\User::PROFESSOR) ?
                                          url(App\Http\Middleware\LocaleMiddleware::getLocale().'/professorProfile') :
                                          url(App\Http\Middleware\LocaleMiddleware::getLocale().'/studentProfile')
                                    )
                             )
                       )
                       : url(App\Http\Middleware\LocaleMiddleware::getLocale().'/auth/login')}}" class="navbar-brand">
        {{ trans('messages.main_title')}}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{App\Http\Middleware\LocaleMiddleware::getLocale()}}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{@getLangURI('ru')}}">Русский</a>
                    <a class="dropdown-item" href="{{@getLangURI('uk')}}">Українська</a>
                </div>
            </li>
            @if (Auth::check())
                @if(Auth::user()->type == \App\User::METHODIST)
                    <li class="nav-item"><a class="nav-header-link nav-link" href={{url(App\Http\Middleware\LocaleMiddleware::getLocale()."/profile")}}>{{ trans('messages.main')}}</a></li>
                @elseif(Auth::user()->type == \App\User::PROFESSOR)
                    <li class="nav-item"><a class="nav-header-link nav-link" href={{url(App\Http\Middleware\LocaleMiddleware::getLocale()."/professorProfile")}}>{{ trans('messages.main')}}</a></li>
                @endif
            @endif
            <li class="nav-item"><a class="nav-header-link nav-link" href="{{Auth::check() ? url(App\Http\Middleware\LocaleMiddleware::getLocale().'/auth/logout') : url(App\Http\Middleware\LocaleMiddleware::getLocale().'/auth/login')}}">
                    <span class="glyphicon glyphicon-log-in"></span>
                    {{Auth::check() ? 'Logout ('.Auth::user()->username.')' : 'Login'}}</a>
            </li>
        </ul>
    </div>
</nav>
</header>
<main role="main" class="container">
    <div class="starter-template">
        @yield('content')
    </div>
</main><!-- /.container -->


</body>
</html>