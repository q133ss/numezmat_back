@extends('layouts.admin')
@section('title', 'Изменить роль '.$role->name)
@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Изменить роль {{$role->name}}</h4>

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <span class="text-danger">{{ $error }}</span> <br>
                @endforeach
            @endif

            <form class="forms-sample" method="POST" action="{{route('admin.roles.update', $role->id)}}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="exampleInputUsername1">Название</label>
                    <input type="text" class="form-control" name="name" id="exampleInputUsername1" value="{{$role->name}}" placeholder="Название">
                </div>

                <div class="form-group">
                    <label for="exampleInputUsername1">Доступы</label>
                    @foreach($permissions as $permission)
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" @if(in_array($permission->slug, $role->permissions->pluck('slug')->all())) checked @endif name="permissions[]" value="{{$permission->slug}}" class="form-check-input"> {{$permission->name}} <i class="input-helper"></i></label>
                    </div>
                    @endforeach
                </div>

                <button type="submit" class="btn btn-primary mr-2">Изменить</button>
            </form>
        </div>
    </div>
@endsection
