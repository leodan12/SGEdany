@extends('base.content')
@section('styles')
<?php echo Html::script('js/alertas/proveedor.js')?>
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
                    <h5 class="modal-title">NUEVO PROVEEDOR</h5>
                </div>


                <div class="card-body">
                    <form method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="ruc" name="ruc"
                                    type="text" placeholder="RUC"/>
                                    <label for="ruc">RUC</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                <input class="form-control" id="razon" name="razon" placeholder="Razón"></input>
                                    <label for="razon">Razón Social</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                <input class="form-control" id="nombre" name="nombre" placeholder="Nombre Comercial"></input>
                                    <label for="nombre">Nombre Comercial</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                <input class="form-control" id="direc" name="direc" placeholder="Dirección"></input>
                                    <label for="direc">Dirección</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                <input class="form-control" id="rubro" name="rubro" placeholder="Rubro"></input>
                                    <label for="rubro">Rubro</label>
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
                PROVEEDORES
            </div>
            <div class="card-body">
                <table class="table" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"> <i class="icon_profile"></i> RUC </th>
                            <th scope="col"> <i class="icon_profile"></i> Nombre comercial </th>
                            <th>Estado</th>
                            <th scope="col"><i class="icon_cogs"></i> Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $cont=1 @endphp
                        @foreach ($empresas as $emp)
                        <tr>
                            <td scope="row">{{$cont}}</td>
                            <td >{{$emp->RUC}}</td>
                            <td >{{$emp->NombreComercial}}</td>
                            <td>
                                @if ($emp->emp_estado == 'activo')
                                <span class="badge bg-warning text-dark" >Activo</span>
                                @else
                                <span class="badge bg-dark">Inactivo</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-primary" onclick='modal({{$emp->idEmpresa}});'><i class="fas fa-edit" style="color: white"></i></button>
                                    @if($emp->emp_estado == 'activo')
                                        <button type="button" class="btn btn-danger" onclick="cambioEstado('inhabilitar',{{$emp->idEmpresa}});" placeholder="Inhabilitar"><i class="fas fa-times-circle"></i></button>
                                    @else
                                        <button type="button" class="btn btn-success" onclick="cambioEstado('habilitar',{{$emp->idEmpresa}});" ><i class="fas fa-check-circle"></i></button>
                                    @endif
                                </div> 
                                <div class="modal fade" id="modalAct{{$emp->idEmpresa}}" tabindex="-1" aria-labelledby="modalActLabel" aria-hidden="true">
                                    <div class="modal-dialog " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">ACTUALIZAR PROVEEDOR</h5>
                                            </div>


                                            <div class="card-body">
                                                <form method="POST">
                                                    @csrf
                                                    <div class="row mb-3">
                                                        <div class="col-md-4">
                                                            <div class="form-floating mb- mb-md-0">
                                                                <input class="form-control"  id="ruc{{$emp->idEmpresa}}" name="ruc{{$emp->idEmpresa}}"
                                                                type="text" value="{{$emp->RUC}}" placeholder="RUC"disabled>
                                                                <label for="ruc">RUC</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <div class="form-floating">
                                                            <input class="form-control" id="razon{{$emp->idEmpresa}}" name="razon{{$emp->idEmpresa}}" 
                                                              type="text" value="{{$emp->RazonSocial}}"  placeholder="Razón"></input>
                                                                <label for="razon">Razón Social</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <div class="form-floating">
                                                            <input class="form-control" id="nombre{{$emp->idEmpresa}}" name="nombre{{$emp->idEmpresa}}" 
                                                            type="text" value="{{$emp->NombreComercial}}" placeholder="Nombre Comercial"></input>
                                                                <label for="nombre">Nombre Comercial</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <div class="form-floating">
                                                            <input class="form-control" id="direc{{$emp->idEmpresa}}" name="direc{{$emp->idEmpresa}}"
                                                            type="text" value="{{$emp->Direccion}}" placeholder="Dirección"></input>
                                                                <label for="direc">Dirección</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <div class="form-floating">
                                                            <input class="form-control" id="rubro{{$emp->idEmpresa}}" name="rubro{{$emp->idEmpresa}}"
                                                            type="text" value="{{$emp->Rubro}}" placeholder="Rubro"></input>
                                                                <label for="rubro">Rubro</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="btn btn-primary" onclick='actualizar({{$emp->idEmpresa}});'><strong> Guardar</strong></button>
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
