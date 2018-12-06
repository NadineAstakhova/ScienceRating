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
                    <li class="breadcrumb-item"><a href={{ url(App\Http\Middleware\LocaleMiddleware::getLocale().'/professorProfile') }}>{{ trans('messages.main')}}</a></li>
                @elseif(Auth::user()->type == '2')
                    <li class="breadcrumb-item"><a href={{ url(App\Http\Middleware\LocaleMiddleware::getLocale().'/studentProfile') }}>{{ trans('messages.main')}}</a></li>
                @endif

                <li class="breadcrumb-item active">{{ trans('messages.rankings')}}</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <h5>{{ trans('messages.user_rank')}}</h5>
    </div>
    <div class="row">
        <p class="font-weight-normal">{{ trans('messages.rank_msg')}}</p>
    </div>
    <div class="row">

        @if(Auth::user()->type == '1')
            <div class="card text-center">
                <h5 class="card-header">{{ trans('messages.rank_prof')}}</h5>
                <div class="card-body">
                    <p class="card-text">{{ trans('messages.prof_rank_title')}}</p>
                    <a href="{{url("pdfRanking/3/".Auth::user()->idUsers)}}" class="btn btn-primary" target="_blank">{{ trans('messages.pdf_doc')}}</a>
                    <a href="{{url("docRanking/3/".Auth::user()->idUsers)}}" class="btn btn-primary">{{ trans('messages.doc_doc')}}</a>
                </div>
            </div>

        @elseif(Auth::user()->type == '2')
            <div class="col-lg-6 col-md-9 col-sm-9 panel-cards">
                <div class="card text-center">
                    <h5 class="card-header">{{ trans('messages.rank_mag')}}</h5>
                    <div class="card-body">
                        <p class="card-text">{{ trans('messages.rank_mag_msg')}}</p>
                        <a href="{{url("pdfRanking/2/".Auth::user()->idUsers)}}" class="btn btn-primary" target="_blank">{{ trans('messages.pdf_doc')}}</a>
                        <a href="{{url("docRanking/2/".Auth::user()->idUsers)}}" class="btn btn-primary">{{ trans('messages.doc_doc')}}</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-9 col-sm-9 panel-cards">
                <div class="card text-center">
                    <h5 class="card-header">{{ trans('messages.rank_asp')}}</h5>
                    <div class="card-body">
                        <p class="card-text">{{ trans('messages.rank_asp_msg')}}</p>
                        <a href="{{url("pdfRanking/1/".Auth::user()->idUsers)}}" class="btn btn-primary" target="_blank">{{ trans('messages.pdf_doc')}}</a>
                        <a href="{{url("docRanking/1/".Auth::user()->idUsers)}}" class="btn btn-primary">{{ trans('messages.doc_doc')}}</a>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
