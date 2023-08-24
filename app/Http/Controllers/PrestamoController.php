<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use App\Models\Historico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PrestamoController extends Controller
{
    public function instructoresList(Request $request){
        $instructores = DB::table('users')
        ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
        ->where('model_has_roles.role_id', '=',4)
        ->where('users.name', 'LIKE', $request->instructor.'%')
        ->select('users.name')
        ->get();
        return response(json_encode($instructores),200)->header('Content-type','text/plain');
    }

    public function ambientesList(Request $request){
        $ambientes = DB::table('ambientes')
        ->join('llaves', 'ambientes.id', '=', 'llaves.ambiente_id')
        ->where('ambientes.ambiente', 'LIKE', $request->ambiente.'%')
        ->select('ambientes.ambiente', 'llaves.id')
        ->get();
        return response(json_encode($ambientes),200)->header('Content-type','text/plain');
    }

    public function store(Request $request){
        date_default_timezone_set('America/Bogota');

        $request->validate([
            'instructor' => 'required',
            'ambiente' => 'required',
        ]);

        $fechaActual = date("d").'/'.date("m").'/'.date("Y").' H:'.date("g").':'.date("i").''.date("a");

        $instructor = DB::table('estados')->where('instructor', $request->instructor)->first();
        $llave = DB::table('llaves')->where('id', $request->ambiente_id)->first();

        if(!$instructor){
            if($llave->estado == 'DISPONIBLE'){
                Estado::create([
                    'llave_id' => $request->ambiente_id,
                    'instructor' => $request->instructor,
                    'user_id' => Auth::user()->id,
                    'fecha_prestamo' => $fechaActual
                ]);
    
                $llaveUpdate = DB::table('llaves')
                    ->where('id', $request->ambiente_id)
                    ->update([
                        'estado' => 'OCUPADO',
                        'ubicacion' => 'EN EL AMBIENTE'
                    ]);
        
                return redirect()->route('home')
                        ->with('success', 'Prestamo created successfully.');
            }
            
                return redirect()->route('home')
                    ->with('error', 'Ambiente no Disponible.');
        }
        return redirect()->route('home')
            ->with('error2', 'El instructor tiene un ambiente pendiente');
        
    }

    public function update(Request $request){
        $request->validate([
            'instructor' => 'required',
            'ambiente' => 'required',
        ]);

        $prestamoActual =  DB::table('estados')
        ->where('id', $request->estado_id)
        ->get();

        if($prestamoActual[0]->instructor !== $request->instructor || $prestamoActual[0]->llave_id !== $request->llaves_id){

            $prestamo = DB::table('estados')
            ->where('id', $request->estado_id)
            ->update([
                'llave_id' => $request->ambiente_id,
                'instructor' => $request->instructor,
                'user_id' => Auth::user()->id
                ]);

            $ambienteModificado = DB::table('llaves')
            ->where('id', $request->llaves_id)
            ->update([
                'estado' => 'DISPONIBLE',
                'ubicacion' => 'COORDINACIÓN',
            ]);

            $llaveUpdate = DB::table('llaves')
                ->where('id', $request->ambiente_id)
                ->update([
                    'estado' => 'OCUPADO',
                    'ubicacion' => 'EN EL AMBIENTE'
                ]);

            return redirect()->route('home')
            ->with('success', 'Prestamo update successfully.');
        }
        
        return redirect()->route('home');
        
    }

    public function cambiarEstado($estado_id){
        date_default_timezone_set('America/Bogota');
        
        $prestamos = DB::table('estados')
        ->join('users', 'estados.user_id', '=', 'users.id')
        ->where('estados.id','=',$estado_id)
        ->select('estados.llave_id', 'estados.instructor', 'users.name', 'estados.fecha_prestamo')
        ->get();

        $fechaActual = date("d").'/'.date("m").'/'.date("Y").' H:'.date("g").':'.date("i").''.date("a");

        Historico::create([
            'llave_id' => $prestamos[0]->llave_id,
            'instructor' => $prestamos[0]->instructor,
            'user_id' => Auth::user()->id,
            'funcionario_prestamo' => $prestamos[0]->name,
            'fecha_prestamo' => $prestamos[0]->fecha_prestamo,
            'fecha_devolucion' => $fechaActual
        ]);

        $ubicacion = session('rol') == 'vigilante' ? 'PORTERIA' : 'COORDINACIÓN'; 
        $llaveUpdate = DB::table('llaves')
            ->where('id', $prestamos[0]->llave_id)
            ->update([
                'estado' => 'DISPONIBLE',
                'ubicacion' => $ubicacion
            ]);

        $deletedPrestamo = DB::table('estados')->where('id', '=', $estado_id)->delete();

        return redirect()->route('home')
            ->with('success', 'Cambio de estado update successfully.');
    }

    public function solicitarEntrega($estado_id){
        $prestamos = DB::table('estados')
        ->where('estados.id','=',$estado_id)
        ->select('estados.llave_id')
        ->get();

        $llaveUpdate = DB::table('llaves')
            ->where('id', $prestamos[0]->llave_id)
            ->update([
                'estado' => 'PENDIENTE'
            ]);

        return redirect()->route('home')
            ->with('success', 'Cambio de estado update successfully.');
    }

    public function historial(){
        $historial = DB::table('historicos')
        ->join('users', 'historicos.user_id', '=', 'users.id')
        ->join('llaves', 'historicos.llave_id', '=', 'llaves.id')
        ->join('ambientes', 'llaves.ambiente_id', '=', 'ambientes.id')
        ->select('historicos.instructor', 'ambientes.ambiente', 'llaves.ubicacion', 'historicos.funcionario_prestamo', 'historicos.fecha_prestamo', 'historicos.fecha_devolucion', 'users.name')
        ->get();

        return view('historial', ['historial' => $historial]);
    }
}
