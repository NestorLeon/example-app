@extends('app')

@section('content')
    <div class="container w-25 border p-4 mt-4">
        <form action="{{ route('categories.update', ['category' => $category->id]) }}" method="POST">
            @method('PATCH')
            @csrf

            @if (session('success'))
                <h6 class="alert alert-success"> {{ session('success') }} </h6>
            @endif

            @error('name')
            <h6 class="alert alert-danger"> {{ $message }} </h6>
            @enderror

            <div class="mb-3">
                <label for="name" class="form-label">Categoría</label>
                <input type="text" class="form-control" value="{{ $category->name }}" 
                    id="name" name="name">
            </div>

            @error('color')
            <h6 class="alert alert-danger"> {{ $message }} </h6>
            @enderror

            <div class="mb-3">
                <label for="color" class="form-label">Color de la Categoría</label>
                <input type="color" class="" id="color" name="color" value="{{ $category->color }}">
            </div>

            <div class="mb-3 align-items-center">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a class="btn btn-secondary btn-md" href="{{ route('categories.index') }}">
                    Cancelar
                </a>
            </div>

        </form>
        
        <div class="container">
            @if ($category->todos->count() > 0)
                @foreach ($category->todos as $todo)
                    <div class="row py-1">
                        <div class="col-md-9 d-flex align-items-center">
                            <a href="{{ route('todos-show', ['id' => $todo->id]) }}">
                                {{ $todo->title }}
                            </a>
                        </div>

                        <div class="col-md-3 d-flex justify-content-end">
                            <form action="{{ route('todos-destroy', [$todo->id]) }}" 
                                    method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </div>

                    </div>
                @endforeach
            @else
                <p>
                    No hay tareas en esta categoría.
                </p>
            @endif

        </div>
    </div>
@endsection