 <?php
session_start();

require '../../connection/index.php';
require 'call.php';
  $queryNow = "UPDATE documents SET last_date = date_sub(NOW(), INTERVAL 300 HOUR_MINUTE) WHERE id=" . $_REQUEST['id'];
  $resultNow = mysqli_query($link,$queryNow) or die ('Consulta fallida: ' . mysqli_error($link));
  //$rowNow = mysqli_fetch_assoc($resultNow);
  $queryDandC = "SELECT D.last_date, D.invoice, D.id, D.id_invoice, D.last_digits, D.total, D.payment_method, C.rfc, C.name, C.address, C.noExt, C.noint, C.colony, C.city, C.state, C.pc, D.usocfdi FROM documents AS D INNER JOIN clients AS C ON D.id_client = C.id WHERE D.id=" . $_REQUEST['id'] ." LIMIT 1;";
  $resultDandC = mysqli_query($link,$queryDandC) or die ('Consulta fallida: ' . mysqli_error($link));
  $rowDandC = mysqli_fetch_assoc($resultDandC);
  $fecha_ = $rowDandC['last_date'];
  //$fecha_ = date("Y-m-d H:i:s", (strtotime ("-2 Hours")));
  //$fecha_ = date("Y-m-d H:i:s");
  $fecha_O = str_replace(" ", "T", $fecha_);
  $idInvoice = $rowDandC['id_invoice'];

  $name_xml = $rowDandC['invoice'] . $rowDandC['id'] . ".xml";
  $name_xml = "xmls/" . $name_xml;

  if ($idInvoice) {
    $numInvoice = $idInvoice;
    $count = strlen($numInvoice);
    switch ($count) {
      case 1:
      $folio = '0000' . $numInvoice;
        break;
      case 2:
      $folio = '000' . $numInvoice;
        break;
      case 3:
      $folio = '00' . $numInvoice;
        break;
      case 4:
      $folio = '0' . $numInvoice;
        break;
      case 5:
      $folio = '' . $numInvoice;
        break;
    }
  }

  $total = round($rowDandC['total'], 4);
  $subTotalX = ($total/116) * 100;
  $subTotal = round($subTotalX, 4);
  $IVA_totalX = ($total/116) * 16;
  $IVA_total = round($IVA_totalX, 4);

  $dom = new DOMDocument('1.0','UTF-8');

  $node_proof=$dom->createElement("cfdi:Comprobante");
  $node_proof->setAttribute("xmlns:cfdi","http://www.sat.gob.mx/cfd/3");
  $node_proof->setAttribute("xmlns:xs","http://www.w3.org/2001/XMLSchema");
  $node_proof->setAttribute("xmlns:xsi","http://www.w3.org/2001/XMLSchema-instance");

  $node_proof->setAttribute("xsi:schemaLocation","http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv33.xsd");
  
  $node_proof->setAttribute("Version","3.3");
  $node_proof->setAttribute("Serie","FA");
  $node_proof->setAttribute("Folio",$idInvoice);
  $node_proof->setAttribute("LugarExpedicion",$_SESSION['branchCP']);
  // $node_proof->setAttribute("LugarExpedicion",$_SESSION['branchCity']);
  // actualizacion 3.3
  // if ($rowDandC['last_digits']) {
  //   $node_proof->setAttribute("NumCtaPago",$rowDandC['last_digits']);
  // }
  // $node_proof->setAttribute("TipoCambio","1");
  $node_proof->setAttribute("Moneda","MXN");
  // $node_proof->setAttribute("Moneda","Pesos Mexicanos");
  $node_proof->setAttribute("Fecha",$fecha_O);
  // $node_proof->setAttribute("formaDePago","Pago en una sola exhibición");
  $node_proof->setAttribute("MetodoPago","PUE");
  $node_proof->setAttribute("NoCertificado","00001000000407885997");
  // $node_proof->setAttribute("Total",$total);
  if ($rowDandC['payment_method'] === 'Cheque Nominativo') {
    $node_proof->setAttribute("FormaPago","02");
  }
  else if ($rowDandC['payment_method'] === 'Tarjeta de Credito') {
    $node_proof->setAttribute("FormaPago","04");
  }
  else if ($rowDandC['payment_method'] === 'Tarjeta de Debito') {
    $node_proof->setAttribute("FormaPago","04");
  }
  else if ($rowDandC['payment_method'] === 'Deposito en Cuenta') {
    $node_proof->setAttribute("FormaPago","99");
  }
  else if ($rowDandC['payment_method'] === 'Pago en Efectivo') {
    $node_proof->setAttribute("FormaPago","01");
  }
  else if ($rowDandC['payment_method'] === 'Transferencia Electronica de Fondos') {
    $node_proof->setAttribute("FormaPago","03");
  }
  else if ($rowDandC['payment_method'] === 'No Identificado') {
    $node_proof->setAttribute("FormaPago","99");
  } else {
    $node_proof->setAttribute("FormaPago","99");
  }
  // $node_proof->setAttribute("tipoDeComprobante","ingreso");
  $node_proof->setAttribute("TipoDeComprobante","I");
  
  $node_sender = $node_proof->appendChild($dom->createElement("cfdi:Emisor"));
  $node_sender->setAttribute("Rfc",$_SESSION['branchRFC']);//VAAA671004LY0
  $node_sender->setAttribute("Nombre",$_SESSION['branchReason']);//Amanda Valencio Avila
  $node_sender->setAttribute("RegimenFiscal","612");
  // $node_dom_fiscal = $node_sender->appendChild($dom->createElement("cfdi:DomicilioFiscal"));
  // $node_dom_fiscal->setAttribute("calle",$_SESSION['branchAddress']);
  // $node_dom_fiscal->setAttribute("noExterior",$_SESSION['branchNext']);
  // $node_dom_fiscal->setAttribute("noInterior",$_SESSION['branchNint']);
  // $node_dom_fiscal->setAttribute("colonia",$_SESSION['branchColony']);
  // $node_dom_fiscal->setAttribute("localidad",$_SESSION['branchCity']);
  // $node_dom_fiscal->setAttribute("municipio",$_SESSION['branchCity']);
  // $node_dom_fiscal->setAttribute("estado",$_SESSION['branchState']);
  // $node_dom_fiscal->setAttribute("pais","México");
  // $node_dom_fiscal->setAttribute("codigoPostal",$_SESSION['branchCP']);
  // $node_regime_fiscal = $node_sender->appendChild($dom->createElement("cfdi:RegimenFiscal"));
  // $node_regime_fiscal->setAttribute("Regimen","Régimen de Personas Físicas con Actividades Empresariales y Profesionales.");
  $rfc = strtoupper($rowDandC['rfc']);
  $node_catch = $node_proof->appendChild($dom->createElement('cfdi:Receptor'));
  $node_catch->setAttribute("Rfc",$rfc);
  if($rowDandC['usocfdi'] != ""){
    $node_catch->setAttribute("UsoCFDI",$rowDandC['usocfdi']);
  } else {
    $node_catch->setAttribute("UsoCFDI","G01");
  }
  // $node_catch->setAttribute("nombre",$rowDandC['name']);
  // $node_dom_catch = $node_catch->appendChild($dom->createElement('cfdi:Domicilio'));
  // $node_dom_catch->setAttribute("calle",$rowDandC['address']);
  // $node_dom_catch->setAttribute("noExterior",$rowDandC['noExt']);
  // if (isset($rowDandC['noInt'])) {
  //   $node_dom_catch->setAttribute("noInterior",$rowDandC['noInt']);
  // }
  // $node_dom_catch->setAttribute("colonia",$rowDandC['colony']);
  // $node_dom_catch->setAttribute("localidad",$rowDandC['city']);
  // $node_dom_catch->setAttribute("municipio",$rowDandC['city']);
  // $node_dom_catch->setAttribute("estado",$rowDandC['state']);
  // $node_dom_catch->setAttribute("pais","México");
  // $node_dom_catch->setAttribute("codigoPostal",$rowDandC['pc']);

  // SELECT * FROM quoter AS Q 
  // INNER JOIN products AS P ON Q.id_product = P.id 
  // INNER JOIN catalog_sat AS C ON P.id_sat = C.id
  // WHERE Q.invoice ='FA08485' AND Q.id_branch = 0


  $queryQandP = "SELECT * FROM quoter AS Q INNER JOIN products AS P ON Q.id_product = P.id INNER JOIN catalog_sat AS C ON P.id_sat = C.id WHERE Q.invoice ='" . $rowDandC['invoice'] . "' AND Q.id_branch =" . $_SESSION['branchID'];
  $resultQandP = mysqli_query($link,$queryQandP) or die ('Consulta fallida: ' . mysqli_error($link));
  $node_concepts = $node_proof->appendChild($dom->createElement("cfdi:Conceptos"));
  $sinIVA = 0;
  $sumIvas = 0;
  while ($rowQandP = mysqli_fetch_assoc($resultQandP)) {
    $costUnit = $rowQandP['unit_cost'];
    $costUnitSIVA = ($costUnit/116) * 100;
    $CostUnitSIVA = round($costUnitSIVA, 4);
    $costPzs = $CostUnitSIVA * $rowQandP['amount'];
    $CostPzs = round($costPzs, 4);
    $sinIVA += $CostPzs;
    $ivaTot = $CostPzs * .16;
    $IVAtot = round($ivaTot, 4);
    $sumIvas += $IVAtot;

echo "Importe ".$IVAtot. " Base ".$CostPzs." <br > ";
    $node_concept = $node_concepts->appendChild($dom->createElement("cfdi:Concepto"));
    $node_concept->setAttribute("ClaveProdServ",$rowQandP['product_key']);
    $node_concept->setAttribute("ClaveUnidad",$rowQandP['unit_key']);
    $node_concept->setAttribute("Cantidad",$rowQandP['amount']);
    $node_concept->setAttribute("Unidad","Pieza");
    $node_concept->setAttribute("NoIdentificacion",$rowQandP['id_product']);
    $node_concept->setAttribute("Descripcion",$rowQandP['name']);
    $node_concept->setAttribute("ValorUnitario",$CostUnitSIVA);
    $node_concept->setAttribute("Importe",$CostPzs);

    $node_concept_imp = $node_concept->appendChild($dom->createElement("cfdi:Impuestos"));
    $node_concept_tras = $node_concept_imp->appendChild($dom->createElement("cfdi:Traslados"));
    $node_concept_tra = $node_concept_tras->appendChild($dom->createElement("cfdi:Traslado"));
    $node_concept_tra->setAttribute("Base",$CostPzs);
    $node_concept_tra->setAttribute("Impuesto","002");
    $node_concept_tra->setAttribute("TipoFactor","Tasa");
    $node_concept_tra->setAttribute("TasaOCuota","0.160000");
    $node_concept_tra->setAttribute("Importe",$IVAtot);
  }
  $totalC_IVA = $sinIVA * 1.16;
  $totalC_IVAX = round($totalC_IVA, 2);

  $node_proof->setAttribute("Total",$totalC_IVAX);
  $node_proof->setAttribute("SubTotal",$sinIVA);
  echo "Esto es el total ". $totalC_IVAX . " y esto es el subtotal " . $sinIVA . " y el iva tot es " . $sumIvas;
  $node_taxes = $node_proof->appendChild($dom->createElement("cfdi:Impuestos"));
  
  // $queryQandP = "SELECT * FROM quoter AS Q INNER JOIN products AS P ON Q.id_product = P.id WHERE Q.invoice ='" . $rowDandC['invoice'] . "'  AND Q.id_branch =" . $_SESSION['branchID'];
  // $resultQandP = mysqli_query($link,$queryQandP) or die ('Consulta fallida: ' . mysqli_error($link));
  $IVATOTAL = $sinIVA * .16;
  $IVA_total = round($IVATOTAL, 4);
  $node_taxes->setAttribute("TotalImpuestosTrasladados",$IVA_total);
  
  $node_transfers = $node_taxes->appendChild($dom->createElement("cfdi:Traslados"));
  $node_transfe = $node_transfers->appendChild($dom->createElement("cfdi:Traslado"));
  $node_transfe->setAttribute("Impuesto","002");
  $node_transfe->setAttribute("TipoFactor","Tasa");
  $node_transfe->setAttribute("TasaOCuota","0.160000");
  $node_transfe->setAttribute("Importe",$IVA_total);
  
  // $node_transfe->setAttribute("TotalImpuestosTrasladados",$IVA_total);
  
  
  // while ($rowQandP = mysqli_fetch_assoc($resultQandP)) {
  //   $totalPIVA = $rowQandP['unit_cost'] * $rowQandP['amount'];
  //   $importe = ($totalPIVA / 116) * 16;
  //   $import = round($importe, 2);

  //   $node_transfe = $node_transfers->appendChild($dom->createElement("cfdi:Traslado"));
  //   $node_transfe->setAttribute("impuesto","IVA");
  //   $node_transfe->setAttribute("tasa","16");
  //   $node_transfe->setAttribute("importe",$import);
  // }

  $dom->appendChild($node_proof);



  $cadenaOriginal = GetCadenaOriginal_3_3($dom);
  $sello = GetSelloDigital($cadenaOriginal, $fecha_O);

  $certificado = GetCertificado();

  $node_proof->setAttribute("Sello",$sello);
  $node_proof->setAttribute("Certificado",$certificado);
  $dom->formatOutput=true;

  $dom->save($name_xml);

  try{
      if(!SetTimbrado($name_xml))
      {
          unlink($name_xml);
          echo "Error en el timbrado";
          exit;
      }
  }
  catch(Exception $e)
  {
      unlink($name_xml);
      echo $e->getMessage();
      exit;
  }

  $doc = new DOMDocument();

  $doc->load($name_xml);
  // var_dump($doc);

  $Complemento = $doc->getElementsByTagName("Complemento");
  $timbre = $Complemento->item(0)->getElementsByTagName("TimbreFiscalDigital");
  $UUID = $timbre->item(0)->getAttribute('UUID');//
  $fechaTimbrado = $timbre->item(0)->getAttribute('FechaTimbrado');
  $selloSAT = $timbre->item(0)->getAttribute('SelloSAT');//
  $noCertificadoSat = $timbre->item(0)->getAttribute('NoCertificadoSAT');

  $izq = str_pad($importe[1], 6, "0", STR_PAD_LEFT);
  $der = str_pad($importe[0], 10, "0", STR_PAD_LEFT);

  include_once("phpqrcode/qrlib.php");
  $cadenaCodigoBarras = "?re=".$_SESSION['branchRFC']."&rr=" . $rfc . "&tt=" . $der . $izq . "&id=" . $UUID;

  if(!file_exists("cbb/" . $UUID . ".png")) {
    QRcode::png($cadenaCodigoBarras, "cbb/" . $UUID . ".png", 'L', 4, 2);
  }
  $noCertificado = '00001000000407885997';

  $query = "UPDATE documents SET uuid='" . $UUID . "', fechaTimbrado='" . $fechaTimbrado . "', selloSat='" . $selloSAT . "', noCertificado='" . $noCertificado . "', certificado='" . $certificado . "', sello='" . $sello . "', noCertificadoSat='" . $noCertificadoSat . "'  WHERE id=" . $_REQUEST['id'];
  $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));

  echo "Creado con exito";

?>
