<?php
session_start();

require '../../connection/index.php';
require 'call.php';
  $queryNow = "UPDATE documents SET last_date = date_sub(NOW(), INTERVAL 300 HOUR_MINUTE) WHERE id=" . $_REQUEST['id'];
  $resultNow = mysqli_query($link,$queryNow) or die ('Consulta fallida: ' . mysqli_error($link));
  //$rowNow = mysqli_fetch_assoc($resultNow);
  $queryDandC = "SELECT D.last_date, D.invoice, D.id, D.id_invoice, D.last_digits, D.total, D.payment_method, C.rfc, C.name, C.address, C.noExt, C.noint, C.colony, C.city, C.state, C.pc, C.phone, C.email FROM documents AS D INNER JOIN clients AS C ON D.id_client = C.id WHERE D.id=" . $_REQUEST['id'] ." LIMIT 1;";
  $resultDandC = mysqli_query($link,$queryDandC) or die ('Consulta fallida: ' . mysqli_error($link));
  $rowDandC = mysqli_fetch_assoc($resultDandC);

  if ($rowDandC['name'] && $rowDandC['address'] && $rowDandC['colony'] && $rowDandC['state'] && $rowDandC['rfc'] && $rowDandC['pc'] && $rowDandC['city'] && $rowDandC['phone'] && $rowDandC['noExt']) {

    //$fecha_ = $rowDandC['last_date'];
    //$fecha_ = date("Y-m-d H:i:s", (strtotime ("-2 Hours")));
    $fecha_ = date("Y-m-d H:i:s");
    // $fecha_explode = explode(":", $fecha_);
    // $fecha_explode_hour = explode(" ", $fecha_explode[0]);
    // $hour_good = $fecha_explode_hour[1] - 2;
    // $fecha_b = $fecha_explode_hour[0] . " ". $hour_good . ":" . $fecha_explode[1] . ":" . $fecha_explode[2];
    // echo $fecha_b;
    $fecha_O = str_replace(" ", "T", $fecha_);
    echo "..".$fecha_O;
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
    echo 'total' . $total . 'subtotal' . $subTotal . 'iva total' . $IVA_total;
    //$total =

    $dom = new DOMDocument('1.0','UTF-8');
    $node_proof=$dom->createElement("cfdi:Comprobante");
    $node_proof->setAttribute("xmlns:cfdi","http://www.sat.gob.mx/cfd/3");
    $node_proof->setAttribute("xmlns:xsi","http://www.w3.org/2001/XMLSchema-instance");
    $node_proof->setAttribute("xsi:schemaLocation","http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv32.xsd");
    $node_proof->setAttribute("version","3.2");
    $node_proof->setAttribute("serie","CR");
    $node_proof->setAttribute("folio",$idInvoice);
    $node_proof->setAttribute("LugarExpedicion",$_SESSION['branchCity']);
    if ($rowDandC['last_digits']) {
      $node_proof->setAttribute("NumCtaPago",$rowDandC['last_digits']);
    }
    $node_proof->setAttribute("TipoCambio","1");
    $node_proof->setAttribute("Moneda","Pesos Mexicanos");
    $node_proof->setAttribute("fecha",$fecha_O);
    $node_proof->setAttribute("formaDePago","Pago en una sola exhibición");
    $node_proof->setAttribute("noCertificado","00001000000301099705");


    $queryQandPX = "SELECT * FROM quoter AS Q INNER JOIN products AS P ON Q.id_product = P.id WHERE Q.invoice ='" . $rowDandC['invoice'] . "';";
    $resultQandPX = mysqli_query($link,$queryQandPX) or die ('Consulta fallida: ' . mysqli_error($link));
    $totalS_IVA = 0;
    while ($rowQandP = mysqli_fetch_assoc($resultQandPX)) {
      $costUnitX = $rowQandP['unit_cost'];
      $costUnitSIVAX = ($costUnitX/116) * 100;
      $CostUnitSIVAX = round($costUnitSIVAX, 2);
      $costPzsX = $CostUnitSIVAX * $rowQandP['amount'];
      $CostPzsX = round($costPzsX, 2);
      $totalS_IVA += $CostPzsX;
    }
    $totalC_IVA = $totalS_IVA * 1.16;
    $totalC_IVAX = round($totalC_IVA, 2);



    $node_proof->setAttribute("subTotal",$totalS_IVA);
    $node_proof->setAttribute("total",$totalC_IVAX);
    if ($rowDandC['payment_method'] === 'Cheque Nominativo') {
      $node_proof->setAttribute("metodoDePago","02");
    }
    else if ($rowDandC['payment_method'] === 'Tarjeta de Credito') {
      $node_proof->setAttribute("metodoDePago","04");
    }
    else if ($rowDandC['payment_method'] === 'Tarjeta de Debito') {
      $node_proof->setAttribute("metodoDePago","28");
    }
    else if ($rowDandC['payment_method'] === 'Deposito en Cuenta') {
      $node_proof->setAttribute("metodoDePago","99");
    }
    else if ($rowDandC['payment_method'] === 'Pago en Efectivo') {
      $node_proof->setAttribute("metodoDePago","01");
    }
    else if ($rowDandC['payment_method'] === 'Transferencia Electronica de Fondos') {
      $node_proof->setAttribute("metodoDePago","03");
    }
    else if ($rowDandC['payment_method'] === 'No Identificado') {
      $node_proof->setAttribute("metodoDePago","99");
    } else {
      $node_proof->setAttribute("metodoDePago","99");
    }
    $node_proof->setAttribute("tipoDeComprobante","ingreso");

    $node_sender = $node_proof->appendChild($dom->createElement("cfdi:Emisor"));
    $node_sender->setAttribute("rfc",$_SESSION['branchRFC']);//VAAA671004LY0
    $node_sender->setAttribute("nombre",$_SESSION['branchReason']);//Amanda Valencio Avila
    $node_dom_fiscal = $node_sender->appendChild($dom->createElement("cfdi:DomicilioFiscal"));
    $node_dom_fiscal->setAttribute("calle",$_SESSION['branchAddress']);
    $node_dom_fiscal->setAttribute("noExterior",$_SESSION['branchNext']);
    $node_dom_fiscal->setAttribute("noInterior",$_SESSION['branchNint']);
    $node_dom_fiscal->setAttribute("colonia",$_SESSION['branchColony']);
    $node_dom_fiscal->setAttribute("localidad",$_SESSION['branchCity']);
    $node_dom_fiscal->setAttribute("municipio",$_SESSION['branchCity']);
    $node_dom_fiscal->setAttribute("estado",$_SESSION['branchState']);
    $node_dom_fiscal->setAttribute("pais","México");
    $node_dom_fiscal->setAttribute("codigoPostal",$_SESSION['branchCP']);
    $node_regime_fiscal = $node_sender->appendChild($dom->createElement("cfdi:RegimenFiscal"));
    $node_regime_fiscal->setAttribute("Regimen","Régimen de Personas Físicas con Actividades Empresariales y Profesionales.");
    $rfc = strtoupper($rowDandC['rfc']);
    $node_catch = $node_proof->appendChild($dom->createElement('cfdi:Receptor'));
    $node_catch->setAttribute("rfc",$rfc);
    $node_catch->setAttribute("nombre",$rowDandC['name']);
    $node_dom_catch = $node_catch->appendChild($dom->createElement('cfdi:Domicilio'));
    $node_dom_catch->setAttribute("calle",$rowDandC['address']);
    $node_dom_catch->setAttribute("noExterior",$rowDandC['noExt']);
    if (isset($rowDandC['noInt'])) {
      $node_dom_catch->setAttribute("noInterior",$rowDandC['noInt']);
    }
    $node_dom_catch->setAttribute("colonia",$rowDandC['colony']);
    $node_dom_catch->setAttribute("localidad",$rowDandC['city']);
    $node_dom_catch->setAttribute("municipio",$rowDandC['city']);
    $node_dom_catch->setAttribute("estado",$rowDandC['state']);
    $node_dom_catch->setAttribute("pais","México");
    $node_dom_catch->setAttribute("codigoPostal",$rowDandC['pc']);

    $queryQandP = "SELECT * FROM quoter AS Q INNER JOIN products AS P ON Q.id_product = P.id WHERE Q.invoice ='" . $rowDandC['invoice'] . "';";
    $resultQandP = mysqli_query($link,$queryQandP) or die ('Consulta fallida: ' . mysqli_error($link));
    $node_concepts = $node_proof->appendChild($dom->createElement("cfdi:Conceptos"));
    while ($rowQandP = mysqli_fetch_assoc($resultQandP)) {
      $costUnit = $rowQandP['unit_cost'];
      $costUnitSIVA = ($costUnit/116) * 100;
      $CostUnitSIVA = round($costUnitSIVA, 2);
      $costPzs = $CostUnitSIVA * $rowQandP['amount'];
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
    $resultQandP = mysqli_query($link,$queryQandP) or die ('Consulta fallida: ' . mysqli_error($link));
    $node_taxes->setAttribute("totalImpuestosTrasladados",$IVA_total);
    $node_transfers = $node_taxes->appendChild($dom->createElement("cfdi:Traslados"));
    while ($rowQandP = mysqli_fetch_assoc($resultQandP)) {
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
    $cadenaCodigoBarras = "?re=".$_SESSION['branchRFC']."&rr=" . $rfc . "&tt=" . $der . $izq . "&id=" . $UUID;

    if(!file_exists("cbb/" . $UUID . ".png")) {
      QRcode::png($cadenaCodigoBarras, "cbb/" . $UUID . ".png", 'L', 4, 2);
    }
    $noCertificado = '00001000000301099705';

    $query = "UPDATE documents SET uuid='" . $UUID . "', fechaTimbrado='" . $fechaTimbrado . "', selloSat='" . $selloSAT . "', noCertificado='" . $noCertificado . "', certificado='" . $certificado . "', sello='" . $sello . "', noCertificadoSat='" . $noCertificadoSat . "'  WHERE id=" . $_REQUEST['id'];
    $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));

    echo 1;
  } else {
    echo 0;
  }

?>
