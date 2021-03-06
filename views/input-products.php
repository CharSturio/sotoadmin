<?php 
session_start();
require '../connection/index.php';

if($_SESSION['MovEntMerGen'] == 'true'){
  echo '<div class="header">
	<h2><strong>Entrada Mercancia</strong></h2>
</div>
<div class="row">
	<div class="col-lg-12">
	  <div class="panel">
	    <div class="panel-header">
	      <h3><i class="icon-bulb"></i> Entrada<strong>Mercancia</strong></h3>
	    </div>
	    <div class="panel-content p-t-0">
	      <p>Selecciona Producto. Agrega cantidad, proveedor y costo unitario, y da clic en Agregar.</p>
	      <div class="row">
	        <div class="col-md-12">
	          <button class="btn btn-dark m-t-5" data-toggle="modal" data-target="#modal-bootstrap-timepicker">Escoger Producto</button>
	        </div>
					<div id="divProducts" class="col-md-12">

          </div>
	        <div class="col-md-12">
						<div class="col-md-6">
							<div class="form-group">
								<label for="sucursal">Sucursal</label>
								<select id="branches" class="form-control">';
								$query = "SELECT * FROM branches";
								$result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
								while ($row = mysqli_fetch_assoc($result)) {
									echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
								}

								echo '
								</select>
								</div>
	            <div class="form-group">
    			  
	              <label class="form-label">Proovedor</label>
	              <input id="provider" type="text" class="form-control" placeholder="Ingrese Proovedor">
	            </div>
	            <div class="form-group">
	              <label class="form-label">Cantidad</label>
	              <input id="amount" type="text" class="form-control" placeholder="Ingrese Cantidad">
	            </div>
	            <div class="form-group">
	              <label class="form-label">Costo Unitario</label>
	              <input id="unitCost" type="text" class="form-control" placeholder="Ingrese Costo Unitario">
	            </div>
	          </div>
	        </div>
	        <div class="col-md-6">
	          <button onclick="onClickAdd()" type="button" class="btn btn-success btn-square">Agregar</button>
	        </div>
					<div id="response">

					</div>
	      </div>
	    </div>
	  </div>
	</div>
</div>
<script src="assets/js/views/input-products.js"></script>
<div class="modal fade" id="modal-bootstrap-timepicker" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
        <h4 class="modal-title"><strong>Seleccion de </strong> Producto</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <h3>Escribe tu busqueda, y da clic en Buscar.</h3>
          <div class="col-md-6">
            <label class="form-label">Nombre</label>
            <input id="nameProduct" type="text" class="form-control" placeholder="Ingrese el nombre del producto...">
            <button onclick="onClickBrowserName()" type="button" class="btn btn-primary btn-embossed" data-dismiss="modal">Seleccionar</button>
          </div>
          <div class="col-md-6">
            <label class="form-label">Código de Barras</label>
            <input id="barcodeProduct" type="text" class="form-control" placeholder="Ingrese el código de barras...">
            <button onclick="onClickBrowserBarcode()" type="button" class="btn btn-primary btn-embossed" data-dismiss="modal">Seleccionar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>';
} else {
  echo '
    <script type="text/javascript">
    alert("No cuenta con los permisos necesarios.");
    </script>
  ';
}
