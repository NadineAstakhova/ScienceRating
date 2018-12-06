<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 19/03/2018
 * Time: 16:00
 */?>
@extends('layouts.main')
@section('title', 'Главная')
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
                <h5 class="card-header">{{ trans('messages.user_results')}}</h5>
                <div class="card-body">
                    <p class="card-text">{{ trans('messages.scient_res_text')}}</p>
                    <a href="{{url(App\Http\Middleware\LocaleMiddleware::getLocale()."/showUserResult/".$user->idUsers)}}" class="btn btn-info" id="listSub">{{ trans('messages.scient_res_btn')}}</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-9 panel-cards">
            <div class="card">
                <h5 class="card-header">{{ trans('messages.add_pub')}}</h5>
                <div class="card-body">
                    <p class="card-text">{{ trans('messages.add_pub_text_user')}}</p>
                    <a href="{{url(App\Http\Middleware\LocaleMiddleware::getLocale()."/createArticleByUser/".$user->idUsers)}}" class="btn btn-info" id="listSub">{{ trans('messages.add_res_btn')}}</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-9 panel-cards">
            <div class="card">
                <h5 class="card-header">{{ trans('messages.add_res')}}</h5>
                <div class="card-body">
                    <p class="card-text">{{ trans('messages.add_res_text_user')}}</p>
                    <a href="{{url(App\Http\Middleware\LocaleMiddleware::getLocale()."/createEventByUser/".$user->idUsers)}}" class="btn btn-info" id="listSub">{{ trans('messages.add_res_btn')}}</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-9 panel-cards">
            <div class="card">
                <h5 class="card-header">{{ trans('messages.scient_rank')}}</h5>
                <div class="card-body">
                    <p class="card-text">{{ trans('messages.scient_rank_text_user')}}</p>
                    <a href="{{url(App\Http\Middleware\LocaleMiddleware::getLocale()."/rankingsPage")}}" class="btn btn-info" id="listSub">{{ trans('messages.scient_rank_btn')}}</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-9 panel-cards">
            <div class="card">
                <h5 class="card-header">{{ trans('messages.profile_data')}}</h5>
                <div class="card-body">
                    <p class="card-text">{{ trans('messages.profile_data_text')}}</p>
                    <a href="{{url(App\Http\Middleware\LocaleMiddleware::getLocale()."/infoProfile")}}" class="btn btn-info" id="listSub">{{ trans('messages.profile_data_btn')}}</a>
                </div>
            </div>
        </div>
    </div>

@endsection
