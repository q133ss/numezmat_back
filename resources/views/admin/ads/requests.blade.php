@extends('layouts.admin')
@section('title', 'Заявки на рекламу | Панель администратора')
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
                <th>Телефон</th>
                <th>Ссылка</th>
                <th>Тип</th>
                <th>Просмотр</th>
            </tr>
            </thead>
            <tbody>
            @foreach($requests as $request)
                <tr>
                    <td><img src="{{$request->img}}" alt=""></td>
                    <td>{{$request->phone}}</td>
                    <td>{{$request->link}}</td>
                    <td>{{$request->getType()}}</td>
                    <td>
                        <a href="{{route('admin.ads.requests.show', $request->id)}}" class="btn btn-info">Просмотр</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
