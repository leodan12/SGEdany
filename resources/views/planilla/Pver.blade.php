@extends('base.content')
@section('styles')
<?php echo Html::script('js/alertas/planilla.js')?>
@endsection
@section('contenido')
<div class="container-fluid px-4">
<div class="row">
        <div class="col-lg-12">
        <a target="_blank" href="{{Route('planilla.descarga',$planilla->idPlanilla)}}" class="btn btn-sm btn-success">
            <i class="fas fa-file-pdf"></i><strong> Visualizar</strong></a>

                <a href="{{Route('planilla.register')}}" class="btn btn-sm btn-danger">Regresar</a>
        </div>
    </div>
    <div class="row">
        <div class="cabecera">
            <div class="col-md-12"><h4><b>PLANILLA DE PAGOS</b></h4></div>
            <div class="col-md-12" style="margin-bottom: 20px"><h4><b>{{$planilla->Periodo}}</b></h4></div>
        </div>
        <div class="row" id='detalleC'>
            <?php $ini = date("d/m/Y",strtotime($planilla->Plan_inicio))?>
            <div class="col-md-6">FECHA INICIO: {{$ini}}</div>
            <?php $final = date("d/m/Y",strtotime($planilla->Plan_final))?>
            <div class="col-md-6" style="margin-bottom: 15px">FECHA FIN: {{$final}}</div>
            <div class="col-md-6">TIPO: {{$tipo->TP_nombre}}</div>
            <?php $reg = date("d/m/Y",strtotime($planilla->Plan_registro))?>
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
                    <td colspan="2"> <b> RETENCIONES  <br> DEL EMPLEADOR</b></td>
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
                @foreach ($detalle as $det)
                    <tr id='detalleP'>
                        <td>{{$det->per_dni}}</td>
                        <td>{{$det->per_apellidos}} {{$det->per_nombres}}</td>
                        <td>{{$det->Car_nombre}}</td>
                        <td>S/.{{$det->col_sueldo}}</td>
                        <td>S/.{{$det->asigFamiliar}}</td>
                        <td>S/.{{$det->otrosIngresos}}</td>
                        <td>S/.{{$det->ingresoBruto}}</td>
                        <td>S/.{{$det->costoInasist}}</td>
                        <td>S/.{{$det->costoAdelanto}}</td>
                        <td>S/.{{$det->otrosEgresos}}</td>
                        <td>S/.{{$det->egreBruto}}</td>
                        <?php if($det->costoONP=='0.00'){$onp='SI';} else{$onp='NO';} ?>
                        <td>{{$onp}}</td>
                        <td>S/.{{$det->costoONP}}</td>
                        <?php $afp = App\Model\Sist_Pension::findOrfail($det->idSistPension) ?>
                        <td>{{$afp->Pen_nombre}}</td>
                        <td>S/.{{$det->AFPoblig}}</td>
                        <td>S/.{{$det->AFPcom}}</td>
                        <td>S/.{{$det->AFPseguro}}</td>
                        <td>S/.{{$det->totalAporte}}</td>
                        <td>S/.{{$det->remuneracionNeta}}</td>
                        <td>S/.{{$det->essalud}}</td>
                        <td>S/.{{$det->sctr}}</td>
                    </tr>

                @endforeach
            </tbody>
        </table>
    </div>
    <?php $costo = number_format($planilla->Plan_costo,2) ?>
    <div class="col-md-6" id='totalP'>TOTAL:S/. {{$costo}}</div>
</div>
@endsection
