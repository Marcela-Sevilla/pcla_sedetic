<?php

namespace App\Imports;

use App\Models\model_has_role;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class modelHasRoleImport implements ToCollection, WithHeadingRow
{
    private $model;

    public function __construct()
    {
        $this->model = User::pluck('id', 'email');
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            if(Str::upper($row['cargo_funcionario']) == 'ADMINISTRATIVO'){
                $modelRole = DB::table('model_has_roles')->where('model_id', $this->model[$row['numero_identificacion']])->first();
                if(!$modelRole){
                    model_has_role::create([
                        'role_id' => 2,
                        'model_type' => 'App\Models\User', 
                        'model_id' => $this->model[$row['numero_identificacion']],
                    ]);
                }
            }elseif(Str::upper($row['cargo_funcionario']) == 'VIGILANTE'){
                $modelRole = DB::table('model_has_roles')->where('model_id', $this->model[$row['numero_identificacion']])->first();
                if(!$modelRole){
                    model_has_role::create([
                        'role_id' => 3,
                        'model_type' => 'App\Models\User', 
                        'model_id' => $this->model[$row['numero_identificacion']],
                    ]);
                }
            }else{
                $modelRole = DB::table('model_has_roles')->where('model_id', $this->model[$row['numero_identificacion']])->first();
                if(!$modelRole){
                    model_has_role::create([
                        'role_id' => 4,
                        'model_type' => 'App\Models\User', 
                        'model_id' => $this->model[$row['numero_identificacion']],
                    ]);
                } 
            }
        }
    }
}
