@extends('base.content')
@section('styles')
<?php echo Html::script('js/alertas/pension.js')?>
@endsection
@section('contenido')
<div class="container-fluid px-4">
    <div class="btn">
        <div class="col-xl-3 col-md-6">
            <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#modalAdd">
                Agregar
            </button>
        </div>
    </div>
    <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">NUEVO SISTEMA DE PENSION</h5>
                </div>


                <div class="card-body">
                    <form method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="namePen" name="namePen"
                                    type="text" placeholder="Sistema de pensión"/>
                                    <label for="colNombres">Pensión</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="oblig" name="oblig"
                                    type="text" placeholder="Cargo Obligatorio"/>
                                    <label for="colNombres">Cargo Obligatorio(%)</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="comFlujo" name="comFlujo"
                                    type="text" placeholder="Comisión flujo"/>
                                    <label for="comFlujo">Cargo comisión flujo(%)</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="comMixta" name="comMixta"
                                    type="text" placeholder="Comisión mixta"/>
                                    <label for="comMixta">Cargo comisión mixta(%)</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="seg" name="seg"
                                    type="text" placeholder="Seguro"/>
                                    <label for="seg">Cargo seguro(%)</label>
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
                SISTEMA DE PENSIONES
            </div>
            <div class="card-body">
                <table class="table" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"> <i class="icon_profile"></i> Nombre </th>
                            <th scope="col"> <i class="icon_profile"></i> Comisión Oblig. </th>
                            <th scope="col"> <i class="icon_profile"></i> Comisión Flujo </th>
                            <th scope="col"> <i class="icon_profile"></i> Comisión Mixta </th>
                            <th scope="col"> <i class="icon_profile"></i> Comisión Seguro </th>
                            <th scope="col"> <i class="icon_profile"></i> Estado </th>
                            <th scope="col"><i class="icon_cogs"></i> Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $cont=1 @endphp
                        @foreach ($pensiones as $pension)
                        <tr>
                            <td scope="row">{{$cont}}</td>
                            <td >{{$pension->Pen_nombre}}</td>
                            <td >{{$pension->Porc_obligatorio}}</td>
                            <td >{{$pension->Porc_comFlujo}}</td>
                            <td >{{$pension->Porc_comMixta}}</td>
                            <td >{{$pension->Porc_seguro}}</td>
                            <td>
                                @if ($pension->pen_estado == 'activo')
                                <span class="badge bg-warning text-dark" >Activo</span>
                                @else
                                <span class="badge bg-dark">Inactivo</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-primary" onclick='modal({{$pension->idSistPension}});'><i class="fas fa-edit" style="color: white"></i></button>
                                    @if($pension->pen_estado == 'activo')
                                        <button type="button" class="btn btn-danger" onclick="cambioEstado('inhabilitar',{{$pension->idSistPension}});" placeholder="Inhabilitar"><i class="fas fa-times-circle"></i></button>
                                    @else
                                        <button type="button" class="btn btn-success" onclick="cambioEstado('hablitar',{{$pension->idSistPension}});"><i class="fas fa-check-circle"></i></button>
                                    @endif                                
                                </div>
                                <div class="modal fade" id="modalAct{{$pension->idSistPension}}" tabindex="-1" aria-labelledby="modalActLabel" aria-hidden="true">
                                    <div class="modal-dialog " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">ACTUALIZAR SISTEMA DE PENSIÓN</h5>
                                            </div>


                                            <div class="card-body">
                                                <form method="POST">
                                                    @csrf
                                                    <div class="row mb-3">
                                                        <div class="col-md-8">
                                                            <div class="form-floating mb- mb-md-0">
                                                                <input class="form-control"  id="namePen{{$pension->idSistPension}}" name="namePen{{$pension->idSistPension}}"
                                                                type="text" value="{{$pension->Pen_nombre}}" placeholder="Sistema de pensión"/>
                                                                <label for="colNombres">Pensión</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb- mb-md-0">
                                                                <input class="form-control"  id="oblig{{$pension->idSistPension}}" name="oblig{{$pension->idSistPension}}"
                                                                type="text" value="{{$pension->Porc_obligatorio}}" placeholder="Cargo Obligatorio"/>
                                                                <label for="colNombres">Cargo Obligatorio(%)</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb- mb-md-0">
                                                                <input class="form-control"  id="comFlujo{{$pension->idSistPension}}" name="comFlujo{{$pension->idSistPension}}"
                                                                type="text" value="{{$pension->Porc_comFlujo}}" placeholder="Comisión flujo"/>
                                                                <label for="comFlujo">Cargo comisión flujo(%)</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb- mb-md-0">
                                                                <input class="form-control"  id="comMixta{{$pension->idSistPension}}" name="comMixta{{$pension->idSistPension}}"
                                                                type="text" value="{{$pension->Porc_comMixta}}" placeholder="Comisión mixta"/>
                                                                <label for="comMixta">Cargo comisión mixta(%)</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb- mb-md-0">
                                                                <input class="form-control"  id="seg{{$pension->idSistPension}}" name="seg{{$pension->idSistPension}}"
                                                                type="text" value="{{$pension->Porc_seguro}}" placeholder="Seguro"/>
                                                                <label for="seg">Cargo seguro(%)</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                                    <button type="button" class="btn btn-primary" onclick='actualizar({{$pension->idSistPension}});'><strong> Actualizar</strong></button>
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
