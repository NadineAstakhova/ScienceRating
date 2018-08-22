@extends('layouts.adminMain')
@section('title', 'Создание методиста')
@section('content')
    <div class="app-content content container-fluid">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form-center">Создание методиста</h4>
                                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                            </div>
                            <div class="card-body collapse in">
                                <div class="card-block">
                                    {!! Form::open(['url' => ['createMethodistForm'], 'class'=>'form', 'files'=>'true']) !!}
                                    <div class="row">
                                        <div class="col-md-6 offset-md-3">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    {!! Form::label('username', 'Логин') !!}
                                                    <input type="text" id="username" class="form-control"
                                                           placeholder="username" name="username">
                                                </div>

                                                <div class="form-group">
                                                    {!! Form::label('email', 'Почта') !!}
                                                    <input type="text" id="email" class="form-control"
                                                           placeholder="email@email.ru" name="email">
                                                </div>

                                                <div class="form-group">
                                                    {!! Form::label('password', 'Пароль') !!}
                                                    <input type="text" id="password" class="form-control"
                                                           placeholder="password" name="password">
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions center">
                                        {!! Form::submit('Save', ['class' => 'btn btn-primary', 'id' => 'btn']) !!}
                                        <a class="btn btn-blue-grey mr-1" href="{{ url()->previous() }}">Cancel</a>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection