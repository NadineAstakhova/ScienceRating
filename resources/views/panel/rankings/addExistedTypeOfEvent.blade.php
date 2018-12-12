<?php
/**
 * Created by PhpStorm.
 * User: astakhova.n
 * Date: 12/11/2018
 * Time: 10:12 PM
 */
?>
@extends('layouts.main')
@section('title', 'Add Type')
@section('content')
    <div class="row">
        {!! Form::open(['url' => [App\Http\Middleware\LocaleMiddleware::getLocale().'/addingFormEventType/'.$ranking->getId()], 'class'=>'form',  'method' => 'GET', 'style' => 'width:100%; padding-bottom:20px;']) !!}
        <h3 class="font-weight-normal">{{ trans('messages.choose_temp')}}</h3>

        {!! Form::submit(trans('messages.add_temp'), ['class' => 'btn btn-outline-secondary', 'id' => 'btn-t1']) !!}
        <a class="btn btn-outline-secondary btn-close" href="{{ url()->to(App\Http\Middleware\LocaleMiddleware::getLocale().'/editRanking/'.$ranking->getId()) }}">{{ trans('messages.cancel')}}</a>
        <p id="error-u"></p>
        <table class="table table-sm" id="ownerTable">
            <thead>
            <tr>
                <th> <input type="text" id="searchOne" placeholder="{{ trans('messages.pub_name')}}..." class='form-control'/></th>
                <th>{{ trans('messages.actions')}}</th>
            </tr>
            </thead>
            <tbody>
            @php $i=0; @endphp
            @foreach($types as $type)
                <tr>
                    <td class="name">{{$type->type}}</td>
                    <td>
                        <div class="custom-control custom-radio">
                            {!! Form::radio('type_id', $type->idTypeEvents, false, ['class' => 'types custom-control-input', 'id' =>  'customRadio'.$type->idTypeEvents]) !!}
                            <label class="custom-control-label" for='customRadio{{$type->idTypeEvents}}'></label>
                        </div>
                    </td>
                </tr>
                @php
                    $i++;
                @endphp
            @endforeach
            </tbody>
        </table>
        {!! Form::submit(trans('messages.add_temp'), ['class' => 'btn btn-outline-secondary', 'id' => 'btn-t']) !!}
        <a class="btn btn-outline-secondary btn-close" href="{{ url()->to(App\Http\Middleware\LocaleMiddleware::getLocale().'/editRanking/'.$ranking->getId()) }}">{{ trans('messages.cancel')}}</a>
        {!! Form::close() !!}
    </div>
@endsection
