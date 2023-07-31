<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $rolId = DB::table('model_has_roles')->where('model_id', '=', Auth::user()->id)->first();
        $rol = DB::table('roles')->where('id', '=', $rolId->role_id)->first();
        session(['rol' => $rol->name]);

        if($rol->name == 'instructor'){
            $prestamos = DB::table('estados')
            ->join('llaves', 'estados.llave_id', '=', 'llaves.id')
            ->join('ambientes', 'llaves.ambiente_id', '=', 'ambientes.id')
            ->where('instructor', Auth::user()->name)
            ->select('estados.instructor', 'ambientes.ambiente', 'ambientes.ubicacion', 'llaves.estado', 'estados.id', 'llaves.id as llaves_id')
            ->get();

            $estado = $prestamos ? true : false;

            return view('home', ['prestamos' => $prestamos], ['estado' => $estado]);
        }else{
            $ambientes = DB::table('llaves')->get();

            $totalDisponibles=0;
            $totalOcupados=0;
            foreach ($ambientes as $ambiente) {
                if($ambiente->estado == 'DISPONIBLE'){
                    $totalDisponibles++;
                }else{
                    $totalOcupados++;
                }
            }

            session(['totalAmbientes' => $ambientes->count()]);
            session(['ambientesDisponibles' => $totalDisponibles]);
            session(['ambientesOcupados' => $totalOcupados]);

            $prestamos = DB::table('estados')
            ->join('llaves', 'estados.llave_id', '=', 'llaves.id')
            ->join('ambientes', 'llaves.ambiente_id', '=', 'ambientes.id')
            ->select('estados.instructor', 'ambientes.id as ambiente_id', 'ambientes.ambiente', 'ambientes.ubicacion', 'llaves.estado', 'estados.id', 'llaves.id as llaves_id')
            ->get();

            return view('home', ['prestamos' => $prestamos]);
        }
        

        
    }
}
