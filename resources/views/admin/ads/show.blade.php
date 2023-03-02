@extends('layouts.admin')
@section('title', 'Заявка на рекламу')
@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Заявка на рекламу</h4>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <span class="text-danger">{{ $error }}</span> <br>
                @endforeach
            @endif
            <form action="{{route('admin.ads.requests.action', [$request->id, 'accept'])}}" method="GET">
                @csrf
            <ul>
                @if($request->user_id != null)
                <li>Пользователь: <a href="{{route('admin.users.edit', $request->user->id)}}">{{$request->user->name}}</a></li>
                @endif
                <li>Тип: {{$request->getType()}}</li>
                <li>Телефон: <a href="tel:{{$request->phone}}">{{$request->phone}}</a></li>
                <li>Ссылка: <a href="{{$request->link}}" target="_blank">{{$request->link}}</a></li>
                <li>Страница: <a href="{{$request->page_url}}" target="_blank">{{$request->page_url}}</a></li>
                <li>Размещение в футоре: {{$request->in_footer == 1 ? 'Да' : 'Нет'}}</li>
                @if($request->type == 'all')
                    <li>Категория: {{$request->getCategory()}}</li>
                @endif
                <li>
                    Дата начала
                    <input type="text" name="start_date" class="form-control data-picker">
                </li>
                <li>
                    Дата окончания
                    <input type="text" name="last_date" class="form-control data-picker">
                </li>
                <li>Изображение: <img src="{{$request->img}}" width="100%" alt=""></li>
            </ul>
            <button type="submit" class="btn btn-primary">Принять</button>
            <a href="{{route('admin.ads.requests.action', ['id' => $request->id, 'action' => 'reject', 'start_date' => '01-01-2023', 'last_date' => '01-01-2023'])}}" class="btn btn-danger">Отклонить</a>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/ui-darkness/jquery-ui.css">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-darkness/jquery-ui.css">

    <script>
        /* Russian (UTF-8) initialisation for the jQuery UI date picker plugin. */
        /* Written by Andrew Stromnov (stromnov@gmail.com). */
        ( function( factory ) {
            "use strict";

            if ( typeof define === "function" && define.amd ) {

                // AMD. Register as an anonymous module.
                define( [ "../widgets/datepicker" ], factory );
            } else {

                // Browser globals
                factory( jQuery.datepicker );
            }
        } )( function( datepicker ) {
            "use strict";

            datepicker.regional.ru = {
                closeText: "Закрыть",
                prevText: "Пред",
                nextText: "След",
                currentText: "Сегодня",
                monthNames: [ "Январь", "Февраль", "Март", "Апрель", "Май", "Июнь",
                    "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь" ],
                monthNamesShort: [ "Янв", "Фев", "Мар", "Апр", "Май", "Июн",
                    "Июл", "Авг", "Сен", "Окт", "Ноя", "Дек" ],
                dayNames: [ "воскресенье", "понедельник", "вторник", "среда", "четверг", "пятница", "суббота" ],
                dayNamesShort: [ "вск", "пнд", "втр", "срд", "чтв", "птн", "сбт" ],
                dayNamesMin: [ "Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб" ],
                weekHeader: "Нед",
                dateFormat: "dd.mm.yy",
                firstDay: 1,
                isRTL: false,
                showMonthAfterYear: false,
                yearSuffix: "" };
            datepicker.setDefaults( datepicker.regional.ru );

            return datepicker.regional.ru;

        } );
    </script>

    <script>
        $( function() {
            $( ".data-picker" ).datepicker({
                changeMonth: true,
                changeYear: true
            });
        } );

        $.datepicker.setDefaults( $.datepicker.regional[ "ru" ] );
    </script>
@endsection
