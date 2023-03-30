<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Controllers\Rule;
use App\Models\Category;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate(
            $request, 
            [
                'name' => 'required|unique:categories|min:3|max:255',
                'color' => 'required|max:7',
            ],
            [
                'name.required' => 'El campo nombre es obligatorio.',
                'name.unique' => 'El campo nombre debe ser único.',
                'name.min' => 'El campo nombre debe tener mínimo 3 caracteres.',
                'name.max' => 'El campo nombre debe tener máximo 255 caracteres.',
                'color.required' => 'El campo color es obligatorio.',
                'color.max' => 'El campo color debe tener máximo 7 caracteres.',
            ],
        );

        $category = new Category();
        $category->name = $request->name;
        $category->color = $request->color;
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Categoría creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        return view('categories.show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        return view('categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);

        $this->validate(
            $request, 
            [
                'name' => [
                            'required', 
                            'unique:categories',
                            //Rule::unique('categories')->ignore($category),
                            'min:3',
                            'max:255',
                ],
                'color' => 'required|max:7',
            ],
            [
                'name.required' => 'El campo nombre es obligatorio.',
                'name.unique' => 'El campo nombre debe ser único.',
                'name.min' => 'El campo nombre debe tener mínimo 3 caracteres.',
                'name.max' => 'El campo nombre debe tener máximo 255 caracteres.',
                'color.required' => 'El campo color es obligatorio.',
                'color.max' => 'El campo color debe tener máximo 7 caracteres.',
            ],
        );

        $category->name = $request->name;
        $category->color = $request->color;
        $category->save();
        
        return redirect()->route('categories.index')->with('success', 'Categoría actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        $category->delete();
        
        return redirect()->route('categories.index')->with('success', 'Categoría eliminada!');
    }
}
