@extends('base.content')
@section('styles')
<?php echo Html::script('js/alertas/adelanto.js')?>
<?php echo Html::script('js/autocomplete/adelanto.js')?>
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
    <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">NUEVO ADELANTO</h5>
                </div>


                <div class="card-body">
                    <form method="POST">
                        @csrf
                        <div class="row mb-3">
                            <h5>Datos Colaborador</h5>
                            <div class="col-md-3">
                                <div class="form-floating mb- mb-md-0">
                                    <select class="form-select" name="dni" id="dni" class="form-control" onchange='cargarNombre();' required>
                                        @foreach ($colaboradores as $col)
                                            <option value="{{$col->idCol}}">{{$col->per_dni}}</option>
                                        @endforeach
                                    </select>
                                    <label for="dni">DNI</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="nombre" name="nombre"
                                    type="text" placeholder="Monto"/>
                                    <label for="monto">Nombre</label>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row mb-3">
                        <h5>Datos Adelanto</h5>
                            <div class="col-md-4">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="monto" name="monto"
                                    type="text" placeholder="Monto"/>
                                    <label for="monto">Monto</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="fecha" name="fecha"
                                    type="date" placeholder="Fecha"/>
                                    <label for="fecha">Fecha Adelanto</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="reg" name="reg"
                                    type="date" value="{{$hoy}}" placeholder="Registrado" disabled/>
                                    <label for="reg">Registrado el</label>
                                </div>
                            </div>
                            
                        </div>
                        <button type="button" class="btn btn-primary" onclick='verificar();'><strong> Guardar</strong></button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card mb-4">
            <div class="card-header">
                ADELANTOS
            </div>
            <div class="card-body">
                <table class="table" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th scope="col" style="text-align: center">Nro.</th>
                            <th scope="col">Colaborador</th>
                            <th scope="col">Monto</th>
                            <th scope="col">Fecha</th>
                            <th>Estado</th>
                            <th scope="col"><i class="fas fa-cogs"></i> Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $cont=1 @endphp
                        @foreach ($adelantos as $adel)
                        <tr>
                            <td scope="row" style="text-align: center">{{$cont}}</td>
                            <td >{{$adel->per_apellidos}} {{$adel->per_nombre}}</td>
                            <td >{{$adel->Adel_monto}}</td>
                            <?php $registro = date_format(date_create(strval($adel->Adel_fecha)),'d-m-Y')?>
                            <td >{{$registro}}</td>
                            <td>
                                @if($adel->adel_estado=='activo')
                                    <span class="badge bg-warning text-dark" >Activo</span>
                                @else
                                    <span class="badge bg-dark">Inactivo</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-primary" onclick='modal({{$adel->idAdelanto}});'><i class="fas fa-edit" style="color: white"></i></button>
                                    @if($adel->adel_estado == 'activo')
                                        <button type="button" class="btn btn-danger" onclick="cambioEstado('inhabilitar',{{$adel->idAdelanto}});" placeholder="Inhabilitar"><i class="fas fa-times-circle"></i></button>
                                    @else
                                        <button type="button" class="btn btn-success" onclick="cambioEstado('habilitar',{{$adel->idAdelanto}});" ><i class="fas fa-check-circle"></i></button>
                                    @endif
                                </div>
                                <div class="modal fade" id="modalAct{{$adel->idAdelanto}}" tabindex="-1" aria-labelledby="modalActLabel" aria-hidden="true">
                                    <div class="modal-dialog " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">ACTUALIZAR ADELANTO</h5>
                                            </div>


                                            <div class="card-body">
                                                <form method="POST">
                                                    @csrf
                                                        <div class="row mb-3">
                                                            <div class="col-md-6">
                                                                <div class="form-floating mb- mb-md-0">
                                                                    <select class="form-select" name="dni{{$adel->idAdelanto}}" id="dni{{$adel->idAdelanto}}" class="form-control" required>
                                                                        @foreach ($colaboradores as $col)
                                                                            <option value="{{$col->idCol}}" @if($adel->idCol==$col->idCol) selected="true" @endif>{{$col->per_dni}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <label for="dni">DNI colaborador</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-floating mb- mb-md-0">
                                                                    <input class="form-control"  id="monto{{$adel->idAdelanto}}" name="monto{{$adel->idAdelanto}}"
                                                                    type="text" value="{{$adel->Adel_monto}}" placeholder="Tipo"/>
                                                                    <label for="monto">Monto</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-6">
                                                                <div class="form-floating mb- mb-md-0">
                                                                    <input class="form-control"  id="fecha{{$adel->idAdelanto}}" name="fecha{{$adel->idAdelanto}}"
                                                                    type="date" value="{{$adel->Adel_fecha}}" placeholder="Tipo"/>
                                                                    <label for="fecha">Fecha Adelanto</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-floating mb- mb-md-0">
                                                                    <input class="form-control"  id="reg{{$adel->idAdelanto}}" name="reg{{$adel->idAdelanto}}"
                                                                    type="date" value="{{$adel->Adel_registro}}" placeholder="Tipo" disabled/>
                                                                    <label for="reg">Ultima Modificación</label>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                        <button type="button" class="btn btn-primary" onclick='actualizar({{$adel->idAdelanto}});'><strong> Guardar</strong></button>
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
