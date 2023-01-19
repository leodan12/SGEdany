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
        @php $cont=0 @endphp
        @foreach ($imagenes as $img)
            {{$img[$cont]}}
        @php $cont++ @endphp
        @endforeach


        <script>
            <?php echo Html::script('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js')?>
            <?php echo Html::script('https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0')?>
        </script>
    </body>
</html>
