<?php 
session_start();
if($_SESSION['MovLisGen']){
  echo '<div class="header">
  <h2><strong>Movimientos</strong></h2>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="panel">
      <div class="panel-header">
        <h3><i class="icon-bulb"></i>Listado de Facturas o Ticket <strong>Movimientos</strong></h3>
      </div>
      <div class="panel-content force-table-responsive">
        <h4>Cliente</h4>
        <div class="col-md-12">
          <div class="col-md-4">
            <label>Nombre de Cliente</label>
            <input id="clientName" type="text" class="form-control" placeholder="Filtrar por Nombre de Cliente">
          </div>
          <div class="col-md-4">
            <label>Clave de Factura</label>
            <input id="keyInvoice" type="text" class="form-control" placeholder="Filtrar por Clave de Factura">
          </div>
          <div class="col-md-4">
            <label>Nombre de Usuario</label>
            <input id="userName" type="text" class="form-control" placeholder="Filtrar por Nombre de usuario">
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
              <th>Fecha</th>
              <th>Tipo</th>
              <th>Status</th>
              <th>Cliente</th>
              <th>Usuario</th>
              <th>Seguimiento</th>
              <th>Total</th>
              <th></th>
              <th></th>
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
<script src="assets/js/views/movelist.js"></script>
';
} else {
  echo '
    <script type="text/javascript">
    alert("No cuenta con los permisos necesarios.");
    </script>
  ';
}