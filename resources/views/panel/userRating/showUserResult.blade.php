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
    </div>
    <div class="row" id='to_print'>
        <div class="col-xs-6 col-sm-8 col-lg-8">
            <h3>Научные результаты {{$user}} </h3>
        </div>
        <div class="col-xs-8 col-sm-4 col-lg-4" id="listBtn">
            <button class="btn btn-default" id="print">Печать</button>
        </div>

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
<script>
    $(document).ready(function(){
        $('#print').click(function(){
            var printing_css = "<style media=print>" +
                "#print, .breadcrumb, .delete_btn, #update_btn{display: none;}" +
                "table{text-align: left} </style>";
            var html_to_print=printing_css+$('#to_print').html();
            var iframe=$('<iframe id="print_frame">');
            $('body').append(iframe);
            var doc = $('#print_frame')[0].contentDocument || $('#print_frame')[0].contentWindow.document;
            var win = $('#print_frame')[0].contentWindow || $('#print_frame')[0];
            doc.getElementsByTagName('body')[0].innerHTML=html_to_print;
            win.print();
            $('iframe').remove();
        }); });
</script>
@endsection
