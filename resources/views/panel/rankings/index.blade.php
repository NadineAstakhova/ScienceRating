<?php
/**
 * Created by PhpStorm.
 * User: astakhova.n
 * Date: 12/10/2018
 * Time: 6:18 PM
 */
?>

@extends('layouts.main')
@section('title', 'Rankings')
@section('content')
    <div class="row">
        <nav aria-label="breadcrumb" style="width: 100%;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href={{ url(App\Http\Middleware\LocaleMiddleware::getLocale().'/profile')}}>{{ trans('messages.main')}}</a></li>
                <li class="breadcrumb-item active">{{ trans('messages.rankings')}}</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-xs-6 col-sm-8 col-lg-8">
            <h3>{{ trans('messages.rankings_msg')}}</h3>
        </div>
        <table class="table table-bordered" style="margin-top: 5px;">
            <thead>
            <tr>
                <th>
                    Id
                </th>
                <th>
                   {{ trans('messages.pub_name')}}
                </th>
                <th>
                   {{ trans('messages.actions')}}
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($rankings as $rank)
                <tr>
                    <td>{{$rank->idTemplate}}</td>
                    <td>{{$rank->title}}</td>
                    <td>
                        <a href="{{ url(App\Http\Middleware\LocaleMiddleware::getLocale()."/editRanking/$rank->idTemplate")}}"><img src="{{asset('images/edit.png')}}" alt=" {{ trans('messages.update_profile')}}"  class="icons update_btn"></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection


