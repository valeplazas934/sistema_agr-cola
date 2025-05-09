<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, Comment $comment)
    {
        // El usuario puede eliminar sus propios comentarios o comentarios en sus publicaciones
        return $user->id === $comment->id_user || 
               $user->id === $comment->cultivationPublication->id_user;
    }
}