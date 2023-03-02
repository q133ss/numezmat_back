@extends('layouts.admin')
@section('title', 'Изменить рекламу')
@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Изменить рекламу</h4>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <span class="text-danger">{{ $error }}</span> <br>
                @endforeach
            @endif
            <form class="forms-sample" method="POST" action="{{route('admin.ads.update', $ad->id)}}">
                @csrf
                <div class="form-group">
                    <label for="exampleInputUsername1">Изображение</label>
                    <img src="{{$ad->img}}" width="100%" alt="">
                    <input type="file" name="img" class="form-control" id="exampleInputUsername1">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Ссылка</label>
                    <input type="text" name="link" class="form-control" value="{{$ad->link}}" id="exampleInputEmail1" placeholder="https://google.com">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Страница</label>
                    <input type="text" name="page_url" value="{{$ad->page_url}}" class="form-control" id="exampleInputPassword1" placeholder="https://numezmat.com">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Размещение в футоре</label>
                    <input type="text" value="{{$ad->in_footer == 1 ? 'Да' : 'Нет'}}" disabled class="form-control" id="exampleInputPassword1">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Категория (если нужна реклама на весь раздел)</label>
                    <select name="category_type" class="form-control" id="">
                        <option value="">Нет</option>
                        <option @if($ad->category == 'news') selected @endif value="news">Новости</option>
                        <option @if($ad->category == 'rating') selected @endif value="rating">Определение и оценка</option>
                        <option @if($ad->category == 'expertise') selected @endif value="expertise">Экспертиза</option>
                        <option @if($ad->category == 'catalog') selected @endif value="catalog">Каталог</option>
                        <option @if($ad->category == 'shop') selected @endif value="shop">Магазин</option>
                        <option @if($ad->category == 'library') selected @endif value="library">Библиотека</option>
                        <option @if($ad->category == 'forum') selected @endif value="forum">Беседка</option>
                    </select>
                </div>
                <div class="form-check form-check-flat form-check-primary">
                    <label class="form-check-label">
                        <input type="checkbox" name="in_footer" @if($ad->in_footer == true) checked @endif class="form-check-input"> Размешение в футоре <i class="input-helper"></i></label>
                </div>

                <div class="form-check form-check-flat form-check-primary">
                    <label class="form-check-label">
                        <input type="checkbox" name="active" @if($ad->active == true) checked @endif class="form-check-input"> Включена <i class="input-helper"></i></label>
                </div>

                <button type="submit" class="btn btn-primary mr-2">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
