@extends('layouts.main')
@section('title', 'Create Ranking')
@section('content')
    <div class="row">
        <nav aria-label="breadcrumb" style="width: 100%;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href={{ url('profile') }}>Back</a></li>
                <li class="breadcrumb-item active">Построение рейтинга</li>
            </ol>
        </nav>
        <h3 class="font-weight-normal">Выберите тип рейтинга:</h3>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <ul>
                <li><a id="0" onclick="showTabs(0)" class="header-active">Научный рейтинг. Магистратура</a></li>
                <li><a id="1" onclick="showTabs(1)">Научный рейтинг. Аспирантура</a></li>
                <li><a id="2" onclick="showTabs(2)">Текущий рейтинг преподавателя</a></li>
                <li><a id="3" onclick="showTabs(3)">Сортировка по публикациям</a></li>
            </ul>

        </div>

        <div class="col-sm-9">
            <div class="ranking" id="0-content">

                <p>Курс </p>
                <div class="form-group">
                    <select name="year" id="year" class="form-old-select form-control">
                        <option value="" disabled selected>Выберите курс</option>
                        @for($i=1; $i < 5; $i++)
                            <option value="{{$i}}"> {{ $i}} </option>
                        @endfor
                    </select>
                </div>
                <p>Выберите группу</p>
                <div class="form-group">
                        <select id="groups" class="form-old-select form-control input" name="groups_id">
                            <option value="" disabled selected>Выберите группу</option>
                        </select>
                </div>
                {!! Form::open(['url' => ['pdfMaster/2'], 'class'=>'form',  'method' => 'GET']) !!}
                <p>Выберите студента</p>
                <div class="form-group">
                        <select id="students" class="form-old-select form-control input" name="owner_id">
                            <option value="" disabled selected>Выберите студента</option>
                        </select>
                </div>
                <p id="error"></p>
                <br><br>
                {!! Form::submit('Сформировать pdf-отчёт', ['class' => 'btn btn-primary', 'id' => 'btn', 'name' => 'pdf']) !!}
                {!! Form::submit('Сформировать doc-отчёт', ['class' => 'btn btn-primary', 'id' => 'btn-doc', 'name' => 'doc']) !!}


                {!! Form::close() !!}
            </div>

            <div class="ranking" id="1-content" style="display: none">
                <p>Курс</p>
                <div class="form-group">
                    <select name="year" id="year1" class="form-old-select form-control">
                        <option value="" disabled selected>Выберите курс</option>
                        @for($i=1; $i < 5; $i++)
                            <option value="{{$i}}"> {{ $i}} </option>
                        @endfor
                    </select>

                </div>
                <p>Выберите группу</p>
                <div class="form-group">
                    <select id="groups1" class="form-old-select form-control input" name="groups_id">
                        <option value="" disabled selected>Выберите группу</option>
                    </select>
                </div>
                {!! Form::open(['url' => ['pdfMaster/1'], 'class'=>'form',  'method' => 'GET']) !!}

                <p>Выберите студента</p>
                <div class="form-group">
                    <select id="students1" class="form-old-select form-control input" name="owner_id">
                        <option value="" disabled selected>Выберите студента</option>
                    </select>
                </div>
                <p id="error1"></p>
                <br><br>
                {!! Form::submit('Сформировать pdf-отчёт', ['class' => 'btn btn-primary', 'id' => 'btn1', 'name' => 'pdf']) !!}
                {!! Form::submit('Сформировать doc-отчёт', ['class' => 'btn btn-primary', 'id' => 'btn-doc1', 'name' => 'doc']) !!}
                {!! Form::close() !!}
            </div>

            <div class="ranking" id="2-content" style="display: none">
                <p>Выберите преподавателя</p>
                {!! Form::open(['url' => ['pdfMaster/3'], 'class'=>'form',  'method' => 'GET']) !!}
                <p id="error2"></p>

                <table class="table table-sm">
                    <thead>
                    <tr>
                        <th>
                            <input type="text" id="searchOne" placeholder="Поиск по ФИО..." class='form-control form-control-sm'/>
                        </th>
                        <th>
                            Email
                        </th>
                        <th>
                            Добавить
                        </th>
                    </tr>
                    </thead>

                    @php $i=0;
                    $arrUsers = \App\Models\UsersOwners::getProf();
                    @endphp
                    <tbody>
                    @foreach($arrUsers as $user)
                        <tr class="all">
                            <td class="name">{{$user->surname}} {{$user->name}} {{$user->patronymic}}</td>
                            <td class="email">{{$user->email}}</td>
                            <td>
                                <div class="custom-control custom-radio">

                                    {!! Form::radio('owner_id', $user->idUsers, false, ['class' => 'owners custom-control-input', 'id' =>  'customRadio'.$user->idUsers]) !!}
                                    <label class="custom-control-label" for='customRadio{{$user->idUsers}}'></label>
                                </div>
                                </td>
                        </tr>
                        @php
                            $i++;
                        @endphp
                    @endforeach

                    </tbody>
                </table>
                {!! Form::submit('Сформировать pdf-отчёт', ['class' => 'btn btn-primary', 'id' => 'btn2', 'name' => 'pdf']) !!}
                {!! Form::submit('Сформировать doc-отчёт', ['class' => 'btn btn-primary', 'id' => 'btn-doc2', 'name' => 'doc']) !!}
                {!! Form::close() !!}
                <br>

            </div>

            <div class="ranking" id="3-content" style="display: none">
                @include('panel.showRankigs.articlesranking')
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
        $('#year1').on('change', function(e){
            fillFields(e, '#groups1', '{{ url('information') }}/create/ajax-year?year_id', "Выберите группу");
        });

        $('#groups1').on('change', function(e){
            fillFields(e, '#students1', '{{ url('information') }}/create/ajax-group?group_id', "Выберите студента");
        });
    </script>

@endsection