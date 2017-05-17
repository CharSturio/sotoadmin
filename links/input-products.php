<?php
  require '../connection/index.php';

  $operation = $_REQUEST['operation'];
  if ($operation === 'add') {
    $provider = $_REQUEST['provider'];
    $amount = $_REQUEST['amount'];
    $unit_cost = $_REQUEST['unit_cost'];
    $id = $_REQUEST['id'];

    $query = "INSERT INTO merchandise_entry (id_product, provider, amount, unit_cost, last_date) VALUES ('" . $id . "','" . $provider . "','" . $amount . "','" . $unit_cost . "',now());";
    $result = mysql_query($query) or die ('Consulta fallida: ' . mysql_error());

    $query = "SELECT * FROM stocks where id_product ='" . $id ."';";
    $result = mysql_query($query) or die ('Consulta fallida: ' . mysql_error());

    $total = $amount;
    while($row = mysql_fetch_assoc($result)){
      $total += $row['amount'];
    }

    $query = "UPDATE stocks SET amount=" . $total . " WHERE id_product=" . $id;
    $result = mysql_query($query) or die ('Consulta fallida: ' . mysql_error());


    echo 'Agregados Satisfactoriamente.';
  } else if ($operation === 'browserBarcode') {
    $query = "SELECT * FROM products WHERE barcode LIKE '%" . $_REQUEST['content'] . "%';";
    $result = mysql_query($query) or die ('Consulta fallida: ' . mysql_error());
    $print = '<table class="table table-striped tablet-tools">
      <thead>
        <tr>
          <th>Código de Barras</th>
          <th>Clave</th>
          <th>Nombre</th>
          <th></th>
        </tr>
      </thead>
      <tbody>';
    while ($row = mysql_fetch_assoc($result)) {
      $barcode = "'" . $row['barcode'] . "'";
      $key_ = "'" . $row['key_'] . "'";
      $name = "'" . $row['name'] . "'";
      $print .= '<tr>
            <td>' . $row['barcode'] . '</td>
            <td>' . $row['key_'] . '</td>
            <td>' . $row['name'] . '</td>
            <td><button onClick="onClickSelect(' . $row['id'] . ',' . $key_ . ',' . $barcode . ',' . $name . ')" type="button" class="btn btn-primary btn-square">Seleccionar</button></td>
          </tr>';
    }
    $print .= '</tbody></table>';
    echo $print;
  } else if ($operation === 'browserName') {
    $query = "SELECT * FROM products WHERE name LIKE '%" . $_REQUEST['content'] . "%';";
    $result = mysql_query($query) or die ('Consulta fallida: ' . mysql_error());
    $print = '<table class="table table-striped tablet-tools">
      <thead>
        <tr>
          <th>Código de Barras</th>
          <th>Clave</th>
          <th>Nombre</th>
          <th></th>
        </tr>
      </thead>
      <tbody>';
      while ($row = mysql_fetch_assoc($result)) {
        $barcode = "'" . $row['barcode'] . "'";
        $key_ = "'" . $row['key_'] . "'";
        $name = "'" . $row['name'] . "'";
        $print .= '<tr>
              <td>' . $row['barcode'] . '</td>
              <td>' . $row['key_'] . '</td>
              <td>' . $row['name'] . '</td>
              <td><button onClick="onClickSelect(' . $row['id'] . ',' . $key_ . ',' . $barcode . ',' . $name . ')" type="button" class="btn btn-primary btn-square">Seleccionar</button></td>
            </tr>';
      }
    $print .= '</tbody></table>';
    echo $print;
  } else if ($operation === 'selectProduct') {
    $id = $_REQUEST['id'];
    $query = "SELECT * FROM products where id=" . $id . ";";
    $result = mysql_query($query) or die ('Consulta fallida: ' . mysql_error());
    $row = mysql_fetch_assoc($result);
    echo $row['barcode'] . ',' . $row['name'] . ',' . $row['description'] . ',' . $row['key_'] . ',' . $row['brand'] . ',' . $row['model'] . ',' . $row['measure'] . ',' . $row['treadware'] . ',' . $row['load_index'] . ',' . $row['load_speed'] . ',' . $row['retail_price'] . ',' . $row['wholesale_price'] . ',' . $row['special_price'];
  }
  mysql_close($link);
 ?>
