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

        $cultivation = new CultivationPublication();
        $cultivation->cropTitle = $request->cropTitle;
        $cultivation->cropContent = $request->cropContent;
        $cultivation->idCategory = $request->idCategory;
        $cultivation->idUser = Auth::id(); // Aquí se asigna el autor autenticado
        $cultivation->save();

        return redirect()->route('cultivations.index')->with('success', '¡Publicación creada exitosamente!');
    }

    public function show(CultivationPublication $cultivation)
    {
        $cultivation->load(['user', 'comments.user', 'category']);
        return view('cultivations.show', compact('cultivation'));
    }

    public function edit(CultivationPublication $cultivation)
    {
        if (auth()->id() !== $cultivation->idUser) 
        return view('cultivations.edit', compact('cultivation'));

        $categories = Category::all();
        return view('cultivations.edit', [
            'cultivation' => $cultivation,
            'categories' => $categories
        ]);

    }

    public function update(Request $request, CultivationPublication $cultivation)
    {
        if (Auth::id() !== $cultivation->idUser) {
            return redirect()->route('cultivations.index');
        }

        $request->validate([
            'cropTitle' => 'required|max:255',
            'cropContent' => 'required',
            'idCategory' => 'nullable|exists:categories,id',
        ]);

        $cultivation->update([
            'cropTitle' => $request->cropTitle,
            'cropContent' => $request->cropContent,
            'idCategory' => $request->idCategory,
        ]);

        return redirect()->route('cultivations.show', $cultivation)
            ->with('success', 'Publicación actualizada con éxito');
    }

    public function destroy(CultivationPublication $cultivation)
    {
        if (Auth::id() !== $cultivation->idUser) {
            return redirect()->route('cultivations.index')
                ->with('error', 'No estás autorizado para eliminar esta publicación');
        }

        $cultivation->delete();

        return redirect()->route('cultivations.index')
            ->with('success', 'Publicación eliminada con éxito');
    }
}
