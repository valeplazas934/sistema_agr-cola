<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'creationDate',
        'idUser',
        'idCultivationPublication',
        'parent_id',
    ];

    protected $casts = [
        'creationDate' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }

    public function cultivationPublication()
    {
        return $this->belongsTo(CultivationPublication::class, 'idCultivationPublication');
    }
    // Comment.php
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }
    
}
