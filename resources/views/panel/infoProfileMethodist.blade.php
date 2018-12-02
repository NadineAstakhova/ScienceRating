<?php
/**
 * Created by PhpStorm.
 * User: Nadine
 * Date: 10/04/2018
 * Time: 12:02
 */
?>
<?php
/**
 * Created by PhpStorm.
 * User: Nadine
 * Date: 09/04/2018
 * Time: 14:54
 */
?>
@extends('layouts.main')
@section('title', 'Info Profile')
@section('header')
    <script src="{{asset('js/passConfirm.js')}}"></script>
@endsection
@section('content')
    <div class="row">
        <nav aria-label="breadcrumb" style="width: 100%;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href={{ url(App\Http\Middleware\LocaleMiddleware::getLocale().'/profile') }}>Главная</a></li>
                <li class="breadcrumb-item active">Анкета</li>
            </ol>
        </nav>
    </div>
    <div class="row my-2">
        <div class="col-lg-9">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="" data-target="#profile" data-toggle="tab" class="nav-link active">Информация</a>
                </li>
                <li class="nav-item">
                    <a href="" data-target="#edit" data-toggle="tab" class="nav-link">Редактирование</a>
                </li>
            </ul>
            <div class="tab-content py-4">
                <div class="tab-pane active" id="profile">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Логин</h6>
                            <p>
                                {{$user->username}}
                            </p>
                            <h6>Почта</h6>
                            <p>
                                {{$user->email}}
                            </p>
                        </div>
                    </div>
                    <!--/row-->
                </div>

                <div class="tab-pane" id="edit">
                    {!! Form::open(['url' => ['editMethodistInfo'], 'class'=>'form']) !!}
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
                            <span class = "error" id="conf"></span>
                        </div>
                    </div>

                    {!! Form::submit('Save', ['class' => 'btn btn-outline-success', 'id' => 'btn']) !!}
                    <a class="btn btn-outline-secondary btn-close" href="{{ url()->previous() }}">Cancel</a>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>

    </div>
@endsection

