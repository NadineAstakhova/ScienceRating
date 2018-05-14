<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 07/05/2018
 * Time: 16:36
 */
?>
@extends('layouts.main')
@section('title', 'Info Scientific Result')
@section('content')
    <div class="row">
        <nav aria-label="breadcrumb" style="width: 100%;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href={{ url()->previous() }}>Back</a></li>
                <li class="breadcrumb-item active">Научный результат {{$event->titleEvent}}</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-xs-6 col-sm-8 col-lg-8">
            <h3>Информация о {{$event->titleEvent}} </h3>
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
                            <h6>Дата</h6>
                            <p>
                                {{$event->date}}
                            </p>
                            <h6>Тип</h6>
                            <p>
                                {{$event->type}}
                            </p>
                            <h6>Участинки</h6>
                            @if(Auth::user()->type == '3')
                                <a href="{{url("editEventMembers/".$event->idScientEvent)}}" class="btn btn-info" id="listSub">Изменить участников</a>
                            @endif
                            <table class="table table-sm">
                                <thead>
                                <tr>
                                    <th scope="col">ФИО</th>
                                    <th scope="col">Результат</th>
                                    <th scope="col">Роль</th>
                                    <th scope="col">Файл</th>
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
                                        <td>
                                            {{$member->type_of_res}}
                                        </td>
                                        <td>
                                            {{$member->type_of_role}}
                                        </td>
                                        <td>
                                            {{$member->file}}
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
                    {!! Form::open(['url' => ['editEventInfo/'.$event->idScientEvent], 'class'=>'form']) !!}
                    {!! Form::label('name', 'Название результата (мероприятия/события):') !!}

                    <input type="text" id="name" class="form-control" name="name" value="{{$event->titleEvent}}">
                    <span id="nameT"></span>
                    <br>

                    {!! Form::label('type', 'Тип:') !!}
                    {!! Form::select('type', $arrType,  $event->fk_type_res, ['class' => 'form-control form-control-md', 'style' => 'max-width:100%']) !!}
                    <span id="typeT"></span>

                    <br>
                    <div class="form-group row">
                        {!! Form::label('date', 'Дата:', array('class' => 'col-sm-2 col-form-label')) !!}
                        <div class="col-sm-3">
                            <input type="text" id="date" class="form-control" name="date" value="{{$event->date}}">
                        </div>
                        <span id="dateT" class="col-sm-10"></span>
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