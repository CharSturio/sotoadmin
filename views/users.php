<?php 
require '../connection/index.php';
session_start();
if($_SESSION['RegUsuGen'] == 'true'){
  echo '
<div class="header">
  <h2><strong>Usuarios</strong></h2>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="panel">
      <div class="panel-header">
        <h3><i class="icon-bulb"></i> Crear | Modificar | Suspender <strong>Usuarios</strong></h3>
      </div>
      <div class="panel-content p-t-0">
        <p> Favor de agregar todos los campos con *. Para modificar información, selecciona usuario en "escoge usuario", solo edita y da clic en el botón Editar o Eliminar.</p>
        <div class="row">
          <div class="col-md-6">
              <label class="form-label">Usuario</label>
              <input id="user" type="text" class="form-control" placeholder="Ingrese Usuario">
          </div>
          <div class="col-md-6">
              <label class="form-label">Contraseña</label>
              <input id="pass" type="password" class="form-control" placeholder="********">
              <label class="form-label">Repetir Contraseña</label>
              <input id="repass" type="password" class="form-control" placeholder="********">
          </div>
          <div class="col-md-6">
              <label class="form-label">Nombre</label>
              <input id="name" type="text" class="form-control" placeholder="Ingrese Nombre">
              <label class="form-label">Dirección</label>
              <input id="address" type="text" class="form-control" placeholder="Ingrese Dirección">
              <label class="form-label">Ciudad</label>
              <input id="city" type="text" class="form-control" placeholder="Ingrese Ciudad">
          </div>
          <div class="col-md-6">
              <label class="form-label">Apellidos</label>
              <input id="last_name" type="text" class="form-control" placeholder="Ingrese Apellidos">
              <label class="form-label">C.P.</label>
              <input id="pc" type="text" class="form-control" placeholder="Ingrese CP">
              <label class="form-label">Estado</label>
              <input id="state" type="text" class="form-control" placeholder="Ingrese Estado">
          </div>
          <div class="col-md-6">
              <label for="permisos">Permisos</label>
              <select id="permision" class="form-control">';
              $query = "SELECT name FROM permissions";
              $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
              while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
              }
                
              echo '</select>
          </div>
          <div class="col-md-6">
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
          <div class="col-md-6">
            <div class="col-md-6">
                <label for="permisos">Horario Entrada</label>
                <select id="check_in" class="form-control" id="favoriteNumber">
                  <option value="0600">06:00</option>
                  <option value="0630">06:30</option>
                  <option value="0700">07:00</option>
                  <option value="0730">07:30</option>
                  <option value="0800">08:00</option>
                  <option value="0830">08:30</option>
                  <option value="0900">09:00</option>
                  <option value="0930">09:30</option>
                  <option value="1000">10:00</option>
                  <option value="1030">10:30</option>
                  <option value="1100">11:00</option>
                  <option value="1130">11:30</option>
                  <option value="1200">12:00</option>
                  <option value="1230">12:30</option>
                  <option value="1300">13:00</option>
                  <option value="1330">13:30</option>
                  <option value="1400">14:00</option>
                  <option value="1430">14:30</option>
                  <option value="1500">15:00</option>
                  <option value="1530">15:30</option>
                  <option value="1600">16:00</option>
                  <option value="1630">16:30</option>
                  <option value="1700">17:00</option>
                  <option value="1730">17:30</option>
                  <option value="1800">18:00</option>
                  <option value="1830">18:30</option>
                  <option value="1900">19:00</option>
                  <option value="1930">19:30</option>
                  <option value="2000">20:00</option>
                  <option value="2030">20:30</option>
                  <option value="2100">21:00</option>
                  <option value="2130">21:30</option>
                  <option value="2200">22:00</option>
                  <option value="2230">22:30</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="permisos">Horario Salida</label>
                <select id="check_out" class="form-control" id="favoriteNumber">
                  <option value="0600">06:00</option>
                  <option value="0630">06:30</option>
                  <option value="0700">07:00</option>
                  <option value="0730">07:30</option>
                  <option value="0800">08:00</option>
                  <option value="0830">08:30</option>
                  <option value="0900">09:00</option>
                  <option value="0930">09:30</option>
                  <option value="1000">10:00</option>
                  <option value="1030">10:30</option>
                  <option value="1100">11:00</option>
                  <option value="1130">11:30</option>
                  <option value="1200">12:00</option>
                  <option value="1230">12:30</option>
                  <option value="1300">13:00</option>
                  <option value="1330">13:30</option>
                  <option value="1400">14:00</option>
                  <option value="1430">14:30</option>
                  <option value="1500">15:00</option>
                  <option value="1530">15:30</option>
                  <option value="1600">16:00</option>
                  <option value="1630">16:30</option>
                  <option value="1700">17:00</option>
                  <option value="1730">17:30</option>
                  <option value="1800">18:00</option>
                  <option value="1830">18:30</option>
                  <option value="1900">19:00</option>
                  <option value="1930">19:30</option>
                  <option value="2000">20:00</option>
                  <option value="2030">20:30</option>
                  <option value="2100">21:00</option>
                  <option value="2130">21:30</option>
                  <option value="2200">22:00</option>
                  <option value="2230">22:30</option>
                </select>
            </div>
          </div>
          <div class="col-md-12">
            <button onClick="onClickNew()" type="button" class="btn btn-success btn-square">Crear</button>
            <button onclick="onClickUsers()" class="btn btn-dark m-t-5" data-toggle="modal" data-target="#modal-bootstrap-timepicker">Escoger Usuario</button>
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
<script src="assets/js/views/users.js"></script>
<div class="modal fade" id="modal-bootstrap-timepicker" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
        <h4 class="modal-title"><strong>Seleccion de </strong> Usuario</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="users">Usuarios</label>
              <select id="all_users" class="form-control">
                <option value="NA">Cargando Usuarios</option>
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
