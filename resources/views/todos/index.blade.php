@extends('app')

@section('content')
    <div class="container w-25 border p-4 mt-4">
        <form action="{{ route('todos') }}" method="POST">
            @csrf

            @if (session('success'))
                <h6 class="alert alert-success"> {{ session('success') }} </h6>
            @endif

            @error('title')
            <h6 class="alert alert-danger"> {{ $message }} </h6>
            @enderror

            <div class="mb-3">
                <label for="title" class="form-label">Título de la tarea</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Categoría de la tarea</label>
                <select class="form-select" id="category_id" name="category_id">
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Crear nueva tarea</button>
        </form>
    </div>

    <div class="container border p-4 mt-4">
        <div class="row row-cols-2 row-cols-md-3 g-4">
            @foreach ($todos as $todo)
                <div class="col">
                    <div class="card m-1" style="width: 12rem; background-color: {{ $todo->category_color }};">
                        <div class="card-header">
                            <h5 style="color: white">{{ $todo->category_name }}</h4>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title">
                                <a class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" 
                                    href="{{ route('todos-show', ['id' => $todo->id]) }}">
                                    {{ $todo->title }}
                                </a>
                            </h6>
                            <form action="{{ route('todos-destroy', [$todo->id]) }}" 
                                method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection