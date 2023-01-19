@extends('base.content')
@section('styles')
<?php echo Html::script('js/autocomplete/colaborador.js')?>
@endsection
@section('contenido')

<div class="container-fluid px-4">
    <div class="card mb-4">
        <div class="card-header">
            NUEVO COLABORADOR
        </div>

        <div class="card-body">
            <form method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-3">
                        <div class="form-floating mb- mb-md-0">
                            <input
                                class="form-control"
                                id="colNombres"
                                name="colNombres"
                                type="text"
                                placeholder="Nombres"/>
                            <label for="colNombres">Nombres</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input
                                class="form-control"
                                id="colApell"
                                name="colApell"
                                type="text"
                                placeholder="Apellidos Completos"/>
                            <label for="colApell">Apellidos</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-floating">
                            <input
                                class="form-control"
                                id="colDNI"
                                name="colDNI"
                                type="text"
                                placeholder="Documento de identidad"/>
                            <label for="colDNI">DNI</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-floating">
                            <input
                                class="form-control"
                                id="colNac"
                                name="colNac"
                                type="date"
                                placeholder="Dirección"/>
                            <label for="colNac">Nacimiento</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-floating">
                            <select class="form-select" name="colSexo" id="colSexo" class="form-control" required>
                                @foreach ($sexos as $sexo)
                                    <option value="{{$sexo->idSexo}}">{{$sexo->Sex_nombre}}</option>
                                @endforeach
                            </select>
                            <label for="colSexo">Sexo</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input
                                class="form-control"
                                id="colDirec"
                                name="colDirec"
                                type="text"
                                placeholder="Dirección"/>
                            <label for="colDirec">Dirección</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-floating">
                            <input
                                class="form-control"
                                id="colCel"
                                name="colCel"
                                type="text"
                                placeholder="Celular"/>
                            <label for="colCel">Celular</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-floating">
                            <select class="form-select" name="colCargo" id="colCargo" class="form-control" required>
                                @foreach ($cargos as $cargo)
                                    <option value="{{$cargo->idCargo}}">{{$cargo->Car_nombre}}</option>
                                @endforeach
                            </select>
                            <label for="colCargo">Cargo</label>
                        </div> 
                    </div>
                    <div class="col-md-2">
                        <div class="form-floating">
                        <input
                                class="form-control"
                                id="colSueldo"
                                name="colSueldo"
                                type="text"
                                placeholder="Sueldo"/>
                            <label for="colSueldo">Sueldo</label>
                        </div> 
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <select class="form-select" name="colRol" id="colRol" class="form-control" required>
                                @foreach ($roles as $rol)
                                    <option value="{{$rol->idRol}}">{{$rol->rol_nombre}}</option>
                                @endforeach
                            </select>
                            <label for="colSexo">Rol</label>
                        </div>
                    </div>    
                </div>
                <div class="row mb-3">
                    <div class="col-md-2">
                        <div class="form-floating">
                            <select class="form-select" name="colPension" id="colPension" class="form-control" onchange="show();" required>
                                @foreach ($pensiones as $pen)
                                    <option value="{{$pen->idSistPension}}">{{$pen->Pen_nombre}}</option>
                                @endforeach
                            </select>
                            <label for="colPension">Pensión</label>
                        </div> 
                    </div>
                    <div class="col-md-2" id="comision">
                        <div class="form-floating">
                            <select class="form-select" name="colComision" id="colComision" class="form-control" enable="false">
                                <option value="flujo">FLUJO</option>
                                <option value="mixta">MIXTA</option>
                            </select>
                            <label for="colComision">Comisión</label>
                        </div> 
                    </div>
                    <div class="col-md-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="colAsigFam" id="colAsigFam">
                            <label class="form-check-label" for="flexCheckDefault">
                                ASIG: FAMILIAR
                            </label>
                        </div>
                        
                    </div>
                    <div class="col-md-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="colSctr" id="colSctr">
                            <label class="form-check-label" for="flexCheckChecked">
                            SCTR
                            </label>
                        </div>
                    </div>
                </div>
                <div class="mt-4 mb-0">
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <div class="d-grid">
                                <button type="button" class="btn btn-primary" onclick="guardar();"><strong> Guardar</strong></button>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="d-grid">
                                <button type="button" class="btn btn-secondary" onclick="location.href='{{Route('colaborador.register')}}'">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection
