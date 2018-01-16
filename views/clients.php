<?php 
session_start();
require '../connection/index.php';

if($_SESSION['RegCliGen'] == 'true'){
  echo '
  <div class="header">
  <h2><strong>Clientes</strong></h2>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="panel">
      <div class="panel-header">
        <h3><i class="icon-bulb"></i> Crear | Modificar | Suspender <strong>Clientes</strong></h3>
      </div>
      <div class="panel-content p-t-0">
        <p> Favor de agregar todos los campos con *. Para modificar información, solo edita y da clic en el botón Editar.</p>
        <div class="row">
          <div class="col-md-6">
            <label class="form-label">* Nombre Comercial / Razon Social</label>
            <input id="name" type="text" class="form-control" placeholder="Ingrese Nombre Comercial">
            <label class="form-label">Dirección</label>
            <input id="address" type="text" class="form-control" placeholder="Ingrese Dirección">
            <label class="form-label">Colonia</label>
            <input id="colony" type"text" class="form-control" placeholder="Ingrese Colonia">
            <label class="form-label">Estado</label>
            <input id="state" type="text" class="form-control" placeholder="Ingrese Estado">
            <label clas="form-label">* Teléfono</label>
            <input id="phone" type="text" class="form-control" placeholder="Ingrese Teléfono">
            <label clas="form-label">No Exterior</label>
            <input id="noExt" type="text" class="form-control" placeholder="Ingrese numero exterior">
            <label clas="form-label">No Interior</label>
            <input id="noInt" type="text" class="form-control" placeholder="Ingrese numeri interior">
            <label for="permisos">Tipo venta</label>
            <select id="typeCost" class="form-control">
              <option value="public">Publico</option>
              <option value="wholesale">Mayoreo</option>
              <option value="special">Especial</option>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label">* Nombre de Contacto</label>
            <input id="contactName" type="text" class="form-control" placeholder="Ingrese Nombre de Contacto">
            <label class="form-label">RFC</label>
            <input id="rfc" type="text" class="form-control" placeholder="Ingrese RFC">
            <label class="form-label">C.P.</label>
            <input id="pc" type="text" class="form-control" placeholder="Ingrese C.P.">
            <label class="form-label">Ciudad</label>
            <input id="city" type="text" class="form-control" placeholder="Ingrese Ciudad">
            <label class="form-label">Celular</label>
            <input id="cellPhone" type="text" class="form-control" placeholder="Ingrese Celular">
            <label clas="form-label">Email</label>
            <input id="email" type="text" class="form-control" placeholder="Ingrese email">
            <label clas="form-label">Limite Credito</label>
            <input id="credit" type="text" class="form-control" placeholder="Ingrese Limite de credito Si lo tiene">
          </div>
          <div class="col-md-12">
            <button onClick="onClickNew()" type="button" class="btn btn-success btn-square">Crear</button>
            <button onclick="onClickClients()" class="btn btn-dark m-t-5" data-toggle="modal" data-target="#modal-bootstrap-timepicker">Escoger Cliente</button>
            <button onClick="onClickModify()" type="button" class="btn btn-primary btn-square">Modificar</button>
            <button onClick="onClickDelete()" type="button" class="btn btn-danger btn-square">Eliminar</button>
          </div>
          <div id="response">
          
          </div>
          <div id="divProducts" class="col-md-12">
          </div>';
          echo '
          <h3 class="col-md-12"> Listado de clientes</h3>
          
          <table class="table table-striped">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>RFC</th>
              <th>Ciudad</th>
              <th></th>
            </tr>
          </thead>
          <tbody id="table">';
          $query = "SELECT * FROM clients ORDER BY name DESC LIMIT 0,10000";
          $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
          while ($row = mysqli_fetch_assoc($result)) {
            
              echo '<tr>
                      <td>' . $row['name'] . '</td>
                      <td>' . $row['rfc'] . '</td>
                      <td>' . $row['city'] . '</td>
                      <td><button onClick="onClickDeleteUser(' . $row['id'] . ')" type="button" class="btn btn-danger btn-square">Eliminar</button></td>
                    </tr>';
            }
          
          echo '</tbody>
        </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modal-bootstrap-timepicker" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
        <h4 class="modal-title"><strong>Seleccion de </strong> Cliente</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <h3>Escribe tu busqueda, y da clic en Buscar.</h3>
          <div class="col-md-6">
            <label class="form-label">Nombre Comercial / Razon Social</label>
            <input id="nameClient" type="text" class="form-control" placeholder="Ingrese el Nombre del cliente...">
            <button onclick="onClickBrowserName()" type="button" class="btn btn-primary btn-embossed" data-dismiss="modal">Seleccionar</button>
          </div>
          <div class="col-md-6">
            <label class="form-label">RFC</label>
            <input id="rfcClient" type="text" class="form-control" placeholder="Ingrese el RFC del cliente...">
            <button onclick="onClickBrowserRFC()" type="button" class="btn btn-primary btn-embossed" data-dismiss="modal">Seleccionar</button>
          </div>
        </div>
      </div>
      <!-- <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="clients">Clientes</label>
              <select id="all_clients" class="form-control" data-search="true">
                <option value="NA">Cargando clientes</option>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer bg-gray-light">
        <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal">Cancelar</button>
        <button onclick="onClickSelect()" type="button" class="btn btn-primary btn-embossed" data-dismiss="modal">Seleccionar</button>
      </div> -->
    </div>
  </div>
</div>
<script src="assets/js/views/clients.js"></script>';
} else {
  echo '
    <script type="text/javascript">
    alert("No cuenta con los permisos necesarios.");
    </script>
  ';
}
