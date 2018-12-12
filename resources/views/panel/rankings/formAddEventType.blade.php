<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12/12/2018
 * Time: 10:26
 */

?>
@extends('layouts.main')
@section('title', 'Add Type')
@section('content')
    <div class="row">
        {!! Form::open(['url' => [App\Http\Middleware\LocaleMiddleware::getLocale().'/addExistedEventType/'.$ranking->getId().'/'.$eventType->idTypeEvents], 'class'=>'form',  'method' => 'POST', 'style' => 'width:100%; padding-bottom:20px;']) !!}
        <h3 class="font-weight-normal">{{ $eventType->type}}</h3>
        {{csrf_field()}}

        {!! Form::label('type',  trans('messages.type_of_res').':') !!}
        {!! Form::select('typeResult', $arrResults, null, ['class' => 'form-old-select form-control']) !!}
        <span id="typeT"></span>
        <br>
        <div class="form-group row">
            {!! Form::label('mark', trans('messages.mark').':', array('class' => 'col-sm-2 col-form-label')) !!}
            <div class="col-sm-3">
                <input type="number" id="mark" class="form-control" name="mark" value="" step="0.1" min="1" required>
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


        {!! Form::submit(trans('messages.save'), ['class' => 'btn btn-outline-secondary']) !!}
        <a class="btn btn-outline-secondary btn-close" href="{{ url()->to(App\Http\Middleware\LocaleMiddleware::getLocale().'/addExistedTypeOfEvent/'.$ranking->getId()) }}">{{ trans('messages.cancel')}}</a>
        {!! Form::close() !!}
    </div>
@endsection
