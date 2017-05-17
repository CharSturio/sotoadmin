<?php
  session_start();
  require '../connection/index.php';

  $operation = $_REQUEST['operation'];
  if ($operation === 'action') {
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
    $html = '<style>
              table {
                  border-collapse: collapse;
                  font: 80%;
              }

              table, td, th {
                  border: 1px solid black;
              }
            </style>
            <link href="http://fonts.googleapis.com/css?family=Nothing+You+Could+Do" rel="stylesheet" type="text/css">
            <link href="../assets/css/style.css" rel="stylesheet"> <!-- MANDATORY -->
            <link href="../assets/css/theme.css" rel="stylesheet"> <!-- MANDATORY -->
            <link href="../assets/css/ui.css" rel="stylesheet"> <!-- MANDATORY -->
            <link href="../assets/plugins/datatables/dataTables.min.css" rel="stylesheet">';
    $html .= '<h2>Reporte de Facturacion de ' . $desde_fecha . ' a ' .  $hasta_fecha . '</h2>';

    $html .= '<div >
    <table class="table ">
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
      $html .= '<tr>
        <td>' . $row['invoice'] . '</td>
        <td>' . $row['last_date'] . '</td>
        <td>' . $row['name'] . '</td>
        <td>' . $row['rfc'] . '</td>
        <td>$' . number_format($row['total'], 2, '.', ',') . '</td>
      </tr>';
    }
    $html .= '</tbody></table></div>';

  }
  //echo $html;
  require_once 'dompdf/autoload.inc.php';
  use Dompdf\Dompdf;

  $dompdf = new Dompdf();
  $dompdf->loadHtml($html);
  $dompdf->setPaper('letter', 'vertical');
  $dompdf->render();
  $dompdf->stream('reporteFacturas' . $desde_fecha . 'a' . $hasta_fecha);
  mysqli_close($link);
 ?>
