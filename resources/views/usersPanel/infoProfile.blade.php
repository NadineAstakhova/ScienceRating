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
                <li class="breadcrumb-item"><a href={{ url('professorProfile') }}>Back</a></li>
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
                                    {{$professor->surname}} {{$professor->name}} {{$professor->patronymic}}
                                </p>
                                <h6>ФИО (укр)</h6>
                                <p>
                                    {{$professor->surname}} {{$professor->name}} {{$professor->patronymic}}
                                </p>
                                <h6>ФИО (en)</h6>
                                <p>
                                    {{$professor->surname}} {{$professor->name}}
                                </p>
                                <h6>Логин</h6>
                                <p>
                                    {{$professor->username}}
                                </p>
                                <h6>Почта</h6>
                                <p>
                                    {{$professor->email}}
                                </p>
                            </div>


                        </div>
                        <!--/row-->
                    </div>

                    <div class="tab-pane" id="edit">
                        {!! Form::open(['url' => ['editUserInfo'], 'class'=>'form']) !!}
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Фамилия:</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{$professor->surname}}" name="surname">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Имя:</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{$professor->name}}" name="name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Отчество:</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{$professor->patronymic}}" name="patronymic">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Фамилия (укр):</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{$professor->surname}}" name="surname_ukr">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Имя (укр):</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{$professor->name}}" name="name_ukr">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Отчество (укр):</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{$professor->patronymic}}" name="patronymic_ukr">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Фамилия (en):</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{$professor->surname}}" name="surname_en">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Имя (en):</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{$professor->name}}" name="name_ukr">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Email:</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="email" value="{{$professor->email}}" name="email">
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
