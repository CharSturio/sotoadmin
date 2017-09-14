function onClickAction() {
  var fecha_desde = document.getElementById('fecha-desde').value;
  var fecha_hasta = document.getElementById('fecha-hasta').value;
  var cliente = document.getElementById('cliente').value;
  var folio = document.getElementById('folio').value;

  if (!fecha_desde || !fecha_hasta) {
    alert('Es necesario elegir ambas fechas');
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

    xmlhttp.open("GET", "links/rep_invoice.php?operation=action&fecha_desde=" + fecha_desde + "&fecha_hasta=" + fecha_hasta + "&cliente=" + cliente + "&folio=" + folio);
    xmlhttp.send();
  }
}

function onClickPDF() {
  var fecha_desde = document.getElementById('fecha-desde').value;
  var fecha_hasta = document.getElementById('fecha-hasta').value;
  var cliente = document.getElementById('cliente').value;
  var folio = document.getElementById('folio').value;

  if (!fecha_desde || !fecha_hasta) {
    alert('Es necesario elegir ambas fechas');
  } else {
    var x = "invoice/pdf_rep_invoice.php?operation=action&fecha_desde=" + fecha_desde + "&fecha_hasta=" + fecha_hasta + "&cliente=" + cliente + "&folio=" + folio;
    window.open(x,'Factura','width=100%,height=100%,fullscreen=yes,scrollbars=NO');
  }
}
