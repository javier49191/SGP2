<?php

namespace App\Http\Controllers;

use App\Vinculacione;
use App\Alumno;
use App\Padrino;
use Illuminate\Http\Request;
use Yajra\DataTables\Datatables;

class VinculacionesController extends Controller
{
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
        $user = \Auth::user();
        $this->authorize('pass', $user);

        $vinculados = Vinculacione::whereNull('deleted_at')->get();

        $Novinculados = Vinculacione::whereNotNull('deleted_at')->get();
        
        $AlumnosVinculados = Vinculacione::distinct()->whereNull('deleted_at')->get(['alumno_id']);
        
        $PadrinosVinculados = Vinculacione::distinct()->whereNull('deleted_at')->get(['padrino_id']);
        
        $alumnos = Alumno::all('id');
        $padrinos = Padrino::all('id');

        return view('vinculaciones.index', compact('vinculados', 'Novinculados', 'AlumnosVinculados', 'PadrinosVinculados', 'alumnos', 'padrinos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = \Auth::user();
        $this->authorize('pass', $user);

        $alumnos = \DB::select (\DB::raw("SELECT * FROM alumnos WHERE NOT EXISTS (SELECT * FROM vinculaciones WHERE vinculaciones.alumno_id = alumnos.id)"));
        $padrinos = Padrino::all();

        return view('vinculaciones.create', compact('alumnos', 'padrinos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = \Auth::user();
        $this->authorize('pass', $user);

        $this->validate($request, [
            'padrino_id' => 'required',
            'alumno_id' => 'required',
        ]);

        $vinculacion = new Vinculacione;
        $vinculacion->padrino_id = $request->padrino_id;
        $vinculacion->alumno_id = $request->alumno_id;

        if ($request['se_conocen']) {
            $vinculacion->se_conocen = 1;
        }else{
            $vinculacion->se_conocen = 0;
        }

        $vinculacion->observaciones = "Creado por ".\Auth::user()->name;
        
        $vinculacion->save();

        return redirect()->route('vinculaciones.index')->with('info', 'Vinculación creada!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vinculacione  $vinculacione
     * @return \Illuminate\Http\Response
     */
    public function show(Vinculacione $vinculacione)
    {
        $user = \Auth::user();
        $this->authorize('pass', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vinculacione  $vinculacione
     * @return \Illuminate\Http\Response
     */
    public function edit(Vinculacione $vinculacione)
    {
        $user = \Auth::user();
        $this->authorize('pass', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vinculacione  $vinculacione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vinculacione $vinculacione)
    {
        $user = \Auth::user();
        $this->authorize('pass', $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vinculacione  $vinculacione
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vinculacione $vinculacione)
    {
        $vinculacione->deleted_at = date("Y-m-d H:i:s");
        $vinculacione->observaciones = 'Borrado por '. \Auth::user()->name;
        $vinculacione->save();
        return back();
    }

    public function datatable(){

        $vinculados = Vinculacione::whereNull('deleted_at')->get();
        
        return Datatables::of($vinculados)
        ->addColumn('alumno', function(Vinculacione $vinculado){
            return '<a href="'.route("alumnos.show", $vinculado->alumno->id).'">'.$vinculado->alumno->nombre.'</a>';
        })
        ->addColumn('padrino', function(Vinculacione $vinculado){
            return '<a href="'.route("padrinos.show", $vinculado->padrino->id).'">'.$vinculado->padrino->nombre.'</a>';
        })
        ->addColumn('fecha_vinculacion', function(Vinculacione $vinculado){
            return '<div class="text-center">'.$vinculado->created_at->format('d-m-Y').'<span> ('.$vinculado->created_at->diffForHumans().')</span>'.'</div>';
        })
        ->addColumn('observaciones', function(Vinculacione $vinculado){
            return '<div class="text-center">'.$vinculado->observaciones.'</div>';
        })
        ->rawColumns(['alumno', 'padrino', 'fecha_vinculacion', 'observaciones'])
        ->toJson();
    }

    public function datatablenv(){

        $Novinculados = Vinculacione::whereNotNull('deleted_at')->get();
        
        return Datatables::of($Novinculados)
        ->addColumn('alumno', function(Vinculacione $vinculado){
            return '<a href="'.route("alumnos.show", $vinculado->alumno->id).'">'.$vinculado->alumno->nombre.'</a>';
        })
        ->addColumn('padrino', function(Vinculacione $vinculado){
            return '<a href="'.route("padrinos.show", $vinculado->padrino->id).'">'.$vinculado->padrino->nombre.'</a>';
        })
        ->addColumn('fecha_vinculacion', function(Vinculacione $vinculado){
            return '<div class="text-center">'.$vinculado->created_at->format('d-m-Y').'<span> ('.$vinculado->created_at->diffForHumans().')</span>'.'</div>';
        })
        ->addColumn('fecha_eliminacion', function(Vinculacione $vinculado){
            return '<div class="text-center">'.$vinculado->deleted_at->format('d-m-Y').'<span> ('.$vinculado->deleted_at->diffForHumans().')</span>'.'</div>';
        })
        ->addColumn('observaciones', function(Vinculacione $vinculado){
            return '<div class="text-center">'.$vinculado->observaciones.'</div>';
        })
        ->rawColumns(['alumno', 'padrino', 'fecha_vinculacion', 'fecha_eliminacion', 'observaciones'])
        ->toJson();
    }
}
