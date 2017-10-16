<?php 
session_start();
if($_SESSION['MovLisGen'] == 'true'){
  echo '<div class="header">
  <h2><strong>Transferencia de Productos</strong></h2>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="panel">
      <div class="panel-header">
        <h3><i class="icon-bulb"></i>Listado de transferencias de <strong>Productos</strong></h3>
      </div>
      <div class="panel-content force-table-responsive">
        <h4>Cliente</h4>
        <div class="col-md-12">
          <div class="col-md-4">
            <label>Sucursal Salida</label>
            <input id="out" type="text" class="form-control" placeholder="Filtrar por Sucursal Salida">
          </div>
          <div class="col-md-4">
            <label>Sucursal Entrada</label>
            <input id="in" type="text" class="form-control" placeholder="Filtrar por Sucursal Entrada">
          </div>
          <div class="col-md-4">
            <label>Clave Producto</label>
            <input id="id" type="text" class="form-control" placeholder="Filtrar por Clave Producto">
          </div>
          <div class="col-md-4">
            <br />
            <button onclick="onClickBrowser()" type="button" class="btn btn-primary btn-square">Buscar</button>
          </div>
        </div>
        <div id="response">

        </div>
        <table class="table table-striped">
          <thead>
            <tr>
            <th>Clave</th>
            <th>Clave Producto</th>
            <th>Sucursal Salida</th>
              <th>Sucursal Entrada</th>
              <th>Usuario</th>
              <th>Cantidad</th>
              <th>Fecha</th>
              <th></th>
            </tr>
          </thead>
          <tbody id="table">

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<div class="footer">
  <div class="copyright">
    <p class="pull-left sm-pull-reset"> <span>Copyright <span class="copyright">©</span> 2016 </span> <span>Sturio</span>. <span>Soto GoodYear, todos los derechos reservados.. </span> </p>
  </div>
</div>
<script src="assets/js/views/transferlist.js"></script>
';
} else {
  echo '
    <script type="text/javascript">
    alert("No cuenta con los permisos necesarios.");
    </script>
  ';
}
