<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    public function cultivationPublications() 
    { 
    return $this->hasMany(CultivationPublication::class, 'idUser'); 
    } 
    public function comments() 
    { 
    return $this->hasMany(Comment::class, 'idUser'); 
    } 
}
