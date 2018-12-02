@extends('layouts.main')
@section('title', 'Главная')
@section('content')
    <div class="row">
        <div class="col-lg-9 panel-cards">
            <h3>Hello, {{Auth::user()->username}}</h3>
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
                    <h5 class="card-header">  {{ trans('messages.add_res')}}</h5>
                    <div class="card-body">
                        <p class="card-text">Формы добавление данных результата для пользователя/ей.</p>
                        <a href="{{url(App\Http\Middleware\LocaleMiddleware::getLocale()."/createResult")}}" class="btn btn-info" id="listSub">Ввести данные</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-9 panel-cards">
                <div class="card">
                    <h5 class="card-header">Добавление научных публикаций</h5>
                    <div class="card-body">
                        <p class="card-text">Формы добавление данных публикации для пользователя/ей.</p>
                        <a href="{{url("createArticle")}}" class="btn btn-info" id="listSub">Ввести данные</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-9 panel-cards">
                @if($countOfNewResults > 0)
                    <div class="card">
                @else
                    <div class="card disabled-card">
                @endif
                         <h5 class="card-header">Подтверждение научных показателей</h5>
                         <div class="card-body">
                               <p class="card-text">Подтверждение научных результатов, которые присылают пользователи.</p>
                                @if($countOfNewResults > 0)
                                    <a href="{{url("acceptResults")}}" class="btn btn-info">Просмотр новых данных ({{$countOfNewResults}})</a>
                                @else
                                    <button type="button" class="btn btn-light" disabled="">Нет новых данных</button>
                                @endif
                          </div>
                     </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-9 panel-cards">
                <div class="card">
                    <h5 class="card-header">Научные достижения</h5>
                    <div class="card-body">
                        <p class="card-text">Просмотр и распечатка текущих научных результатов без учёта рейтинга.</p>
                        <a href="{{url(App\Http\Middleware\LocaleMiddleware::getLocale()."/results")}}" class="btn btn-info" id="listSub">Просмотр данных</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-9 panel-cards">
                <div class="card">
                    <h5 class="card-header">Построение рейтингов</h5>
                    <div class="card-body">
                        <p class="card-text">Составить и распечатать рейтинги пользователей по типам.</p>
                        <a href="{{url(App\Http\Middleware\LocaleMiddleware::getLocale()."/createrating")}}" class="btn btn-info" id="listSub">Просмотр рейтинга</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-9 panel-cards">
                <div class="card">
                    <h5 class="card-header">Личные данные</h5>
                    <div class="card-body">
                        <p class="card-text">Просмотр личных данных и их редактирование</p>
                        <a href="{{url(App\Http\Middleware\LocaleMiddleware::getLocale()."/infoProfileMethodist")}}" class="btn btn-info" id="listSub">Просмотр анкеты</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-9 panel-cards">
                <div class="card disabled-card">
                    <h5 class="card-header">Шаблоны рейтингов</h5>
                    <div class="card-body">
                        <p class="card-text">Создание научных рейтингов с весовыми коэффициентами и типами результатов.</p>
                        <button type="button" class="btn btn-light" disabled="">Создать шаблон рейтинга</button>
                    </div>
                </div>
            </div>
        <br><br>
    </div>
</div>
@endsection