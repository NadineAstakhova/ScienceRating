@extends('layouts.main')
@section('title', 'Add Owners')

@section('content')

    <script>
            //TODO move to js file
            const isValidateTrue = () => {
                let whoUse = [];

                const sum =
                Array.from(document.getElementsByClassName("unic-check"))
                    .filter(che => che.checked)
                    .map(che => {whoUse.push(che.id.replace("arrOwners[","arrRole[")); return che;})
                    .reduce((a,b) => a +
                                     Number.parseInt(
                                        document.getElementById("arrRole["+b.id.replace("arrOwners[","").replace("]","")+"]").value)
                          ,0);


                return { whoUse:whoUse, valid: sum === 100 }
            };


            const getState = () => {

                const validTrueClassName = "form-control unic-input valid-true";
                const validFalseClassName = "form-control unic-input valid-false";
                const validRes = isValidateTrue();

                console.log(validRes.whoUse.length);

                if(validRes.valid === false && validRes.whoUse.length > 0){
                    $('.btn-submit').prop('disabled', true);
                    $("#error").html("Сумма процентов написания должна быть равна 100");

                }
                else{
                    $('.btn-submit').prop('disabled', false);
                    $("#error").html("");
                }

                Array.from(document.getElementsByClassName("unic-input"))
                    .map(el =>
                                validRes.whoUse.includes(el.id)
                                 ? (validRes.valid)
                                    ? el.className = validTrueClassName
                                    : el.className = validFalseClassName
                                 : el.className = validTrueClassName
                    )
            };

            $(document).ready(()=> getState());

    </script>
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


        <h3 class="font-weight-normal">Выберите участника/ов</h3>
        <h4 class="font-weight-normal">Можете воспользоваться фильтрами в заголовках таблицы</h4>

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


        {!! Form::submit('Save', ['class' => 'btn btn-outline-success btn-submit', 'id' => 'btn']) !!}

        <a class="btn btn-outline-secondary btn-close" href="{{ url()->to('profile') }}">Cancel</a>
        <br> <br>
            <p id="error"></p>
        <table class="table table-sm" id="ownerTable">
            <thead>
                <tr>
                    <th>
                        <input type="text" id="search" placeholder="Поиск по ФИО..." class='form-control'/>
                    </th>
                    <th>
                        <select id="selectFilter" class='form-control'>
                            <option id="all">Все пользователи</option>
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
                            Процент написания
                        </th>
                    @endif

                    <th>
                        Добавить
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
        {!! Form::submit('Save', ['class' => 'btn btn-outline-success btn-submit', 'id' => 'btn']) !!}

        <a class="btn btn-outline-secondary btn-close" id="j">Cancel</a>

        {!! Form::close() !!}
        <br>
    </div>


@endsection