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
            <td>
                <a href="{{ url('articles', $user->idUsers) }}" data-toggle="modal" data-target="#modalArt" class="btn btn-default btn-xs">Просмотреть публикации</a>
            </td>
        </tr>
        @php
            $i++;
        @endphp
    @endforeach

    </tbody>
</table>

<div class="modal fade" id="modalArt" tabindex="-1" role="dialog" aria-labelledby="modalArt">
    <div class="modal-dialog" role="document">
        <div class="modal-content"> </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(document).on('hidden.bs.modal', '.modal', function () {
            var modalData = $(this).data('bs.modal');

            // Destroy modal if has remote source – don't want to destroy modals with static content.
            if (modalData && modalData.options.remote) {
                // Destroy component. Next time new component is created and loads fresh content
                $(this).removeData('bs.modal');
                // Also clear loaded content, otherwise it would flash before new one is loaded.
                $(this).find(".modal-content").empty();
            }
        });

    });
</script>