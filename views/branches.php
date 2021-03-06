<?php 
session_start();
if($_SESSION['RegSucGen'] == 'true'){
  echo '<div class="header">
  <h2><strong>Sucursales</strong></h2>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="panel">
      <div class="panel-header">
        <h3><i class="icon-bulb"></i> Crear | Modificar | Suspender <strong>Sucursales</strong></h3>
      </div>
      <div class="panel-content p-t-0">
        <p> Favor de agregar todos los campos con *. Para modificar información, selecciona sucursal en "escoge sucursal", solo edita y da clic en el botón Editar o Eliminar.</p>
        <div class="row">
          <div class="col-md-6">
              <label class="form-label">Nombre Sucursal</label>
              <input id="name" type="text" class="form-control" placeholder="Ingrese Nombre">
              <label class="form-label">Calle</label>
              <input id="address" type="text" class="form-control" placeholder="Ingrese Calle">
              <label class="form-label">No Int</label>
              <input id="nint" type="text" class="form-control" placeholder="Ingrese No Int">
              <label class="form-label">Municipio</label>
              <input id="city" type="text" class="form-control" placeholder="Ingrese Municipio">
              <label class="form-label">C.P.</label>
              <input id="cp" type="text" class="form-control" placeholder="Ingrese C.P.">
              <label class="form-label">Correo</label>
              <input id="mail" type="text" class="form-control" placeholder="Ingrese Correo">
              <label class="form-label">Telefono</label>
              <input id="phone" type="text" class="form-control" placeholder="Ingrese Phone">
          </div>
          <div class="col-md-6">
            <label class="form-label">Razón Social</label>
            <input id="reason" type="text" class="form-control" placeholder="Ingrese Razon Social">
            <label class="form-label">RFC</label>
            <select id="rfc" class="form-control">
              <option value="VAAA671004LY0">VAAA671004LY0</option>
            </select>
            <label class="form-label">No Ext</label>
            <input id="next" type="text" class="form-control" placeholder="Ingrese No Ext">
            <label class="form-label">Colonia</label>
            <input id="colony" type="text" class="form-control" placeholder="Ingrese Colonia">
            <label class="form-label">Estado</label>
            <input id="state" type="text" class="form-control" placeholder="Ingrese Estado">
            
          </div>

          <div class="col-md-12">
            <button onClick="onClickNew()" type="button" class="btn btn-success btn-square">Crear</button>
            <button onclick="onClickBranch()" class="btn btn-dark m-t-5" data-toggle="modal" data-target="#modal-bootstrap-timepicker">Escoger Sucursal</button>
            <button onclick="onClickModify()" type="button" class="btn btn-primary btn-square">Modificar</button>
            <button onclick="onClickDelete()" type="button" class="btn btn-danger btn-square">Eliminar</button>
          </div>
          <div id="response">

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="assets/js/views/branch.js"></script>
<div class="modal fade" id="modal-bootstrap-timepicker" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
        <h4 class="modal-title"><strong>Seleccion de </strong> Sucursales</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="branch">Sucursales</label>
              <select id="all_branch" class="form-control">
                <option value="NA">Cargando Sucursales</option>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer bg-gray-light">
        <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal">Cancelar</button>
        <button onclick="onClickSelect()" type="button" class="btn btn-primary btn-embossed" data-dismiss="modal">Seleccionar</button>
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
