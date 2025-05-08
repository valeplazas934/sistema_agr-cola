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
}
