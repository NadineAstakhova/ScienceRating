@extends('layouts.main')
@section('title', 'Profile')
@section('content')
    <div class="row">
        {{Auth::check() }}
        <h3>Hello, admin</h3>
        <a href="{{url("createres")}}" class="btn btn-primary btn-lg" id="listSub">Внести научный результат</a>
        <a href="{{url("#")}}" class="btn btn-primary btn-lg" id="listSub">Создать научный рейтинг</a>
        <a href="{{url("#")}}" class="btn btn-primary btn-lg" id="listSub">Создать шаблон рейтинга</a>
    </div>

@endsection