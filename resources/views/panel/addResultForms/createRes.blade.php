@extends('layouts.main')
@section('title', 'Create Result')
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href={{ url('profile') }}>Back</a></li>
            <li class="breadcrumb-item active">Ввод данных рейтинга</li>
        </ol>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @php
            if(Session::has('errorParse')){
               echo "<div class='alert alert-danger' id='mesSuccessAdd'>".Session::get("errorParse")."</div>";
            }

        @endphp
        {!! Form::open(['url' => ['createResult'], 'class'=>'form-inline', 'files'=>'true']) !!}

        {!! Form::label('file', 'Загрузить документ:') !!}
        {!! Form::file('file', null, ['class' => 'form-control']) !!}
        <p id="error"></p>
        <br>
        <label class="form-check-label">
            <input type="checkbox" id="allField" class="form-check-input" name="allField" value="allField">
            Заполнить автоматически
        </label>
        <br> <br>

        {!! Form::label('name', 'Название результата:') !!}

        <input type="text" id="name" class="form-control" name="name" value="{{isset($pdfText) && $searchTitle ? $searchTitle : ''}}">
        <span id="nameT"></span>
        <br> <br>

        {!! Form::label('type', 'Тип:') !!}
        {!! Form::select('type', $arrType,  null, ['class' => 'form-control', 'style' => 'width:100%']) !!}
        <span id="typeT"></span>
        <br> <br>

        {!! Form::label('date', 'Дата:') !!}
        <input type="text" id="date" class="form-control" name="date" value="{{isset($pdfText) && $date[0] ? $date[0] : ''}}">
        <span id="dateT"></span>


        <br> <br>
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
        <br> <br>

        <div id="articleFields">
            {!! Form::label('article', 'Название статьи:') !!}
            {!! Form::text('article', null, ['class' => 'form-control']) !!}
            <br> <br>
            {!! Form::label('publishing', 'Издательство:') !!}
            {!! Form::text('publishing', null, ['class' => 'form-control']) !!}
            <br> <br>
            {!! Form::label('pages', 'Количество страниц:') !!}
            {!! Form::number('pages', null, ['class' => 'form-control']) !!}
            <br> <br>
        </div>

        {!! Form::submit('Save', ['class' => 'btn btn-default', 'id' => 'btn']) !!}

        <a class="btn btn-default btn-close" href="{{ url()->previous() }}">Cancel</a>
        <br><br>

        {!! Form::close() !!}


    </div>
    <script>
        $(document).ready(function() {
        $('#type').change(function () {
            let resType = $(this).find(":selected").val();
            console.log(resType);
            let arrArticles = ['8', '9', '10', '11', '12', '13', '14'];
            console.log(arrArticles);
            console.log(jQuery.inArray(resType, arrArticles));
            if(jQuery.inArray(resType, arrArticles) != -1){
                $('#articleFields').slideDown('slow');
            }
            else
                $('#articleFields').slideUp('slow');

        });

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