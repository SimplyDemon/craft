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

            <form method="POST" action="{{ route( 'categories.update', [ 'id' => $single->id ] ) }}">
                @csrf
                @method('PUT')
                <label for="name">Категория</label><br>
                <input type="text" name="name" id="name" value="{{old('name',$single->name)}}" required><br>
                <select name="category_id">
                    @if (empty($single->category_id))
                        <option disabled hidden selected> Родительская категория</option>
                    @endif
                    <option value="">Без категории</option>
                    @foreach($all as $item)
                        @if($item->id != $single->id)

                            <option value="{{$item->id}}"
                                    @if($item->id == $single->category_id) selected @endif>{{$item->name}}</option>
                        @endif
                    @endforeach

                </select><br>
                <input type="hidden" name="currentID" value="{{$single->id}}">
                <input type="submit" name="method" value="Применить">
                <input type="submit" name="method" value="Сохранить">
                <button onclick="history.back(); return false;">Назад</button>
            </form>
        </section>
    </div>

@endsection