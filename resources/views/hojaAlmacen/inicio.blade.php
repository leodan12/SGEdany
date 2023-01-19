@extends('base.content')
@section('styles')
<?php echo Html::script('js/alertas/hojaAlmacen.js')?>
@endsection
@section('contenido')
<div class="container-fluid px-4">
    <div class="btn">
        <div class="col-xl-3 col-md-6">
            <button type="button" class="btn btn-primary"  onclick="location.href='{{route('hojaAlmacen.nuevo')}}'">
                Agregar
            </button>
        </div>
    </div>
    <div class="row">
        <div class="card mb-4">
            <div class="card-header">
                HOJAS DE ALMACEN
            </div>
            <div class="card-body">
                <table  class="table" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"> Nro Hoja </th>
                            <th scope="col">Tipo </th>
                            <th scope="col">Costo Total </th>
                            <th scope="col">Registrado el </th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $cont=1 @endphp
                        @foreach ($hojas as $hoja)
                        <tr>
                            <td scope="row">{{$cont}}</td>
                            <td >{{$Nrohoja[$cont-1]}}</td>
                            @if ($tipo[$cont-1] == 'E')
                            <td >ENTRADA</td>
                            @else
                            <td >SALIDA</td>
                            @endif
                            <td >{{$hoja->HM_total}}</td>
                            <?php $registro = date_format(date_create(strval($hoja->HM_registro)),'d-m-Y')?>
                            <td >{{$registro}}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-primary"  onclick="location.href='{{Route('hojaAlmacen.visualizar',$hoja->idHojMov)}}'"><i class="fas fa-eye" style="color: white"></i></button>
                                    <button type="button" class="btn btn-danger" onclick='eliminar({{$hoja->idHojMov}});'><i class="fas fa-trash-alt" style="color: rgb(161, 26, 26)"></i></button>
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
