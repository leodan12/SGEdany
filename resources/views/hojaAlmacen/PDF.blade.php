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
                transform: scale(0.2);
                margin-bottom:-150;
                margin-left: -450;
                margin-top:-110
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
                font-weight: bold
            }
            table#Tregistro>tbody>tr>td#dato,
            table#Tentrada>tbody>tr>td#dato,
            table#Tsalida>tbody>tr>td#dato{
                text-align:left;
                border:none;
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
    <div class="card-mb-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header" id="cabecera">
                       <p><b>DATOS CABECERA</b></p>
                    </div>
                    
                    <div class="card-body">
                        <div class="row" id="cab">
                            <p id="Dcol">Datos Colaborador</p>
                            <table class="table table-borderless" id="Tregistro">
                                <tbody>
                                    <tr>
                                        <td id="sub">DNI:</td>
                                        <td id="dato">{{$colaborador->per_dni}}</td>
                                        <td id="sub">Registrada por:</td>
                                        <td id="dato">{{$colaborador->persona->per_apellidos}} {{$colaborador->persona->per_nombres}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="row" id="datos">
                            <p id="Dhoja"><b>Datos Hoja de Almacén</b></p>

                            @if($tipo=='E')
                                <table class="table table-borderless" id="Tentrada">
                                    <tbody>
                                        <tr>
                                            <td id="sub">Comprobante: </td>
                                            <td id="dato">{{$hoja->Dcmto_codigo}}</td>
                                            <td id="sub">RUC proveedor:</td>
                                            <td id="dato">{{$hoja->RUC}}</td>
                                            <td id="sub">Proveedor:</td>
                                            <td id="dato">{{$hoja->NombreComercial}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            @endif

                            @if($tipo=='S')
                                <table class="table table-borderless" id="Tsalida">
                                    <tbody>
                                        <tr>
                                            <td id="sub">Descripción:</td>
                                            <td id="dato">{{$hoja->Sal_descripcion}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            @endif
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header" id="cabecera">
                       <p><b>DETALLE</b></p>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless" id="Tdetalle">
                            <thead>
                                <tr>
                                    <th scope="col">Nro</th>
                                    <th scope="col">Código</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody >
                                @php $cont=0 @endphp
                                @foreach($detalle as $det)
                                    <tr>
                                        <td>{{$cont+1}}</td>
                                        <td>{{$det->codProducto}}</td>
                                        <td>{{$det->Prod_nombre}}</td>
                                        <td>S/{{$det->Mov_costo}}</td>
                                        <td>{{$det->Mov_cantidad}}</td>
                                        <td>S/{{$subtotal[$cont]}}</td>
                                    </tr>
                                @php $cont++ @endphp
                                @endforeach
                            </tbody>
                            
                        </table> 
                    </div>
                </div>
            </div>
            
            <div class="col-lg-12" id="total">
                <p><b>TOTAL: S/{{$total}}</b></p>
            </div>
        </div>
    </div>

        <script>
            <?php echo Html::script('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js')?>
            <?php echo Html::script('https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0')?>
        </script>
    </body>
</html>
