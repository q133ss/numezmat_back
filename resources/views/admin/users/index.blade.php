@extends('layouts.admin')
@section('title', 'Пользователи | Панель администратора')
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
                <th>Имя</th>
                <th>Роль</th>
                <th>Дата регистрации</th>
                <th>Изменить</th>
                <th>Удалить</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->roles->pluck('name')->first()}}</td>
                <td>{{$user->created_at}}</td>
                <td>
                    <a href="{{route('admin.users.edit', $user->id)}}" class="btn btn-warning">Изменить</a>
                </td>
                <td>
                    <form action="{{route('admin.users.destroy', $user->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                    <button type="submit" class="delete_agreement btn btn-danger">Удалить</button>
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
