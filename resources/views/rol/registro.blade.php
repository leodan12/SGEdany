@extends('base.content')
@section('styles')
<?php echo Html::script('js/alertas/rol.js')?>
@endsection
@section('contenido')
<div class="container-fluid px-4">
    <div class="btn">
        <div class="col-xl-3 col-md-6">
            <button type="button" class="btn btn-primary"  onclick='abrirModal();'>
                Agregar
            </button>
        </div>
    </div>
    <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">NUEVO ROL</h5>
                </div>
                <div class="card-body">
                    <form method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="name" name="name"
                                    type="text" placeholder="Tipo"/>
                                    <label for="name">Rol</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="nivel" name="nivel"
                                        type="number"  min="1"/>
                                    <label for="nivel">Nivel de permiso</label>
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
                ROLES
            </div>
            <div class="card-body">
                <table class="table" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Rol </th>
                            <th scope="col">Permiso </th>
                            <th scope="col">Estado </th>
                            <th scope="col"><i class="fas fa-cogs"></i> Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $cont=1 @endphp
                        @foreach ($roles as $rol)
                        <tr>
                            <td scope="row">{{$cont}}</td>
                            <td >{{$rol->rol_nombre}}</td>
                            <td >Nivel {{$rol->rol_permiso}}</td>
                            <td>
                                @if($rol->rol_estado=='activo')
                                    <span class="badge bg-warning text-dark" >Activo</span>
                                @else
                                    <span class="badge bg-dark">Inactivo</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-primary" onclick='abrirModalAct({{$rol->idRol}});'><i class="fas fa-edit" style="color: white"></i></button>
                                    @if($rol->rol_estado=='activo')
                                        <button type="button" class="btn btn-danger" onclick="cambioEstado('inhabilitar',{{$rol->idRol}});" placeholder="Inhabilitar"><i class="fas fa-times-circle"></i></button>
                                    @else
                                        <button type="button" class="btn btn-success" onclick="cambioEstado('habilitar',{{$rol->idRol}});" ><i class="fas fa-check-circle"></i></button>
                                    @endif
                                </div>
                                <div class="modal fade" id="modalAct{{$rol->idRol}}" tabindex="-1" aria-labelledby="modalActLabel" aria-hidden="true">
                                    <div class="modal-dialog " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">ACTUALIZAR ROL</h5>
                                            </div>
                                            <div class="card-body">
                                                <form method="POST">
                                                    @csrf
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <div class="form-floating mb- mb-md-0">
                                                                <input class="form-control"  id="name{{$rol->idRol}}" name="name{{$rol->idRol}}"
                                                                type="text" value="{{$rol->rol_nombre}}" placeholder="Nombres"/>
                                                                <label for="nameA">Tipo</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <div class="form-floating mb- mb-md-0">
                                                            <input class="form-control"  id="nivel{{$rol->idRol}}" name="nivel{{$rol->idRol}}"
                                                                type="number" value="{{$rol->rol_permiso}}" min="1"/>
                                                                <label for="nameA">Nivel</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                                    <button type="button" class="btn btn-primary" onclick='actualizar({{$rol->idRol}});'><strong> Actualizar</strong></button>
                                                    <button type="button" class="btn btn-secondary" onclick='cerrarModalAct({{$rol->idRol}});'>Cancelar</button>
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