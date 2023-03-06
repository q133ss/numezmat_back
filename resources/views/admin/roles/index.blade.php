@extends('layouts.admin')
@section('title', 'Роли')
@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <a href="{{route('admin.roles.create')}}" class="btn btn-primary">Добавить</a>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>Название</th>
                <th style="width: 100px">Изменить</th>
                <th style="width: 100px">Удалить</th>
            </tr>
            </thead>
            <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>{{$role->name}}</td>
                    <td><a href="{{route('admin.roles.edit', $role->id)}}" class="btn btn-warning">Изменить</a></td>
                    <td>
                        @if($role->slug != 'nezaregistrirovannyi')
                        <form action="{{route('admin.roles.destroy', $role->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete_agreement btn btn-danger">Удалить</button>
                        </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
