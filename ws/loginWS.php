<?php 
///***********************************************************************************************///
///COMO PROVEEDOR DEL SERVICIO WEB///
///***********************************************************************************************///

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
									array('nombre' => array('name' => 'nombre', 'type' => 'xsd:string'),
										  'password' => array('name' => 'password', 'type' => 'xsd:string'),
	));

//4.- REGISTRAMOS EL METODO A EXPONER
	$server->register('Login',                			// METODO
				array('nombre' => 'xsd:string',
				      'password' => 'xsd:string'),  	// PARAMETROS DE ENTRADA
				array('return' => 'xsd:string'),    	// PARAMETROS DE SALIDA
				'urn:loginWS',                			// NAMESPACE
				'urn:loginWS#Login',           	        // ACCION SOAP
				'rpc',                        			// ESTILO
				'encoded',                    			// CODIFICADO
				'Suma dos numeros'                      // DOCUMENTACION
			);

//5.- DEFINIMOS EL METODO COMO UNA FUNCION PHP
	function Login($nombre,$password) {
		//CREAR 
	}

//6.- USAMOS EL PEDIDO PARA INVOCAR EL SERVICIO
	$HTTP_RAW_POST_DATA = file_get_contents("php://input");
	
	$server->service($HTTP_RAW_POST_DATA);