@extends('base.content')
@section('styles')
<?php echo Html::script('js/alertas/responsable.js')?>
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
    <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">NUEVO RESPONSABLE</h5>
                </div>


                <div class="card-body">
                    <form method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="nameRes" name="nameRes"
                                    type="text" placeholder="Nombres"/>
                                    <label for="nameTipo">Nombres</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="apellRes" name="apellRes"
                                    type="text" placeholder="Apellidos"/>
                                    <label for="nameTipo">Apellidos</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="carRes" name="carRes"
                                    type="text" placeholder="Nombres"/>
                                    <label for="nameTipo">Cargo</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-5">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="celRes" name="celRes"
                                    type="text" placeholder="Nombres"/>
                                    <label for="nameTipo">Celular</label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="emailRes" name="emailRes"
                                    type="text" placeholder="Apellidos"/>
                                    <label for="nameTipo">Correo</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <h5>Cliente</h5>
                            <div class="col-md-5">
                                <div class="form-floating mb- mb-md-0">
                                    <select class="form-select" name="razon" id="razon" class="form-control" onchange='getCliente();' required>
                                        @foreach ($clientes as $clie)
                                            <option value="{{$clie->idCliente}}">{{$clie->clie_identificador}}</option>
                                        @endforeach
                                    </select>
                                    <label for="tipo">RUC</label>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="nameEmp" name="nameEmp"
                                    type="text" placeholder="Empresa" disabled/>
                                    <label for="Empresa">Nombre</label>
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
                RESPONSABLES DE PRESUPUESTOS
            </div>
            <div class="card-body">
                <table class="table" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre </th>
                            <th scope="col">Contacto </th>
                            <th scope="col">Correo </th>
                            <th scope="col">Empresa</th>
                            <th scope="col">Estado </th>
                            <th scope="col"><i class="fas fa-cogs"></i> Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $cont=1 @endphp
                        @foreach ($responsables as $r)
                        <tr>
                            <td scope="row">{{$cont}}</td>
                            <td >{{$r->res_apellidos}} {{$r->res_nombres}}</td>
                            <td >{{$r->res_contacto}}</td>
                            <td >{{$r->res_correo}}</td>
                            <td >{{$r->NombreComercial}}</td>
                            <td>
                                @if($r->res_estado=='activo')
                                    <span class="badge bg-warning text-dark" >Activo</span>
                                @else
                                    <span class="badge bg-dark">Inactivo</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-primary" onclick='modal({{$r->idResponsable}});'><i class="fas fa-edit" style="color: white"></i></button>
                                    @if($r->res_estado=='activo')
                                        <button type="button" class="btn btn-danger" onclick="cambioEstado('inhabilitar',{{$r->idResponsable}});" placeholder="Inhabilitar"><i class="fas fa-times-circle"></i></button>
                                    @else
                                        <button type="button" class="btn btn-success" onclick="cambioEstado('habilitar',{{$r->idResponsable}});" ><i class="fas fa-check-circle"></i></button>
                                    @endif
                                </div>
                                <div class="modal fade" id="modalAct{{$r->idResponsable}}" tabindex="-1" aria-labelledby="modalActLabel" aria-hidden="true">
                                    <div class="modal-dialog " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">ACTUALIZAR DATOS</h5>
                                            </div>
                                            <div class="card-body">
                                                <form method="POST">
                                                    @csrf
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb- mb-md-0">
                                                                <input class="form-control"  id="nameRes{{$r->idResponsable}}" name="nameRes{{$r->idResponsable}}"
                                                                type="text" value="{{$r->res_nombres}}" placeholder="Nombres"/>
                                                                <label for="nameA">Nombres</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb- mb-md-0">
                                                            <input class="form-control"  id="apellRes{{$r->idResponsable}}" name="apellRes{{$r->idResponsable}}"
                                                                type="text" value="{{$r->res_apellidos}}" placeholder="codigo"/>
                                                                <label for="nameA">Apellidos</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb- mb-md-0">
                                                            <input class="form-control"  id="carRes{{$r->idResponsable}}" name="carRes{{$r->idResponsable}}"
                                                                type="text" value="{{$r->res_cargo}}" placeholder="codigo"/>
                                                                <label for="nameA">Cargo</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb- mb-md-0">
                                                            <input class="form-control"  id="celRes{{$r->idResponsable}}" name="celRes{{$r->idResponsable}}"
                                                                type="text" value="{{$r->res_contacto}}" placeholder="codigo"/>
                                                                <label for="nameA">Celular</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-8">
                                                            <div class="form-floating mb- mb-md-0">
                                                            <input class="form-control"  id="emailRes{{$r->idResponsable}}" name="emailRes{{$r->idResponsable}}"
                                                                type="text" value="{{$r->res_correo}}" placeholder="codigo"/>
                                                                <label for="nameA">Correo</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h6>Cliente</h6>
                                                    <div class="row mb-3">
                                                        <div class="col-md-5">
                                                            <div class="form-floating mb- mb-md-0">
                                                                <select class="form-select" name="razon{{$r->idResponsable}}" id="razon{{$r->idResponsable}}" class="form-control" onchange='getClienteEdit({{$r->idResponsable}});' required>
                                                                    @foreach ($clientes as $clie)
                                                                        <option value="{{$clie->idCliente}}" @if($r->idCliente==$clie->idCliente)selected="true"@endif>{{$clie->clie_identificador}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <label for="tipo">RUC</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <div class="form-floating mb- mb-md-0">
                                                                <input class="form-control"  id="nameEmp{{$r->idResponsable}}" name="nameEmp{{$r->idResponsable}}"
                                                                type="text" placeholder="Empresa" disabled/>
                                                                <label for="Empresa">Nombre</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                                    <button type="button" class="btn btn-primary" onclick='actualizar({{$r->idResponsable}});'><strong> Actualizar</strong></button>
                                                    <button type="button" class="btn btn-secondary" onclick='cerrarModalAct({{$r->idResponsable}});'>Cancelar</button>
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
