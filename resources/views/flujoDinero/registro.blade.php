@extends('base.content')
@section('styles')
<?php echo Html::script('js/alertas/flujoDinero.js')?>
<?php echo Html::script('js/autocomplete/flujoDinero.js')?>
@endsection
@section('contenido')
<div class="container-fluid px-4">
    <div class="btn">
        <div class="col-xl-3 col-md-6">
            <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#modalAdd" onclick='limpiarModal(); cargarNombre();'>
                Agregar
            </button>
        </div>
    </div>
    <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">NUEVO MOVIMIENTO</h5>
                </div>


                <div class="card-body">
                    <form method="POST">
                        @csrf
                        <div class="row mb-3">
                            <h5>Datos Colaborador</h5>
                            <div class="col-md-4">
                                <div class="form-floating mb- mb-md-0">
                                    <select class="form-select" name="dni" id="dni" class="form-control" onchange='cargarNombre();' required>
                                        @foreach ($colaboradores as $col)
                                            <option value="{{$col->idCol}}">{{$col->per_dni}}</option>
                                        @endforeach
                                    </select>
                                    <label for="idCol">DNI</label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="nombre" name="nombre"
                                    type="text" placeholder="Monto"/>
                                    <label for="nombre">Nombre</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <h5>Datos Movimiento</h5>
                            <div class="col-md-6">
                                <div class="form-floating mb- mb-md-0">
                                    <select class="form-select" name="tipo" id="tipo" class="form-control" required>
                                        @foreach ($tipos as $tipo)
                                            <option value="{{$tipo->idTipoFlujo}}">{{$tipo->TF_nombre}}</option>
                                        @endforeach
                                    </select>
                                    <label for="dni">Tipo Movimiento</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="monto" name="monto"
                                    type="text" placeholder="Monto"/>
                                    <label for="monto">Monto</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="fecha" name="fecha"
                                    type="date" placeholder="Fecha"/>
                                    <label for="fecha">Fecha Adelanto</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="reg" name="reg"
                                    type="date" value="{{$hoy}}" placeholder="Registrado" disabled/>
                                    <label for="reg">Registrado el</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-floating mb- mb-md-0">
                                    <textarea class="form-control" id="motivo" 
                                     name="motivo" style="min-height:100px;"></textarea>
                                    <label for="motivo">Motivo</label>
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
                INGRESOS Y EGRESOS
            </div>
            <div class="card-body">
                <table class="table" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th scope="col" style="text-align: center">Nro.</th>
                            <th scope="col">Colaborador</th>
                            <th>Tipo Movimiento</th>
                            <th scope="col">Monto</th>
                            <th>Motivo</th>
                            <th scope="col">Fecha</th>
                            <th>Estado</th>
                            <th scope="col"><i class="fas fa-cogs"></i> Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $cont=1 @endphp
                        @foreach ($movimientos as $mov)
                        <tr>
                            <td scope="row" style="text-align: center">{{$cont}}</td>
                            <td >{{$mov->per_apellidos}} {{$mov->per_nombres}}</td>
                            <td >{{$mov->TF_nombre}}</td>
                            <td >{{$mov->Flu_monto}}</td>
                            <td >{{$mov->Flu_motivo}}</td>
                            <?php $registro = date_format(date_create(strval($mov->Flu_fecha)),'d-m-Y')?>
                            <td>{{$registro}}</td>
                            <td>
                                @if($mov->Flu_estado=='activo')
                                    <span class="badge bg-warning text-dark" >Activo</span>
                                @else
                                    <span class="badge bg-dark">Inactivo</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-primary" onclick='modal({{$mov->idFlujo}});'><i class="fas fa-edit" style="color: white"></i></button>
                                    @if($mov->Flu_estado=='activo')
                                        <button type="button" class="btn btn-danger" onclick="cambioEstado('inhabilitar',{{$mov->idFlujo}});" placeholder="Inhabilitar"><i class="fas fa-times-circle"></i></button>
                                    @else
                                        <button type="button" class="btn btn-success" onclick="cambioEstado('habilitar',{{$mov->idFlujo}});" ><i class="fas fa-check-circle"></i></button>
                                    @endif
                                </div>
                                <div class="modal fade" id="modalAct{{$mov->idFlujo}}" tabindex="-1" aria-labelledby="modalActLabel" aria-hidden="true">
                                    <div class="modal-dialog " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">ACTUALIZAR MOVIMIENTO</h5>
                                            </div>


                                            <div class="card-body">
                                                <form method="POST">
                                                    @csrf
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb- mb-md-0">
                                                                <select class="form-select" name="dni{{$mov->idFlujo}}" id="dni{{$mov->idFlujo}}" class="form-control" required>
                                                                    @foreach ($colaboradores as $col)
                                                                        <option value="{{$col->idCol}}" @if($mov->idCol==$col->idCol)selected="true" @endif >{{$col->per_dni}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <label for="dni">DNI</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb- mb-md-0">
                                                                <select class="form-select" name="tipo{{$mov->idFlujo}}" id="tipo{{$mov->idFlujo}}" class="form-control" required>
                                                                    @foreach ($tipos as $tipo)
                                                                        <option value="{{$tipo->idTipoFlujo}}" @if($mov->idTipoFlujo==$tipo->idTipoFlujo)selected="true" @endif >{{$tipo->TF_nombre}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <label for="dni">Tipo Movimiento</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb- mb-md-0">
                                                                <input class="form-control"  id="monto{{$mov->idFlujo}}" name="monto{{$mov->idFlujo}}"
                                                                type="text" value="{{$mov->Flu_monto}}" placeholder="Monto"/>
                                                                <label for="monto">Monto</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb- mb-md-0">
                                                                <input class="form-control"  id="fecha{{$mov->idFlujo}}" name="fecha{{$mov->idFlujo}}"
                                                                type="date" value="{{$mov->Flu_fecha}}" placeholder="Fecha"/>
                                                                <label for="fecha">Fecha Adelanto</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb- mb-md-0">
                                                                <input class="form-control"  id="reg{{$mov->idFlujo}}" name="reg{{$mov->idFlujo}}"
                                                                type="date" value="{{$hoy}}" placeholder="Registrado" disabled/>
                                                                <label for="reg">Registrado el</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                    <div class="col-md-12">
                                                            <div class="form-floating mb- mb-md-0">
                                                                <textarea class="form-control" id="motivo{{$mov->idFlujo}}" 
                                                                name="motivo{{$mov->idFlujo}}" style="min-height:100px;">{{$mov->Flu_motivo}}</textarea>
                                                                <label for="motivo">Motivo</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="btn btn-primary" onclick='actualizar({{$mov->idFlujo}});'><strong> Guardar</strong></button>
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
