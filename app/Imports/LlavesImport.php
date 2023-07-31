<?php

namespace App\Imports;

use App\Models\Llave;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class LlavesImport implements ToCollection, WithHeadingRow, WithValidation
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
            $ambiente = DB::table('ambientes')->where('ambiente', Str::upper($row['nombre_ambiente']))->first();
            $llave = DB::table('llaves')->where('ambiente_id', $ambiente->id)->first();
            if(!$llave){
                Llave::create([
                    'ambiente_id'  => $ambiente->id,
                    'estado' => 'DISPONIBLE',
                    'ubicacion' => 'COORDINACIÓN',
                ]);
            }
        }
    }

    public function rules(): array
    {
        return [
            '*.nombre_ambiente' => [
                'string',
                'required'
            ]
        ];
    }
}
