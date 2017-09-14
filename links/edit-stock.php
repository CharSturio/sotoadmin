<?php
session_start();

  require '../connection/index.php';

  $operation = $_REQUEST['operation'];
  if ($operation === 'browser') {
    if($_SESSION['MovInvBus'] == 'true'){
      $name = $_REQUEST['name'];
      $key = $_REQUEST['key'];
      $barcode = $_REQUEST['barcode'];
      $ident = 0;

      $query = "SELECT P.id, P.barcode, P.name, P.key_, P.brand, P.model, S.amount FROM products AS P INNER JOIN stocks AS S ON P.id = S.id_product where";
      if ($name) {
        $query .= " P.name LIKE '%" . $name . "%'";
        $ident = 1;
      }
      if ($key) {
        if ($ident === 0) {
          $query .= " P.key_ LIKE '%" . $key . "%'";
          $ident = 1;
        } else {
          $query .= " AND P.key_ LIKE '%" . $key . "%'";
        }
      }
      if ($barcode) {
        if ($ident === 0) {
          $query .= " P.barcode LIKE '%" . $barcode . "%'";
        } else {
          $query .= " AND P.barcode LIKE '%" . $barcode . "%'";
        }
      }
      $query .= ";";
      $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
      while ($row = mysqli_fetch_assoc($result)) {
        $namePrint = "'" . $row['name'] . "'";
        echo '<tr>
                <td>' . $row['amount'] . '</td>
                <td>' . $row['barcode'] . '</td>
                <td>' . $row['key_'] . '</td>
                <td>' . $row['name'] . '</td>
                <td>' . $row['brand'] . '</td>
                <td>' . $row['model'] . '</td>
                <td><button onClick="onClickSelect(' . $row['id'] . ',' . $namePrint . ',' . $row['amount'] . ')" type="button" class="btn btn-primary btn-square">Seleccionar</button></td>
              </tr>';
      }
    } else {
      echo 'noPermit';
    }
  } else if ($operation === 'modify') {
    if($_SESSION['MovInvMod'] == 'true'){
      $id_product = $_REQUEST['id'];
      $alter_stock = $_REQUEST['alterStock'];

      $queryTemp = "UPDATE stocks SET amount=" . $alter_stock . " WHERE id_product=" . $id_product;
      $result = mysqli_query($link,$queryTemp) or die ('Consulta fallida: ' . mysqli_error($link));
      echo 'Cantidad cambiada.';
    } else {
      echo 'noPermit';
    }
  } else if ($operation === 'in') {
    if($_SESSION['MovInvEntDev'] == 'true'){
      $id_product = $_REQUEST['id'];
      $alter_stock = $_REQUEST['alterStock'];

      $queryTemp = "SELECT amount FROM stocks WHERE id_product=" . $id_product;
      $result = mysqli_query($link,$queryTemp) or die ('Consulta fallida: ' . mysqli_error($link));

      $row = mysqli_fetch_assoc($result);
      $total = $alter_stock + $row['amount'];

      $queryTemp = "UPDATE stocks SET amount=" . $total . " WHERE id_product=" . $id_product;
      $result = mysqli_query($link,$queryTemp) or die ('Consulta fallida: ' . mysqli_error($link));
      echo 'Cantidad cambiada.';
    } else {
      echo 'noPermit';
    }
  } else if ($operation === 'out') {
    if($_SESSION['MovInvSalDev'] == 'true'){
      $id_product = $_REQUEST['id'];
      $alter_stock = $_REQUEST['alterStock'];

      $queryTemp = "SELECT amount FROM stocks WHERE id_product=" . $id_product;
      $result = mysqli_query($link,$queryTemp) or die ('Consulta fallida: ' . mysqli_error($link));

      $row = mysqli_fetch_assoc($result);
      $total = $row['amount'] - $alter_stock;

      $queryTemp = "UPDATE stocks SET amount=" . $total . " WHERE id_product=" . $id_product;
      $result = mysqli_query($link,$queryTemp) or die ('Consulta fallida: ' . mysqli_error($link));
      echo 'Cantidad cambiada.';
    } else {
      echo 'noPermit';
    }
  }
  mysqli_close($link);
 ?>
