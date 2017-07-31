<?php 

require_once "vendor/autoload.php";
require_once "clases/Auto.php";
require_once "clases/Usuario.php";
require_once "clases/Estacionamiento.php";
require_once "clases/Fichada.php";

date_default_timezone_set("America/Argentina/Buenos_Aires");

$app = new \Slim\Slim();

//////////////////////////////////////** ESTACIONAMIENTO **/////////////////////////////////////////
/// GET TRAER PISOS ////
$app->get('/traerPisos',function() use($app)
	{
		$json = Estacionamiento::traerPisos();
        //var_dump($json);
		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($json));
	});

/// GET TRAER LUGAR ////
$app->get('/traerLugar/:piso',function($piso) use($app)
	{
		$json = Estacionamiento::traerLugar($piso);
        //var_dump($json);
		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($json));
	});

/// GET TRAER ESTACIONAMIENTO ////
$app->get('/traerEstacionamiento/',function() use($app)
	{
		$json = Estacionamiento::traerTodos();
        //var_dump($json);
		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($json));
	});

//////////////////////////////////////** AUTO **////////////////////////////////////////////////////
/// GET TRAER AUTOS ////
$app->get('/traertodosautos',function() use($app)
	{
		$json = Auto::TraerTodosAutos();
        //var_dump($json);
		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($json));
	});

/// GET TRAER UN AUTO ////
$app->get('/traerunauto/:patente',function($patente) use($app)
	{
		$json = Auto::TraerUnAuto($patente);
		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($json));
	});

/// POST INSERTAR UN AUTO ////
$app->post('/insertarauto',function() use($app)
	{
		$lugar=$app->request->post("lugar");
		$marca=$app->request->post("marca");
		$patente=$app->request->post("patente");
		$color=$app->request->post("color");
		$hora = date("Y-m-d H:i:s");
        $autoAgregado=Auto::insertarAuto($lugar,$patente,$marca,$color,$hora);

        if(!$autoAgregado){
            $json = array("Error" => "No se agrego el auto");
        }else{
			Estacionamiento::modificarOcupado($lugar,1);
            $json = array("Mensaje" => "Se agrego un auto");
        }
                  
		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($json));
	});

/// PUT ACTUALIZAR AUTO ////
$app->put('/modificarauto/:marca/:patente/:color',function($marca,$patente,$color) use($app)
	{
        //$id=$app->request->post("id");
		//$marca=$app->request->post("marca");
		//$patente=$app->request->post("patente");
		//$color=$app->request->post("color");

        $auto = new Auto();
        $auto->setMarca($marca);
        $auto->setPatente($patente);
        $auto->setColor($color);
       // var_dumP($auto);

        if(!Auto::modificarAuto($auto)){
            $json = array("Error" => "No se modifico el auto");
        }else{
            $json = array("Mensaje" => "Se modifico un auto");
        }
    
		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($json));
	});

/// DELETE AUTO ////
$app->delete('/eliminarauto/:patente',function($patente) use($app)
	{
		$auto = Auto::TraerUnAuto($patente);
		if(!Auto::eliminarAuto($patente) ){
            $json = array("Error" => "No se elimino el auto");
        }else{
			Estacionamiento::modificarOcupado($auto->getIdLugar(),0);
            $json = array("Mensaje" => "Se elimino un auto");
        }
    
		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($json));
	});

//////////////////////////////////////** USUARIO **/////////////////////////////////////////////////
/// POST INSERTAR UN USUARIO ////
$app->post('/insertarUsuario',function() use($app)
	{
		
		$nombre=$app->request->post("nombre");
		$legajo=$app->request->post("legajo");
		$tipo=$app->request->post("tipo");
		$password=$app->request->post("password");
		$turno=$app->request->post("turno");
		$estado=$app->request->post("estado");

        $usuario=Usuario::insertarUsuario($nombre,$legajo,$tipo,$password,$turno,$estado);

        
        if(!$usuario){
            $json = array("Error" => "No se agrego el usuario");
        }else{
            $json = array("Mensaje" => "Se agrego un usuario");
        }
                  
		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($json));
	});

/// GET TRAER USUARIOS ////
$app->get('/traerUsuarios',function() use($app)
	{
		$json = Usuario::TraerUsuarios();
		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($json));
	});

/// DELETE Usuario ////
$app->delete('/eliminarUsuario/:legajo',function($legajo) use($app)
	{
		if(!Usuario::eliminarUsuario($legajo)){
            $json = array("Error" => "No se eliminio el usuario");
        }else{
            $json = array("Mensaje" => "Se elimino un usuario");
        }
    
		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($json));
	});

/// GET TRAER UN USUARIO ////
$app->get('/traerUsuario/:legajo',function($legajo) use($app)
	{
		$json = Usuario::TraerUsuario($legajo);
		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($json));
	});

/// PUT ACTUALIZAR USUARIO TURNO////
$app->put('/modificaUsuario/:legajo/:turno',function($legajo,$turno) use($app)
	{
        if(!Usuario::modificarTurno($legajo,$turno)){
            $json = array("Error" => "No se modifico el turno");
        }else{
            $json = array("Mensaje" => "Se modifico un turno");
        }
    
		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($json));
	});

/// PUT ACTUALIZAR USUARIO ESTADO////
$app->put('/modificaEstado/:legajo/:turno',function($legajo,$estado) use($app)
	{
        if(!Usuario::modificarEstado($legajo,$estado)){
            $json = array("Error" => "No se modifico el estado");
        }else{
            $json = array("Mensaje" => "Se modifico un estado");
        }
    
		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($json));
	});

/////////////////////////// FICHADAS ////////////////////////////////////
/// GET TRAER FICHADAS ////
$app->get('/traerFichadas',function() use($app)
	{
		$json = Fichada::TraerFichadas();
		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($json));
	});

//****
$app->run();

?>