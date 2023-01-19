@extends('base.content')
@section('styles')
<?php echo Html::script('js/alertas/ubicacion.js')?>
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
                    <h5 class="modal-title">NUEVA UBICACIÓN</h5>
                </div>


                <div class="card-body">
                    <form method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="ubicName" name="ubicName"
                                    type="text" placeholder="Nombres"/>
                                    <label for="colNombres">Ubicación</label>
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
                UBICACIONES
            </div>
            <div class="card-body">
                <table  class="table" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"> Ubicación </th>
                            <th scope="col">Estado </th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $cont=1 @endphp
                        @foreach ($ubicaciones as $ubic)
                        <tr>
                            <td scope="row">{{$cont}}</td>
                            <td >{{$ubic->Ubic_nombre}}</td>
                            <td>
                                @if ($ubic->ubic_estado == 'disponible')
                                    <span class="badge bg-warning text-dark" >Disponible</span>
                                @endif
                                @if ($ubic->ubic_estado == 'ocupado')
                                    <span class="badge bg-danger ">Ocupado</span>
                                @endif
                                @if ($ubic->ubic_estado == 'inactivo')
                                    <span class="badge bg-dark">Inactivo</span>
                                @endif
                                
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-primary" onclick='modal({{$ubic->idUbicacion}});'><i class="fas fa-edit" style="color: white"></i></button>
                                    @if($ubic->ubic_estado == 'inactivo')                                        
                                        <button type="button" class="btn btn-success" onclick="cambioEstado('habilitar',{{$ubic->idUbicacion}});" ><i class="fas fa-check-circle"></i></button>

                                    @else
                                        <button type="button" class="btn btn-danger" onclick="cambioEstado('inhabilitar',{{$ubic->idUbicacion}});" placeholder="Inhabilitar"><i class="fas fa-times-circle"></i></button>

                                    @endif
                                </div>  
                                <div class="modal fade" id="modalAct{{$ubic->idUbicacion}}" tabindex="-1" aria-labelledby="modalActLabel" aria-hidden="true">
                                    <div class="modal-dialog " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">ACTUALIZAR UBICACIÓN</h5>
                                            </div>


                                            <div class="card-body">
                                                <form method="POST">
                                                    @csrf
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb- mb-md-0">
                                                                <input class="form-control"  id="ubicName{{$ubic->idUbicacion}}" name="ubicName{{$ubic->idUbicacion}}"
                                                                type="text" value="{{$ubic->Ubic_nombre}}" placeholder="Nombres"/>
                                                                <label for="nameA">Nombre</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                                    <button type="button" class="btn btn-primary" onclick='actualizar({{$ubic->idUbicacion}});'><strong> Actualizar</strong></button>
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
