idSelect = 'NA';
function onClickBrowser() {
  var barcode = document.getElementById('barcode').value;
  var key = document.getElementById('key').value;
  var name = document.getElementById('name').value;
  if (!barcode && !name && !key) {
    alert('Favor de agregar un filtro.');
  } else {
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function () {
      if (xmlhttp.readyState === 1) {
        document.getElementById('response').innerHTML = 'Procesando...';
      } else if (xmlhttp.readyState === 4 && xmlhttp.status == 200) {
        document.getElementById('response').innerHTML = xmlhttp.responseText;
      }
    };

    xmlhttp.open("GET", "links/edit-stock.php?operation=browser&name=" + name + "&key=" + key + "&barcode=" + barcode);
    xmlhttp.send();
  }
}

function onClickSelect(idProduct, name, amount) {
  document.getElementById('printName').innerHTML = name;
  document.getElementById('printAmount').innerHTML = amount;
  idSelect = idProduct;
}

function onClickModify() {
  document.getElementById('titleOperation').innerHTML = 'Modificar Existencia';
  document.getElementById('button').innerHTML = '<button onClick="onClickSaveModify()" type="button" class="btn btn-success btn-square">Guardar</button>';
}

function onClickIn() {
  document.getElementById('titleOperation').innerHTML = 'Entrada por Devolución';
  document.getElementById('button').innerHTML = '<button onClick="onClickSaveIn()" type="button" class="btn btn-success btn-square">Guardar</button>';
}

function onClickOut() {
  document.getElementById('titleOperation').innerHTML = 'Salida por Devolución';
  document.getElementById('button').innerHTML = '<button onClick="onClickSaveOut()" type="button" class="btn btn-success btn-square">Guardar</button>';
}

function onClickSaveModify() {
  var alterStock = document.getElementById('alterStock').value;
  if (!alterStock) {
    alert('Favor de ingresar una cantidad.');
  } else {
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function () {
      if (xmlhttp.readyState === 1) {
        document.getElementById('response').innerHTML = 'Procesando...';
      } else if (xmlhttp.readyState === 4 && xmlhttp.status == 200) {
        alert(xmlhttp.responseText);
      }
    };

    xmlhttp.open("GET", "links/edit-stock.php?operation=modify&id=" + idSelect + "&alterStock=" + alterStock);
    xmlhttp.send();
  }
}

function onClickSaveIn() {
  var alterStock = document.getElementById('alterStock').value;
  if (!alterStock) {
    alert('Favor de ingresar una cantidad.');
  } else {
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function () {
      if (xmlhttp.readyState === 1) {
        document.getElementById('response').innerHTML = 'Procesando...';
      } else if (xmlhttp.readyState === 4 && xmlhttp.status == 200) {
        alert(xmlhttp.responseText);
      }
    };

    xmlhttp.open("GET", "links/edit-stock.php?operation=in&id=" + idSelect + "&alterStock=" + alterStock);
    xmlhttp.send();
  }
}

function onClickSaveOut() {
  var alterStock = document.getElementById('alterStock').value;
  if (!alterStock) {
    alert('Favor de ingresar una cantidad.');
  } else {
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function () {
      if (xmlhttp.readyState === 1) {
        document.getElementById('response').innerHTML = 'Procesando...';
      } else if (xmlhttp.readyState === 4 && xmlhttp.status == 200) {
        alert(xmlhttp.responseText);
      }
    };

    xmlhttp.open("GET", "links/edit-stock.php?operation=out&id=" + idSelect + "&alterStock=" + alterStock);
    xmlhttp.send();
  }
}
