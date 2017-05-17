function onClickSend() {
  var typeProduct = document.getElementById('typeProduct').value;
  var email = document.getElementById('email').value;

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (!email) {
      alert('Ingrese un Email');
    } else {
      if (xmlhttp.readyState === 1) {
        document.getElementById('response').innerHTML = 'Procesando...';
      } else if (xmlhttp.readyState === 4 && xmlhttp.status == 200) {
        document.getElementById('response').innerHTML = xmlhttp.responseText;
      }
    }
  };

  xmlhttp.open("GET", "invoice/send_min_stocks.php?operation=action&typeProduct=" + typeProduct + "&email=" + email);
  xmlhttp.send();
}
