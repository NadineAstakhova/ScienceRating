<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 04/05/2018
 * Time: 16:12
 */
?>
@extends('layouts.main')
@section('title', 'New User Results')
@section('content')
    <div class="row">
        <nav aria-label="breadcrumb" style="width: 100%;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href={{ url(App\Http\Middleware\LocaleMiddleware::getLocale().'/profile')}}>Главная</a></li>
                <li class="breadcrumb-item active">Подтверждение научных результатов </li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-xs-6 col-sm-8 col-lg-8">
            <h3>Новые научные мероприятия </h3>
        </div>
        {!! Form::open(['url' => ['changeStatusForNewRes'], 'class'=>'form',  'style' => 'width:100%']) !!}
        @if(count($arrNewEvents) > 0)
            {!! Form::submit('Save', ['class' => 'btn btn-outline-success', 'id' => 'btn-top']) !!}
            <a class="btn btn-outline-secondary btn-close" id="j">Cancel</a>
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
                        Участник
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
                        Изменить статус
                    </th>
                </tr>
                </thead>
                <tbody>
                @php $i=0; @endphp
                @foreach($arrNewEvents as $res)
                    <tr>
                        <td>{{$res->titleEvent}}</td>
                        <td>{{$res->type}} </td>
                        <td class="user_pub">{{$res->student_surname}} {{$res->student_name}}
                            {{$res->professor_surname}}  {{$res->professor_name}}</td>
                        <td>{{$res->date}}</td>
                        <td>{{$res->type_of_res}}</td>
                        <td>{{$res->type_of_role}}</td>
                        <td>{{$res->file}}</td>
                        <td>
                            {!! Form::select('arrStatusRes['.$i.']',
                            \App\Models\RankingModels\ScientificResult::ARRAY_STATUS,  null, ['class' => 'form-old-select form-control']) !!}
                        </td>
                        {{ Form::hidden('arrResults['.$i.']', $res->idMember) }}
                    </tr>
                    @php
                        $i++;
                    @endphp
                @endforeach
                </tbody>
            </table>

        @else
            <div class="col-xs-6 col-sm-8 col-lg-8">
                Нет новых результатов
            </div>
        @endif
        <div class="col-xs-6 col-sm-8 col-lg-8">
            <h3>Новые научные публикации </h3>
        </div>

        @if(count($arrNewPublications) > 0)
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
                        Автор
                    </th>
                    <th>
                        Изд-во
                    </th>
                    <th>
                        Дата
                    </th>
                    <th>
                        Кол-во стр
                    </th>
                    <th>
                        %
                    </th>

                    <th>
                        Файл
                    </th>
                    <th>
                        Изменить статус
                    </th>
                </tr>
                </thead>

                @php $j=0;
                @endphp
                <tbody>
                @foreach($arrNewPublications as $article)
                    <tr class="all">
                        <td class="name">{{$article->title}} </td>
                        <td class="type_pub">{{$article->type}} </td>
                        <td class="user_pub">{{$article->student_surname}} {{$article->student_name}}
                            {{$article->professor_surname}}  {{$article->professor_name}}</td>
                        <td class="pub">{{$article->edition}} </td>
                        <td class="date">{{$article->date}} </td>
                        <td class="pages">{{$article->pages}} </td>
                        <td class="percent">{{$article->percent_of_writing}} </td>
                        <td class="file">{{$article->file}} </td>
                        <td class="status">
                            {!! Form::select('arrStatusPub['.$j.']',
                            \App\Models\RankingModels\ScientificResult::ARRAY_STATUS,  null, ['class' => 'form-old-select form-control']) !!}
                        </td>
                        {{ Form::hidden('arrPublications['.$j.']', $article->idPubAuthor) }}
                    </tr>
                    @php
                        $j++;
                    @endphp
                @endforeach
                </tbody>
            </table>
            {!! Form::submit('Save', ['class' => 'btn btn-outline-success', 'id' => 'btn']) !!}
            <a class="btn btn-outline-secondary btn-close" id="j">Cancel</a>
        @else
            <div class="col-xs-6 col-sm-8 col-lg-8">
                Нет новых публикаций
            </div>
        @endif
        {!! Form::close() !!}
    </div>

@endsection

