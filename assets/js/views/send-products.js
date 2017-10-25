setTimeout('loadInfo()', 250);

var _id_stock = 'NA';
var _key = 'NA';
var _barcode = 'NA';
var _name = 'NA';
var _id_branch = 'NA';
var _id_branch_out = 'NA';
var _g_amount = 'NA';

function loadInfo() {
  var xmlhttp = new XMLHttpRequest();

  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState === 4 && xmlhttp.status == 200) {
      document.getElementById('response').innerHTML = xmlhttp.responseText;
    }
  };

  xmlhttp.open("GET", "links/send-products.php?operation=loadInfo");
  xmlhttp.send();
}

function onClickAddProduct() {
  var amount = document.getElementById('amount').value;
  var id_branch_to = document.getElementById('branches').value;

  if (!amount || !id_branch_to) {
    alert('Favor de llenar todos los campos.');
  } else if (_id_stock == 'NA' || _id_branch_out == 'NA' || _g_amount == 'NA'){
    alert('Favor de seleccionar un producto.');
  } else if (amount > _g_amount){
    alert('La cantidad a transferir es mayor a la existencia del producto elegido.');
  } else if (_id_branch_out == id_branch_to){
    alert('No se puede transferir, ya que la sucursal destino es la misma de la mercancia.');
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
          _id_stock = 'NA';
          _key = 'NA';
          _barcode = 'NA';
          _name = 'NA';
          _id_branch = 'NA';
          _id_branch_out = 'NA';
          _g_amount = 'NA';
          document.getElementById('divProducts').innerHTML = "";
          document.getElementById('amount').value = "";
        }
      }
    };

    xmlhttp.open("GET", "links/send-products.php?operation=addProduct&amount=" + amount + "&id_branch_to=" + id_branch_to + "&id_stock=" + _id_stock);
    xmlhttp.send();
  }
}

function onClickAdd() {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState === 1) {
      document.getElementById('response').innerHTML = 'Procesando...';
    } else if (xmlhttp.readyState === 4 && xmlhttp.status == 200) {
      if (xmlhttp.responseText == 'noPermit') {
        alert("No cuenta con los permisos necesarios.");
      } else {
        document.getElementById('response').innerHTML = "Transferencia realizada.";
        window.open('invoice/transfer.php?id=' + xmlhttp.responseText, "Imprecion Doc", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=400, height=400");          
      }
    }
  };

  xmlhttp.open("GET", "links/send-products.php?operation=add");
  xmlhttp.send();
  
}

function onClickCancel(idTempStock) {
  var amount = document.getElementById('amount').value;
  var id_branch_to = document.getElementById('branches').value;

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState === 1) {
      document.getElementById('response').innerHTML = 'Procesando...';
    } else if (xmlhttp.readyState === 4 && xmlhttp.status == 200) {
      if (xmlhttp.responseText == 'noPermit') {
        alert("No cuenta con los permisos necesarios.");
      } else {
        document.getElementById('response').innerHTML = xmlhttp.responseText;        
        alert("Producto Eliminado.");        
      }
    }
  };

  xmlhttp.open("GET", "links/send-products.php?operation=cancelProduct&id=" + idTempStock);
  xmlhttp.send();
}

function onClickSelect(idStock, key, barcode, name, branch, branch_id, amount) {
  _id_stock = idStock;
  _key = key;
  _barcode = barcode;
  _name = name;
  _id_branch = branch;
  _id_branch_out = branch_id;
  _g_amount = amount;
  document.getElementById('divProducts').innerHTML = '<h3>Ha seleccionado: <b>' + name + '.</b></h3><h3>Clave: <b>' + key + '.</b></h3><h3>Codigo de barras: <b>' + barcode + '.</b></h3><h3>Existencia: <b>' + amount + '.</b></h3><h3>Sucursal: <b>' + branch + '.</b></h3>';
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
  xmlhttp.open("GET", "links/send-products.php?operation=browserBarcode&content=" + BProduct);
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
  xmlhttp.open("GET", "links/send-products.php?operation=browserName&content=" + BProduct);
  xmlhttp.send();
}
