<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Pago;
use App\Padrino;
use App\TiposPago;
use App\DetallesPago;
use Carbon\Carbon;
use Yajra\DataTables\Datatables;

class AportesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        Carbon::setLocale('es');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagos = Pago::all();

        // $agrupados = \DB::select (\DB::raw("SELECT YEAR(fecha_pago), SUM(monto_pago) as suma FROM pagos GROUP BY YEAR(fecha_pago)"));

        $agrupados = DB::table('pagos')
        ->select(DB::raw("YEAR(fecha_pago) as year, SUM(monto_pago) as monto"))
        ->groupBy('year')
        ->get();

        // dd($routes->all());
        return view('aportes.index', compact('pagos', 'agrupados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $padrinos = Padrino::all();
        $tipos = TiposPago::all();

        return view('aportes.create', compact('padrinos', 'tipos'));
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
            'monto_pago' => 'required|numeric',
            'padrino_id' => 'required',
            'fecha_pago' => 'required',
            'tipo_pago_id' => 'required',
            'factura' => 'required|numeric',
            'comprobante' => 'required|numeric',
            'descripcion' => 'required',
        ],[
            'padrino_id.required' => 'Debe elegir un padrino',
            'tipo_pago_id.required' => 'Debe elegir un medio de pago',
        ]);

        $data = $request->all();

        DetallesPago::create([
            'tipo_pago_id' => $data['tipo_pago_id'],
            'factura' => $data['factura'],
            'comprobante' => $data['comprobante'],
            'descripcion' => $data['descripcion'],
        ]);

        $date = date_create($data['fecha_pago']);

        Pago::create([
            'monto_pago' => $data['monto_pago'],
            'detalle_pago_id' => DetallesPago::latest()->first()->id,
            'padrino_id' => $data['padrino_id'],
            'fecha_pago' => date_format($date, 'Y-m-d H:i:s'),
            'user_id' => \Auth::user()->id,
        ]);

        return redirect()->route('aportes.index')->with('info', 'Aporte creado!');
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
        $pagos = Pago::all();

        return Datatables::of($pagos)
        ->addColumn('padrino', function(Pago $pago){
            return $pago->padrino->nombre;
        })
        ->addColumn('fecha_pago', function(Pago $pago){
            return $pago->fecha_pago->format('d-m-Y');
        })
        ->addColumn('created_at', function(Pago $pago){
            return $pago->created_at->format('d-m-Y');
        })
        ->addColumn('usuario', function(Pago $pago){
            return $pago->user->name;
        })
        ->addColumn('tipoPago', function(Pago $pago){
            return $pago->detallePago->tipoPago->descripcion;
        })
        ->toJson();
    }
}
