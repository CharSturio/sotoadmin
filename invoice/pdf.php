<?php
require '../connection/index.php';
require "convert.php";
$id = $_REQUEST['id'];
$op = $_REQUEST['op'];
if ($op === '1') {
  $query = "SELECT D.dias_credito, D.type, D.invoice, C.name, C.address, C.noExt, C.noInt, C.pc, C.rfc, C.phone, C.email, D.last_date, D.payment_method, D.last_digits, D.guide_number, D.uuid, D.fechaTimbrado, D.sello, D.noCertificadoSat, D.noCertificado, D.selloSat FROM documents AS D INNER JOIN clients AS C ON D.id_client = C.id WHERE D.id =" . $id . " LIMIT 1;";
  $result = mysql_query($query) or die ('Consulta fallida: ' . mysql_error());
  $row = mysql_fetch_assoc($result);

  $html = '<!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="utf-8">
      <title>Factura</title>
      <link rel="stylesheet" href="invoice.css" media="all" />
      <link href="https://npmcdn.com/basscss@8.0.1/css/basscss.min.css" rel="stylesheet">
    </head>
    <body>
      <div class="wid100 center">
        <h1>Factura ' . $row['invoice'] . '</h1>
      </div>
      <div class="clearL"></div>
      <div class="wid25" >
        <img id="logo" src="logo.png">
      </div>
      <div  class="wid25">
        <b>Emisor</b><br />
        Amanda Valenciano Avila<br />
        Medina Ascencio 649 <br />CP 47180<br />
        VAAA671004LY0<br />
        <br />01 34 8784 7733<br />
        sotogoodyear@hotmail.com
      </div>
      <div class="wid25">
        <b>Receptor</b><br />
        ' . $row['name'] . '<br />
        ' . $row['address'] . " " . $row['noExt'] . " " . $row['noInt'] . '<br /> ' . $row['pc'] . '<br />
        ' . $row['rfc'] . '<br />
        ' . $row['phone'] . '<br />
        ' . $row['email'] . '
      </div>
      <div  class="wid25">
        <b>Fiscales</b><br />
        <b>Fecha: </b>' . $row['last_date'] . '<br />
        <b>Factura: </b>' . $row['invoice'] . '<br />
        <b>Tipo Comprobante: </b>Factura Electrónica<br />
        <b>Método de Pago: </b>' . $row['payment_method'] . '<br />
        <b>Expedido en: </b>Arandas, Jal.<br />
        <b>Cuenta Pago: </b>' . $row['last_digits'] . '
      </div>
      <div class="clearL"></div>
      <br /><br />
      <div class="wid17"><b>Código</b></div>
      <div class="wid17"><b>Descripción</b></div>
      <div class="wid17"><b>Unidad</b></div>
      <div class="wid17"><b>Precio x Unidad</b></div>
      <div class="wid17"><b>Cantidad</b></div>
      <div class="wid15"><b>TOTAL</b></div>
      <div class="clearL"></div>';
          $queryPro = "SELECT * FROM quoter AS Q INNER JOIN products AS P ON Q.id_product = P.id WHERE Q.invoice ='" . $row['invoice'] . "'";
          $resultPro = mysql_query($queryPro) or die ('Consulta fallida: ' . mysql_error());
          $totalGral = 0;
          while ($rowPro = mysql_fetch_assoc($resultPro)) {
            $unitCost = ($rowPro['unit_cost']/116) * 100;
            $totalUnitCost = $rowPro['amount'] * $unitCost;
            $unitCost = round($unitCost, 2);
            $totalUnitCost = round($totalUnitCost, 2);

            $totalGral += $totalUnitCost;
            $html .= '
            <div class="wid17">' . $rowPro['key_'] . '</div>
            <div class="wid17">' . $rowPro['name'] . '</div>
            <div class="wid17">Pieza</div>
            <div class="wid17">$' . $unitCost . '</div>
            <div class="wid17">' . $rowPro['amount'] . '</div>
            <div class="wid15">$' . $totalUnitCost . '</div>
            <div class="clearL"></div>';
          }
          $totalGral = round($totalGral, 2);

          $totalF = $totalGral * 1.16;
          $totalF = round($totalF, 2);
          $ivaTotalF = $totalGral * .16;
          $ivaTotalF = round($ivaTotalF, 2);

          $totalLetra = num2letras($totalF);

          $html .= '
          <div class="wid17">&nbsp;</div>
          <div class="wid17">&nbsp;</div>
          <div class="wid17">&nbsp;</div>
          <div class="wid17">&nbsp;</div>
          <div class="wid17"><b>SUBTOTAL</b></div>
          <div class="wid15">$' . $totalGral . '</div>
          <div class="clearL"></div>
          <div class="wid17">&nbsp;</div>
          <div class="wid17">&nbsp;</div>
          <div class="wid17">&nbsp;</div>
          <div class="wid17">&nbsp;</div>
          <div class="wid17"><b>IVA 16%</b></div>
          <div class="wid15">$' . $ivaTotalF . '</div>
          <div class="clearL"></div>
          <div class="wid14">&nbsp;</div>
          <div class="wid14">&nbsp;</div>
          <div class="wid40">' . $totalLetra . '</div>
          <div class="wid17"><b>TOTAL</b></div>
          <div class="wid15">$' . $totalF . '</div>
          <div class="clearL"></div>
    <div class="clearL"></div>
        <div  class="wid30">
          <img src="../links/create/cbb/' . $row['uuid'] . '.png">
        </div>
        <div  class="wid70" style="word-wrap: break-word;">
          * Pago en una sola exhibición * Esta es una representación impresa de un CFDI.
          <p>
           Guía: ' . $row['guide_number'];
           if ($row['type'] === 'credit') {
             $html .= ' Dias Credito: ' . $row['dias_credito'];
           }
           $html .= '
          </p>
          <p>
            <b>Cadena Original del Timbre</b>

            ||1.0|' . $row['uuid'] . '|' . $row['fechaTimbrado'] . '|' . $row['sello'] . '|' . $row['noCertificadoSat'] . '||
          </p>
          <p>
            <b>Sello Digital del Emisor</b>
            ' . $row['sello'] . '
          </p>
          <p>
            <b>Sello Digital del SAT</b>
            ' . $row['selloSat'] . '
          </p>
        </div>
        <div class="clearL"></div>

        <div class="wid30">
          <b>UUID</b><br />
          ' . $row['uuid'] . '
        </div>
        <div class="wid20">
          <b>Certificado SAT</b><br />
          ' . $row['noCertificadoSat'] . '
        </div>
        <div class="wid20">
          <b>Fecha y Hora Certificación</b><br />
          ' . $row['fechaTimbrado'] . '
        </div>
        <div class="wid30">
          <b>Certificado</b><br />
            ' . $row['noCertificado'] . '
        </div>
    </body>
  </html>';
} else if ($op === '2') {
  $query = "SELECT  D.invoice, C.name, C.address, C.noExt, C.noInt, C.pc, C.rfc, C.phone, C.email, D.last_date, D.payment_method, D.last_digits, D.guide_number FROM documents AS D INNER JOIN clients AS C ON D.id_client = C.id WHERE D.id =" . $id ." LIMIT 1;";
  $result = mysql_query($query) or die ('Consulta fallida: ' . mysql_error());
  $row = mysql_fetch_assoc($result);

  $html = '<!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="utf-8">
      <title>Remision</title>
      <link rel="stylesheet" href="invoice.css" media="all" />
      <link href="https://npmcdn.com/basscss@8.0.1/css/basscss.min.css" rel="stylesheet">
    </head>
    <body>
      <div class="wid100 center">
        <h1>Remision ' . $row['invoice'] . '</h1>
      </div>
      <div class="clearL"></div>
      <div class="wid25" >
        <img id="logo" src="logo.png">
      </div>
      <div  class="wid25">
        <b>Emisor</b><br />
        Amanda Valenciano Avila<br />
        Medina Ascencio 649 <br />CP 47180<br />
        VAAA671004LY0<br />
        <br />01 34 8784 7733<br />
        sotogoodyear@hotmail.com
      </div>
      <div class="wid25">
        <b>Receptor</b><br />
        ' . $row['name'] . '<br />
        ' . $row['address'] . " " . $row['noExt'] . " " . $row['noInt'] . '<br /> ' . $row['pc'] . '<br />
        ' . $row['rfc'] . '<br />
        ' . $row['phone'] . '<br />
        ' . $row['email'] . '
      </div>
      <div  class="wid25">
        <b>X</b><br />
        <b>Fecha: </b>' . $row['last_date'] . '<br />
        <b>Remision: </b>' . $row['invoice'] . '<br />
        <b>Tipo Comprobante: </b>Remision<br />
        <b>Método de Pago: </b>' . $row['payment_method'] . '<br />
        <b>Expedido en: </b>Arandas, Jal.<br />
        <b>Cuenta Pago: </b>' . $row['last_digits'] . '
      </div>
      <div class="clearL"></div>
      <br /><br />
      <div class="wid17"><b>Código</b></div>
      <div class="wid17"><b>Descripción</b></div>
      <div class="wid17"><b>Unidad</b></div>
      <div class="wid17"><b>Precio x Unidad</b></div>
      <div class="wid17"><b>Cantidad</b></div>
      <div class="wid15"><b>TOTAL</b></div>
      <div class="clearL"></div>';
          $queryPro = "SELECT * FROM quoter AS Q INNER JOIN products AS P ON Q.id_product = P.id WHERE Q.invoice ='" . $row['invoice'] . "'";
          $resultPro = mysql_query($queryPro) or die ('Consulta fallida: ' . mysql_error());
          $totalGral = 0;
          while ($rowPro = mysql_fetch_assoc($resultPro)) {
            $unitCost = ($rowPro['unit_cost']/116) * 100;
            $totalUnitCost = $rowPro['amount'] * $unitCost;
            $unitCost = round($unitCost, 2);
            $totalUnitCost = round($totalUnitCost, 2);

            $totalGral += $totalUnitCost;
            $html .= '
            <div class="wid17">' . $rowPro['key_'] . '</div>
            <div class="wid17">' . $rowPro['name'] . '</div>
            <div class="wid17">Pieza</div>
            <div class="wid17">$' . $unitCost . '</div>
            <div class="wid17">' . $rowPro['amount'] . '</div>
            <div class="wid15">$' . $totalUnitCost . '</div>
            <div class="clearL"></div>';
          }
          $totalGral = round($totalGral, 2);

          $totalF = $totalGral * 1.16;
          $totalF = round($totalF, 2);
          $ivaTotalF = $totalGral * .16;
          $ivaTotalF = round($ivaTotalF, 2);

          $totalLetra = num2letras($totalF);

          $html .= '
          <div class="wid17">&nbsp;</div>
          <div class="wid17">&nbsp;</div>
          <div class="wid17">&nbsp;</div>
          <div class="wid17">&nbsp;</div>
          <div class="wid17"><b>SUBTOTAL</b></div>
          <div class="wid15">$' . $totalGral . '</div>
          <div class="clearL"></div>
          <div class="wid17">&nbsp;</div>
          <div class="wid17">&nbsp;</div>
          <div class="wid17">&nbsp;</div>
          <div class="wid17">&nbsp;</div>
          <div class="wid17"><b>IVA 16%</b></div>
          <div class="wid15">$' . $ivaTotalF . '</div>
          <div class="clearL"></div>
          <div class="wid14">&nbsp;</div>
          <div class="wid14">&nbsp;</div>
          <div class="wid40">' . $totalLetra . '</div>
          <div class="wid17"><b>TOTAL</b></div>
          <div class="wid15">$' . $totalF . '</div>
          <div class="clearL"></div>
    <div class="clearL"></div>
        <div  class="wid100" style="word-wrap: break-word;">
          * Remision.
          <p>
           Guía: ' . $row['guide_number'] . '
          </p>
        </div>
    </body>
  </html>';
} else if ($op === '3') {
  $query = "SELECT  D.dias_credito, D.invoice, C.name, C.address, C.noExt, C.noInt, C.pc, C.rfc, C.phone, C.email, D.last_date, D.payment_method, D.last_digits, D.guide_number FROM documents AS D INNER JOIN clients AS C ON D.id_client = C.id WHERE D.id =" . $id ." LIMIT 1;";
  $result = mysql_query($query) or die ('Consulta fallida: ' . mysql_error());
  $row = mysql_fetch_assoc($result);

  $html = '<!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="utf-8">
      <title>Credito</title>
      <link rel="stylesheet" href="invoice.css" media="all" />
      <link href="https://npmcdn.com/basscss@8.0.1/css/basscss.min.css" rel="stylesheet">
    </head>
    <body>
      <div class="wid100 center">
        <h1>Credito ' . $row['invoice'] . '</h1>
      </div>
      <div class="clearL"></div>
      <div class="wid25" >
        <img id="logo" src="logo.png">
      </div>
      <div  class="wid25">
        <b>Emisor</b><br />
        Amanda Valenciano Avila<br />
        Medina Ascencio 649 <br />CP 47180<br />
        VAAA671004LY0<br />
        <br />01 34 8784 7733<br />
        sotogoodyear@hotmail.com
      </div>
      <div class="wid25">
        <b>Receptor</b><br />
        ' . $row['name'] . '<br />
        ' . $row['address'] . " " . $row['noExt'] . " " . $row['noInt'] . '<br /> ' . $row['pc'] . '<br />
        ' . $row['rfc'] . '<br />
        ' . $row['phone'] . '<br />
        ' . $row['email'] . '
      </div>
      <div  class="wid25">
        <b>X</b><br />
        <b>Fecha: </b>' . $row['last_date'] . '<br />
        <b>Credito: </b>' . $row['invoice'] . '<br />
        <b>Tipo Comprobante: </b>Credito<br />
        <b>Método de Pago: </b>' . $row['payment_method'] . '<br />
        <b>Expedido en: </b>Arandas, Jal.<br />
        <b>Cuenta Pago: </b>' . $row['last_digits'] . '
      </div>
      <div class="clearL"></div>
      <br /><br />
      <div class="wid17"><b>Código</b></div>
      <div class="wid17"><b>Descripción</b></div>
      <div class="wid17"><b>Unidad</b></div>
      <div class="wid17"><b>Precio x Unidad</b></div>
      <div class="wid17"><b>Cantidad</b></div>
      <div class="wid15"><b>TOTAL</b></div>
      <div class="clearL"></div>';
          $queryPro = "SELECT * FROM quoter AS Q INNER JOIN products AS P ON Q.id_product = P.id WHERE Q.invoice ='" . $row['invoice'] . "'";
          $resultPro = mysql_query($queryPro) or die ('Consulta fallida: ' . mysql_error());
          $totalGral = 0;
          while ($rowPro = mysql_fetch_assoc($resultPro)) {
            $unitCost = ($rowPro['unit_cost']/116) * 100;
            $totalUnitCost = $rowPro['amount'] * $unitCost;
            $unitCost = round($unitCost, 2);
            $totalUnitCost = round($totalUnitCost, 2);

            $totalGral += $totalUnitCost;
            $html .= '
            <div class="wid17">' . $rowPro['key_'] . '</div>
            <div class="wid17">' . $rowPro['name'] . '</div>
            <div class="wid17">Pieza</div>
            <div class="wid17">$' . $unitCost . '</div>
            <div class="wid17">' . $rowPro['amount'] . '</div>
            <div class="wid15">$' . $totalUnitCost . '</div>
            <div class="clearL"></div>';
          }
          $totalGral = round($totalGral, 2);

          $totalF = $totalGral * 1.16;
          $totalF = round($totalF, 2);
          $ivaTotalF = $totalGral * .16;
          $ivaTotalF = round($ivaTotalF, 2);

          $totalLetra = num2letras($totalF);

          $html .= '
          <div class="wid17">&nbsp;</div>
          <div class="wid17">&nbsp;</div>
          <div class="wid17">&nbsp;</div>
          <div class="wid17">&nbsp;</div>
          <div class="wid17"><b>SUBTOTAL</b></div>
          <div class="wid15">$' . $totalGral . '</div>
          <div class="clearL"></div>
          <div class="wid17">&nbsp;</div>
          <div class="wid17">&nbsp;</div>
          <div class="wid17">&nbsp;</div>
          <div class="wid17">&nbsp;</div>
          <div class="wid17"><b>IVA 16%</b></div>
          <div class="wid15">$' . $ivaTotalF . '</div>
          <div class="clearL"></div>
          <div class="wid14">&nbsp;</div>
          <div class="wid14">&nbsp;</div>
          <div class="wid40">' . $totalLetra . '</div>
          <div class="wid17"><b>TOTAL</b></div>
          <div class="wid15">$' . $totalF . '</div>
          <div class="clearL"></div>
    <div class="clearL"></div>
        <div  class="wid100" style="word-wrap: break-word;">
          * Credito. Días de Credito: ' . $row['dias_credito'] . '
          <p>
           Guía: ' . $row['guide_number'] . '
          </p>
        </div>
    </body>
  </html>';
}

$routePDF = 'pdf/' . $row['invoice'] . '.pdf';
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('letter', 'vertical');
$dompdf->render();
$pdfoutput = $dompdf->output();
$filename = $routePDF;
$fp = fopen($filename, "a");
fwrite($fp, $pdfoutput);
fclose($fp);
echo $html;
?>
