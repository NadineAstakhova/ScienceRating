<?php
/**
 * Created by PhpStorm.
 * User: Nadine
 * Date: 27.12.2017
 * Time: 12:48
 */
use App\Models\RankingModels\ScientificResult;
?>
@extends('layouts.main')
@section('title', 'User Results')
@section('content')
    <div class="row">
        <nav aria-label="breadcrumb" style="width: 100%;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href={{ url()->previous() }}>Back</a></li>
                <li class="breadcrumb-item active">Научные результаты </li>
            </ol>
        </nav>
    </div>
    <div class="row" id='to_print'>
        <div class="col-xs-6 col-sm-8 col-lg-8">
            <h3>Научные результаты {{$user}} </h3>
        </div>
        <div class="col-xs-8 col-sm-4 col-lg-4" id="listBtn">
            <button class="btn btn-outline-dark" id="print">Печать</button>
        </div>
        <div class="col-xs-6 col-sm-8 col-lg-8">
            <h3>Научные мероприятия </h3>
        </div>
        @if(count($arrEvents) > 0)
        <table class="table table-bordered" style="margin-top: 5px;">
            <thead>
            <tr>
                <th>
                    Название
                </th>
                <th>
                    Тип результата
                </th>
                <th>
                    Дата
                </th>
                <th>
                    Результат
                </th>
                <th>
                    Роль
                </th>
                <th>
                    Файл
                </th>
                <th>
                    Статус
                </th>
            </tr>
            </thead>
            <tbody>
                @foreach($arrEvents as $res)
                    <tr>
                        <td>
                            <a href="{{url("event/$res->idScientEvent")}}">{{$res->titleEvent}}</a>
                        </td>
                        <td>{{$res->type}} </td>
                        <td>{{$res->date}}</td>
                        <td>{{$res->type_of_res}}</td>
                        <td>{{$res->type_of_role}}</td>
                        <td>{{$res->file}}</td>
                        <td class = "{{$res->status}}">{{ScientificResult::ARRAY_STATUS[$res->status]}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <div class="col-xs-6 col-sm-8 col-lg-8">
                Нет результатов
            </div>
        @endif
        <div class="col-xs-6 col-sm-8 col-lg-8">
            <h3>Научные публикации </h3>
        </div>

        @if(count($arrArticles) > 0)
        <table class="table table-bordered" style="margin-top: 5px;">
            <thead>
            <tr>
                <th>
                    Название
                </th>
                <th>
                    Тип
                </th>
                <th>
                    Издательство
                </th>
                <th>
                    Дата
                </th>
                <th>
                    Кол-во страниц
                </th>
                <th>
                    Процент
                </th>

                <th>
                    Файл
                </th>
                <th>
                    Статус
                </th>
            </tr>
            </thead>

            @php $i=0;
            @endphp
            <tbody>
                @foreach($arrArticles as $article)
                    <tr class="all">
                        <td class="name">{{$article->title}} </td>
                        <td class="type_pub">{{$article->type}} </td>
                        <td class="pub">{{$article->edition}} </td>
                        <td class="date">{{$article->date}} </td>
                        <td class="pages">{{$article->pages}} </td>
                        <td class="percent">{{$article->percent_of_writing}} </td>
                        <td class="file">{{$article->file}} </td>
                        <td class = "{{$res->status}}">{{ScientificResult::ARRAY_STATUS[$res->status]}}</td>
                    </tr>
                    @php
                        $i++;
                    @endphp
                @endforeach
            </tbody>
        </table>
        @else
            <div class="col-xs-6 col-sm-8 col-lg-8">
                 Нет публикаций
            </div>
        @endif
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
