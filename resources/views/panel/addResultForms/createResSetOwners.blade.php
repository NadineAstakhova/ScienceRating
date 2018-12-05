@extends('layouts.main')
@section('title', 'Add Owners')
@section('header')
    <script src="{{asset('js/validateOwners.js')}}"></script>
@endsection
@section('content')
    <div class="row">

        @if(strpos($_SERVER['REQUEST_URI'], 'editEventMembers') !== false)
            {!! Form::open(['url' => ['editEventMembersForm/'.$idResult], 'class'=>'form', 'files'=>'true', 'style' => 'width:100%']) !!}
        @elseif(strpos($_SERVER['REQUEST_URI'], 'editAuthorMembers') !== false)
                {!! Form::open(['url' => ['editAuthorMembersForm/'.$idResult], 'class'=>'form', 'files'=>'true', 'style' => 'width:100%']) !!}
        @elseif(isset($arrRoles))
            {!! Form::open(['url' => ['addEventMembers/'.$idResult], 'class'=>'form', 'files'=>'true', 'style' => 'width:100%']) !!}
        @else
            {!! Form::open(['url' => ['addPublicationAuthor/'.$idResult], 'class'=>'form', 'files'=>'true', 'style' => 'width:100%']) !!}
        @endif


        <h3 class="font-weight-normal">{{ trans('messages.choose_participants')}}</h3>
        <h4 class="font-weight-normal">{{ trans('messages.choose_participants_msg')}}</h4>
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
                if(Session::has('fileNameAll')){
                   echo "<div class='alert alert-danger' id='mesSuccessAdd'>".Session::get("fileNameAll")."</div>";
                }

            @endphp

            @php
                if(Session::has('errorParse')){
                   echo "<div class='alert alert-danger' id='mesSuccessAdd'>".Session::get("errorParse")."</div>";
                }
            @endphp


        {!! Form::submit( trans('messages.save'), ['class' => 'btn btn-outline-success btn-submit', 'id' => 'btn']) !!}

        <a class="btn btn-outline-secondary btn-close" href="{{ url()->to(App\Http\Middleware\LocaleMiddleware::getLocale().'/profile') }}">{{ trans('messages.cancel')}}</a>
        <br> <br>
            <p id="error"></p>
        <table class="table table-sm" id="ownerTable">
            <thead>
                <tr>
                    <th>
                        <input type="text" id="search" placeholder="{{ trans('messages.search_by_name')}}..." class='form-control'/>
                    </th>
                    <th>
                        <select id="selectFilter" class='form-control'>
                            <option id="all">{{ trans('messages.all_users')}}</option>
                            <option id="student">Student</option>
                            <option id="professor">Professor</option>
                        </select>
                    </th>
                    <th>
                        Email
                    </th>
                    @if(isset($arrRoles))
                        <th>
                            Результат
                        </th>
                        <th>
                            Роль
                        </th>
                        @if(!Session::has('fileNameAll'))
                            <th>
                                Файл
                            </th>
                        @endif
                    @else
                        <th>
                            {{ trans('messages.percent_writing')}}
                        </th>
                    @endif

                    <th>
                        {{ trans('messages.add')}}
                    </th>
                </tr>
            </thead>
            @php
                if(Session::has('owners')){
                   $arr = Session::get("owners");
                }

            @endphp
            @php $i=0; @endphp
            <tbody>
            @foreach($arrUsers as $user)

                <tr class="all">
                    <td class="name">{{$user->surname}} {{$user->name}} {{$user->patronymic}}</td>
                    <td class="type">{{$user->type}}</td>
                    <td class="email">{{$user->email}}</td>
                    @if(isset($arrRoles))
                        <td>
                            {!! Form::select('arrResults['.$i.']', $arrResults,  null, ['class' => 'form-old-select form-control']) !!}
                        </td>
                        <td>
                            {!! Form::select('arrRole['.$i.']', $arrRoles,  null, ['class' => 'form-old-select form-control']) !!}
                        </td>
                        @if(!Session::has('fileNameAll'))
                            <td>
                                {!! Form::file('arrFiles['.$i.']', null, ['class' => 'form-control']) !!}
                            </td>

                        @endif

                        <td >
                            {!! Form::checkbox('arrOwners['.$i.']', $user->idUsers, Session::has('owners') && in_array($user->idUsers, $arr) ?
                        true : false, ['id' => 'arrOwners['.$i.']']) !!}
                        </td>

                    @else
                        <td>
                            {!! Form::number('arrRole['.$i.']', '100', ['class' => 'form-control unic-input', 'onKeyUp'=>'getState()', 'onChange'=>'getState()', 'id' => 'arrRole['.$i.']', 'min'=>1,'max'=>100]) !!}
                        </td>
                        <td >
                            {!! Form::checkbox('arrOwners['.$i.']', $user->idUsers, Session::has('owners') && in_array($user->idUsers, $arr) ?
                        true : false, ['id' => 'arrOwners['.$i.']', 'onClick'=>'getState()', 'class' => 'unic-check']) !!}
                        </td>
                    @endif

                </tr>
                @php
                    $i++;
                @endphp
            @endforeach

            </tbody>
        </table>
        {!! Form::submit( trans('messages.save'), ['class' => 'btn btn-outline-success btn-submit', 'id' => 'btn']) !!}

        <a class="btn btn-outline-secondary btn-close" id="j">{{ trans('messages.cancel')}}</a>

        {!! Form::close() !!}
        <br>
    </div>


@endsection