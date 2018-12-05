<?php
/**
 * Created by PhpStorm.
 * User: astakhova.n
 * Date: 5/3/2018
 * Time: 10:26 PM
 */
use App\Models\RankingModels\TypeOfRes;
?>
@extends('layouts.main')
@section('header')
    <script src="{{asset('js/createForm.js')}}"></script>
@endsection
@section('content')

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
                <li class="breadcrumb-item active">{{ trans('messages.title_create_event')}}</li>
            </ol>
        </nav>

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif

        @php
            if(Session::has('errorParse')){
               echo "<div class='alert alert-danger' id='mesSuccessAdd'>".Session::get("errorParse")."</div>";
            }
        @endphp

        @if(Auth::user()->type == '3')
        <div class="alert alert-info" role="alert">
            {{ trans('messages.create_event_msg')}}
            <br>{{ trans('messages.create_event_msg_br')}}
        </div>
        @endif

        @if(!isset($idUser))
            {!! Form::open(['url' => ['createEventForm'], 'class'=>'form', 'files'=>'true']) !!}
        @else
            {!! Form::open(['url' => ['createEventForm/'.$idUser], 'class'=>'form', 'files'=>'true']) !!}
        @endif

        {!! Form::label('file',  trans('messages.upload_doc')) !!}
        {!! Form::file('file', null, ['class' => 'form-control']) !!}
        <p id="error"></p>
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="allField" name="allField" value="allField">
            <label class="custom-control-label" for="allField">{{ trans('messages.automatic')}}</label>
        </div>
        @if(Auth::user()->type == '3')
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="forAllUser" name="forAllUser" value="forAllUser">
                <label class="custom-control-label" for="forAllUser">{{ trans('messages.use_all')}}</label>
            </div>
        @endif

        <br>
        {!! Form::label('name', trans('messages.name_event')) !!}

        <input type="text" id="name" class="form-control" name="name" value="{{isset($pdfText) && $searchTitle ? $searchTitle : ''}}">
        <span id="nameT"></span>
        <br>

        {!! Form::label('type', 'Тип:') !!}
        {!! Form::select('type', $arrType,  null, ['class' => 'form-control form-control-md', 'style' => 'max-width:100%']) !!}
        <span id="typeT"></span>

        <br>
        <div class="form-group row">
            <div class="col-sm-2">
                {!! Form::label('date', 'Дата:', array('class' => 'col-form-label')) !!}
            </div>

            <div class="col-sm-3">
                <input type="text" id="date" class="form-control" name="date" value="{{isset($pdfText) && $date[0] ? $date[0] : ''}}"
                data-inputmask-placeholder="31-12-2018">
            </div>
            <span id="dateT" class="col-sm-10"></span>
        </div>
        <br>
        @if(isset($pdfText))
            {!! Form::label('pdfText', trans('messages.file_text')) !!}
            <textarea name="description" id="pdfText" class="form-control" rows="5">"{{$pdfText}}"</textarea>
            <br> <br>
            <div class="alert alert-info" role="alert">
                <p>{{trans('messages.after_text')}}</p>
                @if($users != 0)
                    @php $i=0; @endphp
                    @foreach ($users as $user)
                        <li>{{ $user['surname'] }}</li>
                        {{ Form::hidden('owners['.$i.']', $user['id']) }}
                        @php $i++; @endphp
                    @endforeach
                @else
                    {{trans('messages.after_text_no')}}
                @endif
            </div>
        @endif

        @if(isset($idUser))
            <div class="form-group row">
                {!! Form::label('result', 'Результат:', array('class' => 'col-sm-2 col-form-label')) !!}
                <div class="col-sm-3">
                    {!! Form::select('result', TypeOfRes::getResultTypes(),  null, ['class' => 'form-old-select form-control']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('role', 'Роль:', array('class' => 'col-sm-2 col-form-label')) !!}
                <div class="col-sm-3">
                   {!! Form::select('role',  TypeOfRes::getRolesTypes(),  null, ['class' => 'form-old-select form-control']) !!}
                </div>
            </div>

        @endif

        {!! Form::submit(trans('messages.save'), ['class' => 'btn btn-outline-success', 'id' => 'btn']) !!}

        <a class="btn btn-outline-secondary btn-close" href="{{ url()->previous() }}">{{trans('messages.cancel')}}</a>
        <br><br>

        {!! Form::close() !!}

    </div>
@endsection
