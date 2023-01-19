@extends('base.content')
@section('contenido')

<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            SELECCIONE UN COLABORADOR
        </header>
        <div class="panel-body">
            <form class="form-inline" role="form" method="POST"  action="{{Route('boleta.generar')}}">
                @csrf
                <div class="form-group">

                    <select id="colB" name="colB" class="form-control" >
                        <option disabled selected>Colaborador</option>
                        @foreach ($colaboradores as $col)
                        <option value="{{$col->idColaborador}}">{{$col->col_nombres}} {{$col->col_apellidos}}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Seleccionar</button>
            </form>

        </div>
    </section>

</div>


@endsection
