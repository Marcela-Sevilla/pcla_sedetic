<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Imports\UsersImport;
use App\Imports\modelHasRoleImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class FuncionarioController extends Controller
{
    public function index()
    {
        $usuarios = DB::table('users')
        ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
        ->where('model_has_roles.role_id','!=', 1)
        ->select('users.*','model_has_roles.role_id')
        ->get();


        return view('funcionario.index', ['usuarios' => $usuarios]);
    }

    public function import(Request $request){
        $request->validate([
            'listaFuncionarios' => 'required|mimes:xls,xlsx',
        ]);

        if(Excel::import(new UsersImport, request()->file('listaFuncionarios'))){
            Excel::import(new modelHasRoleImport, request()->file('listaFuncionarios'));
            return redirect()->route('funcionarios')->with('success', 'successfully');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required | string | min:15',
            'identificacion' => 'required | integer',
            'rol' => 'required',
        ]);

        $usuarioExit = DB::table('users')->where('email', $request->identificacion)->first();
        if(!$usuarioExit){
            $usuario = User::create([
                'name' => $request->nombre,
                'email' => $request->identificacion,
                'password' => Hash::make($request->identificacion),
            ]);
            switch ($request->rol) {
                case 'ADMINISTRATIVO':
                    $rol = "administrador_prestamos";
                    break;
                case 'INSTRUCTOR':
                    $rol = "instructor";
                    break;
                case 'VIGILANTE':
                    $rol = "vigilante";
                    break;
            }
            $usuario->assignRole($rol);
        }else{
            return redirect()->route('funcionarios')->with('error', 'el usuario ya existe');
        }
        return redirect()->route('funcionarios')->with('success', 'successfully');
        
    }

    public function update(Request $request)
    {
        $request->validate([
            'nombre' => 'required | string | min:15',
            'identificacion' => 'required | integer',
            'rol' => 'required',
        ]);

        $user = User::find($request->id);
        $user->update([
            'name' => $request->nombre, 
            'email' => $request->identificacion, 
            'password' => Hash::make($request->identificacion)
        ]);

        switch ($request->rol) {
            case 'ADMINISTRATIVO':
                $rol = 2;
                break;
            case 'INSTRUCTOR':
                $rol = 4;
                break;
            case 'VIGILANTE':
                $rol = 3;
                break;
        }  

        $model_has_roles = DB::table('model_has_roles')
            ->where('model_id', $request->id)
            ->update(['role_id' => $rol]);

        return redirect()->route('funcionarios')->with('success', 'updated successfully');
    }

    public function destroy($id, $rol)
    {
        $deletedFuncionario = DB::table('users')->where('id', '=', $id)->delete();
        $deletedModel = DB::table('model_has_roles')->where('model_id', '=', $id)->delete();
        return redirect()->route('funcionarios')->with('success', 'Deleted successfully');
    }
}
