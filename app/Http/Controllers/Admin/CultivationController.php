<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CultivationPublication;
use Illuminate\Http\Request;

class CultivationController extends Controller
{
    public function index()
    {
        $cultivations = CultivationPublication::paginate(10);
        return view('admin.cultivations.index', compact('cultivations'));
    }

    public function edit(CultivationPublication $cultivation)
    {
        return view('admin.cultivations.edit', compact('cultivation'));
    }

    public function update(Request $request, CultivationPublication $cultivation)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $cultivation->update($request->only('title', 'content'));

        return redirect()->route('admin.cultivations.index')->with('success', 'Publicación actualizada.');
    }

    public function destroy(CultivationPublication $cultivation)
    {
        $cultivation->delete();
        return redirect()->route('admin.cultivations.index')->with('success', 'Publicación eliminada.');
    }
}

