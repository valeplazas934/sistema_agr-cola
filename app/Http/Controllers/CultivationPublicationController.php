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
        $posts = CultivationPublication::with(['user', 'category', 'comments'])
                    ->latest()
                    ->paginate(10); // ✅ Esto habilita el método links()

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
            'cropTitle' => 'required|string|max:255',
            'cropContent' => 'required|string',
            'idCategory' => 'nullable|exists:categories,id',
        ]);

        $publication = new CultivationPublication();
        $publication->cropTitle = $request->cropTitle;
        $publication->cropContent = $request->cropContent;
        $publication->idCategory = $request->idCategory;
        $publication->idUser = Auth::id(); // Aquí se asigna el autor autenticado
        $publication->save();

        return redirect()->route('cultivations.index')->with('success', '¡Publicación creada exitosamente!');
    }

    public function show(CultivationPublication $publication)
    {
        $publication->load(['user', 'comments.user', 'category']);
        return view('cultivations.show', compact('publication'));
    }

    public function edit(CultivationPublication $publication)
    {
        if (auth()->id() !== $publication->idUser) {
        abort(403, 'No estás autorizado para editar esta publicación');
        }
        return view('cultivations.edit', compact('publication'));

        $categories = Category::all();
        return view('cultivations.edit', [
            'publication' => $publication,
            'categories' => $categories
        ]);

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
