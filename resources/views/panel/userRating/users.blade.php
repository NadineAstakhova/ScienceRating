<?php
/**
 * Created by PhpStorm.
 * User: Nadine
 * Date: 27.12.2017
 * Time: 12:28
 */
?>
@extends('layouts.main')
@section('title', 'Show Users')
@section('content')
    <div class="row">
        <h3>Выберите пользователя</h3>
        <h4>Можете воспользоваться фильтрами в заголовках таблицы</h4>

        {!! Form::open(['url' => ['showUserResult'], 'class'=>'form-inline',  'method' => 'GET']) !!}
        {!! Form::submit('Просмотреть научный результат', ['class' => 'btn btn-default', 'id' => 'btn-u1']) !!}
        <a class="btn btn-default btn-close" href="{{ url()->to('profile') }}">Cancel</a>
        <p id="error-u"></p>
        <table class="table" id="ownerTable">
            <thead>
            <tr>
                <th>
                    <input type="text" id="search" placeholder="Поиск по ФИО..." class='form-control'/>
                </th>
                <th>
                    <select id="selectFilter" class='form-control'>
                        <option id="all">Все пользователи</option>
                        <option id="student">Student</option>
                        <option id="professor">Professor</option>
                    </select>
                </th>
                <th>
                    Email
                </th>
                <th>
                    Добавить
                </th>
            </tr>
            </thead>

            @php $i=0;
            @endphp
            <tbody>
            @foreach($arrUsers as $user)
                <tr class="all">
                    <td class="name">{{$user->surname}} {{$user->name}} {{$user->patronymic}}</td>
                    <td class="type">{{$user->type}}</td>
                    <td class="email">{{$user->email}}</td>
                    <td>{!! Form::radio('owner_id', $user->idUsers, false, ['class' => 'owners']) !!}</td>
                </tr>
                @php
                    $i++;
                @endphp
            @endforeach

            </tbody>
        </table>
        {!! Form::submit('Просмотреть научный результат', ['class' => 'btn btn-default', 'id' => 'btn-u']) !!}
        <a class="btn btn-default btn-close" href="{{ url()->to('profile') }}">Cancel</a>
        {!! Form::close() !!}
        <br><br>
    </div>
@endsection