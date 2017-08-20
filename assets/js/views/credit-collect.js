var idDocument = 'NA';
function onClickBrowser() {
  var client =  document.getElementById('client').value;

  if (!client && !statusX) {
    alert('Favor de agregar un filtro.');
  } else {
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function () {
      if (xmlhttp.readyState === 1) {
        document.getElementById('response').innerHTML = 'Procesando...';
      } else if (xmlhttp.readyState === 4 && xmlhttp.status == 200) {
        document.getElementById('response').innerHTML = xmlhttp.response;
      }
    };

    xmlhttp.open("GET", "links/follow.php?operation=browser&client=" + client);
    xmlhttp.send();
  }
}

function onClickFollow(id_document, limitCredit, rest, invoice, nameClient) {
  idDocument = id_document;
  document.getElementById('limitCredit').innerHTML = limitCredit;
  document.getElementById('rest').innerHTML = rest;
  document.getElementById('invoice').innerHTML = invoice;
  document.getElementById('nameClient').innerHTML = nameClient;

  var xmlhttp = new XMLHttpRequest();

  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState === 1) {
      document.getElementById('response1').innerHTML = 'Procesando...';
    } else if (xmlhttp.readyState === 4 && xmlhttp.status == 200) {
      document.getElementById('response1').innerHTML = xmlhttp.response;
    }
  };

  xmlhttp.open("GET", "links/follow.php?operation=openFollow&id_document=" + id_document);
  xmlhttp.send();
}

function onClickAddFollow() {
  var statusFollow = document.getElementById('statusFollow').value;
  var Follow = document.getElementById('Follow').value;
  var dateFollow = document.getElementById('dateFollow').value;

  var xmlhttp = new XMLHttpRequest();

  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState === 1) {
    } else if (xmlhttp.readyState === 4 && xmlhttp.status == 200) {
      alert(xmlhttp.response);
    }
  };

  xmlhttp.open("GET", "links/follow.php?operation=saveFollow&id_document=" + idDocument + "&status=" + statusFollow + "&follow=" + Follow + "&date_follow=" + dateFollow);
  xmlhttp.send();
}

function onClickPaid() {
  var paid = document.getElementById('paid').value;

  var xmlhttp = new XMLHttpRequest();

  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState === 1) {
    } else if (xmlhttp.readyState === 4 && xmlhttp.status == 200) {
      alert(xmlhttp.response);
    }
  };

  xmlhttp.open("GET", "links/follow.php?operation=paid&id_document=" + idDocument + "&paid=" + paid);
  xmlhttp.send();
}
