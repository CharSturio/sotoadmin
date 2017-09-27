var id_select = 'NA';

function onClickAdd() {
  var provider = document.getElementById('provider').value;
  var amount = document.getElementById('amount').value;
  var unitCost = document.getElementById('unitCost').value;
  var branches = document.getElementById('branches').value;

  if (!provider || !amount || !unitCost) {
    alert('Favor de llenar todos los campos.');
  } else {
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
    };

    xmlhttp.open("GET", "links/input-products.php?operation=add&provider=" + provider + "&amount=" + amount + "&unit_cost=" + unitCost + "&branch=" + branches + "&id=" + id_select);
    xmlhttp.send();
  }
}

function onClickSelect(id_product, key, barcode, name, branch) {
  id_select = id_product;
  document.getElementById('divProducts').innerHTML = '<h2>Ha seleccionado: <b>' + name + '.</b></h2><h2>Clave: <b>' + key + '.</b></h2><h2>Codigo de barras: <b>' + barcode + '.</b></h2><h2>Sucursal a guardar: <b>' + branch + '.</b></h2>';
}

function onClickBrowserBarcode() {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState === 4 && xmlhttp.status == 200) {
      if (xmlhttp.responseText == 'noPermit') {
        alert("No cuenta con los permisos necesarios.");
      } else {
        document.getElementById('divProducts').innerHTML = xmlhttp.responseText;
      }
    }
  };

  var BProduct = document.getElementById('barcodeProduct').value;
  xmlhttp.open("GET", "links/input-products.php?operation=browserBarcode&content=" + BProduct);
  xmlhttp.send();
}

function onClickBrowserName() {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState === 4 && xmlhttp.status == 200) {
      if (xmlhttp.responseText == 'noPermit') {
        alert("No cuenta con los permisos necesarios.");
      } else {
        document.getElementById('divProducts').innerHTML = xmlhttp.responseText;
      }
    }
  };

  var BProduct = document.getElementById('nameProduct').value;
  xmlhttp.open("GET", "links/input-products.php?operation=browserName&content=" + BProduct);
  xmlhttp.send();
}
