
@extends('layouts.main')
@section('title', 'Profile')
@section('content')
    <div class="row">
        <div class="col-lg-9 panel-cards">
            <h3>Hello, {{Auth::user()->username}}</h3>
        </div>
    </div>
    <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-9 panel-cards">
                <div class="card">
                    <h5 class="card-header">Ввод данных результата</h5>
                    <div class="card-body">
                        <h5 class="card-title">Данные результата</h5>
                        <p class="card-text">Формы добавление данных результата для пользователя/ей.</p>
                        <a href="{{url("createres")}}" class="btn btn-info" id="listSub">Ввести данные результата</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-9 panel-cards">
                <div class="card">
                    <h5 class="card-header">Научные результаты</h5>
                    <div class="card-body">
                        <h5 class="card-title">Научные результаты</h5>
                        <p class="card-text">Просмотр и распечатка текущих научных результатов без учёта рейтинга.</p>
                        <a href="{{url("results")}}" class="btn btn-info" id="listSub">Просмотр результатов</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-9 panel-cards">
                <div class="card">
                    <h5 class="card-header">Построение рейтинга</h5>
                    <div class="card-body">
                        <h5 class="card-title">Рейтинги пользователей</h5>
                        <p class="card-text">Составить и распечатать рейтинги пользователей по типам.</p>
                        <a href="{{url("createrating")}}" class="btn btn-info" id="listSub">Построить рейтинг</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-9 panel-cards">
                <div class="card">
                    <h5 class="card-header">Подтверждение</h5>
                    <div class="card-body">
                        <h5 class="card-title">Подтверждение результатов</h5>
                        <p class="card-text">Подтверждение научных результатов, которые присылают пользователи.</p>
                        <a href="{{url("#")}}" class="btn btn-info">Новых результатов - </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-9 panel-cards">
                <div class="card disabled-card">
                    <h5 class="card-header">Шаблоны рейтингов</h5>
                    <div class="card-body">
                        <h5 class="card-title">Создание шаблонов рейтингов</h5>
                        <p class="card-text">Определение новых научных рейтингов с весовыми коэффициентами и типами результатов.</p>
                        <button type="button" class="btn btn-light" disabled="">Создать шаблон рейтинга</button>
                    </div>
                </div>
            </div>





        <br><br>
        @php
            if(Session::has('save'))
               echo "<div class='alert alert-success' id='mesSuccessAdd'>".Session::get("save")."</div>";
           if(Session::has('error'))
               echo "<div class='alert alert-danger' id='mesSuccessAdd'>".Session::get("error")."</div>";
        @endphp
    </div>

@endsection