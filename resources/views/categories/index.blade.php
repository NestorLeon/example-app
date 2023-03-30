@extends('app')

@section('content')

    <a class="btn btn-primary btn-sm mx-1" href="{{ route('categories.create') }}">
        Nueva Categoría
    </a>

    <div class="container w-50 p-4 mt-4">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                  <th scope="col">Nombre</th>
                  <th scope="col">Color</th>
                  <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($categories as $category)
                    <tr>
                        <td>
                            {{ $category->name }}
                        </td>
    
                        <td>
                            <div style="background-color: {{ $category->color }};  width: 50px; height: 50px;">
                            </div>
                        </td>
    
                        <td>
                            <div class="d-flex">
                                <a class="btn btn-primary btn-sm mx-1" href="{{ route('categories.show', ['category' => $category->id]) }}">
                                    Ver
                                </a>
                                <a class="btn btn-secondary btn-sm mx-1" href="{{ route('categories.edit', ['category' => $category->id]) }}">
                                    Editar
                                </a>
                                <form class="mx-1" action="{{ route('categories.destroy', [$category->id]) }}" 
                                        method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </div>
                        </td>
    
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection