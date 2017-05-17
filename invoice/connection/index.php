<?php
  $link = mysql_connect('db625491732.db.1and1.com', 'dbo625491732', 'SotoGoodyear')
    or die('No se pudo conectar: ' . mysql_error());
  mysql_select_db('db625491732', $link) or die ('No se pudo seleccionar la base de datos');
?>
