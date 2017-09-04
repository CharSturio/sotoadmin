function onClickNew() {
  var name = document.getElementById('permission').value;
  var RegUsuGen = document.getElementById('RegUsuGen').checked;
  var RegUsuCre = document.getElementById('RegUsuCre').checked;
  var RegUsuMod = document.getElementById('RegUsuMod').checked;
  var RegUsuEli = document.getElementById('RegUsuEli').checked;
  var RegUsuVer = document.getElementById('RegUsuVer').checked;
  var RegCliGen = document.getElementById('RegCliGen').checked;
  var RegCliCre = document.getElementById('RegCliCre').checked;
  var RegCliMod = document.getElementById('RegCliMod').checked;
  var RegCliEli = document.getElementById('RegCliEli').checked;
  var RegCliVer = document.getElementById('RegCliVer').checked;
  var RegSucGen = document.getElementById('RegSucGen').checked;
  var RegSucCre = document.getElementById('RegSucCre').checked;
  var RegSucMod = document.getElementById('RegSucMod').checked;
  var RegSucEli = document.getElementById('RegSucEli').checked;
  var RegSucVer = document.getElementById('RegSucVer').checked;
  var RegProGen = document.getElementById('RegProGen').checked;
  var RegProCre = document.getElementById('RegProCre').checked;
  var RegProMod = document.getElementById('RegProMod').checked;
  var RegProModPre = document.getElementById('RegProModPre').checked;
  var RegProEli = document.getElementById('RegProEli').checked;
  var RegProVer = document.getElementById('RegProVer').checked;
  var UtiCyCGen = document.getElementById('UtiCyCGen').checked;
  var UtiCyCBus = document.getElementById('UtiCyCBus').checked;
  var UtiCyCSeg = document.getElementById('UtiCyCSeg').checked;
  var UtiCyCPag = document.getElementById('UtiCyCPag').checked;
  var UtiCyCSegInt = document.getElementById('UtiCyCSegInt').checked;
  var UtiEnvMerGen = document.getElementById('UtiEnvMerGen').checked;
  var UtiEnvMerEnv = document.getElementById('UtiEnvMerEnv').checked;
  var UtiCCGen = document.getElementById('UtiCCGen').checked;
  var UtiCCCorCaj = document.getElementById('UtiCCCorCaj').checked;
  var UtiCCPdf = document.getElementById('UtiCCPdf').checked;
  var UtiCCEnv = document.getElementById('UtiCCEnv').checked;
  var UtiEySCGen = document.getElementById('UtiEySCGen').checked;
  var UtiEySCAgrSal = document.getElementById('UtiEySCAgrSal').checked;
  var UtiEySCAgrEnt = document.getElementById('UtiEySCAgrEnt').checked;
  var UtiStoMinGen = document.getElementById('UtiStoMinGen').checked;
  var UtiStoMinEnv = document.getElementById('UtiStoMinEnv').checked;
  var UtiPerGen = document.getElementById('UtiPerGen').checked;
  var UtiPerCre = document.getElementById('UtiPerCre').checked;
  var UtiPerMod = document.getElementById('UtiPerMod').checked;
  var UtiPerEli = document.getElementById('UtiPerEli').checked;
  var UtiPerVer = document.getElementById('UtiPerVer').checked;
  var MovLisGen = document.getElementById('MovLisGen').checked;
  var MovLisBus = document.getElementById('MovLisBus').checked;
  var MovLisTim = document.getElementById('MovLisTim').checked;
  var MovLisDes = document.getElementById('MovLisDes').checked;
  var MovLisEnv = document.getElementById('MovLisEnv').checked;
  var MovLisEli = document.getElementById('MovLisEli').checked;
  var MovCotGen = document.getElementById('MovCotGen').checked;
  var MovCotBusCli = document.getElementById('MovCotBusCli').checked;
  var MovCotBusPro = document.getElementById('MovCotBusPro').checked;
  var MovCotFac = document.getElementById('MovCotFac').checked;
  var MovCotRem = document.getElementById('MovCotRem').checked;
  var MovCotCre = document.getElementById('MovCotCre').checked;
  var MovCotCan = document.getElementById('MovCotCan').checked;
  var MovInvGen = document.getElementById('MovInvGen').checked;
  var MovInvBus = document.getElementById('MovInvBus').checked;
  var MovInvMod = document.getElementById('MovInvMod').checked;
  var MovInvEntDev = document.getElementById('MovInvEntDev').checked;
  var MovInvSalDev = document.getElementById('MovInvSalDev').checked;
  var MovEntMerBus = document.getElementById('MovEntMerBus').checked;
  var MovEntMerGen = document.getElementById('MovEntMerGen').checked;
  var MovEntMerAgr = document.getElementById('MovEntMerAgr').checked;
  var RepFacGen = document.getElementById('RepFacGen').checked;
  var RepFacVer = document.getElementById('RepFacVer').checked;
  var RepFacDes = document.getElementById('RepFacDes').checked;
  var RepMerCInvGen = document.getElementById('RepMerCInvGen').checked;
  var RepMerCInvVer = document.getElementById('RepMerCInvVer').checked;
  var RepMerCInvDes = document.getElementById('RepMerCInvDes').checked;
  var RepMerSInvGen = document.getElementById('RepMerSInvGen').checked;
  var RepMerSInvVer = document.getElementById('RepMerSInvVer').checked;
  var RepMerSInvDes = document.getElementById('RepMerSInvDes').checked;
  var RepMerCCosGen = document.getElementById('RepMerCCosGen').checked;
  var RepMerCCosVer = document.getElementById('RepMerCCosVer').checked;
  var RepMerCCosDes = document.getElementById('RepMerCCosDes').checked;
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

  xmlhttp.open("GET", "links/permissions.php?operation=new&name=" + name +
  "&RegUsuGen=" + RegUsuGen + 
  "&RegUsuCre=" + RegUsuCre +
  "&RegUsuMod=" + RegUsuMod +
  "&RegUsuEli=" + RegUsuEli +
  "&RegUsuVer=" + RegUsuVer +
  "&RegCliGen=" + RegCliGen +
  "&RegCliCre=" + RegCliCre +
  "&RegCliMod=" + RegCliMod +
  "&RegCliEli=" + RegCliEli +
  "&RegCliVer=" + RegCliVer +
  "&RegSucGen=" + RegSucGen +
  "&RegSucCre=" + RegSucCre +
  "&RegSucMod=" + RegSucMod +
  "&RegSucEli=" + RegSucEli +
  "&RegSucVer=" + RegSucVer +
  "&RegProGen=" + RegProGen +
  "&RegProCre=" + RegProCre +
  "&RegProMod=" + RegProMod +
  "&RegProModPre=" + RegProModPre +
  "&RegProEli=" + RegProEli +
  "&RegProVer=" + RegProVer +
  "&UtiCyCGen=" + UtiCyCGen +
  "&UtiCyCBus=" + UtiCyCBus +
  "&UtiCyCSeg=" + UtiCyCSeg +
  "&UtiCyCPag=" + UtiCyCPag +
  "&UtiCyCSegInt=" + UtiCyCSegInt +
  "&UtiEnvMerGen=" + UtiEnvMerGen +
  "&UtiEnvMerEnv=" + UtiEnvMerEnv +
  "&UtiCCGen=" + UtiCCGen +
  "&UtiCCCorCaj=" + UtiCCCorCaj +
  "&UtiCCPdf=" + UtiCCPdf +
  "&UtiCCEnv=" + UtiCCEnv +
  "&UtiEySCGen=" + UtiEySCGen +
  "&UtiEySCAgrSal=" + UtiEySCAgrSal +
  "&UtiEySCAgrEnt=" + UtiEySCAgrEnt +
  "&UtiStoMinGen=" + UtiStoMinGen +
  "&UtiStoMinEnv=" + UtiStoMinEnv +
  "&UtiPerGen=" + UtiPerGen +
  "&UtiPerCre=" + UtiPerCre +
  "&UtiPerMod=" + UtiPerMod +
  "&UtiPerEli=" + UtiPerEli +
  "&UtiPerVer=" + UtiPerVer +
  "&MovLisGen=" + MovLisGen +
  "&MovLisBus=" + MovLisBus +
  "&MovLisTim=" + MovLisTim +
  "&MovLisDes=" + MovLisDes +
  "&MovLisEnv=" + MovLisEnv +
  "&MovLisEli=" + MovLisEli +
  "&MovCotGen=" + MovCotGen +
  "&MovCotBusCli=" + MovCotBusCli +
  "&MovCotBusPro=" + MovCotBusPro +
  "&MovCotFac=" + MovCotFac +
  "&MovCotRem=" + MovCotRem +
  "&MovCotCre=" + MovCotCre +
  "&MovCotCan=" + MovCotCan +
  "&MovInvGen=" + MovInvGen +
  "&MovInvBus=" + MovInvBus +
  "&MovInvMod=" + MovInvMod +
  "&MovInvEntDev=" + MovInvEntDev +
  "&MovInvSalDev=" + MovInvSalDev +
  "&MovEntMerBus=" + MovEntMerBus +
  "&MovEntMerGen=" + MovEntMerGen +
  "&MovEntMerAgr=" + MovEntMerAgr +
  "&RepFacGen=" + RepFacGen +      
  "&RepFacVer=" + RepFacVer +      
  "&RepFacDes=" + RepFacDes +      
  "&RepMerCInvGen=" + RepMerCInvGen +
  "&RepMerCInvVer=" + RepMerCInvVer +
  "&RepMerCInvDes=" + RepMerCInvDes +
  "&RepMerSInvGen=" + RepMerSInvGen +
  "&RepMerSInvVer=" + RepMerSInvVer +
  "&RepMerSInvDes=" + RepMerSInvDes +
  "&RepMerCCosGen=" + RepMerCCosGen +
  "&RepMerCCosVer=" + RepMerCCosVer +
  "&RepMerCCosDes=" + RepMerCCosDes);
  xmlhttp.send();
}

