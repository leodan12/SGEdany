@extends('base.content')
@section('styles')
<?php echo Html::script('js/alertas/kardex.js')?>
@endsection
@section('contenido')
<div class="container-fluid px-4">
    <div class="btn">
        <div class="col-xl-3 col-md-6">
            <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#modalAdd" onclick='productos()'>
                Agregar
            </button>
        </div>
    </div>
    <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">NUEVO KARDEX</h5>
                </div>


                <div class="card-body">
                    <form method="POST" action="{{Route('kardex.guardar')}}">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <div class="form-floating mb- mb-md-0">
                                    <select class="form-select" name="prod" id="prod" class="form-control" onchange='buscaProducto();' required>
                                    </select>
                                    <label for="prod">Código Producto</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="nombre" name="nombre"
                                    type="text" placeholder="Nombre"/>
                                    <label for="prod"> Nombre Producto</label>
                                </div>
                            </div>
                           
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb- mb-md-0">
                                    <select class="form-select" name="ubicacion" id="ubicacion" class="form-control" required>
                                    </select>
                                    <label for="ubicacion">Ubicación</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input class="form-control"  id="cantidad" name="cantidad"
                                    type="text" placeholder="Nombre"/>
                                    <label for="colApell">Cantidad</label>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" id="save" onclick='verificar();'><strong>Guardar</strong></button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card mb-4">
            <div class="card-header">
                KARDEX
            </div>
            <div class="card-body">
                <table  class="table" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th>Código Producto</th>
                            <th scope="col"> Producto </th>
                            <th scope="col"> Ubicación </th>
                            <th scope="col">Cantidad Actual </th>
                            <th scope="col">Creado el </th>
                            <th>Estado</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $cont=1 @endphp
                        @foreach ($kardex as $krdx)
                        <tr>
                            <td scope="row">{{$cont}}</td>
                            <td>{{$krdx->codProducto}}</td>
                            <td >{{$krdx->Prod_nombre}}</td>
                            <td >{{$krdx->Ubic_nombre}}</td>
                            <td >{{$krdx->Cant_actual}}</td>
                            <?php $creado = date_format(date_create(strval($krdx->Kdx_creacion)),'d-m-Y')?>
                            <td >{{$creado}}</td>
                            <td>
                                @if($krdx->krdx_estado=='inactivo')
                                    <span class="badge bg-dark" >Inactivo</span>
                                @else
                                    <span class="badge bg-warning text-dark">Activo</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    
                                    @if($krdx->krdx_estado=='inactivo')
                                        <button type="button" class="btn btn-success" onclick="cambioEstado('habilitar',{{$krdx->idKardex}});" ><i class="fas fa-check-circle"></i></button>
                                    @else
                                        <button type="button" class="btn btn-primary" onclick='modal({{$krdx->idKardex}});'><i class="fas fa-edit" style="color: white"></i></button>
                                        <button type="button" class="btn btn-danger" onclick="cambioEstado('inhabilitar',{{$krdx->idKardex}});" placeholder="Inhabilitar"><i class="fas fa-times-circle"></i></button>
                                    @endif
                                </div>
                                <div class="modal fade" id="modalAct{{$krdx->idKardex}}" tabindex="-1" aria-labelledby="modalActLabel" aria-hidden="true">
                                    <div class="modal-dialog " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">ACTUALIZAR KARDEX</h5>
                                            </div>


                                            <div class="card-body">
                                                <form method="POST">
                                                    @csrf
                                                    <div class="row mb-3">
                                                        <div class="col-md-8">
                                                            <div class="form-floating mb- mb-md-0">
                                                                <input class="form-control"  id="prod{{$krdx->idKardex}}" name="prod{{$krdx->idKardex}}"
                                                                type="text" value="{{$krdx->Prod_nombre}}" placeholder="prod" disabled/>
                                                                <label for="prod">Producto</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb- mb-md-0">
                                                                <select class="form-select" name="ubicacion{{$krdx->idKardex}}" id="ubicacion{{$krdx->idKardex}}" class="form-control" required>
                                                                    @foreach ($ubicAct as $ubic)
                                                                        @if ($ubic->ubic_estado=='disponible')
                                                                            <option value="{{$ubic->idUbicacion}}">{{$ubic->Ubic_nombre}}</option>
                                                                        @else
                                                                            @if ($ubic->idUbicacion == $krdx->idUbicacion)
                                                                            <option value="{{$ubic->idUbicacion}}" selected="true">{{$ubic->Ubic_nombre}}</option>
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                                <label for="ubicacion">Ubicación</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-floating">
                                                                <input class="form-control"  id="cantidad{{$krdx->idKardex}}" name="cantidad{{$krdx->idKardex}}"
                                                                type="text" value="{{$krdx->Cant_actual}}" placeholder="cantidad" disabled/>
                                                                <label for="cantidad">Cantidad</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="btn btn-primary" onclick='actualizar();'><strong> Guardar</strong></button>
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
