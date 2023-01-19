@extends('base.content')
@section('styles')
<?php echo Html::script('js/reportes/boletas.js')?>
@endsection
@section('contenido')
<div class="container-fluid px-4">
<div class="card">
        <div class="card-header" >
       <h4>GENERAR REPORTE DE BOLETAS EMITIDAS</h4>
        </div>
        <div class="card-body" id="contenido">
          <div class="row justify-content-md-center">
            <form method="POST" >
                @csrf
                <div class="row mb-3" style="dispay:flex,justify-content: center;">
                  <div class="col-md-3">
                      
                      <div class="form-floating mb- mb-md-0">
                            <select class="form-select" name="periodo" id="periodo" class="form-control" required>
                                @foreach ($periodos as $periodo)
                                    <option value="{{$periodo->Periodo}}">{{$periodo->Periodo}}</option>
                                @endforeach
                            </select>
                            <label for="colSexo">Seleccione un periodo</label>
                        </div>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-3">
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



