var id_stock = 'NA';
var id_branch_out = 'NA';
var g_amount = 'NA';

function onClickAdd() {
  var amount = document.getElementById('amount').value;
  var id_branch_in = document.getElementById('branches').value;

  if (!amount || !id_branch_in) {
    alert('Favor de llenar todos los campos.');
  } else if (id_stock == 'NA' || id_branch_out == 'NA' || g_amount == 'NA'){
    alert('Favor de seleccionar un producto.');
  } else if (amount > g_amount){
    alert('La cantidad a transferir es mayor a la existencia del producto elegido.');
  } else if (id_branch_out == id_branch_in){
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
          document.getElementById('response').innerHTML = "Transferencia realizada.";
          window.open('invoice/transfer.php?id=' + xmlhttp.responseText, "Imprecion Doc", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=400, height=400");          
        }
      }
    };

    xmlhttp.open("GET", "links/send-products.php?operation=add&amount=" + amount + "&id_branch_in=" + id_branch_in + "&id_branch_out=" + id_branch_out + "&id_stock=" + id_stock);
    xmlhttp.send();
  }
}

function onClickSelect(idStock, key, barcode, name, branch, branch_id, amount) {
  id_stock = idStock;
  id_branch_out = branch_id;
  g_amount = amount;
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
