@extends('base.content')
@section('styles')
<?php echo Html::script('js/autocomplete/presupuesto.js')?>
@endsection
@section('contenido')
<div class="container-fluid px-4">
    <div class="row">
        
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-file-alt"> Datos Cabecera</i>
                    
                </div>
                
                <div class="card-body">
                    <form action="POST">
                        @csrf
                        <h6>Datos Cliente</h6>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <?php $cantEmp = count($empresas) ?>
                                @if($cantEmp>0)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tipoCliente" id="OptEmpresa" onclick='showDiv();' checked>
                                        <label class="form-check-label" for="inlineRadio2">Empresa</label>
                                    </div>
                                
                                @endif
                                <?php $cantPer = count($personas) ?>
                                @if($cantPer>0)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tipoCliente" id="OptPersona" onclick='showDiv();'>
                                        <label class="form-check-label" for="inlineRadio1">Persona</label>
                                    </div>
                                
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3" id="persona">
                            <div class="col-md-2" >
                                <div class="form-floating mb- mb-md-0">
                                    <select class="form-select" name="clienteP" id="clienteP" onchange='buscaCliente();' class="form-control" required>
                                    @foreach($personas as $persona)
                                        <option value="{{$persona->idPersona}}">{{$persona->per_dni}}</option>
                                    @endforeach
                                    </select>
                                    <label for="tipo">DNI</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3" id="empresa">
                            <div class="row mb-3">
                                <div class="col-md-2" >
                                    <div class="form-floating mb- mb-md-0">
                                    <select class="form-select" name="clienteE" id="clienteE" onchange='buscaClienteInfo();' class="form-control" required>
                                        @foreach($empresas as $empresa)
                                            <option value="{{$empresa->idCliente}}">{{$empresa->RUC}}</option>
                                        @endforeach
                                        </select>
                                        <label for="tipo">RUC</label>
                                    </div>
                                </div>
                                
                                <div class="col-md-5">
                                    <div class="form-floating mb- mb-md-0">
                                        <input class="form-control"  id="nombre" name="nombre" 
                                        type="text" placeholder="Nombre"/>
                                        <label for="nombre">Nombre</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-3" id="responsable">
                                <h6>Datos Responsable</h6>
                                <div class="col-md-3" >
                                    <div class="form-floating mb- mb-md-0">
                                    <select class="form-select" name="nameRes" id="nameRes" onchange='buscaRespInfo();' class="form-control" required>
                                        @foreach($responsables as $resp)
                                            <option value="{{$resp->idResponsable}}">{{$resp->res_apellidos}} {{$resp->res_nombres}}</option>
                                        @endforeach
                                        </select>
                                        <label for="nameRes">Responsable</label>
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="form-floating mb- mb-md-0">
                                        <input class="form-control"  id="carRes" name="carRes" 
                                        type="text" placeholder="Cargo" disabled/>
                                        <label for="carRes">Cargo</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-floating mb- mb-md-0">
                                        <input class="form-control"  id="celRes" name="celRes" 
                                        type="text" placeholder="Celular" disabled/>
                                        <label for="celRes">Celular</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating mb- mb-md-0">
                                        <input class="form-control"  id="emailRes" name="emailRes" 
                                        type="text" placeholder="Correo" disabled/>
                                        <label for="emailRes">Correo</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <h6>Otros datos</h6>
                            <div class="col-md-4">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="asunto" name="asunto" 
                                    type="text" placeholder="Asunto"/>
                                    <label for="asunto">Concepto</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="lugar" name="lugar" 
                                    type="text" placeholder="Lugar"/>
                                    <label for="lugar">Lugar</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-floating">
                                    <input class="form-control" id="fecha" name="fecha"
                                        type="date" placeholder="Dirección"/>
                                    <label for="fecha">Fecha</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="btn">
            <div class="row">
                <div class="col-md-2">
                    <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#modalAdd" onclick='inicio();'>
                        Agregar Servicio
                    </button>
                </div>
                
            </div>
        </div>
        <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
            <div class="modal-dialog " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">AGREGAR SERVICIO</h5>
                    </div>

                    <div class="card-body">
                        <form method="get">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb- mb-md-0">
                                        <select class="form-select" name="codServ" id="codServ" class="form-control" onchange='buscaServicio()' required>
                                            @foreach ($servicios as $servicio)
                                                <option value="{{$servicio->idServicio}}" >{{$servicio->codServicio}}</option>
                                            @endforeach
                                        </select>
                                        <label for="codServ">Código</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-8">
                                    <div class="form-floating mb- mb-md-0">
                                        <input class="form-control"  id="servicio" name="servicio"
                                        type="text" placeholder="Servicio"/>
                                        <label for="servicio">Nombre Servicio</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input class="form-control"  id="costo" name="costo"
                                        type="text" placeholder="Costo"/>
                                        <label for="costo">Costo</label>
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
                    <i class="fas fa-tasks"> Detalle</i>
                    
                </div>
                <div class="card-body">
                    <table class="table" id="detalle">
                        <thead>
                            <tr>
                                <th scope="col">Código</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Costo Unit. </th>
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
        <div class="col-lg-3">
            <div class="card mb-4">
                <div class="card-header">
                <i class="fas fa-file-invoice-dollar"> Otros Gastos</i>                 
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="form-floating mb- mb-md-0">
                                <input class="form-control"  id="admGastos" name="admGastos" 
                                type="text" placeholder="Otros"/>
                                <label for="admGastos">Gastos Administrativos</label>
                            </div>
                        </div>
                    </div>
                
                </div>
            </div>
        </div>
        <div class="btn">
            <div class="row">
                <div class="col-md-2">
                    <button type="button" class="btn btn-primary" onclick='registrar();' onclick="location.href='{{route('presupuesto.register')}}'" >
                        Registrar
                    </button>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-primary"  onclick="location.href='{{route('presupuesto.register')}}'">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
