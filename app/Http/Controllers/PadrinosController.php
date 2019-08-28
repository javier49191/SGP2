<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Padrino;
use App\Domicilio;
use App\Alumno;
use App\Vinculacione;
use Purifier;
use Yajra\DataTables\Datatables;

class PadrinosController extends Controller
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
        $padrinos = Padrino::all();
        $vinculacion = Vinculacione::whereNull('deleted_at')->get();
        return view('padrinos.index', compact('padrinos', 'vinculacion'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $alumnos = \DB::select (\DB::raw("SELECT * FROM alumnos WHERE NOT EXISTS (SELECT * FROM vinculaciones WHERE vinculaciones.alumno_id = alumnos.id)"));

        return view('padrinos.create', compact('alumnos'));
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
            'cuil' => 'required|numeric|digits_between:11,13',
            'email' => 'required|email',
            'telefono' => 'required|numeric',
            'segundo_telefono' => 'numeric',
            'contacto' => 'required',
            'calle' => 'required',
            'numero' => 'required|numeric',
            'provincia' => 'required',
            'ciudad' => 'required',
            'piso' => 'numeric',
            'observaciones' => 'min:2',
        ]);

        $data = $request->all();

        Domicilio::create([
            'calle' => $data['calle'],
            'numero' => $data['numero'],
            'provincia' => $data['provincia'],
            'ciudad' => $data['ciudad'],
            'dpto' => $data['dpto'],
            'piso' => $data['piso'],
        ]);

        if ($request['checklist']) {
            $data['checklist'] = 1;
        }else{
            $data['checklist'] = 0;
        }

        Padrino::create([
            'nombre' => $data['nombre'],
            'apellido' => $data['apellido'],
            'alias' => $data['alias'],
            'dni' => $data['dni'],
            'cuil' => $data['cuil'],
            'email' => $data['email'],
            'segundo_email' => $data['segundo_email'],
            'telefono' => $data['telefono'],
            'segundo_telefono' => $data['segundo_telefono'],
            'contacto' => $data['contacto'],
            'domicilio_id' => Domicilio::latest()->first()->id,
            'checklist' => $data['checklist'],
        ]);


        if (isset($data['alumno_id'])) {
            if ($request['se_conocen']) {
             $data['se_conocen'] = 1;
         }else{
            $data['se_conocen'] = 0;
        }

        Vinculacione::create([
            'alumno_id' => $data['alumno_id'],
            'padrino_id' => Padrino::latest()->first()->id,
            'se_conocen' => $data['se_conocen'],
            'observaciones' => Purifier::clean($data['observaciones']),
        ]);
    }


        // dd($data);

    return redirect()->route('padrinos.index')->with('info', 'Padrino creado!');

}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $padrino = Padrino::findOrFail($id);
        $vinculaciones = Vinculacione::where('padrino_id', $id)->whereNull('deleted_at')->get();
        return view('padrinos.show', compact('padrino','vinculaciones'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $padrino = Padrino::findOrFail($id);
        $domicilio = $padrino->domicilio;
        return view('padrinos.edit', compact('padrino','domicilio'));

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
        $padrino = Padrino::findOrFail($id);

        $this->validate($request, [
            'nombre' => 'required',
            'apellido' => 'required',
            'dni' => 'required|numeric|digits_between:8,10',
            'cuil' => 'required|numeric|digits_between:11,13',
            'email' => 'required|email',
            'segundo_email' => 'email',
            'telefono' => 'required|numeric',
            'segundo_telefono' => 'numeric',
            'contacto' => 'required',
            'calle' => 'required',
            'numero' => 'required|numeric',
            'provincia' => 'required',
            'ciudad' => 'required',
            'piso' => 'numeric',
            'observaciones' => 'min:2',
        ]);

        $domicilio = $padrino->domicilio;

        $domicilio->calle = $request->calle;
        $domicilio->numero = $request->numero;
        $domicilio->provincia = $request->provincia;
        $domicilio->ciudad = $request->ciudad;
        $domicilio->piso = $request->piso;
        $domicilio->save();

        if ($request['checklist']) {
            $padrino->checklist = 1;
        }else{
            $padrino->checklist = 0;
        }

        $padrino->nombre = $request->nombre;
        $padrino->apellido = $request->apellido;
        $padrino->alias = $request->alias;
        $padrino->dni = $request->dni;
        $padrino->cuil = $request->cuil;
        $padrino->email = $request->email;
        $padrino->segundo_email = $request->segundo_email;
        $padrino->telefono  = $request->telefono;
        $padrino->segundo_telefono = $request->segundo_telefono;
        $padrino->contacto = $request->contacto;
        $padrino->save();

        return redirect()->route('padrinos.index')->with('info', 'Padrino actualizado!');
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
        $padrinos = Padrino::all('nombre', 'apellido', 'alias', 'email', 'id');
        
        return Datatables::of($padrinos)
        ->editColumn('nombre', function(Padrino $padrino){
            return '<a href="'.route("padrinos.show", $padrino->id).'">'.$padrino->nombre.'</a>';
        })
        ->editColumn('apellido', function(Padrino $padrino){
            return $padrino->apellido;
        })
        ->editColumn('alias', function(Padrino $padrino){
            return $padrino->alias;
        })
        ->editColumn('email', function(Padrino $padrino){
            return $padrino->email;
        })
        ->editColumn('vinculado', function(Padrino $padrino){
            $vinculacion = Vinculacione::whereNull('deleted_at')->get();

            if (vinculado($vinculacion,'padrino_id', $padrino->id)){ 
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
