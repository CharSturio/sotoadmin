<?php
  session_start();
  
  require '../connection/index.php';

  $operation = $_REQUEST['operation'];
  if ($operation === 'add') {
    if($_SESSION['MovEntMerAgr'] == 'true'){
      $provider = $_REQUEST['provider'];
      $amount = $_REQUEST['amount'];
      $unit_cost = $_REQUEST['unit_cost'];
      $branch = $_REQUEST['branch'];
      $id = $_REQUEST['id'];

      $query = "INSERT INTO merchandise_entry (id_product, provider, amount, unit_cost, branch, last_date) VALUES ('" . $id . "','" . $provider . "','" . $amount . "','" . $unit_cost . "','" . $branch . "',date_sub(NOW(), INTERVAL 300 HOUR_MINUTE));";
      $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));

      $query = "SELECT * FROM stocks where id_product ='" . $id ."' and id_branch = ".$branch.";";
      $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));

      $total = $amount;
      $rowcount=mysqli_num_rows($result);
      if($rowcount == 0) {
        $query = "INSERT INTO stocks (id_product, amount, id_branch, last_date) VALUES ('" . $id . "', ".$amount.", " . $branch . ", date_sub(NOW(), INTERVAL 300 HOUR_MINUTE));";
        $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
      } else {
        while($row = mysqli_fetch_assoc($result)){
          $total += $row['amount'];
        }
  
        $query = "UPDATE stocks SET amount=" . $total . " WHERE id_product=" . $id ." and id_branch = ".$branch.";";
        $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
      }
      


      echo 'Agregados Satisfactoriamente.';
    } else {
      echo 'noPermit';
    }
  } else if ($operation === 'browserBarcode') {
    if($_SESSION['MovEntMerBus'] == 'true'){
      $query = "SELECT * FROM products WHERE barcode LIKE '%" . $_REQUEST['content'] . "%';";
      $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
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
      while ($row = mysqli_fetch_assoc($result)) {
        $barcode = "'" . $row['barcode'] . "'";
        $key_ = "'" . $row['key_'] . "'";
        $name = "'" . $row['name'] . "'";
        $branch = "'".$_SESSION['branchName']."'";
        $print .= '<tr>
              <td>' . $row['barcode'] . '</td>
              <td>' . $row['key_'] . '</td>
              <td>' . $row['name'] . '</td>
              <td><button onClick="onClickSelect(' . $row['id'] . ',' . $key_ . ',' . $barcode . ',' . $name . ',' . $branch . ')" type="button" class="btn btn-primary btn-square">Seleccionar</button></td>
            </tr>';
      }
      $print .= '</tbody></table>';
      echo $print;
    } else {
      echo 'noPermit';
    }
  } else if ($operation === 'browserName') {
    if($_SESSION['MovEntMerBus'] == 'true'){
      $query = "SELECT * FROM products WHERE name LIKE '%" . $_REQUEST['content'] . "%';";
      $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
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
        while ($row = mysqli_fetch_assoc($result)) {
          $barcode = "'" . $row['barcode'] . "'";
          $key_ = "'" . $row['key_'] . "'";
          $name = "'" . $row['name'] . "'";
          $branch = "'".$_SESSION['branchName']."'";
          $print .= '<tr>
                <td>' . $row['barcode'] . '</td>
                <td>' . $row['key_'] . '</td>
                <td>' . $row['name'] . '</td>
                <td><button onClick="onClickSelect(' . $row['id'] . ',' . $key_ . ',' . $barcode . ',' . $name . ',' . $branch . ')" type="button" class="btn btn-primary btn-square">Seleccionar</button></td>
              </tr>';
        }
      $print .= '</tbody></table>';
      echo $print;
    } else {
      echo 'noPermit';
    }
  } else if ($operation === 'selectProduct') {
    $id = $_REQUEST['id'];
    $query = "SELECT * FROM products where id=" . $id . ";";
    $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
    $row = mysqli_fetch_assoc($result);
    echo $row['barcode'] . ',' . $row['name'] . ',' . $row['description'] . ',' . $row['key_'] . ',' . $row['brand'] . ',' . $row['model'] . ',' . $row['measure'] . ',' . $row['treadware'] . ',' . $row['load_index'] . ',' . $row['load_speed'] . ',' . $row['retail_price'] . ',' . $row['wholesale_price'] . ',' . $row['special_price'];
  }
  mysqli_close($link);
 ?>
