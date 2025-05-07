<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CultivationPublication extends Model
{
    public function user() 
{ 
return $this->belongsTo(User::class, 'idUser'); 
} 
public function comments() 
{ 
return $this->hasMany(Comment::class, 
'idCultivationPublication'); 
}
}
