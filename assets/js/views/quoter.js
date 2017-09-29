var idSelect = 'NA';
var TypeCost = 'public';

function onClickClients() {
  var name = document.getElementById('clientName').value;

  if (!name) {
    alert('Favor de escribir un nombre de cliente.');
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (xmlhttp.readyState === 1) {
        document.getElementById('response').innerHTML = 'Procesando...';
      } else if (xmlhttp.readyState === 4 && xmlhttp.status == 200) {
        if (xmlhttp.responseText == 'noPermit') {
          alert("No cuenta con los permisos necesarios.");
        } else {
          document.getElementById('response').innerHTML = xmlhttp.responseText;
        }
      }
    }

    xmlhttp.open("GET", "links/quoter.php?operation=browserClient&name=" + name);
    xmlhttp.send();
  }
}

function onClickProducts() {
  var barcode = document.getElementById('barcode').value;
  var key = document.getElementById('key').value;
  var productName = document.getElementById('productName').value;

  if (!barcode && !key && !productName) {
    alert('Favor de ingresar algun valor');
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (xmlhttp.readyState === 1) {
        document.getElementById('responseProduct').innerHTML = 'Procesando...';
      } else if (xmlhttp.readyState === 4 && xmlhttp.status == 200) {
        if (xmlhttp.responseText == 'noPermit') {
          alert("No cuenta con los permisos necesarios.");
        } else {
          document.getElementById('responseProduct').innerHTML = xmlhttp.responseText;
        }
      }
    };

    xmlhttp.open("GET", "links/quoter.php?operation=browserProduct&barcode=" + barcode + "&key=" + key + "&product_name=" + productName + "&type_cost=" + TypeCost);
    xmlhttp.send();
  }
}

function onClickSelectName(id, name, credit, limitCredit, typeCost) {
  idSelect = id;
  console.log(idSelect);
  TypeCost = typeCost;
  document.getElementById('response').innerHTML = '<div></div>';
  document.getElementById('nameClient').innerHTML = '<b>Nombre Comercial / Razón Social: </b>' + name;
  document.getElementById('nameClient2').innerHTML = '<b>Nombre Comercial / Razón Social: </b>' + name;
  document.getElementById('credit').innerHTML = '<b>Credito: </b>' + limitCredit;
  document.getElementById('typeCost').innerHTML = '<b>Tipo: </b>' + typeCost;
}

function onClickAdd(id, amount, codigo) {
  console.log(codigo);
  code = "'"+codigo+"'";
  price = document.getElementById(code).value;
  var xmlhttp = new XMLHttpRequest();
  var ramount = document.getElementById(amount).value;
  if (idSelect === 'NA') {
    alert('Favor de escoger un cliente.');
  } else {
    console.log(idSelect + " cuando se escoge el producto");
    xmlhttp.onreadystatechange = function () {
      if (xmlhttp.readyState === 1) {
        document.getElementById('response').innerHTML = 'Procesando...';
      } else if (xmlhttp.readyState === 4 && xmlhttp.status == 200) {
        document.getElementById('bodyProducts').innerHTML = xmlhttp.responseText;
        //document.getElementById('bodyProducts2').innerHTML = xmlhttp.responseText;
      }
    };

    xmlhttp.open("GET", "links/quoter.php?operation=addProduct&id=" + id + "&amount=" + ramount + "&price=" + price + "&idClient=" + idSelect);
    xmlhttp.send();
  }
}

function onClickCancel(id, id_product, id_client) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState === 1) {
      document.getElementById('response').innerHTML = 'Procesando...';
    } else if (xmlhttp.readyState === 4 && xmlhttp.status == 200) {
      if (xmlhttp.responseText == 'noPermit') {
        alert("No cuenta con los permisos necesarios.");
      } else {
        document.getElementById('totalQuoter').innerHTML = xmlhttp.responseText;
        var th = document.getElementById(id);
        th.parentNode.removeChild(th);
      }
      // var th = document.getElementById(id);
      // th.parentNode.removeChild(th);
    }
  };

  xmlhttp.open("GET", "links/quoter.php?operation=cancelProduct&id=" + id + "&id_product=" + id_product + "&id_client=" + id_client);
  xmlhttp.send();
}

function onClickInvoice() {
  if (idSelect === 'NA') {
    alert('Selecciona un usuario');
  } else {
    document.getElementById('titleOperation').innerHTML = '<h3>FACTURA</h3>';
    document.getElementById('buttons').innerHTML = '<button onclick="onSubmitInvoice()" type="button" class="btn btn-success btn-square">Finalizar</button><button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-danger btn-square">Cancelar</button>';
  }
}

