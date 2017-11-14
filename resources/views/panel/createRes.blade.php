@extends('layouts.main')
@section('title', 'Create Result')
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href={{ url()->previous() }}>Back</a></li>
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
        {!! Form::open(['url' => ['createResult'], 'class'=>'form-inline', 'files'=>'true']) !!}

        {!! Form::label('file', 'Загрузить документ:') !!}
        {!! Form::file('file', null, ['class' => 'form-control']) !!}
        <br>
        <label class="form-check-label">
            <input type="checkbox" id="allField" class="form-check-input" name="allField" value="allField">
            Заполнить автоматически
        </label>
        <br> <br>

        {!! Form::label('name', 'Название результата:') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
        <br> <br>

        {!! Form::label('type', 'Тип:') !!}
        {!! Form::select('type', $arrType,  null, ['class' => 'form-control']) !!}
        <br> <br>

        {!! Form::label('date', 'Дата:') !!}
        {!! Form::text('date', null, ['class' => 'form-control']) !!}
        <br> <br>
        @if(isset($pdfText))
            {!! Form::label('pdfText', 'Text:') !!}
            {!! Form::textArea('pdfText', $pdfText, ['class' => 'form-control']) !!}
            <br> <br>
            @if($users != 0)
                @foreach ($users as $user)
                    <li>{{ $user }}</li>
                @endforeach
            @else
                No data
            @endif
            {{$date[0]}}
            {{$searchTitle}}
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

        {!! Form::close() !!}

        <p id="error"></p>
    </div>
    <script>
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
    </script>

@endsection