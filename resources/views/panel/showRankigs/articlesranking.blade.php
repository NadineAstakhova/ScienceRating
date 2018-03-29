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
            <input type="text" id="search" placeholder="Поиск по ФИО..." class='form-control form-control-sm'/>
        </th>
        <th>
            <select id="selectFilter" class='form-control form-control-sm'>
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
            <td>
                <a href="{{ url('articles', $user->idUsers) }}" data-toggle="modal" data-target="#modalArt" class="btn btn-outline-dark btn-sm">Просмотреть публикации</a>
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
<script>
    $(document).ready(function() {
        // Vary modal content based on trigger button
        $("#modalArt").on('shown.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            console.log( button.attr('href'));
            var target = button.attr('href');
            if (target) {
                $(this).load(target, function () {
                    $(this).find('input:visible:first').focus();
                });
            }
        });
    });
</script>