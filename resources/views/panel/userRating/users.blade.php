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
        {!! Form::open(['url' => [App\Http\Middleware\LocaleMiddleware::getLocale().'/showUserResult'], 'class'=>'form',  'method' => 'GET', 'style' => 'width:100%; padding-bottom:20px;']) !!}
        <h3 class="font-weight-normal">Выберите пользователя</h3>
        <h4 class="font-weight-normal">Можете воспользоваться фильтрами в заголовках таблицы</h4>


        {!! Form::submit('Просмотреть научный результат', ['class' => 'btn btn-outline-secondary', 'id' => 'btn-u1']) !!}
        <a class="btn btn-outline-secondary btn-close" href="{{ url()->to(App\Http\Middleware\LocaleMiddleware::getLocale().'/profile') }}">Cancel</a>
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
                    <td>
                        <div class="custom-control custom-radio">
                            {!! Form::radio('owner_id', $user->idUsers, false, ['class' => 'owners custom-control-input', 'id' =>  'customRadio'.$user->idUsers]) !!}
                            <label class="custom-control-label" for='customRadio{{$user->idUsers}}'></label>
                        </div>
                    </td>
                </tr>
                @php
                    $i++;
                @endphp
            @endforeach

            </tbody>
        </table>
        {!! Form::submit('Просмотреть научный результат', ['class' => 'btn btn-outline-secondary', 'id' => 'btn-u']) !!}
        <a class="btn btn-outline-secondary btn-close" href="{{ url()->to('profile') }}">Cancel</a>
        {!! Form::close() !!}

    </div>
@endsection