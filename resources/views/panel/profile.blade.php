@extends('layouts.main')
@section('title', 'Главная')
@section('content')
    <div class="row">
        <div class="col-lg-9 panel-cards">
            <h3>Hello, {{Auth::user()->username}}</h3>
            @php
                if(Session::has('save'))
                   echo "<div class='alert alert-success' id='mesSuccessAdd'>".Session::get("save")."</div>";
               if(Session::has('error'))
                   echo "<div class='alert alert-danger' id='mesSuccessAdd'>".Session::get("error")."</div>";
            @endphp
        </div>
    </div>
    <div class="row">

            <div class="col-lg-4 col-md-6 col-sm-9 panel-cards">
                <div class="card">
                    <h5 class="card-header">{{ trans('messages.add_res')}}</h5>
                    <div class="card-body">
                        <p class="card-text">{{ trans('messages.add_res_text')}}</p>
                        <a href="{{url(App\Http\Middleware\LocaleMiddleware::getLocale()."/createResult")}}" class="btn btn-info" id="listSub">
                            {{ trans('messages.add_res_btn')}}</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-9 panel-cards">
                <div class="card">
                    <h5 class="card-header">{{ trans('messages.add_pub')}}</h5>
                    <div class="card-body">
                        <p class="card-text">{{ trans('messages.add_pub_text')}}</p>
                        <a href="{{url(App\Http\Middleware\LocaleMiddleware::getLocale()."/createArticle")}}" class="btn btn-info" id="listSub">{{ trans('messages.add_res_btn')}}</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-9 panel-cards">
                @if($countOfNewResults > 0)
                    <div class="card">
                @else
                    <div class="card disabled-card">
                @endif
                         <h5 class="card-header">{{ trans('messages.accept_res')}}</h5>
                         <div class="card-body">
                               <p class="card-text">{{ trans('messages.accept_res_text')}}</p>
                                @if($countOfNewResults > 0)
                                    <a href="{{url(App\Http\Middleware\LocaleMiddleware::getLocale()."/acceptResults")}}" class="btn btn-info">{{ trans('messages.accept_res_btn')}} ({{$countOfNewResults}})</a>
                                @else
                                    <button type="button" class="btn btn-light" disabled="">{{ trans('messages.accept_res_btn1')}}</button>
                                @endif
                          </div>
                     </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-9 panel-cards">
                <div class="card">
                    <h5 class="card-header">{{ trans('messages.scient_res')}}</h5>
                    <div class="card-body">
                        <p class="card-text">{{ trans('messages.scient_res_text')}}</p>
                        <a href="{{url(App\Http\Middleware\LocaleMiddleware::getLocale()."/results")}}" class="btn btn-info" id="listSub">{{ trans('messages.scient_res_btn')}}</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-9 panel-cards">
                <div class="card">
                    <h5 class="card-header">{{ trans('messages.scient_rank')}}</h5>
                    <div class="card-body">
                        <p class="card-text">{{ trans('messages.scient_rank_text')}}</p>
                        <a href="{{url(App\Http\Middleware\LocaleMiddleware::getLocale()."/createrating")}}" class="btn btn-info" id="listSub">
                            {{ trans('messages.scient_rank_btn')}}</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-9 panel-cards">
                <div class="card">
                    <h5 class="card-header">{{ trans('messages.profile_data')}}</h5>
                    <div class="card-body">
                        <p class="card-text">{{ trans('messages.profile_data_text')}}</p>
                        <a href="{{url(App\Http\Middleware\LocaleMiddleware::getLocale()."/infoProfileMethodist")}}" class="btn btn-info" id="listSub">
                            {{ trans('messages.profile_data_btn')}}</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-9 panel-cards">
                <div class="card">
                    <h5 class="card-header">{{ trans('messages.temp_rank')}}</h5>
                    <div class="card-body">
                        <p class="card-text">{{ trans('messages.temp_rank_text')}}</p>
                        <a href="{{url(App\Http\Middleware\LocaleMiddleware::getLocale()."/temps")}}" class="btn btn-info" id="listSub">
                            {{ trans('messages.scient_res_btn')}}</a>
                    </div>
                </div>
            </div>
        <br><br>
    </div>
</div>
@endsection