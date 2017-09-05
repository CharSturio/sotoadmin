<?php 
session_start();
if($_SESSION['RegProGen'] == 'true'){
  echo '<div class="header">
  <h2><strong>Productos</strong></h2>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="panel">
      <div class="panel-header">
        <h3><i class="icon-bulb"></i> Crear | Modificar | Suspender <strong>Productos</strong></h3>
      </div>
      <div class="panel-content p-t-0">
        <p> Favor de agregar todos los campos con *. Para modificar información, solo edita y da clic en el botón Editar.</p>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group col-md-6">
              <label for="permisos">Tipo de Producto</label>
              <select id="typeProduct" class="form-control" name="favoriteNumber">
                <option value="llantas">Llantas</option>
                <option value="rines">Rines</option>
                <option value="productos">Productos y Accesorios</option>
              </select>
            </div>
          </div>
          <div class="col-md-6">
              <label class="form-label">Código de Barras</label>
              <input id="barcode" type="text" class="form-control" placeholder="Ingrese Código de Barras">
              <label class="form-label">Nombre</label>
              <input id="name" type="text" class="form-control" placeholder="Ingrese Nombre">
              <label class="form-label">Descripción</label>
              <input id="description" type="text" class="form-control" placeholder="Ingrese Descripción">
          </div>
          <div class="col-md-6">
              <label class="form-label">Clave</label>
              <input id="key" type="text" class="form-control" placeholder="Ingrese Clave">
              <label class="form-label">Marca</label>
              <input id="brand" type="text" class="form-control" placeholder="Ingrese Marca">
              <label class="form-label">Modelo</label>
              <input id="model" type="text" class="form-control" placeholder="Ingrese Modelo">
          </div>
          <div class="col-md-12 border-top" style="border-top:1px;">
            <div class="col-md-6">
              <h3>Solo para <strong>Llantas</strong></h3>
                <label class="form-label">Medida</label>
                <input id="measure" type="text" class="form-control" placeholder="Ingrese Medida">
                <label class="form-label">Treadware</label>
                <input id="treadware" type="text" class="form-control" placeholder="Ingrese Treadware">
                <label class="form-label">Ind Carga</label>
                <input id="loadIndex" type="text" class="form-control" placeholder="Ingrese Ind Carga">
                <label class="form-label">Ind Velocidad</label>
                <input id="loadSpeed" type="text" class="form-control" placeholder="Ingrese Ind Velocidad">
            </div>
            <div class="col-md-6">
              <h3>Precios de <strong>Venta</strong></h3>
              <label class="form-label">Precio Venta Publico</label>
              <input id="retailPrice" type="text" class="form-control" placeholder="Ingrese Precio Venta Publico">
              <label class="form-label">Precio Mayore</label>
              <input id="wholesalePrice" type="text" class="form-control" placeholder="Ingrese Precio Mayore">
              <label class="form-label">Precio Especial</label>
              <input id="specialPrice" type="text" class="form-control" placeholder="Ingrese Precio Especial">
              <label class="form-label">Precio Tarjeta</label>
              <input id="tarjeta" type="text" class="form-control" placeholder="Ingrese Precio Tarjeta">
              <label class="form-label">Precio Mercado Pago</label>
              <input id="mpago" type="text" class="form-control" placeholder="Ingrese Precio Mercado Pago">
              <label class="form-label">Precio Publico Especial</label>
              <input id="pespecial" type="text" class="form-control" placeholder="Ingrese Precio Publico Especial">
            </div>
          </div>
          <div class="col-md-12">
            <button onClick="onClickNew()" type="button" class="btn btn-primary btn-square">Crear</button>
            <button class="btn btn-dark m-t-5" data-toggle="modal" data-target="#modal-bootstrap-timepicker">Escoger Producto</button>
            <button onClick="onClickModify()" type="button" class="btn btn-primary btn-square">Modificar</button>
            <button onClick="onClickModifyCosts()" type="button" class="btn btn-success btn-square">Modificar Precios</button>
            <button onClick="onClickDelete()" type="button" class="btn btn-danger btn-square">Eliminar</button>
          </div>
          <div id="response">

          </div>
          <div id="divProducts" class="col-md-12">

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="assets/js/views/products.js"></script>
<div class="modal fade" id="modal-bootstrap-timepicker" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
        <h4 class="modal-title"><strong>Seleccion de </strong> Producto</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <h3>Escribe tu busqueda, y da clic en Buscar.</h3>
          <div class="col-md-6">
            <label class="form-label">Nombre</label>
            <input id="nameProduct" type="text" class="form-control" placeholder="Ingrese el nombre del producto...">
            <button onclick="onClickBrowserName()" type="button" class="btn btn-primary btn-embossed" data-dismiss="modal">Seleccionar</button>
          </div>
          <div class="col-md-6">
            <label class="form-label">Código de Barras</label>
            <input id="barcodeProduct" type="text" class="form-control" placeholder="Ingrese el código de barras...">
            <button onclick="onClickBrowserBarcode()" type="button" class="btn btn-primary btn-embossed" data-dismiss="modal">Seleccionar</button>
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
