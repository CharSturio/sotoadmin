<?php
require '../../connection/index.php';

  $pass = $_REQUEST['pass'];
  $name = $_REQUEST['name'];

  if ($_REQUEST['operation'] === 'login') {
    $query = "SELECT * FROM users where user ='" . $name ."' AND password=SHA('" . $pass . "') LIMIT 1;";
    //$query = "SELECT * FROM users as U INNER JOIN permissions as P ON U.permit = P.name where U.user ='" . $name ."' AND U.password=SHA('" . $pass . "') LIMIT 1;";
    $result = mysqli_query($link, $query) or die ('Consulta fallida: ' . mysqli_error($link));
    if(mysqli_num_rows($result) === 1){
        while($row = mysqli_fetch_assoc($result)) {
          session_start();
          $_SESSION['user'] = $row['user'];
          $_SESSION['permit'] = $row['permit'];
          $_SESSION['id'] = $row['id'];
          $_SESSION['logged'] = true;
          $_SESSION['branchID'] = $row['branch'];
        }
        $query2 = "SELECT * FROM permissions where name ='" . $_SESSION['permit'] ."';";
        $result2 = mysqli_query($link, $query2) or die ('Consulta fallida: ' . mysqli_error($link));
        if(mysqli_num_rows($result) === 1){
          while($row2 = mysqli_fetch_assoc($result2)) {
            $_SESSION['RegUsuGen'] = $row2['RegUsuGen'];
            $_SESSION['RegUsuCre'] = $row2['RegUsuCre'];
            $_SESSION['RegUsuMod'] = $row2['RegUsuMod'];
            $_SESSION['RegUsuEli'] = $row2['RegUsuEli'];
            $_SESSION['RegUsuVer'] = $row2['RegUsuVer'];
            $_SESSION['RegCliGen'] = $row2['RegCliGen'];
            $_SESSION['RegCliCre'] = $row2['RegCliCre'];
            $_SESSION['RegCliMod'] = $row2['RegCliMod'];
            $_SESSION['RegCliEli'] = $row2['RegCliEli'];
            $_SESSION['RegCliVer'] = $row2['RegCliVer'];
            $_SESSION['RegSucGen'] = $row2['RegSucGen'];
            $_SESSION['RegSucCre'] = $row2['RegSucCre'];
            $_SESSION['RegSucMod'] = $row2['RegSucMod'];
            $_SESSION['RegSucEli'] = $row2['RegSucEli'];
            $_SESSION['RegSucVer'] = $row2['RegSucVer'];
            $_SESSION['RegProGen'] = $row2['RegProGen'];
            $_SESSION['RegProCre'] = $row2['RegProCre'];
            $_SESSION['RegProMod'] = $row2['RegProMod'];
            $_SESSION['RegProModPre'] = $row2['RegProModPre'];
            $_SESSION['RegProEli'] = $row2['RegProEli'];
            $_SESSION['RegProVer'] = $row2['RegProVer'];
            $_SESSION['UtiCyCGen'] = $row2['UtiCyCGen'];
            $_SESSION['UtiCyCBus'] = $row2['UtiCyCBus'];
            $_SESSION['UtiCyCSeg'] = $row2['UtiCyCSeg'];
            $_SESSION['UtiCyCPag'] = $row2['UtiCyCPag'];
            $_SESSION['UtiCyCSegInt'] = $row2['UtiCyCSegInt'];
            $_SESSION['UtiEnvMerGen'] = $row2['UtiEnvMerGen'];
            $_SESSION['UtiEnvMerEnv'] = $row2['UtiEnvMerEnv'];
            $_SESSION['UtiCCGen'] = $row2['UtiCCGen'];
            $_SESSION['UtiCCCorCaj'] = $row2['UtiCCCorCaj'];
            $_SESSION['UtiCCPdf'] = $row2['UtiCCPdf'];
            $_SESSION['UtiCCEnv'] = $row2['UtiCCEnv'];
            $_SESSION['UtiEySCGen'] = $row2['UtiEySCGen'];
            $_SESSION['UtiEySCAgrSal'] = $row2['UtiEySCAgrSal'];
            $_SESSION['UtiEySCAgrEnt'] = $row2['UtiEySCAgrEnt'];
            $_SESSION['UtiStoMinGen'] = $row2['UtiStoMinGen'];
            $_SESSION['UtiStoMinEnv'] = $row2['UtiStoMinEnv'];
            $_SESSION['UtiPerGen'] = $row2['UtiPerGen'];
            $_SESSION['UtiPerCre'] = $row2['UtiPerCre'];
            $_SESSION['UtiPerMod'] = $row2['UtiPerMod'];
            $_SESSION['UtiPerEli'] = $row2['UtiPerEli'];
            $_SESSION['UtiPerVer'] = $row2['UtiPerVer'];
            $_SESSION['MovLisGen'] = $row2['MovLisGen'];
            $_SESSION['MovLisBus'] = $row2['MovLisBus'];
            $_SESSION['MovLisTim'] = $row2['MovLisTim'];
            $_SESSION['MovLisDes'] = $row2['MovLisDes'];
            $_SESSION['MovLisEnv'] = $row2['MovLisEnv'];
            $_SESSION['MovLisEli'] = $row2['MovLisEli'];
            $_SESSION['MovCotGen'] = $row2['MovCotGen'];
            $_SESSION['MovCotBusCli'] = $row2['MovCotBusCli'];
            $_SESSION['MovCotBusPro'] = $row2['MovCotBusPro'];
            $_SESSION['MovCotFac'] = $row2['MovCotFac'];
            $_SESSION['MovCotRem'] = $row2['MovCotRem'];
            $_SESSION['MovCotCre'] = $row2['MovCotCre'];
            $_SESSION['MovCotCan'] = $row2['MovCotCan'];
            $_SESSION['MovInvGen'] = $row2['MovInvGen'];
            $_SESSION['MovInvBus'] = $row2['MovInvBus'];
            $_SESSION['MovInvMod'] = $row2['MovInvMod'];
            $_SESSION['MovInvEntDev'] = $row2['MovInvEntDev'];
            $_SESSION['MovInvSalDev'] = $row2['MovInvSalDev'];
            $_SESSION['MovEntMerBus'] = $row2['MovEntMerBus'];
            $_SESSION['MovEntMerGen'] = $row2['MovEntMerGen'];
            $_SESSION['MovEntMerAgr'] = $row2['MovEntMerAgr'];
            $_SESSION['RepFacGen'] = $row2['RepFacGen'];
            $_SESSION['RepFacVer'] = $row2['RepFacVer'];
            $_SESSION['RepFacDes'] = $row2['RepFacDes'];
            $_SESSION['RepMerCInvGen'] = $row2['RepMerCInvGen'];
            $_SESSION['RepMerCInvVer'] = $row2['RepMerCInvVer'];
            $_SESSION['RepMerCInvDes'] = $row2['RepMerCInvDes'];
            $_SESSION['RepMerSInvGen'] = $row2['RepMerSInvGen'];
            $_SESSION['RepMerSInvVer'] = $row2['RepMerSInvVer'];
            $_SESSION['RepMerSInvDes'] = $row2['RepMerSInvDes'];
            $_SESSION['RepMerCCosGen'] = $row2['RepMerCCosGen'];
            $_SESSION['RepMerCCosVer'] = $row2['RepMerCCosVer'];
            $_SESSION['RepMerCCosDes'] = $row2['RepMerCCosDes'];
          }
        }
        $query3 = "SELECT * FROM branches where id =" . $_SESSION['branchID'];
        $result3 = mysqli_query($link, $query3) or die ('Consulta fallida: ' . mysqli_error($link));
        $row3 = mysqli_fetch_assoc($result3);
        $_SESSION['branchRFC'] = $row3['rfc'];
        $_SESSION['branchName'] = $row3['name'];
        $_SESSION['branchAddress'] = $row3['address'];
        $_SESSION['branchNint'] = $row3['nint'];
        $_SESSION['branchNext'] = $row3['next'];
        $_SESSION['branchState'] = $row3['state'];
        $_SESSION['branchCity'] = $row3['city'];
        $_SESSION['branchCP'] = $row3['cp'];
        $_SESSION['branchReason'] = $row3['reason'];
        $_SESSION['branchPhone'] = $row3['phone'];
        $_SESSION['branchMail'] = $row3['mail'];
        $_SESSION['branchColony'] = $row3['colony'];
        
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
