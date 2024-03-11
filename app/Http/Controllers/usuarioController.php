<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\usuario;
use App\Models\monstruo;

//use DB;
//use Illuminate\Support\Facades\Validator;
//use App\Http\Requests\StoretgrifoRequest;
//use App\Http\Requests\UpdatetgrifoRequest;

class usuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function login()     {   return view(    'atrib_login'       ); }

    public function registrar() {   return view(    'atrib_registrar'   ); }

    public function logout() {
        session(['usuario' => null]);
        return redirect('/login');
    }

    public function inicio(Request $request) {
        if (session()->has('usuario')) {
            $Usuario = DB::table('tusuario as U')
                ->where('U.id', session('usuario'))
                ->first();
            $Mutantes = DB::table('tmonstruo as M')
                ->join('tusuario as U', 'M.idUsuario', '=', 'U.id')
                ->select(
                    'U.id as idU',
                    'M.id as idM',
                    'M.nombre as nombre',
                    'M.especie as especie',
                    'M.saludMax as saludMax',
                    'M.seleccion as seleccion',
                    'M.apariencia as apariencia',
                    'M.nivel as nivel',
                    'M.at1dano      as at1dano',
                    'M.at1energia   as at1energia',
                    'M.at1alcance   as at1alcance',
                    'M.at1casillas  as at1casillas',
                )
                ->where('U.id', session('usuario'))
                ->get();

            $MutantesSeleccionados = DB::table('tmonstruo as M')
                ->join('tusuario as U', 'M.idUsuario', '=', 'U.id')
                ->select(
                    'U.id as idU',
                    'M.id as idM',
                    'M.nombre as nombre',
                    'M.especie as especie',
                    'M.saludMax as saludMax',
                    'M.apariencia as apariencia',
                    'M.nivel as nivel',

                    'M.at1dano      as at1dano',
                    'M.at1energia   as at1energia',
                    'M.at1alcance   as at1alcance',
                    'M.at1casillas  as at1casillas',
                )
                ->where('U.id', session('usuario'))
                ->where('M.seleccion', 1)
                ->get();

            return view('atrib_inicio', ['usuario' => $Usuario, 'mutantes' => $Mutantes, 'mutantesSel' => $MutantesSeleccionados]); // Pasar $Usuario a la vista
        }
        else return redirect('/login');
    }

    public function arena(Request $request) {
        if (session()->has('usuario')) {
            $Usuario = DB::table('tusuario as U')
                ->where('U.id', session('usuario'))
                ->first();
            $MutantesSeleccionados = DB::table('tmonstruo as M')
                ->join('tusuario as U', 'M.idUsuario', '=', 'U.id')
                ->select(
                    'U.id as idU',
                    'M.id as idM',
                    'M.nombre as nombre',
                    'M.especie as especie',
                    'M.saludMax as saludMax',
                    'M.apariencia as apariencia',
                    'M.nivel as nivel',

                    'M.at1dano      as at1dano',
                    'M.at1energia   as at1energia',
                    'M.at1alcance   as at1alcance',
                    'M.at1casillas  as at1casillas',
                )
                ->where('U.id', session('usuario'))
                ->where('M.seleccion', 1)
                ->get();
            return view('atrib_arena', ['usuario' => $Usuario, 'mutantesSel' => $MutantesSeleccionados]); // Pasar $Usuario a la vista
        }
        else return redirect('/login');
    }

    public function tiendaM(Request $request) {
        if (session()->has('usuario')) {
            $Usuario = DB::table('tusuario as U')
                ->where('U.id', session('usuario'))
                ->first();
            return view('atrib_tienda_mutantes', ['usuario' => $Usuario]); // Pasar $Usuario a la vista
        }
        else return redirect('/login');
    }

    public function configuraciones(Request $request) {
        if (session()->has('usuario')) {
            $Usuario = DB::table('tusuario as U')
                ->where('U.id', session('usuario'))
                ->first();
            return view('atrib_configuraciones', ['usuario' => $Usuario]); // Pasar $Usuario a la vista
        }
        else return redirect('/login');
    }

    public function prueba() {
            return view('prueba');
    }

    public function prueba2() {
        if (session()->has('usuario')) return view('prueba2');
        else return redirect('/login');
    }

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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'nombre'    => 'required',
            'correo'    => 'required',
            'pass'      => 'required',
            'passConf'  => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'res' => false,
                'mensaje' => $validator->errors()->first()." : faltan Datos",
            ], 200);
        }
        if($request->pass == $request->passConf){
            $usuario = new usuario;
            $usuario->nombre       = $request->nombre;
            $usuario->correo       = $request->correo;
            $usuario->pass         = $request->pass;
            $usuario->nivel        = 0;
            $usuario->esmopins     = 0;
            $usuario->cromens      = 0;
            $usuario->boletos      = 0;
            $usuario->parcelas     = 1;
            $usuario->mundoActual  = 0;
            $usuario->save();
            session(['usuario' => $usuario->id]);
            return redirect('/inicio');
        }
        else {
            return response()->json([
                'res'=> false,
                'mensaje' => 'ERROR: la contraseña no fue validada'
            ],200);
        }
    }

    public function session(Request $request)
    {
        //session_start();
        $rules = [
            'nombre'    => 'required',
            'pass'      => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'res' => false,
                'mensaje' => $validator->errors()->first()." : faltan Datos",
            ], 200);
        }
        $verUsuario = DB::table('tusuario as U')
            ->where('U.nombre', $request->nombre)
            ->first();
        if($verUsuario == NULL){
            return response()->json([
                'mensaje' => 'No existe el usuario...'
            ],200);
        }
        elseif($verUsuario->pass == $request->pass){
            //$_SESSION['usuario'] = $verUsuario->id;
            session(['usuario' => $verUsuario->id]);
            return redirect('/inicio');
            /*return response()->json([
                'usuario' => $verUsuario,
                'mensaje' => 'Usuario '.$_SESSION['usuario'].' logueado correctamente !!!'
            ],200);*/
        }
        else {
            return response()->json([
                'res'=> false,
                'mensaje' => 'ERROR: la contraseña no es correcta'
            ],200);
        }
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $usuario=usuario::find($id);
        // Si no existe mostramos error.
        if (!$usuario)
        {
            return response()->json([
                'res'=> false,
                'mensaje'=>'No se encuentra un usuario con ese código.'
            ],200);
        }
        if (!$request->nombre)
        {
            return response()->json([
                'res'=> false,
                'mensaje'=>'Faltan valores para completar el procesamiento.'
            ],200);
        }
        // Si no hay errores, continúa con el proceso de guardado
        //esto llama a la funcion guardar imagen dentro de helpers
        $usuario->nombre = $request->nombre;
        //guardarImagen($request);
        if ($request->hasFile('foto')) {
            echo "se encontro la foto";
            $imagen = $request->file('foto'); // Obtener el archivo de la solicitud
            if ($imagen->isValid()) {
                $nombreImagen = time() . '_' . $request->nombre . '.' . $imagen->guessExtension(); // Generar un nombre único para la imagen -- getUniqueName()
                $ruta = public_path('img/usuarios/'); // Almacenar la imagen en la carpeta 'public/img/usuarios'
                $imagen->move($ruta, $nombreImagen);
                $usuario->foto = $nombreImagen;
            }
            else {
                return response()->json([
                    'res' => false,
                    'mensaje' => 'El archivo de imagen no es válido.'
                ], 200);
            }
        }
        $usuario->save();
        return redirect('/configuraciones');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
