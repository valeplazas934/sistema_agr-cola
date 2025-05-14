<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CultivationPublication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CultivationPublicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = CultivationPublication::with(['user', 'category', 'comments'])->latest()->get();

        return view('cultivations.index', compact('posts'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('cultivations.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cropTitle' => 'required|max:255',
            'cropContent' => 'required',
            'idCategory' => 'nullable|exists:categories,id',
        ]);

        CultivationPublication::create([
            'cropTitle' => $request->cropTitle,
            'cropContent' => $request->cropContent,
            'idUser' => Auth::id(),
            'idCategory' => $request->idCaregory,
        ]);

        return redirect()->route('cultivations.index')
            ->with('success', 'Publicación creada con éxito');
    }

    public function show(CultivationPublication $publication)
    {
        $publication->load(['user', 'comments.user', 'category']);
        return view('cultivations.show', compact('publication'));
    }

    public function edit(CultivationPublication $publication)
    {
        if (Auth::id() !== $publication->idUser) {
            return redirect()->route('cultivations.index')
                ->with('error', 'No estás autorizado para editar esta publicación');
        }

        $categories = Category::all();
        return view('cultivations.edit', compact('cultivation_publications', 'categories'));
    }

    public function update(Request $request, CultivationPublication $publication)
    {
        if (Auth::id() !== $publication->idUser) {
            return redirect()->route('cultivations.index')
                ->with('error', 'No estás autorizado para actualizar esta publicación');
        }

        $request->validate([
            'cropTitle' => 'required|max:255',
            'cropContent' => 'required',
            'idCategory' => 'nullable|exists:categories,id',
        ]);

        $publication->update([
            'cropTitle' => $request->cropTitle,
            'cropContent' => $request->cropContent,
            'idCategory' => $request->idCategory,
        ]);

        return redirect()->route('cultivations.show', $publication)
            ->with('success', 'Publicación actualizada con éxito');
    }

    public function destroy(CultivationPublication $publication)
    {
        if (Auth::id() !== $publication->idUser) {
            return redirect()->route('cultivations.index')
                ->with('error', 'No estás autorizado para eliminar esta publicación');
        }

        $publication->delete();

        return redirect()->route('cultivations.index')
            ->with('success', 'Publicación eliminada con éxito');
    }
}
