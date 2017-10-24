<?php
  session_start();
  
  require '../connection/index.php';

  $operation = $_REQUEST['operation'];
  if ($operation === 'add') {
    if($_SESSION['MovEntMerAgr'] == 'true'){

      $query = "INSERT INTO trans_op (last_date) VALUES (date_sub(NOW(), INTERVAL 300 HOUR_MINUTE));";
      $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
      $insert_temp=mysqli_insert_id($link);
      
      $queryT = "SELECT T.id, P.name AS p_name, P.key_, P.barcode, B2.name AS branch_to, B1.name AS branch, T.amount FROM temp_stock AS T INNER JOIN stocks AS S ON T.id_stock = S.id INNER JOIN products AS P ON S.id_product = P.id INNER JOIN branches AS B1 ON T.id_branch_to = B1.id INNER JOIN branches AS B2 ON S.id_branch = B2.id";
      $resultT = mysqli_query($link,$queryT) or die ('Consulta fallida: ' . mysqli_error($link));

      while ($rowT = mysqli_fetch_assoc($resultT)) {
        $query = "INSERT INTO translates (id_stock, id_branch_out, id_branch_in, id_user, id_trans_op, amount, last_date) VALUES (" . $id_stock . "," . $id_branch_out . "," . $id_branch_in . "," . $_SESSION['id'] . "," . $amount . "," . $insert_temp . ",date_sub(NOW(), INTERVAL 300 HOUR_MINUTE));";
        $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
        $oldInsert=mysqli_insert_id($link);
  
        $query = "UPDATE stocks SET amount=amount - " . $amount . " WHERE id=" . $id_stock;
        $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
  
        $queryP = "SELECT * FROM stocks where id =" . $id_stock .";";
        $resultP = mysqli_query($link,$queryP) or die ('Consulta fallida: ' . mysqli_error($link));
        $rowP = mysqli_fetch_assoc($resultP);
        $id_product = $rowP['id_product'];      
  
        $query = "SELECT * FROM stocks where id_product ='" . $id_product ."' and id_branch = ".$id_branch_in.";";
        $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
  
        $rowcount=mysqli_num_rows($result);
        if($rowcount == 0) {
          $query = "INSERT INTO stocks (id_product, amount, id_branch, last_date) VALUES ('" . $id_product . "', ".$amount.", " . $id_branch_in  . ", date_sub(NOW(), INTERVAL 300 HOUR_MINUTE));";
          $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
        } else {
          $row = mysqli_fetch_assoc($result);
          $idStock = $row['id'];
          
          $query = "UPDATE stocks SET amount=amount + " . $amount . " WHERE id=" . $idStock;
          $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
        }
      }        
      


      echo $oldInsert;
    } else {
      echo 'noPermit';
    }
  } else if ($operation === 'browserBarcode') {
    if($_SESSION['MovEntMerBus'] == 'true'){
      $query = "SELECT S.id, P.barcode, P.key_, P.name, B.id AS branch_id, B.name AS branch, S.amount FROM products AS P INNER JOIN stocks AS S ON S.id_product = P.id INNER JOIN branches AS B ON B.id = S.id_branch WHERE P.barcode LIKE '%" . $_REQUEST['content'] . "%';";
      $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
      $print = '<table class="table table-striped tablet-tools">
        <thead>
          <tr>
            <th>Código de Barras</th>
            <th>Sucursal</th>
            <th>Existencia</th>            
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
        $branch = "'".$row['branch']."'";
        $branch_id = $row['branch_id'];
        $amount = $row['amount'];
        $print .= '<tr>
              <td>' . $row['barcode'] . '</td>
              <td>' . $row['branch'] . '</td>
              <td>' . $row['amount'] . '</td>
              <td>' . $row['key_'] . '</td>
              <td>' . $row['name'] . '</td>
              <td><button onClick="onClickSelect(' . $row['id'] . ',' . $key_ . ',' . $barcode . ',' . $name . ',' . $branch . ','.$branch_id.',' . $amount . ')" type="button" class="btn btn-primary btn-square">Seleccionar</button></td>
            </tr>';
      }
      $print .= '</tbody></table>';
      echo $print;
    } else {
      echo 'noPermit';
    }
  } else if ($operation === 'browserName') {
    if($_SESSION['MovEntMerBus'] == 'true'){
      $query = "SELECT S.id, P.barcode, P.key_, P.name, B.id AS branch_id, B.name AS branch, S.amount FROM products AS P INNER JOIN stocks AS S ON S.id_product = P.id INNER JOIN branches AS B ON B.id = S.id_branch WHERE P.name LIKE '%" . $_REQUEST['content'] . "%';";
      $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
      $print = '<table class="table table-striped tablet-tools">
        <thead>
          <tr>
          <th>Código de Barras</th>
          <th>Sucursal</th>
          <th>Existencia</th>            
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
          $branch = "'".$row['branch']."'";
          $branch_id = $row['branch_id'];
          $amount = $row['amount'];
          $print .= '<tr>
                <td>' . $row['barcode'] . '</td>
                <td>' . $row['branch'] . '</td>
                <td>' . $row['amount'] . '</td>
                <td>' . $row['key_'] . '</td>
                <td>' . $row['name'] . '</td>
                <td><button onClick="onClickSelect(' . $row['id'] . ',' . $key_ . ',' . $barcode . ',' . $name . ',' . $branch . ','.$branch_id.',' . $amount . ')" type="button" class="btn btn-primary btn-square">Seleccionar</button></td>
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
  } else if ($operation === 'cancelProduct') {
    $query .= "DELETE FROM temp_stock WHERE id=" . $_REQUEST['id'] . ";";
    $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));

    $query = "SELECT T.id, P.name AS p_name, P.key_, P.barcode, B2.name AS branch_to, B1.name AS branch, T.amount FROM temp_stock AS T INNER JOIN stocks AS S ON T.id_stock = S.id INNER JOIN products AS P ON S.id_product = P.id INNER JOIN branches AS B1 ON T.id_branch_to = B1.id INNER JOIN branches AS B2 ON S.id_branch = B2.id";
    $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
    $print = '<table class="table table-striped tablet-tools">
    <thead>
      <tr>
      <th>Nombre</th>
      <th>Clave</th>
      <th>Codigo de barras</th>            
      <th>Sucursal Actual</th>
      <th>Sucursal Destino</th>
      <th>Cantidad</th>
      <th></th>
      </tr>
    </thead>
    <tbody>';
    while ($row = mysqli_fetch_assoc($result)) {
      $print .= '<tr>
            <td>' . $row['p_name'] . '</td>
            <td>' . $row['key_'] . '</td>
            <td>' . $row['barcode'] . '</td>
            <td>' . $row['branch'] . '</td>
            <td>' . $row['branch_to'] . '</td>
            <td>' . $row['amount'] . '</td>
            <td><button onClick="onClickCancel(' . $row['id'] . ')" type="button" class="btn btn-primary btn-square">Cancelar</button></td>
            </tr>';
    }
  $print .= '</tbody></table>';
  echo $print;
  } else if ($operation === 'addProduct') {
    $amount = $_REQUEST['amount'];
    $id_branch_to = $_REQUEST['id_branch_to'];
    $id_stock = $_REQUEST['id_stock'];
    $query = "INSERT INTO temp_stock (id_stock, id_branch_to, amount, last_date) VALUES (" . $id_stock . "," . $id_branch_to . "," . $amount . ",date_sub(NOW(), INTERVAL 300 HOUR_MINUTE));";
    $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));

    $query = "SELECT T.id, P.name AS p_name, P.key_, P.barcode, B2.name AS branch_to, B1.name AS branch, T.amount FROM temp_stock AS T INNER JOIN stocks AS S ON T.id_stock = S.id INNER JOIN products AS P ON S.id_product = P.id INNER JOIN branches AS B1 ON T.id_branch_to = B1.id INNER JOIN branches AS B2 ON S.id_branch = B2.id";
    $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
    $print = '<table class="table table-striped tablet-tools">
    <thead>
      <tr>
      <th>Nombre</th>
      <th>Clave</th>
      <th>Codigo de barras</th>            
      <th>Sucursal Actual</th>
      <th>Sucursal Destino</th>
      <th>Cantidad</th>
      <th></th>
      </tr>
    </thead>
    <tbody>';
    while ($row = mysqli_fetch_assoc($result)) {
      $print .= '<tr>
            <td>' . $row['p_name'] . '</td>
            <td>' . $row['key_'] . '</td>
            <td>' . $row['barcode'] . '</td>
            <td>' . $row['branch'] . '</td>
            <td>' . $row['branch_to'] . '</td>
            <td>' . $row['amount'] . '</td>
            <td><button onClick="onClickCancel(' . $row['id'] . ')" type="button" class="btn btn-primary btn-square">Cancelar</button></td>
            </tr>';
    }
  $print .= '</tbody></table>';
  echo $print;
  } else if ($operation === 'loadInfo') {
    $query = "SELECT T.id, P.name AS p_name, P.key_, P.barcode, B2.name AS branch_to, B1.name AS branch, T.amount FROM temp_stock AS T INNER JOIN stocks AS S ON T.id_stock = S.id INNER JOIN products AS P ON S.id_product = P.id INNER JOIN branches AS B1 ON T.id_branch_to = B1.id INNER JOIN branches AS B2 ON S.id_branch = B2.id";
    $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
    $print = '<table class="table table-striped tablet-tools">
    <thead>
      <tr>
      <th>Nombre</th>
      <th>Clave</th>
      <th>Codigo de barras</th>            
      <th>Sucursal Actual</th>
      <th>Sucursal Destino</th>
      <th>Cantidad</th>
      <th></th>
      </tr>
    </thead>
    <tbody>';
    while ($row = mysqli_fetch_assoc($result)) {
      $print .= '<tr>
            <td>' . $row['p_name'] . '</td>
            <td>' . $row['key_'] . '</td>
            <td>' . $row['barcode'] . '</td>
            <td>' . $row['branch'] . '</td>
            <td>' . $row['branch_to'] . '</td>
            <td>' . $row['amount'] . '</td>
            <td><button onClick="onClickCancel(' . $row['id'] . ')" type="button" class="btn btn-primary btn-square">Cancelar</button></td>
            </tr>';
    }
    $print .= '</tbody></table>';
    echo $print;
  }
  mysqli_close($link);
 ?>
