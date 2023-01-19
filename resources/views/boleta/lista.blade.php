@extends('base.content')
@section('contenido')



<div class="row" style="padding-bottom: 30px">
    <div class="col-lg-12">

        <a href="{{Route('grafico.boleta')}}" class="btn btn-sm btn-warning"><strong> Gráfico</strong></a>
    </div>
  </div>
<section class="panel">
    <header class="panel-heading">
        <span class="align-middle">
            <p class="text-center" style="font-size: 18"><strong>BOLETAS GENERADAS</strong></p>
        </span>
    </header>

    <div class="panel-body">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col"> <i class="icon_profile"></i> Colaborador </th>
                    <th scope="col"> <i class="icon_profile"></i> Registrada el </th>
                    <th scope="col"> <i class="icon_profile"></i> Total </th>
                    <th scope="col"><i class="icon_cogs"></i> Opciones</th>
                </tr>
            </thead>
            <tbody>
                @php $cont=1 @endphp
                @foreach ($row as $r)
                <tr>
                    <th scope="row">{{$cont}}</th>
                    <td>{{$r['colaborador']}}</td>
                    <td>{{$r['fecha']}}</td>
                    <td>{{$r['total']}}</td>
                    <td>
                        <button class="btn btn-danger" class="btn btn-primary" data-toggle="modal"
                        data-target="#DelTurModal{{$cont}}" title="Eliminar">
                            <a><i class="icon_trash" style="color: rgb(161, 26, 26)"></i></a>
                        </button>

                        <div class="modal fade" id="DelTurModal{{$cont}}" tabindex="-1"
                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title">ELIMINAR BOLETA</h5>
                                        </div>

                                        <div class="modal-body">
                                            ¿Desea eliminar la boleta seleccionada?
                                        </div>


                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">NO</button>
                                            <button type="submit" class="btn btn-primary"
                                                onclick="location.href='{{Route('boleta.borrar',$cont)}}'"><strong>
                                                    SI</strong></button>
                                        </div>

                                    </div>
                                </div>
                            </div>


                    </td>
                </tr>
                @php $cont++ @endphp
                @endforeach
            </tbody>
        </table>
    </div>


</section>





@endsection
