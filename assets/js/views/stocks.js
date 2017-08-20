var idSelect = 'NA';
var TypeCost = 'special';

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
        document.getElementById('responseProduct').innerHTML = xmlhttp.responseText;
      }
    };

    xmlhttp.open("GET", "links/stocks.php?operation=browserProduct&barcode=" + barcode + "&key=" + key + "&product_name=" + productName + "&type_cost=" + TypeCost);
    xmlhttp.send();
  }
}
