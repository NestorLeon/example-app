@extends('app')

@section('content')
    <div class="container w-25 border p-4 mt-4">
        <form>
            <div class="mb-3">
                <label for="name" class="form-label">Categoría</label>
                <input type="text" class="form-control" value="{{ $category->name }}" disabled>
            </div>

            <div class="mb-3">
                <label for="color" class="form-label">Color</label>
                <div style="background-color: {{ $category->color }};  width: 50px; height: 50px;">
                </div>
            </div>

            <div class="mb-3 align-items-center">
                <a class="btn btn-secondary btn-md" href="{{ route('categories.index') }}">
                    Regresar
                </a>
            </div>

        </form>

        <div class="container">
            @if ($category->todos->count() > 0)
                @foreach ($category->todos as $todo)
                    <div class="row py-1">
                        <div class="col-md-9 d-flex align-items-center">
                            {{ $todo->title }}
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