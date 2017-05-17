<?php
session_start();

  require '../connection/index.php';

  $operation = $_REQUEST['operation'];
  if ($operation === 'new') {
    $type_product = $_REQUEST['type_product'];
    $barcode = $_REQUEST['barcode'];
    $name = $_REQUEST['name'];
    $description = $_REQUEST['description'];
    $key = $_REQUEST['key'];
    $brand = $_REQUEST['brand'];
    $model = $_REQUEST['model'];
    $measure = $_REQUEST['measure'];
    $treadware = $_REQUEST['treadware'];
    $load_index = $_REQUEST['load_index'];
    $load_speed = $_REQUEST['load_speed'];
    $retail_price = $_REQUEST['retail_price'];
    $wholesale_price = $_REQUEST['wholesale_price'];
    $special_price = $_REQUEST['special_price'];
    $tarjeta = $_REQUEST['tarjeta'];
    $mpago = $_REQUEST['mpago'];
    $pespecial = $_REQUEST['pespecial'];
    $retail_price = round(($retail_price/116)*100,2)*1.16;
    $wholesale_price = round(($wholesale_price/116)*100,2)*1.16;
    $special_price = round(($special_price/116)*100,2)*1.16;
    $tarjeta = round(($tarjeta/116)*100,2)*1.16;
    $mpago = round(($mpago/116)*100,2)*1.16;
    $pespecial = round(($pespecial/116)*100,2)*1.16;
    $query = "SELECT * FROM products where name ='" . $name ."';";
    $result = mysql_query($query) or die ('Consulta fallida: ' . mysql_error());
    if (mysql_fetch_assoc($result)) {
      echo 'El Nombre de Producto ya existe.';
    } else {
      $query = "SELECT * FROM products where barcode ='" . $barcode ."';";
      $result = mysql_query($query) or die ('Consulta fallida: ' . mysql_error());
      if (mysql_fetch_assoc($result)) {
        echo 'El Codigo de Barras ya existe.';
      } else {
        $query = "INSERT INTO products (type_product, barcode, name, description, key_, brand, model, measure, treadware, load_index, load_speed, retail_price, wholesale_price, special_price, tarjeta, mpago, pespecial, last_date) VALUES ('" . $type_product . "','" . $barcode . "','" . $name . "','" . $description . "','" . $key . "','" . $brand . "','" . $model . "','" . $measure . "','" . $treadware . "','" . $load_index . "','" . $load_speed . "','" . $retail_price . "','" . $wholesale_price . "','" . $special_price . "','" . $tarjeta . "','" . $mpago . "','" . $pespecial . "',now());";
        $result = mysql_query($query) or die ('Consulta fallida: ' . mysql_error());

        // $query = "SELECT id FROM products where name ='" . $name ."';";
        // $result = mysql_query($query) or die ('Consulta fallida: ' . mysql_error());
        // $id = 0;
        // while ($row = mysql_fetch_assoc($result)) {
        //   $id = $row['id'];
        // }
        $id=mysql_insert_id();

        $query = "INSERT INTO stocks (id_product, amount, last_date) VALUES ('" . $id . "', 0, now());";
        $result = mysql_query($query) or die ('Consulta fallida: ' . mysql_error());

        echo 'Producto agregado.';
      }
    }
  } else if ($operation === 'modify') {
    $query = "UPDATE products SET";
    if ($_REQUEST['barcode']) {
      $query .= " barcode='" . $_REQUEST['barcode'] . "',";
    }
    if ($_REQUEST['name']) {
      $query .= " name='" . $_REQUEST['name'] . "',";
    }
    if ($_REQUEST['description']) {
      $query .= " description='" . $_REQUEST['description'] . "',";
    }
    if ($_REQUEST['key_']) {
      $query .= " key_='" . $_REQUEST['key_'] . "',";
    }
    if ($_REQUEST['brand']) {
      $query .= " brand='" . $_REQUEST['brand'] . "',";
    }
    if ($_REQUEST['model']) {
      $query .= " model='" . $_REQUEST['model'] . "',";
    }
    if ($_REQUEST['measure']) {
      $query .= " measure='" . $_REQUEST['measure'] . "',";
    }
    if ($_REQUEST['treadware']) {
      $query .= " treadware='" . $_REQUEST['treadware'] . "',";
    }
    if ($_REQUEST['load_index']) {
      $query .= " load_index='" . $_REQUEST['load_index'] . "',";
    }
    if ($_REQUEST['load_speed']) {
      $query .= " load_speed='" . $_REQUEST['load_speed'] . "',";
    }
    $query .= " last_date=now() WHERE id=" . $_REQUEST['id'] . ";";
    $result = mysql_query($query) or die ('Consulta fallida: ' . mysql_error());
    echo 'Actualizado correctamente.';

  }else if ($operation === 'modifyCosts') {
    if ($_SESSION['permit'] === 'admin') {
      $query = "UPDATE products SET";
      if ($_REQUEST['retail_price']) {
        $query .= " retail_price='" . round(($_REQUEST['retail_price']/116)*100,2)*1.16 . "',";
      }
      if ($_REQUEST['wholesale_price']) {
        $query .= " wholesale_price='" . round(($_REQUEST['wholesale_price']/116)*100,2)*1.16 . "',";
      }
      if ($_REQUEST['special_price']) {
        $query .= " special_price='" . round(($_REQUEST['special_price']/116)*100,2)*1.16 . "',";
      }
      if ($_REQUEST['tarjeta']) {
        $query .= " tarjeta='" . round(($_REQUEST['tarjeta']/116)*100,2)*1.16 . "',";
      }
      if ($_REQUEST['mpago']) {
        $query .= " mpago='" . round(($_REQUEST['mpago']/116)*100,2)*1.16 . "',";
      }
      if ($_REQUEST['pespecial']) {
        $query .= " pespecial='" . round(($_REQUEST['pespecial']/116)*100,2)*1.16 . "',";
      }
      $query .= " last_date=now() WHERE id=" . $_REQUEST['id'] . ";";
      $result = mysql_query($query) or die ('Consulta fallida: ' . mysql_error());
      echo 'Actualizado correctamente.';
    } elseif ($_REQUEST['typeProduct'] !== 'llantas') {
      $query = "UPDATE products SET";
      if ($_REQUEST['retail_price']) {
        $query .= " retail_price='" . round(($_REQUEST['retail_price']/116)*100,2)*1.16 . "',";
      }
      if ($_REQUEST['wholesale_price']) {
        $query .= " wholesale_price='" . round(($_REQUEST['wholesale_price']/116)*100,2)*1.16 . "',";
      }
      if ($_REQUEST['special_price']) {
        $query .= " special_price='" . round(($_REQUEST['special_price']/116)*100,2)*1.16 . "',";
      }
      if ($_REQUEST['tarjeta']) {
        $query .= " tarjeta='" . round(($_REQUEST['tarjeta']/116)*100,2)*1.16 . "',";
      }
      if ($_REQUEST['mpago']) {
        $query .= " mpago='" . round(($_REQUEST['mpago']/116)*100,2)*1.16 . "',";
      }
      if ($_REQUEST['pespecial']) {
        $query .= " pespecial='" . round(($_REQUEST['pespecial']/116)*100,2)*1.16 . "',";
      }
      $query .= " last_date=now() WHERE id=" . $_REQUEST['id'] . ";";
      $result = mysql_query($query) or die ('Consulta fallida: ' . mysql_error());
      echo 'Actualizado correctamente.';
    } else {
      echo 'Solo el usuario Administrador puede modificar precios';
    }

  } else if ($operation === 'delete') {
    $query .= "DELETE FROM products WHERE id=" . $_REQUEST['id'] . ";";
    $result = mysql_query($query) or die ('Consulta fallida: ' . mysql_error());
    echo 'Eliminado correctamente.';
  }  else if ($operation === 'browserName') {
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
      $print .= '<tr>
            <td>' . $row['barcode'] . '</td>
            <td>' . $row['key_'] . '</td>
            <td>' . $row['name'] . '</td>
            <td><button onClick="onClickSelect(' . $row['id'] . ')" type="button" class="btn btn-primary btn-square">Modificar</button></td>
          </tr>';
    }
    $print .= '</tbody></table>';
    echo $print;
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
      $print .= '<tr>
            <td>' . $row['barcode'] . '</td>
            <td>' . $row['key_'] . '</td>
            <td>' . $row['name'] . '</td>
            <td><button onClick="onClickSelect(' . $row['id'] . ')" type="button" class="btn btn-primary btn-square">Modificar</button></td>
          </tr>';
    }
    $print .= '</tbody></table>';
    echo $print;
  } else if ($operation === 'selectProduct') {
    $id = $_REQUEST['id'];
    $query = "SELECT * FROM products where id=" . $id . ";";
    $result = mysql_query($query) or die ('Consulta fallida: ' . mysql_error());
    $row = mysql_fetch_assoc($result);
    echo $row['barcode'] . ',' . $row['name'] . ',' . $row['description'] . ',' . $row['key_'] . ',' . $row['brand'] . ',' . $row['model'] . ',' . $row['measure'] . ',' . $row['treadware'] . ',' . $row['load_index'] . ',' . $row['load_speed'] . ',' . $row['retail_price'] . ',' . $row['wholesale_price'] . ',' . $row['special_price'] . ',' . $row['tarjeta'] . ',' . $row['mpago'] . ',' . $row['pespecial'];
  }
  mysql_close($link);
 ?>
