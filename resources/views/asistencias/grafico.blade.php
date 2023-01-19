@extends('base.content')
@section('styles')
<?php echo Html::script('js/alertas/tipoProd.js')?>
@endsection
@section('contenido')
<div class="container-fluid px-4">
    <div class="row">
        <div class="card mb-4">
            <div class="card-header">
                <span class="align-middle">
                    @if ($ini == $fin)
                        <p class="text-center" style="font-size: 20"><strong>ASISTENCIAS DEL DIA:&nbsp;&nbsp;{{date('d/m/Y',strtotime($ini))}}</strong></p>
                    @else
                        <p class="text-center" style="font-size: 20"><strong>ASISTENCIAS DESDE EL &nbsp;&nbsp;{{date('d/m/Y',strtotime($ini))}} &nbsp;&nbsp;HASTA EL &nbsp;&nbsp;{{date('d/m/Y',strtotime($fin))}}</strong></p>
                    @endif
                </span>
            </div>
            <div class="card-body">
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            </div>
        </div>  
    </div>
    <div class="row">
        <form method="POST">
            <input type="hidden" name="base64" id="base64"/>
            @csrf
            <button type="submit" class="form-control btn btn-success">
                <strong> Guardar imagen</strong>
            </button>
        </form>
    </div>
</div>
@endsection
