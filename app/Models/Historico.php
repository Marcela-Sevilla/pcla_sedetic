<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historico extends Model
{
    use HasFactory;

    static $rules = [
		'llave_id' => 'required',
		'instructor' => 'required',
		'user_id' => 'required',
		'funcionario_prestamo' => 'required',
		'fecha_prestamo' => 'required',
    ];

    protected $perPage = 20;

    protected $fillable = ['llave_id','instructor','user_id', 'funcionario_prestamo', 'fecha_prestamo'];
}
