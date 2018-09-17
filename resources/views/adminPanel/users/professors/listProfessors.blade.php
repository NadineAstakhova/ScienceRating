@extends('layouts.adminMain')
@section('title', 'Список преподавателей')
@section('header')
    <script src="{{asset('js/message_alert.js')}}"></script>
@endsection
@section('content')
    <script>
        $(document).ready(function (e) {
            messageAlert('.delete_btn', 'Вы уверены, что хотите удалить пользователя?')
        });
    </script>
    <div class="app-content content container-fluid">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Преподаватели</h4>
                            <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="reload"><i class="icon-reload"></i></a></li>
                                    <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body collapse in">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ФИО</th>
                                        <th>Логин</th>
                                        <th>Почта</th>
                                        <th>Статус</th>
                                        <th>Действия</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($professors as $user)
                                        <tr>
                                            <th scope="row">{{$user->idUsers}}</th>
                                            <td>{{$user->surname}} {{$user->name}} {{$user->patronymic}}</td>
                                            <td>{{$user->username}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{\App\User::STATUS[$user->status]}}</td>
                                            <td>
                                                <a href="{{url("#")}}">
                                                    <i class="icon-pencil3" style="font-size: 20px; color: black"></i>
                                                </a>
                                                <a href="{{url("deleteUser/$user->idUsers")}}" class="delete_btn"
                                                   data-toggle="tooltip" title="Удалить пользователя">
                                                    <i class="icon-trash-o" style="font-size: 20px; color: red"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection