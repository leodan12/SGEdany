@extends('base.content')
@section('contenido')

<section class="main-content">

    <div class="row">

        <div class="col-lg-12 col-md-3 col-sm-12 col-xs-12">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalAgregarIngreso">
                Agregar
            </button>
        </div>
        <div class="modal fade" id="ModalAgregarIngreso" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><strong> AGREGAR INGRESO</strong></h5>
                    </div>

                    <section class="panel">
                        <div class="panel-body">
                            <form method="POST"  action="{{Route('ingreso.guardar')}}">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-lg-2"></div>
                                    <div class="form-group col-lg-10">
                                        <label>Colaborador</label>
                                        <select name="colI" id="colI" class="form-control" style="width: 80%">
                                            @foreach ($colaboradores as $col)
                                            <option value="{{$col->idColaborador}}">{{$col->col_nombres}}
                                                {{$col->col_apellidos}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="form-row">
                                    <div class="form-group col-lg-6">
                                        <label>Tipo Ingreso</label>
                                        <select name="tipI" id="tipI" class="form-control" style="width: 80%">
                                            @foreach ($ingresos as $ingreso)
                                            <option value="{{$ingreso->idTipoIngreso}}">{{$ingreso->ing_nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Monto</label>
                                        <input type="number" name="montI" id="montI" class="form-control"
                                            style="width: 90%">
                                    </div>

                                </div>
                                <div class="form-row">

                                    <div class="form-group col-lg-6">
                                        <label>Fecha de adelanto</label>
                                        <input type="date" name="fechI" id="fechI" class="form-control"
                                            style="width: 90%">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Registrado el</label>
                                        <input type="datetime" name="regI" id="regI" class="form-control"
                                            value="<?php echo date("d-m-Y");?>" style="width: 90%">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-lg-10"></div>
                                </div>
                                <div class="form-row">
                                    <div class="form group col-lg-10">
                                        <button type="submit" class="btn btn-primary"><strong>
                                                Guardar</strong></button>
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cancelar</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </section>


                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-3 col-sm-12 col-xs-12">
            <br>
        </div>
        <!--
        <div class="col-lg-12 col-md-3 col-sm-12 col-xs-12">
            <div class="panel">
                <header class="panel-heading">CONTRATOS</header>
                <div class="panel-body">



                </div>


            </div>
        </div>-->
    </div>

</section>




@endsection
