<!DOCTYPE html>
<html lang="es">
    <head>
        
        <link rel="stylesheet" href="{{public_path('css/bootstrap-colorpicker.css')}}" type="text/css">
        <link rel="stylesheet" href="{{public_path('css/bootstrap-datepicker.css')}}" type="text/css"> 
        <link rel="stylesheet" href="{{public_path('css/bootstrap-grid.css')}}" type="text/css">
        <link rel="stylesheet" href="{{public_path('css/bootstrap-grid.css.map')}}" type="text/css">
        <link rel="stylesheet" href="{{public_path('css/boostrap-grid.min.css')}}" type="text/css">
        <link rel="stylesheet" href="{{public_path('css/boostrap-grid.min.css.map')}}" type="text/css">
        <link rel="stylesheet" href="{{public_path('css/bootstrap-grid.rtl.css')}}" type="text/css">
        <link rel="stylesheet" href="{{public_path('css/bootstrap-grid.rtl.css.map')}}" type="text/css">
        <link rel="stylesheet" href="{{public_path('css/bootstrap-grid.rtl.min.css')}}" type="text/css">
        <link rel="stylesheet" href="{{public_path('css/bootstrap-grid.rtl.min.css.map')}}" type="text/css">
        <link rel="stylesheet" href="{{public_path('css/bootstrap-theme.css')}}" type="text/css">
        <link rel="stylesheet" href="{{public_path('css/bootstrap-utilities.css')}}" type="text/css">
        <link rel="stylesheet" href="{{public_path('css/bootstrap-utilities.css.map')}}" type="text/css">
        <link rel="stylesheet" href="{{public_path('css/bootstrap-utilities.min.css')}}" type="text/css">
        <link rel="stylesheet" href="{{public_path('css/bootstrap-utilities.min.css.map')}}" type="text/css">
        <link rel="stylesheet" href="{{public_path('css/bootstrap-utilities.rtl.css')}}" type="text/css">
        <link rel="stylesheet" href="{{public_path('css/bootstrap-utilities.rtl.css.map')}}" type="text/css">
        <link rel="stylesheet" href="{{public_path('css/bootstrap-utilities.rtl.min.css')}}" type="text/css">
        <link rel="stylesheet" href="{{public_path('css/bootstrap-utilities.rtl.min.css.map')}}" type="text/css">
        <link rel="stylesheet" href="{{public_path('css/bootstrap.css')}}" type="text/css">
        <link rel="stylesheet" href="{{public_path('css/bootstrap.css.map')}}" type="text/css">
        <link rel="stylesheet" href="{{public_path('css/bootstrap.min.css')}}" type="text/css">
        <link rel="stylesheet" href="{{public_path('css/bootstrap.min.css.map')}}" type="text/css">
        <link rel="stylesheet" href="{{public_path('css/bootstrap.rtl.css')}}" type="text/css">
        <link rel="stylesheet" href="{{public_path('css/bootstrap.rtl.css.map')}}" type="text/css">
        <link rel="stylesheet" href="{{public_path('css/bootstrap.rtl.min.css')}}" type="text/css">
        <link rel="stylesheet" href="{{public_path('css/bootstrap.rtl.min.css.map')}}" type="text/css">
        <link rel="stylesheet" href="{{public_path('css/pdf.css')}}" type="text/css">
        <link rel="stylesheet" href="{{public_path('css/propios.css')}}" type="text/css">
        <link rel="stylesheet" href="{{public_path('css/style-responsive.css')}}" type="text/css">
        <link rel="stylesheet" href="{{public_path('css/styles.css')}}" type="text/css">
        <link rel="stylesheet" href="{{public_path('css/widgets.css')}}" type="text/css">
        <link rel="stylesheet" href="{{public_path('css/xcharts.min.css')}}" type="text/css">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <style>
            #logo{
                transform: scale(0.2);
                margin-bottom:-150;
                margin-left: -500;
                margin-top:-110
            }
            #empresa{
                font-weight: bold;
                font-family:sans-serif;
                font-size:30;
                margin:-40 -15 0 30;
                color:green
            }
            #titulo{ 
                font-weight: bold;
                font-family:sans-serif;
                font-size:20;
                text-align:center;
                background: white;
                border:none;
            }
            img.imagen{
                width: 700px;
                height: 400px;
                border: solid 0.5px gray;
            }
            #cod{
                width:40px;
            }
            p#nro,
            p#total{
                font-weight:bold;
                font-family: sans-serif;
                margin-bottom:none
            }
            #body>tr>td{
                border:none;
                text-align:left;
                padding-top:none;
                padding-bottom: 1
            }
            #body>tr>td#pos{
                text-align:right;
                padding-right:none;
            }
            #body>tr>td#nombre{
                text-align:left;
                padding-left: 5
            }
            #contenido{
                margin-top:1px
            }
            table#Tregistro>tbody>tr>td#sub,
            table#Tentrada>tbody>tr>td#sub,
            table#Tsalida>tbody>tr>td#sub{
                text-align:right;
                border:none;
                font-weight: bold;
                font-size: 12
            }
            table#Tregistro>tbody>tr>td#dato,
            table#Tentrada>tbody>tr>td#dato,
            table#Tsalida>tbody>tr>td#dato{
                text-align:left;
                border:none;
                font-size: 12
            }
            table#Tsalida>tbody>tr>td#sub{
                max-width: 0;
                margin-left:1px;
            }
            #cabecera>th{
                text-align:center;  
            }
            #cabecera{
                min-height:15px;
                vertical-align:bottom;
            }
            div#cabecera p{
                margin-top:12px;
                margin-bottom:none
            }
            div#datos,
            div#cab{
                transform: scale(0.95);
                margin-top: 20px;
            }
            p#Dcol,
            p#Dhoja{
                font-weight: bold;
                font-size:13;
                
            }
            table#Tdetalle>thead>tr>th{
                text-align:center;
            }
            
            div#total p{
                text-align:right;
                margin-top: 5px;
                margin-right: 5px
            }
            table#tableP{
                border-collapse: collapse;
            }
            table#tableP>thead>tr>td{
                font-size: 6;
                margin-left: -20
            }
            table#tableP>thead>tr#title1>td, 
            table#tableP>thead>tr#title2>td, 
            table#tableP>thead>tr#title3>td{
            font-size: 6;
            vertical-align: middle;
            margin-left: 0;
            margin-right: 0;
            }
            table#tableP>tbody>tr>td{
                font-size: 6;
                
            }
            content{
                margin: 0 0 0 0
            }
        </style>
        <meta charset="UTF-8">
        <title>{{$nombreDoc}}</title>
        
    </head>
    <body>
        <div class="card-mb-4">
            <div class="card-header" id="titulo">
                <img src="{{public_path('img\LOGO RW.png')}}" id="logo">
                <p id="empresa">RESPONSABLE WORK E.I.R.L.</p>
                <span class="align-middle"> 
                    <p>{{$titulo}}</p>
                </span>
            </div>
        </div>
        <div  id="content">
            
                <div class="row">
                    <table class="table table-borderless" id="Tregistro">
                        <tbody>
                            <tr>
                                <td id="sub">Fecha Iniicio:</td>
                                <?php $ini = date("d/m/Y",strtotime($planilla->Plan_inicio))?>
                                <td id="dato">{{$ini}}</td>
                                <td id="sub">Fecha Fin:</td>
                                <?php $final = date("d/m/Y",strtotime($planilla->Plan_final))?>
                                <td id="dato">{{$final}}</td>
                            </tr>
                            <tr>
                                <td id="sub">Fecha Registro:</td>
                                <?php $reg = date("d/m/Y",strtotime($planilla->Plan_registro))?>
                                <td id="dato">{{$reg}}</td>
                                <td id="sub">Tipo:</td>
                                <td id="dato">{{$tipo->TP_nombre}}</td>
                            </tr>
                        </tbody>
                    </table>  
                </div>
                <div class="row">
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
                                <td colspan="1" rowspan="2"> <b> SCTR</b></td>
                            </tr>
                            <tr id='title3'>
                                <td><b>AFP</b></td>
                                <td><b>OBLIG.</b></td>
                                <td><b>COM.</b></td>
                                <td><b>SEGURO</b></td>
                            </tr>
                        </thead>
                        @if(count($detalle)>0)
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


                        @endif
                    </table>
                </div>
           
            
        </div>

        <script>
            <?php echo Html::script('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js')?>
            <?php echo Html::script('https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0')?>
        </script>
    </body>
</html>

