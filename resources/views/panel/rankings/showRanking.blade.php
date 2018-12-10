<?php
/**
 * Created by PhpStorm.
 * User: astakhova.n
 * Date: 12/10/2018
 * Time: 9:56 PM
 */
?>
@extends('layouts.main')
@section('title', 'Rankings')
@section('content')
    <div class="row">
        <nav aria-label="breadcrumb" style="width: 100%;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href={{ url(App\Http\Middleware\LocaleMiddleware::getLocale().'/profile')}}>{{ trans('messages.main')}}</a></li>
                <li class="breadcrumb-item active">{{ $ranking->getTitle()}}</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-xs-6 col-sm-8 col-lg-8">
            <h3>{{ trans('messages.scient_event_user')}}</h3>
        </div>
        <table class="table table-bordered" style="margin-top: 5px;">
            <thead>
            <tr>
                <th>
                    {{ trans('messages.pub_name')}}
                </th>
                <th>
                   Результат
                </th>
                <th>
                    {{ trans('messages.mark')}}
                </th>
                <th>
                    Код
                </th>
                <th>
                    {{ trans('messages.actions')}}
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($events as $event)
                <tr>
                    <td>{{$event->type}}</td>
                    <td>{{$event->type_of_res}}</td>
                    <td>{{$event->mark}}</td>
                    <td>{{$event->code}}</td>
                    <td>
                        <a href="{{ url(App\Http\Middleware\LocaleMiddleware::getLocale()."/editRanking/$event->idRankEvent")}}"><img src="{{asset('images/edit.png')}}" alt=" {{ trans('messages.update_profile')}}"  class="icons update_btn"></a>
                        <a href="">
                            <img src="{{asset('images/delete.png')}}" alt="" class="icons delete_btn"></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-xs-6 col-sm-8 col-lg-8">
            <h3>{{ trans('messages.scient_pub_user')}}</h3>
        </div>
        <table class="table table-bordered" style="margin-top: 5px;">
            <thead>
            <tr>
                <th>
                    {{ trans('messages.pub_name')}}
                </th>
                <th>
                    {{ trans('messages.mark')}}
                </th>
                <th>
                    Код
                </th>
                <th>
                    {{ trans('messages.actions')}}
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($publications as $publication)
                <tr>
                    <td>{{$publication->type}}</td>
                    <td>{{$event->mark}}</td>
                    <td>{{$event->code}}</td>
                    <td>
                        <a href="{{ url(App\Http\Middleware\LocaleMiddleware::getLocale()."/editRanking/$event->idRankEvent")}}"><img src="{{asset('images/edit.png')}}" alt=" {{ trans('messages.update_profile')}}"  class="icons update_btn"></a>
                        <a href="">
                            <img src="{{asset('images/delete.png')}}" alt="" class="icons delete_btn"></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
