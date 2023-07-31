<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UsersImport implements ToCollection, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            $usuario = DB::table('users')->where('email', $row['numero_identificacion'])->first();
            if(!$usuario){
                User::create([
                    'name'     => Str::upper($row['nombre_funcionario']),
                    'email'    => $row['numero_identificacion'], 
                    'password' => Hash::make($row['numero_identificacion']),
                ]);
            }
        }
    }

    public function rules(): array
    {
        return [
            '*.nombre_funcionario' => [
                'string',
                'required'
            ],
            '*.cargo_funcionario' => [
                'string',
                'required'
            ],
            '*.numero_identificacion' => [
                'integer',
                'required'
            ]
        ];
    }
}
