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
@section('content')
    <div class="row">
        <nav aria-label="breadcrumb" style="width: 100%;">
            <ol class="breadcrumb">
                @if(Auth::user()->type == '1')
                    <li class="breadcrumb-item"><a href={{ url('professorProfile') }}>Back</a></li>
                @elseif(Auth::user()->type == '2')
                    <li class="breadcrumb-item"><a href={{ url('studentProfile') }}>Back</a></li>
                @endif

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
                                <h6>ФИО</h6>
                                <p>
                                    {{$user->surname}} {{$user->name}} {{$user->patronymic}}
                                </p>
                                <h6>ФИО (укр)</h6>
                                <p>
                                    {{$user->surname_ukr}} {{$user->name_ukr}} {{$user->patronymic_ukr}}
                                </p>
                                <h6>ФИО (en)</h6>
                                <p>
                                    {{$user->surname_en}} {{$user->name_en}}
                                </p>
                                @if(Auth::user()->type == '2')
                                    <h6>Группа</h6>
                                    <p>
                                        {{$user->groupName}} ({{$user->groupFullName}})
                                    </p>
                                @endif
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
                        @if(Auth::user()->type == '1')
                            {!! Form::open(['url' => ['editProfInfo'], 'class'=>'form']) !!}
                        @elseif(Auth::user()->type == '2')
                            {!! Form::open(['url' => ['editStudentInfo'], 'class'=>'form']) !!}
                        @endif
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Фамилия:</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{$user->surname}}" name="surname">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Имя:</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{$user->name}}" name="name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Отчество:</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{$user->patronymic}}" name="patronymic">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Фамилия (укр):</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{$user->surname_ukr}}" name="surname_ukr">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Имя (укр):</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{$user->name_ukr}}" name="name_ukr">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Отчество (укр):</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{$user->patronymic_ukr}}" name="patronymic_ukr">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Фамилия (en):</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{$user->surname_en}}"
                                       name="surname_en" pattern="[a-zA-Z]+" oninvalid="this.setCustomValidity('Введите фамилию латиницей')"
                                       oninput="setCustomValidity('')" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Имя (en):</label>
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
    <script>
        $('#passConf').keyup(function() {
            formval();
        });
        $('#passNew').keyup(function() {
            formval();
        });
        function formval() {
            if($('#passNew').val() != $('#passConf').val()) {
                $('#conf').html('Пароли не совпдают');
                $('#btn').prop( "disabled", true );
            }
            else {
                $('#conf').html('');
                $('#btn').prop( "disabled", false );
            }
        }
    </script>
@endsection
