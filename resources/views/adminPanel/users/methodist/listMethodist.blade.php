@extends('layouts.adminMain')
@section('title', trans('messages.list_method'))
@section('header')
    <script src="{{asset('js/message_alert.js')}}"></script>
@endsection
@section('content')
    @if (App\Http\Middleware\LocaleMiddleware::getLocale() == 'ru')
        <script>
            $(document).ready(function (e) {
                messageAlert('.delete_btn', 'Вы уверены, что хотите удалить пользователя?')
            });
        </script>
    @elseif(App\Http\Middleware\LocaleMiddleware::getLocale() == 'uk')
        <script>
            $(document).ready(function (e) {
                messageAlert('.delete_btn', 'Ви впевнені, що хочете видалити користувача?')
            });
        </script>
    @endif
    <div class="app-content content container-fluid">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ trans('messages.methodists')}}</h4>
                            <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="reload"><i class="icon-reload"></i></a></li>
                                    <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body collapse in">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans('messages.login')}}</th>
                                        <th>{{ trans('messages.email')}}</th>
                                        <th>Статус</th>
                                        <th>{{ trans('messages.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($methodists as $user)
                                        <tr>
                                            <th scope="row">{{$user->idUsers}}</th>
                                            <td>{{$user->username}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{\App\User::STATUS[$user->status]}}</td>
                                            <td>
                                               <!-- <a href="{{url("#")}}">
                                                    <i class="icon-pencil3" style="font-size: 20px; color: black"></i>
                                                </a>!-->
                                                <a href="{{url("deleteUser/$user->idUsers")}}" class="delete_btn"
                                                   data-toggle="tooltip" title="{{ trans('messages.delete_user')}}">
                                                    <i class="icon-trash-o" style="font-size: 20px; color: red"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection