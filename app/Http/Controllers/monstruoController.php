<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\usuario;
use App\Models\monstruo;

class monstruoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        $rules = [
            'nombreM'    => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'res' => false,
                'mensaje' => $validator->errors()->first()." : faltan Datos",
            ], 200);
        }
        $id = $request->input('id');
        $usuario=usuario::find($id);
        // Si no existe mostramos error.
        if (!$usuario)
        {
            return response()->json([
                'res'=> false,
                'mensaje'=>'No se encuentra un usuario con ese código.'
            ],200);
        }
        $mostruo = new monstruo;
        $mostruo->nombre     = $request->nombreM;
        $mostruo->especie    = $request->especie;
        $mostruo->saludMax   = $request->saludMax;
        $mostruo->energiaMax = $request->energiaMax;
        $mostruo->cargaTurno = $request->cargaTurno;
        $mostruo->apariencia = $request->apariencia;
        $mostruo->nivel      = 0;
        $mostruo->seleccion  = 0;

        $mostruo->at1dano       = $request->at1;
        $mostruo->at1energia    = $request->at2;
        $mostruo->at1alcance    = $request->at3;
        $mostruo->at1casillas   = $request->at4;

        $mostruo->idUsuario  = $id;
        $mostruo->save();
        $usuario->esmopins -= 100;
        $usuario->save();
        return redirect('/inicio');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $monstruo = monstruo::find($id);
        // Si no existe mostramos error.
        if (!$monstruo) {
            return response()->json([
                'res'=> false,
                'mensaje'=>'No se encuentra un mutante con ese código.'
            ],200);
        }
        if (!$request->nombreM) {
            return response()->json([
                'res'=> false,
                'mensaje'=>'Faltan valores para completar el procesamiento (no hay un nombre ingresado).'
            ],200);
        }
        $monstruo->nombre = $request->nombreM;
        $monstruo->save();
        return redirect('/inicio');
    }
    public function seleccion(Request $request, $id)
    {
        $MutantesSeleccionados = DB::table('tmonstruo as M')
            ->join('tusuario as U', 'M.idUsuario', '=', 'U.id')
            ->where('U.id', session('usuario'))
            ->where('M.seleccion', 1)
            ->get();
        $cant = count($MutantesSeleccionados);
        $monstruo = monstruo::find($id);
        // Si no existe mostramos error.
        if (!$monstruo) {
            return response()->json([
                'res'=> false,
                'mensaje'=>'No se encuentra un mutante con ese código.'
            ],200);
        }
        if ($monstruo->seleccion == 0) {
            if ($cant < 4) {
                $monstruo->seleccion = 1;
                $monstruo->save();
                return redirect('/inicio');
            }
            else {
                return response()->json([
                    'res'=> false,
                    'mensaje'=>'ya tienes el maximo de mutantes seleccionados'
                ],200);
            }
        }
        else if ($monstruo->seleccion == 1) {
            $monstruo->seleccion = 0;
            $monstruo->save();
            return redirect('/inicio');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
