@extends('base.content')
@section('styles')
<?php echo Html::script('js/alertas/boleta.js')?>
@endsection
@section('contenido')
<div class="container-fluid px-4">

    <div class="row">
        <div class="card mb-4">
            <div class="card-header">
                BOLETAS
            </div>
            <div class="card-body">
                <table class="table" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th scope="col" style="text-align: center">Nro.</th>
                            <th scope="col">Periodo</th>
                            <th scope="col">Colaborador</th>
                            <th scope="col">Costo</th>
                            <th>Estado</th>
                            <th scope="col"><i class="fas fa-cogs"></i> Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $cont=1 @endphp
                        @foreach ($boletas as $bol)
                        <tr>
                            <td scope="row" style="text-align: center">{{$cont}}</td>
                            <td >{{$bol->Periodo}}</td>
                            <td >{{$bol->per_apellidos}} {{$bol->per_nombres}}</td>
                            <?php $total = $bol->remuneracionNeta +$bol->essalud +$bol->sctr ?>
                            <td >{{$total}}</td>
                            <td>
                                @if($bol->Bol_estado=='inactivo')
                                    <span class="badge bg-dark" >Inactivo</span>
                                @else
                                    <span class="badge bg-warning text-dark">Activo</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-primary" onclick="location.href='{{Route('boleta.ver',$bol->idBoleta)}}'"><i class="fas fa-eye" style="color: white"></i></button>
                                    <button type="button" class="btn btn-success" onclick="imprimir({{$bol->idBoleta}})"><i class="fas fa-print"></i></button>
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
