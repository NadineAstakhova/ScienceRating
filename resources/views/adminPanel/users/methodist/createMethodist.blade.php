@extends('layouts.adminMain')
@section('title', trans('messages.create_method'))
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
                                <h4 class="card-title" id="basic-layout-form-center">{{ trans('messages.create_method')}}</h4>
                                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                            </div>
                            <div class="card-body collapse in">
                                <div class="card-block">
                                    @if ($errors->any())
                                        <div class="alert alert-danger no-border" style="color: #ffffff !important;">
                                            @foreach ($errors->all() as $error)
                                                {{ $error }}
                                            @endforeach
                                        </div>
                                    @endif
                                    {!! Form::open(['url' => ['createMethodistForm'], 'class'=>'form']) !!}
                                    <div class="row">
                                        <div class="col-md-6 offset-md-3">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    {!! Form::label('username', trans('messages.login')) !!}
                                                    <input type="text" id="username" class="form-control"
                                                           placeholder="username" name="username">
                                                </div>

                                                <div class="form-group">
                                                    {!! Form::label('email', trans('messages.email')) !!}
                                                    <input type="email" id="email" class="form-control"
                                                           placeholder="email@email.ru" name="email"
                                                           pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions center">
                                        {!! Form::submit(trans('messages.save'), ['class' => 'btn btn-primary', 'id' => 'btn']) !!}
                                        <a class="btn btn-blue-grey mr-1" href="{{ url()->previous() }}">{{ trans('messages.cancel')}}</a>
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