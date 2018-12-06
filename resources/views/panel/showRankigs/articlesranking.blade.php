<?php
/**
 * Created by PhpStorm.
 * User: Nadine
 * Date: 29.12.2017
 * Time: 15:59
 */

?>
<table class="table table-hover table-sm" id="ownerTable">
    <thead>
    <tr>
        <th>
            <input type="text" id="search" placeholder="{{ trans('messages.search_by_name')}}..." class='form-control form-control-sm'/>
        </th>
        <th>
            <select id="selectFilter" class='form-control form-control-sm'>
                <option id="all">{{ trans('messages.all_users')}}</option>
                <option id="student">Student</option>
                <option id="professor">Professor</option>
            </select>
        </th>
        <th>
            Email
        </th>
        <th>
            {{ trans('messages.numbers')}}
        </th>
        <th>
            {{ trans('messages.show_publications')}}
        </th>
    </tr>
    </thead>

    @php $i=0;
    @endphp
    <tbody>
    @foreach($arrArticles as $user)
        <tr class="all">
            <td class="name">{{$user->surname}} {{$user->name}} {{$user->patronymic}}</td>
            <td class="type">{{$user->type}}</td>
            <td class="email">{{$user->email}}</td>
            <td>{{$user->countA}}</td>
            <td>
                <a href="{{ url(App\Http\Middleware\LocaleMiddleware::getLocale().'/articles', $user->idUsers) }}" data-toggle="modal" data-target="#modalArt" class="btn btn-outline-dark btn-sm">{{ trans('messages.show_publications')}}</a>
            </td>
        </tr>
        @php
            $i++;
        @endphp
    @endforeach

    </tbody>
</table>


<div class="modal fade bd-example-modal-lg" id="modalArt" tabindex="-1" role="dialog" aria-labelledby="modalArt" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        </div>
    </div>
</div>