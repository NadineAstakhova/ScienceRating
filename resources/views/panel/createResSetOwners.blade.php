@extends('layouts.main')
@section('title', 'Add Owners')
@section('content')

    <div class="row">
        <h3>Выберите участника/ов</h3>
        <h4>Можете воспользоваться фильтрами в заголовках таблицы</h4>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {!! Form::open(['url' => ['addResultOwner/'.$idResult], 'class'=>'form-inline', 'files'=>'true']) !!}

        {!! Form::submit('Save', ['class' => 'btn btn-default', 'id' => 'btn']) !!}

        <a class="btn btn-default btn-close" href="{{ url()->to('profile') }}">Cancel</a>
        <br>
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
                    <td>{!! Form::select('arrRole['.$i.']', \App\UsersOwners::ARRAY_ROLES,  null, ['class' => 'form-control']) !!}</td>
                    <td>{!! Form::checkbox('arrOwners['.$i.']', $user->idUsers, Session::has('owners') && in_array($user->idUsers, $arr) ?
                    true : false, ['class' => 'form-control']) !!}

                    </td>
                </tr>
                @php
                    $i++;
                @endphp
            @endforeach

            </tbody>
        </table>
        {!! Form::submit('Save', ['class' => 'btn btn-default', 'id' => 'btn']) !!}

        <a class="btn btn-default btn-close" id="j">Cancel</a>

        {!! Form::close() !!}
        <br>
    </div>

<script>
  /*  $("#ownerTable").ready(function(){

            let rows, switching = true, i, x, y, shouldSwitch, dir, switchcount = 0;
            //table for sort
            let table = document.getElementById("ownerTable");

            let equal = function (a, b, sort) {
                if (sort == "asc")
                    return a > b;
                else
                    return a < b;
            };

            while (switching) {
                switching = false;
                rows = table.getElementsByTagName("TR");

                for (i = 1; i < (rows.length - 1); i++) {

                    shouldSwitch = false;
                    let out = false;


                    //get value of rows in curret column
                    x = $(rows[i].getElementsByTagName("TD")[4]).find("span").attr('id');
                    y = $(rows[i + 1].getElementsByTagName("TD")[4]).find("span").attr('id');
                    console.log($('#' + x).html());
                    console.log($('#' + y).html());
                    //     console.log($(rows[i + 1].getElementsByTagName("TD")[4]).find("input").attr('id'));


                    let real_x = parseFloat($('#' + x).html());

                    let real_y = parseFloat($('#' + y).html());
                    console.log(real_x > real_y)


                    if (real_x === real_y) continue;

                    if (equal(real_x, real_y, "asc")) {
                        shouldSwitch = true;
                        out = true;
                        break;
                    }

                    if (out) break;
                }


                //swap rows
                if (shouldSwitch) {

                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;

                    switchcount++;
                }
            }


    });*/
</script>
@endsection