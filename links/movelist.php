<?php
  require '../connection/index.php';
  $pathXml = "create/xmls/";  
  require "$pathXml";
  $pathPdf = "../invoice/pdf/";  
  require "$pathPdf";

  $operation = $_REQUEST['operation'];
  if ($operation === 'loadInfo') {
    // $id = $_REQUEST['id'];
    // $quest = $id * 25;
    $query = "SELECT D.uuid, D.id, D.invoice, D.last_date, D.type, D.status, C.name, U.user, D.total, D.comments FROM documents AS D INNER JOIN clients AS C ON D.id_client = C.id INNER JOIN users AS U ON D.id_user = U.id ORDER BY D.last_date DESC LIMIT 0,250";
    $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
    while ($row = mysqli_fetch_assoc($result)) {
      if ($row['type'] === 'invoice') {
        if ($row['uuid']) {
           $idIn = 1;
        } else {
           $idIn = 0;
        }
        echo '<tr>
                <td>' . $row['invoice'] . '</td>
                <td>' . $row['last_date'] . '</td>
                <td>' . $row['type'] . '</td>
                <td>' . $row['status'] . '</td>
                <td>' . $row['name'] . '</td>
                <th>' . $row['user'] . '</th>
                <th>' . $row['comments'] . '</th>
                <td>$' . number_format($row['total'], 2, '.', ',') . '</td>
                <td><a onClick="onClickXML(' . $row['id'] . ',' . $idIn . ')"><i class="fa fa-file-archive-o"></i></a></td>
                <td><a onClick="onClickPDF(' . $row['id'] . ', 1)"><i class="fa fa-file-pdf-o"></i></a></td>
                <td><a onClick="onClickSend(' . $row['id'] . ', 1)"><i class="fa fa-send"></i></a></td>
                <td><a onClick="onClickCancel(' . $row['id'] . ')"><i class="fa fa-close c-red"></i></a></td>
              </tr>';
      }
      if ($row['type'] === 'remission') {
        echo '<tr>
                <td>' . $row['invoice'] . '</td>
                <td>' . $row['last_date'] . '</td>
                <td>' . $row['type'] . '</td>
                <td>' . $row['status'] . '</td>
                <td>' . $row['name'] . '</td>
                <th>' . $row['user'] . '</th>
                <th>' . $row['comments'] . '</th>
                <td>$' . number_format($row['total'], 2, '.', ',') . '</td>
                <td></td>
                <td><a onClick="onClickPDF(' . $row['id'] . ', 2)"><i class="fa fa-file-pdf-o"></i></a></td>
                <td><a onClick="onClickSend(' . $row['id'] . ', 2)"><i class="fa fa-send"></i></a></td>
                <td><a onClick="onClickCancel(' . $row['id'] . ')"><i class="fa fa-close c-red"></i></a></td>
              </tr>';
      }
      if ($row['type'] === 'credit') {
        if ($row['uuid']) {
           $idIn = 1;
           $print = 1;
        } else {
           $idIn = 0;
           $print = 3;
        }
        echo '<tr>
                <td>' . $row['invoice'] . '</td>
                <td>' . $row['last_date'] . '</td>
                <td>' . $row['type'] . '</td>
                <td>' . $row['status'] . '</td>
                <td>' . $row['name'] . '</td>
                <th>' . $row['user'] . '</th>
                <th>' . $row['comments'] . '</th>
                <td>$' . number_format($row['total'], 2, '.', ',') . '</td>
                <td><a onClick="onClickXMLCredit(' . $row['id'] . ', ' . $idIn . ')"><i class="fa fa-file-archive-o"></i></a></td>
                <td><a onClick="onClickPDF(' . $row['id'] . ', ' . $print . ')"><i class="fa fa-file-pdf-o"></i></a></td>
                <td><a onClick="onClickSend(' . $row['id'] . ', 3)"><i class="fa fa-send"></i></a></td>
                <td><a onClick="onClickCancel(' . $row['id'] . ')"><i class="fa fa-close c-red"></i></a></td>
              </tr>';
      }

    }
  } if ($operation === 'browserInfo') {
    $ident = 0;
    $client = $_REQUEST['client'];
    $invoice = $_REQUEST['invoice'];
    $user = $_REQUEST['user'];
    $query = "SELECT D.uuid, D.id, D.invoice, D.last_date, D.type, D.status, C.name, U.user, D.total FROM documents AS D INNER JOIN clients AS C ON D.id_client = C.id INNER JOIN users AS U ON D.id_user = U.id WHERE";
    if ($client) {
      $query .= " C.name LIKE '%" . $client . "%'";
      $ident = 1;
    }
    if ($invoice) {
      if ($ident === 1) {
        $query .= " AND ";
      }
      $query .= " D.invoice LIKE '%" . $invoice . "%'";
      $ident = 1;
    }
    if ($user) {
      if ($ident === 1) {
        $query .= " AND ";
      }
      $query .= " U.user LIKE '%" . $user . "%'";
    }
    $query .= " ORDER BY D.last_date DESC";
    $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
    while ($row = mysqli_fetch_assoc($result)) {
      if ($row['type'] === 'invoice') {
        if ($row['uuid']) {
           $idIn = 1;
        } else {
           $idIn = 0;
        }
        echo '<tr>
                <td>' . $row['invoice'] . '</td>
                <td>' . $row['last_date'] . '</td>
                <td>' . $row['type'] . '</td>
                <td>' . $row['status'] . '</td>
                <td>' . $row['name'] . '</td>
                <th>' . $row['user'] . '</th>
                <td>$' . number_format($row['total'], 2, '.', ',') . '</td>
                <td><a onClick="onClickXML(' . $row['id'] . ',' . $idIn . ')"><i class="fa fa-file-archive-o"></i></a></td>
                <td><a onClick="onClickPDF(' . $row['id'] . ', 1)"><i class="fa fa-file-pdf-o"></i></a></td>
                <td><a onClick="onClickSend(' . $row['id'] . ', 1)"><i class="fa fa-send"></i></a></td>
                <td><a onClick="onClickCancel(' . $row['id'] . ')"><i class="fa fa-close c-red"></i></a></td>
              </tr>';
      }
      if ($row['type'] === 'remission') {
        echo '<tr>
                <td>' . $row['invoice'] . '</td>
                <td>' . $row['last_date'] . '</td>
                <td>' . $row['type'] . '</td>
                <td>' . $row['status'] . '</td>
                <td>' . $row['name'] . '</td>
                <th>' . $row['user'] . '</th>
                <td>$' . number_format($row['total'], 2, '.', ',') . '</td>
                <td></td>
                <td><a onClick="onClickPDF(' . $row['id'] . ', 2)"><i class="fa fa-file-pdf-o"></i></a></td>
                <td><a onClick="onClickSend(' . $row['id'] . ', 2)"><i class="fa fa-send"></i></a></td>
                <td><a onClick="onClickCancel(' . $row['id'] . ')"><i class="fa fa-close c-red"></i></a></td>
              </tr>';
      }
      if ($row['type'] === 'credit') {
        if ($row['uuid']) {
           $idIn = 1;
        } else {
           $idIn = 0;
        }
        echo '<tr>
                <td>' . $row['invoice'] . '</td>
                <td>' . $row['last_date'] . '</td>
                <td>' . $row['type'] . '</td>
                <td>' . $row['status'] . '</td>
                <td>' . $row['name'] . '</td>
                <th>' . $row['user'] . '</th>
                <td>$' . number_format($row['total'], 2, '.', ',') . '</td>
                <td><a onClick="onClickXMLCredit(' . $row['id'] . ', ' . $idIn . ')"><i class="fa fa-file-archive-o"></i></a></td>
                <td><a onClick="onClickPDF(' . $row['id'] . ', 3)"><i class="fa fa-file-pdf-o"></i></a></td>
                <td><a onClick="onClickSend(' . $row['id'] . ', 3)"><i class="fa fa-send"></i></a></td>
                <td><a onClick="onClickCancel(' . $row['id'] . ')"><i class="fa fa-close c-red"></i></a></td>
              </tr>';
      }

    }
  } else if ($operation === 'xml') {
    $id = $_REQUEST['id'];
    $queryDandC = "SELECT * FROM documents WHERE id=" . $id ." LIMIT 1;";
    $resultDandC = mysqli_query($link,$queryDandC) or die ('Consulta fallida: ' . mysqli_error($link));
    $rowDandC = mysqli_fetch_assoc($resultDandC);
    if ($rowDandC['status'] === 'cancelado') {
      $name_xml = $rowDandC['invoice'] . $rowDandC['id'] . "_cancelado.xml";
      $file = $pathXml.$name_xml;
    } else {
      $name_xml = $rowDandC['invoice'] . $rowDandC['id'] . ".xml";
      $file = $pathXml.$name_xml;
    }
    if (file_exists($file)) {
      header('Content-Description: File Transfer');
      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename='.basename($file));
      header('Content-Transfer-Encoding: binary');
      header('Expires: 0');
      header('Cache-Control: must-revalidate');
      header('Pragma: public');
      header('Content-Length: ' . filesize($file));
      ob_clean();
      flush();
      readfile($file);
    }

  }
  else if ($operation === 'pdf') {
    $id = $_REQUEST['id'];
    $queryDandC = "SELECT * FROM documents WHERE id=" . $id ." LIMIT 1;";
    $resultDandC = mysqli_query($link,$queryDandC) or die ('Consulta fallida: ' . mysqli_error($link));
    $rowDandC = mysqli_fetch_assoc($resultDandC);
    $name_pdf = $rowDandC['invoice']. ".pdf";
    $file = $pathPdf . $name_pdf;
    if (file_exists($file)) {
      header('Content-Description: File Transfer');
      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename='.basename($file));
      header('Content-Transfer-Encoding: binary');
      header('Expires: 0');
      header('Cache-Control: must-revalidate');
      header('Pragma: public');
      header('Content-Length: ' . filesize($file));
      ob_clean();
      flush();
      readfile($file);
    }
  }
  mysqli_close($link);
 ?>
