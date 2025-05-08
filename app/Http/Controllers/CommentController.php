<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CultivationPublication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, CultivationPublication $publication)
    {
        $request->validate([
            'content' => 'required|max:1000',
        ]);

        Comment::create([
            'content' => $request->content,
            'idUser' => Auth::id(),
            'idCultivationPublication' => $publication->id,
        ]);

        return redirect()->route('publications.show', $publication)
            ->with('success', 'Comentario agregado con éxito');
    }

    public function destroy(Comment $comment)
    {
        if (Auth::id() !== $comment->idUser) {
            return back()->with('error', 'No estás autorizado para eliminar este comentario');
        }

        $publicationId = $comment->idCultivationPublication;
        $comment->delete();

        return redirect()->route('publications.show', $publicationId)
            ->with('success', 'Comentario eliminado con éxito');
    }
}