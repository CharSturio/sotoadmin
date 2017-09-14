<?php
  session_start();
  require '../connection/index.php';

  $operation = $_REQUEST['operation'];
  if ($operation === 'action') {   
    if($_SESSION['RepMerCInvVer'] == 'true'){
      $query = "SELECT S.amount, P.type_product, P.barcode, P.name, P.key_, P.brand, P.model, P.measure, P.treadware, P.load_index, P.load_speed FROM stocks AS S INNER JOIN products AS P ON S.id_product = P.id WHERE P.type_product = '" . $_REQUEST['typeProduct'] . "' ORDER BY P.barcode ASC";
      $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));

      $table_efectivo_remision = '<div class="force-table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Tipo</th>
            <th>Nombre</th>
            <th>Codigo</th>
            <th>Clave</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Medida</th>
            <th>Treadware</th>
            <th>Ind Carga</th>
            <th>Ind Velici</th>
            <th>Existencia</th>
          </tr>
        </thead>
        <tbody id="table">';

      while($row = mysqli_fetch_assoc($result)){
        $total_efectivo += $row['total'];
        $table_efectivo_remision .= '<tr>
          <td>' . $row['type_product'] . '</td>
          <td>' . $row['name'] . '</td>
          <td>' . $row['barcode'] . '</td>
          <td>' . $row['key_'] . '</td>
          <td>' . $row['brand'] . '</td>
          <td>' . $row['model'] . '</td>
          <td>' . $row['measure'] . '</td>
          <td>' . $row['treadware'] . '</td>
          <td>' . $row['load_index'] . '</td>
          <td>' . $row['load_speed'] . '</td>
          <td>' . $row['amount'] . '</td>
        </tr>';
      }
      $table_efectivo_remision .= '</tbody></table></div>';


      echo $table_efectivo_remision;
    } else {
      echo 'noPermit';
    }
  }
  mysqli_close($link);
 ?>
