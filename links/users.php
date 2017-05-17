<?php
  require '../connection/index.php';

  $operation = $_REQUEST['operation'];
  if ($operation === 'new') {
    $user = $_REQUEST['user'];
    $password = $_REQUEST['pass'];
    $name = $_REQUEST['name'];
    $address = $_REQUEST['address'];
    $city = $_REQUEST['city'];
    $last_name = $_REQUEST['lastName'];
    $pc = $_REQUEST['pc'];
    $state = $_REQUEST['state'];
    $permit = $_REQUEST['permision'];
    $check_in = $_REQUEST['checkIn'];
    $check_out = $_REQUEST['checkOut'];

    $query = "SELECT * FROM users where user='" . $user ."';";
    $result = mysql_query($query) or die ('Consulta fallida: ' . mysql_error());
    if (mysql_fetch_assoc($result)) {
      echo 'El usuario ya existe. Favor de intentar con otro.';
    } else {
      $query = "INSERT INTO users (status, user, password, name, address, city, last_name, pc, state, permit, check_in, check_out, last_date) VALUES(1,'" . $user . "',SHA('" . $password . "'),'" . $name . "','" . $address . "','" . $city . "','" . $last_name . "','" . $pc . "','" . $state . "','" . $permit . "','" . $check_in . "','" . $check_out . "',now());";
      $result = mysql_query($query) or die ('Consulta fallida: ' . mysql_error());
      echo 'Usuario agregado.';
    }

  } else if ($operation === 'modify') {
    $query = "UPDATE users SET";
    if ($_REQUEST['user']) {
      $query .= " user='" . $_REQUEST['user'] . "',";
    }
    if ($_REQUEST['pass']) {
      $query .= " password=SHA('" . $_REQUEST['pass'] . "'),";
    }
    if ($_REQUEST['name']) {
      $query .= " name='" . $_REQUEST['name'] . "',";
    }
    if ($_REQUEST['address']) {
      $query .= " address='" . $_REQUEST['address'] . "',";
    }
    if ($_REQUEST['city']) {
      $query .= " city='" . $_REQUEST['city'] . "',";
    }
    if ($_REQUEST['lastName']) {
      $query .= " last_name='" . $_REQUEST['lastName'] . "',";
    }
    if ($_REQUEST['pc']) {
      $query .= " pc='" . $_REQUEST['pc'] . "',";
    }
    if ($_REQUEST['state']) {
      $query .= " state='" . $_REQUEST['state'] . "',";
    }
    if ($_REQUEST['permision']) {
      $query .= " permit='" . $_REQUEST['permit'] . "',";
    }
    if ($_REQUEST['checkIn']) {
      $query .= " check_in='" . $_REQUEST['checkIn'] . "',";
    }
    if ($_REQUEST['checkOut']) {
      $query .= " check_out='" . $_REQUEST['checkOut'] . "',";
    }
    $query .= " last_date=now() WHERE id=" . $_REQUEST['id'] . ";";
    $result = mysql_query($query) or die ('Consulta fallida: ' . mysql_error());
    echo 'Actualizado correctamente.';

  } else if ($operation === 'delete') {
    $query .= "DELETE FROM users WHERE id=" . $_REQUEST['id'] . ";";
    $result = mysql_query($query) or die ('Consulta fallida: ' . mysql_error());
    echo 'Eliminado correctamente.';
  } else if ($operation === 'users') {
    $query = "SELECT id, user FROM users;";
    $result = mysql_query($query) or die ('Consulta fallida: ' . mysql_error());
    while ($row = mysql_fetch_assoc($result)) {
      echo '<option value="' . $row["id"] . '">' . $row["user"] . '</option>';
    }
  } else if ($operation === 'selectUser') {
    $id = $_REQUEST['id'];
    $query = "SELECT * FROM users where id=" . $id . ";";
    $result = mysql_query($query) or die ('Consulta fallida: ' . mysql_error());
    $row = mysql_fetch_assoc($result);
    echo $row['user'] . ',' . $row['name'] . ',' . $row['address'] . ',' . $row['city'] . ',' . $row['last_name'] . ',' . $row['pc'] . ',' . $row['state'] . ',' . $row['permit'] . ',' . $row['check_in'] . ',' . $row['check_out'];
  }
  mysql_close($link);
 ?>
