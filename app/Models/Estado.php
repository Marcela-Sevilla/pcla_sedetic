<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

    static $rules = [
		'llave_id' => 'required',
		'instructor' => 'required',
		'user_id' => 'required',
    ];

    protected $perPage = 20;

    protected $fillable = ['llave_id','instructor','user_id'];
}
