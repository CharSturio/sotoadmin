<?php
  session_start();
  require '../connection/index.php';

  $operation = $_REQUEST['operation'];
  if ($operation === 'action') {
    if($_SESSION['UtiCCCorCaj'] == 'true'){

      $fecha_desde = $_REQUEST['fecha_desde'];
      $fecha_hasta = $_REQUEST['fecha_hasta'];
      $desde = explode("/", $fecha_desde);
      $hasta = explode("/", $fecha_hasta);

      $desde_fecha = $desde[2] . '-' . $desde[0] . '-' . $desde[1];
      $hasta_fecha = $hasta[2] . '-' . $hasta[0] . '-' . $hasta[1];
      
      $print = '<div class="force-table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Clave</th>
                  <th>Sucursal</th>
                  <th>Total</th>
                  <th>Fecha</th>
                  <th>Tipo</th>
                  <th>Status</th>
                  <th>Cliente</th>
                  <th>Usuario</th>
                  <th>Seguimiento</th>
                  <th>Metodo Pago</th>
                </tr>
              </thead>
              <tbody id="table">';



      $total_efectivo = 0;
      $total_cheque = 0;
      $total_tc = 0;
      $total_td = 0;
      $total_deposito = 0;
      $total_transfer = 0;
      $total_noident = 0; 

      $query = "SELECT B.name AS nameBranch, D.payment_method, D.id, D.invoice, D.total, D.last_date, D.type, D.status, D.comments, C.name AS nameC, U.name AS nameU FROM documents AS D  INNER JOIN clients AS C ON D.id_client = C.id INNER JOIN users AS U ON D.id_user = U.id INNER JOIN branches AS B ON D.id_branch = B.id WHERE D.id_branch = ".$_SESSION['branchID']." AND D.last_date BETWEEN '" . $desde_fecha . " 00:00:00' AND '" . $hasta_fecha . " 23:59:59'";
      $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
      while($row = mysqli_fetch_assoc($result)){
        if ($row['payment_method'] === 'Pago en Efectivo') {
          $total_efectivo += $row['total'];
        }
        if ($row['payment_method'] === 'Cheque Nominativo') {
          $total_cheque += $row['total'];
        }
        if ($row['payment_method'] === 'Tarjeta de Credito') {
          $total_tc += $row['total'];
        }
        if ($row['payment_method'] === 'Tarjeta de Debito') {
          $total_td += $row['total'];
        }
        if ($row['payment_method'] === 'Deposito en Cuenta') {
          $total_deposito += $row['total'];
        }
        if ($row['payment_method'] === 'Transferencia Electronica de Fondos') {
          $total_transfer += $row['total'];
        }
        if ($row['payment_method'] === 'No Identificado') {
          $total_noident += $row['total'];
        }
        $print .= '<tr>
            <td>' . $row['invoice'] . '</td>
            <td>' . $row['nameBranch'] . '</td>
            <td>$' . number_format($row['total'], 2, '.', ',') . '</td>
            <td>' . $row['last_date'] . '</td>
            <td>' . $row['type'] . '</td>
            <td>' . $row['status'] . '</td>
            <td>' . $row['nameC'] . '</td>
            <td>' . $row['nameU'] . '</td>
            <td>' . $row['comments'] . '</td>
            <td>' . $row['payment_method'] . '</td>
          </tr>';
      }
      $salida_caja = 0;
      $query_out = "SELECT * FROM cash_out WHERE status='out' AND last_date BETWEEN '" . $desde_fecha . " 00:00:00' AND '" . $hasta_fecha . " 23:59:59'";
      $result_out = mysqli_query($link,$query_out) or die ('Consulta fallida: ' . mysqli_error($link));
      while($row_out = mysqli_fetch_assoc($result_out)){
        $salida_caja += $row_out['cantidad'];
      }

      $entrada_caja = 0;
      $query_out = "SELECT * FROM cash_out WHERE status='in' AND last_date BETWEEN '" . $desde_fecha . " 00:00:00' AND '" . $hasta_fecha . " 23:59:59'";
      $result_out = mysqli_query($link,$query_out) or die ('Consulta fallida: ' . mysqli_error($link));
      while($row_out = mysqli_fetch_assoc($result_out)){
        $entrada_caja += $row_out['cantidad'];
      }
      $total_pagos_para_credito=0;
      $query = "SELECT paid_out FROM credit_paid WHERE last_date BETWEEN '" . $desde_fecha . " 00:00:00' AND '" . $hasta_fecha . " 23:59:59'";
      $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
      while($row = mysqli_fetch_assoc($result)){
        $total_pagos_para_credito += $row['paid_out'];
      }

      $total_efectivo -= $salida_caja;
      $total_efectivo += $entrada_caja;
      $total_efectivo += 500;


      $gran_total = $total_efectivo + $total_cheque + $total_tc + $total_td + $total_deposito + $total_transfer + $total_noident; 
      
      $print .= '</tbody></table></div>';

      echo '<div class="col-md-12">
        <div class="col-md-6">
          <h3><strong>Gran <strong>TOTAL:</strong> </strong></h3>
          <label id="entrada-caja" class="form-label">$' . number_format($gran_total, 2, '.', ',') . '</label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="col-md-6">
          <h3><strong>Total <strong>efectivo</strong> en caja:</strong></h3>
            <label id="total-efectivo" class="form-label">$' . number_format($total_efectivo, 2, '.', ',') . '</label>
        </div>
        <div class="col-md-6">
          <h3><strong>Salida de <strong>caja:</strong> </strong></h3>
            <label id="salida-caja" class="form-label">$' . number_format($salida_caja, 2, '.', ',') . '</label>
        </div>
        <div class="col-md-6">
          <h3><strong>Entrada de <strong>caja:</strong> </strong></h3>
          <label id="entrada-caja" class="form-label">$' . number_format($entrada_caja, 2, '.', ',') . '</label>
        </div>
        <div class="col-md-6">
          <h3><strong>Total <strong>cheque:</strong> </strong></h3>
            <label id="entrada-caja" class="form-label">$' . number_format($total_cheque, 2, '.', ',') . '</label>
        </div>
        <div class="col-md-6">
          <h3><strong>Total <strong>tarjeta credito:</strong> </strong></h3>
            <label id="entrada-caja" class="form-label">$' . number_format($total_tc, 2, '.', ',') . '</label>
        </div>
        <div class="col-md-6">
          <h3><strong>Total <strong>tarjeta debito:</strong> </strong></h3>
          <label id="entrada-caja" class="form-label">$' . number_format($total_td, 2, '.', ',') . '</label>
        </div>
        <div class="col-md-6">
          <h3><strong>Total <strong>deposito en cuenta:</strong> </strong></h3>
            <label id="entrada-caja" class="form-label">$' . number_format($total_deposito, 2, '.', ',') . '</label>
        </div>
        <div class="col-md-6">
          <h3><strong>Total <strong>transferencia interbancaria:</strong> </strong></h3>
          <label id="entrada-caja" class="form-label">$' . number_format($total_transfer, 2, '.', ',') . '</label>
        </div>
        <div class="col-md-6">
          <h3><strong>Total <strong>no identificado:</strong> </strong></h3>
          <label id="entrada-caja" class="form-label">$' . number_format($total_noident, 2, '.', ',') . '</label>
        </div>
        
      </div>';
echo $print;
  
  //     $fecha_desde = $_REQUEST['fecha_desde'];
  //     $fecha_hasta = $_REQUEST['fecha_hasta'];
  //     $desde = explode("/", $fecha_desde);
  //     $hasta = explode("/", $fecha_hasta);

  //     $desde_fecha = $desde[2] . '-' . $desde[0] . '-' . $desde[1];
  //     $hasta_fecha = $hasta[2] . '-' . $hasta[0] . '-' . $hasta[1];

  //     $query = "SELECT B.name AS nameBranch, D.payment_method, D.id, D.invoice, D.total, D.last_date, D.type, D.status, D.comments, C.name AS nameC, U.name AS nameU FROM documents AS D  INNER JOIN clients AS C ON D.id_client = C.id INNER JOIN users AS U ON D.id_user = U.id INNER JOIN branches AS B ON D.id_branch = B.id WHERE D.id_branch = ".$_SESSION['branchID']." AND D.last_date BETWEEN '" . $desde_fecha . " 00:00:00' AND '" . $hasta_fecha . " 23:59:59'";
  //     $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
  //     $total_efectivo = 0;
  //     $salida_caja = 0;
  //     $entrada_caja = 0;

  //     $efectivo_f = 0;
  //     $cheque_f = 0;
  //     $credito_f = 0;
  //     $debito_f = 0;
  //     $deposito_f = 0;
  //     $transferencia_f = 0;
  //     $no_identificado_f = 0;

  //     $efectivo_c = 0;
  //     $cheque_c = 0;
  //     $credito_c = 0;
  //     $debito_c = 0;
  //     $deposito_c = 0;
  //     $transferencia_c = 0;
  //     $no_identificado_c = 0;

  //     $efectivo_r = 0;
  //     $cheque_r = 0;
  //     $credito_r = 0;
  //     $debito_r = 0;
  //     $deposito_r = 0;
  //     $transferencia_r = 0;
  //     $no_identificado_r = 0;
  //     $table_efectivo_remision = '<div class="force-table-responsive">
  //     <table class="table table-striped">
  //       <thead>
  //         <tr>
  //           <th>Clave</th>
  //           <th>Sucursal</th>
  //           <th>Total</th>
  //           <th>Fecha</th>
  //           <th>Tipo</th>
  //           <th>Status</th>
  //           <th>Cliente</th>
  //           <th>Usuario</th>
  //           <th>Seguimiento</th>
  //         </tr>
  //       </thead>
  //       <tbody id="table">';
  //     $table_cheque_remision = '<div class="force-table-responsive">
  //       <table class="table table-striped">
  //         <thead>
  //           <tr>
  //             <th>Clave</th>
  //             <th>Sucursal</th>
  //             <th>Total</th>
  //             <th>Fecha</th>
  //             <th>Tipo</th>
  //             <th>Status</th>
  //             <th>Cliente</th>
  //             <th>Usuario</th>
  //             <th>Seguimiento</th>
  //           </tr>
  //         </thead>
  //         <tbody id="table">';
  //     $table_tarjeta_credito_remision = '<div class="force-table-responsive">
  //       <table class="table table-striped">
  //         <thead>
  //           <tr>
  //             <th>Clave</th>
  //             <th>Sucursal</th>
  //             <th>Total</th>
  //             <th>Fecha</th>
  //             <th>Tipo</th>
  //             <th>Status</th>
  //             <th>Cliente</th>
  //             <th>Usuario</th>
  //             <th>Seguimiento</th>
  //           </tr>
  //         </thead>
  //         <tbody id="table">';
  //     $table_tarjeta_debito_remision = '<div class="force-table-responsive">
  //       <table class="table table-striped">
  //         <thead>
  //           <tr>
  //             <th>Clave</th>
  //             <th>Sucursal</th>
  //             <th>Total</th>
  //             <th>Fecha</th>
  //             <th>Tipo</th>
  //             <th>Status</th>
  //             <th>Cliente</th>
  //             <th>Usuario</th>
  //             <th>Seguimiento</th>
  //           </tr>
  //         </thead>
  //         <tbody id="table">';
  //     $table_deposito_remision = '<div class="force-table-responsive">
  //       <table class="table table-striped">
  //         <thead>
  //           <tr>
  //             <th>Clave</th>
  //             <th>Sucursal</th>
  //             <th>Total</th>
  //             <th>Fecha</th>
  //             <th>Tipo</th>
  //             <th>Status</th>
  //             <th>Cliente</th>
  //             <th>Usuario</th>
  //             <th>Seguimiento</th>
  //           </tr>
  //         </thead>
  //         <tbody id="table">';
  //     $table_transferencia_remision = '<div class="force-table-responsive">
  //       <table class="table table-striped">
  //         <thead>
  //           <tr>
  //             <th>Clave</th>
  //             <th>Sucursal</th>
  //             <th>Total</th>
  //             <th>Fecha</th>
  //             <th>Tipo</th>
  //             <th>Status</th>
  //             <th>Cliente</th>
  //             <th>Usuario</th>
  //             <th>Seguimiento</th>
  //           </tr>
  //         </thead>
  //         <tbody id="table">';
  //     $table_no_identificado_remision = '<div class="force-table-responsive">
  //       <table class="table table-striped">
  //         <thead>
  //           <tr>
  //             <th>Clave</th>
  //             <th>Sucursal</th>
  //             <th>Total</th>
  //             <th>Fecha</th>
  //             <th>Tipo</th>
  //             <th>Status</th>
  //             <th>Cliente</th>
  //             <th>Usuario</th>
  //             <th>Seguimiento</th>
  //           </tr>
  //         </thead>
  //         <tbody id="table">';
  //         $table_efectivo_credito = '<div class="force-table-responsive">
  //         <table class="table table-striped">
  //           <thead>
  //             <tr>
  //               <th>Clave</th>
  //               <th>Sucursal</th>
  //               <th>Total</th>
  //               <th>Fecha</th>
  //               <th>Tipo</th>
  //               <th>Status</th>
  //               <th>Cliente</th>
  //               <th>Usuario</th>
  //               <th>Seguimiento</th>
  //             </tr>
  //           </thead>
  //           <tbody id="table">';
  //         $table_cheque_credito = '<div class="force-table-responsive">
  //           <table class="table table-striped">
  //             <thead>
  //               <tr>
  //                 <th>Clave</th>
  //                 <th>Sucursal</th>
  //                 <th>Total</th>
  //                 <th>Fecha</th>
  //                 <th>Tipo</th>
  //                 <th>Status</th>
  //                 <th>Cliente</th>
  //                 <th>Usuario</th>
  //                 <th>Seguimiento</th>
  //               </tr>
  //             </thead>
  //             <tbody id="table">';
  //         $table_tarjeta_credito_credito = '<div class="force-table-responsive">
  //           <table class="table table-striped">
  //             <thead>
  //               <tr>
  //                 <th>Clave</th>
  //                 <th>Sucursal</th>
  //                 <th>Total</th>
  //                 <th>Fecha</th>
  //                 <th>Tipo</th>
  //                 <th>Status</th>
  //                 <th>Cliente</th>
  //                 <th>Usuario</th>
  //                 <th>Seguimiento</th>
  //               </tr>
  //             </thead>
  //             <tbody id="table">';
  //         $table_tarjeta_debito_credito = '<div class="force-table-responsive">
  //           <table class="table table-striped">
  //             <thead>
  //               <tr>
  //                 <th>Clave</th>
  //                 <th>Sucursal</th>
  //                 <th>Total</th>
  //                 <th>Fecha</th>
  //                 <th>Tipo</th>
  //                 <th>Status</th>
  //                 <th>Cliente</th>
  //                 <th>Usuario</th>
  //                 <th>Seguimiento</th>
  //               </tr>
  //             </thead>
  //             <tbody id="table">';
  //         $table_deposito_credito = '<div class="force-table-responsive">
  //           <table class="table table-striped">
  //             <thead>
  //               <tr>
  //                 <th>Clave</th>
  //                 <th>Sucursal</th>
  //                 <th>Total</th>
  //                 <th>Fecha</th>
  //                 <th>Tipo</th>
  //                 <th>Status</th>
  //                 <th>Cliente</th>
  //                 <th>Usuario</th>
  //                 <th>Seguimiento</th>
  //               </tr>
  //             </thead>
  //             <tbody id="table">';
  //         $table_transferencia_credito = '<div class="force-table-responsive">
  //           <table class="table table-striped">
  //             <thead>
  //               <tr>
  //                 <th>Clave</th>
  //                 <th>Sucursal</th>
  //                 <th>Total</th>
  //                 <th>Fecha</th>
  //                 <th>Tipo</th>
  //                 <th>Status</th>
  //                 <th>Cliente</th>
  //                 <th>Usuario</th>
  //                 <th>Seguimiento</th>
  //               </tr>
  //             </thead>
  //             <tbody id="table">';
  //         $table_no_identificado_credito = '<div class="force-table-responsive">
  //           <table class="table table-striped">
  //             <thead>
  //               <tr>
  //                 <th>Clave</th>
  //                 <th>Sucursal</th>
  //                 <th>Total</th>
  //                 <th>Fecha</th>
  //                 <th>Tipo</th>
  //                 <th>Status</th>
  //                 <th>Cliente</th>
  //                 <th>Usuario</th>
  //                 <th>Seguimiento</th>
  //               </tr>
  //             </thead>
  //             <tbody id="table">';


  //             $table_efectivo_factura = '<div class="force-table-responsive">
  //             <table class="table table-striped">
  //               <thead>
  //                 <tr>
  //                   <th>Clave</th>
  //                   <th>Sucursal</th>
  //                   <th>Total</th>
  //                   <th>Fecha</th>
  //                   <th>Tipo</th>
  //                   <th>Status</th>
  //                   <th>Cliente</th>
  //                   <th>Usuario</th>
  //                   <th>Seguimiento</th>
  //                 </tr>
  //               </thead>
  //               <tbody id="table">';
  //             $table_cheque_factura = '<div class="force-table-responsive">
  //               <table class="table table-striped">
  //                 <thead>
  //                   <tr>
  //                     <th>Clave</th>
  //                     <th>Sucursal</th>
  //                     <th>Total</th>
  //                     <th>Fecha</th>
  //                     <th>Tipo</th>
  //                     <th>Status</th>
  //                     <th>Cliente</th>
  //                     <th>Usuario</th>
  //                     <th>Seguimiento</th>
  //                   </tr>
  //                 </thead>
  //                 <tbody id="table">';
  //             $table_tarjeta_credito_factura = '<div class="force-table-responsive">
  //               <table class="table table-striped">
  //                 <thead>
  //                   <tr>
  //                     <th>Clave</th>
  //                     <th>Sucursal</th>
  //                     <th>Total</th>
  //                     <th>Fecha</th>
  //                     <th>Tipo</th>
  //                     <th>Status</th>
  //                     <th>Cliente</th>
  //                     <th>Usuario</th>
  //                     <th>Seguimiento</th>
  //                   </tr>
  //                 </thead>
  //                 <tbody id="table">';
  //             $table_tarjeta_debito_factura = '<div class="force-table-responsive">
  //               <table class="table table-striped">
  //                 <thead>
  //                   <tr>
  //                     <th>Clave</th>
  //                     <th>Sucursal</th>
  //                     <th>Total</th>
  //                     <th>Fecha</th>
  //                     <th>Tipo</th>
  //                     <th>Status</th>
  //                     <th>Cliente</th>
  //                     <th>Usuario</th>
  //                     <th>Seguimiento</th>
  //                   </tr>
  //                 </thead>
  //                 <tbody id="table">';
  //             $table_deposito_factura = '<div class="force-table-responsive">
  //               <table class="table table-striped">
  //                 <thead>
  //                   <tr>
  //                     <th>Clave</th>
  //                     <th>Sucursal</th>
  //                     <th>Total</th>
  //                     <th>Fecha</th>
  //                     <th>Tipo</th>
  //                     <th>Status</th>
  //                     <th>Cliente</th>
  //                     <th>Usuario</th>
  //                     <th>Seguimiento</th>
  //                   </tr>
  //                 </thead>
  //                 <tbody id="table">';
  //             $table_transferencia_factura = '<div class="force-table-responsive">
  //               <table class="table table-striped">
  //                 <thead>
  //                   <tr>
  //                     <th>Clave</th>
  //                     <th>Sucursal</th>
  //                     <th>Total</th>
  //                     <th>Fecha</th>
  //                     <th>Tipo</th>
  //                     <th>Status</th>
  //                     <th>Cliente</th>
  //                     <th>Usuario</th>
  //                     <th>Seguimiento</th>
  //                   </tr>
  //                 </thead>
  //                 <tbody id="table">';
  //             $table_no_identificado_factura = '<div class="force-table-responsive">
  //               <table class="table table-striped">
  //                 <thead>
  //                   <tr>
  //                     <th>Clave</th>
  //                     <th>Sucursal</th>
  //                     <th>Total</th>
  //                     <th>Fecha</th>
  //                     <th>Tipo</th>
  //                     <th>Status</th>
  //                     <th>Cliente</th>
  //                     <th>Usuario</th>
  //                     <th>Seguimiento</th>
  //                   </tr>
  //                 </thead>
  //                 <tbody id="table">';
  //     while($row = mysqli_fetch_assoc($result)){
  //       if ($row['payment_method'] === 'Pago en Efectivo') {
  //         $total_efectivo += $row['total'];
  //         if ($row['type'] === 'remission') {
  //           if($row['status'] === 'activo') {
  //             $efectivo_r += $row['total'];
  //           }
  //           $table_efectivo_remision .= '<tr>
  //                   <td>' . $row['invoice'] . '</td>
  //                   <td>' . $row['nameBranch'] . '</td>
  //                   <td>$' . number_format($row['total'], 2, '.', ',') . '</td>
  //                   <td>' . $row['last_date'] . '</td>
  //                   <td>' . $row['type'] . '</td>
  //                   <td>' . $row['status'] . '</td>
  //                   <td>' . $row['nameC'] . '</td>
  //                   <td>' . $row['nameU'] . '</td>
  //                   <td>' . $row['comments'] . '</td>
  //                 </tr>';
  //         }
  //         if ($row['type'] === 'credit') {
  //           if($row['status'] === 'activo') {
  //             $efectivo_c += $row['total'];
  //           }
  //           $table_efectivo_credito .= '<tr>
  //                   <td>' . $row['invoice'] . '</td>
  //                   <td>' . $row['nameBranch'] . '</td>
  //                   <td>$' . number_format($row['total'], 2, '.', ',') . '</td>
  //                   <td>' . $row['last_date'] . '</td>
  //                   <td>' . $row['type'] . '</td>
  //                   <td>' . $row['status'] . '</td>
  //                   <td>' . $row['nameC'] . '</td>
  //                   <td>' . $row['nameU'] . '</td>
  //                   <td>' . $row['comments'] . '</td>
  //                 </tr>';
  //         }
  //         if ($row['type'] === 'invoice') {
  //           if($row['status'] === 'activo') {
  //             $efectivo_f += $row['total'];
  //           }
  //           $table_efectivo_factura .= '<tr>
  //                   <td>' . $row['invoice'] . '</td>
  //                   <td>' . $row['nameBranch'] . '</td>
  //                   <td>$' . number_format($row['total'], 2, '.', ',') . '</td>
  //                   <td>' . $row['last_date'] . '</td>
  //                   <td>' . $row['type'] . '</td>
  //                   <td>' . $row['status'] . '</td>
  //                   <td>' . $row['nameC'] . '</td>
  //                   <td>' . $row['nameU'] . '</td>
  //                   <td>' . $row['comments'] . '</td>
  //                 </tr>';
  //         }
  //       }
  //       if ($row['payment_method'] === 'Cheque Nominativo') {
  //         if ($row['type'] === 'remission') {
  //           if($row['status'] === 'activo') {
  //             $cheque_r += $row['total'];
  //           }
  //           $table_cheque_remision .= '<tr>
  //                   <td>' . $row['invoice'] . '</td>
  //                   <td>' . $row['nameBranch'] . '</td>
  //                   <td>$' . number_format($row['total'], 2, '.', ',') . '</td>
  //                   <td>' . $row['last_date'] . '</td>
  //                   <td>' . $row['type'] . '</td>
  //                   <td>' . $row['status'] . '</td>
  //                   <td>' . $row['nameC'] . '</td>
  //                   <td>' . $row['nameU'] . '</td>
  //                   <td>' . $row['comments'] . '</td>
  //                 </tr>';
  //         }
  //         if ($row['type'] === 'credit') {
  //           if($row['status'] === 'activo') {
  //             $cheque_c += $row['total'];
  //           }
  //           $table_cheque_credito .= '<tr>
  //                   <td>' . $row['invoice'] . '</td>
  //                   <td>' . $row['nameBranch'] . '</td>
  //                   <td>$' . number_format($row['total'], 2, '.', ',') . '</td>
  //                   <td>' . $row['last_date'] . '</td>
  //                   <td>' . $row['type'] . '</td>
  //                   <td>' . $row['status'] . '</td>
  //                   <td>' . $row['nameC'] . '</td>
  //                   <td>' . $row['nameU'] . '</td>
  //                   <td>' . $row['comments'] . '</td>
  //                 </tr>';
  //         }
  //         if ($row['type'] === 'invoice') {
  //           if($row['status'] === 'activo') {
  //             $cheque_f += $row['total'];
  //           }
  //           $table_cheque_factura .= '<tr>
  //                   <td>' . $row['invoice'] . '</td>
  //                   <td>' . $row['nameBranch'] . '</td>
  //                   <td>$' . number_format($row['total'], 2, '.', ',') . '</td>
  //                   <td>' . $row['last_date'] . '</td>
  //                   <td>' . $row['type'] . '</td>
  //                   <td>' . $row['status'] . '</td>
  //                   <td>' . $row['nameC'] . '</td>
  //                   <td>' . $row['nameU'] . '</td>
  //                   <td>' . $row['comments'] . '</td>
  //                 </tr>';
  //         }
  //       }
  //       if ($row['payment_method'] === 'Tarjeta de Credito') {
  //         if ($row['type'] === 'remission') {
  //           if($row['status'] === 'activo') {
  //             $credito_r += $row['total'];
  //           }
  //           $table_tarjeta_credito_remision .= '<tr>
  //                   <td>' . $row['invoice'] . '</td>
  //                   <td>' . $row['nameBranch'] . '</td>
  //                   <td>$' . number_format($row['total'], 2, '.', ',') . '</td>
  //                   <td>' . $row['last_date'] . '</td>
  //                   <td>' . $row['type'] . '</td>
  //                   <td>' . $row['status'] . '</td>
  //                   <td>' . $row['nameC'] . '</td>
  //                   <td>' . $row['nameU'] . '</td>
  //                   <td>' . $row['comments'] . '</td>
  //                 </tr>';
  //         }
  //         if ($row['type'] === 'credit') {
  //           if($row['status'] === 'activo') {
  //             $credito_c += $row['total'];
  //           }
  //           $table_tarjeta_credito_credito .= '<tr>
  //                   <td>' . $row['invoice'] . '</td>
  //                   <td>' . $row['nameBranch'] . '</td>
  //                   <td>$' . number_format($row['total'], 2, '.', ',') . '</td>
  //                   <td>' . $row['last_date'] . '</td>
  //                   <td>' . $row['type'] . '</td>
  //                   <td>' . $row['status'] . '</td>
  //                   <td>' . $row['nameC'] . '</td>
  //                   <td>' . $row['nameU'] . '</td>
  //                   <td>' . $row['comments'] . '</td>
  //                 </tr>';
  //         }
  //         if ($row['type'] === 'invoice') {
  //           if($row['status'] === 'activo') {
  //             $credito_f += $row['total'];
  //           }
  //           $table_tarjeta_credito_factura .= '<tr>
  //                   <td>' . $row['invoice'] . '</td>
  //                   <td>' . $row['nameBranch'] . '</td>
  //                   <td>$' . number_format($row['total'], 2, '.', ',') . '</td>
  //                   <td>' . $row['last_date'] . '</td>
  //                   <td>' . $row['type'] . '</td>
  //                   <td>' . $row['status'] . '</td>
  //                   <td>' . $row['nameC'] . '</td>
  //                   <td>' . $row['nameU'] . '</td>
  //                   <td>' . $row['comments'] . '</td>
  //                 </tr>';
  //         }
  //       }
  //       if ($row['payment_method'] === 'Tarjeta de Debito') {
  //         if ($row['type'] === 'remission') {
  //           if($row['status'] === 'activo') {
  //             $debito_r += $row['total'];
  //           }
  //           $table_tarjeta_debito_remision .= '<tr>
  //                   <td>' . $row['invoice'] . '</td>
  //                   <td>' . $row['nameBranch'] . '</td>
  //                   <td>$' . number_format($row['total'], 2, '.', ',') . '</td>
  //                   <td>' . $row['last_date'] . '</td>
  //                   <td>' . $row['type'] . '</td>
  //                   <td>' . $row['status'] . '</td>
  //                   <td>' . $row['nameC'] . '</td>
  //                   <td>' . $row['nameU'] . '</td>
  //                   <td>' . $row['comments'] . '</td>
  //                 </tr>';
  //         }
  //         if ($row['type'] === 'credit') {
  //           if($row['status'] === 'activo') {
  //             $debito_c += $row['total'];
  //           }
  //           $table_tarjeta_debito_credito .= '<tr>
  //                   <td>' . $row['invoice'] . '</td>
  //                   <td>' . $row['nameBranch'] . '</td>
  //                   <td>$' . number_format($row['total'], 2, '.', ',') . '</td>
  //                   <td>' . $row['last_date'] . '</td>
  //                   <td>' . $row['type'] . '</td>
  //                   <td>' . $row['status'] . '</td>
  //                   <td>' . $row['nameC'] . '</td>
  //                   <td>' . $row['nameU'] . '</td>
  //                   <td>' . $row['comments'] . '</td>
  //                 </tr>';
  //         }
  //         if ($row['type'] === 'invoice') {
  //           if($row['status'] === 'activo') {
  //             $debito_f += $row['total'];
  //           }
  //           $table_tarjeta_debito_factura .= '<tr>
  //                   <td>' . $row['invoice'] . '</td>
  //                   <td>' . $row['nameBranch'] . '</td>
  //                   <td>$' . number_format($row['total'], 2, '.', ',') . '</td>
  //                   <td>' . $row['last_date'] . '</td>
  //                   <td>' . $row['type'] . '</td>
  //                   <td>' . $row['status'] . '</td>
  //                   <td>' . $row['nameC'] . '</td>
  //                   <td>' . $row['nameU'] . '</td>
  //                   <td>' . $row['comments'] . '</td>
  //                 </tr>';
  //         }
  //       }
  //       if ($row['payment_method'] === 'Deposito en Cuenta') {
  //         if ($row['type'] === 'remission') {
  //           if($row['status'] === 'activo') {
  //             $deposito_r += $row['total'];
  //           }
  //           $table_deposito_remision .= '<tr>
  //                   <td>' . $row['invoice'] . '</td>
  //                   <td>' . $row['nameBranch'] . '</td>
  //                   <td>$' . number_format($row['total'], 2, '.', ',') . '</td>
  //                   <td>' . $row['last_date'] . '</td>
  //                   <td>' . $row['type'] . '</td>
  //                   <td>' . $row['status'] . '</td>
  //                   <td>' . $row['nameC'] . '</td>
  //                   <td>' . $row['nameU'] . '</td>
  //                   <td>' . $row['comments'] . '</td>
  //                 </tr>';
  //         }
  //         if ($row['type'] === 'credit') {
  //           if($row['status'] === 'activo') {
  //             $deposito_c += $row['total'];
  //           }
  //           $table_deposito_credito .= '<tr>
  //                   <td>' . $row['invoice'] . '</td>
  //                   <td>' . $row['nameBranch'] . '</td>
  //                   <td>$' . number_format($row['total'], 2, '.', ',') . '</td>
  //                   <td>' . $row['last_date'] . '</td>
  //                   <td>' . $row['type'] . '</td>
  //                   <td>' . $row['status'] . '</td>
  //                   <td>' . $row['nameC'] . '</td>
  //                   <td>' . $row['nameU'] . '</td>
  //                   <td>' . $row['comments'] . '</td>
  //                 </tr>';
  //         }
  //         if ($row['type'] === 'invoice') {
  //           if($row['status'] === 'activo') {
  //             $deposito_f += $row['total'];
  //           }
  //           $table_deposito_factura .= '<tr>
  //                   <td>' . $row['invoice'] . '</td>
  //                   <td>' . $row['nameBranch'] . '</td>
  //                   <td>$' . number_format($row['total'], 2, '.', ',') . '</td>
  //                   <td>' . $row['last_date'] . '</td>
  //                   <td>' . $row['type'] . '</td>
  //                   <td>' . $row['status'] . '</td>
  //                   <td>' . $row['nameC'] . '</td>
  //                   <td>' . $row['nameU'] . '</td>
  //                   <td>' . $row['comments'] . '</td>
  //                 </tr>';
  //         }
  //       }
  //       if ($row['payment_method'] === 'Transferencia Electronica de Fondos') {
  //         if ($row['type'] === 'remission') {
  //           if($row['status'] === 'activo') {
  //             $transferencia_r += $row['total'];
  //           }
  //           $table_transferencia_remision .= '<tr>
  //                   <td>' . $row['invoice'] . '</td>
  //                   <td>' . $row['nameBranch'] . '</td>
  //                   <td>$' . number_format($row['total'], 2, '.', ',') . '</td>
  //                   <td>' . $row['last_date'] . '</td>
  //                   <td>' . $row['type'] . '</td>
  //                   <td>' . $row['status'] . '</td>
  //                   <td>' . $row['nameC'] . '</td>
  //                   <td>' . $row['nameU'] . '</td>
  //                   <td>' . $row['comments'] . '</td>
  //                 </tr>';
  //         }
  //         if ($row['type'] === 'credit') {
  //           if($row['status'] === 'activo') {
  //             $transferencia_c += $row['total'];
  //           }
  //           $table_transferencia_credito .= '<tr>
  //                   <td>' . $row['invoice'] . '</td>
  //                   <td>' . $row['nameBranch'] . '</td>
  //                   <td>$' . number_format($row['total'], 2, '.', ',') . '</td>
  //                   <td>' . $row['last_date'] . '</td>
  //                   <td>' . $row['type'] . '</td>
  //                   <td>' . $row['status'] . '</td>
  //                   <td>' . $row['nameC'] . '</td>
  //                   <td>' . $row['nameU'] . '</td>
  //                   <td>' . $row['comments'] . '</td>
  //                 </tr>';
  //         }
  //         if ($row['type'] === 'invoice') {
  //           if($row['status'] === 'activo') {
  //             $transferencia_f += $row['total'];
  //           }
  //           $table_transferencia_factura .= '<tr>
  //                   <td>' . $row['invoice'] . '</td>
  //                   <td>' . $row['nameBranch'] . '</td>
  //                   <td>$' . number_format($row['total'], 2, '.', ',') . '</td>
  //                   <td>' . $row['last_date'] . '</td>
  //                   <td>' . $row['type'] . '</td>
  //                   <td>' . $row['status'] . '</td>
  //                   <td>' . $row['nameC'] . '</td>
  //                   <td>' . $row['nameU'] . '</td>
  //                   <td>' . $row['comments'] . '</td>
  //                 </tr>';
  //         }
  //       }
  //       if ($row['payment_method'] === 'No Identificado') {
  //         if ($row['type'] === 'remission') {
  //           if($row['status'] === 'activo') {
  //             $no_identificado_r += $row['total'];
  //           }
  //           $table_no_identificado_remision .= '<tr>
  //                   <td>' . $row['invoice'] . '</td>
  //                   <td>' . $row['nameBranch'] . '</td>
  //                   <td>$' . number_format($row['total'], 2, '.', ',') . '</td>
  //                   <td>' . $row['last_date'] . '</td>
  //                   <td>' . $row['type'] . '</td>
  //                   <td>' . $row['status'] . '</td>
  //                   <td>' . $row['nameC'] . '</td>
  //                   <td>' . $row['nameU'] . '</td>
  //                   <td>' . $row['comments'] . '</td>
  //                 </tr>';
  //         }
  //         if ($row['type'] === 'credit') {
  //           if($row['status'] === 'activo') {
  //             $no_identificado_c += $row['total'];
  //           }
  //           $table_no_identificado_credito .= '<tr>
  //                   <td>' . $row['invoice'] . '</td>
  //                   <td>' . $row['nameBranch'] . '</td>
  //                   <td>$' . number_format($row['total'], 2, '.', ',') . '</td>
  //                   <td>' . $row['last_date'] . '</td>
  //                   <td>' . $row['type'] . '</td>
  //                   <td>' . $row['status'] . '</td>
  //                   <td>' . $row['nameC'] . '</td>
  //                   <td>' . $row['nameU'] . '</td>
  //                   <td>' . $row['comments'] . '</td>
  //                 </tr>';
  //         }
  //         if ($row['type'] === 'invoice') {
  //           if($row['status'] === 'activo') {
  //             $no_identificado_f += $row['total'];
  //           }
  //           $table_no_identificado_factura .= '<tr>
  //                   <td>' . $row['invoice'] . '</td>
  //                   <td>' . $row['nameBranch'] . '</td>
  //                   <td>$' . number_format($row['total'], 2, '.', ',') . '</td>
  //                   <td>' . $row['last_date'] . '</td>
  //                   <td>' . $row['type'] . '</td>
  //                   <td>' . $row['status'] . '</td>
  //                   <td>' . $row['nameC'] . '</td>
  //                   <td>' . $row['nameU'] . '</td>
  //                   <td>' . $row['comments'] . '</td>
  //                 </tr>';
  //         }
  //       }
  //     }
  //     $table_efectivo_remision .= '</tbody></table></div>';
  //     $table_cheque_remision .= '</tbody></table></div>';
  //     $table_tarjeta_debito_remision .= '</tbody></table></div>';
  //     $table_tarjeta_credito_remision .= '</tbody></table></div>';
  //     $table_deposito_remision .= '</tbody></table></div>';
  //     $table_transferencia_remision .= '</tbody></table></div>';
  //     $table_no_identificado_remision .= '</tbody></table></div>';

  //     $table_efectivo_credito .= '</tbody></table></div>';
  //     $table_cheque_credito .= '</tbody></table></div>';
  //     $table_tarjeta_debito_credito .= '</tbody></table></div>';
  //     $table_tarjeta_credito_credito .= '</tbody></table></div>';
  //     $table_deposito_credito .= '</tbody></table></div>';
  //     $table_transferencia_credito .= '</tbody></table></div>';
  //     $table_no_identificado_credito .= '</tbody></table></div>';

  //     $table_efectivo_factura .= '</tbody></table></div>';
  //     $table_cheque_factura .= '</tbody></table></div>';
  //     $table_tarjeta_debito_factura .= '</tbody></table></div>';
  //     $table_tarjeta_credito_factura .= '</tbody></table></div>';
  //     $table_deposito_factura .= '</tbody></table></div>';
  //     $table_transferencia_factura .= '</tbody></table></div>';
  //     $table_no_identificado_factura .= '</tbody></table></div>';

  //     $query_out = "SELECT * FROM cash_out WHERE status='out' AND last_date BETWEEN '" . $desde_fecha . " 00:00:00' AND '" . $hasta_fecha . " 23:59:59'";
  //     $result_out = mysqli_query($link,$query_out) or die ('Consulta fallida: ' . mysqli_error($link));
  //     while($row_out = mysqli_fetch_assoc($result_out)){
  //       $salida_caja += $row_out['cantidad'];
  //     }

  //     $query_out = "SELECT * FROM cash_out WHERE status='in' AND last_date BETWEEN '" . $desde_fecha . " 00:00:00' AND '" . $hasta_fecha . " 23:59:59'";
  //     $result_out = mysqli_query($link,$query_out) or die ('Consulta fallida: ' . mysqli_error($link));
  //     while($row_out = mysqli_fetch_assoc($result_out)){
  //       $entrada_caja += $row_out['cantidad'];
  //     }
  // $total_pagos_para_credito=0;
  //     $query = "SELECT paid_out FROM credit_paid WHERE last_date BETWEEN '" . $desde_fecha . " 00:00:00' AND '" . $hasta_fecha . " 23:59:59'";
  //     $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
  //     while($row = mysqli_fetch_assoc($result)){
  //       $total_pagos_para_credito += $row['paid_out'];
  //     }

  //     $total_efectivo -= $salida_caja;
  //     $total_efectivo += $entrada_caja;
  //     $total_efectivo += 500;
  //     $total_efectivo += $total_pagos_para_credito;
  //     $table_efectivo_remision .= '</tbody></table></div>';

  //     echo '<div class="col-md-12">
  //       <div class="col-md-6">
  //         <h3><strong>Total <strong>efectivo</strong> en caja:</strong></h3>
  //           <label id="total-efectivo" class="form-label">$' . number_format($total_efectivo, 2, '.', ',') . '</label>
  //       </div>
  //     </div>
  //     <div class="col-md-12">
  //       <div class="col-md-6">
  //         <h3><strong>Salida de <strong>caja:</strong> </strong></h3>
  //           <label id="salida-caja" class="form-label">$' . number_format($salida_caja, 2, '.', ',') . '</label>
  //       </div>
  //       <div class="col-md-6">
  //         <h3><strong>Entrada de <strong>caja:</strong> </strong></h3>
  //           <label id="entrada-caja" class="form-label">$' . number_format($entrada_caja, 2, '.', ',') . '</label>
  //       </div>
  //     </div>';

  //     echo '<div class="col-md-12 border-top" style="border-top:1px;">
  //       <h2>Ventas <strong>Factura</strong></h2>
  //         <h3><strong>Efectivo: </strong></h3>
  //           <label id="efectivo" class="form-label">$' . number_format($efectivo_f, 2, '.', ',') . '</label>
  //           ';
  //           echo $table_efectivo_factura;
  //           echo '
  //           <h3><strong>Cheque Nominativo: </strong></h3>
  //           <label id="cheque" class="form-label">$' . number_format($cheque_f, 2, '.', ',') . '</label>
  //           ';
  //           echo $table_cheque_factura;
  //           echo '
  //           <h3><strong>Tarjeta de Credito: </strong></h3>
  //           <label id="credito" class="form-label">$' . number_format($credito_f, 2, '.', ',') . '</label>
  //           ';
  //           echo $table_tarjeta_credito_factura;
  //           echo '
  //           <h3><strong>Tarjeta de Debito: </strong></h3>
  //           <label id="debito" class="form-label">$' . number_format($debito_f, 2, '.', ',') . '</label>
  //           ';
  //           echo $table_tarjeta_debito_factura;
  //           echo '
  //         <h3><strong>Deposito Bancario: </strong></h3>
  //         <label id="deposito" class="form-label">$' . number_format($deposito_f, 2, '.', ',') . '</label>
  //         ';
  //         echo $table_deposito_factura;
  //         echo '
  //         <h3><strong>Transferencia Interbancaria: </strong></h3>
  //         <label id="transferencia" class="form-label">$' . number_format($transferencia_f, 2, '.', ',') . '</label>
  //         ';
  //         echo $table_transferencia_factura;
  //         echo '
  //         <h3><strong>No Identificado: </strong></h3>
  //         <label id="no-identificado" class="form-label">$' . number_format($no_identificado_f, 2, '.', ',') . '</label>
  //         ';
  //         echo $table_no_identificado_factura;
  //         echo '
  //     </div>';

  //     echo '<div class="col-md-12 border-top" style="border-top:1px;">
  //       <h2>Ventas <strong>Credito</strong></h2>
  //         <h3><strong>Efectivo: </strong></h3>
  //           <label id="efectivo" class="form-label">$' . number_format($efectivo_c, 2, '.', ',') . '</label>
  //           ';
  //           echo $table_efectivo_credito;
  //           echo '
  //           <h3><strong>Cheque Nominativo: </strong></h3>
  //           <label id="cheque" class="form-label">$' . number_format($cheque_c, 2, '.', ',') . '</label>
  //           ';
  //           echo $table_cheque_credito;
  //           echo '
  //           <h3><strong>Tarjeta de Credito: </strong></h3>
  //           <label id="credito" class="form-label">$' . number_format($credito_c, 2, '.', ',') . '</label>
  //           ';
  //           echo $table_tarjeta_credito_credito;
  //           echo '
  //           <h3><strong>Tarjeta de Debito: </strong></h3>
  //           <label id="debito" class="form-label">$' . number_format($debito_c, 2, '.', ',') . '</label>
  //           ';
  //           echo $table_tarjeta_debito_credito;
  //           echo '
  //         <h3><strong>Deposito Bancario: </strong></h3>
  //         <label id="deposito" class="form-label">$' . number_format($deposito_c, 2, '.', ',') . '</label>
  //         ';
  //         echo $table_deposito_credito;
  //         echo '
  //         <h3><strong>Transferencia Interbancaria: </strong></h3>
  //         <label id="transferencia" class="form-label">$' . number_format($transferencia_c, 2, '.', ',') . '</label>
  //         ';
  //         echo $table_transferencia_credito;
  //         echo '
  //         <h3><strong>No Identificado: </strong></h3>
  //         <label id="no-identificado" class="form-label">$' . number_format($no_identificado_c, 2, '.', ',') . '</label>
  //         ';
  //         echo $table_no_identificado_credito;
  //         echo '
  //     </div>';

  //     echo '<div class="col-md-12 border-top" style="border-top:1px;">
  //       <h2>Ventas <strong>Remisión</strong></h2>
  //         <h3><strong>Efectivo: </strong></h3>
  //           <label id="efectivo" class="form-label">$' . number_format($efectivo_r, 2, '.', ',') . '</label>
  //           ';
  //           echo $table_efectivo_remision;
  //           echo '
  //           <h3><strong>Cheque Nominativo: </strong></h3>
  //           <label id="cheque" class="form-label">$' . number_format($cheque_r, 2, '.', ',') . '</label>
  //           ';
  //           echo $table_cheque_remision;
  //           echo '
  //           <h3><strong>Tarjeta de Credito: </strong></h3>
  //           <label id="credito" class="form-label">$' . number_format($credito_r, 2, '.', ',') . '</label>
  //           ';
  //           echo $table_tarjeta_credito_remision;
  //           echo '
  //           <h3><strong>Tarjeta de Debito: </strong></h3>
  //           <label id="debito" class="form-label">$' . number_format($debito_r, 2, '.', ',') . '</label>
  //           ';
  //           echo $table_tarjeta_debito_remision;
  //           echo '
  //         <h3><strong>Deposito Bancario: </strong></h3>
  //         <label id="deposito" class="form-label">$' . number_format($deposito_r, 2, '.', ',') . '</label>
  //         ';
  //         echo $table_deposito_remision;
  //         echo '
  //         <h3><strong>Transferencia Interbancaria: </strong></h3>
  //         <label id="transferencia" class="form-label">$' . number_format($transferencia_r, 2, '.', ',') . '</label>
  //         ';
  //         echo $table_transferencia_remision;
  //         echo '
  //         <h3><strong>No Identificado: </strong></h3>
  //         <label id="no-identificado" class="form-label">$' . number_format($no_identificado_r, 2, '.', ',') . '</label>
  //         ';
  //         echo $table_no_identificado_remision;
  //         echo '
  //     </div>';



      //tabla salida de caja
          $total_salida_caja = 0;
          $salidas_de_caja = '<div class="force-table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Comprobante</th>
                  <th>Descripcion</th>
                  <th>Cantidad</th>
                  <th>Usuario</th>
                  <th>Fecha</th>
                </tr>
              </thead>
              <tbody id="table">';
          $query = "SELECT OU.comprobante, OU.descripcion, OU.cantidad, OU.last_date, C.name FROM cash_out AS OU INNER JOIN users AS C ON  OU.id_user = C.id WHERE OU.status='out' AND OU.last_date BETWEEN '" . $desde_fecha . " 00:00:00' AND '" . $hasta_fecha . " 23:59:59'";
          $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
          while($row = mysqli_fetch_assoc($result)){
            $salidas_de_caja .= '<tr>
                    <td>' . $row['comprobante'] . '</td>
                    <td>' . $row['descripcion'] . '</td>
                    <td>$' . number_format($row['cantidad'], 2, '.', ',') . '</td>
                    <td>' . $row['name'] . '</td>
                    <td>' . $row['last_date'] . '</td>
                  </tr>';
            $total_salida_caja += $row['cantidad'];
          }
          $salidas_de_caja .= '</tbody></table></div>';

          echo '<div class="col-md-12 border-top" style="border-top:1px;">
            <h2>Salida de <strong>Caja</strong></h2>
              <h3><strong>Resumen </strong></h3>
                <label id="efectivo" class="form-label">$' . number_format($total_salida_caja, 2, '.', ',') . '</label>
                ';
                echo $salidas_de_caja;
              echo '
          </div>';



  //tabla entrada de caja
      $total_entrada_caja = 0;
      $entradas_de_caja = '<div class="force-table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Comprobante</th>
              <th>Descripcion</th>
              <th>Cantidad</th>
              <th>Usuario</th>
              <th>Fecha</th>
            </tr>
          </thead>
          <tbody id="table">';
      $query = "SELECT OU.comprobante, OU.descripcion, OU.cantidad, OU.last_date, C.name FROM cash_out AS OU INNER JOIN users AS C ON  OU.id_user = C.id WHERE OU.status='in' AND OU.last_date BETWEEN '" . $desde_fecha . " 00:00:00' AND '" . $hasta_fecha . " 23:59:59'";
      $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
      while($row = mysqli_fetch_assoc($result)){
        $entradas_de_caja .= '<tr>
                <td>' . $row['comprobante'] . '</td>
                <td>' . $row['descripcion'] . '</td>
                <td>$' . number_format($row['cantidad'], 2, '.', ',') . '</td>
                <td>' . $row['name'] . '</td>
                <td>' . $row['last_date'] . '</td>
              </tr>';
        $total_entrada_caja += $row['cantidad'];
      }
      $entradas_de_caja .= '</tbody></table></div>';

      echo '<div class="col-md-12 border-top" style="border-top:1px;">
        <h2>Entrada de <strong>Caja</strong></h2>
          <h3><strong>Resumen </strong></h3>
            <label id="efectivo" class="form-label">$' . number_format($total_entrada_caja, 2, '.', ',') . '</label>
            ';
            echo $entradas_de_caja;
          echo '
      </div>';


  //tabla pagos a credito
      $total_pagos_credito = 0;
      $pagos_credito = '<div class="force-table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Clave</th>
              <th>Sucursal</th>
              <th>Abono</th>
              <th>Cliente</th>
              <th>Usuario</th>
              <th>Fecha</th>
            </tr>
          </thead>
          <tbody id="table">';
      $query = "SELECT D.invoice, CP.paid_out, C.name AS nameC, U.name AS nameU, CP.last_date FROM credit_paid AS CP INNER JOIN documents AS D ON CP.id_document = D.id INNER JOIN clients AS C ON D.id_client = C.id INNER JOIN users AS U ON D.id_user = U.id WHERE CP.last_date BETWEEN '" . $desde_fecha . " 00:00:00' AND '" . $hasta_fecha . " 23:59:59'";
      $result = mysqli_query($link,$query) or die ('Consulta fallida: ' . mysqli_error($link));
      while($row = mysqli_fetch_assoc($result)){
        $pagos_credito .= '<tr>
                <td>' . $row['invoice'] . '</td>
                <td>' . $row['nameBranch'] . '</td>
                <td>$' . number_format($row['paid_out'], 2, '.', ',') . '</td>
                <td>' . $row['nameC'] . '</td>
                <td>' . $row['nameU'] . '</td>
                <td>' . $row['last_date'] . '</td>
              </tr>';
        $total_pagos_credito += $row['paid_out'];
      }
      $pagos_credito .= '</tbody></table></div>';

      echo '<div class="col-md-12 border-top" style="border-top:1px;">
        <h2>Pagos de  <strong>Credito</strong></h2>
          <h3><strong>Resumen </strong></h3>
            <label id="efectivo" class="form-label">$' . number_format($total_pagos_credito, 2, '.', ',') . '</label>
            ';
            echo $pagos_credito;
          echo '
      </div>';
    } else {
      echo 'noPermit';
    }
  }
  mysqli_close($link);
 ?>
