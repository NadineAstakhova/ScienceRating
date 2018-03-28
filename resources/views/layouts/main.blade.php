<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{asset('js/index.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/filter.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/ratingTabs.js')}}"></script>


</head>
<body>
<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="{{Auth::check() ?
                       ((Auth::user()->type == \App\User::METHODIST) ?
                             url('profile') :
                             url('professorProfile')
                       )
                       : url('auth/login')}}" class="navbar-brand">
                Научный рейтинг кафеды КТ</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::check())
                    @if(Auth::user()->type == \App\User::METHODIST)
                        <li><a href={{url("profile")}}>Profile</a></li>
                    @elseif(Auth::user()->type == \App\User::PROFESSOR)
                        <li><a href={{url("professorProfile")}}>Profile</a></li>
                    @endif
                @endif
                <li><a href="{{Auth::check() ? url('auth/logout') : url('auth/login')}}">
                        <span class="glyphicon glyphicon-log-in"></span>
                        {{Auth::check() ? 'Logout' : 'Login'}}</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    @yield('content')
</div>

</body>
</html>