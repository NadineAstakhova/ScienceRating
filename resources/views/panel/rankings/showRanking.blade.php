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
@section('header')
    <script src="{{asset('js/message_alert.js')}}"></script>
@endsection
@section('content')
    <script>
        $(document).ready(function (e) {
            messageAlert('.delete_btn', "{{ trans('messages.msg_delete')}}")
        });
    </script>
    <div class="row">
        <nav aria-label="breadcrumb" style="width: 100%;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href={{ url(App\Http\Middleware\LocaleMiddleware::getLocale().'/profile')}}>{{ trans('messages.main')}}</a></li>
                <li class="breadcrumb-item active">{{ $ranking->getTitle()}}</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-xs-6 col-sm-5 col-lg-8">
            <h3>{{ trans('messages.scient_event_user')}}</h3>
        </div>
        <div class="col-xs-4 col-sm-3 col-lg-1" id="listBtn">
            <a href="{{url(App\Http\Middleware\LocaleMiddleware::getLocale()."/addNewTypeOfEvent/".$ranking->getId())}}"
               class="btn btn-outline-dark">
                {{ trans('messages.add_new_type')}} </a>
        </div>
        <div class="col-xs-4 col-sm-3 col-lg-3" id="listBtn">
            <a href="{{url(App\Http\Middleware\LocaleMiddleware::getLocale()."/addNewTypeOfEvent/".$ranking->getId())}}"
               class="btn btn-outline-dark">
                {{ trans('messages.add_existed')}} </a>
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
                        <a href="{{url(App\Http\Middleware\LocaleMiddleware::getLocale()."/deleteEventAtRanking/$event->idRankEvent")}}">
                            <img src="{{asset('images/delete.png')}}" alt="" class="icons delete_btn"></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-xs-6 col-sm-5 col-lg-8">
            <h3>{{ trans('messages.scient_pub_user')}}</h3>
        </div>
        <div class="col-xs-4 col-sm-3 col-lg-1" id="listBtn">
            <a href="{{url(App\Http\Middleware\LocaleMiddleware::getLocale()."/addNewTypeOfPub/".$ranking->getId())}}"
               class="btn btn-outline-dark">
                {{ trans('messages.add_new_type')}} </a>
        </div>
        <div class="col-xs-4 col-sm-3 col-lg-3" id="listBtn">
            <a href="{{url(App\Http\Middleware\LocaleMiddleware::getLocale()."/addExistedTypeOfPub/".$ranking->getId())}}"
               class="btn btn-outline-dark">
                {{ trans('messages.add_existed')}} </a>
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
                    <td>{{$publication->mark}}</td>
                    <td>{{$publication->code}}</td>
                    <td>
                        <a href="{{ url(App\Http\Middleware\LocaleMiddleware::getLocale()."/editRanking/$publication->idPubRank")}}"><img src="{{asset('images/edit.png')}}" alt=" {{ trans('messages.update_profile')}}"  class="icons update_btn"></a>
                        <a href="{{url(App\Http\Middleware\LocaleMiddleware::getLocale()."/deletePubAtRanking/$publication->idPubRank")}}">
                            <img src="{{asset('images/delete.png')}}" alt="" class="icons delete_btn"></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
