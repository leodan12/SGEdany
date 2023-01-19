@extends('base.content')
@section('styles')
<?php echo Html::script('js/alertas/planilla.js')?>
@endsection
@section('contenido')
<div class="container-fluid px-4">
    
    <div class="col-xl-6 col-md-12">
        <button type="button" class="btn btn-primary"  onclick="location.href='{{Route('planilla.nuevo')}}'">
            Agregar Actual
        </button>
    </div>
  

    <div class="row">
        <div class="card mb-4">
            <div class="card-header">
                PLANILLAS
            </div>
            <div class="card-body">
                <table class="table" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th scope="col" style="text-align: center">Nro.</th>
                            <th scope="col">Periodo</th>
                            <th scope="col">Tipo</th>
                            <th>Costo</th>
                            <th scope="col">Registrado el:</th>
                            <th scope="col"><i class="fas fa-cogs"></i> Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $cont=1 @endphp
                        @foreach ($planillas as $plan)
                        <tr>
                            <td scope="row" style="text-align: center">{{$cont}}</td>
                            <td >{{$plan->Periodo}}</td>
                            <td >{{$plan->TP_nombre}}</td>
                            <td>S/{{$plan->Plan_costo}}</td>
                            <td >{{$plan->Plan_registro}}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-primary" onclick="location.href='{{Route('planilla.ver',$plan->idPlanilla)}}'"><i class="fas fa-eye" style="color: white"></i></button>
                                    <button type="button" class="btn btn-success" onclick="imprimir({{$plan->idPlanilla}});" placeholder="Inhabilitar"><i class="fas fa-print"></i></button>
                                </div>
                            </td>
                        </tr>
                        @php $cont++ @endphp
                        @endforeach
                    </tbody>
                </table> 
            </div>
        </div>  
    </div>
</div>
@endsection
