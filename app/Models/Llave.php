<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Llave extends Model
{
    use HasFactory;
    
    static $rules = [
		'ambiente_id' => 'required',
		'estado' => 'required',
		'ubicacion' => 'required',
    ];

    protected $perPage = 20;

    protected $fillable = ['ambiente_id','estado','ubicacion'];
}
