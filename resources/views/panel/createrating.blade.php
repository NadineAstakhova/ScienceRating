@extends('layouts.main')
@section('title', 'Create Ranking')
@section('content')
    <div class="row">
        <h3>Выберите тип рейтинга:</h3>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <ul>
                <li><a id="0" onclick="showTabs(0)">Научный рейтинг. Магистратура</a></li>
                <li><a id="1" onclick="showTabs(1)">Научный рейтинг. Аспирантура</a></li>
                <li><a id="2" onclick="showTabs(2)">Сортировка по параметрам</a></li>
            </ul>

        </div>
        <div class="col-sm-8">
            <div class="ranking" id="0-content">
                <p>Выберите группу</p>
                <p>Выберите студента</p>
                <a href="pdfMaster/1/1" class="btn btn-primary"> Сформировать отчёт</a>
            </div>
            <div class="ranking" id="1-content" style="display: none">
                <p>Выберите группу</p>
                <p>Выберите студента</p>
                <a href="pdfMaster/1/2" class="btn btn-primary"> Сформировать отчёт</a>
            </div>
            <div class="ranking" id="2-content" style="display: none">
                sort

            </div>

        </div>
    </div>
    <script>
        function showTabs(id){
            //$(id).slideDown('slow');
            let numItems = $('.ranking').length;
            console.log($('.ranking')[id].id);
            for (let i = 0; i < numItems; i++) {
                if (i == id) {
                    $('#'+id).addClass('header-active');
                    $('#' + i + '-content').slideDown('slow');

                }
                else {
                    $('#' + i + '-content').slideUp('slow');
                    $('#'+i).removeClass('header-active');
                }
            }
        }
    </script>

@endsection