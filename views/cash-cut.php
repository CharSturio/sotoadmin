<?php 
session_start();
if($_SESSION['UtiCCGen'] == 'true'){
  echo '<div class="header">
  <h2><strong>Corte de Caja</strong></h2>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="panel">
      <div class="panel-header">
        <h3><i class="icon-bulb"></i>Corte de <strong>Caja</strong></h3>
      </div>
      <div class="panel-content p-t-0">
        <p> Favor de elegir las fechas y dar clic en Corte de Caja, para generar resultados.</p>
        <div class="row">
          <div class="col-md-12 no-print">
            <div class="form-group col-md-4" id="sandbox-container">
              <label class="form-label">Fecha desde: </label>
              <div class="prepend-icon">
                <input id="fecha-desde" type="text" name="timepicker" class="b-datepicker form-control" placeholder="Fecha desde...">
                <i class="icon-clock"></i>
              </div>
            </div>
            <div class="form-group col-md-4" id="sandbox-container">
              <label class="form-label">Fecha hasta: </label>
              <div class="prepend-icon">
                <input id="fecha-hasta" type="text" name="timepicker" class="b-datepicker form-control" placeholder="Fecha hasta...">
                <i class="icon-clock"></i>
              </div>
            </div>
            <div class="form-group col-md-4">
              <label class="form-label">Correo </label>
              <div class="prepend-icon">
                <input id="correo" type="email" name="timepicker" class="b-datepicker form-control" placeholder="ejemplo@dominio.com">
              </div>
            </div>
            <button onClick="onClickAction()" type="button" class="btn btn-primary btn-square">Corte Caja</button>
            <button onClick="onClickPDF()" type="button" class="btn btn-danger btn-square">PDF</button>
            <button onClick="onClickSend()" type="button" class="btn btn-success btn-square">Enviar por Correo</button>
          </div>
          <div id="response">

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="assets/js/views/cash-cut.js"></script>
<script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script> <!-- >Bootstrap Date Picker -->
<link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet">
<link href="assets/plugins/rateit/rateit.css" rel="stylesheet">
<script>
$("#sandbox-container input").datepicker({});</script>';
} else {
  echo '
    <script type="text/javascript">
    alert("No cuenta con los permisos necesarios.");
    </script>
  ';
}
