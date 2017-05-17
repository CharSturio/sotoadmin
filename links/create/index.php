<?php
	header ('Content-type: text/html; charset=utf-8');
	try {

		set_time_limit(0);

		$filename="xmls/FA0000571.xml";

		/*$output="";
		$file = fopen($filename, "r");
		while(!feof($file)) {
			//read file line by line into variable
		  $output = $output . fgets($file, 4096);
		}
		fclose ($file); */
		//echo $output;

		$XML = new DOMDocument();
		$XML->load( $filename );

		//set_time_limit(60);


		/* conexion al web service https://www.facturacfdi.mx/WSTimbrado/WSForcogsaService?wsdl    https://dev.facturacfdi.mx:8081/WSTimbrado/WSForcogsaService?wsdl */
		$client = new SoapClient('https://www.facturacfdi.mx/WSTimbrado/WSForcogsaService?wsdl');
		/* esto es solo para informativo */
		//var_dump($client->__getFunctions());

		/* se le pasan los datos de acceso */
		$autentica = new Autenticar();
		$autentica->usuario = "VAAA671004";//pruebasWS
		$autentica->contrasena = "7388O_a14";//pruebasWS

		/* se cacha la respuesta de la autenticacion */
		$responseAutentica = $client->Autenticar($autentica);

		echo $responseAutentica->return->mensaje . "<br>";
		echo $responseAutentica->return->token . "<br>";

		/* se manda el xml a timbrar */
		$timbrar = new Timbrar();
		$timbrar->cfd = $XML->saveXML();
		$timbrar->token = $responseAutentica->return->token;

		/* cacha la respuesta */
		$responseTimbre = $client->Timbrar($timbrar);
		echo $responseTimbre;
		//var_dump($responseTimbre);
		echo "<br><br><br>MSG SOAP REQUEST:<br><br>" . $client->__getLastRequest() . "\n";
		echo "<br><br><br>MSG SOAP REQUEST:<br><br>" . $client->__getLastResponse() . "\n";


		/* solo informativo... muestra el codigo de error en caso de existir y resultados */
		echo "codigoErr:" . $responseTimbre->return->codigo . "<br>";
		echo $responseTimbre->return->mensaje . "<br>";
		echo $responseTimbre->return->cfdi . "<br>";



	} catch (SoapFault $e) {
		print("Auth Error:::: $e");
	}


class Autenticar{
	public $usuario;
	public $contraseña;
}

class Timbrar{
	public $cfd;
	public $token;
}
?>
