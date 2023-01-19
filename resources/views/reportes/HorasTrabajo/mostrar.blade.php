@extends('base.content')
@section('contenido')


<div class="row" style="padding-bottom: 30px">
    <div class="col-lg-12">
        <a target="_blank" href="{{Route('horast.descarga',array($ini,$fin))}}" class="btn btn-sm btn-success"><i
                class="fas fa-file-pdf"></i><strong>&nbsp Guardar y Visualizar</strong></a>
        <a  href="{{Route('grafico.horast',array($ini,$fin))}}" class="btn btn-sm btn-warning"><strong> Gráfico</strong></a>
        <a href="{{Route('horast.inicio')}}" class="btn btn-sm btn-danger" style="margin-left:800px">Regresar</a>
    </div>
</div>


<div class="panel">
    <header class="panel-heading">
        <span class="align-middle">
            @if ($ini == $fin)
            <p class="text-center" style="font-size: 20"><strong>HORAS TRABAJADAS EN EL
                    DIA:&nbsp;&nbsp;{{date('d/m/Y',strtotime($ini))}} <br> (AGRUPADAS POR TRABAJADOR)</strong></p>
            @else
            <p class="text-center" style="font-size: 20"><strong>HORAS TRABAJADAS DESDE EL
                    &nbsp;&nbsp;{{date('d/m/Y',strtotime($ini))}} &nbsp;&nbsp;HASTA EL
                    &nbsp;&nbsp;{{date('d/m/Y',strtotime($fin))}} <br> (AGRUPADAS POR TRABAJADOR)</strong></p>
            @endif
        </span>
    </header>

    <div class="panel-body">
        <table class="table table-dark">
            <thead style="text-align: center">
                <tr>
                    <th scope="col" style="text-align: center">Nro</th>
                    <th scope="col" style="text-align: center" >Colaborador</th>
                    <th scope="col" style="text-align: center">Cargo</th>
                    <th scope="col" style="text-align: center">Horas Trabajadas</th>
                </tr>
            </thead>
            <tbody id="tbody-horast" style="text-align: center">
                @php $cont =1 @endphp
                @foreach ($row as $r)
                <tr>
                  <td scope="row">{{$cont}}</td>
                  <td scope="row">{{$r['colaborador']}}</td>
                  <td scope="row">{{$r['cargo']}}</td>
                  <td scope="row">{{$r['horas']}} hrs.</td>
                </tr>
                @php $cont++ @endphp
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection
