function onClickNew() {
  var user = document.getElementById('user').value;
  var pass = document.getElementById('pass').value;
  var repass = document.getElementById('repass').value;
  var name = document.getElementById('name').value;
  var address = document.getElementById('address').value;
  var city = document.getElementById('city').value;
  var lastName = document.getElementById('last_name').value;
  var pc = document.getElementById('pc').value;
  var state = document.getElementById('state').value;
  var permision = document.getElementById('permision').value;
  var checkIn = document.getElementById('check_in').value;
  var checkOut = document.getElementById('check_out').value;
  if (pass !== repass) {
    alert('La contraseña es diferente.');
  } else {
    if (pass === '' || repass === '') {
      alert('Favor de ingresar contraseña.');
    } else {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 1) {
          document.getElementById('response').innerHTML = 'Procesando...';
        } else if (xmlhttp.readyState === 4 && xmlhttp.status == 200) {
          document.getElementById('response').innerHTML = xmlhttp.responseText;
        }
      };

      xmlhttp.open("GET", "links/users.php?operation=new&user=" + user + "&pass=" + pass + "&name=" + name + "&address=" + address + "&city=" + city + "&lastName=" + lastName + "&pc=" + pc + "&state=" + state + "&permision=" + permision + "&checkIn=" + checkIn  + "&checkOut=" + checkOut);
      xmlhttp.send();
    }
  }
}

function onClickModify() {
  var id = document.getElementById('all_users').value;
  if (!id || id === 'NA') {
    document.getElementById('response').innerHTML = "No se ha seleccionado ningun usuario";
  } else {
    var user = document.getElementById('user').value;
    var pass = document.getElementById('pass').value;
    var repass = document.getElementById('repass').value;
    var name = document.getElementById('name').value;
    var address = document.getElementById('address').value;
    var city = document.getElementById('city').value;
    var lastName = document.getElementById('last_name').value;
    var pc = document.getElementById('pc').value;
    var state = document.getElementById('state').value;
    var permision = document.getElementById('permision').value;
    var checkIn = document.getElementById('check_in').value;
    var checkOut = document.getElementById('check_out').value;
    if (pass !== repass) {
      alert('La contraseña es diferente.');
    } else {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 1) {
          document.getElementById('response').innerHTML = 'Procesando...';
        } else if (xmlhttp.readyState === 4 && xmlhttp.status == 200) {
          document.getElementById('response').innerHTML = xmlhttp.responseText;
        }
      };

      xmlhttp.open("GET", "links/users.php?operation=modify&user=" + user + "&pass=" + pass + "&name=" + name + "&address=" + address + "&city=" + city + "&lastName=" + lastName + "&pc=" + pc + "&state=" + state + "&permision=" + permision + "&checkIn=" + checkIn  + "&checkOut=" + checkOut + "&id=" + id);
      xmlhttp.send();
    }
  }
}

function onClickSelect() {
  var select = document.getElementById('all_users').value;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState === 4 && xmlhttp.status == 200) {
      //document.getElementById('all_users').innerHTML = xmlhttp.responseText;
      var res = xmlhttp.responseText.split(',');
      document.getElementById('user').value = res[0];
      document.getElementById('name').value = res[1];
      document.getElementById('address').value = res[2];
      document.getElementById('city').value = res[3];
      document.getElementById('last_name').value = res[4];
      document.getElementById('pc').value = res[5];
      document.getElementById('state').value = res[6];
      document.getElementById('permision').value = res[7];
      document.getElementById('check_in').value = res[8];
      document.getElementById('check_out').value = res[9];
    }
  };

  xmlhttp.open("GET", "links/users.php?operation=selectUser&id=" + select);
  xmlhttp.send();
}

function onClickUsers() {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState === 4 && xmlhttp.status == 200) {
      document.getElementById('all_users').innerHTML = xmlhttp.responseText;
    }
  };

  xmlhttp.open("GET", "links/users.php?operation=users");
  xmlhttp.send();
}

function onClickDelete() {
  var select = document.getElementById('all_users').value;
  if (!select || select === 'NA') {
    document.getElementById('response').innerHTML = "No se ha seleccionado ningun usuario";
    } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (xmlhttp.readyState === 4 && xmlhttp.status == 200) {
        document.getElementById('response').innerHTML = xmlhttp.responseText;
      }
    };

    xmlhttp.open("GET", "links/users.php?operation=delete&id=" + select);
    xmlhttp.send();
  }
}
