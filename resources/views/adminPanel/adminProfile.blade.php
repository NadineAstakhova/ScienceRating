@extends('layouts.main')
@section('title', 'Главная')
@section('content')
    <div>You are super admin {{Auth::user()->username}}</div>
    <a href="{{url("infoProfileMethodist")}}" class="btn btn-info" id="listSub">Просмотр анкеты</a>
@endsection