@extends('base.content')
@section('styles')
<?php echo Html::script('js/Autocomplete/documento.js')?>
<?php echo Html::script('js/alertas/documento.js')?>
@endsection
@section('contenido')
<div class="container-fluid px-4">
    <div class="btn">
        <div class="col-xl-3 col-md-6">
            <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#modalAdd" onclick='limpiarModal(); buscaEmpresa();'> 
                Agregar
            </button>
        </div>
    </div>
    <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">NUEVO COMPROBANTE</h5>
                </div>


                <div class="card-body">
                    <form method="POST" action="#" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <h5>Datos Proveedor</h5>
                            <div class="col-md-6">
                                <div class="form-floating mb- mb-md-0">
                                    <select class="form-select" name="rucDoc" id="rucDoc" class="form-control" onchange='buscaEmpresa();' required>
                                        
                                        @foreach ($empresas as $emp)
                                            <option value="{{$emp->idEmpresa}}">{{$emp->RUC}}</option>
                                        @endforeach
                                    </select>
                                    <label for="codDoc">RUC</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="nombre" name="nombre"
                                    type="text" placeholder="Tipo" disabled/>
                                    <label for="codDoc">Nombre</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <h5>Datos Comprobante</h5>
                            <div class="col-md-6">
                                <div class="form-floating mb- mb-md-0">
                                    <select class="form-select" name="tipoDoc" id="tipoDoc" class="form-control" required>
                                        @foreach ($tipos as $tipo)
                                            <option value="{{$tipo->idTipoDcmto}}">{{$tipo->TD_nombre}}</option>
                                        @endforeach
                                    </select>
                                    <label for="tipoDoc">Tipo</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="codDoc" name="codDoc"
                                    type="text" placeholder="Tipo"/>
                                    <label for="codDoc">Código</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="precioDoc" name="precioDoc"
                                    type="text" placeholder="Tipo"/>
                                    <label for="precioDoc">Precio</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input class="form-control" id="emiDoc" name="emiDoc" type="date" placeholder="Emitido el"/>
                                    <label for="emiDoc">Emitido el</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="custom-file-input" id="fileDoc" name="fileDoc"
                                    type="file" placeholder="Tipo"/>
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
                COMPROBANTES
            </div>
            <div class="card-body">
                <table class="table" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th scope="col" style="text-align: center">Nro.</th>
                            <th scope="col">Código</th>
                            <th scope="col">Proveedor</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Emision</th>
                            <th scope="col">Estado</th>
                            <th scope="col"><i class="fas fa-cogs"></i> Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $cont=1 @endphp
                        @foreach ($docs as $doc)
                        <tr>
                            <td scope="row" style="text-align: center">{{$cont}}</td>
                            <td >{{$doc->Dcmto_codigo}}</td>
                            <td >{{$doc->RUC}}</td>
                            <td >{{$doc->Dcmto_precio}}</td>
                            <?php $registro = date_format(date_create(strval($doc->Dcmto_emision)),'d-m-Y')?>
                            <td >{{$registro}}</td>
                            <td>
                                @if($doc->Dcmnto_estado=='inactivo')
                                    <span class="badge bg-dark" >Inactivo</span>
                                @else
                                    <span class="badge bg-warning text-dark">Activo</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    @if($doc->Dcmto_estado=='inactivo')
                                        <button type="button" class="btn btn-success" onclick="cambioEstado('habilitar',{{$doc->idDocumento}});" ><i class="fas fa-check-circle"></i></button>
                                    @else
                                        <button type="button" class="btn btn-primary" onclick='modal({{$doc->idDocumento}});'><i class="fas fa-edit" style="color: white"></i></button>
                                        <button type="button" class="btn btn-secondary" onclick='modalVis({{$doc->idDocumento}});'><i class="fas fa-eye"></i></button>
                                        @if($doc->Dcmto_estado=='activo')
                                        <button type="button" class="btn btn-danger" onclick="cambioEstado('inhabilitar',{{$doc->idDocumento}});" placeholder="Inhabilitar"><i class="fas fa-times-circle"></i></button>
                                        @endif
                                    @endif
                                </div>
                                <div class="modal fade" id="modalAct{{$doc->idDocumento}}" tabindex="-1" aria-labelledby="modalActLabel" aria-hidden="true">
                                    <div class="modal-dialog " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">ACTUALIZAR COMPROBANTE</h5>
                                            </div>

                                            <div class="card-body">
                                                <form method="POST" action="#">
                                                    @csrf
                                                    <div class="row mb-3">
                                                        <h5>Datos Proveedor</h5>
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb- mb-md-0">
                                                                <select class="form-select" name="rucDoc{{$doc->idDocumento}}" id="rucDoc{{$doc->idDocumento}}" class="form-control" onchange='buscaEmpresa();' required>
                                                                    @foreach ($empresas as $emp)
                                                                        <option value="{{$emp->idEmpresa}}" @if($doc->idEmpresa==$tipo->idEmpresa) selected="true" @endif>{{$emp->RUC}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <label for="codDoc">RUC</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb- mb-md-0">
                                                                <input class="form-control"  id="nombre{{$doc->idDocumento}}" name="nombre{{$doc->idDocumento}}" value="{{$doc->NombreComercial}}"
                                                                type="text" placeholder="Tipo"  disabled/>
                                                                <label for="codDoc">Nombre</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <h5>Datos Comprobante</h5>
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb- mb-md-0">
                                                                <select class="form-select" name="tipoDoc{{$doc->idDocumento}}" id="tipoDoc{{$doc->idDocumento}}" class="form-control" required>
                                                                    @foreach ($tipos as $tipo)
                                                                        <option value="{{$tipo->idTipoDcmto}}" @if($doc->idTipoDcmto==$tipo->idTipoDcmto) selected="true" @endif>{{$tipo->TD_nombre}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <label for="tipoDoc">Tipo</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb- mb-md-0">
                                                                <input class="form-control"  id="codDoc{{$doc->idDocumento}}" name="codDoc{{$doc->idDocumento}}"
                                                                type="text" value="{{$doc->Dcmto_codigo}}" placeholder="Tipo"/>
                                                                <label for="codDoc">Código</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-4">
                                                            <div class="form-floating mb- mb-md-0">
                                                                <input class="form-control"  id="precioDoc{{$doc->idDocumento}}" name="precioDoc{{$doc->idDocumento}}"
                                                                type="text" value="{{$doc->Dcmto_precio}}" placeholder="Tipo"/>
                                                                <label for="precioDoc">Precio</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-floating">
                                                                <input class="form-control" id="emiDoc{{$doc->idDocumento}}" name="emiDoc{{$doc->idDocumento}}" 
                                                                type="date" value="{{$doc->Dcmto_emision}}" placeholder="Emitido el"/>
                                                                <label for="emiDoc">Emitido el</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="modal-dialog" role="document">
                                                            <img style="height:60px" src="{{asset('img/comprobantes/'.$doc->Dcmto_archivo)}}" alt="">
                                                        </div>
                                                    </div>
                                                    <button type="button" class="btn btn-primary" onclick='verificarAct({{$doc->idDocumento}});'><strong> Guardar</strong></button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                </form>    

                                            </div>
                                        </div>
                                    </div> 
                                </div>
                                <div class="modal fade" id="modalVis{{$doc->idDocumento}}" tabindex="-1" aria-labelledby="modalVisLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">VER COMPROBANTE</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="modal-dialog" role="document">
                                                    <img style="width:400px" src="{{asset('img/comprobantes/'.$doc->Dcmto_archivo)}}" alt="">
                                                </div>
                                                
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
