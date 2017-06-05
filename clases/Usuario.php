<?php

require_once "AccesoDatos.php";

class Usuario
{
    #Atributos
    private $_nombre;
    private $_legajo;
    private $_tipo;
    private $_password;

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

    public function setNombre($value){
        $this->_nombre = $value;
    }

    public function setLegajo($value){
        $this->_Legajo = $value;
    }

    public function setTipo($value){
        $this->_tipo = $value;
    }

    public function setPassword($value){
        $this->password = $value;
    }

    #Constructor
    public function __construct($nombre=NULL,$legajo=NULL, $tipo=NULL, $password=NULL){
        if($nombre !== NULL && $legajo !== NULL && $tipo !== NULL && $password !== NULL){
            $this->_nombre = $nombre;
            $this->_legajo = $legajo;
            $this->_tipo = $tipo;
            $this->_password = $password;
        }else{
            $this->_nombre = $nombre;
            $this->_legajo = $legajo;
            $this->_tipo = $tipo;
        }
    }

    //Metodos de Clase
    public static function TraerUsuario($legajo){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta = $objetoAccesoDato->RetornarConsulta("SELECT nombre, legajo, tipo, password FROM login WHERE legajo=:legajo");
		$consulta->bindValue(':legajo',$legajo,PDO::PARAM_INT);
		$consulta->execute();

		return $consulta->fetchAll(PDO::FETCH_CLASS('Usuario'));
	}
}

/// test ///
$unUsuario = new Usuario("mario",3,"administrador","123");
$dosUsuario = new Usuario("marito",4,"usuario");
//var_dump($unUsuario);
var_dump($dosUsuario);
echo"<br>";
//var_dump(Usuario::TraerUsuario(1));
?>