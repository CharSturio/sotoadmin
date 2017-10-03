<?php 
session_start();
if($_SESSION['MovCotGen'] == 'true'){
  echo '<div class="header">
  <h2><strong>Cotizador</strong></h2>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="panel">
      <div class="panel-header">
        <h3><i class="icon-bulb"></i>Cotizador </h3>
      </div>
      <div class="panel-content p-t-0">
        <p>Escoge el cliente, escoge los productos y las cantidades y da clic en el Botón segun lo que se desee hacer.</p>
        <div class="row">
          <div class="col-md-12 border-top" style="border-top:1px;">
            <div class="panel-content force-table-responsive">
              <div class="col-md-12">
                <h4>Cliente</h4>
                <div class="col-md-6">
                  <div class="col-md-8">
                    <label>Nombre de Cliente</label>
                    <input id="clientName" type="text" class="form-control" placeholder="Filtrar por Nombre de Cliente">
                  </div>
                  <div class="col-md-4">
                    <br />
                    <button onclick="onClickClients()" type="button" class="btn btn-primary btn-square">Buscar</button>
                  </div>
                </div>
                <div class="col-md-6">
                  <p id="nameClient" class="form-label"></p>
                  <p id="credit" class="form-label"></p>
                  <p id="typeCost" class="form-label"></p>
                </div>
                <div id="response" class="col-md-12">

                </div>
              </div>
              <div class="col-md-12 border-top">
                <h4>Productos</h4>
                <div class="col-md-4">
                  <label>Codigo de Barras</label>
                  <input id="barcode" type="text" class="form-control" placeholder="Filtrar por Codigo de Barras">
                </div>
                <div class="col-md-3">
                  <label>Clave</label>
                  <input id="key" type="text" class="form-control" placeholder="Filtrar por Clave">
                </div>
                <div class="col-md-3">
                  <label>Nombre de Producto</label>
                  <input id="productName" type="text" class="form-control" placeholder="Filtrar por Nombre de Producto">
                </div>
                <div class="col-md-2">
                  <br  />
                  <button onclick="onClickProducts()" type="button" class="btn btn-primary btn-square">Buscar</button>
                </div>
              </div>
              <div class="col-md-12 border-top">
                <table class="table table-striped tablet-tools ">
                  <thead>
                    <tr>
                      <th>Existencia</th>
                      <th>Cantidad</th>
                      <th>Tipo Producto</th>
                      <th>Sucursal</th>
                      <th>Codigo</th>
                      <th>Clave</th>
                      <th>Marca</th>
                      <th>Modelo</th>
                      <th>Nombre</th>
                      <th>Precios</th>
                      <th>Agregar</th>
                    </tr>
                  </thead>
                  <tbody id="responseProduct">

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="panel">
      <div class="panel-content p-t-0">
        <div class="row">
          <div class="col-md-12 border-top force-table-responsive">
            <table class="table table-striped tablet-tools ">
              <thead>
                <tr>
                  <th>Quitar</th>
                  <th>Tipo Producto</th>
                  <th>Sucursal</th>
                  <th>Marca</th>
                  <th>Modelo</th>
                  <th>Nombre</th>
                  <th>Cantidad</th>
                  <th>Precio x Pieza</th>
                  <th>Sub Total</th>
                </tr>
              </thead>
              <tbody id="bodyProducts">

              </tbody>
            </table>
          </div>
          <div class="col-md-12">
            <button data-toggle="modal" data-target="#modal-bootstrap-timepicker" onClick="onClickInvoice()" type="button" class="btn btn-success btn-square">Factura</button>
            <button data-toggle="modal" data-target="#modal-bootstrap-timepicker" onClick="onClickRemission()" type="button" class="btn btn-primary btn-square">Remision</button>
            <button data-toggle="modal" data-target="#modal-bootstrap-timepicker" onClick="onClickCredit()" type="button" class="btn btn-warning btn-square">Credito</button>
            <button onClick="onClickCancelAll()" type="button" class="btn btn-danger btn-square">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="assets/js/views/quoter.js"></script>
<div class="modal fade" id="modal-bootstrap-timepicker" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
        <div id="titleOperation">

        </div>
        <p id="nameClient2" class="form-label"></p>
      </div>
      <div class="modal-body">
        <p>Escoge los datos y da clic en Finalizar para generar, imprimir y enviar el documento.</p>
        <div class="row">
          <div class="col-md-12 border-top" style="border-top:1px;">
            <div class="panel-content">
              <!--<table class="table table-striped tablet-tools ">
                <thead>
                  <tr>
                    <th>Quitar</th>
                    <th>Tipo Producto</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Nombre</th>
                    <th>Precio x Pieza</th>
                    <th>Cantidad</th>
                    <th>Sub Total</th>
                  </tr>
                </thead>
                <tbody id="bodyProducts2">

                </tbody>
              </table>-->
              <div class="col-md-12">
                <div class="col-md-8">
                  <div class="form-group">
                    <label>Numero de Guía</label>
                    <input id="guideNumber" type="text" class="form-control" placeholder="XXXXXXXX">
                    <label>Metodo de Pago</label>
                    <select id="paymentMethod" class="form-control" data-placeholder="Selecciona Estatus">
                      <option value="Cheque Nominativo">Cheque Nominativo</option>
                      <option value="Tarjeta de Credito">Tarjeta de Crédito</option>
                      <option value="Tarjeta de Debito">Tarjeta de Débito</option>
                      <option value="Deposito en Cuenta">Deposito en Cuenta</option>
                      <option value="Pago en Efectivo">Pago en Efectivo</option>
                      <option value="Transferencia Electronica de Fondos">Transferencia Electronica de Fondos</option>
                      <option value="No Identificado">No Identificado</option>
                    </select>
                    <label>Ultimos Digitos</label>
                    <input id="lastDigits" type="text" class="form-control" placeholder="Ej: 123">
                    <label class="form-label">Seguimiento</label>
                    <textarea id="comments" type="text" class="form-control">

                    </textarea>
                    <label>Días de Credito</label>
                    <input id="diasCredito" type="text" class="form-control" placeholder="Ej: 15">
                  </div>
                </div>
                <div class="col-md-2">

                </div>
                <div class="col-md-2" id="buttons">

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>';
} else {
  echo '
    <script type="text/javascript">
    alert("No cuenta con los permisos necesarios.");
    </script>
  ';
}
