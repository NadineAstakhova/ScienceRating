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
                @if(Auth::user()->type == '1')
                    <li class="breadcrumb-item"><a href={{ url(App\Http\Middleware\LocaleMiddleware::getLocale().'/professorProfile') }}>{{ trans('messages.main')}}</a></li>
                @elseif(Auth::user()->type == '2')
                    <li class="breadcrumb-item"><a href={{ url(App\Http\Middleware\LocaleMiddleware::getLocale().'/studentProfile') }}>{{ trans('messages.main')}}</a></li>
                @endif

                <li class="breadcrumb-item active">Анкета</li>
            </ol>
        </nav>
    </div>
        <div class="row my-2">
            <div class="col-lg-9">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="" data-target="#profile" data-toggle="tab" class="nav-link active">{{ trans('messages.info')}}</a>
                    </li>
                    <li class="nav-item">
                        <a href="" data-target="#edit" data-toggle="tab" class="nav-link">{{ trans('messages.update')}}</a>
                    </li>
                </ul>
                <div class="tab-content py-4">
                    <div class="tab-pane active" id="profile">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>{{ trans('messages.fio')}}</h6>
                                <p>
                                    {{$user->surname}} {{$user->name}} {{$user->patronymic}}
                                </p>
                                <h6>{{ trans('messages.fio')}} (укр)</h6>
                                <p>
                                    {{$user->surname_ukr}} {{$user->name_ukr}} {{$user->patronymic_ukr}}
                                </p>
                                <h6>{{ trans('messages.fio')}} (en)</h6>
                                <p>
                                    {{$user->surname_en}} {{$user->name_en}}
                                </p>
                                @if(Auth::user()->type == '2')
                                    <h6>{{ trans('messages.group')}}</h6>
                                    <p>
                                        {{$user->groupName}} ({{$user->groupFullName}})
                                    </p>
                                @endif
                                <h6>{{ trans('messages.login')}}</h6>
                                <p>
                                    {{$user->username}}
                                </p>
                                <h6>{{ trans('messages.email')}}</h6>
                                <p>
                                    {{$user->email}}
                                </p>
                            </div>


                        </div>
                        <!--/row-->
                    </div>

                    <div class="tab-pane" id="edit">
                        @if(Auth::user()->type == '1')
                            {!! Form::open(['url' => [App\Http\Middleware\LocaleMiddleware::getLocale().'/editProfInfo'], 'class'=>'form']) !!}
                        @elseif(Auth::user()->type == '2')
                            {!! Form::open(['url' => [App\Http\Middleware\LocaleMiddleware::getLocale().'/editStudentInfo'], 'class'=>'form']) !!}
                        @endif
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">{{ trans('messages.surname')}}:</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{$user->surname}}" name="surname">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">{{ trans('messages.name')}}:</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{$user->name}}" name="name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">{{ trans('messages.patronymic')}}:</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{$user->patronymic}}" name="patronymic">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">{{ trans('messages.surname')}} (укр):</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{$user->surname_ukr}}" name="surname_ukr">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">{{ trans('messages.name')}} (укр):</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{$user->name_ukr}}" name="name_ukr">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">{{ trans('messages.patronymic')}} (укр):</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{$user->patronymic_ukr}}" name="patronymic_ukr">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">{{ trans('messages.surname')}} (en):</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{$user->surname_en}}"
                                       name="surname_en" pattern="[a-zA-Z]+" oninvalid="this.setCustomValidity('Введите фамилию латиницей')"
                                       oninput="setCustomValidity('')" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">{{ trans('messages.name')}} (en):</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{$user->name_en}}"
                                       name="name_en"  pattern="[a-zA-Z]+" oninvalid="this.setCustomValidity('Введите имя латиницей')"
                                       oninput="setCustomValidity('')">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Email:</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="email" value="{{$user->email}}"
                                       name="email" oninvalid="this.setCustomValidity('Это неверный формат Email')"
                                       oninput="setCustomValidity('')" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">{{ trans('messages.new_pass')}}:</label>
                            <div class="col-lg-9">
                                {!! Form::password('new_password',
                                    ['class' => 'form-control', 'id' => 'passNew', 'minlength' => 6]) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">{{ trans('messages.repeat_pass')}}:</label>
                            <div class="col-lg-9">
                                {!! Form::password('password_confirm',
                                    ['class' => 'form-control', 'id' => 'passConf',  'minlength' => 6]) !!}
                                <span class = "error" id="conf"></span>
                            </div>
                        </div>

                        {!! Form::submit(trans('messages.save'), ['class' => 'btn btn-outline-success', 'id' => 'btn']) !!}
                        <a class="btn btn-outline-secondary btn-close" href="{{ url()->previous() }}">{{ trans('messages.cancel')}}</a>

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>

        </div>
@endsection
