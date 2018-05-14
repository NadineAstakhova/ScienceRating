<?php
/**
 * Created by PhpStorm.
 * User: astakhova.n
 * Date: 5/3/2018
 * Time: 10:26 PM
 */
use App\Models\RankingModels\TypeOfRes;
?>
@extends('layouts.main')
@section('title', 'Create Event')

@section('content')
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
                <li class="breadcrumb-item active">Ввод данных научного результата</li>
            </ol>
        </nav>

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif
        @php
            if(Session::has('errorParse')){
               echo "<div class='alert alert-danger' id='mesSuccessAdd'>".Session::get("errorParse")."</div>";
            }

        @endphp
        @if(Auth::user()->type == '3')
        <div class="alert alert-info" role="alert">
            Если документ общий для всех участников выберите "Использовать для всех", если нет,
            то на следующей странице вы можете для каждого участника загрузить свой файл.
            <br>Если хотите воспользоваться функцией автоматического распознавания, то "Использовать для всех" выберите на следующем этапе.
        </div>
        @endif

        @if(!isset($idUser))
            {!! Form::open(['url' => ['createEventForm'], 'class'=>'form', 'files'=>'true']) !!}
        @else
            {!! Form::open(['url' => ['createEventForm/'.$idUser], 'class'=>'form', 'files'=>'true']) !!}
        @endif



        {!! Form::label('file', 'Загрузить документ:') !!}
        {!! Form::file('file', null, ['class' => 'form-control']) !!}
        <p id="error"></p>
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="allField" name="allField" value="allField">
            <label class="custom-control-label" for="allField">Заполнить автоматически</label>
        </div>
        @if(Auth::user()->type == '3')
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="forAllUser" name="forAllUser" value="forAllUser">
                <label class="custom-control-label" for="forAllUser">Использовать для всех</label>
            </div>
        @endif

        <br>
        {!! Form::label('name', 'Название результата (мероприятия/события):') !!}

        <input type="text" id="name" class="form-control" name="name" value="{{isset($pdfText) && $searchTitle ? $searchTitle : ''}}">
        <span id="nameT"></span>
        <br>

        {!! Form::label('type', 'Тип:') !!}
        {!! Form::select('type', $arrType,  null, ['class' => 'form-control form-control-md', 'style' => 'max-width:100%']) !!}
        <span id="typeT"></span>

        <br>
        <div class="form-group row">
            {!! Form::label('date', 'Дата:', array('class' => 'col-sm-2 col-form-label')) !!}
            <div class="col-sm-3">
                <input type="text" id="date" class="form-control" name="date" value="{{isset($pdfText) && $date[0] ? $date[0] : ''}}">
            </div>
            <span id="dateT" class="col-sm-10"></span>
        </div>
        <br>
        @if(isset($pdfText))
            {!! Form::label('pdfText', 'Содержание файла:') !!}
            {!! Form::textArea('pdfText', $pdfText, ['class' => 'form-control', 'style' => 'width:100%']) !!}
            <br> <br>
            <div class="alert alert-info" role="alert">
                <p>Удалось определить таких студентов/преподавателей. На следующей странице вы можете изменить эту информацию</p>
                @if($users != 0)
                    @php $i=0; @endphp
                    @foreach ($users as $user)
                        <li>{{ $user['surname'] }}</li>
                        {{ Form::hidden('owners['.$i.']', $user['id']) }}
                        @php $i++; @endphp
                    @endforeach
                @else
                    Совпадений не найдено.
                @endif
            </div>
        @endif

        @if(isset($idUser))
            <div class="form-group row">
                {!! Form::label('result', 'Результат:', array('class' => 'col-sm-2 col-form-label')) !!}
                <div class="col-sm-3">
                    {!! Form::select('result', TypeOfRes::getResultTypes(),  null, ['class' => 'form-old-select form-control']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('role', 'Роль:', array('class' => 'col-sm-2 col-form-label')) !!}
                <div class="col-sm-3">
                   {!! Form::select('role',  TypeOfRes::getRolesTypes(),  null, ['class' => 'form-old-select form-control']) !!}
                </div>
            </div>


        @endif


        {!! Form::submit('Save', ['class' => 'btn btn-outline-success', 'id' => 'btn']) !!}

        <a class="btn btn-outline-secondary btn-close" href="{{ url()->previous() }}">Cancel</a>
        <br><br>

        {!! Form::close() !!}


    </div>
    <script>
        $(document).ready(function() {
            $('#allField').change(
                function(){
                    if ($(this).is(':checked')) {
                        $("#nameT").html("Поле будет заполнено автоматически");
                        $("#dateT").html("Поле будет заполнено автоматически");
                        $("#typeT").html("Поле нужно будет заполнить самостоятельно");
                        $("#name").css("border-color", "#3A5FCD");
                        $("#date").css("border-color", "#3A5FCD");

                    }
                    else {
                        $("#nameT").html("");
                        $("#dateT").html("");
                        $("#typeT").html("");
                        $("#name").css("border-color", "#ccc");
                        $("#date").css("border-color", "#ccc");
                    }
                });

            $("#date").keyup(function () {
                let reg = /^(\d{1,2})?-?(\d{1,2})?-?(\d{2,4})?$/;
                //checking if these strings are dates
                let m = $("#date").val().match(reg);


                if (m === null)
                    $("#dateT").html("Заполните поле в соответствии с шаблоном и без букв: 12-12-12, 11-10-2012, 2012").
                    css("color", "red");
                else
                    $("#dateT").html("");
            });



            $('#btn').bind("click",function()
            {
                let imgVal = $('#file').val();
                if(imgVal=='')
                {
                    $("#error").html("Загрузите файл");

                    return false;
                }

            });
        });

    </script>

@endsection
