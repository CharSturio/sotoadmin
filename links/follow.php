<?php
  session_start();
  require '../connection/index.php';

  $operation = $_REQUEST['operation'];
  if ($operation === 'browser') {
    $client = $_REQUEST['client'];

    $query = "SELECT D.id AS id_document, C.limit_credit, D.invoice, U.name AS name_user, C.name AS name_client, CR.total_credit, CR.total_paid_out, CR.status, CR.last_date FROM documents AS D INNER JOIN credit AS CR ON D.id = CR.id_document INNER JOIN users AS U ON D.id_user = U.id INNER JOIN clients AS C ON D.id_client = C.id WHERE C.name LIKE '%" . $client . "%' AND D.type='credit' AND CR.status='payable'";
    $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));

    while ($row =  mysqli_fetch_assoc($result)) {
      $rest = $row['total_paid_out'] - $row['total_credit'];
      $document = "'" . $row['invoice'] . "'";
      $client_name = "'" . $row['name_client'] . "'";
      echo '<tr>
              <td>' . $row['name_client'] . '</td>
              <td>' . $rest . '</td>
              <td>' . $row['invoice'] . '</td>
              <td>' . $row['status'] . '</td>
              <td>' . $row['last_date'] . '</td>
              <td>' . $row['name_user'] . '</td>
              <td><button data-toggle="modal" data-target="#modal-bootstrap-timepicker" onClick="onClickFollow(' . $row['id_document'] . ',' . $row['limit_credit'] . ',' . $rest . ',' . $document . ',' . $client_name . ')" type="button" class="btn btn-primary btn-square">Seguimiento</button></td>
            </tr>';
    }

  } else if ($operation === 'openFollow') {
    $id_document = $_REQUEST['id_document'];

    $query = "SELECT * FROM follow WHERE id_invoice = " . $id_document;
    $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));

    while ($row = mysqli_fetch_assoc($result)) {
      echo '<tr>
              <td>' . $row['last_date'] . '</td>
              <td>' . $row['status'] . '</td>
              <td>' . $row['follow'] . '</td>
              <td>' . $row['date_follow'] . '</td>
            </tr>';
    }
  } else if ($operation === 'saveFollow') {
    $id_document = $_REQUEST['id_document'];
    $status = "'" . $_REQUEST['status'] . "'";
    $follow = "'" . $_REQUEST['follow'] . "'";
    $date_follow = "'" . $_REQUEST['date_follow'] . "'";

    $query = "INSERT INTO follow (status, follow, date_follow, id_invoice, last_date) VALUES (" . $status . "," . $follow . "," . $date_follow . "," . $id_document . ",now())";
    $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));

    echo "Guardado con Exito. Refresque para actualizar datos.";
  } else if ($operation === 'paid') {
    $id_document = $_REQUEST['id_document'];
    $paid = $_REQUEST['paid'];

    $query = "INSERT INTO credit_paid (id_document, id_user, paid_out, last_date) VALUES (" . $id_document . "," . $_SESSION['id'] . "," . $paid . ",now())";
    $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));

    $query = "SELECT * FROM credit WHERE id_document=" . $id_document . " LiMIT 1";
    $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));

    $row = mysqli_fetch_assoc($result);
    $total = $row['total_credit'] * 1;
    $total_out = ($row['total_paid_out'] + $paid) * 1;
    $status = $row['status'];

    if ($total_out > $total) {
      $status = 'paid_out';
    }

    if ($total_out === $total) {
      $status = 'paid_out';
    }

    $query = "UPDATE credit SET total_paid_out=" . $total_out . ", status='" . $status . "'  WHERE id_document=" . $id_document;
    $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));

    echo "Guardado con Exito. Refresque para actualizar datos.";
  }
  mysqli_close($link);
 ?>
