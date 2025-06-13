<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }
     
    // CategoryController.php
    public function index()
    {
        session()->forget('url_origen');

        $categories = Category::paginate(10); // ✅ Pagina de a 10 categorías
        return view('categories.index', compact('categories'));
    }


    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'required|string|max:500',
        ]);

        $category = Category::create($validated);

        return redirect()->route('categories.show', $category->id)
            ->with('success', 'Categoría creada exitosamente');
    }

    public function show(Category $category)
    {
        if (!session()->has('url_origen')) {
        session(['url_origen' => url()->previous()]);
        }
        
        $cultivations = $category->cultivationPublications()->with('user')->paginate(10);
        return view('categories.show', compact('category', 'cultivations'));
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable',
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')
            ->with('success', 'Categoría actualizada con éxito');
    }

    public function destroy(Category $category)
    {
        if ($category->cultivationPublications()->count() > 0) {
            return redirect()->route('categories.index')
                ->with('error', 'No se puede eliminar la categoría porque tiene publicaciones asociadas');
        }

        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Categoría eliminada con éxito');
    }
}
