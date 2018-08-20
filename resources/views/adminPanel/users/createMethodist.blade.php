@extends('layouts.main')
@section('title', 'Главная')
@section('content')
    <div class="row">
        {!! Form::open(['url' => ['createMethodistForm'], 'class'=>'form', 'files'=>'true']) !!}
        <div class="form-group row">
            {!! Form::label('username', 'Логин:', array('class' => 'col-sm-3 col-form-label')) !!}
            <div class="col-sm-8">
                <input type="text" id="username" class="form-control"
                       name="username" >
            </div>

        </div>
        <div class="form-group row">
            {!! Form::label('email', 'Почта:', array('class' => 'col-sm-3 col-form-label')) !!}
            <div class="col-sm-8">
                <input type="text" id="email" class="form-control"
                       name="email" >
            </div>

        </div>
        {!! Form::submit('Save', ['class' => 'btn btn-outline-success', 'id' => 'btn']) !!}

        <a class="btn btn-outline-secondary btn-close" href="{{ url()->previous() }}">Cancel</a>
        <br><br>

        {!! Form::close() !!}
    </div>
@endsection