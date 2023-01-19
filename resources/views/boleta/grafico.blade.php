@extends('base.content')
@section('styles')
<?php echo Html::script('js/graficos/graficoBoletas.js')?>
@endsection
@section('contenido')
<div class="row" style="padding-bottom: 30px">
    <div class="col-lg-12">
        <a href="{{Route('boleta.reporte')}}" class="btn btn-sm btn-danger" style="width: auto">Regresar</a>
    </div>
</div>
<div class="panel">
    <header class="panel-heading">
        <span class="align-middle">
            <p class="text-center" style="font-size: 20">
                <strong>BOLETAS EMITIDAS EL ULTIMO AÑO</strong>
            </p>

        </span>
    </header>


    <div class="panel-body">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <div>
            <canvas id="boletas" width="00px" height="300px"></canvas>
        </div>
    </div>

</div>

@endsection
