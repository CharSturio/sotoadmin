var id_select = 'NA';

function onClickAdd() {
  var comprobante = document.getElementById('comprobante').value;
  var cantidad = document.getElementById('cantidad').value;
  var descripcion = document.getElementById('descripcion').value;

  if (!comprobante || !cantidad || !descripcion) {
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

    xmlhttp.open("GET", "links/cash-out.php?operation=add&comprobante=" + comprobante + "&cantidad=" + cantidad + "&descripcion=" + descripcion);
    xmlhttp.send();
  }
}

function onClickAdd2() {
  var comprobante2 = document.getElementById('comprobante2').value;
  var cantidad2 = document.getElementById('cantidad2').value;
  var descripcion2 = document.getElementById('descripcion2').value;

  if (!comprobante2 || !cantidad2 || !descripcion2) {
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

    xmlhttp.open("GET", "links/cash-out.php?operation=add2&comprobante2=" + comprobante2 + "&cantidad2=" + cantidad2 + "&descripcion2=" + descripcion2);
    xmlhttp.send();
  }
}
