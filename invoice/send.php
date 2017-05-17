<?php
require '../connection/index.php';

//function send ($id_document) {
$id_document = $_REQUEST['id'];
  require_once 'phpmailer/class.phpmailer.php';
  $queryClient = "SELECT D.invoice, C.email, D.uuid FROM documents AS D INNER JOIN clients AS C ON D.id_client = C.id WHERE D.id=" . $id_document;
  $resultClient = mysql_query($queryClient) or die ('Consulta fallida: ' . mysql_error());
  $rowClient = mysql_fetch_assoc($resultClient);

  $pdf = './pdf/' . $rowClient['invoice'] . '.pdf';
  $xml = '../links/create/xmls/' . $rowClient['invoice'] . $id_document . '.xml';

  if ($rowClient['email']) {
    // if ($rowClient['uuid']) {
      if (file_exists($pdf)) {
          if (file_exists($xml)) {
            $mail = new PHPMailer(true); //defaults to using php "mail()"; the true param means it will throw exceptions on errors, which we need to catch

            try {
              $mail->AddAddress($rowClient['email'], 'Cliente');
              $mail->AddAddress('facturasoto@hotmail.com', 'SotoFacturacion');
              $mail->SetFrom('no-reply@sotoadmin.com', 'Soto Goodyear');
              $mail->Subject = 'Factura de SotoGoodyear';
              $mail->AltBody = 'Factura de SotoGoodyear'; // optional - MsgHTML will create an alternate automatically
              $mail->MsgHTML('Estos son sus documentos de la compra con SotoGoddyear. Agradecemos su preferencia.');
              $mail->AddAttachment($pdf);      // attachment
              $mail->AddAttachment($xml); // attachment
              $send = $mail->Send();
              echo "Correo enviado correctamente.";
            } catch (phpmailerException $e) {
              echo $e->errorMessage(); //Pretty error messages from PHPMailer
            } catch (Exception $e) {
              echo $e->getMessage(); //Boring error messages from anything else!
            }
          } else {
            echo 'El archivo XML no existe';
          }
      } else {
        echo 'El archivo PDF no existe';
      }
    // } else {
    //   if (file_exists($pdf)) {
    //     $mail = new PHPMailer(true); //defaults to using php "mail()"; the true param means it will throw exceptions on errors, which we need to catch
    //
    //     try {
    //       $mail->AddAddress($rowClient['email'], 'Cliente');
    //       $mail->AddAddress('facturasoto@hotmail.com', 'SotoFacturacion');
    //       $mail->AddAddress('charly.soft@hotmail.com', 'SotoFacturacion');
    //       $mail->SetFrom('no-reply@sotoadmin.com', 'Soto Goodyear');
    //       $mail->Subject = 'Factura de SotoGoodyear';
    //       $mail->AltBody = 'Factura de SotoGoodyear'; // optional - MsgHTML will create an alternate automatically
    //       $mail->MsgHTML('Estos son sus documentos de la compra con SotoGoddyear. Agradecemos su preferencia.');
    //       $mail->AddAttachment($pdf);      // attachment
    //       $send = $mail->Send();
    //       echo "Correo enviado correctamente.";
    //     } catch (phpmailerException $e) {
    //       echo $e->errorMessage(); //Pretty error messages from PHPMailer
    //     } catch (Exception $e) {
    //       echo $e->getMessage(); //Boring error messages from anything else!
    //     }
    //   } else {
    //     echo 'El archivo PDF no existe';
    //   }
    // }
  } else {
    echo 'El cliente no tiene un correo asignado.';
  }
?>
