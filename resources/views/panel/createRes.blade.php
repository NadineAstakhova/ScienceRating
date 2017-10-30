@extends('layouts.main')
@section('title', 'Create Result')
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href={{ url()->previous() }}>Back</a></li>
            <li class="breadcrumb-item active">Создание научного результата</li>
        </ol>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {!! Form::open(['url' => ['createResult'], 'class'=>'form-inline', 'files'=>'true']) !!}

        {!! Form::label('file', 'Загрузить документ:') !!}
        {!! Form::file('file', null, ['class' => 'form-control']) !!}
        <br>
        <label class="form-check-label">
            <input type="checkbox" id="allField" class="form-check-input" name=" Автоматически" value="allField">
            Заполнить автоматически
        </label>
        <br> <br>

        {!! Form::label('name', 'Название результата:') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
        <br> <br>

        {!! Form::label('type', 'Тип:') !!}
        {!! Form::select('type', $arrType,  null, ['class' => 'form-control']) !!}
        <br> <br>

        {!! Form::label('date', 'Дата:') !!}
        {!! Form::text('date', null, ['class' => 'form-control']) !!}
        <br> <br>

        {!! Form::submit('Save', ['class' => 'btn btn-default', 'id' => 'btn']) !!}

        <a class="btn btn-default btn-close" href="{{ url()->previous() }}">Cancel</a>

        {!! Form::close() !!}

        <p id="error"></p>
    </div>

@endsection