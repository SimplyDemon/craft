@extends('admin.layouts.primary')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Одиночная страница
            </h1>
        </section>

        <section class="content container-fluid">

            Айди: {{$single->id}}<br>
            Название: {{$single->name}}<br>
            Слаг: {{$single->slug}}<br>
            Цена: {{$single->cost}}<br>
            Ссылка на изображение: {{$single->img}}<br>
            Дата создания: {{$single->created_at}}<br>
            <form method="POST" action="{{ route( 'resources.destroy', [ 'id' => $single->id ] ) }}">
                @csrf
                @method('DELETE')
                <button>Удалить</button>
            </form>
            <br>
            <a href="{{ route( 'resources.edit', [ 'id' => $single->id ] ) }}">Редактировать</a>


        </section>
    </div>

@endsection