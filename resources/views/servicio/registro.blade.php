@extends('base.content')
@section('styles')
<?php echo Html::script('js/alertas/servicio.js')?>
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
                    <h5 class="modal-title">NUEVO SERVICIO</h5>
                </div>


                <div class="card-body">
                    <form method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="codigo" name="codigo"
                                    type="text" placeholder="Código"/>
                                    <label for="codigo">Código Servicio</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="nombre" name="nombre"
                                    type="text" placeholder="Nombre"/>
                                    <label for="nombre">Nombre Servicio</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="detalle" name="detalle"
                                    type="text" placeholder="Detalle"/>
                                    <label for="precio">Detalle</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="costo" name="costo"
                                    type="number" min="0" placeholder="Costo"/>
                                    <label for="unidMed">Costo</label>
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
                SERVICIOS
            </div>
            <div class="card-body">
                <table class="table" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th scope="col" style="text-align: center">Nro.</th>
                            <th scope="col">Código</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Estado</th>
                            <th scope="col"><i class="fas fa-cogs"></i> Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $cont=1 @endphp
                        @foreach ($servicios as $servicio)
                        <tr>
                            <td scope="row" style="text-align: center">{{$cont}}</td>
                            <td >{{$servicio->codServicio}}</td>
                            <td >{{$servicio->serv_nombre}}</td>
                            <td >{{$servicio->serv_costo}}</td>
                            <td>
                                @if($servicio->serv_estado=='inactivo')
                                    <span class="badge bg-dark" >Inactivo</span>
                                @else
                                    <span class="badge bg-warning text-dark">Activo</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-primary" onclick='modal({{$servicio->idServicio}});'><i class="fas fa-edit" style="color: white"></i></button>
                                    @if($servicio->serv_estado=='inactivo')
                                        <button type="button" class="btn btn-success" onclick="cambioEstado('habilitar',{{$servicio->idServicio}});" ><i class="fas fa-check-circle"></i></button>
                                    @else
                                        <button type="button" class="btn btn-danger" onclick="cambioEstado('inhabilitar',{{$servicio->idServicio}});" placeholder="Inhabilitar"><i class="fas fa-times-circle"></i></button>
                                    @endif
                                </div>
                                <div class="modal fade" id="modalAct{{$servicio->idServicio}}" tabindex="-1" aria-labelledby="modalActLabel" aria-hidden="true">
                                    <div class="modal-dialog " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">ACTUALIZAR SERVICIO</h5>
                                            </div>


                                            <div class="card-body">
                                                <form method="POST">
                                                    @csrf
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb- mb-md-0">
                                                                <input class="form-control"   id="codigo{{$servicio->idServicio}}" name="codigo{{$servicio->idServicio}}"
                                                                type="text" placeholder="Código" value="{{$servicio->codServicio}}" disabled/>
                                                                <label for="codigo">Código Servicio</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <div class="form-floating mb- mb-md-0">
                                                                <input class="form-control"  id="nombre{{$servicio->idServicio}}" name="nombre{{$servicio->idServicio}}"
                                                                type="text" placeholder="Nombre" value="{{$servicio->serv_nombre}}"/>
                                                                <label for="nombre">Nombre Servicio</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-9">
                                                            <div class="form-floating mb- mb-md-0">
                                                                <input class="form-control"  id="detalle{{$servicio->idServicio}}" name="detalle{{$servicio->idServicio}}"
                                                                type="text" placeholder="Detalle" value="{{$servicio->serv_detalle}}"/>
                                                                <label for="precio">Detalle</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-floating mb- mb-md-0">
                                                                <input class="form-control"  id="costo{{$servicio->idServicio}}" name="costo{{$servicio->idServicio}}"
                                                                type="text" min="0" placeholder="Costo" value="{{$servicio->serv_costo}}"/>
                                                                <label for="unidMed">Costo</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="btn btn-primary"  onclick='actualizar({{$servicio->idServicio}});'><strong> Actualizar</strong></button>
                                                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
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
