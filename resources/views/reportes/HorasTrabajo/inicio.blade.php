@extends('base.content')
@section('contenido')

<section class="panel" style="width: 400px; margin-left:350px">

    <header class="panel-heading">
        <span class="align-middle">
            <p class="text-center" style="font-size: 25"><strong>GENERAR REPORTE DE HORAS TRABAJADAS</strong></p>
        </span>
    </header>
    <div class="panel-body" style="height: auto">

        <form style="margin-left: 30px" method="POST" action="{{Route('mostrar.horast')}}" class="@error('error') is-invalid @enderror">
            @csrf

            @error('error')
                        <span class="invalid-feedback alert-danger" role="alert" style="margin-left:20px; width:200px" >
                            <strong>{{$message}}<br></strong>
                        </span>
            @enderror
            @error('falta')
                        <span class="invalid-feedback alert-danger" role="alert" style="margin-left:85px; width:200px" >
                            <strong>{{$message}}<br></strong>
                        </span>
            @enderror
            <div class="form-group row" style="margin-top: 10px">
              <label class="col-sm-4 col-form-label" style="margin-top: 5px">Fecha Inicio:</label>
              <div class="col-sm-7">
                <input class="form-control" id="fini" name="fini" type="date"
                        size="10" value="{{old('iniB')}}" max="{{$hoy}}">
              </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label" style="margin-top: 5px">Fecha Final:</label>
              <div class="col-sm-7">
                <input class="form-control" id="ffinB" name="ffin" type="date"
                        size="16" value="{{old('finB')}}"  max="{{$hoy}}">
              </div>
            </div>

            <div class="form-group row" style="margin-left: 60px">
              <div class="col-sm-8">
                <button type="submit" class="form-control btn btn-success">
                    <i class="fas fa-search"> </i><strong> BUSCAR</strong>
                </button>
              </div>
            </div>
          </form>
    </div>
</section>
@endsection
