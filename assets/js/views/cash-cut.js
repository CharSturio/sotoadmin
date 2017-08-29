function onClickAction() {
  var fecha_desde = document.getElementById('fecha-desde').value;
  var fecha_hasta = document.getElementById('fecha-hasta').value;

  if (!fecha_desde || !fecha_hasta) {
    alert('Favor de llenar ambas fechas.');
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

    xmlhttp.open("GET", "links/cash-cut.php?operation=action&fecha_desde=" + fecha_desde + "&fecha_hasta=" + fecha_hasta);
    xmlhttp.send();
  }
}

function onClickPDF() {
  var fecha_desde = document.getElementById('fecha-desde').value;
  var fecha_hasta = document.getElementById('fecha-hasta').value;

  if (!fecha_desde || !fecha_hasta) {
    alert('Favor de llenar ambas fechas.');
  } else {
    var x = "invoice/pdf-corte-caja.php?op=1&desde=" + fecha_desde + "&hasta=" + fecha_hasta;
    window.open(x,'Factura','width=100%,height=100%,fullscreen=yes,scrollbars=NO');
  }
}

function onClickSend() {
  var fecha_desde = document.getElementById('fecha-desde').value;
  var fecha_hasta = document.getElementById('fecha-hasta').value;
  var correo = document.getElementById('correo').value;

  if (!fecha_desde || !fecha_hasta) {
    alert('Favor de llenar ambas fechas.');
  } else {
    if (!correo) {
      alert('Es necesario un correo para ser enviado.');
    } else {
      var x = "invoice/send-corte-caja.php?op=1&desde=" + fecha_desde + "&hasta=" + fecha_hasta + "&correo=" + correo;
      window.open(x,'Factura','width=100%,height=100%,fullscreen=yes,scrollbars=NO');
    }
  }
}
