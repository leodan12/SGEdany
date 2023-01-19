@extends('base.content')
@section('styles')
<?php echo Html::script('js/alertas/cargo.js')?>
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
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">NUEVO CARGO</h5>
                </div>


                <div class="card-body">
                    <form method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="nameCa" name="nameCa"
                                    type="text" placeholder="Nombres"/>
                                    <label for="colNombres">Nombre</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <div class="form-floating mb- mb-md-0">
                                    <select class="form-select" name="areaCa" id="areaCa" class="form-control" required>
                                        @foreach ($areas as $area)
                                            <option value="{{$area->idArea}}" >{{$area->Are_nombre}}</option>
                                        @endforeach
                                    </select>
                                    <label for="colNombres">Área</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <textarea class="form-control" id="descCa" name="descCa" placeholder="Descripcion"></textarea>
                                    <label for="colApell">Descripción</label>
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
                CARGOS
            </div>
            <div class="card-body">
                <table  class="table" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"> Cargo </th>
                            <th scope="col">Área </th>
                            <th scope="col">Estado </th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $cont=1 @endphp
                        @foreach ($cargos as $cargo)
                        <tr>
                            <td scope="row">{{$cont}}</td>
                            <td >{{$cargo->Car_nombre}}</td>
                            <td >{{$cargo->Are_nombre}}</td>
                            <td>
                                @if ($cargo->Car_estado == 'activo')
                                <span class="badge bg-warning text-dark" >Activo</span>
                                @else
                                <span class="badge bg-dark">Inactivo</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-primary" onclick='modal({{$cargo->idCargo}});'><i class="fas fa-edit" style="color: white"></i></button>
                                    @if($cargo->Car_estado == 'activo')
                                        <button type="button" class="btn btn-danger" onclick="cambioEstado('inhabilitar',{{$cargo->idCargo}});" placeholder="Inhabilitar"><i class="fas fa-times-circle"></i></button>
                                    @else
                                        <button type="button" class="btn btn-success" onclick="cambioEstado('habilitar',{{$cargo->idCargo}});" ><i class="fas fa-check-circle"></i></button>
                                    @endif
                                </div>  
                                <div class="modal fade" id="modalAct{{$cargo->idCargo}}" tabindex="-1" aria-labelledby="modalActLabel" aria-hidden="true">
                                    <div class="modal-dialog " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">ACTUALIZAR CARGO</h5>
                                            </div>


                                            <div class="card-body">
                                                <form method="POST" action="{{Route('cargo.update',$cargo->idCargo)}}">
                                                    @csrf
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb- mb-md-0">
                                                                <input class="form-control"  id="nameCa{{$cargo->idCargo}}" name="nameCa{{$cargo->idCargo}}"
                                                                type="text" value="{{$cargo->Car_nombre}}" placeholder="Nombres"/>
                                                                <label for="nameA">Nombre</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb- mb-md-0">
                                                                <select class="form-select" name="areaCa{{$cargo->idCargo}}" id="areaCa{{$cargo->idCargo}}" class="form-control" required>
                                                                    @foreach ($areas as $area)
                                                                        <option value="{{$area->idArea}}" @if ($cargo->idArea==$area->idArea) selected="true" @endif >{{$area->Are_nombre}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <label for="colNombres">Área</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <div class="form-floating">
                                                                <textarea 
                                                                class="form-control" 
                                                                id="descCa{{$cargo->idCargo}}" 
                                                                name="descCa{{$cargo->idCargo}}"
                                                                style="min-height:200px"
                                                                >{{$cargo->Car_descripcion}}</textarea>
                                                                <label for="descA">Descripción</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                                    <button type="button" class="btn btn-primary" onclick='actualizar({{$cargo->idCargo}});'><strong> Actualizar</strong></button>
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
