@extends('layouts.main')
@section('title', 'Create Ranking')
@section('header')
    <script src="{{asset('js/showModalWindow.js')}}"></script>
@endsection
@section('content')
    <div class="row">
        <nav aria-label="breadcrumb" style="width: 100%;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href={{ url(App\Http\Middleware\LocaleMiddleware::getLocale().'/profile') }}>{{ trans('messages.main')}}</a></li>
                <li class="breadcrumb-item active">{{ trans('messages.title_rank')}}</li>
            </ol>
        </nav>
        <h3 class="font-weight-normal">{{ trans('messages.choose_rank')}}:</h3>
    </div>
    <div class="row">
        <p class="font-weight-normal">{{ trans('messages.rank_msg')}}</p>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <ul>
                <li><a id="0" onclick="showTabs(0)" class="header-active">{{ trans('messages.rank_mag')}}</a></li>
                <li><a id="1" onclick="showTabs(1)">{{ trans('messages.rank_asp')}}</a></li>
                <li><a id="2" onclick="showTabs(2)">{{ trans('messages.rank_prof')}}</a></li>
                <li><a id="3" onclick="showTabs(3)">{{ trans('messages.sort_pub')}}</a></li>
            </ul>

        </div>

        <div class="col-sm-9">
            <div class="ranking" id="0-content">

                <p>{{ trans('messages.course')}} </p>
                <div class="form-group">
                    <select name="year" id="year" class="form-old-select form-control">
                        <option value="" disabled selected>{{ trans('messages.choose_course')}}</option>
                        @for($i=1; $i < 5; $i++)
                            <option value="{{$i}}"> {{ $i}} </option>
                        @endfor
                    </select>
                </div>
                <p>{{ trans('messages.choose_group')}}</p>
                <div class="form-group">
                        <select id="groups" class="form-old-select form-control input" name="groups_id">
                            <option value="" disabled selected>{{ trans('messages.choose_group')}}</option>
                        </select>
                </div>
                {!! Form::open(['url' => ['pdfMaster/2'], 'class'=>'form',  'method' => 'GET']) !!}
                <p>{{ trans('messages.choose_student')}}</p>
                <div class="form-group">
                        <select id="students" class="form-old-select form-control input" name="owner_id">
                            <option value="" disabled selected>{{ trans('messages.choose_student')}}</option>
                        </select>
                </div>
                <p id="error"></p>
                <br><br>
                {!! Form::submit(trans('messages.pdf_doc'), ['class' => 'btn btn-primary', 'id' => 'btn', 'name' => 'pdf']) !!}
                {!! Form::submit(trans('messages.doc_doc'), ['class' => 'btn btn-primary', 'id' => 'btn-doc', 'name' => 'doc']) !!}


                {!! Form::close() !!}
            </div>

            <div class="ranking" id="1-content" style="display: none">
                <p>{{ trans('messages.course')}}</p>
                <div class="form-group">
                    <select name="year" id="year1" class="form-old-select form-control">
                        <option value="" disabled selected>{{ trans('messages.choose_course')}}</option>
                        @for($i=1; $i < 5; $i++)
                            <option value="{{$i}}"> {{ $i}} </option>
                        @endfor
                    </select>

                </div>
                <p>{{ trans('messages.choose_group')}}</p>
                <div class="form-group">
                    <select id="groups1" class="form-old-select form-control input" name="groups_id">
                        <option value="" disabled selected>{{ trans('messages.choose_group')}}</option>
                    </select>
                </div>
                {!! Form::open(['url' => ['pdfMaster/1'], 'class'=>'form',  'method' => 'GET', 'target'=>"_blank"]) !!}

                <p>{{ trans('messages.choose_student')}}</p>
                <div class="form-group">
                    <select id="students1" class="form-old-select form-control input" name="owner_id">
                        <option value="" disabled selected>{{ trans('messages.choose_student')}}</option>
                    </select>
                </div>
                <p id="error1"></p>
                <br><br>
                {!! Form::submit(trans('messages.pdf_doc'), ['class' => 'btn btn-primary', 'id' => 'btn1', 'name' => 'pdf']) !!}
                {!! Form::submit(trans('messages.doc_doc'), ['class' => 'btn btn-primary', 'id' => 'btn-doc1', 'name' => 'doc']) !!}
                {!! Form::close() !!}
            </div>

            <div class="ranking" id="2-content" style="display: none">
                <p>{{ trans('messages.choose_prof')}}</p>
                {!! Form::open(['url' => ['pdfMaster/3'], 'class'=>'form',  'method' => 'GET', 'target'=>"_blank"]) !!}
                <p id="error2"></p>

                <table class="table table-sm">
                    <thead>
                    <tr>
                        <th>
                            <input type="text" id="searchOne" placeholder="{{ trans('messages.search_by_name')}}..." class='form-control form-control-sm'/>
                        </th>
                        <th>
                            Email
                        </th>
                        <th>
                            {{ trans('messages.add')}}
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
                {!! Form::submit(trans('messages.pdf_doc'), ['class' => 'btn btn-primary', 'id' => 'btn2', 'name' => 'pdf']) !!}
                {!! Form::submit(trans('messages.doc_doc'), ['class' => 'btn btn-primary', 'id' => 'btn-doc2', 'name' => 'doc']) !!}
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
            fillFields(e, '#groups', '{{ url('information') }}/create/ajax-year?year_id', "{{ trans('messages.choose_group_list')}}");
        });

        $('#groups').on('change', function(e){
            fillFields(e, '#students', '{{ url('information') }}/create/ajax-group?group_id', "{{ trans('messages.choose_student_list')}}");
        });
        $('#year1').on('change', function(e){
            fillFields(e, '#groups1', '{{ url('information') }}/create/ajax-year?year_id', "{{ trans('messages.choose_group_list')}}");
        });

        $('#groups1').on('change', function(e){
            fillFields(e, '#students1', '{{ url('information') }}/create/ajax-group?group_id', "{{ trans('messages.choose_student_list')}}");
        });
    </script>

@endsection