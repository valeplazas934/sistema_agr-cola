<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CultivationPublication extends Model
{
    use HasFactory;

    protected $fillable = [
        'cropTitle',
        'cropContent',
        'idUser',
        'idCategory',
        'creationDate',
    ];

    protected $casts = [
        'creationDate' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'idCategory');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'idCultivationPublication');
    }
    
    public function readComment()
    {
        return $this->comments;
    }
}
