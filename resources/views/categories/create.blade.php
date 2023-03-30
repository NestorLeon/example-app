@extends('app')

@section('content')

    <div class="container w-25 border p-4 mt-4">
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            @if (session('success'))
                <h6 class="alert alert-success"> {{ session('success') }} </h6>
            @endif

            @error('name')
            <h6 class="alert alert-danger"> {{ $message }} </h6>
            @enderror

            <div class="mb-3">
                <label for="name" class="form-label">Nombre de la Categoría</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>

            @error('color')
            <h6 class="alert alert-danger"> {{ $message }} </h6>
            @enderror

            <div class="mb-3">
                <label for="color" class="form-label">Color de la Categoría</label>
                <input type="color" class="" id="color" name="color">
            </div>

            <div class="mb-3 align-items-center">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a class="btn btn-secondary btn-md" href="{{ route('categories.index') }}">
                    Cancelar
                </a>
            </div>
        </form>
    </div>

@endsection