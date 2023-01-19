@extends('base.content')
@section('styles')
<?php echo Html::script('js/alertas/planilla.js')?>
@endsection
@section('contenido')
<div class="container-fluid px-4">
    <div class="row">
        <div class="cabecera">
            <div class="col-md-12"><h4><b>PLANILLA DE PAGOS</b></h4></div>
            <div class="col-md-12" style="margin-bottom: 20px"><h4><b>{{$periodo}}</b></h4></div>
        </div>
        <div class="row" id='detalleC'>
            <?php $ini = $inicio->format("d/m/Y")?>
            <div class="col-md-6">FECHA INICIO: {{$ini}}</div>
            <?php $final = $fin->format("d/m/Y")?>
            <div class="col-md-6" style="margin-bottom: 15px">FECHA FIN: {{$final}}</div>
            <div class="col-md-6">TIPO: {{$tipo}}</div>
            <?php $reg = $hoy->format("d/m/Y")?>
            <div class="col-md-6" style="margin-bottom: 15px">FECHA REGITRO: {{$reg}}</div>
        </div>
        <table class="cabeceraP" id='tableP'>
            <thead>
                <tr id='title1'>
                    <td rowspan="3"><b>DNI</b></td>
                    <td rowspan="3"><b>COLABORADOR</b></td>
                    <td rowspan="3"> <b>CARGO</b></td>
                    <td colspan="3"> <b> INGRESOS DEL <br> TRABAJADOR</b></td>
                    <td rowspan="3"> <b> INGRESO<br>BRUTO</b></td>
                    <td colspan="3"> <b> EGRESOS DEL <br> TRABAJADOR</b></td>
                    <td rowspan="3"> <b> EGRESO<br>BRUTO</b></td>
                    <td colspan="6"> <b> RETENCIONES  <br> DEL EMPLEADO</b></td>
                    <td rowspan="3"><b>TOTAL <br> DESCUENTO</b></td>
                    <td rowspan="3" colspan='1'> <b> REMUNERACION <br> NETA </b></td>
                    <td colspan="4"> <b> RETENCIONES  <br> DEL EMPLEADOR</b></td>
                </tr>
                <tr id='title2' >
                    <td rowspan="2"><b> SUELDO<br>BÁSICO</b></td>
                    <td rowspan="2"> <b> ASIG.<br>FAM.</b></td>
                    <td rowspan="2"> <b> OTROS</b></td>
                    <td rowspan="2"><b> INASIST.</b></td>
                    <td rowspan="2"> <b> ADELANTO</b></td>
                    <td rowspan="2"> <b> OTROS</b></td>
                    <td colspan="2" rowspan="2"><b> SNP/ONP</b></td>
                    <td colspan="4"><b>SISTEMA PRIVADO DE PENSIONES</b></td>
                    <td rowspan="2"><b> ESSALUD</b></td>
                    <td rowspan="2"> <b> SCTR</b></td>
                </tr>
                <tr id='title3'>
                    <td><b>AFP</b></td>
                    <td><b>OBLIG.</b></td>
                    <td><b>COM.</b></td>
                    <td><b>SEGURO</b></td>
                </tr>
            </thead>
            <tbody>
                @foreach ($row as $r)
                    <tr id='detalleP'>
                        <td>{{$r["dni"]}}</td>
                        <td>{{$r["nombre"]}}</td>
                        <td>{{$r["cargo"]}}</td>
                        <td>S/.{{$r["sueldo"]}}</td>
                        <td>S/.{{$r["asigFam"]}}</td>
                        <td>S/.{{$r["otrosI"]}}</td>
                        <td>S/.{{$r["Ting"]}}</td>
                        <td>S/.{{$r["inasistencias"]}}</td>
                        <td>S/.{{$r["adelanto"]}}</td>
                        <td>S/.{{$r["otrosD"]}}</td>
                        <td>S/.{{$r["Tdesc"]}}</td>
                        <td>{{$r["onp"]}}</td>
                        <td>S/.{{$r["Monp"]}}</td>
                        <td>{{$r["afp"]}}</td>
                        <td>S/.{{$r["obligatorio"]}}</td>
                        <td>S/.{{$r["comision"]}}</td>
                        <td>S/.{{$r["prima"]}}</td>
                        <td>S/.{{$r["TdesEmpleado"]}}</td>
                        <td>S/.{{$r["totalRem"]}}</td>
                        <td>S/.{{$r["essalud"]}}</td>
                        <td>S/.{{$r["sctr"]}}</td>
                    </tr>

                @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-md-6" id='totalP'>TOTAL: {{$totalP}}</div>
    <div class="btn">
        <div class="col-xl-3 col-md-6">
            <button type="button" class="btn btn-primary" onclick="generar('{{$periodo}}','{{$inicio}}','{{$fin}}','{{$hoy}}');">
                Generar
            </button>
        </div>
    </div>
</div>
@endsection
