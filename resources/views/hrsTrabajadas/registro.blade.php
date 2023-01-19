@extends('base.content')
@section('styles')
<?php echo Html::script('js/alertas/hrsTrabajadas.js')?>
<?php echo Html::script('js/autocomplete/hrsTrabajadas.js')?>
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
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">NUEVO JORNADA LABORAL</h5>
                </div>


                <div class="card-body">
                    <form method="POST" >
                        @csrf
                        <div class="row mb-3">
                            <h5>Datos Colaborador</h5>
                            <div class="col-md-4">
                                <div class="form-floating mb- mb-md-0">
                                    <select class="form-select" name="dni" id="dni" class="form-control"  onchange='cargarNombre();' required>
                                        @foreach ($colaboradores as $col)
                                            <option value="{{$col->idCol}}">{{$col->per_dni}}</option>
                                        @endforeach
                                    </select>
                                    <label for="dni">DNI</label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="nombre" name="nombre"
                                    type="text" placeholder="Nombre"/>
                                    <label for="monto">Nombre</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <h5>Datos Jornada</h5>
                            <div class="col-md-4">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="fecha" name="fecha"
                                    type="date" placeholder="Tipo"/>
                                    <label for="fecha">Fecha</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="inicio" name="inicio"
                                    type="time" placeholder="Tipo"/>
                                    <label for="codDoc">Hora Inicio</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="fin" name="fin"
                                    type="time" placeholder="Tipo"/>
                                    <label for="codDoc">Hora Fin</label>
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
                HORAS TRABAJADAS
            </div>
            <div class="card-body">
                <table class="table" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th scope="col" style="text-align: center">Nro.</th>
                            <th scope="col">Colaborador</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Hora Inicio</th>
                            <th scope="col">Hora Fin</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Estado</th>
                            <th scope="col"><i class="fas fa-cogs"></i> Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $cont=1 @endphp
                        @foreach ($hrs as $hra)
                        <tr>
                            <td scope="row" style="text-align: center">{{$cont}}</td>
                            <td >{{$hra->per_apellidos}} {{$hra->per_nombres}}</td>
                            <?php $reg = date("d/m/Y",strtotime($hra->Hrs_fecha))?>
                            <td >{{$reg}}</td>
                            <td >{{$hra->Hra_inicio}}</td>
                            <td >{{$hra->Hra_fin}}</td>
                            <td >{{$hra->Hrs_cantidad}}</td>
                            <td>
                                @if($hra->hrs_estado=='activo')
                                    <span class="badge bg-warning text-dark" >Activo</span>
                                @else
                                    <span class="badge bg-dark">Inactivo</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-primary" onclick='modal({{$hra->idHrs}});'><i class="fas fa-edit" style="color: white"></i></button>
                                    @if($hra->hrs_estado=='activo')
                                        <button type="button" class="btn btn-danger" onclick="cambioEstado('inhabilitar',{{$hra->idHrs}});" placeholder="Inhabilitar"><i class="fas fa-times-circle"></i></button>
                                    @else
                                        <button type="button" class="btn btn-success" onclick="cambioEstado('habilitar',{{$hra->idHrs}});" ><i class="fas fa-check-circle"></i></button>
                                    @endif
                                </div>
                                <div class="modal fade" id="modalAct{{$hra->idHrs}}" tabindex="-1" aria-labelledby="modalActLabel" aria-hidden="true">
                                    <div class="modal-dialog " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">ACTUALIZAR REGISTRO DE HORAS TRABAJADAS</h5>
                                            </div>


                                            <div class="card-body">
                                                <form method="POST">
                                                    @csrf
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb- mb-md-0">
                                                                <select class="form-select" name="dni{{$hra->idHrs}}" id="dni{{$hra->idHrs}}" class="form-control" required>
                                                                    @foreach ($colaboradores as $col)
                                                                        <option value="{{$col->idCol}}" @if($hra->idCol==$col->idCol) selected="true" @endif>{{$col->per_dni}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <label for="dni">DNI colaborador</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb- mb-md-0">
                                                                <input class="form-control"  id="fecha{{$hra->idHrs}}" name="fecha{{$hra->idHrs}}"
                                                                type="date" value="{{$hra->Hrs_fecha}}" placeholder="Tipo"/>
                                                                <label for="fecha">Fecha</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-4">
                                                            <div class="form-floating mb- mb-md-0">
                                                                <input class="form-control"  id="inicio{{$hra->idHrs}}" name="inicio{{$hra->idHrs}}"
                                                                type="time" value="{{$hra->Hra_inicio}}" placeholder="Tipo"/>
                                                                <label for="codDoc">Hora Inicio</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-floating mb- mb-md-0">
                                                                <input class="form-control"  id="fin{{$hra->idHrs}}" name="fin{{$hra->idHrs}}"
                                                                type="time" value="{{$hra->Hra_fin}}" placeholder="Tipo"/>
                                                                <label for="codDoc">Hora Fin</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="btn btn-primary" onclick='actualizar({{$hra->idHrs}});'><strong> Guardar</strong></button>
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
