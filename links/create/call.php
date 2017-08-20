<?php
class Autenticar{
  public $usuario;
  public $contraseña;
}

class Timbrar{
  public $cfd;
  public $token;
}
function SetTimbrado($fileName) {
    header ('Content-type: text/html; charset=utf-8');
    try {
        set_time_limit(0);
        $XML = new DOMDocument();
        $XML->load($fileName);
        //$client = new SoapClient('https://dev.facturacfdi.mx:8081/WSTimbrado/WSForcogsaService?wsdl');
        $client = new SoapClient('https://www.facturacfdi.mx/WSTimbrado/WSForcogsaService?wsdl');
        $autentica = new Autenticar();
        $autentica->usuario = "VAAA671004";
        $autentica->contrasena = "7388O_a14";

        $responseAutentica = $client->Autenticar($autentica);
        echo $responseAutentica->return->mensaje . "<br>";
    		echo $responseAutentica->return->token . "<br>";
        /* se manda el xml a timbrar */
        $timbrar = new Timbrar();
    		$timbrar->cfd = $XML->saveXML();
    		$timbrar->token = $responseAutentica->return->token;

        /* cacha la respuesta */
        $responseTimbre = $client->Timbrar($timbrar);
        echo "<br><br><br>MSG SOAP REQUEST:<br><br>" . $client->__getLastRequest() . "\n";
    		echo "<br><br><br>MSG SOAP REQUEST:<br><br>" . $client->__getLastResponse() . "\n";


        echo "codigoErr:" . $responseTimbre->return->codigo . "<br>";
    		echo $responseTimbre->return->mensaje . "<br>";
    		echo $responseTimbre->return->cfdi . "<br>";


        if(isset($responseTimbre->return->codigo) && $responseTimbre->return->codigo != "" && $responseTimbre->return->codigo <> 0) {
            throw new Exception($responseTimbre->return->mensaje);
            return false;
        } else {
            $dom = new DOMDocument();
            $dom->loadXML($responseTimbre->return->cfdi);
            $dom->save($fileName);
            return true;
        }


    } catch (SoapFault $e) {
        throw new Exception($e->getMessage());
    }
}

function CancelarCFDI($fecha, $folio, $file) {
    header ('Content-type: text/html; charset=utf-8');
    ob_end_clean();

    include_once('cancelacion.class.php');

    $serv=new Cancelacion();
    $serv->usuario = "pruebasWS";
    $serv->password = "pruebasWS";
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
function GetCadenaOriginal_3_2($xml_Original) {
      if($xml_Original) {
          $str_xml = $xml_Original->saveXML();
          $xml = new DOMDocument();
          $xml->loadXML($str_xml);

          $obj_xsl = new DOMDocument();
          $obj_xsl->load("http://www.sat.gob.mx/sitio_internet/cfd/3/cadenaoriginal_3_2/cadenaoriginal_3_2.xslt", LIBXML_NOCDATA);

          error_reporting(0);

          $obj_xslt = new XSLTProcessor();
          $obj_xslt->importStylesheet($obj_xsl);

          error_reporting(E_ALL);
          $tmp_CadOrig = $obj_xslt->transformToXml($xml);

          return $tmp_CadOrig;
      }
  }

  //funcion para obtener el sello digital
  function GetSelloDigital($CadenaOrig) {
      //obtenemos la ruta del archivo key ya transformado
      //sablot.dll, expat.dll, and iconv.dll
      $archivo_pem = "../keys/CSD_AMANDA_VALENCIANO_AVILA_VAAA671004LY0_20131021_130729.key.pem";
      //$archivo_pem = "../keys/CSD01_AAA010101AAA.key.pem";
      $pkeyid = openssl_get_privatekey(file_get_contents($archivo_pem));
      //md5
      openssl_sign($CadenaOrig,$res_sig,$pkeyid,OPENSSL_ALGO_MD5);
      //sha1
      openssl_sign($CadenaOrig,$res_sig,$pkeyid,OPENSSL_ALGO_SHA1);
      openssl_free_key($pkeyid);

      $sello=base64_encode($res_sig);
      return $sello;
  }

  //funcion para obtener el certificado
  function GetCertificado() {
      $archivo_pem = "../keys/00001000000301099705.cer.pem";
      //$archivo_pem = "../keys/CSD01_AAA010101AAA.cer.pem";
      $datos=file($archivo_pem);
      $certificado = "";
      $carga =false;
      for($i=0;$i<sizeof($datos);$i++) {
        if (strstr($datos[$i],"END CERTIFICATE")) $carga=false;
        if ($carga) $certificado .= trim($datos[$i]);
        if (strstr($datos[$i],"BEGIN CERTIFICATE")) $carga=true;
      }
      return $certificado;
  }
?>
