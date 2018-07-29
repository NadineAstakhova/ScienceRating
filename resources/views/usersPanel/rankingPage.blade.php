<?php
/**
 * Created by PhpStorm.
 * User: astakhova.n
 * Date: 5/11/2018
 * Time: 8:26 PM
 */
?>
@extends('layouts.main')
@section('title', 'Your Rankings')
@section('content')
    <div class="row">
        <nav aria-label="breadcrumb" style="width: 100%;">
            <ol class="breadcrumb">
                @if(Auth::user()->type == '1')
                    <li class="breadcrumb-item"><a href={{ url('professorProfile') }}>Главная</a></li>
                @elseif(Auth::user()->type == '2')
                    <li class="breadcrumb-item"><a href={{ url('studentProfile') }}>Главная</a></li>
                @endif

                <li class="breadcrumb-item active">Научные Рейтинги</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <h5>Вам доступны такие научные рейтинги</h5>
    </div>
    <div class="row">
        <p class="font-weight-normal">Обратите внимание, что в рейтингах учитываются только подтверждённые результаты</p>
    </div>
    <div class="row">

        @if(Auth::user()->type == '1')
            <div class="card text-center">
                <h5 class="card-header">Текущий рейтинг преподавателя</h5>
                <div class="card-body">
                    <p class="card-text">Индикаторы персонального рейтинга преподавателя ДонНУ</p>
                    <a href="{{url("pdfRanking/3/".Auth::user()->idUsers)}}" class="btn btn-primary" target="_blank">Сформировать pdf-отчёт</a>
                    <a href="{{url("docRanking/3/".Auth::user()->idUsers)}}" class="btn btn-primary">Сформировать doc-отчёт</a>
                </div>
            </div>

        @elseif(Auth::user()->type == '2')
            <div class="col-lg-6 col-md-9 col-sm-9 panel-cards">
                <div class="card text-center">
                    <h5 class="card-header">Научный рейтинг. Магистратура</h5>
                    <div class="card-body">
                        <p class="card-text">Научные баллы для поступления на магистратуру</p>
                        <a href="{{url("pdfRanking/2/".Auth::user()->idUsers)}}" class="btn btn-primary" target="_blank">Сформировать pdf-отчёт</a>
                        <a href="{{url("docRanking/2/".Auth::user()->idUsers)}}" class="btn btn-primary">Сформировать doc-отчёт</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-9 col-sm-9 panel-cards">
                <div class="card text-center">
                    <h5 class="card-header">Научный рейтинг. Аспирантура</h5>
                    <div class="card-body">
                        <p class="card-text">Научные баллы для поступления на аспирантуру</p>
                        <a href="{{url("pdfRanking/1/".Auth::user()->idUsers)}}" class="btn btn-primary" target="_blank">Сформировать pdf-отчёт</a>
                        <a href="{{url("docRanking/1/".Auth::user()->idUsers)}}" class="btn btn-primary">Сформировать doc-отчёт</a>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
