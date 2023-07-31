<?php

namespace App\Http\Controllers;

use App\Models\Ambiente;
use App\Models\Llave;
use Illuminate\Http\Request;
use App\Imports\ambientesImport;
use App\Imports\LlavesImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

/**
 * Class AmbienteController
 * @package App\Http\Controllers
 */
class AmbienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ambientes = Ambiente::paginate();

        return view('ambiente.index', compact('ambientes'))
            ->with('i', (request()->input('page', 1) - 1) * $ambientes->perPage());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Ambiente::$rules);

        if(Ambiente::create($request->all())){
            $ambiente = DB::table('ambientes')->where('ambiente', $request->ambiente)->first();
            Llave::create([
                'ambiente_id' => $ambiente->id,
                'estado' => 'DISPONIBLE',
                'ubicacion' => 'COORDINACIÓN',
            ]);
    
            return redirect()->route('ambientes.index')
                ->with('success', 'Ambiente created successfully.');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Ambiente $ambiente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ambiente $ambiente)
    {
        request()->validate(Ambiente::$rules);

        $ambiente->update($request->all());

        return redirect()->route('ambientes.index')
            ->with('success', 'Ambiente updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $ambiente = Ambiente::find($id)->delete();

        return redirect()->route('ambientes.index')
            ->with('success', 'Ambiente deleted successfully');
    }

    public function import(Request $request){
        $request->validate([
            'listaAmbientes' => 'required|mimes:xls,xlsx',
        ]);

        if(Excel::import(new ambientesImport, request()->file('listaAmbientes'))){
            Excel::import(new LlavesImport, request()->file('listaAmbientes'));
            return redirect()->route('ambientes.index')->with('success', 'successfully');
        }
    }
}
