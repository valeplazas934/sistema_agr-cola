<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CultivationPublicationController extends Controller
{
    public function index()
    {
        $publications = CultivationPublication::with('user')->latest()->paginate(10);
        return view('publications.index', compact('publications'));
    }

    public function create()
    {
        return view('publications.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'cropTitle' => 'required|string|max:255',
            'cropContent' => 'required|string',
        ]);

        CultivationPublication::create([
            'cropTitle' => $validated['cropTitle'],
            'cropContent' => $validated['cropContent'],
            'creationDate' => now(),
            'idUser' => auth()->id(),
        ]);

        return redirect()->route('publications.index')->with('success', 'Publicación creada exitosamente');
    }

    public function show(CultivationPublication $publication)
    {
        $publication->load(['user', 'comments.user']);
        return view('publications.show', compact('publication'));
    }

    public function edit(CultivationPublication $publication)
    {
        $this->authorize('update', $publication);
        return view('publications.edit', compact('publication'));
    }

    public function update(Request $request, CultivationPublication $publication)
    {
        $this->authorize('update', $publication);

        $validated = $request->validate([
            'cropTitle' => 'required|string|max:255',
            'cropContent' => 'required|string',
        ]);

        $publication->update([
            'cropTitle' => $validated['cropTitle'],
            'cropContent' => $validated['cropContent'],
        ]);

        return redirect()->route('publications.show', $publication)->with('success', 'Publicación actualizada exitosamente');
    }

    public function destroy(CultivationPublication $publication)
    {
        $this->authorize('delete', $publication);
        $publication->delete();
        return redirect()->route('publications.index')->with('success', 'Publicación eliminada exitosamente');
    }
}
