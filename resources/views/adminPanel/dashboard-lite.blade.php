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
                                            <h3 class="teal">156</h3>
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
                                            <h3 class="deep-orange">64</h3>
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
                                            <h3 class="cyan">423</h3>
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
                                        <h5 class="text-bold-400">1,22,356</h5>
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
                                        <h5 class="text-bold-400">28</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Недавно подтверждённые пользователи</h4>
                                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="reload"><i class="icon-reload"></i></a></li>
                                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="card-block">
                                    <p>Не придумала что будет здесь <span class="float-xs-right"><a href="#">Invoice Summary <i
                                                        class="icon-arrow-right2"></i></a></span></p>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                        <tr>
                                            <th>Invoice#</th>
                                            <th>Customer Name</th>
                                            <th>Status</th>
                                            <th>Due</th>
                                            <th>Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="text-truncate"><a href="#">INV-001001</a></td>
                                            <td class="text-truncate">Elizabeth W.</td>
                                            <td class="text-truncate"><span
                                                        class="tag tag-default tag-success">Paid</span></td>
                                            <td class="text-truncate">10/05/2016</td>
                                            <td class="text-truncate">$ 1200.00</td>
                                        </tr>
                                        <tr>
                                            <td class="text-truncate"><a href="#">INV-001012</a></td>
                                            <td class="text-truncate">Andrew D.</td>
                                            <td class="text-truncate"><span
                                                        class="tag tag-default tag-success">Paid</span></td>
                                            <td class="text-truncate">20/07/2016</td>
                                            <td class="text-truncate">$ 152.00</td>
                                        </tr>
                                        <tr>
                                            <td class="text-truncate"><a href="#">INV-001401</a></td>
                                            <td class="text-truncate">Megan S.</td>
                                            <td class="text-truncate"><span
                                                        class="tag tag-default tag-success">Paid</span></td>
                                            <td class="text-truncate">16/11/2016</td>
                                            <td class="text-truncate">$ 1450.00</td>
                                        </tr>
                                        <tr>
                                            <td class="text-truncate"><a href="#">INV-01112</a></td>
                                            <td class="text-truncate">Doris R.</td>
                                            <td class="text-truncate"><span
                                                        class="tag tag-default tag-warning">Overdue</span></td>
                                            <td class="text-truncate">11/12/2016</td>
                                            <td class="text-truncate">$ 5685.00</td>
                                        </tr>
                                        <tr>
                                            <td class="text-truncate"><a href="#">INV-008101</a></td>
                                            <td class="text-truncate">Walter R.</td>
                                            <td class="text-truncate"><span
                                                        class="tag tag-default tag-warning">Overdue</span></td>
                                            <td class="text-truncate">18/05/2016</td>
                                            <td class="text-truncate">$ 685.00</td>
                                        </tr>
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
