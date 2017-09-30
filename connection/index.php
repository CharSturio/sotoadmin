<?php
//$link = mysqli_connect('db625491732.db.1and1.com', 'dbo625491732', 'sotoadmin','db625491732')
  //or die('No se pudo conectar: ' . mysqli_connect_error());
  // $link = mysqli_connect('localhost', 'admin', 'SotoLlantas2015.','sotoadmin')
  // or die('No se pudo conectar: ' . mysqli_connect_error());
  //$link = mysqli_connect('localhost', 'root', 'SS2013MySql2017.','sotoadmin')
  $link = mysqli_connect('localhost', 'root', 'SotoLlantas2015','sotoadmin')
  or die('No se pudo conectar: ' . mysqli_connect_error());
  $passSMTP = "SotoGoodyear2015.,";
 // mysql_select_db('sotoadmin', $link) or die ('No se pudo seleccionar la base de datos');
?>
