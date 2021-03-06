<?php 
session_start();
if($_SESSION['RepFacGen'] == 'true'){
  echo '<div class="header">
  <h2><strong>Reporte de Facturas</strong></h2>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="panel">
      <div class="panel-header">
        <h3><i class="icon-bulb"></i>Reporte de <strong>Facturación</strong></h3>
      </div>
      <div class="panel-content p-t-0">
        <p>Seleccione los filtros y da clic en Generar.</p>
        <div class="row">
          <div class="col-md-12 no-print">
            <div class="form-group col-md-3" id="sandbox-container">
              <label class="form-label">Fecha desde: </label>
              <div class="prepend-icon">
                <input id="fecha-desde" type="text" name="timepicker" class="b-datepicker form-control" placeholder="Fecha desde...">
                <i class="icon-clock"></i>
              </div>
            </div>
            <div class="form-group col-md-3" id="sandbox-container">
              <label class="form-label">Fecha hasta: </label>
              <div class="prepend-icon">
                <input id="fecha-hasta" type="text" class="b-datepicker form-control" placeholder="Fecha hasta...">
                <i class="icon-clock"></i>
              </div>
            </div>
            <div class="form-group col-md-3">
              <label class="form-label">Nombre Cliente </label>
              <div>
                <input id="cliente" type="text"class="form-control" placeholder="ej. Juan Perez">
              </div>
            </div>
            <div class="form-group col-md-3">
              <label class="form-label">Folio </label>
              <div>
                <input id="folio" type="text" class="form-control" placeholder="ej. FA000FACT">
              </div>
            </div>
            <button onClick="onClickAction()" type="button" class="btn btn-primary btn-square">Generar</button>
            <button onClick="onClickPDF()" type="button" class="btn btn-danger btn-square">PDF</button>
          </div>
          <div id="response">

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="assets/js/views/rep_invoice.js"></script>
<script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script> <!-- >Bootstrap Date Picker -->
<link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet">
<link href="assets/plugins/rateit/rateit.css" rel="stylesheet">
<script>
$("#sandbox-container input").datepicker({});
</script>
';
} else {
  echo '
    <script type="text/javascript">
    alert("No cuenta con los permisos necesarios.");
    </script>
  ';
}