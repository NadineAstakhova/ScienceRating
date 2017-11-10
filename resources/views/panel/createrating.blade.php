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
                <p>Курс                </p>
                <div class="form-group">
                    <select name="year" id="year" class="form-control">
                        <option value="" disabled selected>Выберите курс</option>

                        @for($i=1; $i < 5; $i++)
                            <option value="{{$i}}"> {{ $i}} </option>
                        @endfor
                    </select>

                </div>
                <p>Выберите группу</p>
                <div class="form-group">
                        <select id="groups" class="form-control input" name="groups_id">
                            <option value="" disabled selected>Выберите группу</option>
                        </select>
                </div>

                <p>Выберите студента</p>
                <div class="form-group">
                        <select id="students" class="form-control input" name="students_id">
                            <option value="" disabled selected>Выберите студента</option>
                        </select>
                </div>

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


        $('#year').on('change', function(e){
            fillFields(e, '#groups', '{{ url('information') }}/create/ajax-year?year_id', "Выберите группу");
        });

        $('#groups').on('change', function(e){
            fillFields(e, '#students', '{{ url('information') }}/create/ajax-group?group_id', "Выберите студента");
        });
    </script>

@endsection