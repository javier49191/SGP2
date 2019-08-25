<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alumno;
use Purifier;
use App\Vinculacione;
use Yajra\DataTables\Datatables;

class AlumnosController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vinculacion = Vinculacione::whereNull('deleted_at')->get();

        return view('alumnos.index', compact('vinculacion'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('alumnos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required',
            'apellido' => 'required',
            'dni' => 'required|numeric|digits_between:8,10',
            'grado' => 'required',
            'fecha_nacimiento' => 'required',
            'observaciones' => 'nullable|min:2'
        ]);

        $alumno = new Alumno;

        $alumno->nombre = $request->nombre;
        $alumno->alias = $request->alias;
        $alumno->apellido = $request->apellido;
        $alumno->dni = $request->dni;
        $alumno->grado = $request->grado;

        $date = date_create($request->fecha_nacimiento);
        $alumno->fecha_nacimiento = date_format($date, 'Y-m-d H:i:s');

        $alumno->observaciones = Purifier::clean($request->observaciones);

        if ($request['es_alumno']) {
            $alumno->es_alumno = 1;
        }else{
            $alumno->es_alumno = 0;
        }

        $alumno->save();
        return redirect()->route('alumnos.index')->with('info', 'Alumno creado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $alumno = Alumno::findOrFail($id);
        $vinculaciones = Vinculacione::where('alumno_id', $id)->whereNull('deleted_at')->get();
        return view('alumnos.show', compact('alumno', 'vinculaciones'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $alumno = Alumno::findOrFail($id);
        return view('alumnos.edit', compact('alumno'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $alumno = Alumno::findOrFail($id);

        $this->validate($request, [
            'nombre' => 'required',
            'apellido' => 'required',
            'dni' => 'required|numeric|digits_between:8,10',
            'grado' => 'required|numeric|min:1|max:6',
            'fecha_nacimiento' => 'required',
            'observaciones' => 'nullable|min:2'
        ]);

        $alumno->nombre = $request->nombre;
        $alumno->alias = $request->alias;
        $alumno->apellido = $request->apellido;
        $alumno->dni = $request->dni;
        $alumno->grado = $request->grado;

        $date = date_create($request->fecha_nacimiento);
        $alumno->fecha_nacimiento = date_format($date, 'Y-m-d H:i:s');

        $alumno->observaciones = Purifier::clean($request->observaciones);

        if ($request['es_alumno']) {
            $alumno->es_alumno = 1;
        }else{
            $alumno->es_alumno = 0;
        }

        $alumno->save();

        return redirect()->route('alumnos.index')->with('info', 'Alumno actualizado!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function datatable(){
        $alumnos = Alumno::all('nombre', 'apellido', 'alias', 'dni', 'id');
        
        return Datatables::of($alumnos)
        ->editColumn('nombre', function(Alumno $alumno){
            return '<a href="'.route("alumnos.show", $alumno->id).'">'.$alumno->nombre.'</a>';
        })
        ->editColumn('apellido', function(Alumno $alumno){
            return $alumno->apellido;
        })
        ->editColumn('alias', function(Alumno $alumno){
            return $alumno->alias;
        })
        ->editColumn('dni', function(Alumno $alumno){
            return $alumno->dni;
        })
        ->addColumn('vinculado', function(Alumno $alumno){
            $vinculacion = Vinculacione::whereNull('deleted_at')->get();

            if (vinculado($vinculacion,'alumno_id', $alumno->id)){ 
                return '<div class="text-center"><span class="badge badge-pill badge-success">Si</span></div>';
            }
            else{ 
                return '<div class="text-center"><span class="badge badge-pill badge-danger">No</span></div>';
            }
        })
        ->rawColumns(['nombre', 'vinculado'])
        ->toJson();
    }
}
