@extends('layouts.admin')
@section('title', 'Реклама')
@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>Изображение</th>
                <th>Ссылка</th>
                <th>Страница/Категория</th>
                <th>Начало</th>
                <th>Окончание</th>
                <th>Статус</th>
                <th>Действие</th>
            </tr>
            </thead>
            <tbody>
            @foreach($ads as $ad)
                <tr>
                    <td><img src="{{$ad->img}}" alt=""></td>
                    <td>{{$ad->link}}</td>
                    <td>
                        {{$ad->getCategory()}}
                    </td>
                    <td>
                        {{$ad->getStartDate()}}
                    </td>
                    <td>
                        {{$ad->getLastDate()}}
                    </td>
                    <td>
                        {{$ad->active ? 'Активная' : 'Не активная'}}
                    </td>
                    <td>
                        <a href="#">Изменить</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
