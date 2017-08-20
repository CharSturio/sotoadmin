<?php
  session_start();
  require '../connection/index.php';

  $operation = $_REQUEST['operation'];
  if ($operation === 'action') {
    $query = "SELECT S.amount, P.type_product, P.barcode, P.name, P.key_, P.brand, P.model, P.measure, P.treadware, P.load_index, P.load_speed FROM stocks AS S INNER JOIN products AS P ON S.id_product = P.id WHERE P.type_product = '" . $_REQUEST['typeProduct'] . "'  ORDER BY P.barcode DESC";
    $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));

      require_once 'lib/PHPExcel/PHPExcel.php';

      // Se crea el objeto PHPExcel
      $objPHPExcel = new PHPExcel();

      // Se asignan las propiedades del libro
      $objPHPExcel->getProperties()->setCreator("SotoGoodyear") //Autor
                 ->setLastModifiedBy("SotoGoodYear") //Ultimo usuario que lo modificó
                 ->setTitle("Reporte de Mercancia Sin Inventarios")
                 ->setSubject("Reporte de Mercancia Sin Inventarios")
                 ->setDescription("Reporte de Mercancia Sin Inventarios")
                 ->setKeywords("Reporte de Mercancia Sin Inventarios")
                 ->setCategory("Reporte excel");

      $tituloReporte = "Reporte de Mercancia Sin Inventarios";
      $titulosColumnas = array('TIPO', 'NOMBRE', 'CODIGO', 'CLAVE', 'MARCA', 'MODELO', 'MEDIDA', 'TREADWARE', 'IND CARGA', 'IND VELOCIDAD');

      $objPHPExcel->setActiveSheetIndex(0)
                  ->mergeCells('A1:J1');

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
                  ->setCellValue('J3',  $titulosColumnas[9]);

      //Se agregan los datos de los alumnos
      $i=4;
      while($row = mysqli_fetch_assoc($result)){
        $objPHPExcel->setActiveSheetIndex(0)
                  ->setCellValue('A'.$i, $row['type_product'])
                  ->setCellValue('B'.$i, $row['name'] )
                  ->setCellValue('C'.$i, $row['barcode'])
                  ->setCellValue('D'.$i,$row['key_'])
                  ->setCellValue('E'.$i,$row['brand'])
                  ->setCellValue('F'.$i,$row['model'])
                  ->setCellValue('G'.$i,$row['measure'])
                  ->setCellValue('H'.$i,$row['treadware'])
                  ->setCellValue('I'.$i,$row['load_index'])
                  ->setCellValue('J'.$i,$row['load_speed']);
                  $i++;
      }


      $estiloTituloReporte = array(
            'font' => array(
              'name'      => 'Verdana',
                'bold'      => true,
                'italic'    => false,
                  'strike'    => false,
                  'size' =>16,
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
          ));

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
          ));

      $objPHPExcel->getActiveSheet()->getStyle('A1:J1')->applyFromArray($estiloTituloReporte);
      $objPHPExcel->getActiveSheet()->getStyle('A3:J3')->applyFromArray($estiloTituloColumnas);
      $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:J".($i-1));

      for($i = 'A'; $i <= 'J'; $i++){
        $objPHPExcel->setActiveSheetIndex(0)
          ->getColumnDimension($i)->setAutoSize(TRUE);
      }

      // Se asigna el nombre a la hoja
      $objPHPExcel->getActiveSheet()->setTitle('Reporte Mercancia');

      // Se activa la hoja para que sea la que se muestre cuando el archivo se abre
      $objPHPExcel->setActiveSheetIndex(0);
      // Inmovilizar paneles
      //$objPHPExcel->getActiveSheet(0)->freezePane('A4');
      $objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);

      // Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename="reportemercanciasininventarios.xlsx"');
      header('Cache-Control: max-age=0');

      $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
      $objWriter->save('php://output');
      exit;

  }
  mysqli_close($link);
 ?>
