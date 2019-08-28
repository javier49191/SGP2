<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EstadosFinanciero;
use App\EstadosLaravel;
use App\Padrino;
use Yajra\DataTables\Facades\DataTables;

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
        // $padrinos = Padrino::query('id', 'nombre', 'apellido', 'alias');
        $estados = EstadosLaravel::all();
        
        return Datatables::of($estados)
        ->editColumn('nombre', function(EstadosLaravel $estado){
            return '<a href="'.route("padrinos.show", $estado->padrino_id).'">'.$estado->nombre.'</a>';
        })
        ->editColumn('apellido', function(EstadosLaravel $estado){
            return $estado->apellido;
        })
        ->editColumn('alias', function(EstadosLaravel $estado){
            return $estado->alias;
        })
        ->editColumn('pagas', function(EstadosLaravel $estado){
            return '<div class="text-center">'.$estado->pagas.'</div>';
        })
        ->editColumn('pendientes', function(EstadosLaravel $estado){
            return '<div class="text-center">'.$estado->pendientes.'</div>';
        })
        ->editColumn('monto_total', function(EstadosLaravel $estado){
            return '<div class="text-center">'.$estado->monto_total.'</div>';
        })
        ->editColumn('estado', function(EstadosLaravel $estado){
            $estados2 = EstadosFinanciero::all();

            // return '<span class="badge badge-pill '.claseEstado($estados2, 'cantidad_cuotas',pendientes($estado->pagas)).'">'.estadoFinanciero($estados2, 'cantidad_cuotas', pendientes($estado->pendientes)).'</span>';
            return '<span class="badge badge-pill '.claseEstado($estados2, 'cantidad_cuotas',pendientes($estado->pagas)).'">'.estadoFinanciero($estados2, 'cantidad_cuotas', pendientes($estado->pagas)).'</span>';
        })
        ->rawColumns(['nombre', 'pagas', 'estado','pendientes', 'monto_total'])
        ->toJson();
    }
}
