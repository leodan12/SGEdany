@extends('base.content')
@section('styles')
<?php echo Html::script('js/reportes/inventario.js')?>
@endsection
@section('contenido')
<div class="container-fluid px-4">
<div class="card">
        <div class="card-header" >
       <h4>INVENTARIO DE ALMACÉN</h4>
        </div>
        <div class="card-body" id="contenido">
          <div class="row" id="OreporteT">
            <div class="col-mb-12">
              <a target="_blank" class="btn btn-sm btn-primary" onclick="pdfTabla();"><i class="fas fa-file-pdf"></i><strong> PDF</strong></a>
            </div>
          </div>
          <div class="row" id="Treporte">
          </div>
        </div>
      </div>
</div>
@endsection



