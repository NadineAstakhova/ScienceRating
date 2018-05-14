<?php
/**
 * Created by PhpStorm.
 * User: Nadine
 * Date: 27.12.2017
 * Time: 12:48
 */
use App\Models\RankingModels\ScientificResult;
use App\Models\RankingModels\TypeOfRes;
?>
@extends('layouts.main')
@section('title', 'User Results')
@section('content')
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script>
    $(document).ready(function (e) {
        $('.delete_btn').on('click', function () {
            return confirm('Вы уверены, что хотите удалить научный результат для пользователя?');
        });

        init();
        $('[data-toggle="tooltip"]').tooltip();
    });


</script>
<meta name="csrf-token" content="{{ csrf_token() }}" />

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
                <th>
                    Действие
                </th>
            </tr>
            </thead>
            <tbody>
            @php $i=0;
            @endphp
                @foreach($arrEvents as $res)
                    <tr>
                        <td>
                            <a href="{{url("event/$res->idScientEvent")}}">{{$res->titleEvent}}</a>
                        </td>
                        <td>{{$res->type}} </td>
                        <td>{{$res->date}}</td>
                        <td>
                            <div onclick="showInputProviderRes({{$i}})">
                                <span id="result[{{$i}}]" onclick="showInputProviderRes({{$i}})" class="unic-text-percent" data-toggle="tooltip" title="Нажмите, чтобы отредактировать значение">
                                    {{$res->type_of_res}}
                                </span>
                            </div>
                            {!! Form::select('arrResult['.$i.']', TypeOfRes::getResultTypes(),  $res->idTypeRes, ['class' => 'form-old-select form-control display-none',
                                'id' => 'resultInput['.$i.']', 'onBlur' =>"blurInputProviderRes($i,$res->idMember )"]) !!}
                        </td>
                        <td>
                            <div onclick="showInputProviderRole({{$i}})">
                                <span id="role[{{$i}}]" onclick="showInputProviderRole({{$i}})" class="unic-text-percent" data-toggle="tooltip" title="Нажмите, чтобы отредактировать значение">
                                   {{$res->type_of_role}}
                                </span>
                            </div>
                            {!! Form::select('arrRole['.$i.']', TypeOfRes::getRolesTypes(),  $res->idTypeRole, ['class' => 'form-old-select form-control display-none',
                                'id' => 'roleInput['.$i.']', 'onBlur' =>"blurInputProviderRole($i,$res->idMember )"
                                ]) !!}
                        </td>
                        <td>{{$res->file}}</td>
                        <td class = "{{$res->status}}">{{ScientificResult::ARRAY_STATUS[$res->status]}}</td>
                        <td>
                            <img src="{{asset('images/edit.png')}}" alt=""  class="icons update_btn editIconPub"
                                 onclick="showInputProviderRes({{$i}})">

                            <a href="{{url("deleteMemberEvent/$res->idMember")}}">
                                <img src="{{asset('images/delete.png')}}" alt="" class="icons delete_btn"></a>
                        </td>
                        @php
                            $i++;
                        @endphp
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
                    Процент
                </th>
                <th>
                    Из-во
                </th>
                <th>
                    Дата
                </th>
                <th>
                    Кол-во страниц
                </th>


                <th>
                    Файл
                </th>
                <th>
                    Статус
                </th>
                <th>
                    Действие
                </th>
            </tr>
            </thead>

            @php $i=0;
            @endphp
            <tbody>
                @foreach($arrArticles as $article)
                    <tr class="all">
                        <td>
                            <a href="{{url("publication/$article->idPublication")}}">{{$article->title}}</a>
                        </td>
                        <td class="type_pub">{{$article->type}} </td>
                        <td class="percent">
                            <div onclick="showInputProvider({{$i}})" data-toggle="tooltip" title="Нажмите, чтобы отредактировать значение">
                            <span id="percent[{{$i}}]" onclick="showInputProvider({{$i}})" class="unic-text-percent" >{{$article->percent_of_writing}}</span>
                            </div>
                            <input type="number" class='form-control' name="arrPercent[{{$i}}]" id="percentInput[{{$i}}]"
                                       value="{{$article->percent_of_writing}}"
                                       onBlur="blurInputProvider({{$i}}, {{$article->idPubAuthor}})"

                            />
                        </td>
                        <td class="pub">{{$article->edition}} </td>
                        <td class="date">{{$article->date}} </td>
                        <td class="pages">{{$article->pages}} </td>
                        <td class="file">{{$article->file}} </td>
                        <td class = "{{$article->status}}">{{ScientificResult::ARRAY_STATUS[$article->status]}}</td>
                        <td>
                            <img src="{{asset('images/edit.png')}}" alt=""  class="icons update_btn editIconPub"
                                 onclick="showInputProvider({{$i}})">
                            <a href="{{url("deleteAuthorPub/$article->idPubAuthor")}}">
                                <img src="{{asset('images/delete.png')}}" alt="" class="icons delete_btn"></a>
                        </td>
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
                "#print, .breadcrumb, .delete_btn, .update_btn{display: none;}" +
                "table{text-align: left} </style>";
            var html_to_print=printing_css+$('#to_print').html();
            var iframe=$('<iframe id="print_frame">');
            $('body').append(iframe);
            var doc = $('#print_frame')[0].contentDocument || $('#print_frame')[0].contentWindow.document;
            var win = $('#print_frame')[0].contentWindow || $('#print_frame')[0];
            doc.getElementsByTagName('body')[0].innerHTML=html_to_print;
            win.print();
            $('iframe').remove();
        });

    });

    const styleTextElem = "unic-text-percent";
    const styleInputElem = "form-control percentInputArr";

    const setElementVisible = (elId, display) => {
        document.getElementById('percentInput['+ elId +']').className = styleInputElem + ((display) ? " display-block" : " display-none");
        document.getElementById('percent['+ elId +']').className = styleTextElem + ((display) ? " display-none" : " display-block");
    };

    /**
     *
     * @param text format ex. textbala[3]
     * @returns {string} number beetwen [ and ]
     */
    const getNumberFromId = (text) => {
        const n = text.indexOf('[');

        return text.substr(n+1,(text.length - (n + 2)) );
    };

    const showInputProvider = (id) => {
        showInput([{display:true, id:id}]);
        document.getElementById('percentInput['+ id +']').focus();
    };

    const blurInputProvider = (id, idPublication) => {
        showInput([{display:false, id:id}]);
        blurLogic([{idPublication:idPublication, newValue:document.getElementById('percentInput['+ id +']').value}]);
    };

    // state.el = [{id:1, display:true}, {id:2,display:false}]
    const showInput = (state) => {
        state.map(st => setElementVisible(st.id, st.display));
    };

    const blurLogic = (idPublication, newValue) =>{

        $.post('http://sciencerating/public/editPercent', {
            idPublication: idPublication,
            newValue: newValue,
                _token: $('meta[name=csrf-token]').attr('content'),


            }
        )
            .done(function(data) { //meow
                document.getElementById('percentInput['+ 0 +']').innerHTML = data;
                console.log(document.getElementById('percentInput['+ 0 +']'));
            })
            .fail(function( jqXHR, textStatus ) {
                console.log( "Request failed: " + textStatus );
            });

    };

    const init = () => {
        console.log(" Array.of(document.getElementsByClassName(styleTextElem))",
            Array.from(document.getElementsByClassName(styleTextElem))[0]);

        Array.from(document.getElementsByClassName(styleTextElem))
            .forEach(el => setElementVisible(getNumberFromId(el.id),false))
    };

    const showInputProviderRes = (id) => {
        showInputRes([{display:true, id:id}]);
        document.getElementById('resultInput['+ id +']').focus();
    };

    const showInputRes = (state) => {
        state.map(st => setElementResVisible(st.id, st.display));
    };

    const setElementResVisible = (elId, display) => {
        document.getElementById('resultInput['+ elId +']').className = styleInputElem + ((display) ? " display-block" : " display-none");
        document.getElementById('result['+ elId +']').className = styleTextElem + ((display) ? " display-none" : " display-block");
    };

    const blurInputProviderRes= (id, idMember) => {
        showInputRes([{display:false, id:id}]);
        console.log(idMember);
        blurLogicRes([{idMember:idMember, newValue:document.getElementById('resultInput['+ id +']').value}]);
    };
    const blurLogicRes = (idMember, newValue) =>{

        $.post('http://sciencerating/public/editResult', {
                idMember: idMember,
                newValue: newValue,
                _token: $('meta[name=csrf-token]').attr('content'),


            }
        )
            .done(function(data) { //meow
             //   document.getElementById('percentInput['+ 0 +']').innerHTML = data;
               alert("Запись успешно обновлена");
            })
            .fail(function( jqXHR, textStatus ) {
                console.log( "Request failed: " + textStatus );
            });

    };

    const showInputProviderRole = (id) => {
        showInputRole([{display:true, id:id}]);
        document.getElementById('roleInput['+ id +']').focus();
    };

    const showInputRole = (state) => {
        state.map(st => setElementRoleVisible(st.id, st.display));
    };

    const setElementRoleVisible = (elId, display) => {
        document.getElementById('roleInput['+ elId +']').className = styleInputElem + ((display) ? " display-block" : " display-none");
        document.getElementById('role['+ elId +']').className = styleTextElem + ((display) ? " display-none" : " display-block");
    };

    const blurInputProviderRole= (id, idMember) => {
        showInputRole([{display:false, id:id}]);
        console.log(idMember);
        blurLogicRole([{idMember:idMember, newValue:document.getElementById('roleInput['+ id +']').value}]);
    };
    const blurLogicRole = (idMember, newValue) =>{

        $.post('http://sciencerating/public/editRole', {
                idMember: idMember,
                newValue: newValue,
                _token: $('meta[name=csrf-token]').attr('content'),


            }
        )
            .done(function(data) { //meow
                //   document.getElementById('percentInput['+ 0 +']').innerHTML = data;
                alert("Запись успешно обновлена");
            })
            .fail(function( jqXHR, textStatus ) {
                console.log( "Request failed: " + textStatus );
            });

    };



</script>
@endsection
