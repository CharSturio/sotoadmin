function onClickNew() {
  var name = document.getElementById('name').value;
  var address = document.getElementById('address').value;
  var nint = document.getElementById('nint').value;
  var city = document.getElementById('city').value;
  var cp = document.getElementById('cp').value;
  var reason = document.getElementById('reason').value;
  var rfc = document.getElementById('rfc').value;
  var next = document.getElementById('next').value;
  var state = document.getElementById('state').value;
  var phone = document.getElementById('phone').value;
  var mail = document.getElementById('mail').value;
  var colony = document.getElementById('colony').value;
  
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

  xmlhttp.open("GET", "links/branch.php?operation=new&name=" + name + "&address=" + address + "&nint=" + nint + "&city=" + city + "&cp=" + cp + "&reason=" + reason + "&rfc=" + rfc + "&next=" + next + "&state=" + state + "&phone=" + phone + "&mail=" + mail + "&colony=" + colony);
  xmlhttp.send();
}

function onClickModify() {
  var id = document.getElementById('all_branch').value;
  if (!id || id === 'NA') {
    document.getElementById('response').innerHTML = "No se ha seleccionado ningun usuario";
  } else {
    var name = document.getElementById('name').value;
    var address = document.getElementById('address').value;
    var nint = document.getElementById('nint').value;
    var city = document.getElementById('city').value;
    var cp = document.getElementById('cp').value;
    var reason = document.getElementById('reason').value;
    var rfc = document.getElementById('rfc').value;
    var next = document.getElementById('next').value;
    var state = document.getElementById('state').value;
    var phone = document.getElementById('phone').value;
    var mail = document.getElementById('mail').value;
    var colony = document.getElementById('colony').value;

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

    xmlhttp.open("GET", "links/branch.php?operation=modify&&name=" + name + "&address=" + address + "&nint=" + nint + "&city=" + city + "&cp=" + cp + "&reason=" + reason + "&rfc=" + rfc + "&next=" + next + "&state=" + state + "&phone=" + phone + "&mail=" + mail + "&colony=" + colony + "&id=" + id);
    xmlhttp.send();
  }
}

function onClickSelect() {
  var select = document.getElementById('all_branch').value;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState === 4 && xmlhttp.status == 200) {
      //document.getElementById('all_branch').innerHTML = xmlhttp.responseText;
      var res = xmlhttp.responseText.split(',');
      document.getElementById('name').value = res[0];
      document.getElementById('rfc').value = res[1];
      document.getElementById('address').value = res[2];
      document.getElementById('nint').value = res[3];
      document.getElementById('next').value = res[4];
      document.getElementById('state').value = res[5];
      document.getElementById('city').value = res[6];
      document.getElementById('cp').value = res[7];
      document.getElementById('reason').value = res[8];
      document.getElementById('phone').value = res[9];
      document.getElementById('mail').value = res[10];
      document.getElementById('colony').value = res[11];
    }
  };

  xmlhttp.open("GET", "links/branch.php?operation=selectBranch&id=" + select);
  xmlhttp.send();
}

function onClickBranch() {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState === 4 && xmlhttp.status == 200) {
      if (xmlhttp.responseText == 'noPermit') {
        alert("No cuenta con los permisos necesarios.");
      } else {
        document.getElementById('all_branch').innerHTML = xmlhttp.responseText;            
      }
    }
  };

  xmlhttp.open("GET", "links/branch.php?operation=branch");
  xmlhttp.send();
}

function onClickDelete() {
  var select = document.getElementById('all_branch').value;
  if (!select || select === 'NA') {
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

    xmlhttp.open("GET", "links/branch.php?operation=delete&id=" + select);
    xmlhttp.send();
  }
}
