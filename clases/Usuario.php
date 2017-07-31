<?php

require_once "AccesoDatos.php";

class Usuario
{
    #Atributos
    private $_nombre;
    private $_legajo;
    private $_tipo;
    private $_password;
    private $_turno;
    private $_estado;

    #Getter y Setter
    public function getNombre(){
        return $this->_nombre;
    }

    public function getLegajo(){
        return $this->_legajo;
    }

    public function getTipo(){
        return $this->_tipo;
    }

    public function getPassword(){
        return $this->_password;
    }

    public function getTurno(){
        return $this->_turno;
    }

    public function getEstado(){
        return $this->_estado;
    }

    public function setNombre($value){
        $this->_nombre = $value;
    }

    public function setLegajo($value){
        $this->_legajo = $value;
    }

    public function setTipo($value){
        $this->_tipo = $value;
    }

    public function setPassword($value){
        $this->_turno = $value;
    }

    public function setTurno($value){
        $this->_turno = $value;
    }

    public function setEstado($value){
        $this->_estado = $value;
    }

    #Constructor
    public function __construct($nombre=NULL,$legajo=NULL, $tipo=NULL, $password=NULL, $turno=NULL, $estado=NULL){
        if($nombre !== NULL && $legajo !== NULL && $tipo !== NULL && $password !== NULL && $turno !== NULL && $estado !== NULL){
            $this->_nombre = $nombre;
            $this->_legajo = $legajo;
            $this->_tipo = $tipo;
            $this->_password = $password;
            $this->_turno = $turno;
            $this->_estado = $estado;
        }
    }

    #Metodos de Clase
    //TRAER USUARIO LOGEADO
    public static function TraerUsuarioLog($nombre,$password){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta = $objetoAccesoDato->RetornarConsulta("SELECT nombre, legajo, tipo, password, turno, estado FROM usuarios WHERE nombre=:nombre and password=:password");
		$consulta->bindValue(':nombre',$nombre,PDO::PARAM_STR);//STR para cadenas
        $consulta->bindValue(':password',$password,PDO::PARAM_STR);
		$consulta->execute();

		return $consulta->fetchAll();
        //return $consulta->fetchAll(PDO::FETCH_CLASS,'Usuario');
	}

    //TRAER UN USUARIO 
    public static function TraerUsuario($legajo){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta = $objetoAccesoDato->RetornarConsulta("SELECT nombre, legajo, tipo, turno, estado FROM usuarios WHERE legajo=:legajo");
		$consulta->bindValue(':legajo',$legajo,PDO::PARAM_INT);//STR para cadenas
		$consulta->execute();

		//return $consulta->fetchAll();
        return $consulta->fetchAll(PDO::FETCH_CLASS,'Usuario');
	}

    //TRAER USUARIOS 
    public static function TraerUsuarios(){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta = $objetoAccesoDato->RetornarConsulta("SELECT nombre, legajo, tipo, turno, estado FROM usuarios");
		$consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS,'Usuario');
	}

    ///// INGRESAR USUARIO /////
    public static function insertarUsuario($nombre,$legajo,$tipo,$password,$turno,$estado)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        try{
            $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO usuarios(nombre, legajo, tipo, password, turno, estado)VALUES(:nombre,:legajo,:tipo,:password,:turno,:estado)");
            $consulta->bindValue(':nombre', $nombre, PDO::PARAM_STR);
            $consulta->bindValue(':legajo', $legajo, PDO::PARAM_INT);
            $consulta->bindValue(':tipo', $tipo, PDO::PARAM_INT );
            $consulta->bindValue(':password', $password, PDO::PARAM_STR);
            $consulta->bindValue(':turno', $turno, PDO::PARAM_INT );
            $consulta->bindValue(':estado', $estado, PDO::PARAM_INT );

            $consulta->execute(); 
        }catch(Ecxeption $e){
            return false;
        }
        return true;   
	}

    ///// ELIMINAR USUARIO /////
    public static function eliminarUsuario($legajo){

		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		try
		{
			$consulta = $objetoAccesoDato->RetornarConsulta("DELETE FROM usuarios WHERE legajo=:legajo");
			$consulta->bindValue(':legajo', $legajo, PDO::PARAM_INT);
			$consulta->execute();
		}
		catch(Ecxeption $e)
		{
			return false;
		}
		return true;
		
	}

    ///// MODIFICAR ESTADO /////
    public static function modificarEstado($legajo,$estado){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		try{
			$consulta = $objetoAccesoDato->RetornarConsulta("UPDATE usuarios SET estado=:estado WHERE legajo=:legajo");
            $consulta->bindValue(':legajo', $legajo, PDO::PARAM_INT);
            $consulta->bindValue(':estado', $estado, PDO::PARAM_INT );
			$consulta->execute();
		}catch(Ecxeptrion $e){
			return false;
		}
		return true;		
	}

    ///// MODIFICAR TURNO /////
    public static function modificarTurno($legajo,$turno){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		try{
			$consulta = $objetoAccesoDato->RetornarConsulta("UPDATE usuarios SET turno=:turno WHERE legajo=:legajo");
            $consulta->bindValue(':legajo', $legajo, PDO::PARAM_INT);
            $consulta->bindValue(':turno', $turno, PDO::PARAM_INT );
			$consulta->execute();
		}catch(Ecxeptrion $e){
			return false;
		}
		return true;		
	}
}

/// test ///
//$unUsuario = new Usuario("mario",3,"administrador","123");
//$dosUsuario = new Usuario("marito",4,"usuario");
//var_dump($unUsuario);
//var_dump($dosUsuario);
//echo"<br>";
//var_dump(Usuario::TraerUsuario("pepe","123"));
//$usuario = Usuario::TraerUsuarioLog("pepe","123");
//print_r($usuario);
//var_dump($usuario);
//echo $usuario[0]["nombre"];
//Usuario::modificarEstado(1,1);
//Usuario::modificarTurno(2,1);
?>