<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\DB;

class TodosController extends Controller
{
    /*
        CREATE para mostrar el formulario de creación de un registro
        INDEX para mostrar todos los registros
        STORE para guardar un registro
        UPDATE para actualizar un registro
        DESTROY para eliminar un un registro
        EDIT para mostrar el formulario de edición de un registro
        SHOW para mostrar un formulario de consulta de un registro
    */


    public function store(Request $request){
        // $request -> validate([
        //     'title' => 'required|min:3'
        // ]);

        $this->validate(
            $request, 
            [
                'title' => 'required|min:3',
                'category_id' => 'required',
            ],
            [
                'title.required' => 'El campo título es obligatorio.',
                'title.min' => 'El campo título debe tener más de 3 caracteres.',
                'category_id.required' => 'Seleccione la categoría de la tarea.',
            ],
        );

        $todo = new Todo();
        $todo->title = $request->title;
        $todo->category_id = $request->category_id;
        $todo->save();

        return redirect()->route('todos')->with('success', 'Tarea creada correctamente');
    }

    public function index()
    {
        $todos = DB::table('todos')
                        ->select('todos.*', 'categories.color as category_color', 'categories.name as category_name')
                        ->join('categories', 'todos.category_id', '=', 'categories.id')
                        ->orderBy('categories.name')
                        ->orderBy('todos.title')
                        ->get();
        $categories = DB::table('categories')->orderBy('name')->get();
        return view('todos.index', ['todos' => $todos, 'categories' => $categories]);
    }

    public function show($id)
    {
        $todo = Todo::find($id);
        $categories = DB::table('categories')->orderBy('name')->get();
        return view('todos.show', ['todo' => $todo, 'categories' => $categories]);
    }

    public function update(Request $request,  $id)
    {
        $this->validate(
            $request, 
            [
                'title' => 'required|min:3',
                'category_id' => 'required',
            ],
            [
                'title.required' => 'El campo título es obligatorio.',
                'title.min' => 'El campo título debe tener más de 3 caracteres.',
                'category_id.required' => 'Seleccione la categoría de la tarea.',
            ],
        );

        $todo = Todo::find($id);
        $todo->title =  $request->title;
        $todo->category_id =  $request->category_id;
        $todo->save();
        
        return redirect()->route('todos')->with('success', 'Tarea actualizada!');
    }

    public function destroy($id)
    {
        $todo = Todo::find($id);
        $todo->delete();
        
        return redirect()->route('todos')->with('success', 'Tarea ha sido eliminada!');
    }

    

}
