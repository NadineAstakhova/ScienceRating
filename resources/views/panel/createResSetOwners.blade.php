@extends('layouts.main')
@section('title', 'Add Owners')
@section('content')
    <div class="row">
        <h3>Выберите участника/ов</h3>
        <h4>Можете воспользоваться фильтрами в заголовках таблицы</h4>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>
                        ФИО
                    </th>
                    <th>
                        Роль
                    </th>
                    <th>
                        Участие в результате
                    </th>
                    <th>
                        Добавить
                    </th>
                </tr>
            </thead>
            {!! Form::open(['url' => ['addResultOwner/'.$idResult], 'class'=>'form-inline', 'files'=>'true']) !!}
            @php $i=0; @endphp
            <tbody>
            @foreach($arrUsers as $user)
                <tr>
                    <td>{{$user->surname}} {{$user->name}} {{$user->patronymic}}</td>
                    <td>{{$user->type}}</td>
                    <td>{!! Form::select('arrRole['.$i.']', \App\UsersOwners::ARRAY_ROLES,  null, ['class' => 'form-control']) !!}</td>
                    <td>{!! Form::checkbox('arrOwners['.$i.']', $user->idUsers) !!}</td>
                </tr>
                @php
                    $i++;
                @endphp
            @endforeach

            </tbody>
        </table>
        {!! Form::submit('Save', ['class' => 'btn btn-default', 'id' => 'btn']) !!}

        <a class="btn btn-default btn-close" href="{{ url()->previous() }}">Cancel</a>

        {!! Form::close() !!}
    </div>

@endsection