<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

    <link href="{{public_path('css/styles.css')}}" rel="stylesheet" type="text/css" >
    <link href="{{public_path('css/propios.css')}}" rel="stylesheet" type="text/css">
    <link href="{{public_path('css/pdf.css')}}" rel="stylesheet" type="text/css">
    <link href="{{public_path('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{public_path('css/bootstrap-theme.css')}}" rel="stylesheet" type="text/css">
    <link href="{{public_path('css/bootstrap-colorpicker.css')}}" rel="stylesheet" type="text/css">
    <link href="{{public_path('css/bootstrap-datepicker.css')}}" rel="stylesheet" type="text/css">
</head>
<body>
    
        <section class="panel" style="height: auto;width:auto;font-color:black;">

            <section class="main-container">

                <div class="row" id="cabeceraB">
                    <div class="col-md-12" style="text-align: center">
                        <h5 style="font-size: 26">BOLETA DE PAGO</h5>
                    </div>
                    <!-- <div class="col-lg-5" style="margin-top:7px; text-align:center;width:300px">
                        <h5>D.S. N° 001-98TR</h5>
                    </div> -->
                </div>
                <div class="row">
                    <div class="col-lg-12" style="text-align: center; ">
                        <h5 style="font-size: 17">{{$periodo}}</h5>
                    </div>
                </div>
            </section>

            <section class="panel boleta">

                <div class="row">
                        <div class="col-md-3" id="btc">
                            DNI: 
                        </div>
                        <div class="col-md-2" id="bstc">
                            {{$colaborador->per_dni}}
                        </div>
                        <div class="col-md-3" id="btc">
                        Apellidos y Nombres: 
                        </div>
                        <div class="col-md-4" id="bstc">
                            {{$colaborador->per_apellidos}} {{$colaborador->per_nombres}}
                        </div>

                </div>      
                <div class="row">
                    <div class="col-md-3" id="btc">
                        F. Ingreso:
                    </div>
                    <div class="col-md-2" id="bstc">
                        {{date('d/m/Y',strtotime($colaborador->per_registro))}}
                    </div>
                    <div class="col-md-3" id="btc">
                        Cargo: 
                    </div>
                    <div class="col-md-4" id="bstc">
                        {{$colaborador->Car_nombre}}
                    </div>
                </div> 
                <div class="row">
                    <div class="col-md-3" id="btc">
                        Días Trabajados: 
                    </div>
                    <div class="col-md-2 col2" id="bstc">
                        {{$dias}} días
                    </div>
                    <div class="col-md-3" id="btc">
                        Horas Trabajadas: 
                    </div>
                    <div class="col-md-4" id="bstc">
                        {{$horas}} hrs
                    </div>
                </div>
            </section>

            <section class="panel boletaD" style="padding: 10px 20px 10px 20px;">
                <div class="row" id="Bdetalle">
                    <div class="col-md-6" style="padding-right:0">
                        <table class="table table-borderless">
                            <thead class="table-dark">
                                <th style="Color: white; min-width: 220px">INGRESOS</th>
                                <th style="Color: white;">IMPORTE</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>SALARIO MENSUAL</td>
                                    <td>S/{{$boleta->sueldoBasico}}</td>
                                </tr>
                                @if($boleta->asigFamiliar!='0.00')
                                    <tr>
                                        <td>ASIGNACION FAMILIAR</td>
                                        <td>S/{{$boleta->asigFamiliar}}</td>
                                    </tr>
                                @endif
                                @if($boleta->otrosIngresos!='0.00')
                                    <tr>
                                        <td>OTROS</td>
                                        <td>S/{{$boleta->otrosIngresos}}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6" style="padding-left:0">
                        <table class="table table-borderless">
                            <thead class="table-dark">
                                <th style="Color: white;max-width: 220px">DESCUENTOS Y RETENCIONES</th>
                                <th style="Color: white;">IMPORTE</th>
                            </thead>
                            <tbody>
                                @if($boleta->costoAdelanto!='0.00')
                                    <tr>
                                        <td>ADELANTO</td>
                                        <td>S/{{$boleta->costoAdelanto}}</td>
                                    </tr>
                                @endif
                                @if($boleta->costoInasist!='0.00')
                                    <tr>
                                        <td>INASISTENCIAS</td>
                                        <td>S/{{$boleta->costoInasist}}</td>
                                    </tr>
                                @endif
                                @if($boleta->otrosEgresos!='0.00')
                                    <tr>
                                        <td>OTROS</td>
                                        <td>S/{{$boleta->otrosEgresos}}</td>
                                    </tr>
                                @endif
                                @if($boleta->costoONP!='0.00')
                                    <tr>
                                        <td>APORTE ONP</td>
                                        <td>S/{{$boleta->costoONP}}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>APORTE OBLIGATORIO AFP-{{$colaborador->Pen_nombre}}</td>
                                        <td>S/{{$boleta->AFPoblig}}</td>
                                    </tr>
                                    <tr>
                                        <td>APORTE COMISION AFP-{{$colaborador->Pen_nombre}} {{$colaborador->col_comPension}}</td>
                                        <td>S/{{$boleta->AFPcom}}</td>
                                    </tr>
                                    <tr>
                                        <td>APORTE SEGURO AFP-{{$colaborador->Pen_nombre}}</td>
                                        <td>S/{{$boleta->AFPseguro}}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6" style="padding-right:0">
                        <table class="table">
                            <thead class="table-dark">
                                <th style="Color: white; min-width: 220px">TOTAL INGRESOS:</th>
                                <th style="Color: white;">S/{{$boleta->ingresoBruto}}</th>
                            </thead>
                        </table>
                    </div>
                    <div class="col-md-6" style="padding-left:0">
                        <table class="table">
                            <thead class="table-dark">
                                <th style="Color: white; min-width: 220px">TOTAL DESCUENTOS:</th>
                                <?php $descuento= $boleta->egreBruto+$boleta->totalAporte?>
                                <th style="Color: white;">S/{{$descuento}}</th>
                            </thead>
                        </table>
                    </div>
                </div>  
                <div class="row" id="empleador">
                    <div class="col-md-3">
                        <h6>RETENCIONES DEL EMPLEADOR</h6>
                        <table class="table table-bordered">
                            <thead class="table-dark">
                                <th>ESSALUD</th>
                                <th>SCTR</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>S/{{$boleta->essalud}}</td>
                                    <td>S/{{$boleta->sctr}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>  
                </div>
                <div class="row" >
                    <div class="col-md-3" id="firmas" style="text-align:center;">
                        <h6 style="border-top:1px solid">RESPONSABLE WORK E.I.R.L.</h6>
                    </div>
                    <div class="col-md-3" id="firmas" style="text-align:center;">
                        <h6 style="border-top:1px solid">FIRMA DEL TRABAJADOR</h6>
                    </div>
                </div>
            </section>
        </section>
    
</body>
</html>
<style>
   </style>
