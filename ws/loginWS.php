<?php 
///***********************************************************************************************///
///COMO PROVEEDOR DEL SERVICIO WEB///
///***********************************************************************************************///
    require_once "../clases/Usuario.php";
//1.- INCLUIMOS LA LIBRERIA NUSOAP DENTRO DE NUESTRO ARCHIVO
	require_once('../lib/nusoap.php'); 
	
//2.- CREAMOS LA INSTACIA AL SERVIDOR
	$server = new nusoap_server(); 

//3.- INICIALIZAMOS EL SOPORTE WSDL (Web Service Description Language)
	$server->configureWSDL('Sevicio de Login', 'urn:loginWS'); 

//AGREGO TIPO COMPLEJO, INFORMANDO SU ESTRUCTURA	
	$server->wsdl->addComplexType(
		'Usuario',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'nombre' => array('name' => 'nombre', 'type' => 'xsd:string'),
			'legajo' => array('name' => 'legajo', 'type' => 'xsd:string'),
			'tipo' => array('name' => 'tipo', 'type' => 'xsd:string'),
			'password' => array('name' => 'password', 'type' => 'xsd:string')
		)
	);

//4.- REGISTRO EL METODO COMO UNA FUNCION PHP
	$server->register('Login',
			array("nombre" => 'xsd:string', "password"=>'xsd:string'),  //parameters
			array('return' => 'tns:Usuario'),  //output
			'urn:loginWS',   //namespace
			'urn:loginWS#Login',  //soapaction
			'rpc', // style
			'encoded', // use
			'Check user login'); 

//5.- DEFINIMOS EL METODO COMO UNA FUNCION PHP
	function Login($nombre,$password){
		$returUs = array();
		$usuario = Usuario::TraerUsuarioLog($nombre,$password);
		$returUs=$usuario[0];
		//var_dump($returUs);
		return $returUs;
		//return $returUs;*/
		//return $usuario;
		/*return array("nombre"=>"pepe",
					 "legajo"=>"1",
					 "tipo"=>"0",
					 "password"=>"123");*/
	}


//6.- USAMOS EL PEDIDO PARA INVOCAR EL SERVICIO
	$HTTP_RAW_POST_DATA = file_get_contents("php://input");
	
	$server->service($HTTP_RAW_POST_DATA);