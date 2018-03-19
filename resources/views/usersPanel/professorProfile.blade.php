<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 19/03/2018
 * Time: 16:00
 */?>
@extends('layouts.main')
@section('title', 'Profile')
@section('content')
    <div class="row">
        <h3>Hello, {{Auth::user()->username}}</h3>

        <br><br>
        @php
            if(Session::has('save'))
               echo "<div class='alert alert-success' id='mesSuccessAdd'>".Session::get("save")."</div>";
           if(Session::has('error'))
               echo "<div class='alert alert-danger' id='mesSuccessAdd'>".Session::get("error")."</div>";
        @endphp
    </div>

@endsection
