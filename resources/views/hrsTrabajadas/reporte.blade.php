@extends('base.content')
@section('styles')
<?php echo Html::script('js/reportes/hrsTrabajadas.js')?>
@endsection
@section('contenido')
<div class="container-fluid px-4">
<div class="card">
        <div class="card-header" >
          <h4>GENERAR REPORTE DE HORAS TRABAJADAS</h4>
        </div>
        <div class="card-body" id="contenido">
          <div class="row justify-content-md-center">
            <form method="POST" >
                @csrf
                <div class="col-md-6">
                  <div class="alert alert-danger" role="alert" id="alert">
                    ERROR! VERIFIQUE LAS FECHAS DE INICIO Y FIN
                  </div>
                </div>
                <div class="row mb-3" style="dispay:flex,justify-content: center;">
                  <div class="col-md-3">
                      <div class="form-floating mb- mb-md-0">
                      <input class="form-control" id="iniB" name="iniB" type="date"
                        size="10" max="{{$hoy}}" value="{{$hoy}}">
                          <label for="iniB">Desde:</label>
                      </div>
                  </div>
                  <div class="col-md-3">
                      <div class="form-floating">
                      <input class="form-control" id="finB" name="finB" type="date"
                        size="16" max="{{$hoy}}" value="{{$hoy}}">
                          <label for="finB">Hasta:</label>
                      </div>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-6">
                    <button type="button" class="form-control btn btn-success" onclick="verificar();">
                        <i class="fas fa-search"> </i><strong> BUSCAR</strong>
                    </button>
                  </div>
                </div>
            </form>
          </div>
          <div class="row" id="OreporteT">
            <div class="col-mb-12">
            <a  class="btn btn-sm btn-danger" onclick="verGrafico();"><i class="fas fa-chart-area"></i><strong>  Gráfico</strong></a>
              <a target="_blank" class="btn btn-sm btn-primary" onclick="pdfTabla();"><i class="fas fa-file-pdf"></i><strong> PDF</strong></a>
              
            </div>
          </div>
          <div class="row" id="OreporteG">
            <div class="col-mb-12">
            <a  class="btn btn-sm btn-danger" onclick="verTabla();"><i class="fas fa-chart-area"></i><strong>Tabla</strong></a>
              <a target="_blank" class="btn btn-sm btn-primary" onclick="pdfGrafico();"><i class="fas fa-file-pdf"></i><strong> PDF</strong></a>
              
            </div>
          </div>
          <div class="row" id="Treporte">
          </div>
          <div class="row" id="Greporte">
          </div>
        </div>
      </div>
</div>
@endsection



