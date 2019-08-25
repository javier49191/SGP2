<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EstadosFinanciero;
use App\Padrino;
use Yajra\DataTables\Datatables;

class EstadosFinancierosController extends Controller
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
        $padrinos = Padrino::all('id');
        $estados = EstadosFinanciero::all('id', 'nombre', 'cantidad_cuotas');
        return view('estados.index', compact('padrinos', 'estados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
        // $padrinos = Padrino::all('id', 'nombre', 'apellido', 'alias');
        $padrinos = Padrino::query('id', 'nombre', 'apellido', 'alias');
        
        return Datatables::of($padrinos)
        ->addColumn('nombre', function(Padrino $padrino){
            return '<a href="'.route("padrinos.show", $padrino->id).'">'.$padrino->nombre.'</a>';
        })
        ->addColumn('apellido', function(Padrino $padrino){
            return $padrino->apellido;
        })
        ->addColumn('alias', function(Padrino $padrino){
            return $padrino->alias;
        })
        ->addColumn('cuotas_pagas', function(Padrino $padrino){
            return '<div class="text-center">'.$padrino->pagos->count().'</div>';
        })
        ->addColumn('cuotas_pendientes', function(Padrino $padrino){
            return '<div class="text-center">'.pendientes($padrino->pagos->count()).'</div>';
        })
        ->addColumn('monto_total', function(Padrino $padrino){
            return '<div class="text-center">'.$padrino->pagos->pluck('monto_pago')->sum().'</div>';
        })
        ->addColumn('estado', function(Padrino $padrino){
            $estados = EstadosFinanciero::all();

            return '<span class="badge badge-pill '.claseEstado($estados, 'cantidad_cuotas',pendientes($padrino->pagos->count())).'">'.estadoFinanciero($estados, 'cantidad_cuotas', pendientes($padrino->pagos->count())).'</span>';
        })
        ->rawColumns(['nombre', 'estado', 'cuotas_pagas', 'cuotas_pendientes', 'monto_total'])
        ->toJson();
    }
}
