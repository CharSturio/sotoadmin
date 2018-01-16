<?php
  session_start();
  require 'connection/index.php';
  require_once 'phpmailer/class.phpmailer.php';
  require_once 'phpmailer/class.smtp.php';
  

  $operation = $_REQUEST['operation'];
  if ($operation === 'action') {
    if($_SESSION['UtiStoMinEnv']){
      $query = "SELECT S.amount, P.type_product, P.barcode, P.name, P.key_, P.brand, P.model FROM stocks AS S INNER JOIN products AS P ON S.id_product = P.id WHERE P.type_product = '" . $_REQUEST['typeProduct'] . "' AND S.amount < 5 ORDER BY P.barcode DESC";
      $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));

      require_once 'lib/PHPExcel/PHPExcel.php';

      // Se crea el objeto PHPExcel
      $objPHPExcel = new PHPExcel();

      // Se asignan las propiedades del libro
      $objPHPExcel->getProperties()->setCreator("SotoGoodyear") //Autor
                ->setLastModifiedBy("SotoGoodYear") //Ultimo usuario que lo modificó
                ->setTitle("Reporte de minimo de stocks")
                ->setSubject("Reporte de minimo de stocks")
                ->setDescription("Reporte de minimo de stocks")
                ->setKeywords("Reporte de minimo de stocks")
                ->setCategory("Reporte excel");

      $tituloReporte = "Reporte de minimo de stocks";
      $titulosColumnas = array('TIPO','NOMBRE','CODIGO','CLAVE','EXISTENCIA');

      $objPHPExcel->setActiveSheetIndex(0)
                  ->mergeCells('A1:E1');

      // Se agregan los titulos del reporte
      $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1',$tituloReporte)
                  ->setCellValue('A3',  $titulosColumnas[0])
                  ->setCellValue('B3',  $titulosColumnas[1])
                  ->setCellValue('C3',  $titulosColumnas[2])
                  ->setCellValue('D3',  $titulosColumnas[3])
                  ->setCellValue('E3',  $titulosColumnas[4]);

      //Se agregan los datos de los alumnos
      $i=4;
      while($row = mysqli_fetch_assoc($result)){
        $objPHPExcel->setActiveSheetIndex(0)
                  ->setCellValue('A'.$i, $row['type_product'])
                  ->setCellValue('B'.$i, $row['name'])
                  ->setCellValue('C'.$i, $row['barcode'])
                  ->setCellValue('D'.$i, $row['key_'])
                  ->setCellValue('E'.$i, $row['amount']);
                  $i++;
      }


      $estiloTituloReporte = array(
            'font' => array(
              'name'      => 'Verdana',
                'bold'      => true,
                'italic'    => false,
                  'strike'    => false,
                  'size' =>14,
                  'color'     => array(
                      'rgb' => 'FFFFFF'
                    )
              ),
            'fill' => array(
          'type'	=> PHPExcel_Style_Fill::FILL_SOLID,
          'color'	=> array('argb' => 'FF220835')
        ),
              'borders' => array(
                  'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_NONE
                  )
              ),
              'alignment' =>  array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'rotation'   => 0,
                'wrap'          => TRUE
          )
          );

      $estiloTituloColumnas = array(
              'font' => array(
                  'name'      => 'Arial',
                  'bold'      => true,
                  'color'     => array(
                      'rgb' => '000000'
                  )
              ),
        'alignment' =>  array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'wrap'          => TRUE
          )
        );

      $estiloInformacion = new PHPExcel_Style();
      $estiloInformacion->applyFromArray(
        array(
                'font' => array(
                  'name'      => 'Arial',
                  'color'     => array(
                      'rgb' => '000000'
                  )
              ),
              'borders' => array(
                  'left'     => array(
                      'style' => PHPExcel_Style_Border::BORDER_THIN ,
                    'color' => array(
                      'rgb' => '000000'
                      )
                  )
              )
          )
        );

      $objPHPExcel->getActiveSheet()->getStyle('A1:E1')->applyFromArray($estiloTituloReporte);
      $objPHPExcel->getActiveSheet()->getStyle('A3:E3')->applyFromArray($estiloTituloColumnas);
      $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:E".($i-1));

      for($i = 'A'; $i <= 'E'; $i++){
        $objPHPExcel->setActiveSheetIndex(0)
          ->getColumnDimension($i)->setAutoSize(TRUE);
      }

      // Se asigna el nombre a la hoja
      $objPHPExcel->getActiveSheet()->setTitle('Alerta de minimos stock');

      // Se activa la hoja para que sea la que se muestre cuando el archivo se abre
      $objPHPExcel->setActiveSheetIndex(0);
      // Inmovilizar paneles
      //$objPHPExcel->getActiveSheet(0)->freezePane('A4');
      $objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);


      $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
      $objWriter->save('minimostock.xlsx');

  $nombre_archivo = 'minimostock.xlsx';


      $mail = new PHPMailer(true); //defaults to using php "mail()"; the true param means it will throw exceptions on errors, which we need to catch

      try {
        $mail->IsSMTP();                                      // set mailer to use SMTP
        $mail->Host = "smtp.1and1.mx";  // specify main and backup server
        $mail->Port = 587;
        $mail->SMTPAuth = true;     // turn on SMTP authentication
        $mail->Username = "no-reply@sturio.com";  // SMTP username
        $mail->Password = $passSMTP; // SMTP password
        
        $mail->AddAddress($_REQUEST['email'], 'Cliente');
        $mail->SetFrom('no-reply@sotoadmin.com', 'Soto Goodyear');
        $mail->Subject = 'Reporte minimo stocks';
        $mail->AltBody = 'Minimo stocks SotoGoodyear'; // optional - MsgHTML will create an alternate automatically
        $mail->MsgHTML('Minimo stocks de SotoGoodyear');
        $mail->AddAttachment($nombre_archivo);
        $send = $mail->Send();
        echo "Correo enviado correctamente.";
        unlink($nombre_archivo);

      } catch (phpmailerException $e) {
        unlink($nombre_archivo);

        echo $e->errorMessage(); //Pretty error messages from PHPMailer
      } catch (Exception $e) {
        unlink($nombre_archivo);

        echo $e->getMessage(); //Boring error messages from anything else!
      }
    } else {
      echo 'noPermit';
    }
  }
  mysqli_close($link);
 ?>
