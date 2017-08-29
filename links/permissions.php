<?php
  require '../connection/index.php';
  session_start();  

  $operation = $_REQUEST['operation'];
  if ($operation === 'new') {
    if($_SESSION['UtiPerCre']){
      $name= $_REQUEST['name'];
      $RegUsuGen= $_REQUEST['RegUsuGen'];
      $RegUsuCre = $_REQUEST['RegUsuCre'];
      $RegUsuMod = $_REQUEST['RegUsuMod'];
      $RegUsuEli = $_REQUEST['RegUsuEli'];
      $RegUsuVer = $_REQUEST['RegUsuVer'];
      $RegCliGen = $_REQUEST['RegCliGen'];
      $RegCliCre = $_REQUEST['RegCliCre'];
      $RegCliMod = $_REQUEST['RegCliMod'];
      $RegCliEli = $_REQUEST['RegCliEli'];
      $RegCliVer = $_REQUEST['RegCliVer'];
      $RegSucGen = $_REQUEST['RegSucGen'];
      $RegSucCre = $_REQUEST['RegSucCre'];
      $RegSucMod = $_REQUEST['RegSucMod'];
      $RegSucEli = $_REQUEST['RegSucEli'];
      $RegSucVer = $_REQUEST['RegSucVer'];
      $RegProGen = $_REQUEST['RegProGen'];
      $RegProCre = $_REQUEST['RegProCre'];
      $RegProMod = $_REQUEST['RegProMod'];
      $RegProModPre = $_REQUEST['RegProModPre'];
      $RegProEli = $_REQUEST['RegProEli'];
      $RegProVer = $_REQUEST['RegProVer'];
      $UtiCyCGen = $_REQUEST['UtiCyCGen'];
      $UtiCyCBus = $_REQUEST['UtiCyCBus'];
      $UtiCyCSeg = $_REQUEST['UtiCyCSeg'];
      $UtiCyCPag = $_REQUEST['UtiCyCPag'];
      $UtiCyCSegInt = $_REQUEST['UtiCyCSegInt'];
      $UtiEnvMerGen = $_REQUEST['UtiEnvMerGen'];
      $UtiEnvMerEnv = $_REQUEST['UtiEnvMerEnv'];
      $UtiCCGen = $_REQUEST['UtiCCGen'];
      $UtiCCCorCaj = $_REQUEST['UtiCCCorCaj'];
      $UtiCCPdf = $_REQUEST['UtiCCPdf'];
      $UtiCCEnv = $_REQUEST['UtiCCEnv'];
      $UtiEySCGen = $_REQUEST['UtiEySCGen'];
      $UtiEySCAgrSal = $_REQUEST['UtiEySCAgrSal'];
      $UtiEySCAgrEnt= $_REQUEST['UtiEySCAgrEnt'];
      $UtiStoMinGen = $_REQUEST['UtiStoMinGen'];
      $UtiStoMinEnv = $_REQUEST['UtiStoMinEnv'];
      $UtiPerGen = $_REQUEST['UtiPerGen'];
      $UtiPerCre = $_REQUEST['UtiPerCre'];
      $UtiPerMod = $_REQUEST['UtiPerMod'];
      $UtiPerEli = $_REQUEST['UtiPerEli'];
      $UtiPerVer = $_REQUEST['UtiPerVer'];
      $MovLisGen = $_REQUEST['MovLisGen'];
      $MovLisBus = $_REQUEST['MovLisBus'];
      $MovLisTim = $_REQUEST['MovLisTim'];
      $MovLisDes = $_REQUEST['MovLisDes'];
      $MovLisEnv = $_REQUEST['MovLisEnv'];
      $MovLisEli = $_REQUEST['MovLisEli'];
      $MovCotGen = $_REQUEST['MovCotGen'];
      $MovCotBusCli = $_REQUEST['MovCotBusCli'];
      $MovCotBusPro = $_REQUEST['MovCotBusPro'];
      $MovCotFac = $_REQUEST['MovCotFac'];
      $MovCotRem = $_REQUEST['MovCotRem'];
      $MovCotCre = $_REQUEST['MovCotCre'];
      $MovCotCan = $_REQUEST['MovCotCan'];
      $MovInvGen = $_REQUEST['MovInvGen'];
      $MovInvBus = $_REQUEST['MovInvBus'];
      $MovInvMod = $_REQUEST['MovInvMod'];
      $MovInvEntDev = $_REQUEST['MovInvEntDev'];
      $MovInvSalDev = $_REQUEST['MovInvSalDev'];
      $MovEntMerBus = $_REQUEST['MovEntMerBus'];
      $MovEntMerGen = $_REQUEST['MovEntMerGen'];
      $MovEntMerAgr = $_REQUEST['MovEntMerAgr'];
      $RepFacGen = $_REQUEST['RepFacGen'];
      $RepFacVer = $_REQUEST['RepFacVer'];
      $RepFacDes = $_REQUEST['RepFacDes'];
      $RepMerCInvGen = $_REQUEST['RepMerCInvGen'];
      $RepMerCInvVer = $_REQUEST['RepMerCInvVer'];
      $RepMerCInvDes = $_REQUEST['RepMerCInvDes'];
      $RepMerSInvGen = $_REQUEST['RepMerSInvGen'];
      $RepMerSInvVer = $_REQUEST['RepMerSInvVer'];
      $RepMerSInvDes = $_REQUEST['RepMerSInvDes'];
      $RepMerCCosGen = $_REQUEST['RepMerCCosGen'];
      $RepMerCCosVer = $_REQUEST['RepMerCCosVer'];
      $RepMerCCosDes = $_REQUEST['RepMerCCosDes'];
      $query = "SELECT * FROM permissions where name='" . $name ."';";
      $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
      if (mysqli_fetch_assoc($result)) {
        echo 'El permiso ya existe. Favor de intentar con otro nombre.';
      } else {
        $query = "INSERT INTO permissions (name, RegUsuGen, RegUsuCre, RegUsuMod, RegUsuEli, RegUsuVer, RegCliGen, RegCliCre, RegCliMod, RegCliEli, RegCliVer, RegSucGen, RegSucCre, RegSucMod, RegSucEli, RegSucVer, RegProGen, RegProCre, RegProMod, RegProModPre, RegProEli, RegProVer, UtiCyCGen, UtiCyCBus, UtiCyCSeg, UtiCyCPag, UtiCyCSegInt, UtiEnvMerGen, UtiEnvMerEnv, UtiCCGen, UtiCCCorCaj, UtiCCPdf, UtiCCEnv, UtiEySCGen, UtiEySCAgrSal, UtiEySCAgrEnt, UtiStoMinGen, UtiStoMinEnv, UtiPerGen, UtiPerCre, UtiPerMod, UtiPerEli, UtiPerVer, MovLisGen, MovLisBus, MovLisTim, MovLisDes, MovLisEnv, MovLisEli, MovCotGen, MovCotBusCli, MovCotBusPro, MovCotFac, MovCotRem, MovCotCre, MovCotCan, MovInvGen, MovInvBus, MovInvMod, MovInvEntDev, MovInvSalDev, MovEntMerGen, MovEntMerBus, MovEntMerAgr, RepFacGen, RepFacVer, RepFacDes, RepMerCInvGen, RepMerCInvVer, RepMerCInvDes, RepMerSInvGen, RepMerSInvVer, RepMerSInvDes, RepMerCCosGen, RepMerCCosVer, RepMerCCosDes, last_date) VALUES('" . $name ."',".$RegUsuGen.",".$RegUsuCre.",".$RegUsuMod.",".$RegUsuEli.",".$RegUsuVer.",".$RegCliGen.",".$RegCliCre.",".$RegCliMod.",".$RegCliEli.",".$RegCliVer.",".$RegSucGen.",".$RegSucCre.",".$RegSucMod.",".$RegSucEli.",".$RegSucVer.",".$RegProGen.",".$RegProCre.",".$RegProMod.",".$RegProModPre.",".$RegProEli.",".$RegProVer.",".$UtiCyCGen.",".$UtiCyCBus.",".$UtiCyCSeg.",".$UtiCyCPag.",".$UtiCyCSegInt.",".$UtiEnvMerGen.",".$UtiEnvMerEnv.",".$UtiCCGen.",".$UtiCCCorCaj.",".$UtiCCPdf.",".$UtiCCEnv.",".$UtiEySCGen.",".$UtiEySCAgrSal.",".$UtiEySCAgrEnt.",".$UtiStoMinGen.",".$UtiStoMinEnv.",".$UtiPerGen.",".$UtiPerCre.",".$UtiPerMod.",".$UtiPerEli.",".$UtiPerVer.",".$MovLisGen.",".$MovLisBus.",".$MovLisTim.",".$MovLisDes.",".$MovLisEnv.",".$MovLisEli.",".$MovCotGen.",".$MovCotBusCli.",".$MovCotBusPro.",".$MovCotFac.",".$MovCotRem.",".$MovCotCre.",".$MovCotCan.",".$MovInvGen.",".$MovInvBus.",".$MovInvMod.",".$MovInvEntDev.",".$MovInvSalDev.",".$MovEntMerBus.",".$MovEntMerGen.",".$MovEntMerAgr.",".$RepFacGen.",".$RepFacVer.",".$RepFacDes.",".$RepMerCInvGen.",".$RepMerCInvVer.",".$RepMerCInvDes.",".$RepMerSInvGen.",".$RepMerSInvVer.",".$RepMerSInvDes.",".$RepMerCCosGen.",".$RepMerCCosVer.",".$RepMerCCosDes.",date_sub(NOW(), INTERVAL 300 HOUR_MINUTE))";
        //$query = "INSERT INTO permissions (name, rfc, address, nint, next, state, city, cp, reason, last_date) VALUES('" . $name ."','" . $rfc . "','" . $address . "','" . $nint . "','" . $next . "','" . $state . "','" . $city . "','" . $cp . "','" . $reason . "',date_sub(NOW(), INTERVAL 300 HOUR_MINUTE));";
        $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
        echo 'Sucursal agregada.';
      }
    } else {
      echo 'noPermit';
    }

  } else if ($operation === 'modify') {
    if($_SESSION['UtiPerMod']){
      $query = "UPDATE permissions SET";
      if ($_REQUEST['name']) {
        $query .= " name='" . $_REQUEST['name'] . "',";
      }
      if ($_REQUEST['RegUsuGen']) {
        $query .= " RegUsuGen=" . $_REQUEST['RegUsuGen'] . ",";
      }
      if ($_REQUEST['RegUsuCre']) {
        $query .= " RegUsuCre=" . $_REQUEST['RegUsuCre'] . ",";
      }
      if ($_REQUEST['RegUsuMod']) {
        $query .= " RegUsuMod=" . $_REQUEST['RegUsuMod'] . ",";
      }
      if ($_REQUEST['RegUsuEli']) {
        $query .= " RegUsuEli=" . $_REQUEST['RegUsuEli'] . ",";
      }
      if ($_REQUEST['RegUsuVer']) {
        $query .= " RegUsuVer=" . $_REQUEST['RegUsuVer'] . ",";
      }
      if ($_REQUEST['RegCliGen']) {
        $query .= " RegCliGen=" . $_REQUEST['RegCliGen'] . ",";
      }
      if ($_REQUEST['RegCliCre']) {
        $query .= " RegCliCre=" . $_REQUEST['RegCliCre'] . ",";
      }
      if ($_REQUEST['RegCliMod']) {
        $query .= " RegCliMod=" . $_REQUEST['RegCliMod'] . ",";
      }
      if ($_REQUEST['RegCliEli']) {
        $query .= " RegCliEli=" . $_REQUEST['RegCliEli'] . ",";
      }
      if ($_REQUEST['RegCliVer']) {
        $query .= " RegCliVer=" . $_REQUEST['RegCliVer'] . ",";
      }
      if ($_REQUEST['RegSucGen']) {
        $query .= " RegSucGen=" . $_REQUEST['RegSucGen'] . ",";
      }
      if ($_REQUEST['RegSucCre']) {
        $query .= " RegSucCre=" . $_REQUEST['RegSucCre'] . ",";
      }
      if ($_REQUEST['RegSucMod']) {
        $query .= " RegSucMod=" . $_REQUEST['RegSucMod'] . ",";
      }
      if ($_REQUEST['RegSucEli']) {
        $query .= " RegSucEli=" . $_REQUEST['RegSucEli'] . ",";
      }
      if ($_REQUEST['RegSucVer']) {
        $query .= " RegSucVer=" . $_REQUEST['RegSucVer'] . ",";
      }
      if ($_REQUEST['RegProGen']) {
        $query .= " RegProGen=" . $_REQUEST['RegProGen'] . ",";
      }
      if ($_REQUEST['RegProCre']) {
        $query .= " RegProCre=" . $_REQUEST['RegProCre'] . ",";
      }
      if ($_REQUEST['RegProMod']) {
        $query .= " RegProMod=" . $_REQUEST['RegProMod'] . ",";
      }
      if ($_REQUEST['RegProModPre']) {
        $query .= " RegProModPre=" . $_REQUEST['RegProModPre'] . ",";
      }
      if ($_REQUEST['RegProEli']) {
        $query .= " RegProEli=" . $_REQUEST['RegProEli'] . ",";
      }
      if ($_REQUEST['RegProVer']) {
        $query .= " RegProVer=" . $_REQUEST['RegProVer'] . ",";
      }
      if ($_REQUEST['UtiCyCGen']) {
        $query .= " UtiCyCGen=" . $_REQUEST['UtiCyCGen'] . ",";
      }
      if ($_REQUEST['UtiCyCBus']) {
        $query .= " UtiCyCBus=" . $_REQUEST['UtiCyCBus'] . ",";
      }
      if ($_REQUEST['UtiCyCSeg']) {
        $query .= " UtiCyCSeg=" . $_REQUEST['UtiCyCSeg'] . ",";
      }
      if ($_REQUEST['UtiCyCPag']) {
        $query .= " UtiCyCPag=" . $_REQUEST['UtiCyCPag'] . ",";
      }
      if ($_REQUEST['UtiCyCSegInt']) {
        $query .= " UtiCyCSegInt=" . $_REQUEST['UtiCyCSegInt'] . ",";
      }
      if ($_REQUEST['UtiEnvMerGen']) {
        $query .= " UtiEnvMerGen=" . $_REQUEST['UtiEnvMerGen'] . ",";
      }
      if ($_REQUEST['UtiEnvMerEnv']) {
        $query .= " UtiEnvMerEnv=" . $_REQUEST['UtiEnvMerEnv'] . ",";
      }
      if ($_REQUEST['UtiCCGen']) {
        $query .= " UtiCCGen=" . $_REQUEST['UtiCCGen'] . ",";
      }
      if ($_REQUEST['UtiCCCorCaj']) {
        $query .= " UtiCCCorCaj=" . $_REQUEST['UtiCCCorCaj'] . ",";
      }
      if ($_REQUEST['UtiCCPdf']) {
        $query .= " UtiCCPdf=" . $_REQUEST['UtiCCPdf'] . ",";
      }
      if ($_REQUEST['UtiCCEnv']) {
        $query .= " UtiCCEnv=" . $_REQUEST['UtiCCEnv'] . ",";
      }
      if ($_REQUEST['UtiEySCGen']) {
        $query .= " UtiEySCGen=" . $_REQUEST['UtiEySCGen'] . ",";
      }
      if ($_REQUEST['UtiEySCAgrSal']) {
        $query .= " UtiEySCAgrSal=" . $_REQUEST['UtiEySCAgrSal'] . ",";
      }
      if ($_REQUEST['UtiEySCAgrEnt']) {
        $query .= " UtiEySCAgrEnt=" . $_REQUEST['UtiEySCAgrEnt'] . ",";
      }
      if ($_REQUEST['UtiStoMinGen']) {
        $query .= " UtiStoMinGen=" . $_REQUEST['UtiStoMinGen'] . ",";
      }
      if ($_REQUEST['UtiStoMinEnv']) {
        $query .= " UtiStoMinEnv=" . $_REQUEST['UtiStoMinEnv'] . ",";
      }
      if ($_REQUEST['UtiPerGen']) {
        $query .= " UtiPerGen=" . $_REQUEST['UtiPerGen'] . ",";
      }
      if ($_REQUEST['UtiPerCre']) {
        $query .= " UtiPerCre=" . $_REQUEST['UtiPerCre'] . ",";
      }
      if ($_REQUEST['UtiPerMod']) {
        $query .= " UtiPerMod=" . $_REQUEST['UtiPerMod'] . ",";
      }
      if ($_REQUEST['UtiPerEli']) {
        $query .= " UtiPerEli=" . $_REQUEST['UtiPerEli'] . ",";
      }
      if ($_REQUEST['UtiPerVer']) {
        $query .= " UtiPerVer=" . $_REQUEST['UtiPerVer'] . ",";
      }
      if ($_REQUEST['MovLisGen']) {
        $query .= " MovLisGen=" . $_REQUEST['MovLisGen'] . ",";
      }
      if ($_REQUEST['MovLisBus']) {
        $query .= " MovLisBus=" . $_REQUEST['MovLisBus'] . ",";
      }
      if ($_REQUEST['MovLisTim']) {
        $query .= " MovLisTim=" . $_REQUEST['MovLisTim'] . ",";
      }
      if ($_REQUEST['MovLisDes']) {
        $query .= " MovLisDes=" . $_REQUEST['MovLisDes'] . ",";
      }
      if ($_REQUEST['MovLisEnv']) {
        $query .= " MovLisEnv=" . $_REQUEST['MovLisEnv'] . ",";
      }
      if ($_REQUEST['MovLisEli']) {
        $query .= " MovLisEli=" . $_REQUEST['MovLisEli'] . ",";
      }
      if ($_REQUEST['MovCotGen']) {
        $query .= " MovCotGen=" . $_REQUEST['MovCotGen'] . ",";
      }
      if ($_REQUEST['MovCotBusCli']) {
        $query .= " MovCotBusCli=" . $_REQUEST['MovCotBusCli'] . ",";
      }
      if ($_REQUEST['MovCotBusPro']) {
        $query .= " MovCotBusPro=" . $_REQUEST['MovCotBusPro'] . ",";
      }
      if ($_REQUEST['MovCotFac']) {
        $query .= " MovCotFac=" . $_REQUEST['MovCotFac'] . ",";
      }
      if ($_REQUEST['MovCotRem']) {
        $query .= " MovCotRem=" . $_REQUEST['MovCotRem'] . ",";
      }
      if ($_REQUEST['MovCotCre']) {
        $query .= " MovCotCre=" . $_REQUEST['MovCotCre'] . ",";
      }
      if ($_REQUEST['MovCotCan']) {
        $query .= " MovCotCan=" . $_REQUEST['MovCotCan'] . ",";
      }
      if ($_REQUEST['MovInvGen']) {
        $query .= " MovInvGen=" . $_REQUEST['MovInvGen'] . ",";
      }
      if ($_REQUEST['MovInvBus']) {
        $query .= " MovInvBus=" . $_REQUEST['MovInvBus'] . ",";
      }
      if ($_REQUEST['MovInvMod']) {
        $query .= " MovInvMod=" . $_REQUEST['MovInvMod'] . ",";
      }
      if ($_REQUEST['MovInvEntDev']) {
        $query .= " MovInvEntDev=" . $_REQUEST['MovInvEntDev'] . ",";
      }
      if ($_REQUEST['MovInvSalDev']) {
        $query .= " MovInvSalDev=" . $_REQUEST['MovInvSalDev'] . ",";
      }
      if ($_REQUEST['MovEntMerBus']) {
        $query .= " MovEntMerBus=" . $_REQUEST['MovEntMerBus'] . ",";
      }
      if ($_REQUEST['MovEntMerGen']) {
        $query .= " MovEntMerGen=" . $_REQUEST['MovEntMerGen'] . ",";
      }
      if ($_REQUEST['MovEntMerAgr']) {
        $query .= " MovEntMerAgr=" . $_REQUEST['MovEntMerAgr'] . ",";
      }
      if ($_REQUEST['RepFacGen']) {
        $query .= " RepFacGen=" . $_REQUEST['RepFacGen'] . ",";
      }
      if ($_REQUEST['RepFacVer']) {
        $query .= " RepFacVer=" . $_REQUEST['RepFacVer'] . ",";
      }
      if ($_REQUEST['RepFacDes']) {
        $query .= " RepFacDes=" . $_REQUEST['RepFacDes'] . ",";
      }
      if ($_REQUEST['RepMerCInvGen']) {
        $query .= " RepMerCInvGen=" . $_REQUEST['RepMerCInvGen'] . ",";
      }
      if ($_REQUEST['RepMerCInvVer']) {
        $query .= " RepMerCInvVer=" . $_REQUEST['RepMerCInvVer'] . ",";
      }
      if ($_REQUEST['RepMerCInvDes']) {
        $query .= " RepMerCInvDes=" . $_REQUEST['RepMerCInvDes'] . ",";
      }
      if ($_REQUEST['RepMerSInvGen']) {
        $query .= " RepMerSInvGen=" . $_REQUEST['RepMerSInvGen'] . ",";
      }
      if ($_REQUEST['RepMerSInvVer']) {
        $query .= " RepMerSInvVer=" . $_REQUEST['RepMerSInvVer'] . ",";
      }
      if ($_REQUEST['RepMerSInvDes']) {
        $query .= " RepMerSInvDes=" . $_REQUEST['RepMerSInvDes'] . ",";
      }
      if ($_REQUEST['RepMerCCosGen']) {
        $query .= " RepMerCCosGen=" . $_REQUEST['RepMerCCosGen'] . ",";
      }
      if ($_REQUEST['RepMerCCosVer']) {
        $query .= " RepMerCCosVer=" . $_REQUEST['RepMerCCosVer'] . ",";
      }
      if ($_REQUEST['RepMerCCosDes']) {
        $query .= " RepMerCCosDes=" . $_REQUEST['RepMerCCosDes'] . ",";
      }
      $query .= " last_date=date_sub(NOW(), INTERVAL 300 HOUR_MINUTE) WHERE name='" . $_REQUEST['id'] . "';";
      $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
      echo 'Actualizado correctamente.';
    } else {
      echo 'noPermit';
    }
  } else if ($operation === 'delete') {
    if($_SESSION['UtiPerEli']){
      $query .= "DELETE FROM permissions WHERE id=" . $_REQUEST['id'] . ";";
      $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
      echo 'Eliminado correctamente.';
    } else {
      echo 'noPermit';
    }
  } else if ($operation === 'permissions') {
    if($_SESSION['UtiPerVer']){
      $query = "SELECT id, name FROM permissions;";
      $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
      while ($row = mysqli_fetch_assoc($result)) {
        echo '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
      }
    } else {
      echo 'noPermit';
    }
  } else if ($operation === 'selectpermissions') {
    $id = $_REQUEST['id'];
    $query = "SELECT * FROM permissions where id=" . $id . ";";
    $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
    $row = mysqli_fetch_assoc($result);

    echo $row['name'] . ',' . $row['RegUsuGen'] . ',' . $row['RegUsuCre'] . ',' . $row['RegUsuMod'] . ',' . $row['RegUsuEli'] . ',' . $row['RegUsuVer'] . ',' . $row['RegCliGen'] . ',' . $row['RegCliCre'] . ',' . $row['RegCliMod'] . ',' . $row['RegCliEli'] . ',' . $row['RegCliVer'] . ',' . $row['RegSucGen'] . ',' . $row['RegSucCre'] . ',' . $row['RegSucMod'] . ',' . $row['RegSucEli'] . ',' . $row['RegSucVer'] . ',' . $row['RegProGen'] . ',' . $row['RegProCre'] . ',' . $row['RegProMod'] . ',' . $row['RegProModPre'] . ',' . $row['RegProEli'] . ',' . $row['RegProVer'] . ',' . $row['UtiCyCGen'] . ',' . $row['UtiCyCBus'] . ',' . $row['UtiCyCSeg'] . ',' . $row['UtiCyCPag'] . ',' . $row['UtiCyCSegInt'] . ',' . $row['UtiEnvMerGen'] . ',' . $row['UtiEnvMerEnv'] . ',' . $row['UtiCCGen'] . ',' . $row['UtiCCCorCaj'] . ',' . $row['UtiCCPdf'] . ',' . $row['UtiCCEnv'] . ',' . $row['UtiEySCGen'] . ',' . $row['UtiEySCAgrSal'] . ',' . $row['UtiEySCAgrEnt'] . ',' . $row['UtiStoMinGen'] . ',' . $row['UtiStoMinEnv'] . ',' . $row['UtiPerGen'] . ',' . $row['UtiPerCre'] . ',' . $row['UtiPerMod'] . ',' . $row['UtiPerEli'] . ',' . $row['UtiPerVer'] . ',' . $row['MovLisGen'] . ',' . $row['MovLisBus'] . ',' . $row['MovLisTim'] . ',' . $row['MovLisDes'] . ',' . $row['MovLisEnv'] . ',' . $row['MovLisEli'] . ',' . $row['MovCotGen'] . ',' . $row['MovCotBusCli'] . ',' . $row['MovCotBusPro'] . ',' . $row['MovCotFac'] . ',' . $row['MovCotRem'] . ',' . $row['MovCotCre'] . ',' . $row['MovCotCan'] . ',' . $row['MovInvGen'] . ',' . $row['MovInvBus'] . ',' . $row['MovInvMod'] . ',' . $row['MovInvEntDev'] . ',' . $row['MovInvSalDev'] . ',' . $row['MovEntMerGen'] . ',' . $row['MovEntMerBus'] . ',' . $row['MovEntMerAgr'] . ',' . $row['RepFacGen'] . ',' . $row['RepFacVer'] . ',' . $row['RepFacDes'] . ',' . $row['RepMerCInvGen'] . ',' . $row['RepMerCInvVer'] . ',' . $row['RepMerCInvDes'] . ',' . $row['RepMerSInvGen'] . ',' . $row['RepMerSInvVer'] . ',' . $row['RepMerSInvDes'] . ',' . $row['RepMerCCosGen'] . ',' . $row['RepMerCCosVer'] . ',' . $row['RepMerCCosDes'];
  }
   mysqli_close($link);
 ?>
