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
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $publications = CultivationPublication::with(['user', 'category'])
            ->latest()
            ->paginate(10);
        return view('publications.index', compact('publications'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('publications.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cropTitle' => 'required|max:255',
            'cropContent' => 'required',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        CultivationPublication::create([
            'cropTitle' => $request->cropTitle,
            'cropContent' => $request->cropContent,
            'idUser' => Auth::id(),
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('publications.index')
            ->with('success', 'Publicación creada con éxito');
    }

    public function show(CultivationPublication $publication)
    {
        $publication->load(['user', 'comments.user', 'category']);
        return view('publications.show', compact('publication'));
    }

    public function edit(CultivationPublication $publication)
    {
        if (Auth::id() !== $publication->idUser) {
            return redirect()->route('publications.index')
                ->with('error', 'No estás autorizado para editar esta publicación');
        }

        $categories = Category::all();
        return view('publications.edit', compact('publication', 'categories'));
    }

    public function update(Request $request, CultivationPublication $publication)
    {
        if (Auth::id() !== $publication->idUser) {
            return redirect()->route('publications.index')
                ->with('error', 'No estás autorizado para actualizar esta publicación');
        }

        $request->validate([
            'cropTitle' => 'required|max:255',
            'cropContent' => 'required',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $publication->update([
            'cropTitle' => $request->cropTitle,
            'cropContent' => $request->cropContent,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('publications.show', $publication)
            ->with('success', 'Publicación actualizada con éxito');
    }

    public function destroy(CultivationPublication $publication)
    {
        if (Auth::id() !== $publication->idUser) {
            return redirect()->route('publications.index')
                ->with('error', 'No estás autorizado para eliminar esta publicación');
        }

        $publication->delete();

        return redirect()->route('publications.index')
            ->with('success', 'Publicación eliminada con éxito');
    }
}
