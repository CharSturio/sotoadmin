function onClickAction() {
  var typeProduct = document.getElementById('typeProduct').value;

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

  xmlhttp.open("GET", "links/rep_merc_s_inv.php?operation=action&typeProduct=" + typeProduct);
  xmlhttp.send();
}

function onClickPDF() {
  var typeProduct = document.getElementById('typeProduct').value;

  var x = "invoice/pdf_rep_merc_s_inv.php?operation=action&typeProduct=" + typeProduct;
  window.open(x,'Factura','width=100%,height=100%,fullscreen=yes,scrollbars=NO');
}
