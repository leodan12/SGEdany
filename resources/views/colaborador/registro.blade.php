@extends('base.content')
@section('styles')
<?php echo Html::script('js/alertas/colaborador.js')?>
@endsection
@section('contenido')
<div class="container-fluid px-4">
    <div class="btn">
        <div class="col-xl-3 col-md-6">
            <button type="button" class="btn btn-primary" onclick="location.href='{{Route('colaborador.registrar')}}'">
                Agregar
            </button>
        </div>
    </div>
    <div class="row">
        <div class="card mb-4">
            <div class="card-header">
                COLABORADORES
            </div>
            <div class="card-body">
                <table class="table" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"> <i class="icon_profile"></i> Nombres </th>
                            <th scope="col"><i class=" icon_group"></i> Apellidos</th>
                            <th scope="col"><i class="icon_id_alt"></i> DNI</th>
                            <th scope="col"><i class="icon_mobile"></i> Cargo</th>
                            <th scope="col"><i class="icon_mail_alt"></i> Estado</th>
                            <th scope="col"><i class="icon_cogs"></i> Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $cont=1 @endphp
                        @foreach ($colaboradores as $col)
                        <tr>
                            <td scope="row">{{$cont}}</td>
                            <td >{{$col->per_nombres}}</td>
                            <td>{{$col->per_apellidos}}</td>
                            <td>{{$col->per_dni}}</td>
                            <td>{{$col->Car_nombre}}</td>
                            <td>
                                @if ($col->per_estado == 'activo')
                                <span class="badge bg-warning text-dark" >Activo</span>
                                @else
                                <span class="badge bg-dark">Inactivo</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-primary" onclick="abrirModalAct({{$col->idCol}});"><i class="fas fa-edit" style="color: white"></i></button>
                                    @if($col->per_estado == 'activo')
                                        <button type="button" class="btn btn-danger" onclick="cambioEstado('inhabilitar',{{$col->idCol}});"><i class="fas fa-times-circle"></i></button>
                                    @else
                                        <button type="button" class="btn btn-success" onclick="cambioEstado('habilitar',{{$col->idCol}});"><i class="fas fa-check-circle"></i></button>
                                    @endif
                                </div>  
                                <div class="modal fade" id="modalAct{{$col->idCol}}" tabindex="-1" aria-labelledby="modalActLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">ACTUALIZAR COLABORADOR</h5>
                                            </div>

                                            <div class="card-body">
                                                <form method="POST" action="{{Route('colaborador.update',$col->idCol)}}">
                                                    @csrf
                                                    <div class="row mb-3">
                                                        <div class="col-md-4">
                                                            <div class="form-floating mb- mb-md-0">
                                                                <input class="form-control"  id="colNombres{{$col->idCol}}" name="colNombres{{$col->idCol}}"
                                                                type="text" value="{{$col->per_nombres}}" placeholder="Nombres"/>
                                                                <label for="colNombres">Nombres</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-floating">
                                                                <input
                                                                class="form-control"
                                                                id="colApell{{$col->idCol}}"
                                                                name="colApell{{$col->idCol}}"
                                                                type="text"
                                                                value="{{$col->per_apellidos}}"
                                                                placeholder="Apellidos Completos"/>
                                                                <label for="colApell">Apellidos</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-floating">
                                                                <input
                                                                    class="form-control"
                                                                    id="colDNI{{$col->idCol}}"
                                                                    name="colDNI{{$col->idCol}}"
                                                                    type="text"
                                                                    value="{{$col->per_dni}}"
                                                                    disabled
                                                                    placeholder="Documento de identidad"/>
                                                                <label for="colDNI">DNI</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-3">
                                                            <div class="form-floating">
                                                                <input
                                                                    class="form-control"
                                                                    id="colNac{{$col->idCol}}"
                                                                    name="colNac{{$col->idCol}}"
                                                                    type="date"
                                                                    value="{{$col->per_nacimiento}}"
                                                                    placeholder="Dirección"/>
                                                                <label for="colNac">Nacimiento</label>
                                                            </div>
                                                                
                                                        </div>

                                                        <div class="col-md-5">
                                                            <div class="form-floating">
                                                                <input
                                                                    class="form-control"
                                                                    id="colDirec{{$col->idCol}}"
                                                                    name="colDirec{{$col->idCol}}"
                                                                    type="text"
                                                                    value="{{$col->per_direccion}}"
                                                                    placeholder="Dirección"/>
                                                                <label for="colDirec">Dirección</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-floating">
                                                                <select class="form-select" name="colSexo{{$col->idCol}}" id="colSexo{{$col->idCol}}" class="form-control" required>
                                                                    @foreach ($sexos as $sexo)
                                                                        <option value="{{$sexo->idSexo}}" @if($col->idSexo==$sexo->idSexo)selected="true" @endif >{{$sexo->Sex_nombre}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <label for="colSexo">Sexo</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-3">
                                                            <div class="form-floating">
                                                                <input
                                                                    class="form-control"
                                                                    id="colCel{{$col->idCol}}"
                                                                    name="colCel{{$col->idCol}}"
                                                                    type="text"
                                                                    value="{{$col->per_cel}}"
                                                                    placeholder="Celular"/>
                                                                <label for="colCel">Celular</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-floating">
                                                                <select class="form-select" name="colCargo{{$col->idCol}}" id="colCargo{{$col->idCol}}" class="form-control" required>
                                                                    @foreach ($cargos as $cargo)
                                                                        <option value="{{$cargo->idCargo}}" @if($col->idCargo==$cargo->idCargo)selected="true" @endif >{{$cargo->Car_nombre}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <label for="colCargo">Cargo</label>
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-floating">
                                                                <input
                                                                    class="form-control"
                                                                    id="colSueldo{{$col->idCol}}"
                                                                    name="colSueldo{{$col->idCol}}"
                                                                    type="text"
                                                                    value="{{$col->col_sueldo}}"
                                                                    placeholder="Sueldo"/>
                                                                <label for="colSueldo">Sueldo</label>
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-floating">
                                                                <select class="form-select" name="colRol{{$col->idCol}}" id="colRol{{$col->idCol}}" class="form-control" required>
                                                                    @foreach ($roles as $rol)
                                                                        <option value="{{$rol->idRol}}" @if($col->idRol==$rol->idRol)selected="true" @endif >{{$rol->rol_nombre}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <label for="colPension">Rol</label>
                                                            </div> 
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-3">
                                                            <div class="form-floating">
                                                                <select class="form-select" name="colPension{{$col->idCol}}" id="colPension{{$col->idCol}}" class="form-control" onchange="show({{$col->idCol}});" required>
                                                                    @foreach ($pensiones as $pen)
                                                                        <option value="{{$pen->idSistPension}}" @if($col->idSistPension==$pen->idSistPension)selected="true" @endif >{{$pen->Pen_nombre}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <label for="colPension">Pensión</label>
                                                            </div> 
                                                        </div>
                       
                                                        <div class="col-md-2" id="comision">
                                                            <div class="form-floating">
                                                                <select class="form-select" name="colComision{{$col->idCol}}" id="colComision{{$col->idCol}}" class="form-control" enable="false">
                                                                    <option value="flujo" @if($col->col_comPension=='FLUJO')selected="true" @endif >FLUJO</option>
                                                                    <option value="mixta" @if($col->col_comPension=='MIXTA')selected="true" @endif >MIXTA</option>
                                                                </select>
                                                                <label for="colComision">Comisión</label>
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="colAsigFam{{$col->idCol}}" id="colAsigFam{{$col->idCol}}" @if($col->col_asigFam=='SI') checked @endif >
                                                                <label class="form-check-label" for="flexCheckDefault">
                                                                    ASIG. FAM.
                                                                </label>
                                                            </div>  
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="colSctr{{$col->idCol}}" id="colSctr{{$col->idCol}}" @if($col->col_sctr=='SI') checked @endif >
                                                                <label class="form-check-label" for="flexCheckChecked">
                                                                SCTR
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="btn btn-primary" onclick="actualizar({{$col->idCol}});"><strong> Guardar</strong></button>
                                                    <button type="button" class="btn btn-secondary" onclick="cerrarModalAct({{$col->idCol}});">Cancelar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="modalDelete{{$col->idCol}}" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                @if($col->per_estado == 'activo')
                                                <h5 class="modal-title">INHABILTAR COLABORADOR</h5>
                                                @else
                                                <h5 class="modal-title">HABILITAR COLABORADOR</h5>
                                                @endif
                                            </div>

                                            <div class="modal-body">
                                                @if($col->per_estado == 'activo')
                                                    ¿Desea inhabilitar al colaborador {{$col->per_nombres}} {{$col->per_apellidos}}?
                                                @else
                                                    ¿Desea habilitar al colaborador {{$col->per_nombres}} {{$col->per_apellidos}}?
                                                @endif
                                            </div>


                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">NO</button>
                                                <button type="submit" class="btn btn-primary"
                                                onclick="location.href='{{Route('colaborador.delete',$col->idCol)}}'"><strong>
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
