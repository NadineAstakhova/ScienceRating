<?php
/**
 * Created by PhpStorm.
 * User: Nadine
 * Date: 27.12.2017
 * Time: 12:48
 */
use App\Models\RankingModels\ScientificResult;
use App\Models\RankingModels\TypeOfRes;
?>
@extends('layouts.main')
@section('title', 'User Results')
@section('header')
    <script src="{{asset('js/printResults.js')}}"></script>

    <script src="{{asset('js/editPercentOfArticle.js')}}"></script>
@endsection
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />

    <div class="row">
        <nav aria-label="breadcrumb" style="width: 100%;">
            <ol class="breadcrumb">
                @if(Auth::user()->type == '1')
                    <li class="breadcrumb-item"><a href={{ url(App\Http\Middleware\LocaleMiddleware::getLocale().'/professorProfile') }}>{{ trans('messages.main')}}</a></li>
                @elseif(Auth::user()->type == '2')
                    <li class="breadcrumb-item"><a href={{ url(App\Http\Middleware\LocaleMiddleware::getLocale().'/studentProfile') }}>{{ trans('messages.main')}}</a></li>
                @elseif(Auth::user()->type == '3')
                    <li class="breadcrumb-item"><a href={{ url(App\Http\Middleware\LocaleMiddleware::getLocale().'/profile') }}>{{ trans('messages.main')}}</a></li>
                @endif
                <li class="breadcrumb-item active">{{ trans('messages.scient_res_user')}} </li>
            </ol>
        </nav>
    </div>
    <div class="row" id='to_print'>
        <div class="col-xs-6 col-sm-8 col-lg-8 printed-center">
            <h3>{{ trans('messages.scient_res_user')}} {{$user}} </h3>
        </div>
        <div class="col-xs-8 col-sm-4 col-lg-4" id="listBtn">
            <button class="btn btn-outline-dark" id="print">{{ trans('messages.print_1')}}</button>
        </div>
        <div class="col-xs-6 col-sm-8 col-lg-8 printed-center">
            <h3>{{ trans('messages.scient_event_user')}} </h3>
        </div>
        <div class="col-xs-6 col-sm-8 col-lg-9">
            <div class="alert alert-info no-print" role="alert">
                {{ trans('messages.edit_pub_msg')}}
            </div>
        </div>
        @if(count($arrEvents) > 0)
        <table class="table table-bordered" style="margin-top: 5px;">
            <thead>
            <tr>
                <th>
                    {{ trans('messages.pub_name')}}
                </th>
                <th>
                    {{ trans('messages.type_of_res')}}
                </th>
                <th>
                    Дата
                </th>
                <th>
                    Результат
                </th>
                <th>
                    Роль
                </th>
                <th class="no-print">
                    Файл
                </th>
                <th>
                    Статус
                </th>
                @if(Auth::user()->type == '3')
                    <th class="no-print">
                        {{ trans('messages.actions')}}
                    </th>
                @endif
            </tr>
            </thead>
            <tbody>
            @php $i=0;
            @endphp
                @foreach($arrEvents as $res)
                    <tr>
                        <td>
                            <a href="{{url(App\Http\Middleware\LocaleMiddleware::getLocale()."/event/$res->idScientEvent")}}">{{$res->titleEvent}}</a>
                        </td>
                        <td>{{$res->type}} </td>
                        <td>{{$res->date}}</td>
                        <td>
                            <div onclick="showInputProviderRes({{$i}})">
                                <span id="result[{{$i}}]" onclick="showInputProviderRes({{$i}})" class="unic-text-percent" data-toggle="tooltip" title="{{ trans('messages.msg_update')}}">
                                    {{$res->type_of_res}}
                                </span>
                            </div>
                            {!! Form::select('arrResult['.$i.']', TypeOfRes::getResultTypes(),  $res->idTypeRes, ['class' => 'form-old-select form-control display-none',
                                'id' => 'resultInput['.$i.']', 'onBlur' =>"blurInputProviderRes($i,$res->idMember )"]) !!}
                        </td>
                        <td>
                            <div onclick="showInputProviderRole({{$i}})">
                                <span id="role[{{$i}}]" onclick="showInputProviderRole({{$i}})" class="unic-text-percent" data-toggle="tooltip" title="{{ trans('messages.msg_update')}}">
                                   {{$res->type_of_role}}
                                </span>
                            </div>
                            {!! Form::select('arrRole['.$i.']', TypeOfRes::getRolesTypes(),  $res->idTypeRole, ['class' => 'form-old-select form-control display-none',
                                'id' => 'roleInput['.$i.']', 'onBlur' =>"blurInputProviderRole($i,$res->idMember )"
                                ]) !!}
                        </td>
                        <td class="no-print">{{$res->file}}</td>
                        <td class = "{{$res->status}}">
                            @if (App\Http\Middleware\LocaleMiddleware::getLocale() == 'ru')
                                {{ScientificResult::ARRAY_STATUS_RU[$res->status]}}
                            @elseif (App\Http\Middleware\LocaleMiddleware::getLocale() == 'uk')
                                {{ScientificResult::ARRAY_STATUS_UK[$res->status]}}
                            @endif
                        </td>
                        @if(Auth::user()->type == '3')
                        <td class="no-print">
                                <a href="{{url("deleteMemberEvent/$res->idMember")}}">
                                    <img src="{{asset('images/delete.png')}}" alt="" class="icons delete_btn"></a>
                        </td>
                        @endif
                        @php
                            $i++;
                        @endphp
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <div class="col-xs-6 col-sm-8 col-lg-8">
                {{ trans('messages.no_res_1')}}
            </div>
        @endif
        <div class="col-xs-6 col-sm-8 col-lg-8 printed-center">
            <h3>{{ trans('messages.scient_pub_user')}} </h3>
        </div>

        @if(count($arrArticles) > 0)
        <table class="table table-bordered" style="margin-top: 5px;">
            <thead>
            <tr>
                <th>
                    Название
                </th>
                <th>
                    Тип
                </th>
                <th>
                    {{ trans('messages.percent')}}
                </th>
                <th>
                    {{ trans('messages.pub_name_short')}}
                </th>
                <th>
                    Дата
                </th>
                <th>
                    {{ trans('messages.pub_numbers')}}
                </th>

                <th class="no-print">
                    Файл
                </th>
                <th>
                    Статус
                </th>
                <th class="no-print">
                    {{ trans('messages.actions')}}
                </th>
            </tr>
            </thead>

            @php $i=0;
            @endphp
            <tbody>
                @foreach($arrArticles as $article)
                    <tr class="all">
                        <td>
                            <a href="{{url(App\Http\Middleware\LocaleMiddleware::getLocale()."/publication/$article->idPublication")}}">{{$article->title}}</a>
                        </td>
                        <td class="type_pub">{{$article->type}} </td>
                        <td class="percent">
                            <div onclick="showInputProvider({{$i}})" data-toggle="tooltip" title="{{ trans('messages.msg_update')}}">
                            <span id="percent[{{$i}}]" onclick="showInputProvider({{$i}})" class="unic-text-percent" >{{$article->percent_of_writing}}</span>
                            </div>
                            <input type="number" class='form-control' name="arrPercent[{{$i}}]" id="percentInput[{{$i}}]"
                                       value="{{$article->percent_of_writing}}"
                                       onBlur="blurInputProvider({{$i}}, {{$article->idPubAuthor}})"

                                   onkeydown="if (event.keyCode ==13) blurInputProvider({{$i}}, {{$article->idPubAuthor}})"

                            />
                        </td>
                        <td class="pub">{{$article->edition}} </td>
                        <td class="date">{{$article->date}} </td>
                        <td class="pages">{{$article->pages}} </td>
                        <td class="file no-print">{{$article->file}} </td>
                        <td class = "{{$article->status}}">
                            @if (App\Http\Middleware\LocaleMiddleware::getLocale() == 'ru')
                                {{ScientificResult::ARRAY_STATUS_RU[$article->status]}}
                            @elseif (App\Http\Middleware\LocaleMiddleware::getLocale() == 'uk')
                                {{ScientificResult::ARRAY_STATUS_UK[$article->status]}}
                            @endif
                        </td>
                        <td class="no-print">
                            <img src="{{asset('images/edit.png')}}" alt=""  class="icons update_btn editIconPub"
                                 onclick="showInputProvider({{$i}})">
                            @if(Auth::user()->type == '3')
                                <a href="{{url("deleteAuthorPub/$article->idPubAuthor")}}">
                                    <img src="{{asset('images/delete.png')}}" alt="" class="icons delete_btn"></a>
                            @endif
                        </td>
                    </tr>
                    @php
                        $i++;
                    @endphp
                @endforeach
            </tbody>
        </table>
        @else
            <div class="col-xs-6 col-sm-8 col-lg-8">
                {{ trans('messages.no_user_pub')}}
            </div>
        @endif
    </div>
@endsection
