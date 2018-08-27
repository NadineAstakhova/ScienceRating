@extends('layouts.adminMain')
@section('title', 'Создание профессора')
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
                                <h4 class="card-title" id="basic-layout-form-center">Создание профессора</h4>
                                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                            </div>
                            <div class="card-body collapse in">
                                <div class="card-block">
                                    {!! Form::open(['url' => ['createProfessorForm'], 'class'=>'form']) !!}
                                    <div class="row">
                                        <div class="col-md-6 offset-md-3">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    {!! Form::label('surname', 'Фамилия') !!}
                                                    <input type="text" id="surname" class="form-control"
                                                           placeholder="surname" name="surname">
                                                </div>

                                                <div class="form-group">
                                                    {!! Form::label('name', 'Имя') !!}
                                                    <input type="text" id="name" class="form-control"
                                                           placeholder="name" name="name">
                                                </div>

                                                <div class="form-group">
                                                    {!! Form::label('patronymic', 'Отчество') !!}
                                                    <input type="text" id="patronymic" class="form-control"
                                                           placeholder="patronymic" name="patronymic">
                                                </div>

                                                <div class="form-group">
                                                    {!! Form::label('username', 'Логин') !!}
                                                    <input type="text" id="username" class="form-control"
                                                           placeholder="username" name="username">
                                                </div>

                                                <div class="form-group">
                                                    {!! Form::label('email', 'Почта') !!}
                                                    <input type="email" id="email" class="form-control"
                                                           placeholder="email@email.ru" name="email">
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