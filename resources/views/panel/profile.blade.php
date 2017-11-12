@extends('layouts.main')
@section('title', 'Profile')
@section('content')
    <script>
        $(document).ready(function(){
            setTimeout(function(){$('#mesSuccessAdd').slideUp('slow')},5000);
        });
    </script>
    <div class="row">
        <h3>Hello, {{Auth::user()->username}}</h3>
        <a href="{{url("createres")}}" class="btn btn-primary btn-lg" id="listSub">Внести научный результат</a>
        <a href="{{url("createrating")}}" class="btn btn-primary btn-lg" id="listSub">Создать научный рейтинг</a>
        <a href="{{url("#")}}" class="btn btn-primary btn-lg" id="listSub" disabled="">Создать шаблон рейтинга</a>
        <br><br>
        @php
            if(Session::has('save'))
               echo "<div class='alert alert-success' id='mesSuccessAdd'>".Session::get("save")."</div>";
           if(Session::has('error'))
               echo "<div class='alert alert-danger' id='mesSuccessAdd'>".Session::get("error")."</div>";
        @endphp
    </div>

@endsection