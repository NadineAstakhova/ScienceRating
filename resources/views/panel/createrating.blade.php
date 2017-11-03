@extends('layouts.main')
@section('title', 'Create Ranking')
@section('content')
    <div class="row">
        <h3>Выберите тип рейтинга:</h3>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <ul>
                <li>Научный рейтинг. Магистратура</li>
                <li>Научный рейтинг. Аспирантура</li>
                <li>Сортировка по параметрам</li>
            </ul>

        </div>
        <div class="col-sm-8">
            Выберите группу
            Выберите студента
            <a href="pdfMaster/2"> Сформировать отчёт</a>

        </div>
    </div>

@endsection