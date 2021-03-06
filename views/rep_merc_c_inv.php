<?php 
session_start();
if($_SESSION['RepMerCInvGen'] == 'true'){
  echo '<div class="header">
  <h2><strong>Reporte de Mercancia con Inventarios</strong></h2>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="panel">
      <div class="panel-header">
        <h3><i class="icon-bulb"></i>Reporte de mercancia con <strong>Inventarios</strong></h3>
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
          </div>
          <div class="col-md-12 no-print">
            <button onClick="onClickAction()" type="button" class="btn btn-primary btn-square">Ver</button>
            <button onClick="onClickPDF()" type="button" class="btn btn-success btn-square">Excel</button>
          </div>
          <div id="response">

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="assets/js/views/rep_merc_c_inv.js"></script>
<script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script> <!-- >Bootstrap Date Picker -->
<link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet">
<link href="assets/plugins/rateit/rateit.css" rel="stylesheet">
<script>
$("#sandbox-container input").datepicker({});
</script>';
} else {
  echo '
    <script type="text/javascript">
    alert("No cuenta con los permisos necesarios.");
    </script>
  ';
}
