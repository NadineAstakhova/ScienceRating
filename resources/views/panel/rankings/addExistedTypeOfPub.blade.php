<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 11/12/2018
 * Time: 15:44
 */
?>
@extends('layouts.main')
@section('title', 'Add Type')
@section('content')
    <div class="row">
        {!! Form::open(['url' => [App\Http\Middleware\LocaleMiddleware::getLocale().'/addExistedTypes/'.$ranking->getId()], 'class'=>'form',  'style' => 'width:100%']) !!}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @php
            if(Session::has('errorParse')){
               echo "<div class='alert alert-danger' id='mesSuccessAdd'>".Session::get("errorParse")."</div>";
            }
        @endphp
        {!! Form::submit( trans('messages.save'), ['class' => 'btn btn-outline-success btn-submit', 'id' => 'btn']) !!}

        <a class="btn btn-outline-secondary btn-close" href="{{ url()->to(App\Http\Middleware\LocaleMiddleware::getLocale().'/editRanking/'.$ranking->getId()) }}">{{ trans('messages.cancel')}}</a>
        <br> <br>
        <table class="table table-sm" id="ownerTable">
            <thead>
            <tr>
                <th> <input type="text" id="searchOne" placeholder="{{ trans('messages.pub_name')}}..." class='form-control'/></th>
                <th>{{ trans('messages.mark')}}</th>
                <th>Код</th>
                <th>{{ trans('messages.add')}}</th>
            </tr>
            </thead>
            <tbody>
            @php $i=0; @endphp
                @foreach($types as $type)
                    <tr>

                        <td class="name">{{$type->type}}</td>
                        <td>
                            {!! Form::number('arrMark['.$i.']', '1', ['class' => 'form-control']) !!}
                        </td>
                        <td>
                            {!! Form::text('arrCode['.$i.']', '', ['class' => 'form-control']) !!}
                        </td>
                        <td>
                            {!! Form::checkbox('arrTypes['.$i.']', $type->idTypePub) !!}
                        </td>
                    </tr>
                    @php
                        $i++;
                    @endphp
                @endforeach
            </tbody>
        </table>

        {!! Form::submit( trans('messages.save'), ['class' => 'btn btn-outline-success btn-submit', 'id' => 'btn']) !!}

        <a class="btn btn-outline-secondary btn-close" id="j">{{ trans('messages.cancel')}}</a>

        {!! Form::close() !!}


    </div>
    <br>
    <br>
@endsection
