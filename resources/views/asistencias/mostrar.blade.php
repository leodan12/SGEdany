@extends('base.content')

@section('contenido')


  <div class="row" style="padding-bottom: 30px">
    <div class="col-lg-12">
      <a target="_blank" href="{{Route('asistencia.descarga',array($ini,$fin))}}" class="btn btn-sm btn-success"><i class="fas fa-file-pdf"></i><strong> Visualizar</strong></a>
              <a href="{{Route('grafico.asistencia',array($ini,$fin))}}" class="btn btn-sm btn-warning"><strong>  Gráfico</strong></a>
            <a href="{{Route('asistencia.reporte')}}" class="btn btn-sm btn-danger" style="margin-left:900px">Regresar</a>
    </div>
  </div>


<div class="panel">
    <header class="panel-heading">
        <span class="align-middle">
            @if ($ini == $fin)
            <p class="text-center" style="font-size: 20"><strong>ASISTENCIAS DEL DIA:&nbsp;&nbsp;{{date('d/m/Y',strtotime($ini))}}</strong></p>
            @else
            <p class="text-center" style="font-size: 20"><strong>ASISTENCIAS DESDE EL &nbsp;&nbsp;{{date('d/m/Y',strtotime($ini))}} &nbsp;&nbsp;HASTA EL &nbsp;&nbsp;{{date('d/m/Y',strtotime($fin))}}</strong></p>
            @endif
        </span>
    </header>

    <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-dark">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Registrado el</th>
                <th scope="col">Colaborador</th>
                <th scope="col">Cargo</th>
              </tr>
            </thead>
            <tbody>
              @php $cont =1 @endphp
              @foreach ($row as $r)
              <tr>
                <td scope="row">{{$cont}}</td>
                <td scope="row">{{date('d/m/Y',strtotime($r['registrado']))}}</td>
                <td scope="row">{{$r['colaborador']}}</td>
                <td scope="row">{{$r['cargo']}}</td>
              </tr>
              @php $cont++ @endphp
              @endforeach
            </tbody>
          </table>
        </div>
    </div>
</div>


@endsection
