@extends('base.content')
@section('styles')
<?php echo Html::script('js/alertas/area.js')?>
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
                    <h5 class="modal-title">NUEVA ÁREA</h5>
                </div>


                <div class="card-body">
                    <form method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="nameA" name="nameA"
                                    type="text" placeholder="Nombres"/>
                                    <label for="colNombres">Nombre</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                <textarea class="form-control" id="descA" name="descA" placeholder="Descripcion"></textarea>
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
                ÁREAS
            </div>
            <div class="card-body">
                <table class="table" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"> <i class="icon_profile"></i> Área </th>
                            <th scope="col"> <i class="icon_profile"></i> Estado </th>
                            <th scope="col"><i class="icon_cogs"></i> Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $cont=1 @endphp
                        @foreach ($areas as $area)
                        <tr>
                            <td scope="row">{{$cont}}</td>
                            <td >{{$area->Are_nombre}}</td>
                            <td>
                                @if ($area->are_estado == 'activo')
                                <span class="badge bg-warning text-dark" >Activo</span>
                                @else
                                <span class="badge bg-dark">Inactivo</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-primary" onclick='modal({{$area->idArea}});'><i class="fas fa-edit" style="color: white"></i></button>
                                    @if($area->are_estado == 'activo')
                                        <button type="button" class="btn btn-danger" onclick="cambioEstado('inhabilitar',{{$area->idArea}});"  placeholder="Inhabilitar"><i class="fas fa-times-circle"></i></button>
                                    @else
                                        <button type="button" class="btn btn-success" onclick="cambioEstado('habilitar',{{$area->idArea}});"><i class="fas fa-check-circle"></i></button>
                                    @endif
                                </div>
                                <div class="modal fade" id="modalAct{{$area->idArea}}" tabindex="-1" aria-labelledby="modalActLabel" aria-hidden="true">
                                    <div class="modal-dialog " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">ACTUALIZAR ÁREA</h5>
                                            </div>


                                            <div class="card-body">
                                                <form method="POST">
                                                    @csrf
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <div class="form-floating mb- mb-md-0">
                                                                <input class="form-control"  id="nameAct{{$area->idArea}}" name="nameAct{{$area->idArea}}"
                                                                type="text" value="{{$area->Are_nombre}}" placeholder="Nombres"/>
                                                                <label for="nameAct">Nombre</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <div class="form-floating">
                                                                <textarea 
                                                                class="form-control" 
                                                                id="descAct{{$area->idArea}}" 
                                                                name="descAct{{$area->idArea}}"
                                                                >{{$area->Are_descripcion}}</textarea>
                                                                <label for="descA">Descripción</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                                    <button type="button" class="btn btn-primary" onclick='actualizar({{$area->idArea}});'><strong> Guardar</strong></button>
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
