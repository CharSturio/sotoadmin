<?php
session_start();

if($_SESSION['MovLisEli'] == 'true'){
    require '../../connection/index.php';
    function CancelarCFDI($fecha, $folio, $file) {
        header ('Content-type: text/html; charset=utf-8');
        ob_end_clean();

        include_once('cancelacion.class.php');

        $serv=new Cancelacion();
        $serv->usuario = "VAAA671004";
        $serv->password = "7388O_a14";
        $serv->rfc = "VAAA671004LY0";
        $serv->fecha = $fecha;
        $serv->folios = Array(
            0 => $folio
        );
        $serv->passwordkeys = "acoss551";

        // array bytes public key
        $handle = fopen("../keys/00001000000301099705.cer",'r');
        $contents = fread($handle,filesize("../keys/00001000000301099705.cer"));
        $serv->publicKey = $contents;

        // array bytes public key
        $handle = fopen("../keys/CSD_AMANDA_VALENCIANO_AVILA_VAAA671004LY0_20131021_130729.key",'r');
        $contents = fread($handle,filesize("../keys/CSD_AMANDA_VALENCIANO_AVILA_VAAA671004LY0_20131021_130729.key"));
        $serv->privateKey = $contents;


        //var_dump($serv->https->__getFunctions());
        //var_dump($serv->https->__getTypes());
        $serv->process();

          $error = $serv->Cancelacion_1Response->return->folios->folio->mensaje;

        switch($serv->Cancelacion_1Response->return->folios->folio->estatusUUID) {
            case "201":
                $dom = new DOMDocument();
                $dom->loadXML($serv->Cancelacion_1Response->return->acuse);
                $dom->save(str_replace(".xml", "_cancelado.xml", $file));
                return true;
                break;

            case "202":
                 throw new Exception($error . " [previamente cancelado]");
                break;

            case "203":
                 throw new Exception($error . " [emisor no corresponde]");
                break;

            case "204":
                 throw new Exception($error . " [no aplica para cancelacion]");
                break;
            case "205":
                 throw new Exception($error . " [UUID invalido]");
                break;
            default:
                 throw new Exception("Por el momento no se puede cancelar, intentelo mas tarde" . " [PAC]: Status" . $serv->Cancelacion_1Response->return->folios->folio->estatusUUID);
                break;
        }

    }
    $id = $_REQUEST['id'];
    $queryDandC = "SELECT * FROM documents WHERE id=" . $id . " LIMIT 1;";
    $resultDandC = mysqli_query($link,$queryDandC) or die ('Consulta fallida: ' . mysqli_error($link));
    $rowDandC = mysqli_fetch_assoc($resultDandC);
    $name_xml = $rowDandC['invoice'] . $rowDandC['id'] . ".xml";
    $name_xml = "xmls/" . $name_xml;
    if ($rowDandC['uuid']) {
      try
      {
          if(CancelarCFDI($rowDandC['fechaTimbrado'], $rowDandC['uuid'], $name_xml))
          {
            $query = "UPDATE documents SET status='cancelado' WHERE id=" . $id;
            $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
            $queryTemp = "DELETE FROM credit WHERE id_document =" . $id;
            $result = mysqli_query($link,$queryTemp) or die ('Consulta fallida: ' . mysqli_error($link));
              echo "cancelado";
          }
      }
      catch(Exception $e)
      {
          echo $e->getMessage();
          exit;
      }
    } else {
      $query = "UPDATE documents SET status='cancelado' WHERE id=" . $id;
      $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
      $queryTemp = "DELETE FROM credit WHERE id_document =" . $id;
      $result = mysqli_query($link,$queryTemp) or die ('Consulta fallida: ' . mysqli_error($link));
        echo "cancelado";
    }
} else {
echo 'noPermit';
}

?>
