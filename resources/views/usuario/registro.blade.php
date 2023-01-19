@extends('base.content')
@section('styles')
<?php echo Html::script('js/reloj/perfilReg.js')?>
<?php echo Html::script('js/alertas/perfilReg.js')?>
@endsection
@section('contenido')

<div class="container-fluid px-4">
    <div class="card mb-4">
        <div class="card-header" id="tipoRegistro">
            REALIZAR REGISTRO DE {{$tipo}}
        </div>

        <div class="card-body">
            <form method="POST">
                @csrf
                <div id="clockdate">
                    <div class="clockdate-wrapper">
                        <div id="title"></div>
                        <div id="clock"></div>
                        <div id="date"></div>
                    </div>
                </div>
                <div class="mt-4 mb-0">
                    <div class="row mb-3" id='btnReg'>
                        <div class="col-md-6">
                            <div class="d-grid">
                                <button type="button" class="btn btn-primary" onclick="registrar('{{$tipo}}');"><strong> Registrar {{$tipo}}  </strong></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection