@extends('base.content')
@section('styles')
<?php echo Html::script('js/alertas/presupuesto.js')?>
@endsection
@section('contenido')
<div class="container-fluid px-4">
    <div class="btn">
        <div class="col-xl-3 col-md-6">
            <button type="button" class="btn btn-primary"  onclick="location.href='{{Route('presupuesto.registrar')}}'">
                Agregar
            </button>
        </div>
    </div>
    <div class="row">
        <div class="card mb-4">
            <div class="card-header">
                PRESUPUESTOS
            </div>
            <div class="card-body">
                <table  class="table" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"> Nro. Presupuesto </th>
                            <th scope="col">Cliente </th>
                            <th scope="col">Concepto</th>
                            <th scope="col">Total</th>
                            <th scope="col">Fecha </th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $cont=1 @endphp
                        @foreach ($presupuestos as $presupuesto)
                        <tr>
                            <td scope="row">{{$cont}}</td>
                            <td >{{$presupuesto->codPresupuesto}}</td>
                            @if ($tipo[$cont-1] == 'empresa')
                                <td >{{$presupuesto->NombreComercial}}</td>
                            @else
                            <td >{{$presupuesto->per_apellidos}} {{$presupuesto->per_nombres}}</td>
                            @endif
                            <td>{{$presupuesto->concepto}}</td>
                            <td >{{$presupuesto->costoTotal}}</td>
                            <?php $registro = date_format(date_create(strval($presupuesto->fechaRealizacion)),'d-m-Y')?>
                            <td >{{$registro}}</td>
                            <td>
                                @if($presupuesto->pres_estado =='activo')
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-primary"  onclick="location.href='{{Route('presupuesto.visualizar',$presupuesto->idPresupuesto)}}'"><i class="fas fa-eye" style="color: white"></i></button>
                                        
                                        <button type="button" class="btn btn-danger"  onclick="cambioEstado({{$presupuesto->idPresupuesto}})"><i class="fas fa-trash-alt" style="color: rgb(161, 26, 26)"></i></button>
                                    </div>
                                @else
                                    <span class="badge bg-dark" >Eliminado</span>
                                @endif

                                <div class="modal fade" id="modalDelete{{$presupuesto->idPresupuesto}}" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">ELIMINAR PRESUPUESTO</h5>
                                            </div>

                                            <div class="modal-body">
                                                ¿Desea eliminar el presupuesto én N° {{$presupuesto->codPresupuesto}}?
                                            </div>


                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">NO</button>
                                                <button type="submit" class="btn btn-primary"
                                                onclick="location.href='{{Route('presupuesto.delete',$presupuesto->idPresupuesto)}}'"><strong>
                                                    SI</strong></button>
                                            </div>

                                        </div>
                                    </div>
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
