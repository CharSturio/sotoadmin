<?php
require '../../connection/index.php';

  $pass = $_REQUEST['pass'];
  $name = $_REQUEST['name'];

  if ($_REQUEST['operation'] === 'login') {
    //$query = "SELECT * FROM users where user ='" . $name ."' AND password=SHA('" . $pass . "') LIMIT 1;";
    $query = "SELECT * FROM users as U INNER JOIN permissions as P ON U.permit = P.name where U.user ='" . $name ."' AND U.password=SHA('" . $pass . "') LIMIT 1;";
    echo $query;
    $result = mysqli_query($link, $query) or die ('Consulta fallida: ' . mysqli_error($link));
    if(mysqli_num_rows($result) === 1){
        while($row = mysqli_fetch_assoc($result)) {
          echo $row;
          session_start();
          $_SESSION['user'] = $row['user'];
          $_SESSION['permit'] = $row['permit'];
          $_SESSION['id'] = $row['id'];
          $_SESSION['logged'] = true;
        }
        if ($row['permit'] === 'client') {
          echo 2;
        } else {
          echo 1;
        }





    } else {
      echo "Usuario o contraseña incorrecta. Intente de nuevo.";
      exit;
    }
  }
?>
