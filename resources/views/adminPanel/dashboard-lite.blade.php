@extends('layouts.adminMain')
@section('title', 'Главная')
@section('content')
    <div data-scroll-to-active="true" class="main-menu menu-fixed menu-dark menu-accordion menu-shadow">
        <div class="main-menu-content">
            <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
                <li class=" nav-item">
                    <a href="{{url("admin")}}">
                        <i class="icon-home3"></i>
                        <span data-i18n="nav.form_layouts.form_layout_basic" class="menu-title">Dashboard</span>
                    </a>
                </li>

                <li class=" nav-item">
                    <a href="#">
                        <i class="icon-user"></i>
                        <span data-i18n="nav.page_layouts.main" class="menu-title">Методисты</span>
                    </a>
                    <ul class="menu-content">
                        <li>
                            <a href="layout-1-column.html" data-i18n="nav.page_layouts.1_column" class="menu-item">
                                <i class="icon-list"></i>
                                <span data-i18n="nav.project.main" class="menu-title">Список</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url("createMethodistPage")}}" data-i18n="nav.page_layouts.2_columns"
                               class="menu-item">
                                <i class="icon-user-plus"></i>
                                <span data-i18n="nav.project.main" class="menu-title">Создание</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class=" nav-item">
                    <a href="#">
                        <i class="icon-study"></i>
                        <span data-i18n="nav.project.main" class="menu-title">Преподавтели</span>
                    </a>
                    <ul class="menu-content">
                        <li>
                            <a href="layout-1-column.html" data-i18n="nav.page_layouts.1_column" class="menu-item">
                                <i class="icon-list"></i>
                                <span data-i18n="nav.project.main" class="menu-title">Список</span>
                            </a>
                        </li>
                        <li>
                            <a href="layout-2-columns.html" data-i18n="nav.page_layouts.2_columns" class="menu-item">
                                <i class="icon-user-plus"></i>
                                <span data-i18n="nav.project.main" class="menu-title">Создание</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class=" nav-item">
                    <a href="#">
                        <i class="icon-android-funnel"></i>
                        <span data-i18n="nav.project.main" class="menu-title">Меню</span>
                    </a>
                    <ul class="menu-content">
                        <li>
                            <a href="layout-1-column.html" data-i18n="nav.page_layouts.1_column" class="menu-item">
                                <i class="icon-list3"></i>
                                <span data-i18n="nav.project.main" class="menu-title">Дерево</span>
                            </a>
                        </li>
                        <li>
                            <a href="layout-2-columns.html" data-i18n="nav.page_layouts.2_columns" class="menu-item">
                                <i class="icon-plus"></i>
                                <span data-i18n="nav.project.main" class="menu-title">Создание</span>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
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
                                            <h3 class="pink">278</h3>
                                            <span>Новые студенты</span>
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
                                            <span>Новые группы</span>
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
                                            <span>Новые предметы</span>
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
                                            <span>Научные рейтинги</span>
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
                                        <h5>Неподтверждённые пользователи</h5>
                                        <h5 class="text-bold-400">1,22,356</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <div class="p-2 media-body text-xs-left">
                                        <h5>Новые научные публикации</h5>
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
                                        <h5>Новые научные результаты</h5>
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
