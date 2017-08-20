setTimeout('loadInfo()', 250);

function loadInfo() {
  var xmlhttp = new XMLHttpRequest();

  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState === 1) {
      document.getElementById('response').innerHTML = 'Procesando...';
    } else if (xmlhttp.readyState === 4 && xmlhttp.status == 200) {
      document.getElementById('response').innerHTML = '';
      document.getElementById('table').innerHTML = xmlhttp.responseText;
    }
  };

  xmlhttp.open("GET", "links/movelist.php?operation=loadInfo");
  xmlhttp.send();
}

function onClickXML(id, op) {
  if (op === 0) {
    if (confirm("¿Desea timbrar el Documento?") === true) {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 1) {
          document.getElementById('response').innerHTML = 'Procesando...';
        } else if (xmlhttp.readyState === 4 && xmlhttp.status == 200) {
          if(/exito/.test(xmlhttp.responseText)) {
            alert('Proceso realizado. Se le redireccionara.');
            window.location.href ="links/movelist.php?operation=xml&id=" + id;
            document.location.reload();
          } else {
            alert(xmlhttp.responseText);
          }
          console.log(xmlhttp.responseText);

        }
      }
      xmlhttp.open("GET", "links/create/xml.php?id=" + id);
      xmlhttp.send();
      }
  } else if (op === 1) {
    window.location.href ="links/movelist.php?operation=xml&id=" + id;
  }
}

function onClickXMLCredit(id, op) {
  if (op === 0) {
    if (confirm("¿Desea timbrar el Documento?") === true) {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 1) {
          document.getElementById('response').innerHTML = 'Procesando...';
        } else if (xmlhttp.readyState === 4 && xmlhttp.status == 200) {
          if (xmlhttp.response === '0') {
            alert('Faltan datos del cliente para poder facturar.');
          } else if (xmlhttp.response === '0') {
            alert('Hubo un error: ' + xmlhttp.response);
            console.log(xmlhttp.response);
          } else {
            window.location.href ="links/movelist.php?operation=xml&id=" + id;
            alert('Se creo con exito. Espere mientras es redireccionado.');
            document.location.reload();
          }
        }
      }
      xmlhttp.open("GET", "links/create/xml_credit.php?id=" + id);
      xmlhttp.send();
      }
  } else if (op === 1) {
    window.location.href ="links/movelist.php?operation=xml&id=" + id;
  }
}

function onClickPDF(id, op) {
  window.open('invoice/index.php?id=' + id + '&op=' + op, "Imprecion Doc", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=400, height=400");
  window.location.href ="links/movelist.php?operation=pdf&id=" + id;
}

function onClickCancel(id) {
  if (confirm("¿Desea Cancelar el Documento?") === true) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (xmlhttp.readyState === 1) {
        document.getElementById('response').innerHTML = 'Procesando...';
      } else if (xmlhttp.readyState === 4 && xmlhttp.status == 200) {
        if (xmlhttp.response === '1') {
          alert('Solo un usuario Administrador puede Eliminar');
        } else {
          alert(xmlhttp.response + ' sera redireccionado.');
          document.location.reload();
        }
      }
    }
    xmlhttp.open("GET", "links/create/cancel_xml.php?id=" + id);
    xmlhttp.send();
  }
}

function onClickSend (id, op) {
  window.open("invoice/send.php?id=" + id, "Imprecion Doc", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=400, height=400");
  //window.location.href ="invoice/send.php?id=" + id;
}

function onClickBrowser() {
  var clientName = document.getElementById('clientName').value;
  var keyInvoice = document.getElementById('keyInvoice').value;
  var userName = document.getElementById('userName').value;
  if (!clientName && !keyInvoice && !userName) {
    alert('Favor de agregar algun filtro.');
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (xmlhttp.readyState === 1) {
        document.getElementById('response').innerHTML = 'Procesando...';
      } else if (xmlhttp.readyState === 4 && xmlhttp.status == 200) {
        document.getElementById('response').innerHTML = '';
        document.getElementById('table').innerHTML = xmlhttp.responseText;
      }
    }
    xmlhttp.open("GET", "links/movelist.php?operation=browserInfo&user=" + userName +"&client=" + clientName + "&invoice=" + keyInvoice);
    xmlhttp.send();
  }
}
