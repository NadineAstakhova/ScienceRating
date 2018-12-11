<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 11/12/2018
 * Time: 14:33
 */
?>
@extends('layouts.main')
@section('title', 'Add Type')
@section('content')
    <div class="row">
        <nav aria-label="breadcrumb" style="width: 100%;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href={{ url(App\Http\Middleware\LocaleMiddleware::getLocale().'/profile')}}>{{ trans('messages.main')}}</a></li>
                <li class="breadcrumb-item active">{{ $ranking->getTitle()}}</li>
            </ol>
        </nav>
    </div>
        @php
            if(Session::has('errorParse')){
               echo "<div class='alert alert-danger' id='mesSuccessAdd'>".Session::get("errorParse")."</div>";
            }
        @endphp
        @if(isset($arrResults))
            {!! Form::open(['url' => [App\Http\Middleware\LocaleMiddleware::getLocale().'/createEventType/'.$ranking->getId()], 'class'=>'form', 'files'=>'true']) !!}
        @else
            {!! Form::open(['url' => [App\Http\Middleware\LocaleMiddleware::getLocale().'/createPubType/'.$ranking->getId()], 'class'=>'form', 'files'=>'true']) !!}
        @endif
        {!! Form::label('title', trans('messages.pub_name').':') !!}

        <input type="text" id="title" class="form-control" name="title" required>
        <span id="nameT"></span>
        @if(isset($arrResults))
            <br>
            {!! Form::label('type',  trans('messages.type_of_res').':') !!}
            {!! Form::select('typeResult', $arrResults, null, ['class' => 'form-old-select form-control']) !!}
            <span id="typeT"></span>
        @endif

        <br>
        <div class="form-group row">
            {!! Form::label('mark', trans('messages.mark').':', array('class' => 'col-sm-2 col-form-label')) !!}
            <div class="col-sm-3">
                <input type="number" id="mark" class="form-control" name="mark" value="" required>
            </div>
            <span id="pagesT" class="col-sm-10"></span>
        </div>

        <div class="form-group row">
            {!! Form::label('code', 'Код:', array('class' => 'col-sm-2 col-form-label')) !!}
            <div class="col-sm-3">
                <input type="text" id="code" class="form-control"
                       name="code" >
            </div>
            <span id="publishingT" class="col-sm-10"></span>

        </div>

        {!! Form::submit(trans('messages.save'), ['class' => 'btn btn-outline-success', 'id' => 'btn']) !!}

        <a class="btn btn-outline-secondary btn-close" href="{{ url()->previous() }}">{{trans('messages.cancel')}}</a>
        <br><br>

        {!! Form::close() !!}

@endsection
