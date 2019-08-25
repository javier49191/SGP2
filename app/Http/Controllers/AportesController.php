<?php

namespace App\Http\Controllers;

use DB;
use App\Pago;
use App\Padrino;
use App\TiposPago;
use App\DetallesPago;
use App\AportesLaravel;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

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
        // $pagos = Pago::all('monto_pago', 'fecha_pago', 'created_at', 'user_id', 'padrino_id');
        // $pagos = Pago::query();
        // Pago::with('padrino', 'user', 'detallePago')
        $aportes = AportesLaravel::query();
        
        return Datatables::of($aportes)
        ->editColumn('nombre', function(AportesLaravel $aporte){
            return $aporte->nombre;
        })
        ->editColumn('monto_pago', function(AportesLaravel $aporte){
            return $aporte->monto_pago;
        })
        ->editColumn('fecha_pago', function(AportesLaravel $aporte){
            return $aporte->fecha_pago->format('d-m-Y');
        })
        ->editColumn('created_at', function(AportesLaravel $aporte){
            return $aporte->created_at->format('d-m-Y');
        })
        ->editColumn('name', function(AportesLaravel $aporte){
            return $aporte->name;
        })
        ->editColumn('descripcion', function(AportesLaravel $aporte){
            return $aporte->descripcion;
        })
        ->toJson();
    }
}
