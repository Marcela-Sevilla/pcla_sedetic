<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Ambiente
 *
 * @property $id
 * @property $ambiente
 * @property $ubicacion
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Ambiente extends Model
{
    
    static $rules = [
		'ambiente' => 'required',
		'ubicacion' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['ambiente','ubicacion'];



}