function onSubmitInvoice() {
  var xmlhttp = new XMLHttpRequest();
  var guideNumber = document.getElementById('guideNumber').value;
  var paymentMethod = document.getElementById('paymentMethod').value;
  var lastDigits = document.getElementById('lastDigits').value;
  var comments = document.getElementById('comments').value;

  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState === 1) {
      document.getElementById('response').innerHTML = 'Procesando...';
    } else if (xmlhttp.readyState === 4 && xmlhttp.status == 200) {
      if (xmlhttp.responseText == 'noPermit') {
        alert("No cuenta con los permisos necesarios.");
      } else if (xmlhttp.responseText === 'x') {
        alert('Valores incorrectos o faltantes en cliente.');
      } else if (xmlhttp.responseText === 'y') {
        alert('Las existencias han cambiado. Favor de verificar los productos.');
      } else {
        alert(xmlhttp.responseText);
        alert('Añadido con Exito. Timbre en proceso. Sera redireccionado al terminar con el proceso..');
        var idDocument = xmlhttp.responseText;
        var x = 'invoice/index.php?id=' + xmlhttp.responseText + '&op=1';
        window.open(x,'Factura','width=100%,height=100%,fullscreen=yes,scrollbars=NO');

        var xmlhttp2 = new XMLHttpRequest();
        xmlhttp2.onreadystatechange = function () {
          if (xmlhttp2.readyState === 1) {
            document.getElementById('response').innerHTML = 'Procesando...';
          } else if (xmlhttp2.readyState === 4 && xmlhttp2.status == 200) {
            window.location.href ="links/movelist.php?operation=xml&id=" + idDocument;
            alert(xmlhttp.responseText);
            document.location.reload();
          }
        }
        xmlhttp2.open("GET", "links/create/xml.php?id=" + idDocument);
        xmlhttp2.send();
      }
    }
  };

  xmlhttp.open("GET", "links/quoter.php?operation=invoice&id_client=" + idSelect + "&guide_number=" + guideNumber + "&payment_method=" + paymentMethod + "&last_digits=" + lastDigits + "&comments=" + comments);
  xmlhttp.send();
}

function onClickCredit() {
  if (idSelect === 'NA') {
    alert('Selecciona un usuario');
  } else {
    document.getElementById('titleOperation').innerHTML = '<h3>CREDITO</h3>';
    document.getElementById('buttons').innerHTML = '<button onclick="onSubmitCredit()" type="button" class="btn btn-success btn-square">Finalizar</button><button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-danger btn-square">Cancelar</button>';
  }
}

function onSubmitCredit() {
  var xmlhttp = new XMLHttpRequest();
  var guideNumber = document.getElementById('guideNumber').value;
  var paymentMethod = document.getElementById('paymentMethod').value;
  var lastDigits = document.getElementById('lastDigits').value;
  var comments = document.getElementById('comments').value;
  var diasCredito = document.getElementById('diasCredito').value;

  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState === 1) {
      document.getElementById('response').innerHTML = 'Procesando...';
    } else if (xmlhttp.readyState === 4 && xmlhttp.status == 200) {
      if (xmlhttp.responseText == 'noPermit') {
        alert("No cuenta con los permisos necesarios.");
      } else {
        alert('Añadida con exito.');
        var x = 'invoice/index.php?id=' + xmlhttp.responseText + '&op=3';
        window.open(x,'Credito','width=100%,height=100%,fullscreen=yes,scrollbars=NO')
        document.location.reload();
      }
    }
  };

  xmlhttp.open("GET", "links/quoter.php?operation=credit&id_client=" + idSelect + "&guide_number=" + guideNumber + "&payment_method=" + paymentMethod + "&last_digits=" + lastDigits + "&comments=" + comments + "&diasCredito = " + diasCredito);
  xmlhttp.send();
}

function onClickRemission() {
  if (idSelect === 'NA') {
    alert('Selecciona un usuario');
  } else {
    document.getElementById('titleOperation').innerHTML = '<h3>REMISION</h3>';
    document.getElementById('buttons').innerHTML = '<button onclick="onSubmitRemission()" type="button" class="btn btn-success btn-square">Finalizar</button><button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-danger btn-square ">Cancelar</button>';
  }
}

function onSubmitRemission() {
  var xmlhttp = new XMLHttpRequest();
  var guideNumber = document.getElementById('guideNumber').value;
  var paymentMethod = document.getElementById('paymentMethod').value;
  var lastDigits = document.getElementById('lastDigits').value;
  var comments = document.getElementById('comments').value;

  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState === 1) {
      document.getElementById('response').innerHTML = 'Procesando...';
    } else if (xmlhttp.readyState === 4 && xmlhttp.status == 200) {
      if (xmlhttp.responseText == 'noPermit') {
        alert("No cuenta con los permisos necesarios.");
      } else {
        alert("Añadida con Exito. Sera redireccionado.");
        var x = 'invoice/index.php?id=' + xmlhttp.responseText + '&op=2';
        window.open(x,'Remision','width=100%,height=100%,fullscreen=yes,scrollbars=NO')
        document.location.reload();
      }
    }
  };

  xmlhttp.open("GET", "links/quoter.php?operation=remission&id_client=" + idSelect + "&guide_number=" + guideNumber + "&payment_method=" + paymentMethod + "&last_digits=" + lastDigits + "&comments=" + comments);
  xmlhttp.send();
}

function onClickCancelAll() {
  var xmlhttp = new XMLHttpRequest();

  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState === 1) {
      document.getElementById('response').innerHTML = 'Procesando...';
    } else if (xmlhttp.readyState === 4 && xmlhttp.status == 200) {
      if (xmlhttp.responseText == 'noPermit') {
        alert("No cuenta con los permisos necesarios.");
      } else {
        alert(xmlhttp.responseText);
      }
    }
  };

  xmlhttp.open("GET", "links/quoter.php?operation=cancelAll&id_client=" + idSelect);
  xmlhttp.send();
}
