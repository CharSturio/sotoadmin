<?php

/************************************************************
#	Esta clase permite generar la firma digital a una cadena
#	mediante la ejecucion de comandos java
#
#	Results are passed to: FirmaString->output
#
#	Parameters to set:
#		usuario		-> usuario ws
#		password	-> password ws
#		rfc			-> rfc
#		fecha		-> fecha cancelacion
#		folios		-> folios lista de folios a cancelar
#		publicKey	-> archivo .cer
#		privateKey	-> archivo .key
#		passwordkeys-> password de la clave privada
#
#
#
#	Returned data:
#		error			-> Errores encontrados durante el proceso
#		out				-> acuse de cancelacion
#
#	Methods:
#		process()	-> Process data
************************************************************/

class Cancelacion{

	var $usuario;
	var $password;
	var $rfc;
	var $fecha;
	var $folios;
	var $publicKey;
	var $privateKey;
	var $passwordkeys;



	var $out;
	var $error;
	var $coderror;
	var $https;
	var $responseAutentica;
	var $Cancelacion_1Response;

	function Cancelacion(){
		// Set error message
		$this->error="";

		$this->https = new SoapClient('https://www.facturacfdi.mx/WSTimbrado/WSForcogsaService?wsdl');
	}

	function process(){
		try{
			if($this->usuario==""){
				$this->error="ERROR: El usuario es requerido.";
				return 0;
			}
			if($this->password==""){
				$this->error="ERROR: El password es requerido.";
				return 0;
			}


			var_dump($https);

			/* se le pasan los datos de acceso */
			$autentica = new Autenticar();
			$autentica->usuario = $this->usuario;
			$autentica->contrasena = $this->password;


			/* se cacha la respuesta de la autenticacion */
			$this->responseAutentica = $this->https->Autenticar($autentica);
			if($this->responseAutentica->return->mensaje != ""){
				$this->error = $this->responseAutentica->return->mensaje;
			}else{
				/* se manda el xml a timbrar */
				$cancela1 = new Cancelacion_1();
				$cancela1->rfcEmisor = $this->rfc;
				$cancela1->token = $this->responseAutentica->return->token;
				$cancela1->fecha = $this->fecha;
				$cancela1->folios = $this->folios;
				$cancela1->password = $this->passwordkeys;
				$cancela1->publicKey = $this->publicKey;
				$cancela1->privateKey = $this->privateKey;

				/* cacha la respuesta */
				$this->Cancelacion_1Response = $this->https->Cancelacion_1($cancela1);

				if($this->Cancelacion_1Response->return->mensaje != ""){
					$this->error = $this->Cancelacion_1Response->return->mensaje;
				}else{
					$this->out = $this->Cancelacion_1Response->return->acuse;
				}
			}
		} catch (SoapFault $e) {
			print("Auth Error:::: $e");
		}
	}
}


class Autenticar{
	public $usuario;
	public $contrase�a;
}

class Cancelacion_1{
	public $rfcEmisor;
	public $fecha;
	public $folios;
	public $publicKey;
	public $privateKey;
	public $password;
	public $token;
}
?>
