var id_select = 'NA';
function onClickNew() {
  var typeProduct = document.getElementById('typeProduct').value;
  var barcode = document.getElementById('barcode').value;
  var name = document.getElementById('name').value;
  var description = document.getElementById('description').value;
  var key = document.getElementById('key').value;
  var brand = document.getElementById('brand').value;
  var model = document.getElementById('model').value;
  var measure = document.getElementById('measure').value;
  var treadware = document.getElementById('treadware').value;
  var loadIndex = document.getElementById('loadIndex').value;
  var loadSpeed = document.getElementById('loadSpeed').value;
  var retailPrice = document.getElementById('retailPrice').value;
  var wholesalePrice = document.getElementById('wholesalePrice').value;
  var specialPrice = document.getElementById('specialPrice').value;
  var tarjeta = document.getElementById('tarjeta').value;
  var mpago = document.getElementById('mpago').value;
  var pespecial = document.getElementById('pespecial').value;

  if (!name) {
    alert('Favor de llenar nombre.');
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

    xmlhttp.open("GET", "links/products.php?operation=new&type_product=" + typeProduct + "&barcode=" + barcode + "&name=" + name + "&description=" + description + "&key=" + key + "&brand=" + brand + "&model=" + model + "&measure=" + measure + "&treadware=" + treadware + "&load_index=" + loadIndex + "&load_speed=" + loadSpeed + "&retail_price=" + retailPrice + "&wholesale_price=" + wholesalePrice + "&special_price=" + specialPrice + "&tarjeta=" + tarjeta + "&mpago=" + mpago + "&pespecial=" + pespecial);
    xmlhttp.send();
  }
}

function onClickModify() {
  if (!id_select || id_select === 'NA') {
    document.getElementById('response').innerHTML = "No se ha seleccionado ningun producto";
  } else {
    var barcode = document.getElementById('barcode').value;
    var name = document.getElementById('name').value;
    var description = document.getElementById('description').value;
    var key_ = document.getElementById('key').value;
    var brand = document.getElementById('brand').value;
    var model = document.getElementById('model').value;
    var measure = document.getElementById('measure').value;
    var treadware = document.getElementById('treadware').value;
    var loadIndex = document.getElementById('loadIndex').value;
    var loadSpeed = document.getElementById('loadSpeed').value;
    if (name === '' || key_ === '') {
      alert('Ingresa datos obligatorios.');
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

      xmlhttp.open("GET", "links/products.php?operation=modify&barcode=" + barcode + "&name=" + name + "&description=" + description + "&key_=" + key_ + "&brand=" + brand + "&model=" + model + "&measure=" + measure + "&treadware=" + treadware + "&load_index=" + loadIndex + "&load_speed=" + loadSpeed  + "&id=" + id_select);

      xmlhttp.send();
    }
  }
}
function onClickModifyCosts() {
  var typeProduct = document.getElementById('typeProduct').value;

  if (!id_select || id_select === 'NA') {
    document.getElementById('response').innerHTML = "No se ha seleccionado ningun producto";
  } else {
    var retailPrice = document.getElementById('retailPrice').value;
    var wholesalePrice = document.getElementById('wholesalePrice').value;
    var specialPrice = document.getElementById('specialPrice').value;
    var tarjeta = document.getElementById('tarjeta').value;
    var mpago = document.getElementById('mpago').value;
    var pespecial = document.getElementById('pespecial').value;

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

    xmlhttp.open("GET", "links/products.php?operation=modifyCosts&retail_price=" + retailPrice + "&wholesale_price=" + wholesalePrice + "&special_price=" + specialPrice + "&tarjeta=" + tarjeta + "&mpago=" + mpago + "&pespecial=" + pespecial + "&id=" + id_select + "&typeProduct=" + typeProduct);

    xmlhttp.send();
  }
}

function onClickSelect(id_product) {
  id_select = id_product;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState === 4 && xmlhttp.status == 200) {
      var res = xmlhttp.responseText.split(',');
      document.getElementById('barcode').value = res[0];
      document.getElementById('name').value = res[1];
      document.getElementById('description').value = res[2];
      document.getElementById('key').value = res[3];
      document.getElementById('brand').value = res[4];
      document.getElementById('model').value = res[5];
      document.getElementById('measure').value = res[6];
      document.getElementById('treadware').value = res[7];
      document.getElementById('loadIndex').value = res[8];
      document.getElementById('loadSpeed').value = res[9];
      document.getElementById('retailPrice').value = res[10];
      document.getElementById('wholesalePrice').value = res[11];
      document.getElementById('specialPrice').value = res[12];
      document.getElementById('tarjeta').value = res[13];
      document.getElementById('mpago').value = res[14];
      document.getElementById('pespecial').value = res[15];
    }
  };

  xmlhttp.open("GET", "links/products.php?operation=selectProduct&id=" + id_product);
  xmlhttp.send();
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
  xmlhttp.open("GET", "links/products.php?operation=browserBarcode&content=" + BProduct);
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
  xmlhttp.open("GET", "links/products.php?operation=browserName&content=" + BProduct);
  xmlhttp.send();
}

function onClickDelete() {
  //var select = document.getElementById('all_products').value;
  if (!id_select || id_select === 'NA') {
    document.getElementById('response').innerHTML = "No se ha seleccionado ningun usuario";
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (xmlhttp.readyState === 4 && xmlhttp.status == 200) {
        if (xmlhttp.responseText == 'noPermit') {
          alert("No cuenta con los permisos necesarios.");
        } else {
          document.getElementById('response').innerHTML = xmlhttp.responseText;            
        }
      }
    };

    xmlhttp.open("GET", "links/products.php?operation=delete&id=" + id_select);
    xmlhttp.send();
  }
}
