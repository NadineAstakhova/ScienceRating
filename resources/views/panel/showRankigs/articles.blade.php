<?php
/**
 * Created by PhpStorm.
 * User: Nadine
 * Date: 30.12.2017
 * Time: 20:43
 */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Просмотр публикаций</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
<div class="modal-body" id='to_print'>
    Публикации {{$user}}
    <table class="table table-hover" id="articlesTable">
        <thead>
        <tr>
            <th>
                Название
            </th>
            <th>
                Издательство
            </th>
            <th>
                Дата
            </th>
            <th>
                Кол-во страниц
            </th>
            <th>
                Процент
            </th>
            <th>
                Тип
            </th>
        </tr>
        </thead>

        @php $i=0;
        @endphp
        <tbody>
        @if(count($articles) > 0)
            @foreach($articles as $article)
                <tr class="all">
                    <td class="name">{{$article->title}} </td>
                    <td class="pub">{{$article->edition}} </td>
                    <td class="date">{{$article->date}} </td>
                    <td class="pages">{{$article->pages}} </td>
                    <td class="percent">{{$article->percent_of_writing}} </td>
                    <td class="type_pub">{{$article->type}} </td>
                </tr>
                @php
                    $i++;
                @endphp
            @endforeach

        @else
            <tr class="all">
                <td>Нет публикаций</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

    <button type="button" class="btn btn-success" data-slug="" id="print">Распечатать</button>
</div>

    </div>
</div>
<script>
    //TODO::Красивости
    $(document).ready(function(){
        $('#print').click(function(){
            var printing_css = "<style media=print>" +
                "#print, .breadcrumb, .delete_btn, #update_btn{display: none;}" +
                "table{text-align: left} </style>";
            var html_to_print=printing_css+$('#to_print').html();
            var iframe=$('<iframe id="print_frame">');
            $('body').append(iframe);
            var doc = $('#print_frame')[0].contentDocument || $('#print_frame')[0].contentWindow.document;
            var win = $('#print_frame')[0].contentWindow || $('#print_frame')[0];
            doc.getElementsByTagName('body')[0].innerHTML=html_to_print;
            win.print();
            $('iframe').remove();
        }); });
</script>