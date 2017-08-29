<?php
  session_start();
  require '../connection/index.php';

  $operation = $_REQUEST['operation'];
  if ($operation === 'add') {
    if($_SESSION['UtiEySCAgrSal']){
      $comprobante = $_REQUEST['comprobante'];
      $cantidad = $_REQUEST['cantidad'];
      $descripcion = $_REQUEST['descripcion'];
      $query = "INSERT INTO cash_out (comprobante, cantidad, descripcion, id_user, status, last_date) VALUES ('" . $comprobante . "'," . $cantidad . ",'" . $descripcion . "'," . $_SESSION['id'] . ",'out',date_sub(NOW(), INTERVAL 300 HOUR_MINUTE));";
      $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));

      echo 'Agregados Satisfactoriamente.';
    } else {
      echo 'noPermit';
    }
  } else if ($operation === 'add2') {
    if($_SESSION['UtiEySCAgrEnt']){
        $comprobante = $_REQUEST['comprobante2'];
        $cantidad = $_REQUEST['cantidad2'];
        $descripcion = $_REQUEST['descripcion2'];
        $query = "INSERT INTO cash_out (comprobante, cantidad, descripcion, id_user, status, last_date) VALUES ('" . $comprobante . "'," . $cantidad . ",'" . $descripcion . "'," . $_SESSION['id'] . ",'in',date_sub(NOW(), INTERVAL 300 HOUR_MINUTE));";
        $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));

        echo 'Agregados Satisfactoriamente.';
      } else {
        echo 'noPermit';
      }
    }
  mysqli_close($link);
 ?>
