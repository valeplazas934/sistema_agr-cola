<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, CultivationPublication 
    $publication) 
    { 
    $validated = $request->validate([ 
    'content' => 'required|string', 
    ]); 
    $comment = new Comment(); 
    $comment->content = $validated['content']; 
    $comment->idUser = auth()->id(); 
    $comment->idCultivationPublication = $publication->id; 
    $comment->save(); 
    return redirect()->route('publications.show', $publication) ->with('success', 'Comment added successfully.'); 
    } 
}
