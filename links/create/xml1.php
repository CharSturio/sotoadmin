<?php
require '../../connection/index.php';
require 'call.php';

  $queryDandC = "SELECT D.last_date, D.invoice, D.id, D.id_invoice, D.last_digits, D.total, D.payment_method, C.rfc, C.name, C.address, C.noExt, C.noint, C.colony, C.city, C.state, C.pc FROM documents AS D INNER JOIN clients AS C ON D.id_client = C.id WHERE D.id=" . $_REQUEST['id'] ." LIMIT 1;";
  $resultDandC = mysql_query($queryDandC) or die ('Consulta fallida: ' . mysql_error());
  $rowDandC = mysql_fetch_assoc($resultDandC);
  $fecha_ = $rowDandC['last_date'];
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

  $total = $rowDandC['total'];
  $subTotalX = ($total/116) * 100;
  $subTotal = round($subTotalX, 2);
  $IVA_totalX = ($total/116) * 16;
  $IVA_total = round($IVA_totalX, 2);

  $dom = new DOMDocument('1.0','UTF-8');
  $node_proof=$dom->createElement("cfdi:Comprobante");
  $node_proof->setAttribute("xmlns:cfdi","http://www.sat.gob.mx/cfd/3");
  $node_proof->setAttribute("xmlns:xsi","http://www.w3.org/2001/XMLSchema-instance");
  $node_proof->setAttribute("xsi:schemaLocation","http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv32.xsd");
  $node_proof->setAttribute("version","3.2");
  $node_proof->setAttribute("serie","FA");
  $node_proof->setAttribute("folio",$idInvoice);
  $node_proof->setAttribute("LugarExpedicion","Arandas");
  if ($rowDandC['last_digits']) {
    $node_proof->setAttribute("NumCtaPago",$rowDandC['last_digits']);
  }
  $node_proof->setAttribute("TipoCambio","1");
  $node_proof->setAttribute("Moneda","Pesos Mexicanos");
  $node_proof->setAttribute("fecha",$fecha_O);
  $node_proof->setAttribute("formaDePago","Pago en una sola exhibición");
  $node_proof->setAttribute("noCertificado","00001000000301099705");
  $node_proof->setAttribute("subTotal",$subTotal);
  $node_proof->setAttribute("total",$total);
  $node_proof->setAttribute("metodoDePago",$rowDandC['payment_method']);
  $node_proof->setAttribute("tipoDeComprobante","ingreso");

  $node_sender = $node_proof->appendChild($dom->createElement("cfdi:Emisor"));
  $node_sender->setAttribute("rfc","VAAA671004LY0");//VAAA671004LY0
  $node_sender->setAttribute("nombre","Amanda Valencio Avila");//Amanda Valencio Avila
  $node_dom_fiscal = $node_sender->appendChild($dom->createElement("cfdi:DomicilioFiscal"));
  $node_dom_fiscal->setAttribute("calle","Medina Ascencio");
  $node_dom_fiscal->setAttribute("noExterior","649");
  $node_dom_fiscal->setAttribute("noInterior","NA");
  $node_dom_fiscal->setAttribute("colonia","Santa Barbara");
  $node_dom_fiscal->setAttribute("localidad","Arandas");
  $node_dom_fiscal->setAttribute("municipio","Arandas");
  $node_dom_fiscal->setAttribute("estado","Jalisco");
  $node_dom_fiscal->setAttribute("pais","México");
  $node_dom_fiscal->setAttribute("codigoPostal","47180");
  $node_regime_fiscal = $node_sender->appendChild($dom->createElement("cfdi:RegimenFiscal"));
  $node_regime_fiscal->setAttribute("Regimen","Régimen de Personas Físicas con Actividades Empresariales y Profesionales.");
