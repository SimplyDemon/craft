@extends('admin.layouts.primary')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Добавить
            </h1>
        </section>

        <section class="content container-fluid">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach


            @if (Session::has('message'))
                <li>{!! session('message') !!}</li>
            @endif
            <form method="post" action="<?= route( 'recipes.store' ) ?>">
                @csrf
                <label for="name">Рецепт</label><br>
                <input type="text" name="name" id="name" value="{{old('name','')}}" required><br>
                <label for="cost">Цена</label><br>
                <input type="number" name="cost" id="cost" value="{{old('cost','')}}" min="1" required><br>
                <label for="img">Изображение</label><br>
                <input type="text" name="img" id="img" value="{{old('img','')}}" required><br>

                <select name="category_id">
                    <option value="">Без категории</option>
                    @foreach($categories as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach

                </select><br>

                <select name="percent">
                    @foreach($percentValues as $item)
                        <option value="{{$item}}" @if ($item == '60') selected @endif>{{$item}}%</option>
                    @endforeach


                </select><br>

                <select name="grade">
                    @foreach($gradeValues as $item)
                        <option value="{{$item}}" @if ($item == 'none') selected @endif>{{$item}}</option>
                    @endforeach


                </select>

                <br>
                <button>Создать</button>
            </form>
        </section>
    </div>

@endsection