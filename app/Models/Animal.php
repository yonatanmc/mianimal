<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\database\Eloquent\Model;


class Animal extends Model
{
    protected $table = "animal";
    protected $fillable = [
        'nombre', 'especie', 'genero'
    ];

    public $timestamps = false;
   
}
