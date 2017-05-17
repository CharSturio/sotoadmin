<?php
	header ('Content-type: text/html; charset=utf-8');	
	ob_end_clean();
	
	include_once('class/cancelacion.class.php');
	
	
	$serv=new Cancelacion;
	$serv->usuario = "pruebasWS";
	$serv->password = "pruebasWS";
	$serv->rfc = "APR0412108C5";
	$serv->fecha = "2012-03-26T11:00:00";
	$serv->folios = Array(
						0 => "1EE7E7FE-1371-4D88-B8D6-A0E26232FBE2"
					);
	$serv->passwordkeys = "12345678a";
	
	// array bytes public key
	$handle = fopen('archivosPEM/apr0412108c5.cer','r');
	$contents = fread($handle,filesize("archivosPEM/apr0412108c5.cer"));
	$serv->publicKey = $contents;
	
	// array bytes public key
	$handle = fopen('archivosPEM/apr0412108c5.key','r');
	$contents = fread($handle,filesize("archivosPEM/apr0412108c5.key"));
	$serv->privateKey = $contents;
	
	
	//var_dump($serv->https->__getFunctions());
	//var_dump($serv->https->__getTypes());
	$serv->process();
	if($serv->error != ""){
		echo "Error**** <br>";
		echo $serv->error . "<br>";
		exit;
	}else{
		echo $serv->out . "<br>";
		exit;
	}
	
	
?>