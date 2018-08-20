@extends('layouts.main')
@section('title', 'Главная')
@section('content')
    <div>You are super admin {{Auth::user()->username}}</div>
@endsection