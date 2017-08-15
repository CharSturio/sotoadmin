<?php
  require '../connection/index.php';

  $operation = $_REQUEST['operation'];
  if ($operation === 'new') {
    $name = $_REQUEST['name'];
    $rfc = $_REQUEST['rfc'];
    $address = $_REQUEST['address'];
    $nint = $_REQUEST['nint'];
    $next = $_REQUEST['next'];
    $state = $_REQUEST['state'];
    $city = $_REQUEST['city'];
    $cp = $_REQUEST['cp'];
    $reason = $_REQUEST['reason'];

    $query = "SELECT * FROM branches where name='" . $name ."';";
    $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
    if (mysqli_fetch_assoc($result)) {
      echo 'La sucursal ya existe. Favor de intentar con otro.';
    } else {
      $query = "INSERT INTO branches (name, rfc, address, nint, next, state, city, cp, reason, last_date) VALUES('" . $name ."','" . $rfc . "','" . $address . "','" . $nint . "','" . $next . "','" . $state . "','" . $city . "','" . $cp . "','" . $reason . "',date_sub(NOW(), INTERVAL 300 HOUR_MINUTE));";
      $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
      echo 'Sucursal agregada.';
    }

  } else if ($operation === 'modify') {
    $query = "UPDATE branches SET";
    if ($_REQUEST['name']) {
      $query .= " name='" . $_REQUEST['name'] . "',";
    }
    if ($_REQUEST['rfc']) {
      $query .= " rfc='" . $_REQUEST['rfc'] . "',";
    }
    if ($_REQUEST['address']) {
      $query .= " address='" . $_REQUEST['address'] . "',";
    }
    if ($_REQUEST['nint']) {
      $query .= " nint='" . $_REQUEST['nint'] . "',";
    }
    if ($_REQUEST['next']) {
      $query .= " next='" . $_REQUEST['next'] . "',";
    }
    if ($_REQUEST['state']) {
      $query .= " state='" . $_REQUEST['state'] . "',";
    }
    if ($_REQUEST['city']) {
      $query .= " city='" . $_REQUEST['city'] . "',";
    }
    if ($_REQUEST['cp']) {
      $query .= " cp='" . $_REQUEST['cp'] . "',";
    }
    if ($_REQUEST['reason']) {
      $query .= " reason=" . $_REQUEST['reason'] . ",";
    }
    $query .= " last_date=date_sub(NOW(), INTERVAL 300 HOUR_MINUTE) WHERE id=" . $_REQUEST['id'] . ";";
    $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
    echo 'Actualizado correctamente.';

  } else if ($operation === 'delete') {
    $query .= "DELETE FROM branches WHERE id=" . $_REQUEST['id'] . ";";
    $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
    echo 'Eliminado correctamente.';
  } else if ($operation === 'branch') {
    $query = "SELECT id, name FROM branches;";
    $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
    while ($row = mysqli_fetch_assoc($result)) {
      echo '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
    }
  } else if ($operation === 'selectBranch') {
    $id = $_REQUEST['id'];
    $query = "SELECT * FROM branches where id=" . $id . ";";
    $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
    $row = mysqli_fetch_assoc($result);
    echo $row['name'] . ',' . $row['rfc'] . ',' . $row['address'] . ',' . $row['nint'] . ',' . $row['next'] . ',' . $row['state'] . ',' . $row['city'] . ',' . $row['cp'] . ',' . $row['reason'];
  }
   mysqli_close($link);
 ?>
