@extends('layouts.main')
@section('title', 'Главная')
@section('content')
    <div>You are super admin {{Auth::user()->username}}</div>
    <a href="{{url("infoProfileMethodist")}}" class="btn btn-info" id="listSub">Просмотр анкеты</a>
    <a href="{{url("createMethodistPage")}}" class="btn btn-info" id="listSub">Добавление методиста</a>
    <a href="{{url("infoProfileMethodist")}}" class="btn btn-info" id="listSub">Добавление преподователя</a>
    <a href="{{url("infoProfileMethodist")}}" class="btn btn-info" id="listSub">Редактирование меню</a>
@endsection