function onClickModify() {
  var id = document.getElementById('all_permissions').value;
  if (!id || id === 'NA') {
    document.getElementById('response').innerHTML = "No se ha seleccionado ningun usuario";
  } else {
    var name = document.getElementById('permission').value;
    var RegUsuGen = document.getElementById('RegUsuGen').checked;
    var RegUsuCre = document.getElementById('RegUsuCre').checked;
    var RegUsuMod = document.getElementById('RegUsuMod').checked;
    var RegUsuEli = document.getElementById('RegUsuEli').checked;
    var RegUsuVer = document.getElementById('RegUsuVer').checked;
    var RegCliGen = document.getElementById('RegCliGen').checked;
    var RegCliCre = document.getElementById('RegCliCre').checked;
    var RegCliMod = document.getElementById('RegCliMod').checked;
    var RegCliEli = document.getElementById('RegCliEli').checked;
    var RegCliVer = document.getElementById('RegCliVer').checked;
    var RegSucGen = document.getElementById('RegSucGen').checked;
    var RegSucCre = document.getElementById('RegSucCre').checked;
    var RegSucMod = document.getElementById('RegSucMod').checked;
    var RegSucEli = document.getElementById('RegSucEli').checked;
    var RegSucVer = document.getElementById('RegSucVer').checked;
    var RegProGen = document.getElementById('RegProGen').checked;
    var RegProCre = document.getElementById('RegProCre').checked;
    var RegProMod = document.getElementById('RegProMod').checked;
    var RegProModPre = document.getElementById('RegProModPre').checked;
    var RegProEli = document.getElementById('RegProEli').checked;
    var RegProVer = document.getElementById('RegProVer').checked;
    var UtiCyCGen = document.getElementById('UtiCyCGen').checked;
    var UtiCyCBus = document.getElementById('UtiCyCBus').checked;
    var UtiCyCSeg = document.getElementById('UtiCyCSeg').checked;
    var UtiCyCPag = document.getElementById('UtiCyCPag').checked;
    var UtiCyCSegInt = document.getElementById('UtiCyCSegInt').checked;
    var UtiEnvMerGen = document.getElementById('UtiEnvMerGen').checked;
    var UtiEnvMerEnv = document.getElementById('UtiEnvMerEnv').checked;
    var UtiCCGen = document.getElementById('UtiCCGen').checked;
    var UtiCCCorCaj = document.getElementById('UtiCCCorCaj').checked;
    var UtiCCPdf = document.getElementById('UtiCCPdf').checked;
    var UtiCCEnv = document.getElementById('UtiCCEnv').checked;
    var UtiEySCGen = document.getElementById('UtiEySCGen').checked;
    var UtiEySCAgrSal = document.getElementById('UtiEySCAgrSal').checked;
    var UtiEySCAgrEnt = document.getElementById('UtiEySCAgrEnt').checked;
    var UtiStoMinGen = document.getElementById('UtiStoMinGen').checked;
    var UtiStoMinEnv = document.getElementById('UtiStoMinEnv').checked;
    var UtiPerGen = document.getElementById('UtiPerGen').checked;
    var UtiPerCre = document.getElementById('UtiPerCre').checked;
    var UtiPerMod = document.getElementById('UtiPerMod').checked;
    var UtiPerEli = document.getElementById('UtiPerEli').checked;
    var UtiPerVer = document.getElementById('UtiPerVer').checked;
    var MovLisGen = document.getElementById('MovLisGen').checked;
    var MovLisBus = document.getElementById('MovLisBus').checked;
    var MovLisTim = document.getElementById('MovLisTim').checked;
    var MovLisDes = document.getElementById('MovLisDes').checked;
    var MovLisEnv = document.getElementById('MovLisEnv').checked;
    var MovLisEli = document.getElementById('MovLisEli').checked;
    var MovCotGen = document.getElementById('MovCotGen').checked;
    var MovCotBusCli = document.getElementById('MovCotBusCli').checked;
    var MovCotBusPro = document.getElementById('MovCotBusPro').checked;
    var MovCotFac = document.getElementById('MovCotFac').checked;
    var MovCotRem = document.getElementById('MovCotRem').checked;
    var MovCotCre = document.getElementById('MovCotCre').checked;
    var MovCotCan = document.getElementById('MovCotCan').checked;
    var MovInvGen = document.getElementById('MovInvGen').checked;
    var MovInvBus = document.getElementById('MovInvBus').checked;
    var MovInvMod = document.getElementById('MovInvMod').checked;
    var MovInvEntDev = document.getElementById('MovInvEntDev').checked;
    var MovInvSalDev = document.getElementById('MovInvSalDev').checked;
    var MovEntMerBus = document.getElementById('MovEntMerBus').checked;
    var MovEntMerGen = document.getElementById('MovEntMerGen').checked;
    var MovEntMerAgr = document.getElementById('MovEntMerAgr').checked;
    var RepFacGen = document.getElementById('RepFacGen').checked;
    var RepFacVer = document.getElementById('RepFacVer').checked;
    var RepFacDes = document.getElementById('RepFacDes').checked;
    var RepMerCInvGen = document.getElementById('RepMerCInvGen').checked;
    var RepMerCInvVer = document.getElementById('RepMerCInvVer').checked;
    var RepMerCInvDes = document.getElementById('RepMerCInvDes').checked;
    var RepMerSInvGen = document.getElementById('RepMerSInvGen').checked;
    var RepMerSInvVer = document.getElementById('RepMerSInvVer').checked;
    var RepMerSInvDes = document.getElementById('RepMerSInvDes').checked;
    var RepMerCCosGen = document.getElementById('RepMerCCosGen').checked;
    var RepMerCCosVer = document.getElementById('RepMerCCosVer').checked;
    var RepMerCCosDes = document.getElementById('RepMerCCosDes').checked;

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

    xmlhttp.open("GET", "links/permissions.php?operation=modify&id=" + name +
    "&RegUsuGen=" + RegUsuGen + 
    "&RegUsuCre=" + RegUsuCre +
    "&RegUsuMod=" + RegUsuMod +
    "&RegUsuEli=" + RegUsuEli +
    "&RegUsuVer=" + RegUsuVer +
    "&RegCliGen=" + RegCliGen +
    "&RegCliCre=" + RegCliCre +
    "&RegCliMod=" + RegCliMod +
    "&RegCliEli=" + RegCliEli +
    "&RegCliVer=" + RegCliVer +
    "&RegSucGen=" + RegSucGen +
    "&RegSucCre=" + RegSucCre +
    "&RegSucMod=" + RegSucMod +
    "&RegSucEli=" + RegSucEli +
    "&RegSucVer=" + RegSucVer +
    "&RegProGen=" + RegProGen +
    "&RegProCre=" + RegProCre +
    "&RegProMod=" + RegProMod +
    "&RegProModPre=" + RegProModPre +
    "&RegProEli=" + RegProEli +
    "&RegProVer=" + RegProVer +
    "&UtiCyCGen=" + UtiCyCGen +
    "&UtiCyCBus=" + UtiCyCBus +
    "&UtiCyCSeg=" + UtiCyCSeg +
    "&UtiCyCPag=" + UtiCyCPag +
    "&UtiCyCSegInt=" + UtiCyCSegInt +
    "&UtiEnvMerGen=" + UtiEnvMerGen +
    "&UtiEnvMerEnv=" + UtiEnvMerEnv +
    "&UtiCCGen=" + UtiCCGen +
    "&UtiCCCorCaj=" + UtiCCCorCaj +
    "&UtiCCPdf=" + UtiCCPdf +
    "&UtiCCEnv=" + UtiCCEnv +
    "&UtiEySCGen=" + UtiEySCGen +
    "&UtiEySCAgrSal=" + UtiEySCAgrSal +
    "&UtiEySCAgrEnt=" + UtiEySCAgrEnt +
    "&UtiStoMinGen=" + UtiStoMinGen +
    "&UtiStoMinEnv=" + UtiStoMinEnv +
    "&UtiPerGen=" + UtiPerGen +
    "&UtiPerCre=" + UtiPerCre +
    "&UtiPerMod=" + UtiPerMod +
    "&UtiPerEli=" + UtiPerEli +
    "&UtiPerVer=" + UtiPerVer +
    "&MovLisGen=" + MovLisGen +
    "&MovLisBus=" + MovLisBus +
    "&MovLisTim=" + MovLisTim +
    "&MovLisDes=" + MovLisDes +
    "&MovLisEnv=" + MovLisEnv +
    "&MovLisEli=" + MovLisEli +
    "&MovCotGen=" + MovCotGen +
    "&MovCotBusCli=" + MovCotBusCli +
    "&MovCotBusPro=" + MovCotBusPro +
    "&MovCotFac=" + MovCotFac +
    "&MovCotRem=" + MovCotRem +
    "&MovCotCre=" + MovCotCre +
    "&MovCotCan=" + MovCotCan +
    "&MovInvGen=" + MovInvGen +
    "&MovInvBus=" + MovInvBus +
    "&MovInvMod=" + MovInvMod +
    "&MovInvEntDev=" + MovInvEntDev +
    "&MovInvSalDev=" + MovInvSalDev +
    "&MovEntMerBus=" + MovEntMerBus +
    "&MovEntMerGen=" + MovEntMerGen +
    "&MovEntMerAgr=" + MovEntMerAgr +
    "&RepFacGen=" + RepFacGen +      
    "&RepFacVer=" + RepFacVer +      
    "&RepFacDes=" + RepFacDes +      
    "&RepMerCInvGen=" + RepMerCInvGen +
    "&RepMerCInvVer=" + RepMerCInvVer +
    "&RepMerCInvDes=" + RepMerCInvDes +
    "&RepMerSInvGen=" + RepMerSInvGen +
    "&RepMerSInvVer=" + RepMerSInvVer +
    "&RepMerSInvDes=" + RepMerSInvDes +
    "&RepMerCCosGen=" + RepMerCCosGen +
    "&RepMerCCosVer=" + RepMerCCosVer +
    "&RepMerCCosDes=" + RepMerCCosDes);
    xmlhttp.send();
  }
}

