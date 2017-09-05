<?php 
session_start();
if($_SESSION['UtiStoMinGen'] == 'true'){
  echo '<div class="header">
  <h2><strong>Reporte de minino en stocks</strong></h2>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="panel">
      <div class="panel-header">
        <h3><i class="icon-bulb"></i>Reporte de <strong>Minimo en Stocks</strong></h3>
      </div>
      <div class="panel-content p-t-0">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group col-md-6">
              <label for="permisos">Tipo de Producto</label>
              <select id="typeProduct" class="form-control" name="favoriteNumber">
                <option value="llantas">Llantas</option>
                <option value="rines">Rines</option>
                <option value="productos">Productos y Accesorios</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label class="form-label">Correo </label>
              <div class="prepend-icon">
                <input id="email" type="email" name="timepicker" class="b-datepicker form-control" placeholder="ejemplo@dominio.com">
              </div>
            </div>
          </div>
          <div class="col-md-12 no-print">
            <button onClick="onClickSend()" type="button" class="btn btn-success btn-square">Enviar</button>
          </div>
          <div id="response">

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="assets/js/views/send_min_stocks.js"></script>
<script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script> <!-- >Bootstrap Date Picker -->
<link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet">
<link href="assets/plugins/rateit/rateit.css" rel="stylesheet">
<script>
$("#sandbox-container input").datepicker({
});
</script>';
} else {
  echo '
    <script type="text/javascript">
    alert("No cuenta con los permisos necesarios.");
    </script>
  ';
}
