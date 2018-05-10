<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 19/03/2018
 * Time: 16:00
 */?>
@extends('layouts.main')
@section('title', 'Profile')
@section('content')
    <div class="row">
        <div class="col-lg-9 panel-cards">
            <h3>Hello, {{$user->surname}} {{$user->name}} {{$user->patronymic}}</h3>
        @php
            if(Session::has('save'))
               echo "<div class='alert alert-success' id='mesSuccessAdd'>".Session::get("save")."</div>";
           if(Session::has('error'))
               echo "<div class='alert alert-danger' id='mesSuccessAdd'>".Session::get("error")."</div>";
        @endphp
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-9 panel-cards">
            <div class="card">
                <h5 class="card-header">Анкета</h5>
                <div class="card-body">
                    <h5 class="card-title">Личные данные</h5>
                    <p class="card-text">Просмотр личных данных и их редактирование</p>
                    <a href="{{url("infoProfile")}}" class="btn btn-info" id="listSub">Посмотреть анкету</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-9 panel-cards">
            <div class="card">
                <h5 class="card-header">Научные результаты</h5>
                <div class="card-body">
                    <h5 class="card-title">Научные результаты</h5>
                    <p class="card-text">Просмотр и распечатка текущих научных результатов без учёта рейтинга.</p>
                    <a href="{{url("showUserResult/".$user->idUsers)}}" class="btn btn-info" id="listSub">Просмотр результатов</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-9 panel-cards">
            <div class="card">
                <h5 class="card-header">Ввод данных публикации</h5>
                <div class="card-body">
                    <h5 class="card-title">Данные научной публикации</h5>
                    <p class="card-text">Формы добавление данных публикации для пользователя/ей.</p>
                    <a href="{{url("createArticleByUser/".$user->idUsers)}}" class="btn btn-info" id="listSub">Ввести данные публикации</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-9 panel-cards">
            <div class="card">
                <h5 class="card-header">Ввод данных результата</h5>
                <div class="card-body">
                    <h5 class="card-title">Данные результата</h5>
                    <p class="card-text">Форма добавления данных вашего научного результата.</p>
                    <a href="#" class="btn btn-info" id="listSub">Ввести данные результата</a>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-9 panel-cards">
            <div class="card">
                <h5 class="card-header">Просмотр рейтинга</h5>
                <div class="card-body">
                    <h5 class="card-title">Научные рейтинги</h5>
                    <p class="card-text">Просмотр и распечатка доступных научных рейтингов.</p>
                    <a href="#" class="btn btn-info" id="listSub">Построить рейтинг</a>
                </div>
            </div>
        </div>
    </div>

@endsection
