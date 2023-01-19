@extends('base.content')
@section('contenido')

@if ($bandera == 1)
<form method="POST" action="{{Route('entrada.register')}}">
    @csrf
    <section class="panel" style="text-align: center">
        <div class="panel-body">
            <h5>¡Que tenga un excelente día,
                {{Auth::User()->colaborador->col_nombres.' '.Auth::User()->colaborador->col_apellidos}}</h5>
            <button type="submit" class="btn btn-primary">
                Registrar Entrada
            </button>
        </div>
    </section>


</form>

@elseif($bandera == 2)

<div style="content: center">
    <div class="col-lg-3">

    </div>
    <div class="col-lg-6">
        <form method="post" role="form" class="contactForm" action="{{Route('salida.register')}}">
            @csrf

            <div class="form-group">
                <textarea class="form-control" placeholder="Observaciones" id="floatingTextarea" id="obsevR"
                    name="obsevR"></textarea>
                <div class="validation"></div>
            </div>

            <div class="form-group">
                <div class="text-center"><button type="submit" class="btn btn-primary">Registrar Salida</button></div>
            </div>

        </form>
    </div>
</div>


@else
<div class="col-lg-3">

</div>
<div class="col-lg-6">
    <section class="panel">

            <div class="alert alert-light" role="alert" style="text-align: center">
                El usuario {{Auth::User()->colaborador->col_nombres.' '.Auth::User()->colaborador->col_apellidos}} ha registrado su
            salida.
              </div>

    </section>
</div>
@endif





@endsection
