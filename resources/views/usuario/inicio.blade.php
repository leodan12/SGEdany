@extends('base.content')
@section('styles')
<?php echo Html::script('js/alertas/usuarios.js')?>
@endsection
@section('contenido')
<div class="container-fluid px-4">
    <div class="btn">
        <div class="col-xl-3 col-md-6">
            <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#modalAdd" onclick='abrirModal();'>
                Agregar
            </button>
        </div>
    </div>
    <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">NUEVO USUARIO</h5>
                </div>


                <div class="card-body">
                    <form method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <div class="form-floating mb- mb-md-0">
                                    <input class="form-control"  id="nombres" name="nombres"
                                    type="text" placeholder="Nombres"/>
                                    <label for="colNombres">Nombres</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating">
                                    <input class="form-control" id="apellidos" name="apellidos"
                                    type="text" placeholder="Apellidos Completos"/>
                                    <label for="colApell">Apellidos</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-floating">
                                    <input class="form-control" id="dni" name="dni"
                                        type="text" placeholder="Documento de identidad"/>
                                    <label for="colDNI">DNI</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating">
                                    <input class="form-control" id="nacimiento" name="nacimiento"
                                        type="date" placeholder="Dirección"/>
                                    <label for="colNac">Nacimiento</label>
                                </div>
                                    
                            </div>
                        </div>
                        <div class="row mb-3">

                            <div class="col-md-5">
                                <div class="form-floating">
                                    <input class="form-control" id="direccion" name="direccion"
                                        type="text" placeholder="Dirección"/>
                                    <label for="colDirec">Dirección</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating">
                                    <select class="form-select" name="sexo" id="sexo" class="form-control" required>
                                        @foreach ($sexos as $sexo)
                                            <option value="{{$sexo->idSexo}}" >{{$sexo->Sex_nombre}}</option>
                                        @endforeach
                                    </select>
                                    <label for="colSexo">Sexo</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating">
                                    <input class="form-control" id="cel" name="cel"
                                        type="text" placeholder="Celular"/>
                                    <label for="colCel">Celular</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary"><strong> Guardar</strong></button>
                        <button type="button" class="btn btn-secondary" onclick="cerrarModal();">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card mb-4">
            <div class="card-header">
                USUARIOS
            </div>
            <div class="card-body">
                <table class="table" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"> <i class="icon_profile"></i> Login </th>
                            <th scope="col"><i class="icon_id_alt"></i> Colaborador</th>
                            <th scope="col"><i class="icon_id_alt"></i> Rol</th>
                            <th scope="col"><i class="icon_cogs"></i> Estado</th>
                            <th scope="col"><i class="fas fa-cogs"></i> Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $cont=1 @endphp
                        @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{$cont}}</th>
                            <td>{{$user->login}}</td>
                            <td>{{$user->per_apellidos}} {{$user->per_nombres}}</td>
                            <td>{{$user->rol_nombre}}</td>
                            <td>
                                @if($user->user_estado=='activo')
                                    <span class="badge bg-warning text-dark" >Activo</span>
                                @else
                                    <span class="badge bg-dark">Inactivo</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-primary" onclick='resetPassword({{$user->idUser}});'><i class="fas fa-undo" style="color: white"></i></button>
                                    @if($user->user_estado=='activo')
                                        <button type="button" class="btn btn-danger" onclick="cambioEstado('inhabilitar',{{$user->idUser}});" placeholder="Inhabilitar"><i class="fas fa-times-circle"></i></button>
                                    @else
                                        <button type="button" class="btn btn-success" onclick="cambioEstado('habilitar',{{$user->idUser}});" ><i class="fas fa-check-circle"></i></button>
                                    @endif
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
