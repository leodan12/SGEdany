@extends('base.content')
@section('styles')
<?php echo Html::script('js/reportes/hojaAlmacen.js')?>
@endsection
@section('contenido')
<div class="container-fluid px-4">
    <div class="row">
        <div class="col-lg-9">
        <h3 id="{{$hoja->idHojMov}}"><b>{{$NroHoja}}</b></h3>
        </div>
        <div class="col-lg-3">
        <h3 class="tCabecera"><b> TOTAL: S/{{$total}}</b></h3>
        </div>
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-file-alt"></i>
                    DATOS CABECERA
                </div>
                
                <div class="card-body">

                    <div class="row mb-3">
                        <h6>Datos Colaborador</h6>
                        <div class="col-md-2">
                            <div class="form-floating mb- mb-md-0">
                                <input class="form-control"  id="dni" name="dni" value="{{$colaborador->per_dni}}"
                                type="text" placeholder="dni" disabled/>
                                <label for="dni">DNI</label>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-floating mb- mb-md-0">
                                <input class="form-control"  id="nombre" name="nombre" value="{{$colaborador->persona->per_nombres.' '.$colaborador->persona->per_apellidos}}"
                                type="text" placeholder="nombre" disabled/>
                                <label for="nombre">Nombre Colaborador</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <h6>Datos Hoja de Almacén</h6>
                        <div class="col-md-2">
                            <div class="form-floating mb- mb-md-0">
                                <input class="form-control"  id="tipo" name="tipo" @if($tipo == 'E')value="ENTRADA" @else value="SALIDA"@endif
                                type="text" placeholder="Tipo" disabled/>
                                <label for="tipo">Tipo</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            @if ($tipo == 'E')
                                
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-floating mb- mb-md-0">
                                                <input class="form-control"  id="tipo" name="tipo" value="{{$hoja->Dcmto_codigo}}"
                                                type="text" placeholder="Tipo" disabled/>
                                                <label for="idDoc">Código </label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-floating mb- mb-md-0">
                                                <input class="form-control"  id="ruc" name="ruc" value="{{$hoja->RUC}}"
                                                type="text" placeholder="ruc" disabled/>
                                                <label for="ruc">RUC Empresa</label>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-floating mb- mb-md-0">
                                                <input class="form-control"  id="nombreE" name="nombreE" value="{{$hoja->NombreComercial}}"
                                                type="text" placeholder="nombreE" disabled/>
                                                <label for="nombreE">Nombre Empresa</label>
                                            </div>
                                        </div>
                                    </div>
                                
                            @endif
                            @if($tipo=='S')
                                
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-floating mb- mb-md-0">
                                                <textarea class="form-control" name="descripcion" id="descripcion" 
                                                style="min-height:58px;" placeholder="Descripción" disabled>{{$hoja->Sal_descripcion}}</textarea>
                                                <label for="descripcion">Descripción</label>
                                            </div>
                                        </div>
                                    </div>
                               
                            @endif
                        </div>
                        
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
                    <table class="table" id="detalleAct">
                        <thead>
                            <tr>
                                <th scope="col">Nro</th>
                                <th scope="col">Código</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody >
                            @php $cont=0 @endphp
                            @foreach($detalle as $det)
                                <tr>
                                    <td>{{$cont+1}}</td>
                                    <td>{{$det->codProducto}}</td>
                                    <td>{{$det->Prod_nombre}}</td>
                                    <td>S/{{$det->Mov_costo}}</td>
                                    <td>{{$det->Mov_cantidad}}</td>
                                    <td>S/{{$subtotal[$cont]}}</td>
                                </tr>
                            @php $cont++ @endphp
                            @endforeach
                        </tbody>
                        
                    </table> 
                </div>
            </div>
        </div>
        
            <div class="row">
                <div class="col-md-2">
                    <button type="button" class="btn btn-success" onclick='pdf();' >
                        Imprimir
                    </button>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-primary"  onclick="location.href='{{route('hojaAlmacen.register')}}'">
                        Atrás
                    </button>
                </div>
            </div>
        
    </div>
</div>
@endsection
