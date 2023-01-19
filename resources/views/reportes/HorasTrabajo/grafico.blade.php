@extends('base.content')
@section('styles')
<?php echo Html::script('js/graficos/graficoHorasTrabajadas.js')?>
@endsection
@section('contenido')
<div class="row" style="padding-bottom: 30px">
    <div class="col-lg-12">
        <a href="{{Route('horast.inicio')}}" class="btn btn-sm btn-danger" style="width: auto">Regresar</a>
    </div>
</div>
<div class="panel">
    <header class="panel-heading">
        <span class="align-middle">
            @if ($ini == $fin)
            <p class="text-center" style="font-size: 20"><strong>ASISTENCIAS DEL
                    DIA:&nbsp;&nbsp;{{date('d/m/Y',strtotime($ini))}}</strong></p>
            @else
            <p class="text-center" style="font-size: 20"><strong>ASISTENCIAS DESDE EL
                    &nbsp;&nbsp;{{date('d/m/Y',strtotime($ini))}} &nbsp;&nbsp;HASTA EL
                    &nbsp;&nbsp;{{date('d/m/Y',strtotime($fin))}}</strong></p>
            @endif
        </span>
    </header>

    <div style="display: none">
        <input type="text" id="inicio" value="{{$ini}}">
        <input type="text" id="fin" value="{{$fin}}">
    </div>
    <div class="panel-body">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <div>
            <canvas id="horas_trabajadas" width="00px" height="300px"></canvas>
        </div>
    </div>

</div>




@endsection
