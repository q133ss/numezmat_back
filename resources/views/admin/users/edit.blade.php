@extends('layouts.admin')
@section('title')Изменить пользователя {{$user->name}}@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Изменить пользователя</h4>
            <p class="card-description"> Изменить пользователя {{$user->name}} </p>

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <span class="text-danger">{{ $error }}</span> <br>
                @endforeach
            @endif

            <form class="forms-sample" method="POST" action="{{route('admin.users.update', $user->id)}}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="exampleInputUsername1">Имя</label>
                    <input type="text" class="form-control" name="name" id="exampleInputUsername1" placeholder="Имя" value="{{$user->name}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" name="email" value="{{$user->email}}" class="form-control" id="exampleInputEmail1" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="exampleSelectGender">Роль</label>
                    <select class="form-control" name="role_id" id="exampleSelectGender">
                        @foreach($roles as $role)
                            <option value="{{$role->id}}" @if($user->roles->pluck('id')->first() == $role->id) selected @endif>{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Задать новый пароль</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Можно оставить пустым">
                </div>
                <button type="submit" class="btn btn-primary mr-2">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
