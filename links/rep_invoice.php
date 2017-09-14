<?php
  session_start();
  require '../connection/index.php';

  $operation = $_REQUEST['operation'];
  if ($operation === 'action') {
    if($_SESSION['RepFacVer'] == 'true'){      
      $fecha_desde = $_REQUEST['fecha_desde'];
      $fecha_hasta = $_REQUEST['fecha_hasta'];
      $cliente = $_REQUEST['cliente'];
      $invoice = $_REQUEST['folio'];
      $desde = explode("/", $fecha_desde);
      $hasta = explode("/", $fecha_hasta);

      $desde_fecha = $desde[2] . '-' . $desde[0] . '-' . $desde[1];
      $hasta_fecha = $hasta[2] . '-' . $hasta[0] . '-' . $hasta[1];



      $query = "SELECT D.invoice, D.total, C.name, C.rfc, D.last_date FROM documents AS D  INNER JOIN clients AS C ON D.id_client = C.id WHERE status='activo' AND uuid IS NOT NULL AND D.last_date BETWEEN '" . $desde_fecha . " 00:00:00' AND '" . $hasta_fecha . " 23:59:59'";
      $ident = 0;
      if ($cliente) {
        $query .= " AND C.name LIKE '%" . $cliente . "%'";
        $ident = 1;
      }
      if ($invoice) {
        if ($ident === 1) {
          $query .= " AND ";
        }
        $query .= " D.invoice LIKE '%" . $invoice . "%'";
        $ident = 1;
      }
      $query .= " ORDER BY D.last_date DESC";
      $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));

      $table_efectivo_remision = '<div class="force-table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Folio</th>
            <th>Fecha</th>
            <th>Nombre</th>
            <th>RFC</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody id="table">';

      while($row = mysqli_fetch_assoc($result)){
        $total_efectivo += $row['total'];
        $table_efectivo_remision .= '<tr>
          <td>' . $row['invoice'] . '</td>
          <td>' . $row['last_date'] . '</td>
          <td>' . $row['name'] . '</td>
          <td>' . $row['rfc'] . '</td>
          <td>$' . number_format($row['total'], 2, '.', ',') . '</td>
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
