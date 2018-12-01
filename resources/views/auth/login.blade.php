@extends('layouts.main')
@section('title', 'Login')

@section('content')
    <div class="row-signin">
        {!! Form::open(['url' => ['auth/login']], ['class' => 'form-signin']) !!}
        @php
            if(Session::has('message'))
                echo "<div class='alert alert-danger' id='mesSuccessAdd' role='alert'>".Session::get("message")."</div>";
        @endphp
        <img src="{{asset('images/logo-2.png')}}" alt="" width="102" height="102">
        <h3 class="h3 mb-3 font-weight-normal">Введите данные для входа</h3>
            <label for="email" class="sr-only">Почта</label>
            {!! Form::email('email', $value = null,
                $attributes = array('class' => 'form-control', 'placeholder'=>"Почта", 'id'=>"inputEmail")) !!}
            <label for="password" class="sr-only">Password</label>
            {!! Form::password('password', ['class' => 'form-control', 'placeholder'=>"Пароль", 'id'=>"inputPass"]) !!}
            {!! Form::submit('Login', ['class' => 'btn btn-lg btn-info btn-block']) !!}
            <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
            {!! Form::close() !!}

    </div>

@endsection