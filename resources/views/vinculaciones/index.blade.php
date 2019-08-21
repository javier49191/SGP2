@extends('layouts.app')

@section('loader')
@include('partials.loader')
@endsection

@section('links')
@include('partials.ChartJS')
@endsection

@section('content')

<div class="container">
	<div class="row">
        {{-- ################ Vinculaciones ################ --}}
        <div class="col-lg-4">
           <div class="card" style="width: 100%;">
            <div class="card-header bg-info text-white">
             <b>Vinculaciones activas y no activas</b>
         </div>
         <div class="card-body">
             <canvas id="vinculaciones">
             </canvas>
             <h6>Total = {{$vinculados->count() + $Novinculados->count()}} vinculaciones</h6>
             <h6>Activas: {{$vinculados->count()}}</h6>
             <h6>Inactivas: {{$Novinculados->count()}}</h6>
         </div>
     </div>
 </div>
 {{-- ################ Fin Vinculaciones ################ --}}
 {{-- ################ Alumnos ################ --}}
 <div class="col-lg-4">
    <div class="card" style="width: 100%;">
        <div class="card-header bg-info text-white">
            <b>Alumnos vinculados y no vinculados</b>
        </div>
        <div class="card-body">
            <canvas id="alumnos">
            </canvas>
            <h6>Total = {{$alumnos->count()}} alumnos</h6>
            <h6>Vinculados: {{$AlumnosVinculados->count()}}</h6>
            <h6>No vinculados: {{$alumnos->count()-$AlumnosVinculados->count()}}</h6>
        </div>
    </div>
</div>
{{-- ################ Fin Alumnos ################ --}}
{{-- ################ Padrinos ################ --}}
<div class="col-lg-4">
    <div class="card" style="width: 100%;">
        <div class="card-header bg-info text-white">
            <b>Padrinos vinculados y no vinculados</b>
        </div>
        <div class="card-body">
            <canvas id="padrinos">
            </canvas>
            <h6>Total = {{$padrinos->count()}} padrinos</h6>
            <h6>Vinculados: {{$PadrinosVinculados->count()}}</h6>
            <h6>No vinculados: {{$padrinos->count()-$PadrinosVinculados->count()}}</h6>
        </div>
    </div>
</div>
{{-- ################ Fin Padrinos ################ --}}

</div>
{{-- ################ Tabla Vinculaciones activas ################ --}}
<div class="row mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <b>
                Vinculaciones activas
                </b>
                <a href="{{ route('vinculaciones.create') }}" class="btn btn-success float-right border">Crear vinculación</a>
            </div>
            <div class="card-body table-responsive">
                    <table id="activas" class="table table-bordered table-hover" style="width:100%">
                        <thead>
                            <th>Alumno</th>
                            <th>Padrino</th>
                            <th class="text-center">Fecha de vinculación</th>
                            <th class="text-center">Observaciones</th>
                        </thead>
                    </table>
                </div>
        </div>
    </div>
</div>
{{-- ################ Fin Tabla Vinculaciones activas ################ --}}

{{-- ################ Tabla Vinculaciones Incativas ################ --}}
<div class="row mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <b>Vinculaciones Inactivas</b>
            </div>
            <div class="card-body table-responsive">
                    <table id="inactivas" class="table table-bordered table-hover" style="width:100%">
                        <thead>
                            <th>Alumno</th>
                            <th>Padrino</th>
                            <th class="text-center">Fecha de vinculación</th>
                            <th class="text-center">Fecha de eliminación</th>
                            <th class="text-center">Observaciones</th>
                        </thead>
                    </table>
                </div>
        </div>
    </div>
</div>

{{-- ################ Fin Tabla Vinculaciones Incativas ################ --}}
</div>

@endsection

@section('scripts')
{{-- ##### Vinculaciones ##### --}}
<script>
	let myChart = document.getElementById('vinculaciones').getContext('2d');

	let myDoughnutChart = new Chart(myChart, {
        type: 'doughnut',
        data: {
            labels: [
            'Activas',
            'Inactivas',
            ],
            datasets: [{
                label: 'Activas y Inactivas',
                data: [
                {{$vinculados->count()}},
                {{$Novinculados->count()}}],
                backgroundColor: [
                'rgba(92, 184, 92, 0.8)',
                'rgba(217, 83, 79, 0.8)',
                ],
                borderColor: [],
                borderWidth: 2
            }]
        },

    });
</script>
{{-- ##### Alumnos ##### --}}
<script>
    let myChart2 = document.getElementById('alumnos').getContext('2d');

    let myPieChart2 = new Chart(myChart2, {
        type: 'pie',
        data: {
            labels: [
            'Vinculados',
            'No vinculados',
            ],
            datasets: [{
                label: 'Activas y no activas',
                data: [
                {{$AlumnosVinculados->count()}},
                {{$alumnos->count() - $AlumnosVinculados->count()}}],
                backgroundColor: [
                'rgba(92, 184, 92, 1)',
                'rgba(255, 99, 132, 1)',
                ],
                borderColor: [],
                borderWidth: 2
            }]
        },

    });
</script>
{{-- ##### Padrinos ##### --}}
<script>
    let myChart3 = document.getElementById('padrinos').getContext('2d');

    let myPieChart3 = new Chart(myChart3, {
        type: 'pie',
        data: {
            labels: [
            'Vinculados',
            'No vinculados',
            ],
            datasets: [{
                label: 'Activas y no activas',
                data: [
                {{$PadrinosVinculados->count()}},
                {{$padrinos->count() - $PadrinosVinculados->count()}}],
                backgroundColor: [
                'rgba(92, 184, 92, 1)',
                'rgba(255, 99, 132, 1)',
                ],
                borderColor: [
                // 'rgba(41, 43, 44, 0.8)',
                // 'rgba(41, 43, 44, 0.8)',
                ],
                borderWidth: 2
            }]
        },

    });
</script>

{{-- DataTable --}}

{{-- Activas --}}
@include('partials.DataTable')
 <script>
    $(document).ready( function () {
        $('#activas').DataTable({
            "lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "Todo"] ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
            },
            processing: true,
            serverSide: true,
            deferRender: true,
            ajax: '{{ url('vinculacionesDatatable') }}',
            columns: [
            {data: 'alumno', name: 'alumno'},
            {data: 'padrino', name: 'padrino'},
            {data: 'fecha_vinculacion', name: 'fecha_vinculacion'},
            {data: 'observaciones', name: 'observaciones'},
            ]
        });
    } );
</script>

{{-- Toastr --}}
@include('partials.alert')
{{-- Inactivas --}}
<script>
    $(document).ready( function () {
        $('#inactivas').DataTable({
            "lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "Todo"] ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
            },
            processing: true,
            serverSide: true,
            ajax: '{{ url('novinculadoDatatable') }}',
            columns: [
            {data: 'alumno', name: 'alumno'},
            {data: 'padrino', name: 'padrino'},
            {data: 'fecha_vinculacion', name: 'fecha_vinculacion'},
            {data: 'fecha_eliminacion', name: 'fecha_eliminacion'},
            {data: 'observaciones', name: 'observaciones'},
            ]
        });
    } );
</script>
@endsection