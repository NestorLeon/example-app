<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

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
            ['title' => 'required|min:3'],
            [
                'title.required' => 'El campo título es obligatorio.',
                'title.min' => 'El campo título debe tener más de 3 caracteres.'
            ],
        );

        $todo = new Todo();
        $todo->title = $request->title;
        $todo->save();

        return redirect()->route('todos')->with('success', 'Tarea creada correctamente');
    }

    public function index()
    {
        $todos = Todo::all();
        return view('todos.index', ['todos' => $todos]);
    }

    public function show($id)
    {
        $todo = Todo::find($id);
        return view('todos.show', ['todo' => $todo]);
    }

    public function update(Request $request,  $id)
    {
        $this->validate(
            $request, 
            ['title' => 'required|min:3'],
            [
                'title.required' => 'El campo título es obligatorio.',
                'title.min' => 'El campo título debe tener más de 3 caracteres.'
            ],
        );

        $todo = Todo::find($id);
        $todo->title =  $request->title;
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
