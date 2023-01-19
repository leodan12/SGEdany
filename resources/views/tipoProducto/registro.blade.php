@extends('base.content')
@section('styles')
<?php echo Html::script('js/alertas/tipoProd.js')?>
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
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">NUEVO TIPO DE PRODUCTOS</h5>
                </div>


                <div class="card-body">
                    <form method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="nameTipo" name="nameTipo"
                                    type="text" placeholder="Tipo"/>
                                    <label for="nameTipo">Tipo</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="codTipo" name="codTipo"
                                        type="text"  placeholder="codigo"/>
                                    <label for="codTipo">Código</label>
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
                TIPOS DE PRODUCTOS
            </div>
            <div class="card-body">
                <table class="table" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tipo Producto </th>
                            <th scope="col">Código </th>
                            <th scope="col">Estado </th>
                            <th scope="col"><i class="fas fa-cogs"></i> Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $cont=1 @endphp
                        @foreach ($tipos as $tipo)
                        <tr>
                            <td scope="row">{{$cont}}</td>
                            <td >{{$tipo->TP_nombre}}</td>
                            <td >{{$tipo->TP_codigo}}</td>
                            <td>
                                @if($tipo->TP_estado=='activo')
                                    <span class="badge bg-warning text-dark" >Activo</span>
                                @else
                                    <span class="badge bg-dark">Inactivo</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-primary" onclick='modal({{$tipo->idTipoProd}});'><i class="fas fa-edit" style="color: white"></i></button>
                                    @if($tipo->TP_estado == 'activo')
                                        <button type="button" class="btn btn-danger" onclick="cambioEstado('inhabilitar',{{$tipo->idTipoProd}});" placeholder="Inhabilitar"><i class="fas fa-times-circle"></i></button>
                                    @else
                                        <button type="button" class="btn btn-success" onclick="cambioEstado('habilitar',{{$tipo->idTipoProd}});" ><i class="fas fa-check-circle"></i></button>
                                    @endif
                                </div>
                                <div class="modal fade" id="modalAct{{$tipo->idTipoProd}}" tabindex="-1" aria-labelledby="modalActLabel" aria-hidden="true">
                                    <div class="modal-dialog " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">ACTUALIZAR TIPO PRODUCTO</h5>
                                            </div>
                                            <div class="card-body">
                                                <form method="POST">
                                                    @csrf
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <div class="form-floating mb- mb-md-0">
                                                                <input class="form-control"  id="nameTipo{{$tipo->idTipoProd}}" name="nameTipo{{$tipo->idTipoProd}}"
                                                                type="text" value="{{$tipo->TP_nombre}}" placeholder="Nombres"/>
                                                                <label for="nameA">Tipo</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <div class="form-floating mb- mb-md-0">
                                                            <input class="form-control"  id="codTipo{{$tipo->idTipoProd}}" name="codTipo{{$tipo->idTipoProd}}"
                                                                type="text" value="{{$tipo->TP_codigo}}" placeholder="codigo"/>
                                                                <label for="nameA">Código</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                                    <button type="button" class="btn btn-primary" onclick='actualizar({{$tipo->idTipoProd}});'><strong> Actualizar</strong></button>
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
