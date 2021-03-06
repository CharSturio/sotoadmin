<?php 
session_start();
if($_SESSION['UtiEySCGen'] == 'true'){
  echo '<div class="header">
	<h2><strong>Entradas y salidas de Caja</strong></h2>
</div>
<div class="row">
	<div class="col-lg-12">
	  <div class="panel">
	    <div class="panel-header">
	      <h3><i class="icon-bulb"></i> Salida <strong>Caja</strong></h3>
	    </div>
			<div class="panel-content p-t-0">
	      <p>Ingrese el comprobante, el monto en cantidad y la descripcion de la salida.</p>
	      <div class="row">
	        <div class="col-md-12">
	          <div class="col-md-6">
	            <div class="form-group">
	              <label class="form-label">Comprobante/Factura</label>
	              <input id="comprobante" type="text" class="form-control" placeholder="Ingrese Comprobante">
	            </div>
	            <div class="form-group">
	              <label class="form-label">Cantidad</label>
	              <input id="cantidad" type="text" class="form-control" placeholder="Ingrese Cantidad">
	            </div>
	            <div class="form-group">
	              <label class="form-label">Descripción</label>
	              <input id="descripcion" type="text" class="form-control" placeholder="Ingrese Descripción">
	            </div>
	          </div>
	        </div>
	        <div class="col-md-6">
	          <button onclick="onClickAdd()" type="button" class="btn btn-success btn-square">Agregar Salida</button>
	        </div>
					<div id="response">

					</div>
	      </div>
	    </div>
		</div>
		<div class="panel">
			<div class="panel-header">
	      <h3><i class="icon-bulb"></i> Entrada <strong>Caja</strong></h3>
	    </div>
			<div class="panel-content p-t-0">
	      <p>Ingrese el comprobante, el monto en cantidad y la descripcion de la entrada.</p>
	      <div class="row">
	        <div class="col-md-12">
	          <div class="col-md-6">
	            <div class="form-group">
	              <label class="form-label">Comprobante/Factura</label>
	              <input id="comprobante2" type="text" class="form-control" placeholder="Ingrese Comprobante">
	            </div>
	            <div class="form-group">
	              <label class="form-label">Cantidad</label>
	              <input id="cantidad2" type="text" class="form-control" placeholder="Ingrese Cantidad">
	            </div>
	            <div class="form-group">
	              <label class="form-label">Descripción</label>
	              <input id="descripcion2" type="text" class="form-control" placeholder="Ingrese Descripción">
	            </div>
	          </div>
	        </div>
	        <div class="col-md-6">
	          <button onclick="onClickAdd2()" type="button" class="btn btn-success btn-square">Agregar Entrada</button>
	        </div>
					<div id="response2">

					</div>
	      </div>
	    </div>
		</div>
	  </div>
	</div>
</div>
<script src="assets/js/views/cash-out.js"></script>';
} else {
  echo '
    <script type="text/javascript">
    alert("No cuenta con los permisos necesarios.");
    </script>
  ';
}
