<?php
  session_start();
  require '../connection/index.php';

  $operation = $_REQUEST['operation'];
  if ($operation === 'action') {
    $query="SELECT S.id, S.amount, P.type_product, P.barcode, P.name, P.key_, P.brand, P.model, P.retail_price, P.wholesale_price, P.special_price, P.tarjeta, P.mpago, P.pespecial, E.unit_cost, E.last_date FROM stocks AS S INNER JOIN products AS P ON S.id_product = P.id INNER JOIN (SELECT * FROM merchandise_entry) AS E ON S.id_product = E.id_product WHERE P.type_product = '" . $_REQUEST['typeProduct'] . "' ORDER BY P.barcode, E.last_date DESC";
    $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error());

    require_once 'lib/PHPExcel/PHPExcel.php';

    // Se crea el objeto PHPExcel
    $objPHPExcel = new PHPExcel();

    // Se asignan las propiedades del libro
    $objPHPExcel->getProperties()->setCreator("SotoGoodyear") //Autor
               ->setLastModifiedBy("SotoGoodYear") //Ultimo usuario que lo modificó
               ->setTitle("Reporte de Mercancia Con Inventarios")
               ->setSubject("Reporte de Mercancia Con Inventarios")
               ->setDescription("Reporte de Mercancia Con Inventarios")
               ->setKeywords("Reporte de Mercancia Con Inventarios")
               ->setCategory("Reporte excel");

    $tituloReporte = "Reporte de Mercancia Con Inventarios";
    $titulosColumnas = array('TIPO','NOMBRE','CODIGO','CLAVE','P PUBLICO','P MAYOREO','P ESPECIAL','P TARJETA','P MERC PAGO','P PUB ESPECIAL','EXISTENCIA','COSTO','FECHA COSTOS');

    $objPHPExcel->setActiveSheetIndex(0)
                ->mergeCells('A1:K1');

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
                ->setCellValue('L3',  $titulosColumnas[11])
                ->setCellValue('M3',  $titulosColumnas[12]);

    //Se agregan los datos de los alumnos
    $i=4;
    while($row = mysqli_fetch_assoc($result)){
      $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i, $row['type_product'])
                ->setCellValue('B'.$i, $row['name'])
                ->setCellValue('C'.$i, $row['barcode'])
                ->setCellValue('D'.$i, $row['key_'])
                ->setCellValue('E'.$i, '$'.$row['retail_price'])
                ->setCellValue('F'.$i, '$'.$row['wholesale_price'])
                ->setCellValue('G'.$i, '$'.$row['special_price'])
                ->setCellValue('H'.$i, '$'.$row['tarjeta'])
                ->setCellValue('I'.$i, '$'.$row['mpago'])
                ->setCellValue('J'.$i, '$'.$row['pespecial'])
                ->setCellValue('K'.$i, '$'.$row['amount'])
                ->setCellValue('L'.$i, '$'.$row['unit_cost'])
                ->setCellValue('M'.$i, $row['last_date']);
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

    $objPHPExcel->getActiveSheet()->getStyle('A1:M1')->applyFromArray($estiloTituloReporte);
    $objPHPExcel->getActiveSheet()->getStyle('A3:M3')->applyFromArray($estiloTituloColumnas);
    $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:M".($i-1));

    for($i = 'A'; $i <= 'K'; $i++){
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
    header('Content-Disposition: attachment;filename="reportemercanciaconcostos.xlsx"');
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');
    exit;
  }
  mysqli_close($link);
 ?>
