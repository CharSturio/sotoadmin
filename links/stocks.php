<?php
  session_start();
  require '../connection/index.php';
  $totalAll;
  $operation = $_REQUEST['operation'];
  if ($operation === 'browserProduct') {
    $exist = 0;
    $query = "SELECT * FROM products AS p INNER JOIN stocks AS s ON p.id = s.id_product WHERE ";
    if ($_REQUEST['product_name'] !== "") {
      $query .= "p.name LIKE '%" . $_REQUEST['product_name'] . "%'";
      $exist = 1;
    }

    if ($_REQUEST['barcode'] !== "") {
      if ($exist === 1) {
        $query .= " AND ";
      }
      $query .= "p.barcode LIKE '%" . $_REQUEST['barcode'] . "%'";
      $exist = 1;
    }

    if ($_REQUEST['key'] !== "") {
      if ($exist === 1) {
        $query .= " AND ";
      }
      $query .= "p.key_ LIKE '%" . $_REQUEST['key'] . "%'";
    }
    $query .= " AND s.amount > 1;";
    $result = mysql_query($query) or die ('Consulta fallida: ' . mysql_error());

    while ($row = mysql_fetch_assoc($result)) {
      echo '
          <tr>
            <td>' . $row['amount'] . '</td>
            <td>' . $row['type_product'] . '</td>
            <td>' . $row['barcode'] . '</td>
            <td>' . $row['key_'] . '</td>
            <td>' . $row['brand'] . '</td>
            <td>' . $row['model'] . '</td>
            <td>' . $row['name'] . '</td>
            <td>' . $row['retail_price'] . '</td>
            <td>' . $row['wholesale_price'] . '</td>
          </tr>';
    }
  }
  mysql_close($link);
 ?>