$rfc = strtoupper($rowDandC['rfc']);
  $node_catch = $node_proof->appendChild($dom->createElement('cfdi:Receptor'));
  $node_catch->setAttribute("rfc",$rfc);
  $node_catch->setAttribute("nombre",$rowDandC['name']);
  $node_dom_catch = $node_catch->appendChild($dom->createElement('cfdi:Domicilio'));
  $node_dom_catch->setAttribute("calle",$rowDandC['address']);
  $node_dom_catch->setAttribute("noExterior",$rowDandC['noExt']);
  if ($rowDandC['noInt']) {
    $node_dom_catch->setAttribute("noInterior",$rowDandC['noInt']);
  }
  $node_dom_catch->setAttribute("colonia",$rowDandC['colony']);
  $node_dom_catch->setAttribute("localidad",$rowDandC['city']);
  $node_dom_catch->setAttribute("municipio",$rowDandC['city']);
  $node_dom_catch->setAttribute("estado",$rowDandC['state']);
  $node_dom_catch->setAttribute("pais","México");
  $node_dom_catch->setAttribute("codigoPostal",$rowDandC['pc']);

  $queryQandP = "SELECT * FROM quoter AS Q INNER JOIN products AS P ON Q.id_product = P.id WHERE Q.invoice ='" . $rowDandC['invoice'] . "';";
  $resultQandP = mysql_query($queryQandP) or die ('Consulta fallida: ' . mysql_error());
  $node_concepts = $node_proof->appendChild($dom->createElement("cfdi:Conceptos"));
  while ($rowQandP = mysql_fetch_assoc($resultQandP)) {
    $costUnit = $rowQandP['unit_cost'];
    $costUnitSIVA = ($costUnit/116) * 100;
    $CostUnitSIVA = round($costUnitSIVA, 2);
    $costPzs = $costUnitSIVA * $rowQandP['amount'];
    $CostPzs = round($costPzs, 2);

    $node_concept = $node_concepts->appendChild($dom->createElement("cfdi:Concepto"));
    $node_concept->setAttribute("cantidad",$rowQandP['amount']);
    $node_concept->setAttribute("unidad","Pieza");
    $node_concept->setAttribute("noIdentificacion",$rowQandP['id_product']);
    $node_concept->setAttribute("descripcion",$rowQandP['name']);
    $node_concept->setAttribute("valorUnitario",$CostUnitSIVA);
    $node_concept->setAttribute("importe",$CostPzs);
  }
  $node_taxes = $node_proof->appendChild($dom->createElement("cfdi:Impuestos"));
  $queryQandP = "SELECT * FROM quoter AS Q INNER JOIN products AS P ON Q.id_product = P.id WHERE Q.invoice ='" . $rowDandC['invoice'] . "';";
  $resultQandP = mysql_query($queryQandP) or die ('Consulta fallida: ' . mysql_error());
  $node_taxes->setAttribute("totalImpuestosTrasladados",$IVA_total);
  $node_transfers = $node_taxes->appendChild($dom->createElement("cfdi:Traslados"));
  while ($rowQandP = mysql_fetch_assoc($resultQandP)) {
    $totalPIVA = $rowQandP['unit_cost'] * $rowQandP['amount'];
    $importe = ($totalPIVA / 116) * 16;
    $import = round($importe, 2);

    $node_transfe = $node_transfers->appendChild($dom->createElement("cfdi:Traslado"));
    $node_transfe->setAttribute("impuesto","IVA");
    $node_transfe->setAttribute("tasa","16");
    $node_transfe->setAttribute("importe",$import);
  }

  $dom->appendChild($node_proof);



  $cadenaOriginal = GetCadenaOriginal_3_2($dom);

  $sello = GetSelloDigital($cadenaOriginal, $fecha_O);

  $certificado = GetCertificado();

  $node_proof->setAttribute("sello",$sello);
  $node_proof->setAttribute("certificado",$certificado);
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

  $Complemento = $doc->getElementsByTagName("Complemento");
  $timbre = $Complemento->item(0)->getElementsByTagName("TimbreFiscalDigital");
  $UUID = $timbre->item(0)->getAttribute('UUID');
  $fechaTimbrado = $timbre->item(0)->getAttribute('FechaTimbrado');
  $selloSAT = $timbre->item(0)->getAttribute('selloSAT');
  $noCertificadoSat = $timbre->item(0)->getAttribute('noCertificadoSAT');

  $izq = str_pad($importe[1], 6, "0", STR_PAD_LEFT);
  $der = str_pad($importe[0], 10, "0", STR_PAD_LEFT);

  include_once("phpqrcode/qrlib.php");
  $cadenaCodigoBarras = "?re=VAAA671004LY0&rr=" . $rfc . "&tt=" . $der . $izq . "&id=" . $UUID;

  if(!file_exists("cbb/" . $UUID . ".png")) {
    QRcode::png($cadenaCodigoBarras, "cbb/" . $UUID . ".png", 'L', 4, 2);
  }
  $noCertificado = '00001000000301099705';

  $query = "UPDATE documents SET uuid='" . $UUID . "', fechaTimbrado='" . $fechaTimbrado . "', selloSat='" . $selloSAT . "', noCertificado='" . $noCertificado . "', certificado='" . $certificado . "', sello='" . $sello . "', noCertificadoSat='" . $noCertificadoSat . "'  WHERE id=" . $_REQUEST['id'];
  $result = mysql_query($query) or die ('Consulta fallida: ' . mysql_error());

  echo "Creado con exito";

?>
