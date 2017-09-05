<?php 
session_start();
if($_SESSION['UtiPerGen'] == 'true'){
  echo '<div class="header">
  <h2><strong>Permisos</strong></h2>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="panel">
      <div class="panel-header">
        <h3><i class="icon-bulb"></i> Crear | Modificar <strong>Permisos</strong></h3>
      </div>
      <div class="panel-content">
        <p>Favor de escoger un Nombre de Permiso para Editar, o simplemente Asigne un nombre y de Guardar para que se guarde un nuevo Permiso.</p>
        <div class="row">
          <div class="col-md-6">
              <label class="form-label">Nombre de Permiso</label>
              <input id="permission" type="text" class="form-control" placeholder="Ingrese Nombre de Permiso">
          </div>
          <div class="col-md-12">
            <button onClick="onClickNew()" type="button" class="btn btn-success btn-square">Crear</button>
            <button onclick="onClickPermissions()" class="btn btn-dark m-t-5" data-toggle="modal" data-target="#modal-bootstrap-timepicker">Escoger Permiso</button>
            <button onclick="onClickModify()" type="button" class="btn btn-primary btn-square">Modificar</button>
            <button onclick="onClickDelete()" type="button" class="btn btn-danger btn-square">Eliminar</button>       
            <div id="response">
            </div>     
          </div>
          
          <div class="col-md-6">
            <h3><strong>Registro</strong></h3>
            <div class="panel-group panel-accordion" id="accordion">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4>
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#usersP">
                      Usuarios
                    </a>
                  </h4>
                </div>
                <div id="usersP" class="panel-collapse collapse">
                  <div class="panel-body">
                    <div class="col-md-6">
                      <b>General</b>
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="RegUsuGen" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Crear
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="RegUsuCre" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Modificar
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="RegUsuMod" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Eliminar
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="RegUsuEli" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Ver
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="RegUsuVer" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4>
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#clientsP">
                      Clientes
                    </a>
                  </h4>
                </div>
                <div id="clientsP" class="panel-collapse collapse">
                  <div class="panel-body">
                    <div class="col-md-6">
                      <b>General</b>
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="RegCliGen" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Crear
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="RegCliCre" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Modificar
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="RegCliMod" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Eliminar
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="RegCliEli" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Ver
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="RegCliVer" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4>
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#branchesP">
                      Sucursales
                    </a>
                  </h4>
                </div>
                <div id="branchesP" class="panel-collapse collapse">
                  <div class="panel-body">
                    <div class="col-md-6">
                      <b>General</b>
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="RegSucGen" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Crear
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="RegSucCre" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Modificar
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="RegSucMod" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Eliminar
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="RegSucEli" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Ver
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="RegSucVer" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4>
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#productsP">
                      Productos
                    </a>
                  </h4>
                </div>
                <div id="productsP" class="panel-collapse collapse">
                  <div class="panel-body">
                    <div class="col-md-6">
                      <b>General</b>
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="RegProGen" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Crear
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="RegProCre" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Modificar
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="RegProMod" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Modificar Precios
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="RegProModPre" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Eliminar
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="RegProEli" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Ver
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="RegProVer" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <h3><strong>Utilerias</strong></h3>
            <div class="panel-group panel-accordion" id="accordion">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4>
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#creditP">
                      Credito y Cobranza
                    </a>
                  </h4>
                </div>
                <div id="creditP" class="panel-collapse collapse">
                  <div class="panel-body">
                    <div class="col-md-6">
                      <b>General</b>
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="UtiCyCGen" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Buscar
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="UtiCyCBus" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Seguimiento
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="UtiCyCSeg" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Pagos
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="UtiCyCPag" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Seguimiento Interno
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="UtiCyCSegInt" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4>
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#SendMercP">
                      Envio Mercancia
                    </a>
                  </h4>
                </div>
                <div id="SendMercP" class="panel-collapse collapse">
                  <div class="panel-body">
                    <div class="col-md-6">
                      <b>General</b>
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="UtiEnvMerGen" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Enviar
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="UtiEnvMerEnv" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4>
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#cutBoxP">
                      Corte de Caja
                    </a>
                  </h4>
                </div>
                <div id="cutBoxP" class="panel-collapse collapse">
                  <div class="panel-body">
                    <div class="col-md-6">
                      <b>General</b>
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="UtiCCGen" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Corte de Caja
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="UtiCCCorCaj" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      PDF
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="UtiCCPdf" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Enviar por correo
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="UtiCCEnv" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4>
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#inOutBoxP">
                      Entrada y Salida Caja
                    </a>
                  </h4>
                </div>
                <div id="inOutBoxP" class="panel-collapse collapse">
                  <div class="panel-body">
                    <div class="col-md-6">
                      <b>General</b>
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="UtiEySCGen" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Agregar Salida
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="UtiEySCAgrSal" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Agregar Entrada
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="UtiEySCAgrEnt" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4>
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#minStockP">
                      Stocks Minimos
                    </a>
                  </h4>
                </div>
                <div id="minStockP" class="panel-collapse collapse">
                  <div class="panel-body">
                    <div class="col-md-6">
                      <b>General</b>
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="UtiStoMinGen" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Enviar
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="UtiStoMinEnv" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4>
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#permisionsP">
                      Permisos
                    </a>
                  </h4>
                </div>
                <div id="permisionsP" class="panel-collapse collapse">
                  <div class="panel-body">
                    <div class="col-md-6">
                      <b>General</b>
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="UtiPerGen" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Crear
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="UtiPerCre" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Modificar
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="UtiPerMod" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Eliminar
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="UtiPerEli" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Ver
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="UtiPerVer" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <h3><strong>Movimientos</strong></h3>
            <div class="panel-group panel-accordion" id="accordion">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4>
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#ListP">
                      Listado
                    </a>
                  </h4>
                </div>
                <div id="ListP" class="panel-collapse collapse">
                  <div class="panel-body">
                    <div class="col-md-6">
                      <b>General</b>
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="MovLisGen" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Buscar
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="MovLisBus" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Timbrar
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="MovLisTim" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Descargar
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="MovLisDes" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Enviar
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="MovLisEnv" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Eliminar
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="MovLisEli" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4>
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#QuotationP">
                      Cotizador
                    </a>
                  </h4>
                </div>
                <div id="QuotationP" class="panel-collapse collapse">
                  <div class="panel-body">
                    <div class="col-md-6">
                      <b>General</b>
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="MovCotGen" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Buscar Cliente
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="MovCotBusCli" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Buscar Producto
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="MovCotBusPro" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Facturar
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="MovCotFac" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Remision
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="MovCotRem" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Credito
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="MovCotCre" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Cancelar
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="MovCotCan" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4>
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#inventP">
                      Inventarios
                    </a>
                  </h4>
                </div>
                <div id="inventP" class="panel-collapse collapse">
                  <div class="panel-body">
                    <div class="col-md-6">
                      <b>General</b>
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="MovInvGen" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Buscar
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="MovInvBus" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Modificar
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="MovInvMod" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Entrada por devolucion
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="MovInvEntDev" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Salida por devolucion
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="MovInvSalDev" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4>
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#inMercP">
                      Entrada Mercancia
                    </a>
                  </h4>
                </div>
                <div id="inMercP" class="panel-collapse collapse">
                  <div class="panel-body">
                    <div class="col-md-6">
                      <b>General</b>
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="MovEntMerGen" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Buscar
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="MovEntMerBus" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Agregar
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="MovEntMerAgr" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <h3><strong>Reportes</strong></h3>
            <div class="panel-group panel-accordion" id="accordion">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4>
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#invoiseP">
                      Facturas
                    </a>
                  </h4>
                </div>
                <div id="invoiseP" class="panel-collapse collapse">
                  <div class="panel-body">
                    <div class="col-md-6">
                      <b>General</b>
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="RepFacGen" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Ver
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="RepFacVer" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Descargar
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="RepFacDes" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4>
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#merccinvP">
                      Mercancia c/inventarios
                    </a>
                  </h4>
                </div>
                <div id="merccinvP" class="panel-collapse collapse">
                  <div class="panel-body">
                    <div class="col-md-6">
                      <b>General</b>
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="RepMerCInvGen" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      ver
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="RepMerCInvVer" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Descargar
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="RepMerCInvDes" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4>
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#mercsinvP">
                      Mercancia s/inventarios
                    </a>
                  </h4>
                </div>
                <div id="mercsinvP" class="panel-collapse collapse">
                  <div class="panel-body">
                    <div class="col-md-6">
                      <b>General</b>
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="RepMerSInvGen" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Ver
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="RepMerSInvVer" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Descargar
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="RepMerSInvDes" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4>
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#mercccostP">
                      Mercancia c/costos
                    </a>
                  </h4>
                </div>
                <div id="mercccostP" class="panel-collapse collapse">
                  <div class="panel-body">
                    <div class="col-md-6">
                      <b>General</b>
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="RepMerCCosGen" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Ver
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="RepMerCCosVer" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                    <div class="col-md-6">
                      Descargar
                    </div>
                    <div class="col-md-6">
                      <label class="switch switch-green">
                        <input id="RepMerCCosDes" type="checkbox" class="switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
<script src="assets/js/views/permissions.js"></script>
<div class="modal fade" id="modal-bootstrap-timepicker" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
        <h4 class="modal-title"><strong>Seleccion de </strong> Permiso</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="permissions">Permisos</label>
              <select id="all_permissions" class="form-control">
                <option value="NA">Cargando permisos</option>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer bg-gray-light">
        <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal">Cancelar</button>
        <button onclick="onClickSelect()" type="button" class="btn btn-primary btn-embossed" data-dismiss="modal">Seleccionar</button>
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
