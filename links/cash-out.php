<?php
  session_start();
  require '../connection/index.php';

  $operation = $_REQUEST['operation'];
  if ($operation === 'add') {
    $comprobante = $_REQUEST['comprobante'];
    $cantidad = $_REQUEST['cantidad'];
    $descripcion = $_REQUEST['descripcion'];


    $query = "INSERT INTO cash_out (comprobante, cantidad, descripcion, id_user, status, last_date) VALUES ('" . $comprobante . "'," . $cantidad . ",'" . $descripcion . "'," . $_SESSION['id'] . ",'out',now());";
    $result = mysql_query($query) or die ('Consulta fallida: ' . mysql_error());

    echo 'Agregados Satisfactoriamente.';
  } else if ($operation === 'add2') {
      $comprobante = $_REQUEST['comprobante2'];
      $cantidad = $_REQUEST['cantidad2'];
      $descripcion = $_REQUEST['descripcion2'];


      $query = "INSERT INTO cash_out (comprobante, cantidad, descripcion, id_user, status, last_date) VALUES ('" . $comprobante . "'," . $cantidad . ",'" . $descripcion . "'," . $_SESSION['id'] . ",'in',now());";
      $result = mysql_query($query) or die ('Consulta fallida: ' . mysql_error());

      echo 'Agregados Satisfactoriamente.';
    }
  mysql_close($link);
 ?>
