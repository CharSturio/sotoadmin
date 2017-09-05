<?php
  require '../connection/index.php';
  session_start();
  
  $operation = $_REQUEST['operation'];
  if ($operation === 'new') {
    if($_SESSION['RegCliCre'] == 'true'){
      $name = $_REQUEST['name'];
      $address = $_REQUEST['address'];
      $colony = $_REQUEST['colony'];
      $state = $_REQUEST['state'];
      $phone = $_REQUEST['phone'];
      $contact_name = $_REQUEST['contact_name'];
      $rfc = $_REQUEST['rfc'];
      $pc = $_REQUEST['pc'];
      $city = $_REQUEST['city'];
      $noInt = $_REQUEST['noInt'];
      $noExt = $_REQUEST['noExt'];
      $email = $_REQUEST['email'];
      $credit = $_REQUEST['credit'];
      $type_cost = $_REQUEST['typeCost'];
      $cell_phone = $_REQUEST['cell_phone'];
      if ($credit > 0) {
        $thiscredit = 1;
      } else {
        $thiscredit = 0;
        $credit = 0;
      }

      $query = "SELECT * FROM clients where name='" . $name ."';";
      $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
      if (mysqli_fetch_assoc($result)) {
        echo 'El cliente ya existe. Favor de verificarlo o ingresar uno diferente.';
      } else {
        $query = "INSERT INTO clients (name, address, colony, state, phone, contact_name, rfc, pc, city, cell_phone, last_date, noInt, noExt, email, limit_credit, credit, type_cost) VALUES ('" . $name . "','" . $address . "','" . $colony . "','" . $state . "','" . $phone . "','" . $contact_name . "','" . $rfc . "','" . $pc . "','" . $city . "','" . $cell_phone . "',date_sub(NOW(), INTERVAL 300 HOUR_MINUTE),'" . $noInt . "','" . $noExt . "','" . $email . "','" . $credit . "','" . $thiscredit . "','" . $type_cost . "');";
        $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
        echo 'Usuario agregado.';
      }
    } else {
      echo 'noPermit';
    }
  } else if ($operation === 'modify') {
    if($_SESSION['RegCliMod'] == 'true'){
      $query = "UPDATE clients SET";
      if ($_REQUEST['name']) {
        $query .= " name='" . $_REQUEST['name'] . "',";
      }
      if ($_REQUEST['address']) {
        $query .= " address='" . $_REQUEST['address'] . "',";
      }
      if ($_REQUEST['colony']) {
        $query .= " colony='" . $_REQUEST['colony'] . "',";
      }
      if ($_REQUEST['state']) {
        $query .= " state='" . $_REQUEST['state'] . "',";
      }
      if ($_REQUEST['phone']) {
        $query .= " phone='" . $_REQUEST['phone'] . "',";
      }
      if ($_REQUEST['contact_name']) {
        $query .= " contact_name='" . $_REQUEST['contact_name'] . "',";
      }
      if ($_REQUEST['rfc']) {
        $query .= " rfc='" . $_REQUEST['rfc'] . "',";
      }
      if ($_REQUEST['pc']) {
        $query .= " pc='" . $_REQUEST['pc'] . "',";
      }
      if ($_REQUEST['city']) {
        $query .= " city='" . $_REQUEST['city'] . "',";
      }
      if ($_REQUEST['cell_phone']) {
        $query .= " cell_phone='" . $_REQUEST['cell_phone'] . "',";
      }
      if ($_REQUEST['noInt']) {
        $query .= " noInt='" . $_REQUEST['noInt'] . "',";
      }
      if ($_REQUEST['noExt']) {
        $query .= " noExt='" . $_REQUEST['noExt'] . "',";
      }
      if ($_REQUEST['email']) {
        $query .= " email='" . $_REQUEST['email'] . "',";
      }
      if ($_REQUEST['typeCost']) {
        $query .= " type_cost='" . $_REQUEST['typeCost'] . "',";
      }
      if ($_REQUEST['credit']) {
        if ($_REQUEST['credit'] > 0) {
          $query .= " limit_credit=" . $_REQUEST['credit'] . ", credit = 1,";
        } else {
          $query .= " limit_credit=" . $_REQUEST['credit'] . ", credit = 0,";
        }
      }
      $query .= " last_date=date_sub(NOW(), INTERVAL 300 HOUR_MINUTE) WHERE id=" . $_REQUEST['id'] . ";";
      $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
      echo 'Actualizado correctamente.';
    } else {
      echo 'noPermit';
    }
  } else if ($operation === 'delete') {
    if($_SESSION['RegCliEli'] == 'true'){
      $query .= "DELETE FROM clients WHERE id=" . $_REQUEST['id'] . ";";
      $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
      echo 'Eliminado correctamente.';
    } else {
      echo 'noPermit';
    }
  } else if ($operation === 'clients') {
    if($_SESSION['RegCliVer'] == 'true'){
      $query = "SELECT id, name FROM clients;";
      $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
      while ($row = mysqli_fetch_assoc($result)) {
        echo '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
      }
    } else {
      echo 'noPermit';
    }
  } else if ($operation === 'selectClient') {
    $id = $_REQUEST['id'];
    $query = "SELECT * FROM clients where id=" . $id . ";";
    $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
    $row = mysqli_fetch_assoc($result);
    echo $row['name'] . ',' . $row['address'] . ',' . $row['colony'] . ',' . $row['state'] . ',' . $row['phone'] . ',' . $row['contact_name'] . ',' . $row['rfc'] . ',' . $row['pc'] . ',' . $row['city'] . ',' . $row['cell_phone'] . ',' . $row['noInt'] . ',' . $row['noExt'] . ',' . $row['email'] . ',' . $row['limit_credit'] . ',' . $row['type_cost'];
  } else if ($operation === 'browserName') {
    $query = "SELECT * FROM clients WHERE name LIKE '%" . $_REQUEST['content'] . "%';";
    $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
    $print = '<table class="table table-striped tablet-tools">
      <thead>
        <tr>
          <th>Nombre Comercial</th>
          <th>RFC</th>
          <th>Telefono</th>
          <th></th>
        </tr>
      </thead>
      <tbody>';
    while ($row = mysqli_fetch_assoc($result)) {
      $print .= '<tr>
            <td>' . $row['name'] . '</td>
            <td>' . $row['rfc'] . '</td>
            <td>' . $row['phone'] . '</td>
            <td><button onClick="onClickSelect(' . $row['id'] . ')" type="button" class="btn btn-primary btn-square">Modificar</button></td>
          </tr>';
    }
    $print .= '</tbody></table>';
    echo $print;
  } else if ($operation === 'browserRFC') {
    $query = "SELECT * FROM clients WHERE rfc LIKE '%" . $_REQUEST['content'] . "%';";
    $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
    $print = '<table class="table table-striped tablet-tools">
      <thead>
        <tr>
          <th>Nombre Comercial</th>
          <th>RFC</th>
          <th>Telefono</th>
          <th></th>
        </tr>
      </thead>
      <tbody>';
    while ($row = mysqli_fetch_assoc($result)) {
      $print .= '<tr>
            <td>' . $row['name'] . '</td>
            <td>' . $row['rfc'] . '</td>
            <td>' . $row['phone'] . '</td>
            <td><button onClick="onClickSelect(' . $row['id'] . ')" type="button" class="btn btn-primary btn-square">Modificar</button></td>
          </tr>';
    }
    $print .= '</tbody></table>';
    echo $print;
  }
  mysqli_close($link);
 ?>
