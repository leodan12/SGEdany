@extends('base.content')
@section('styles')
<?php echo Html::script('js/alertas/producto.js')?>
<?php echo Html::script('js/autocomplete/producto.js')?>
@endsection
@section('contenido')
<div class="container-fluid px-4">
    <div class="btn">
        <div class="col-xl-3 col-md-6">
            <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#modalAdd" onclick='cargarCodigoTipo();'>
                Agregar
            </button>
        </div>
    </div>
    <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">NUEVO PRODUCTO</h5>
                </div>


                <div class="card-body">
                    <form method="POST">
                        @csrf
                        <div class="row mb-3">
                            <h5>Tipo Producto</h5>
                            <div class="col-md-6">
                                <div class="form-floating mb- mb-md-0">
                                    <select class="form-select" name="tipo" id="tipo" class="form-control" onchange=' cargarCodigoTipo();' required>
                                        @foreach ($tipos as $tipo)
                                            <option value="{{$tipo->idTipoProd}}">{{$tipo->TP_nombre}}</option>
                                        @endforeach
                                    </select>
                                    <label for="tipo">Tipo Producto</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="cod" name="cod"
                                    type="text" placeholder="Código"/>
                                    <label for="producto">Codigo Tipo Producto</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <h5>Datos Producto</h5>
                            <div class="col-md-12">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="nombre" name="nombre"
                                    type="text" placeholder="Nombre"/>
                                    <label for="nombre">Nombre Producto</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="precio" name="precio"
                                    type="text" placeholder="Precio"/>
                                    <label for="precio">Precio</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="unidMed" name="unidMed"
                                    type="text" placeholder="Unidad de Medida"/>
                                    <label for="unidMed">Unid. Med.</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="minimo" name="minimo"
                                    type="number" min="0" placeholder="Stock minimo"/>
                                    <label for="unidMed">Stock Mínimo</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <textarea class="form-control"  name="descripcion" id="descripcion"  placeholder="Descripcion"></textarea>
                                    <label for="descripcion">Descripción</label>
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
                PRODUCTOS
            </div>
            <div class="card-body">
                <table class="table" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th scope="col" style="text-align: center">Nro.</th>
                            <th scope="col">Código</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Unidad Medida</th>
                            <th scope="col">Stock Mínimo</th>
                            <th scope="col"><i class="fas fa-cogs"></i> Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $cont=1 @endphp
                        @foreach ($productos as $prod)
                        <tr>
                            <td scope="row" style="text-align: center">{{$cont}}</td>
                            <td >{{$prod->codProducto}}</td>
                            <td >{{$prod->Prod_nombre}}</td>
                            <td >{{$prod->Prod_precio}}</td>
                            <td >{{$prod->Prod_unidMed}}</td>
                            <td >{{$prod->Stock_minimo}}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-primary" onclick='modal({{$prod->idProducto}});'><i class="fas fa-edit" style="color: white"></i></button>
                                    @if($prod->Prod_estado=='inactivo')
                                        <button type="button" class="btn btn-success" onclick="cambioEstado('habilitar',{{$prod->idProducto}});" ><i class="fas fa-check-circle"></i></button>
                                    @else
                                        <button type="button" class="btn btn-danger" onclick="cambioEstado('inhabilitar',{{$prod->idProducto}});" placeholder="Inhabilitar"><i class="fas fa-times-circle"></i></button>
                                    @endif
                                </div>
                                <div class="modal fade" id="modalAct{{$prod->idProducto}}" tabindex="-1" aria-labelledby="modalActLabel" aria-hidden="true">
                                    <div class="modal-dialog " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">ACTUALIZAR PRODUCTO</h5>
                                            </div>


                                            <div class="card-body">
                                                <form method="POST">
                                                    @csrf
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb- mb-md-0">
                                                                <select class="form-select" name="tipo{{$prod->idProducto}}" id="tipo{{$prod->idProducto}}" class="form-control" required>
                                                                    @foreach ($tipos as $tipo)
                                                                        <option value="{{$tipo->idTipoProd}}" @if($prod->idTipoProd==$tipo->idTipoProd)selected="true"@endif>{{$tipo->TP_nombre}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <label for="tipo">Tipo Producto</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb- mb-md-0">
                                                                <input class="form-control"  id="codigo{{$prod->idProducto}}" name="codigo{{$prod->idProducto}}"
                                                                type="text" value="{{$prod->codProducto}}" placeholder="codigo" disabled/>
                                                                <label for="codigo">Código Producto</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <div class="form-floating mb- mb-md-0">
                                                                <input class="form-control"  id="nombre{{$prod->idProducto}}" name="nombre{{$prod->idProducto}}"
                                                                type="text" value="{{$prod->Prod_nombre}}" placeholder="Nombre"/>
                                                                <label for="nombre">Nombre Producto</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-4">
                                                            <div class="form-floating mb- mb-md-0">
                                                                <input class="form-control"  id="precio{{$prod->idProducto}}" name="precio{{$prod->idProducto}}"
                                                                type="text" value="{{$prod->Prod_precio}}" placeholder="Precio"/>
                                                                <label for="precio">Precio</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-floating mb- mb-md-0">
                                                                <input class="form-control"  id="unidMed{{$prod->idProducto}}" name="unidMed{{$prod->idProducto}}"
                                                                type="text" value="{{$prod->Prod_unidMed}}" placeholder="Unidad de Medida"/>
                                                                <label for="unidMed">Unid. Med.</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-floating mb- mb-md-0">
                                                                <input class="form-control"  id="minimo{{$prod->idProducto}}" name="minimo{{$prod->idProducto}}"
                                                                type="number" min="0" value="{{$prod->Stock_minimo}}" placeholder="Stock Minimo"/>
                                                                <label for="minimo">Stock Mínimo</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <div class="form-floating">
                                                                <textarea class="form-control"  name="descripcion{{$prod->idProducto}}" id="descripcion{{$prod->idProducto}}" placeholder="Descripcion">{{$prod->Prod_descripcion}}</textarea>
                                                                <label for="descripcion">Descripción</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="btn btn-primary" onclick='actualizar({{$prod->idProducto}});'><strong> Guardar</strong></button>
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
