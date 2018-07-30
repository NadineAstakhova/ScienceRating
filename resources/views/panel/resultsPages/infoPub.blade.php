<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 09/05/2018
 * Time: 15:51
 */
?>
@extends('layouts.main')
@section('title', 'Info Scientific Publication')
@section('content')
    <div class="row">
        <nav aria-label="breadcrumb" style="width: 100%;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href={{ url()->previous() }}>Back</a></li>
                <li class="breadcrumb-item active">Научная публикация {{$publication->title}}</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-xs-6 col-sm-8 col-lg-8">
            <h3>Информация о {{$publication->title}} </h3>
        </div>

    </div>
    <div class="row my-2">
        <div class="col-lg-9">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="" data-target="#profile" data-toggle="tab" class="nav-link active">Информация</a>
                </li>
                @if(Auth::user()->type == '3')
                    <li class="nav-item">
                        <a href="" data-target="#edit" data-toggle="tab" class="nav-link">Редактирование</a>
                    </li>
                @endif
            </ul>
            <div class="tab-content py-4">
                <div class="tab-pane active" id="profile">
                    <div class="row">
                        <div class="col-md-9" >
                            <h6>Тип</h6>
                            <p>
                                {{$publication->type}}
                            </p>
                            <h6>Издательство</h6>
                            <p>
                                {{$publication->edition}}
                            </p>
                            <h6>Кол-во страниц</h6>
                            <p>
                                {{$publication->pages}}
                            </p>
                            <h6>Дата</h6>
                            <p>
                                {{$publication->date}}
                            </p>
                            <h6>Файл</h6>
                            <p>
                                {{$publication->file}}
                            </p>
                            <h6>Участинки</h6>
                            @if(Auth::user()->type == '3')
                                <a href="{{url("editAuthorMembers/".$publication->idPublication)}}" class="btn btn-info btn-sm" id="listSub">Изменить участников</a>
                            @endif
                            <table class="table table-sm">
                                <thead>
                                <tr>
                                    <th scope="col">ФИО</th>
                                    <th scope="col">Статус</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($members as $member)
                                    <tr>
                                        <td>
                                            {{$member->professor_surname}}  {{$member->professor_name}}
                                            {{$member->student_surname}}  {{$member->student_name}}
                                        </td>

                                        <td class="{{$member->status}}">
                                            {{$member->status}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--/row-->
                </div>

                <div class="tab-pane" id="edit">
                    {!! Form::open(['url' => ['editPublicationInfo/'.$publication->idPublication], 'class'=>'form']) !!}
                    {!! Form::label('name', 'Название публикации:') !!}

                    <input type="text" id="name" class="form-control" name="name" value="{{$publication->title}}">
                    <span id="nameT"></span>
                    <br>

                    {!! Form::label('type', 'Тип:') !!}
                    {!! Form::select('type', $arrType,  $publication->fk_pub_type, ['class' => 'form-control form-control-md', 'style' => 'max-width:100%']) !!}
                    <span id="typeT"></span>

                    <br>
                    <div class="form-group row">
                        {!! Form::label('date', 'Дата:', array('class' => 'col-sm-2 col-form-label')) !!}
                        <div class="col-sm-3">
                            <input type="text" id="date" class="form-control" name="date" value="{{$publication->date}}">
                        </div>
                        <span id="dateT" class="col-sm-10"></span>
                    </div>

                    <div class="form-group row">
                        {!! Form::label('publishing', 'Издательство:', array('class' => 'col-sm-2 col-form-label')) !!}
                        <div class="col-sm-3">
                            <input type="text" id="publishing" class="form-control"
                                   name="publishing" value="{{$publication->edition}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        {!! Form::label('pages', 'Количество страниц:', array('class' => 'col-sm-2 col-form-label')) !!}
                        <div class="col-sm-3">
                            <input type="number" id="pages" class="form-control" name="pages" value="{{$publication->pages}}">
                        </div>
                    </div>
                    <br>

                    {!! Form::submit('Save', ['class' => 'btn btn-outline-success', 'id' => 'btn']) !!}
                    <a class="btn btn-outline-secondary btn-close" href="{{ url()->previous() }}">Cancel</a>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>
@endsection
