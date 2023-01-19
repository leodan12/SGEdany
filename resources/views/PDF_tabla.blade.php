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
            h5{
                font-weight:bold;
                font-family: sans-serif;
                margin-bottom:none
            }
            table#body>thead>tr>th,
            table#body>tbody>tr>th{
                font-size: 10;
            }
            #body>tr>td{
                border:none;
                text-align:left;
                padding-top:none;
                padding-bottom: 1;
                font-size: 11;
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
            table#fechas>tbody>tr>td#inicio,
            table#fechas>tbody>tr>td#fin{
                text-align:right;
                border:none;
            }
            table#fechas>tbody>tr>td#finicio,
            table#fechas>tbody>tr>td#ffin{
                text-align:left;
                border:none;
            }
            #cabecera>th{
                text-align:center;  
            }
        </style>
        <meta charset="UTF-8">
        <title>{{$nombreDoc}}</title>
        
    </head>
    <body>
        <div class="card-mb-4" >
            <div class="card-header" id="titulo">
                <img src="{{public_path('img\LOGO RW.png')}}" id="logo">
                <p id="empresa">RESPONSABLE WORK E.I.R.L.</p>
                <span class="align-middle" > 
                    <p>{{$titulo}}</p>
                </span>
            </div>
            <div class="card-body" id="contenido">
                <div class="row">
                    <table class="table table-borderless" id="fechas">   
                        @if ($ini==$fin)
                            <tbody id="bodyF">
                                <tr>
                                    <td id="inicio">{{$cabF[2]}}</td>
                                    <td id="finicio">{{$ini}}</td>
                                    <td id="inicio">Generado: </td>
                                    <td id="finicio">{{$generado}}</td>
                                </tr>
                            </tbody>
                        @else
                            <tbody id="bodyF">
                                <tr>
                                    <td id="inicio">{{$cabF[0]}}</td>
                                    <td id="finicio">{{$ini}}</td>
                                    <td id="fin">{{$cabF[1]}}</td>
                                    <td id="ffin">{{$fin}}</td>
                                </tr>
                                <tr>
                                    <td id="inicio">Generado: </td>
                                    <td id="finicio">{{$generado}}</td>>
                                </tr>
                            </tbody>
                        @endif 
                    </table>
                    
                </div>
                <div class="row">
                <table class="table table-striped" id="body">
                    <thead>
                        <tr id="cabecera">
                            <th>Nro.</th>
                            @foreach ($colums as $col)
                                <th>{{$col}}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @php $cont=0 @endphp
                        @foreach ($contenido as $row)
                          <tr>
                                <td>{{$cont+1}}</td>
                                @for ($x=0;$x < count($row);$x++)
                                <td scope="row">{{$row[$x]}}</td>
                                @endfor
                            </tr>
                        @php $cont++ @endphp
                        @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script>
            <?php echo Html::script('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js')?>
            <?php echo Html::script('https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0')?>
        </script>
    </body>
</html>
