<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CultivationPublication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'idCultivationPublication' => 'required|exists:cultivation_publications,id',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        Comment::create([
            'idUser' => Auth::id(),
            'idCultivationPublication' => $request->idCultivationPublication,
            'content' => $request->content,
            'parent_id' => $request->parent_id,
        ]);

        return back()->with('success', 'Comentario publicado.');
    }

    public function edit(Comment $comment)
    {
        if (Auth::id() !== $comment->idUser) {
            return redirect()->back()->with('error', 'No autorizado.');
        }

        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        if (Auth::id() !== $comment->idUser) {
            return redirect()->back()->with('error', 'No autorizado.');
        }

        $request->validate(['content' => 'required']);
        $comment->update(['content' => $request->content]);

        return redirect()->route('cultivations.show', $comment->idCultivationPublication)->with('success', 'Comentario actualizado.');
    }

    public function destroy(Comment $comment)
    {
        if (Auth::id() !== $comment->idUser) {
            return redirect()->back()->with('error', 'No autorizado.');
        }

        $comment->delete();
        return back()->with('success', 'Comentario eliminado.');
    }

    public function reply(Request $request, Comment $comment)
    {
        $request->validate([
            'reply' => 'required|string|max:1000',
        ]);

        $reply = new Comment();
        $reply->content = $request->input('reply');
        $reply->idUser = auth()->id();
        $reply->parent_id = $comment->id;
        $reply->idCultivationPublication= $comment->idCultivationPublication; // Asegúrate que esté en tu modelo
        $reply->save();

        return back()->with('success', 'Respuesta publicada correctamente.');
    }
}
