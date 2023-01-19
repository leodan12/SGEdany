@extends('base.content')
@section('styles')
<?php echo Html::script('js/alertas/jubilacion.js')?>
@endsection
@section('contenido')
<div class="container-fluid px-4">
    <div class="btn">
        <div class="col-xl-3 col-md-6">
            <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#modalAdd" onclick='limpiarModal();'>
                Agregar
            </button>
        </div>
    </div>
    <div class="modal fade" id="modalAdd"  name="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">NUEVA JUBILACIÓN</h5>
                </div>


                <div class="card-body">
                    <form method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <div class="form-floating mb- mb-md-0">
                                    <select class="form-select" name="colJub" id="colJub" class="form-control" required>
                                        @foreach ($colaboradores as $col)
                                            <option value="{{$col->idCol}}" >{{$col->per_apellidos}} {{$col->per_nombres}}</option>
                                        @endforeach
                                    </select>
                                    <label for="colNombres">Colaborador</label>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" onclick='guardar();'><strong> Guardar</strong></button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card mb-4">
            <div class="card-header">
                JUBILACIONES
            </div>
            <div class="card-body">
                <table class="table" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"> <i class="icon_profile"></i>Colaborador </th>
                            <th scope="col"> <i class="icon_profile"></i>Fecha Registro </th>
                            <th scope="col"> <i class="icon_profile"></i>Estado </th>
                            <th scope="col"><i class="icon_cogs"></i>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $cont=1 @endphp
                        @foreach ($jubilaciones as $jubilacion)
                        <tr>
                            <td scope="row">{{$cont}}</td>
                            <td >{{$jubilacion->per_apellidos}} {{$jubilacion->per_nombres}}</td>
                            <td >{{$jubilacion->jub_fecha}}</td>
                            <td>
                                @if ($jubilacion->jub_estado == 'activo')
                                <span class="badge bg-warning text-dark" >Activo</span>
                                @else
                                <span class="badge bg-dark">Inactivo</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-primary" onclick='modal({{$jubilacion->idJubilacion}});'><i class="fas fa-edit" style="color: white"></i></button>
                                    @if($jubilacion->jub_estado == 'activo')
                                        <button type="button" class="btn btn-danger" onclick="cambioEstado('inhabilitar',{{$jubilacion->idJubilacion}});"  placeholder="Inhabilitar"><i class="fas fa-times-circle"></i></button>
                                    @else
                                        <button type="button" class="btn btn-success" onclick="cambioEstado('habilitar',{{$jubilacion->idJubilacion}});"><i class="fas fa-check-circle"></i></button>
                                    @endif
                                </div>
                                <div class="modal fade" id="modalAct{{$jubilacion->idJubilacion}}" tabindex="-1" aria-labelledby="modalActLabel" aria-hidden="true">
                                    <div class="modal-dialog " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">ACTUALIZAR JUBILACION</h5>
                                            </div>


                                            <div class="card-body">
                                                <form method="POST">
                                                    @csrf
                                                    <div class="row mb-3">
                                                        <div class="col-md-8">
                                                            <div class="form-floating mb- mb-md-0">
                                                                <select class="form-select" name="colAct{{$jubilacion->idJubilacion}}" id="colAct{{$jubilacion->idJubilacion}}" class="form-control" required>
                                                                    @foreach ($AllCol as $colN)
                                                                       
                                                                        <option value="{{$colN->idCol}}" @if ($jubilacion->idCol==$colN->idCol) selected="true" @endif >{{$colN->per_apellidos}} {{$colN->per_nombres}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <label for="colAct">Colaborador</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-4">
                                                            <div class="form-floating mb- mb-md-0">
                                                                <input class="form-control" id="fechaAct{{$jubilacion->idJubilacion}}" name="fechaAct{{$jubilacion->idJubilacion}}" 
                                                                type="input" value="{{$jubilacion->jub_fecha}}" placeholder="Emitido el" disabled="true"/>
                                                                <label for="fechaAct">Fecha</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                                    <button type="button" class="btn btn-primary" onclick='actualizar({{$jubilacion->idJubilacion}});'><strong> Guardar</strong></button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                </form>
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