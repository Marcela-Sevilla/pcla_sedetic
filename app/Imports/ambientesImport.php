<?php

namespace App\Imports;

use App\Models\Ambiente;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ambientesImport implements ToCollection, WithHeadingRow, WithValidation
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
            if(!$ambiente){
                Ambiente::create([
                    'ambiente'  => Str::upper($row['nombre_ambiente']),
                    'ubicacion' => Str::upper($row['piso']),
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
            ],
            '*.piso' => [
                'string',
                'required'
            ]
        ];
    }
}
