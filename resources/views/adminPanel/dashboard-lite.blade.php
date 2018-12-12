@extends('layouts.adminMain')
@section('title', trans('messages.main'))
@section('content')
    <div class="app-content content container-fluid">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body"><!-- stats -->
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-xs-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-block">
                                    <div class="media">
                                        <div class="media-body text-xs-left">
                                            <h3 class="pink">{{$new_student}}</h3>
                                            <span>{{ trans('messages.new_student')}}</span>
                                        </div>
                                        <div class="media-right media-middle">
                                            <i class="icon-user1 pink font-large-2 float-xs-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-xs-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-block">
                                    <div class="media">
                                        <div class="media-body text-xs-left">
                                            <h3 class="teal">{{$groups}}</h3>
                                            <span>{{ trans('messages.groups')}}</span>
                                        </div>
                                        <div class="media-right media-middle">
                                            <i class="icon-users2 teal font-large-2 float-xs-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-xs-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-block">
                                    <div class="media">
                                        <div class="media-body text-xs-left">
                                            <h3 class="deep-orange">{{$subjects}}</h3>
                                            <span>{{ trans('messages.new_sub')}}</span>
                                        </div>
                                        <div class="media-right media-middle">
                                            <i class="icon-bag2 deep-orange font-large-2 float-xs-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-xs-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-block">
                                    <div class="media">
                                        <div class="media-body text-xs-left">
                                            <h3 class="cyan">{{$rankings}}</h3>
                                            <span>{{ trans('messages.rankings')}}</span>
                                        </div>
                                        <div class="media-right media-middle">
                                            <i class="icon-diagram cyan font-large-2 float-xs-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ project charts -->
                <!-- Recent invoice with Statistics -->
                <div class="row match-height">
                    <div class="col-xl-4 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <div class="p-2 text-xs-center  bg-gradient-directional-blue media-left media-middle">
                                        <i class="icon-user1 font-large-2 white"></i>
                                    </div>
                                    <div class="p-2 media-body">
                                        <h5>{{ trans('messages.unconf_users')}}</h5>
                                        <h5 class="text-bold-400">{{$unconfirm_users}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <div class="p-2 media-body text-xs-left">
                                        <h5>{{ trans('messages.new_pub')}}</h5>
                                        <h5 class="text-bold-400">{{$new_pub}}</h5>
                                    </div>
                                    <div class="p-2 text-xs-center bg-gradient-directional-purple media-right media-middle">
                                        <i class="icon-ios-book-outline white font-large-2 float-xs-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <div class="p-2 text-xs-center bg-gradient-directional-blue media-left media-middle">
                                        <i class="icon-ios-glasses-outline font-large-2 white"></i>
                                    </div>
                                    <div class="p-2 media-body">
                                        <h5>{{ trans('messages.new_res')}}</h5>
                                        <h5 class="text-bold-400">{{$new_event}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-12">
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
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ trans('messages.login')}}</th>
                                            <th>{{ trans('messages.email')}}</th>
                                            <th>Статус</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($methodists as $user)
                                        <tr>
                                            <td class="text-truncate">{{$user->idUsers}}</td>
                                            <td class="text-truncate">{{$user->username}}</td>
                                            <td class="text-truncate">{{$user->email}}</td>
                                            <td class="text-truncate">{{\App\User::STATUS[$user->status]}}</td>
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
    </div>
@endsection
