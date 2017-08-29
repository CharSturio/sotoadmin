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
      document.getElementById('RegUsuGen').checked = (res[1] == 0 ? false : true);
      document.getElementById('RegUsuCre').checked = (res[2] == 0 ? false : true);
      document.getElementById('RegUsuMod').checked = (res[3] == 0 ? false : true);
      document.getElementById('RegUsuEli').checked = (res[4] == 0 ? false : true);
      document.getElementById('RegUsuVer').checked = (res[5] == 0 ? false : true);
      document.getElementById('RegCliGen').checked = (res[6] == 0 ? false : true);
      document.getElementById('RegCliCre').checked = (res[7] == 0 ? false : true);
      document.getElementById('RegCliMod').checked = (res[8] == 0 ? false : true);
      document.getElementById('RegCliEli').checked = (res[9] == 0 ? false : true);
      document.getElementById('RegCliVer').checked = (res[10] == 0 ? false : true);
      document.getElementById('RegSucGen').checked = (res[11] == 0 ? false : true);
      document.getElementById('RegSucCre').checked = (res[12] == 0 ? false : true);
      document.getElementById('RegSucMod').checked = (res[13] == 0 ? false : true);
      document.getElementById('RegSucEli').checked = (res[14] == 0 ? false : true);
      document.getElementById('RegSucVer').checked = (res[15] == 0 ? false : true);
      document.getElementById('RegProGen').checked = (res[16] == 0 ? false : true);
      document.getElementById('RegProCre').checked = (res[17] == 0 ? false : true);
      document.getElementById('RegProMod').checked = (res[18] == 0 ? false : true);
      document.getElementById('RegProModPre').checked = (res[19] == 0 ? false : true);
      document.getElementById('RegProEli').checked = (res[20] == 0 ? false : true);
      document.getElementById('RegProVer').checked = (res[21] == 0 ? false : true);
      document.getElementById('UtiCyCGen').checked = (res[22] == 0 ? false : true);
      document.getElementById('UtiCyCBus').checked = (res[23] == 0 ? false : true);
      document.getElementById('UtiCyCSeg').checked = (res[24] == 0 ? false : true);
      document.getElementById('UtiCyCPag').checked = (res[25] == 0 ? false : true);
      document.getElementById('UtiCyCSegInt').checked = (res[26] == 0 ? false : true);
      document.getElementById('UtiEnvMerGen').checked = (res[27] == 0 ? false : true);
      document.getElementById('UtiEnvMerEnv').checked = (res[28] == 0 ? false : true);
      document.getElementById('UtiCCGen').checked = (res[29] == 0 ? false : true);
      document.getElementById('UtiCCCorCaj').checked = (res[30] == 0 ? false : true);
      document.getElementById('UtiCCPdf').checked = (res[31] == 0 ? false : true);
      document.getElementById('UtiCCEnv').checked = (res[32] == 0 ? false : true);
      document.getElementById('UtiEySCGen').checked = (res[33] == 0 ? false : true);
      document.getElementById('UtiEySCAgrSal').checked = (res[34] == 0 ? false : true);
      document.getElementById('UtiEySCAgrEnt').checked = (res[35] == 0 ? false : true);
      document.getElementById('UtiStoMinGen').checked = (res[36] == 0 ? false : true);
      document.getElementById('UtiStoMinEnv').checked = (res[37] == 0 ? false : true);
      document.getElementById('UtiPerGen').checked = (res[38] == 0 ? false : true);
      document.getElementById('UtiPerCre').checked = (res[39] == 0 ? false : true);
      document.getElementById('UtiPerMod').checked = (res[40] == 0 ? false : true);
      document.getElementById('UtiPerEli').checked = (res[41] == 0 ? false : true);
      document.getElementById('UtiPerVer').checked = (res[42] == 0 ? false : true);
      document.getElementById('MovLisGen').checked = (res[43] == 0 ? false : true);
      document.getElementById('MovLisBus').checked = (res[44] == 0 ? false : true);
      document.getElementById('MovLisTim').checked = (res[45] == 0 ? false : true);
      document.getElementById('MovLisDes').checked = (res[46] == 0 ? false : true);
      document.getElementById('MovLisEnv').checked = (res[47] == 0 ? false : true);
      document.getElementById('MovLisEli').checked = (res[48] == 0 ? false : true);
      document.getElementById('MovCotGen').checked = (res[49] == 0 ? false : true);
      document.getElementById('MovCotBusCli').checked = (res[50] == 0 ? false : true);
      document.getElementById('MovCotBusPro').checked = (res[51] == 0 ? false : true);
      document.getElementById('MovCotFac').checked = (res[52] == 0 ? false : true);
      document.getElementById('MovCotRem').checked = (res[53] == 0 ? false : true);
      document.getElementById('MovCotCre').checked = (res[54] == 0 ? false : true);
      document.getElementById('MovCotCan').checked = (res[55] == 0 ? false : true);
      document.getElementById('MovInvGen').checked = (res[56] == 0 ? false : true);
      document.getElementById('MovInvBus').checked = (res[57] == 0 ? false : true);
      document.getElementById('MovInvMod').checked = (res[58] == 0 ? false : true);
      document.getElementById('MovInvEntDev').checked = (res[59] == 0 ? false : true);
      document.getElementById('MovInvSalDev').checked = (res[60] == 0 ? false : true);
      document.getElementById('MovEntMerBus').checked = (res[61] == 0 ? false : true);
      document.getElementById('MovEntMerGen').checked = (res[62] == 0 ? false : true);
      document.getElementById('MovEntMerAgr').checked = (res[63] == 0 ? false : true);
      document.getElementById('RepFacGen').checked = (res[64] == 0 ? false : true);
      document.getElementById('RepFacVer').checked = (res[65] == 0 ? false : true);
      document.getElementById('RepFacDes').checked = (res[66] == 0 ? false : true);
      document.getElementById('RepMerCInvGen').checked = (res[67] == 0 ? false : true);
      document.getElementById('RepMerCInvVer').checked = (res[68] == 0 ? false : true);
      document.getElementById('RepMerCInvDes').checked = (res[69] == 0 ? false : true);
      document.getElementById('RepMerSInvGen').checked = (res[70] == 0 ? false : true);
      document.getElementById('RepMerSInvVer').checked = (res[71] == 0 ? false : true);
      document.getElementById('RepMerSInvDes').checked = (res[72] == 0 ? false : true);
      document.getElementById('RepMerCCosGen').checked = (res[73] == 0 ? false : true);
      document.getElementById('RepMerCCosVer').checked = (res[74] == 0 ? false : true);
      document.getElementById('RepMerCCosDes').checked = (res[75] == 0 ? false : true);
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
