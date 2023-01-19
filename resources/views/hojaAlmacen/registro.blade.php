@extends('base.content')
@section('styles')
<?php echo Html::script('js/autocomplete/hojaAlmacen.js')?>
<?php echo Html::script('js/alertas/hojaAlmacen.js')?>
@endsection
@section('contenido')
<div class="container-fluid px-4">
    <div class="row">
        
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-file-alt"></i>
                    Datos Cabecera
                </div>
                
                <div class="card-body">

                    <div class="row mb-3">
                        <h6>Datos Colaborador</h6>
                        <div class="col-md-2">
                            <div class="form-floating mb- mb-md-0">
                                <input class="form-control"  id="dni" name="dni" value="{{Auth::User()->persona->per_dni}}"
                                type="text" placeholder="dni" disabled/>
                                <label for="dni">DNI</label>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-floating mb- mb-md-0">
                                <input class="form-control"  id="nombre" name="nombre" value="{{Auth::User()->persona->per_nombres.' '.Auth::User()->persona->per_apellidos}}"
                                type="text" placeholder="nombre" disabled/>
                                <label for="nombre">Nombre Colaborador</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <h6>Datos Hoja de Almacén</h6>
                        <div class="col-md-2">
                            <div class="form-floating mb- mb-md-0">
                                <select class="form-select" name="tipo" id="tipo" onchange='showDiv();' class="form-control" required>
                                    <option value="entrada">Entrada</option>
                                    <option value="salida">Salida</option>
                                </select>
                                <label for="tipo">Tipo</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div name="entrada" id="entrada">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-floating mb- mb-md-0">
                                            
                                            <select class="form-select" name="idDoc" id="idDoc" onchange='showDatosEmpresa();' class="form-control" required>
                                                @foreach($documentos as $doc)
                                                    <option value="{{$doc->idDocumento}}">{{$doc->Dcmto_codigo}}</option>
                                                @endforeach
                                            </select>
                                            <label for="idDoc">Código</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-floating mb- mb-md-0">
                                            <input class="form-control"  id="ruc" name="ruc" 
                                            type="text" placeholder="ruc"/>
                                            <label for="ruc">RUC Empresa</label>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-floating mb- mb-md-0">
                                            <input class="form-control"  id="nombreE" name="nombreE" 
                                            type="text" placeholder="nombreE"/>
                                            <label for="nombreE">Nombre Empresa</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div name="salida" id="salida">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-floating mb- mb-md-0">
                                            <textarea class="form-control" name="descripcion" id="descripcion" style="min-height:58px;" placeholder="Descripción" ></textarea>
                                            <label for="descripcion">Descripción</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="btn">
            <div class="row">
                <div class="col-md-2">
                    <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#modalAdd" onclick='buscaProducto(); limpiarModal();'>
                        Agregar Producto
                    </button>
                </div>
                
            </div>
        </div>
        <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
            <div class="modal-dialog " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar Producto</h5>
                    </div>

                    <div class="card-body">
                        <form method="get">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb- mb-md-0">
                                        <select class="form-select" name="codProd" id="codProd" class="form-control" onchange='buscaProducto()' required>
                                            @foreach ($productos as $producto)
                                                <option value="{{$producto->idProducto}}" >{{$producto->codProducto}}</option>
                                            @endforeach
                                        </select>
                                        <label for="codProd">Código</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-8">
                                    <div class="form-floating mb- mb-md-0">
                                        <input class="form-control"  id="producto" name="producto"
                                        type="text" placeholder="Producto"/>
                                        <label for="producto">Nombre Producto</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input class="form-control"  id="precio" name="precio"
                                        type="text" placeholder="Precio"/>
                                        <label for="colApell">Precio</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input class="form-control"  id="cant" name="cant"
                                        type="number" placeholder="Cantidad" min="1"/>
                                        <label for="cant">Cantidad</label>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary" onclick='addFila();' ><strong> Guardar</strong></button>
                            <button type="button" class="btn btn-secondary" onclick='limpiarDatos();' data-bs-dismiss="modal">Cancelar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-tasks"></i>
                    Detalle
                </div>
                <div class="card-body">
                    <table class="table" id="detalle">
                        <thead>
                            <tr>
                                <th scope="col">Código</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Precio Unit.</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Subtotal</th>
                                <th scope="col"><i class="fas fa-cogs"></i> Opciones</th>
                            </tr>
                        </thead>
                        <tbody >
                            
                        </tbody>
                    </table> 
                </div>
            </div>
        </div>
        <div class="btn">
            <div class="row">
                <div class="col-md-2">
                    <button type="button" class="btn btn-primary" onclick='registrar();'>
                        Registrar
                    </button>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-primary"  onclick="location.href='{{route('hojaAlmacen.register')}}'">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
