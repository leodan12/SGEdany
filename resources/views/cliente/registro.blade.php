@extends('base.content')
@section('styles')
<?php echo Html::script('js/alertas/cliente.js')?>
<?php echo Html::script('js/autocomplete/cliente.js')?>
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
                    <h5 class="modal-title">NUEVO CLIENTE</h5>
                </div>


                <div class="card-body">
                    <form method="POST">
                        @csrf
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="opciones" id="empresa" checked>
                            <label class="form-check-label" for="inlineRadio1">Empresa</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="opciones" id="persona">
                            <label class="form-check-label" for="inlineRadio2">Persona</label>
                        </div>
                        <div id="empresaDiv">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="form-floating mb- mb-md-0">
                                        <input class="form-control"  id="ruc" name="ruc" type="text" placeholder="RUC"/>
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
                                        <input class="form-control" id="nombreE" name="nombreE" placeholder="Nombre Comercial"></input>
                                        <label for="nombre">Nombre Comercial</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input class="form-control" id="direcE" name="direcE" placeholder="Dirección"></input>
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
                        </div>
                        <div id="personaDiv">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="form-floating mb- mb-md-0">
                                        <input class="form-control"  id="dni" name="dni" type="text" placeholder="DNI"/>
                                        <label for="ruc">DNI</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" id="nombres" name="nombres" placeholder="Nombres"></input>
                                        <label for="razon">Nombres</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos"></input>
                                        <label for="nombre">Apellidos</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input class="form-control" id="nacimiento" name="nacimiento" type="date"  placeholder="Dirección"/>
                                        <label for="colNac">Nacimiento</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <select class="form-select" name="sexo" id="sexo" class="form-control" required>
                                            @foreach ($sexos as $sexo)
                                                <option value="{{$sexo->idSexo}}" >{{$sexo->Sex_nombre}}</option>
                                            @endforeach
                                        </select>
                                        <label for="colSexo">Sexo</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input class="form-control" id="celular" name="celular" type="text"  placeholder="Celular"/>
                                        <label for="colCel">Celular</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input class="form-control" id="direcP" name="direcP"  placeholder="Dirección"></input>
                                        <label for="direc">Dirección</label>
                                    </div>
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
                CLIENTE
            </div>
            <div class="card-body">
                <table  class="table" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"> DNI/RUC </th>
                            <th scope="col">Nombre </th>
                            <th scope="col">Estado </th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $cont=1 @endphp
                        @foreach ($clientes as $cliente)
                        <tr>
                            <td scope="row">{{$cont}}</td>
                            <td >{{$cliente->clie_identificador}}</td>
                            <?php $cant =strlen($cliente->clie_identificador) ?>
                            <td>
                                @if($cant>8)
                                    {{$cliente->RazonSocial}}
                                @else
                                    {{$cliente->per_apellidos}}, {{$cliente->per_nombres}}
                                @endif
                            </td>
                            
                            <td>
                                @if ($cliente->clie_estado == 'activo')
                                <span class="badge bg-warning text-dark" >Activo</span>
                                @else
                                <span class="badge bg-dark">Inactivo</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-primary"  onclick='modal({{$cliente->idCliente}});'><i class="fas fa-edit" style="color: white"></i></button>
                                    @if($cliente->clie_estado == 'activo')
                                        <button type="button" class="btn btn-danger" onclick="cambioEstado('inhabilitar',{{$cliente->idCliente}});" placeholder="Inhabilitar"><i class="fas fa-times-circle"></i></button>
                                    @else
                                        <button type="button" class="btn btn-success" onclick="cambioEstado('habilitar',{{$cliente->idCliente}});"><i class="fas fa-check-circle"></i></button>
                                    @endif
                                </div> 
                                <div class="modal fade" id="modalAct{{$cliente->idCliente}}" tabindex="-1" aria-labelledby="modalActLabel" aria-hidden="true">
                                    <div class="modal-dialog " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">ACTUALIZAR CLIENTE</h5>
                                            </div>
                                                <div class="card-body">
                                                    <form method="POST">
                                                        @csrf
                                                        @if($cant>8)
                                                            <div class="row mb-3">
                                                                <div class="col-md-4">
                                                                    <div class="form-floating mb- mb-md-0">
                                                                        <input class="form-control"  id="ruc{{$cliente->idCliente}}" name="ruc{{$cliente->idCliente}}" type="text" value="{{$cliente->RUC}}" placeholder="RUC" disabled/>
                                                                        <label for="ruc">RUC</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col-md-12">
                                                                    <div class="form-floating">
                                                                        <input class="form-control" id="razon{{$cliente->idCliente}}" name="razon{{$cliente->idCliente}}" value="{{$cliente->RazonSocial}}" placeholder="Razón"></input>
                                                                        <label for="razon">Razón Social</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col-md-12">
                                                                    <div class="form-floating">
                                                                        <input class="form-control" id="nombreE{{$cliente->idCliente}}" name="nombreE{{$cliente->idCliente}}" value="{{$cliente->NombreComercial}}" placeholder="Nombre Comercial"></input>
                                                                        <label for="nombre">Nombre Comercial</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col-md-12">
                                                                    <div class="form-floating">
                                                                        <input class="form-control" id="direcE{{$cliente->idCliente}}" name="direcE{{$cliente->idCliente}}"  value="{{$cliente->Direccion}}" placeholder="Dirección"></input>
                                                                        <label for="direc">Dirección</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col-md-12">
                                                                    <div class="form-floating">
                                                                        <input class="form-control" id="rubro{{$cliente->idCliente}}" name="rubro{{$cliente->idCliente}}" value="{{$cliente->Rubro}}" placeholder="Rubro"></input>
                                                                        <label for="rubro">Rubro</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="row mb-3">
                                                                <div class="col-md-4">
                                                                    <div class="form-floating mb- mb-md-0">
                                                                        <input class="form-control"  id="dni{{$cliente->idCliente}}" name="dni{{$cliente->idCliente}}" type="text" value="{{$cliente->per_dni}}" placeholder="DNI" disabled/>
                                                                        <label for="ruc">DNI</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col-md-6">
                                                                    <div class="form-floating">
                                                                        <input class="form-control" id="nombres{{$cliente->idCliente}}" name="nombres{{$cliente->idCliente}}" value="{{$cliente->per_nombres}}" placeholder="Nombres"></input>
                                                                        <label for="razon">Nombres</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-floating">
                                                                        <input class="form-control" id="apellidos{{$cliente->idCliente}}" name="apellidos{{$cliente->idCliente}}" value="{{$cliente->per_apellidos}}" placeholder="Apellidos"></input>
                                                                        <label for="nombre">Apellidos</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col-md-4">
                                                                    <div class="form-floating">
                                                                        <input class="form-control" id="nacimiento{{$cliente->idCliente}}" name="nacimiento{{$cliente->idCliente}}" type="date" value="{{$cliente->per_nacimiento}}" placeholder="Dirección"/>
                                                                        <label for="colNac">Nacimiento</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-floating">
                                                                        <select class="form-select" name="sexo" id="sexo{{$cliente->idCliente}}" class="form-control" required>
                                                                            @foreach ($sexos as $sexo)
                                                                                <option value="{{$sexo->idSexo}}"  @if($cliente->idSexo==$sexo->idSexo)selected="true" @endif>{{$sexo->Sex_nombre}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        <label for="colSexo">Sexo</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-floating">
                                                                        <input class="form-control" id="celular{{$cliente->idCliente}}" name="celular{{$cliente->idCliente}}" type="text" value="{{$cliente->per_cel}}" placeholder="Celular"/>
                                                                        <label for="colCel">Celular</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col-md-12">
                                                                    <div class="form-floating">
                                                                        <input class="form-control" id="direcP{{$cliente->idCliente}}" name="direcP{{$cliente->idCliente}}" value="{{$cliente->per_direccion}}" placeholder="Dirección"></input>
                                                                        <label for="direc">Dirección</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        
                                                        <button type="button" class="btn btn-primary" onclick='actualizar({{$cliente->idCliente}});'><strong> Guardar</strong></button>
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
