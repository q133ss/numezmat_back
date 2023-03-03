@extends('layouts.admin')
@section('title', 'Создать роль')
@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Добавить роль</h4>

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <span class="text-danger">{{ $error }}</span> <br>
                @endforeach
            @endif

            <form class="forms-sample" method="POST" action="{{route('admin.roles.store')}}">
                @csrf
                <div class="form-group">
                    <label for="exampleInputUsername1">Название</label>
                    <input type="text" class="form-control" name="name" id="exampleInputUsername1" value="{{old('name')}}" placeholder="Название">
                </div>

                <div class="form-group">
                    <label for="exampleInputUsername1">Доступы</label>
                    @foreach($permissions as $permission)
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" @if(in_array($permission->slug, old('permissions'))) checked @endif name="permissions[]" value="{{$permission->slug}}" class="form-check-input"> {{$permission->name}} <i class="input-helper"></i></label>
                    </div>
                    @endforeach
                </div>

                <button type="submit" class="btn btn-primary mr-2">Добавить</button>
            </form>
        </div>
    </div>
@endsection
