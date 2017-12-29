<?php
/**
 * Created by PhpStorm.
 * User: Nadine
 * Date: 29.12.2017
 * Time: 15:59
 */

?>
<table class="table table-hover" id="ownerTable">
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
        <th>
            Количество
        </th>
        <th>
            Просмотреть публикации
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
            <td></td>
        </tr>
        @php
            $i++;
        @endphp
    @endforeach

    </tbody>
</table>