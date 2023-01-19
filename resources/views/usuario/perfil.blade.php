@extends('base.content')
@section('styles')
<?php echo Html::script('js/alertas/perfil.js')?>
@endsection
@section('contenido')

<div class="container-fluid px-4">
    <div class="card mb-4">
        <div class="card-header">
            ACTUALIZAR CONTRASEÑA
        </div>

        <div class="card-body">
            <form method="POST" id="ActContraseñas">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input
                                class="form-control"
                                id="actual"
                                name="actual"
                                type="password"
                                placeholder="Contraseña actual:"/>
                            <label for="actual">Contraseña actual:</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input
                                class="form-control"
                                id="nueva"
                                name="nueva"
                                type="password"
                                placeholder="Contraseña nueva:"/>
                            <label for="nueva">Contraseña nueva:</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input
                                class="form-control"
                                id="repetida"
                                name="repetida"
                                type="password"
                                placeholder="Repetir contraseña:"/>
                            <label for="repetida">Repetir contraseña:</label>
                        </div>
                    </div>
                </div>
                <div class="mt-4 mb-0">
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <div class="d-grid">
                                <button type="button" class="btn btn-primary" onclick="verificar({{Auth::User()->idUser}});"><strong> Guardar</strong></button>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="d-grid">
                                <button type="button" class="btn btn-secondary" onclick="cancelar();">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            INFORMACION PERSONAL
        </div>

        <div class="card-body">
            <form method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input class="form-control" id="apellidos" name="apellidos"
                                type="text" value="{{Auth::User()->persona->per_apellidos}}"
                                placeholder="Apellidos" disabled/>
                            <label for="apellidos">Apellidos:</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input class="form-control" id="nombres" name="nombres"
                                type="text" value="{{Auth::User()->persona->per_nombres}}"
                                placeholder="Nombres" disabled/>
                            <label for="nombres">Nombres:</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input class="form-control" id="dni" name="dni"
                                type="text" value="{{Auth::User()->persona->per_dni}}"
                                placeholder="DNI" disabled/>
                            <label for="dni">DNI:</label>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection