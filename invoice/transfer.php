<?php
session_start();
require '../connection/index.php';
require "convert.php";
$id = $_REQUEST['id'];

$query = "SELECT T.id,P.key_, B1.name AS Bout, B2.name AS Bin, U.name AS Nuser, T.amount, T.last_date FROM `translates` AS T INNER JOIN stocks AS S ON S.id = T.id_stock INNER JOIN products AS P ON P.id = S.id_product INNER JOIN branches AS B1 ON B1.id = T.id_branch_out INNER JOIN branches AS B2 ON B2.id = T.id_branch_in INNER JOIN users AS U ON U.id = T.id_user WHERE T.id ='" . $id . "'";
$result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
  $row = mysqli_fetch_assoc($result);

  $html = '<!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="utf-8">
      <title>Transferncia</title>
      <link rel="stylesheet" href="invoice.css" media="all" />
      <link href="https://npmcdn.com/basscss@8.0.1/css/basscss.min.css" rel="stylesheet">
    </head>
    <body>
      <div class="wid100 center">
        <h1>Transferencia ' . $id . '</h1>
      </div>
      <div class="clearL"></div>
      <div class="wid25" >
        <img id="logo" src="logo.png">
      </div>
      
      <div class="clearL"></div>
      <br /><br />
      <div class="wid10"><b>Código</b></div>
      <div class="wid12"><b>Clave Producto</b></div>
      <div class="wid12"><b>Nombre</b></div>
      <div class="wid12"><b>Modelo</b></div>      
      <div class="wid12"><b>Sucursal Salida</b></div>
      <div class="wid12"><b>Sucural Entrada</b></div>
      <div class="wid10"><b>Usuario</b></div>
      <div class="wid10"><b>Cantidad</b></div>
      <div class="wid10"><b>Fecha</b></div>
      <div class="clearL"></div>';
      $query = "SELECT T.id,P.key_, B1.name AS Bout, B2.name AS Bin, U.name AS Nuser, T.amount, T.last_date, P.name, P.model FROM `translates` AS T INNER JOIN stocks AS S ON S.id = T.id_stock INNER JOIN products AS P ON P.id = S.id_product INNER JOIN branches AS B1 ON B1.id = T.id_branch_out INNER JOIN branches AS B2 ON B2.id = T.id_branch_in INNER JOIN users AS U ON U.id = T.id_user WHERE T.id_trans_op ='" . $id . "'";
      $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
        while($row = mysqli_fetch_assoc($result)){
          $html .= '<div class="wid10">' . $row['id'] . '</div>
          <div class="wid12">' . $row['key_'] . '</div>
          <div class="wid12">' . $row['name'] . '</div>
          <div class="wid12">' . $row['model'] . '</div>
          <div class="wid12">' . $row['Bout'] . '</div>
          <div class="wid12">' . $row['Bin'] . '</div>
          <div class="wid10">' . $row['Nuser'] . '</div>
          <div class="wid10">' . $row['amount'] . '</div>
          <div class="wid10">' . $row['last_date'] . '</div>
          <div class="clearL"></div>';
        }


       
      $html .= '<div class="clearL"></div>
      <br /><br />
      <div class="wid100"><b>Nombre y Firma de autorizacion</b></div>   
      <br /><br />   
      <div class="wid100"><b>_______________________________</b></div>      
      </body>
  </html>';
echo $html;
echo"<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />";
echo $html;
?>
