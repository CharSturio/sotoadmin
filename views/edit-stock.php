<?php 
session_start();
if($_SESSION['MovInvGen'] == 'true'){
  echo '<div class="header">
  <h2><strong>Inventarios</strong></h2>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="panel">
      <div class="panel-header">
        <h3><i class="icon-bulb"></i> Modificar | Entrada y Salida por Devolución <strong>Inventarios</strong></h3>
      </div>
      <div class="panel-content p-t-0">
        <p> Selecciona tipo de Producto. Para filtrar, escribe el código de barras y/o clave, y/o nombre. Selecciona un producto de la lista y elige el tipo de operacion a realizar.</p>
        <div class="row">
          <div class="col-md-6">
              <label class="form-label">Código de Barras</label>
              <input id="barcode" type="text" class="form-control" placeholder="Filtrar por Código de barras">
              <label class="form-label">Clave</label>
              <input id="key" type="text" class="form-control" placeholder="Filtrar por clave">
          </div>
          <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">Nombre</label>
            <input id="name" type="text" class="form-control" placeholder="Filtrar por Nombre">
          </div>
          </div>
          <div class="col-md-12">
            <button onclick="onClickBrowser()"type="button" class="btn btn-primary btn-square">Buscar</button>
          </div>
          <div class="col-md-12 border-top" style="border-top:1px;">
            <div class="panel-content">
              <table class="table table-striped tablet-tools">
                <thead>
                  <tr>
                    <th>Existencia</th>
    				<th>Sucursal</th>
                    <th>Código de Barras</th>
                    <th>Clave</th>
                    <th>Nombre</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id="response">

                </tbody>
              </table>
            </div>
          </div>
          <div class="col-md-12 border-top" style="border-top:1px;">
              <h3>Existencia de <b id="printName">Nombre Producto</b></h3>
              <p>
                Existencia en Almacen: <b id="printAmount"></b>
              </p>
              <div class="col-md-12">
                <button data-toggle="modal" data-target="#modal-bootstrap-timepicker" onClick="onClickModify()" type="button" class="btn btn-success btn-square">Modificar</button>
                <button data-toggle="modal" data-target="#modal-bootstrap-timepicker" onClick="onClickIn()" type="button" class="btn btn-primary btn-square">Entrada por Devolucion</button>
                <button data-toggle="modal" data-target="#modal-bootstrap-timepicker" onClick="onClickOut()" type="button" class="btn btn-danger btn-square">Salida por Devolucion</button>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="assets/js/views/edit-stock.js"></script>
<div class="modal fade" id="modal-bootstrap-timepicker" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
        <div id="titleOperation">

        </div>
      </div>
      <div class="modal-body">
        <p>Pon la catidad y da clic en el boton Guardar.</p>
        <div class="row">
          <div class="col-md-12 border-top" style="border-top:1px;">
            <div class="panel-content">
              <div class="col-md-12">
                <div class="col-md-8">
                  <div class="form-group">
                    <label>Cantidad</label>
                    <input id="alterStock" type="text" class="form-control" placeholder="XXXXXXXX">
                    <div id="button">

                    </div>
                  </div>
                </div>
                <div class="col-md-2">

                </div>
                <div class="col-md-2" id="buttons">

                </div>
              </div>
            </div>
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
