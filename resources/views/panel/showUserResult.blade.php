<?php
/**
 * Created by PhpStorm.
 * User: Nadine
 * Date: 27.12.2017
 * Time: 12:48
 */
?>
@extends('layouts.main')
@section('title', 'User Results')
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href={{ url()->previous() }}>Back</a></li>
            <li class="breadcrumb-item active">Научные результаты {{$user}}</li>
        </ol>
        <h3>Научные результаты {{$user}}</h3>
    </div>
    <div class="row">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>
                    Тип результата
                </th>
                <th>
                    Название
                </th>
                <th>
                    Дата
                </th>
                <th>
                    Роль
                </th>
            </tr>
            </thead>
            <tbody>
                @foreach($arrResults as $res)
                    <tr>
                        <td>{{$res->type}} {{$res->type_of_participation}}</td>
                        <td>{{$res->title}}</td>
                        <td>{{$res->date}}</td>
                        <td>{{$res->role}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

@endsection
