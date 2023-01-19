@extends('base.content')
@section('styles')
<?php echo Html::script('js/reportes/presupuesto.js')?>
<?php echo Html::script('js/alertas/presupuesto.js')?>
@endsection
@section('contenido')
<div class="container-fluid px-4">
    <div class="row">
        <div class="col-lg-9">
            <h3 id="{{$presupuesto->idPresupuesto}}"><b>{{$presupuesto->codPresupuesto}}</b></h3>
        </div>
        <div class="col-lg-3">
            <h3 class="tCabecera"><b> TOTAL: S/{{$presupuesto->costoTotal}}</b></h3>
        </div>
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-file-alt"> DATOS CABECERA</i>
                    
                </div>
                
                <div class="card-body">

                    <div class="row mb-3">
                        <h6>Datos Cliente</h6>
                        <div class="col-md-2">
                            <div class="form-floating mb- mb-md-0">
                                <input class="form-control"  id="empresa" name="empresa" value="{{$presupuesto->clie_identificador}}"
                                type="text" placeholder="empresa" disabled/>
                                <?php $cant = strlen($presupuesto->clie_identificador) ?>
                                @if ($cant>8)
                                    <label for="empresa">RUC</label>
                                @else
                                    <label for="empresa">DNI</label>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-floating mb- mb-md-0">
                                @if ($cant>8)
                                    <input class="form-control"  id="nombre" name="nombre" value="{{$presupuesto->RazonSocial}}"
                                    type="text" placeholder="nombre" disabled/>
                                @else
                                    <input class="form-control"  id="nombre" name="nombre" value="{{$presupuesto->per_apellidos.', '.$presupuesto->per_nombres}}"
                                    type="text" placeholder="nombre" disabled/>
                                @endif
                                
                                <label for="nombre">Nombre Cliente</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <h6>Datos Responsable</h6>
                        <div class="col-md-3">
                            <div class="form-floating mb- mb-md-0">
                                <input class="form-control"  id="nameRes" name="nameRes" value="{{$presupuesto->res_apellidos}} {{$presupuesto->res_nombres}}"
                                type="text" placeholder="Nombre" disabled/>
                                <label for="nameRes">Nombre</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating mb- mb-md-0">
                                <input class="form-control"  id="carRes" name="carRes" value="{{$presupuesto->res_cargo}}"
                                type="text" placeholder="Cargo" disabled/>
                                <label for="carRes">Cargo</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating mb- mb-md-0">
                                <input class="form-control"  id="celRes" name="celRes" value="{{$presupuesto->res_contacto}}"
                                type="text" placeholder="Contacto" disabled/>
                                <label for="celRes">Contacto</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating mb- mb-md-0">
                                <input class="form-control"  id="emailRes" name="emailRes" value="{{$presupuesto->res_correo}}"
                                type="text" placeholder="Correo" disabled/>
                                <label for="emailRes">Correo</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-tasks"> Detalle</i>
                    
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
                                    <td>{{$det->codServicio}}</td>
                                    <td>{{$det->serv_nombre}}</td>
                                    <td>S/{{$det->costUnid}}</td>
                                    <td>{{$det->cantidad}}</td>
                                    <td>S/{{$subtotal[$cont]}}</td>
                                </tr>
                            @php $cont++ @endphp
                            @endforeach
                        </tbody>
                        
                    </table> 
                </div>
            </div>
        </div>
        <div class="col-lg-9" style="margin-top: -10px; margin-bottom: 10px">
            <h5><b>Gastos Administrativos: S/{{$presupuesto->gastosAdm}}</b></h5>
        </div>

        <div class="col-lg-12">
            <button type="button" class="btn btn-success" onclick='pdf();' onclick="location.href='{{route('hojaAlmacen.register')}}'" >
            <i class="fas fa-file-pdf"> Generar PDF</i>
            </button>

            @if ($presupuesto->pres_estado != 'informado')
                <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#modalInforme" onclick='limpiarImagenes();'>
                    <i class="fas fa-file-alt"> Crear Informe</i>
                </button>
                <div class="modal fade" id="modalInforme" tabindex="-1" aria-labelledby="modalInformeLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">CREAR INFORME {{$presupuesto->codPresupuesto}} </h5>
                            </div>

                            <div class="card-body">
                                <form method="POST">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                        <label for="producto">Cargar imágenes: </label>
                                            <div class="form-floating mb- mb-md-0">
                                                
                                                <input class="form-control"  id="images" name="images[]"
                                                type="file" placeholder="Código" accept="image/png, .jpeg, .jpg" multiple />
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary" onclick='crearInforme();'><strong> Guardar</strong></button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <button type="button" class="btn btn-danger"  onclick="location.href='{{route('presupuesto.register')}}'">
                <i class="fas fa-file-download"> Ver Informe</i>
                </button>
            @endif

            <button type="button" class="btn btn-secondary"  onclick="location.href='{{route('presupuesto.register')}}'">
            <i class="fas fa-arrow-alt-circle-left"> Atrás</i>
            </button>
        </div>
        
    </div>
</div>
@endsection