function onClickSelect() {
  var select = document.getElementById('all_permissions').value;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState === 4 && xmlhttp.status == 200) {
      //document.getElementById('all_permissions').innerHTML = xmlhttp.responseText;
      var res = xmlhttp.responseText.split(',');
      document.getElementById('permission').value = res[0];
      document.getElementById('RegUsuGen').checked = (res[1] == 'true' ? true : false);
      document.getElementById('RegUsuCre').checked = (res[2] == 'true' ? true : false);
      document.getElementById('RegUsuMod').checked = (res[3] == 'true' ? true : false);
      document.getElementById('RegUsuEli').checked = (res[4] == 'true' ? true : false);
      document.getElementById('RegUsuVer').checked = (res[5] == 'true' ? true : false);
      document.getElementById('RegCliGen').checked = (res[6] == 'true' ? true : false);
      document.getElementById('RegCliCre').checked = (res[7] == 'true' ? true : false);
      document.getElementById('RegCliMod').checked = (res[8] == 'true' ? true : false);
      document.getElementById('RegCliEli').checked = (res[9] == 'true' ? true : false);
      document.getElementById('RegCliVer').checked = (res[10] == 'true' ? true : false);
      document.getElementById('RegSucGen').checked = (res[11] == 'true' ? true : false);
      document.getElementById('RegSucCre').checked = (res[12] == 'true' ? true : false);
      document.getElementById('RegSucMod').checked = (res[13] == 'true' ? true : false);
      document.getElementById('RegSucEli').checked = (res[14] == 'true' ? true : false);
      document.getElementById('RegSucVer').checked = (res[15] == 'true' ? true : false);
      document.getElementById('RegProGen').checked = (res[16] == 'true' ? true : false);
      document.getElementById('RegProCre').checked = (res[17] == 'true' ? true : false);
      document.getElementById('RegProMod').checked = (res[18] == 'true' ? true : false);
      document.getElementById('RegProModPre').checked = (res[19] == 'true' ? true : false);
      document.getElementById('RegProEli').checked = (res[20] == 'true' ? true : false);
      document.getElementById('RegProVer').checked = (res[21] == 'true' ? true : false);
      document.getElementById('UtiCyCGen').checked = (res[22] == 'true' ? true : false);
      document.getElementById('UtiCyCBus').checked = (res[23] == 'true' ? true : false);
      document.getElementById('UtiCyCSeg').checked = (res[24] == 'true' ? true : false);
      document.getElementById('UtiCyCPag').checked = (res[25] == 'true' ? true : false);
      document.getElementById('UtiCyCSegInt').checked = (res[26] == 'true' ? true : false);
      document.getElementById('UtiEnvMerGen').checked = (res[27] == 'true' ? true : false);
      document.getElementById('UtiEnvMerEnv').checked = (res[28] == 'true' ? true : false);
      document.getElementById('UtiCCGen').checked = (res[29] == 'true' ? true : false);
      document.getElementById('UtiCCCorCaj').checked = (res[30] == 'true' ? true : false);
      document.getElementById('UtiCCPdf').checked = (res[31] == 'true' ? true : false);
      document.getElementById('UtiCCEnv').checked = (res[32] == 'true' ? true : false);
      document.getElementById('UtiEySCGen').checked = (res[33] == 'true' ? true : false);
      document.getElementById('UtiEySCAgrSal').checked = (res[34] == 'true' ? true : false);
      document.getElementById('UtiEySCAgrEnt').checked = (res[35] == 'true' ? true : false);
      document.getElementById('UtiStoMinGen').checked = (res[36] == 'true' ? true : false);
      document.getElementById('UtiStoMinEnv').checked = (res[37] == 'true' ? true : false);
      document.getElementById('UtiPerGen').checked = (res[38] == 'true' ? true : false);
      document.getElementById('UtiPerCre').checked = (res[39] == 'true' ? true : false);
      document.getElementById('UtiPerMod').checked = (res[40] == 'true' ? true : false);
      document.getElementById('UtiPerEli').checked = (res[41] == 'true' ? true : false);
      document.getElementById('UtiPerVer').checked = (res[42] == 'true' ? true : false);
      document.getElementById('MovLisGen').checked = (res[43] == 'true' ? true : false);
      document.getElementById('MovLisBus').checked = (res[44] == 'true' ? true : false);
      document.getElementById('MovLisTim').checked = (res[45] == 'true' ? true : false);
      document.getElementById('MovLisDes').checked = (res[46] == 'true' ? true : false);
      document.getElementById('MovLisEnv').checked = (res[47] == 'true' ? true : false);
      document.getElementById('MovLisEli').checked = (res[48] == 'true' ? true : false);
      document.getElementById('MovCotGen').checked = (res[49] == 'true' ? true : false);
      document.getElementById('MovCotBusCli').checked = (res[50] == 'true' ? true : false);
      document.getElementById('MovCotBusPro').checked = (res[51] == 'true' ? true : false);
      document.getElementById('MovCotFac').checked = (res[52] == 'true' ? true : false);
      document.getElementById('MovCotRem').checked = (res[53] == 'true' ? true : false);
      document.getElementById('MovCotCre').checked = (res[54] == 'true' ? true : false);
      document.getElementById('MovCotCan').checked = (res[55] == 'true' ? true : false);
      document.getElementById('MovInvGen').checked = (res[56] == 'true' ? true : false);
      document.getElementById('MovInvBus').checked = (res[57] == 'true' ? true : false);
      document.getElementById('MovInvMod').checked = (res[58] == 'true' ? true : false);
      document.getElementById('MovInvEntDev').checked = (res[59] == 'true' ? true : false);
      document.getElementById('MovInvSalDev').checked = (res[60] == 'true' ? true : false);
      document.getElementById('MovEntMerBus').checked = (res[61] == 'true' ? true : false);
      document.getElementById('MovEntMerGen').checked = (res[62] == 'true' ? true : false);
      document.getElementById('MovEntMerAgr').checked = (res[63] == 'true' ? true : false);
      document.getElementById('RepFacGen').checked = (res[64] == 'true' ? true : false);
      document.getElementById('RepFacVer').checked = (res[65] == 'true' ? true : false);
      document.getElementById('RepFacDes').checked = (res[66] == 'true' ? true : false);
      document.getElementById('RepMerCInvGen').checked = (res[67] == 'true' ? true : false);
      document.getElementById('RepMerCInvVer').checked = (res[68] == 'true' ? true : false);
      document.getElementById('RepMerCInvDes').checked = (res[69] == 'true' ? true : false);
      document.getElementById('RepMerSInvGen').checked = (res[70] == 'true' ? true : false);
      document.getElementById('RepMerSInvVer').checked = (res[71] == 'true' ? true : false);
      document.getElementById('RepMerSInvDes').checked = (res[72] == 'true' ? true : false);
      document.getElementById('RepMerCCosGen').checked = (res[73] == 'true' ? true : false);
      document.getElementById('RepMerCCosVer').checked = (res[74] == 'true' ? true : false);
      document.getElementById('RepMerCCosDes').checked = (res[75] == 'true' ? true : false);
    }
  };

  xmlhttp.open("GET", "links/permissions.php?operation=selectpermissions&id=" + select);
  xmlhttp.send();
}

function onClickPermissions() {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState === 4 && xmlhttp.status == 200) {
      if (xmlhttp.responseText == 'noPermit') {
        alert("No cuenta con los permisos necesarios.");
      } else {
        document.getElementById('all_permissions').innerHTML = xmlhttp.responseText;            
      }
    }
  };

  xmlhttp.open("GET", "links/permissions.php?operation=permissions");
  xmlhttp.send();
}

function onClickDelete() {
  var select = document.getElementById('all_permissions').value;
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

    xmlhttp.open("GET", "links/permissions.php?operation=delete&id=" + select);
    xmlhttp.send();
  }
}
