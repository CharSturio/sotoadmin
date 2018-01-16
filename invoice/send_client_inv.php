<?php
  session_start();
  require '../connection/index.php';
  require_once 'phpmailer/class.phpmailer.php';
  require_once 'phpmailer/class.smtp.php';
  

  $operation = $_REQUEST['operation'];
  if ($operation === 'action') {
    if($_SESSION['UtiEnvMerEnv']){
      $query = "SELECT S.amount, P.type_product, P.name, P.brand, P.model, P.description, P.measure, P.treadware, P.load_index, P.load_speed, P.wholesale_price, P.pespecial FROM stocks AS S INNER JOIN products AS P ON S.id_product = P.id WHERE P.type_product = '" . $_REQUEST['typeProduct'] . "' AND S.amount > 0 ORDER BY P.barcode DESC";
      $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));

      require_once 'lib/PHPExcel/PHPExcel.php';

      // Se crea el objeto PHPExcel
      $objPHPExcel = new PHPExcel();

      // Se asignan las propiedades del libro
      $objPHPExcel->getProperties()->setCreator("SotoGoodyear") //Autor
                ->setLastModifiedBy("SotoGoodYear") //Ultimo usuario que lo modificó
                ->setTitle("REPORTE DE INVENTARIOS SOTOGOODYEAR")
                ->setSubject("REPORTE DE INVENTARIOS SOTOGOODYEAR")
                ->setDescription("REPORTE DE INVENTARIOS SOTOGOODYEAR")
                ->setKeywords("REPORTE DE INVENTARIOS SOTOGOODYEAR")
                ->setCategory("Reporte excel");

      $tituloReporte = "Reporte de minimo de stocks";
      $titulosColumnas = array('TIPO','NOMBRE','MARCA','MODELO','DESCRIPCION','MEDIDA','TREADWARE','IND CARGA','IND VELOCIDAD','PRECIO ESPECIAL','PRECIO MAYOREO','EXISTENCIA');

      $objPHPExcel->setActiveSheetIndex(0)
                  ->mergeCells('A1:L1');

      // Se agregan los titulos del reporte
      $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1',$tituloReporte)
            ->setCellValue('A3',  $titulosColumnas[0])
            ->setCellValue('B3',  $titulosColumnas[1])
            ->setCellValue('C3',  $titulosColumnas[2])
            ->setCellValue('D3',  $titulosColumnas[3])
            ->setCellValue('E3',  $titulosColumnas[4])
            ->setCellValue('F3',  $titulosColumnas[5])
            ->setCellValue('G3',  $titulosColumnas[6])
            ->setCellValue('H3',  $titulosColumnas[7])
            ->setCellValue('I3',  $titulosColumnas[8])
            ->setCellValue('J3',  $titulosColumnas[9])
            ->setCellValue('K3',  $titulosColumnas[10])
            ->setCellValue('L3',  $titulosColumnas[11]);

      //Se agregan los datos de los alumnos
      $i=4;
      while($row = mysqli_fetch_assoc($result)){
        $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A'.$i, $row['type_product'])
        ->setCellValue('B'.$i, $row['name'])
        ->setCellValue('C'.$i, $row['brand'])
        ->setCellValue('D'.$i, $row['model'])
        ->setCellValue('E'.$i, $row['description'])
        ->setCellValue('F'.$i, $row['measure'])
        ->setCellValue('G'.$i, $row['treadware'])
        ->setCellValue('H'.$i, $row['load_index'])
        ->setCellValue('I'.$i, $row['load_speed'])
        ->setCellValue('J'.$i, $row['pespecial'])
        ->setCellValue('K'.$i, $row['wholesale_price'])
        ->setCellValue('L'.$i, $row['amount']);
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

      $objPHPExcel->getActiveSheet()->getStyle('A1:L1')->applyFromArray($estiloTituloReporte);
      $objPHPExcel->getActiveSheet()->getStyle('A3:L3')->applyFromArray($estiloTituloColumnas);
      $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:L".($i-1));

      for($i = 'A'; $i <= 'L'; $i++) {
        $objPHPExcel->setActiveSheetIndex(0)
          ->getColumnDimension($i)->setAutoSize(TRUE);
      }

      // Se asigna el nombre a la hoja
      $objPHPExcel->getActiveSheet()->setTitle('INVENTARIOS SOTOGOODYEAR');

      // Se activa la hoja para que sea la que se muestre cuando el archivo se abre
      $objPHPExcel->setActiveSheetIndex(0);
      // Inmovilizar paneles
      //$objPHPExcel->getActiveSheet(0)->freezePane('A4');
      $objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);


      $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
      $objWriter->save('inventarioSotoGoodyear.xlsx');

  $nombre_archivo = 'inventarioSotoGoodyear.xlsx';


      $mail = new PHPMailer(true); //defaults to using php "mail()"; the true param means it will throw exceptions on errors, which we need to catch

      try {
        $mail->IsSMTP();                                      // set mailer to use SMTP
        $mail->Host = "smtp.1and1.mx";  // specify main and backup server
        $mail->Port = 587;
        $mail->SMTPAuth = true;     // turn on SMTP authentication
        $mail->Username = "no-reply@sotoadmin.com";  // SMTP username
        $mail->Password = $passSMTP; // SMTP password
        
        $mail->AddAddress('sotollantas@gmail.com', 'Cliente');
        $split = explode(",",$_REQUEST['email']);
        $count = count($split);
        for ($i=0;$i<$count;$i++) {
          $mail->AddBCC($split[$i]);
        }
        $mail->SetFrom('no-reply@sturio.com', 'Soto Goodyear');
        $mail->Subject = 'Reporte de inventarios Sotogoodyear';
        $mail->AltBody = 'Reporte de inventarios Sotogoodyear'; // optional - MsgHTML will create an alternate automatically
        $mail->MsgHTML('Reporte de inventarios Sotogoodyear');
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
