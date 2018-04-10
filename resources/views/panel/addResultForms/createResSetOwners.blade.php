@extends('layouts.main')
@section('title', 'Add Owners')

@section('content')

    <div class="row">
        {!! Form::open(['url' => ['addResultOwner/'.$idResult], 'class'=>'form', 'files'=>'true', 'style' => 'width:100%']) !!}
        <h3 class="font-weight-normal">Выберите участника/ов</h3>
        <h4 class="font-weight-normal">Можете воспользоваться фильтрами в заголовках таблицы</h4>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif



        {!! Form::submit('Save', ['class' => 'btn btn-outline-success', 'id' => 'btn']) !!}

        <a class="btn btn-outline-secondary btn-close" href="{{ url()->to('profile') }}">Cancel</a>
        <br><br>
        <table class="table table-sm" id="ownerTable">
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
                        Участие в результате
                    </th>
                    <th>
                        Добавить
                    </th>
                </tr>
            </thead>
            @php
                if(Session::has('owners')){
                   $arr = Session::get("owners");
                }

            @endphp
            @php $i=0; @endphp
            <tbody>
            @foreach($arrUsers as $user)

                <tr class="all">
                    <td class="name">{{$user->surname}} {{$user->name}} {{$user->patronymic}}</td>
                    <td class="type">{{$user->type}}</td>
                    <td class="email">{{$user->email}}</td>
                    @php

                   // $id = ($i % 2 == 0) ? '0': '1';
                    @endphp
                    <td>{!! Form::select('arrRole['.$i.']', \App\Models\UsersOwners::ARRAY_ROLES,  null, ['class' => 'form-old-select form-control']) !!}</td>
                    <td>

                        {!! Form::checkbox('arrOwners['.$i.']', $user->idUsers, Session::has('owners') && in_array($user->idUsers, $arr) ?
                    true : false) !!}

                    </td>
                </tr>
                @php
                    $i++;
                @endphp
            @endforeach

            </tbody>
        </table>
        {!! Form::submit('Save', ['class' => 'btn btn-outline-success', 'id' => 'btn']) !!}

        <a class="btn btn-outline-secondary btn-close" id="j">Cancel</a>

        {!! Form::close() !!}
        <br>
    </div>

@endsection