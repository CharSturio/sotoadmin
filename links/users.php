<?php
  require '../connection/index.php';
  session_start();
  
  $operation = $_REQUEST['operation'];
  if ($operation === 'new') {
    if($_SESSION['RegUsuCre'] == 'true'){
      $user = $_REQUEST['user'];
      $password = $_REQUEST['pass'];
      $name = $_REQUEST['name'];
      $address = $_REQUEST['address'];
      $city = $_REQUEST['city'];
      $last_name = $_REQUEST['lastName'];
      $pc = $_REQUEST['pc'];
      $state = $_REQUEST['state'];
      $permit = $_REQUEST['permision'];
      $branch = $_REQUEST['branches'];
      $check_in = $_REQUEST['checkIn'];
      $check_out = $_REQUEST['checkOut'];

      $query = "SELECT * FROM users where user='" . $user ."';";
      $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
      if (mysqli_fetch_assoc($result)) {
        echo 'El usuario ya existe. Favor de intentar con otro.';
      } else {
        $query = "INSERT INTO users (status, user, password, name, address, city, last_name, pc, state, permit, branch, check_in, check_out, last_date) VALUES(1,'" . $user . "',SHA('" . $password . "'),'" . $name . "','" . $address . "','" . $city . "','" . $last_name . "','" . $pc . "','" . $state . "','" . $permit . "','" . $branch . "','" . $check_in . "','" . $check_out . "',date_sub(NOW(), INTERVAL 300 HOUR_MINUTE));";
        $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
        echo 'Usuario agregado.';
      }
    } else {
      echo 'noPermit';
    }

  } else if ($operation === 'modify') {
    if($_SESSION['RegUsuMod'] == 'true'){
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
        $query .= " permit='" . $_REQUEST['permision'] . "',";
      }
      if ($_REQUEST['branches']) {
        $query .= " branch='" . $_REQUEST['branches'] . "',";
      }
      if ($_REQUEST['checkIn']) {
        $query .= " check_in='" . $_REQUEST['checkIn'] . "',";
      }
      if ($_REQUEST['checkOut']) {
        $query .= " check_out='" . $_REQUEST['checkOut'] . "',";
      }
      $query .= " last_date=date_sub(NOW(), INTERVAL 300 HOUR_MINUTE) WHERE id=" . $_REQUEST['id'] . ";";
      $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
      echo 'Actualizado correctamente.';
    } else {
      echo 'noPermit';
    }
  } else if ($operation === 'delete') {
    if($_SESSION['RegUsuEli'] == 'true'){
      $query .= "DELETE FROM users WHERE id=" . $_REQUEST['id'] . ";";
      $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
      echo 'Eliminado correctamente.';
    } else {
      echo 'noPermit';
    }
  } else if ($operation === 'users') {
    if($_SESSION['RegUsuVer'] == 'true'){      
      $query = "SELECT id, user FROM users;";
      $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
      while ($row = mysqli_fetch_assoc($result)) {
        echo '<option value="' . $row["id"] . '">' . $row["user"] . '</option>';
      }
    } else {
      echo 'noPermit';
    }
  } else if ($operation === 'selectUser') {
    $id = $_REQUEST['id'];
    $query = "SELECT * FROM users where id=" . $id . ";";
    $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
    $row = mysqli_fetch_assoc($result);
    echo $row['user'] . ',' . $row['name'] . ',' . $row['address'] . ',' . $row['city'] . ',' . $row['last_name'] . ',' . $row['pc'] . ',' . $row['state'] . ',' . $row['permit'] . ',' . $row['branch'] . ',' . $row['check_in'] . ',' . $row['check_out'];
  }
  mysqli_close($link);
 ?>
