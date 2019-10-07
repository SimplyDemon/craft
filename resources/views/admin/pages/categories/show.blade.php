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
            Дата создания: {{$single->created_at}}<br>
            <form method="POST" action="{{ route( 'categories.destroy', [ 'id' => $single->id ] ) }}">
                @csrf
                @method('DELETE')
                <button>Удалить</button>
            </form>
            <br>
            <a href="{{ route( 'categories.edit', [ 'id' => $single->id ] ) }}">Редактировать</a>


        </section>
    </div>

@endsection