<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CultivationPublication;
use App\Models\Category;
use Illuminate\Http\Request;

class CultivationController extends Controller
{
    public function index()
    {
        $posts = CultivationPublication::with(['user', 'category'])->latest()->paginate(10);
        return view('admin.cultivations.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.cultivations.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cropTitle' => 'required|string|max:255',
            'cropContent' => 'required|string',
            'idCategory' => 'nullable|exists:categories,id',
        ]);

        CultivationPublication::create([
            'idUser' => auth()->id(),
            'cropTitle' => $request->cropTitle,
            'cropContent' => $request->cropContent,
            'idCategory' => $request->idCategory,
            'creationDate' => now(),
        ]);

        return redirect()->route('admin.cultivations.index')->with('success', 'Publicación creada exitosamente.');
    }

    public function edit(CultivationPublication $cultivation)
    {
        $categories = Category::all();
        return view('admin.cultivations.edit', compact('cultivation', 'categories'));
    }

    public function update(Request $request, CultivationPublication $cultivation)
    {
        $request->validate([
            'cropTitle' => 'required|string|max:255',
            'cropContent' => 'required|string',
            'idCategory' => 'nullable|exists:categories,id',
        ]);

        $cultivation->update($request->only('cropTitle', 'cropContent', 'idCategory'));

        return redirect()->route('admin.cultivations.index')->with('success', 'Publicación actualizada.');
    }

    public function destroy(CultivationPublication $cultivation)
    {
        $cultivation->delete();

        return redirect()->route('admin.cultivations.index')->with('success', 'Publicación eliminada.');
    }
}