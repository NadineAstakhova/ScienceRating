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

<script>
    $(document).ready(function (e) {

        $('.delete_btn').on('click', function () {
            return confirm('Вы уверены, что хотите удалить научный результат для пользователя?');
        });

        init();

    });


</script>
<meta name="csrf-token" content="{{ csrf_token() }}" />

    <div class="row">
        <nav aria-label="breadcrumb" style="width: 100%;">
            <ol class="breadcrumb">
                @if(Auth::user()->type == '1')
                    <li class="breadcrumb-item"><a href={{ url('professorProfile') }}>Back</a></li>
                @elseif(Auth::user()->type == '2')
                    <li class="breadcrumb-item"><a href={{ url('studentProfile') }}>Back</a></li>
                @elseif(Auth::user()->type == '3')
                    <li class="breadcrumb-item"><a href={{ url('profile') }}>Back</a></li>
                @endif
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
                <th class="no-print">
                    Файл
                </th>
                <th>
                    Статус
                </th>
                <th class="no-print">
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
                        <td class="no-print">{{$res->file}}</td>
                        <td class = "{{$res->status}}">{{ScientificResult::ARRAY_STATUS[$res->status]}}</td>
                        <td class="no-print">
                            <img src="{{asset('images/edit.png')}}" alt=""  class="icons update_btn editIconPub"
                                 onclick="showInputProviderRes({{$i}})">
                            @if(Auth::user()->type == '3')
                                <a href="{{url("deleteMemberEvent/$res->idMember")}}">
                                    <img src="{{asset('images/delete.png')}}" alt="" class="icons delete_btn"></a>
                            @endif
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
                    Кол-во стр
                </th>


                <th class="no-print">
                    Файл
                </th>
                <th>
                    Статус
                </th>
                <th class="no-print">
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

                                   onkeydown="if (event.keyCode ==13) blurInputProvider({{$i}}, {{$article->idPubAuthor}})"

                            />
                        </td>
                        <td class="pub">{{$article->edition}} </td>
                        <td class="date">{{$article->date}} </td>
                        <td class="pages">{{$article->pages}} </td>
                        <td class="file no-print">{{$article->file}} </td>
                        <td class = "{{$article->status}}">{{ScientificResult::ARRAY_STATUS[$article->status]}}</td>
                        <td class="no-print">
                            <img src="{{asset('images/edit.png')}}" alt=""  class="icons update_btn editIconPub"
                                 onclick="showInputProvider({{$i}})">
                            @if(Auth::user()->type == '3')
                                <a href="{{url("deleteAuthorPub/$article->idPubAuthor")}}">
                                    <img src="{{asset('images/delete.png')}}" alt="" class="icons delete_btn"></a>
                            @endif
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
                "#print, .breadcrumb, .delete_btn, .update_btn, .form-control, .no-print{display: none;}" +
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
        // const elInput = document.getElementById('percentInput['+ elId +']');
        // const elText = document.getElementById('percentInput['+ elId +']');

        document.getElementById('percentInput['+ elId +']').className = styleInputElem + ((display) ? " display-block" : " display-none");
        document.getElementById('percent['+ elId +']').className = styleTextElem + ((display) ? " display-none" : " display-block");
    };

    /**
     *
     * @param text format ex. textbala[3]
     * @returns {string} number beetwen [ and ]
     */
    const getNumberFromId = (text) => {
        console.log("text",text);
        const n = text.indexOf('[');

        return text.substr(n+1,(text.length - (n + 2)) );
    };

    const showInputProvider = (id) => {
        showInput([{display:true, id:id}]);
        document.getElementById('percentInput['+ id +']').focus();
    };

    const blurInputProvider = (id, idPublication) => {
        showInput([{display:false, id:id}]);
        blurLogic({idPublication:idPublication,  id:id, newValue:document.getElementById('percentInput['+ id +']').value});
    };

    // state.el = [{id:1, display:true}, {id:2,display:false}]
    const showInput = (state) => {
        state.map(st => setElementVisible(st.id, st.display));
    };

    const setValue = (id, newVal, field, fieldInput) => {
        console.log(fieldInput);
        document.getElementById(fieldInput+'['+ id +']').value = newVal;
        document.getElementById(field+'['+ id +']').innerHTML = newVal;
    };

    const blurLogic = (obj) =>{

        $.post('http://sciencerating/public/editPercent', {
            idPublication: obj.idPublication,
            newValue: obj.newValue,
                _token: $('meta[name=csrf-token]').attr('content'),


            }
        )
            .done(function(data) { //meow
                setValue(obj.id, data, 'percent',  'percentInput');
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
        let e = document.getElementById('resultInput['+ id +']');
        blurLogicRes({idMember:idMember, newValue:e.value,  id:id, text: e.options[e.selectedIndex].text});
    };
    const blurLogicRes = (obj) =>{

        $.post('http://sciencerating/public/editResult', {
                idMember: obj.idMember,
                newValue: obj.newValue,
                _token: $('meta[name=csrf-token]').attr('content'),


            }
        )
            .done(function(data) { //meow
             //   document.getElementById('percentInput['+ 0 +']').innerHTML = data;
                setValue(obj.id, obj.text,  'result', 'resultInput');
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
        let e = document.getElementById('roleInput['+ id +']');
        blurLogicRole({idMember:idMember, newValue:e.value, id:id,
            text: e.options[e.selectedIndex].text});
    };
    const blurLogicRole = (obj) =>{

        $.post('http://sciencerating/public/editRole', {
                idMember: obj.idMember,
                newValue: obj.newValue,
                _token: $('meta[name=csrf-token]').attr('content'),
            }
        )
            .done(function(data) { //meow
                //   document.getElementById('percentInput['+ 0 +']').innerHTML = data;
                setValue(obj.id, obj.text, 'role',  'roleInput');
            })
            .fail(function( jqXHR, textStatus ) {
                console.log( "Request failed: " + textStatus );
            });

    };



</script>
@endsection
