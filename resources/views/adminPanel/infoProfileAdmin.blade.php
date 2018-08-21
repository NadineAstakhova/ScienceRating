@extends('layouts.main')
@section('title', 'Info Profile')
@section('header')
    <script src="{{asset('js/passConfirm.js')}}"></script>
@endsection
@section('content')
    <div class="row">
        <nav aria-label="breadcrumb" style="width: 100%;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href={{ url()->previous() }}>Главная</a></li>
                <li class="breadcrumb-item active">Анкета</li>
            </ol>
        </nav>
    </div>
    <div class="row my-2">
        <div class="col-lg-9">

            {!! Form::open(['url' => ['editAdminInfo'], 'class'=>'form']) !!}
            <div class="form-group row">
                <label class="col-lg-3 col-form-label form-control-label">Email:</label>
                <div class="col-lg-9">
                    <input class="form-control" type="email" value="{{$user->email}}"
                           name="email" oninvalid="this.setCustomValidity('Это неверный формат Email')"
                           oninput="setCustomValidity('')">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label form-control-label">Новый пароль:</label>
                <div class="col-lg-9">
                    {!! Form::password('new_password',
                        ['class' => 'form-control', 'id' => 'passNew', 'minlength' => 6]) !!}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label form-control-label">Повторите пароль:</label>
                <div class="col-lg-9">
                    {!! Form::password('password_confirm',
                        ['class' => 'form-control', 'id' => 'passConf',  'minlength' => 6]) !!}
                    <span class="error" id="conf"></span>
                </div>
            </div>

            {!! Form::submit('Save', ['class' => 'btn btn-outline-success', 'id' => 'btn']) !!}
            <a class="btn btn-outline-secondary btn-close" href="{{ url()->previous() }}">Cancel</a>

            {!! Form::close() !!}

            </div>
        </div>

    </div>
@endsection

