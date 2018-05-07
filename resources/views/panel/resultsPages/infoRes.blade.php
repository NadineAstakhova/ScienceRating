<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 07/05/2018
 * Time: 16:36
 */
?>@extends('layouts.main')
@section('title', 'Info Scientific Result')
@section('content')
    <div class="row">
        <nav aria-label="breadcrumb" style="width: 100%;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href={{ url()->previous() }}>Back</a></li>
                <li class="breadcrumb-item active">Научный результат {{$event->titleEvent}}</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-xs-6 col-sm-8 col-lg-8">
            <h3>Информация о {{$event->titleEvent}} </h3>
        </div>
        <div class="col-md-9">
            <h6>Дата</h6>
            <p>
                {{$event->date}}
            </p>
            <h6>Тип</h6>
            <p>
                {{$event->type}}
            </p>
            <h6>Участинки</h6>
            <p>


            </p>
        </div>
    </div>
@endsection