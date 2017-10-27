<?php
  require '../connection/index.php';
  session_start();  

  $operation = $_REQUEST['operation'];
  if ($operation === 'loadInfo') {
    // $id = $_REQUEST['id'];
    // $quest = $id * 25;
    $id_op = 0;
    $tot_op = 0;
    $unique = 0;
    $query = "SELECT T.id_trans_op,T.id,P.key_, B1.name AS Bout, B2.name AS Bin, U.name AS Nuser, T.amount, T.last_date FROM `translates` AS T INNER JOIN stocks AS S ON S.id = T.id_stock INNER JOIN products AS P ON P.id = S.id_product INNER JOIN branches AS B1 ON B1.id = T.id_branch_out INNER JOIN branches AS B2 ON B2.id = T.id_branch_in INNER JOIN users AS U ON U.id = T.id_user Order By T.id_trans_op DESC LIMIT 0,425";
    $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
    while ($row = mysqli_fetch_assoc($result)) {
      if($unique == 0){
        $id_op = $row['id_trans_op'];
        $unique = 1;
      }
      if($id_op != $row['id_trans_op']){
        echo '<tr>
        <td>' . $row['id_trans_op'] . '</td>
        <td>' . $row['Bout'] . '</td>
        <td>' . $row['Bin'] . '</td>
        <td>' . $row['Nuser'] . '</td>
        <th>' . $tot_op . '</th>
        <th>' . $row['last_date'] . '</th>
        <td><a onClick="onClickPDF(' . $id_op . ')"><i class="fa fa-file-pdf-o"></i></a></td>
      </tr>';
        $id_op = $row['id_trans_op'];
        $tot_op = $row['amount'];
      } else {
        $tot_op += $row['amount']; 
      }
    }
    echo '<tr>
    <td>' . $row['id_trans_op'] . '</td>
    <td>' . $row['Bout'] . '</td>
    <td>' . $row['Bin'] . '</td>
    <td>' . $row['Nuser'] . '</td>
    <th>' . $tot_op . '</th>
    <th>' . $row['last_date'] . '</th>
    <td><a onClick="onClickPDF(' . $id_op . ')"><i class="fa fa-file-pdf-o"></i></a></td>
  </tr>';
  } else if ($operation === 'browserInfo') {
    if($_SESSION['MovLisBus'] == 'true'){
      $ident = 0;
      $id = $_REQUEST['id'];
      $in = $_REQUEST['in'];
      $out = $_REQUEST['out'];
      $query = "SELECT T.id_trans_op, T.id,P.key_, B1.name AS Bout, B2.name AS Bin, U.name AS Nuser, T.amount, T.last_date FROM `translates` AS T INNER JOIN stocks AS S ON S.id = T.id_stock INNER JOIN products AS P ON P.id = S.id_product INNER JOIN branches AS B1 ON B1.id = T.id_branch_out INNER JOIN branches AS B2 ON B2.id = T.id_branch_in INNER JOIN users AS U ON U.id = T.id_user WHERE ";
      if ($id) {
        $query .= " T.id LIKE '%" . $id . "%'";
        $ident = 1;
      }
      if ($in) {
        if ($ident === 1) {
          $query .= " AND ";
        }
        $query .= " B2.name LIKE '%" . $in . "%'";
        $ident = 1;
      }
      if ($out) {
        if ($ident === 1) {
          $query .= " AND ";
        }
        $query .= " B1.name LIKE '%" . $out . "%'";
      }
      $query .= " Order By T.id_trans_op DESC";
      $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
      while ($row = mysqli_fetch_assoc($result)) {
        if($unique == 0){
          $id_op = $row['id_trans_op'];
          $unique = 1;
        }
        if($id_op != $row['id_trans_op']){
          echo '<tr>
          <td>' . $row['id_trans_op'] . '</td>
          <td>' . $row['Bout'] . '</td>
          <td>' . $row['Bin'] . '</td>
          <td>' . $row['Nuser'] . '</td>
          <th>' . $tot_op . '</th>
          <th>' . $row['last_date'] . '</th>
          <td><a onClick="onClickPDF(' . $id_op . ')"><i class="fa fa-file-pdf-o"></i></a></td>
        </tr>';
          $id_op = $row['id_trans_op'];
          $tot_op = $row['amount'];
        } else {
          $tot_op += $row['amount']; 
        }
      }
      echo '<tr>
        <td>' . $row['id_trans_op'] . '</td>
        <td>' . $row['Bout'] . '</td>
        <td>' . $row['Bin'] . '</td>
        <td>' . $row['Nuser'] . '</td>
        <th>' . $tot_op . '</th>
        <th>' . $row['last_date'] . '</th>
        <td><a onClick="onClickPDF(' . $id_op . ')"><i class="fa fa-file-pdf-o"></i></a></td>
      </tr>';
      
    } else {
      echo 'noPermit';
    }
  } 
  mysqli_close($link);
 ?>
