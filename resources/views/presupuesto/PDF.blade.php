<!DOCTYPE html>
<html lang="es">
    <head>
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
        
        <style>
            #logo{
                transform: scale(0.3);
                margin-top: -188;
                margin-left: -428;
                margin-bottom: -300;
            }
            #empresa{
                font-weight: bold;
                font-family:sans-serif;
                font-size:30;
                margin:30 -20 55 30;
                color:green
            }
            #titulo{ 
                font-weight: bold;
                font-family:sans-serif;
                font-size:20;
                text-align:center;
                background: white;
                border:none
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
            #body{
              padding-top:0;
              padding-bottom:0;
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
            table#Tregistro,
            table#Tdetalle{
               
                padding-top:0;
                border-collapse: collapse;
                margin: 1px; 
                padding:1px;
                
            }
            table#Tregistro>tbody>tr>td#sub,
            table#Tregistro>tbody>tr>td#det{
                text-align:center;
                border:none;
                font-weight: bold;
                font-size: 11;
                margin: 3px; 
                padding:3px;
            }
            table#Tregistro>tbody>tr>td#dato{
                text-align:left;
                border:none;
                font-size: 11;
                margin: 3px; 
                padding:3px;
            }
            table#Tregistro>tbody>tr>td#sub2{
                text-align:left;
                border:none;
                font-weight: bold;
                font-size: 11;
                margin: 3px; 
                padding:3px;
            }
            table#Tregistro>tbody>tr>td#dato2{
                text-align:left;
                border:none;
                font-size: 11;
                margin: 3px; 
                padding:3px;
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
                padding-top: 0;
                padding-bottom:0;
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
        </style>
        <meta charset="UTF-8">
        <title>{{$nombreDoc}}</title>
        
    </head>
    <body>
        <table class="table table-bordered" id="Tcabecera">
            <thead>
                <tr>
                    <td rowspan="6" style="min-width: 100px"></td>
                    <td rowspan="2" style="vertical-align:middle;margin: 1px; padding:1px;"><b>RESPONSABLE WORK E.I.R.L.</b></td>
                    <td colspan="3" style="font-size:10; margin: 1px; padding:1px;"><b>Versión: 06</b></td>
                    <td colspan="3" style="font-size:10; margin: 1px; padding:1px;"><b>Página 1 de 1</b></td>
                </tr>
                <tr>
                    <td colspan="6" style="font-size:10; text-align:left; margin: 1px; padding:1px;"><b>Fecha de aprobación:</b></td>
                </tr>
                <tr>
                    <td rowspan="2" style="vertical-align:middle; margin: 1px; padding:1px;"><b>SISTEMA DE GESTIÓN DE LA CALIDAD</b></td>
                    <td colspan="6" style="font-size:10; text-align:left; margin: 1px; padding:1px;"><b>Fecha de actualización:</b></td>
                </tr>
                <tr>
                    <td colspan="6" style="font-size:10; text-align:left; margin: 1px; padding:1px;"><b>Fecha de vigencia:</b></td>
                </tr>
                <tr>
                    <td rowspan="2" style="vertical-align: middle; margin: 1px; padding:1px;"><b>{{$titulo}}</b></td>
                    <td colspan="2" style="font-size:8; margin: 1px; padding:1px;"><b>ELABORADO </b></td>
                    <td colspan="2" style="font-size:8; margin: 1px; padding:1px;"><b>REVISADO</b></td>
                    <td colspan="2" style="font-size:8; margin: 1px; padding:1px;"><b>APROBADO</b></td>
                </tr>
                <tr>
                    <td colspan="2" style="font-size:8; margin: 1px; padding:1px;"><b>ASIST ADM</b></td>
                    <td colspan="2" style="font-size:8; margin: 1px; padding:1px;"><b>ASIST ADM</b></td>
                    <td colspan="2" style="font-size:8; margin: 1px; padding:1px;"><b>ADM</b></td>
                </tr>
            </thead>
        </table>
        <div class="card-mb-4">
            <div class="card-header" id="titulo">
                <img src="{{public_path('img\LOGO RW.png')}}" id="logo">
            </div>
        </div>
        <div class="card-mb-4" style="margin-bottom:-16px; margin-right:30px;">
            <div class="row" >
                <div class="col-lg-12" >
                    <div class="card mb-4" >
                        <div class="card-header" id="cabecera" >
                        <p><b>DATOS PROVEEDOR</b></p>
                        </div>
                        
                        <div class="card-body" id="body">
                            <div class="row" id="cab">
                                <table class="table" id="Tregistro">
                                    <tbody>
                                        <tr>
                                            <td id="sub">EMPRESA: </td>
                                            <td  id="dato">RESPONSABLE WORK E.I.R.L</td>
                                            <td id="sub" >RUC: </td>
                                            <td id="dato">20602163751</td>
                                        </tr> 
                                        <tr>
                                            <td colspan="1" id="sub">DIRECCIÓN: </td>
                                            <td colspan="3" id="dato">CAL. CUSCO MZ-30 LT-16 PUERTO MALABRIGO - LA LIBERTAD - ASCOPE - RAZURI</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-mb-4" style="margin-right:30px;">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header" id="cabecera">
                            <p><b>DATOS CLIENTE</b></p>
                        </div>
                        
                        <div class="card-body" id="body">
                            <div class="row" id="cab">
                                @if($tipo=='cliente')
                                    <table class="table table-borderless" id="Tregistro">
                                        <tbody>
                                            <tr>
                                                <td id="sub">DNI: </td>
                                                <td id="dato">{{$identificador}}</td>
                                                <td id="sub">Cliente:</td>
                                                <td id="dato">{{$cliente}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @endif

                                @if($tipo=='empresa')
                                    <table class="table table-borderless"  id="Tregistro">
                                        <tbody>
                                            <tr>
                                                <td id="sub2">CLIENTE:</td>
                                                <td id="dato2">{{$cliente}}</td>
                                                <td id="sub">RUC: </td>
                                                <td id="dato2">{{$identificador}}</td>
                                                
                                            </tr>
                                            <tr>
                                                <td id="sub2">RESPONSABLE: </td>
                                                <td id="dato2">{{$responsable}}</td>
                                                <td id="sub">CARGO:</td>
                                                <td id="dato2">{{$cargo}}</td>
                                            </tr>
                                            <tr>
                                                <td id="sub2">EMAIL: </td>
                                                <td id="dato2">{{$correo}}</td>
                                                <td id="sub">CELULAR:</td>
                                                <td id="dato2">{{$cel}}</td>
                                            </tr>
                                            <tr>
                                                <td id="sub2">LUGAR: </td>
                                                <td id="dato2">{{$lugar}}</td>
                                                <td id="sub">FECHA:</td>
                                                <td id="dato2">{{$fecha}}</td>
                                            </tr>
                                            <tr>
                                                <td id="sub2">SERVICIO: </td>
                                                <td id="dato2">{{$servicio}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="card-mb-4" style="margin-right:30px;">
            <div class="row" style="display:flex;">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header" id="cabecera">
                            <p><b>DETALLE</b></p>
                        </div>
                        
                        <div class="card-body" id="body">
                            <div class="row" id="cab">

                                @if($tipo=='empresa')
                                    <table class="table table-borderless"  id="Tregistro">
                                        <thead>
                                            <tr>
                                                <th style=" text-align:center;" scope="col">Nro</th>
                                                <th style=" text-align:center;" scope="col">Código</th>
                                                <th style=" text-align:center;" scope="col">Nombre</th>
                                                <th style=" text-align:center;" scope="col">Precio</th>
                                                <th style=" text-align:center;" scope="col">Cantidad</th>
                                                <th style=" text-align:center;" scope="col">Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            @php $cont=0 @endphp
                                            @foreach($detalle as $det)
                                                <tr>
                                                    <td style="border:none; text-align:center; border:none;font-size: 11; margin: 3px; padding:3px;">{{$cont+1}}</td>
                                                    <td style="border:none; text-align:center; border:none;font-size: 11; margin: 3px; padding:3px;">{{$det->codServicio}}</td>
                                                    <td style="border:none; text-align:center; border:none;font-size: 11; margin: 3px; padding:3px;">{{$det->serv_nombre}}</td>
                                                    <td style="border:none; text-align:center; border:none;font-size: 11; margin: 3px; padding:3px;">S/{{$det->costUnid}}</td>
                                                    <td style="border:none; text-align:center; border:none;font-size: 11; margin: 3px; padding:3px;" >{{$det->cantidad}}</td>
                                                    <td style="border:none; text-align:center; border:none;font-size: 11; margin: 3px; padding:3px;">S/{{$sub[$cont]}}</td>
                                                </tr>
                                            @php $cont++ @endphp
                                            @endforeach
                                            <tr>
                                                <td style="text-align:right" colspan="5" id="sub"><b>Sub Total</b></td>
                                                <td id="det"><b>S/{{$subTotal}}</b></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:right" colspan="5" id="sub"><b>Gastos administrativos</b></td>
                                                <td id="det"><b>S/{{$gastosAdm}}</b></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:right" colspan="5" id="sub"><b>Total</b></td>
                                                <td id="det"><b>S/{{$total}}</b></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>  
                    </div>
                    <div class="card mb-4" style="margin-top:-16px">
                        <div class="card-body" id="body" style="min-height:30px">
                            <div class="row" id="cab" style="margin-top:25px; margin-bottom:-10">
                            <b style="text-decoration: underline;">NOTA:</b> PRECIOS NO INCLUYEN IGV.
                            </div>
                        </div>  
                    </div>
                </div> 
            </div>
            <div class="row" style="margin-top:-16px; margin-left:0px;">
                <div class="card mb-4" style="width:50%;">
                    <div class="card-body" id="body" style="min-height:30px">
                        <div class="row" id="cab" style="margin-top:25px; margin-bottom:-10">
                            <p style="min-height:10px">
                                <b style="text-decoration: underline; margin-left: 30px">BBVA CONTINENTAL</b> <br/>
                            </p>
                            <p style="min-height:10px; margin-left: 30px">
                                CTA. SOLES 0011 0030 0200081084 42 <br/>
                            </p>
                            <p style="min-height:10px; margin-left: 30px">
                                CCI   011 030 000200081084 42
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top:-100px; margin-left:345px; margin-right:-385px">
                <div class="card mb-4" style="width:50%;">
                    <div class="card-body" id="body" style="min-height:60px">
                        <div class="row" id="cab" style="margin-top:25px; margin-bottom:-10; align-content:center">
                            <p style="min-height:10px;align-content:center">
                                <b style="text-decoration: underline; margin-left: 30px">BANCO DE LA NACIÓN</b> 
                            </p>
                            <p style="min-height:10px; margin-left: 30px">
                                CTA. DETRACCIONES 00-753-001654 
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top:-16px; margin-left:0px; margin-right: -29px">
                <div class="card mb-4" style="margin-top:-16px">
                    <div class="card-body" id="body" style="min-height:30px">
                        <div class="row" id="cab" style="margin-top:25px; margin-bottom:-10">
                            <p style="min-height:10px; margin-left: 300px">
                                Atentamente,
                            </p>
                            <p style=" font-weight: bold; min-height:10px; margin-left: 245px">
                                ÁREA DE OPERACIONES 
                            </p>
                            <p style="font-weight: bold; min-height:10px; margin-left: 225px">
                                RESPONSABLE WORK E.I.R.L.
                            </p>
                        </div>
                    </div>  
                </div>
            </div>
        </div>

        <script>
            <?php echo Html::script('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js')?>
            <?php echo Html::script('https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0')?>
        </script>
    </body>
</html>
