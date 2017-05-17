<?php
  session_start();
  require '../connection/index.php';

  $operation = $_REQUEST['operation'];
  if ($operation === 'action') {

    $query = "SELECT P.type_product, P.barcode, P.name, P.key_, P.brand, P.model, P.retail_price, P.wholesale_price, P.special_price, P.tarjeta, P.mpago, P.pespecial FROM stocks AS S INNER JOIN products AS P ON S.id_product = P.id WHERE P.type_product = '" . $_REQUEST['typeProduct'] . "' ORDER BY P.barcode ASC";
    $result = mysql_query($query) or die ('Consulta fallida: ' . mysql_error());

    $table_efectivo_remision = '<div class="force-table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
        <th>Tipo</th>
        <th>Nombre</th>
        <th>Codigo</th>
        <th>Clave</th>
        <th>P Publico</th>
        <th>P Mayoreo</th>
        <th>P Especial</th>
        <th>P Tarjeta</th>
        <th>P Merc Pago</th>
        <th>P Pub Especial</th>
        </tr>
      </thead>
      <tbody id="table">';

    while($row = mysql_fetch_assoc($result)){
      $total_efectivo += $row['total'];
      $table_efectivo_remision .= '<tr>
      <td>' . $row['type_product'] . '</td>
      <td>' . $row['name'] . '</td>
      <td>' . $row['barcode'] . '</td>
      <td>' . $row['key_'] . '</td>
      <td>' . $row['retail_price'] . '</td>
      <td>' . $row['wholesale_price'] . '</td>
      <td>' . $row['special_price'] . '</td>
      <td>' . $row['tarjeta'] . '</td>
      <td>' . $row['mpago'] . '</td>
      <td>' . $row['pespecial'] . '</td>
      </tr>';
    }
    $table_efectivo_remision .= '</tbody></table></div>';


    echo $table_efectivo_remision;

  }
  mysql_close($link);
 ?>
