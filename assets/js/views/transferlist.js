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

  xmlhttp.open("GET", "links/transferlist.php?operation=loadInfo");
  xmlhttp.send();
}


function onClickPDF(id) {
  window.open('invoice/transfer.php?id=' + id, "Imprecion Doc", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=400, height=400");
}

function onClickBrowser() {
  var in_ = document.getElementById('in').value;
  var out = document.getElementById('out').value;
  var id = document.getElementById('id').value;
  if (!in_ && !out && !id) {
    alert('Favor de agregar algun filtro.');
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (xmlhttp.readyState === 1) {
        document.getElementById('response').innerHTML = 'Procesando...';
      } else if (xmlhttp.readyState === 4 && xmlhttp.status == 200) {
        if (xmlhttp.responseText == 'noPermit') {
          alert("No cuenta con los permisos necesarios.");
        } else {
          document.getElementById('response').innerHTML = '';
          document.getElementById('table').innerHTML = xmlhttp.responseText;
        }
      }
    }
    xmlhttp.open("GET", "links/transferlist.php?operation=browserInfo&in=" + in_ +"&out=" + out + "&id=" + id);
    xmlhttp.send();
  }
}
