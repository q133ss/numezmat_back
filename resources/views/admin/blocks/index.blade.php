@extends('layouts.admin')
@section('title', 'Заблокированные записи')
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
                <th style="max-width: 30px">Название</th>
                <th style="max-width: 30px">Просмотр</th>
                <th style="max-width: 30px">Восстановить</th>
                <th style="max-width: 30px">Удалить</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                <tr>
                    <td><img src="{{$item->img()}}" alt=""></td>
                    <td>{{mb_substr($item->title,0,50)}}..</td>
                    <td>
                        @if($item->getTable() == 'news')
                            <a href="{{route($item->getTable().'.show', $item->id)}}" target="_blank" class="btn btn-info">Просмотр</a>
                        @elseif($item->getTable() == 'products')
                            <a href="{{route('shop.detail', $item->id)}}" target="_blank" class="btn btn-info">Просмотр</a>
                        @elseif($item->getTable() == 'libraries')
                            <a href="{{route('library.detail', $item->id)}}" target="_blank" class="btn btn-info">Просмотр</a>
                        @else
                            <a href="{{route(mb_substr($item->getTable(),0,-1).'.detail', $item->id)}}" target="_blank" class="btn btn-info">Просмотр</a>
                        @endif
                    </td>
                    <td>
                        @if($item->getTable() == 'libraries')
                            <a href="{{route('admin.block.restore', ['library', $item])}}" class="btn btn-success">Восстановить</a>
                        @elseif($item->getTable() == 'news')
                            <a href="{{route('admin.block.restore', ['news', $item])}}" class="btn btn-success">Восстановить</a>
                        @else
                            <a href="{{route('admin.block.restore', [mb_substr($item->getTable(),0,-1), $item])}}" class="btn btn-success">Восстановить</a>
                        @endif
                    </td>
                    <td>
                        @if($item->getTable() == 'libraries')
                            <a href="{{route('admin.block.delete', ['library', $item])}}" class="btn btn-danger">Удалить</a>
                        @elseif($item->getTable() == 'news')
                            <a href="{{route('admin.block.delete', ['news', $item])}}" class="btn btn-danger">Удалить</a>
                        @else
                            <a href="{{route('admin.block.delete', [mb_substr($item->getTable(),0,-1), $item])}}" class="btn btn-danger">Удалить</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
