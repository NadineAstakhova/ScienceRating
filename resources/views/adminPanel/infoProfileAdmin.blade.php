@extends('layouts.adminMain')
@section('title', 'Профайл')
@section('header')
    <script src="{{asset('js/passConfirm.js')}}"></script>
@endsection
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
                                <h4 class="card-title" id="basic-layout-form-center">Редактирование профиля</h4>
                                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                            </div>
                            <div class="card-body collapse in">
                                <div class="card-block">
                                    {!! Form::open(['url' => ['editAdminInfo'], 'class'=>'form']) !!}
                                    <div class="row">
                                        <div class="col-md-6 offset-md-3">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    {!! Form::label('email', 'Почта') !!}
                                                    <input class="form-control" type="email" value="{{$user->email}}"
                                                           name="email" oninvalid="this.setCustomValidity('Это неверный формат Email')"
                                                           oninput="setCustomValidity('')">
                                                </div>

                                                <div class="form-group">
                                                    <label>Новый пароль:</label>
                                                        {!! Form::password('new_password',
                                                            ['class' => 'form-control', 'id' => 'passNew', 'minlength' => 6]) !!}
                                                </div>

                                                <div class="form-group">
                                                    <label>Повторите пароль:</label>
                                                        {!! Form::password('password_confirm',
                                                            ['class' => 'form-control', 'id' => 'passConf',  'minlength' => 6]) !!}
                                                        <span class="error" id="conf"></span>
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

