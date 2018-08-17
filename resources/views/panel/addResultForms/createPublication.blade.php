<?php
/**
 * Created by PhpStorm.
 * User: astakhova.n
 * Date: 5/3/2018
 * Time: 7:37 PM
 */?>
@extends('layouts.main')
@section('title', 'Create Publication')
@section('header')
    <script src="{{asset('js/createForm.js')}}"></script>
@endsection
@section('content')
    <div class="row">
        <nav aria-label="breadcrumb" style="width: 100%;">
            <ol class="breadcrumb">
                @if(Auth::user()->type == '1')
                    <li class="breadcrumb-item"><a href={{ url('professorProfile') }}>Главная</a></li>
                @elseif(Auth::user()->type == '2')
                    <li class="breadcrumb-item"><a href={{ url('studentProfile') }}>Главная</a></li>
                @elseif(Auth::user()->type == '3')
                    <li class="breadcrumb-item"><a href={{ url('profile') }}>Главная</a></li>
                @endif
                <li class="breadcrumb-item active">Ввод данных научной публикации</li>
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

        @if(!isset($idUser))
            {!! Form::open(['url' => ['createPublicationForm'], 'class'=>'form', 'files'=>'true']) !!}
        @else
            {!! Form::open(['url' => ['createPublicationForm/'.$idUser], 'class'=>'form', 'files'=>'true']) !!}
        @endif

        {!! Form::label('file', 'Загрузить документ:') !!}
        {!! Form::file('file', null, ['class' => 'form-control']) !!}
        <p id="error"></p>
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="allField" name="allField" value="allField">
            <label class="custom-control-label" for="allField">Заполнить автоматически</label>
        </div>
        <br>

        {!! Form::label('name', 'Название публикации:') !!}

        <input type="text" id="name" class="form-control" name="name" value="{{isset($pdfText) && $searchTitle ? $searchTitle : ''}}">
        <span id="nameT"></span>
        <br>

        {!! Form::label('type', 'Тип:') !!}
        {!! Form::select('type', $arrType,  null, ['class' => 'form-control form-control-md', 'style' => 'max-width:100%']) !!}
        <span id="typeT"></span>

        <br>
        <div class="form-group row">
            {!! Form::label('date', 'Дата:', array('class' => 'col-sm-2 col-form-label')) !!}
            <div class="col-sm-3">
                <input type="text" id="date" class="form-control" name="date" value="{{isset($pdfText) && $date[0] ? $date[0] : ''}}"
                       data-inputmask-placeholder="31-12-2018">
            </div>
            <span id="dateT" class="col-sm-10"></span>
        </div>
        <div class="form-group row">
            {!! Form::label('publishing', 'Издательство:', array('class' => 'col-sm-2 col-form-label')) !!}
            <div class="col-sm-3">
                <input type="text" id="publishing" class="form-control"
                       name="publishing" >
            </div>

        </div>
        <div class="form-group row">
            {!! Form::label('pages', 'Количество страниц:', array('class' => 'col-sm-2 col-form-label')) !!}
            <div class="col-sm-3">
                <input type="number" id="pages" class="form-control" name="pages" >
            </div>

        </div>

        <br>
        @if(isset($pdfText))
            {!! Form::label('pdfText', 'Содержание файла:') !!}
            {!! Form::textArea('pdfText', $pdfText, ['class' => 'form-control', 'style' => 'width:100%']) !!}
            <br> <br>
            <div class="alert alert-info" role="alert">
                <p>Удалось определить таких студентов/преподавателей. На следующей странице вы можете изменить эту информацию</p>
                @if($users != 0)
                    @php $i=0; @endphp
                    @foreach ($users as $user)
                        <li>{{ $user['surname'] }}</li>
                        {{ Form::hidden('owners['.$i.']', $user['id']) }}
                        @php $i++; @endphp
                    @endforeach
                @else
                    Совпадений не найдено.
                @endif
            </div>
        @endif

        {!! Form::submit('Save', ['class' => 'btn btn-outline-success', 'id' => 'btn']) !!}

        <a class="btn btn-outline-secondary btn-close" href="{{ url()->previous() }}">Cancel</a>
        <br><br>

        {!! Form::close() !!}

    </div>
@endsection
