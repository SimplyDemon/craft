@extends('admin.layouts.primary')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Редактировать
            </h1>
        </section>

        <section class="content container-fluid">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach


            @if (Session::has('message'))
                <li>{!! session('message') !!}</li>
            @endif

            <form method="POST" action="{{ route( 'resources.update', [ 'id' => $single->id ] ) }}">
                @csrf
                @method('PUT')
                <label for="name">Категория</label><br>
                <input type="text" name="name" id="name" value="{{old('name',$single->name)}}" required><br>
                <label for="cost">Цена</label><br>
                <input type="number" name="cost" id="cost" value="{{old('cost',$single->cost)}}" min="1" required><br>
                <label for="img">Изображение</label><br>
                <input type="text" name="img" id="img" value="{{old('img',$single->img)}}" required><br>

                <input type="hidden" name="currentID" value="{{$single->id}}">
                <input type="submit" name="method" value="Применить">
                <input type="submit" name="method" value="Сохранить">
                <button onclick="history.back(); return false;">Назад</button>
            </form>
        </section>
    </div>

@endsection