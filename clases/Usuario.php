<?php

require_once "AccesoDatos.php";

class Usuario
{
    #Atributos
    private $_nombre;
    private $_legajo;
    private $_tipo;
    private $_password

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
    public function __construct($nombre=NULL,$email=NULL, $tipo=NULL, $password=NULL){
        if($nombre !== NULL && $email !== NULL && $tipo !== NULL && $password !== NULL){
            $this->_nombre = $nombre;
            $this->_email = $email;
            $this->_tipo = $tipo;
            $this->_password = $password;
        }else{
            $this->_nombre = $nombre;
            $this->_email = $email;
            $this->_tipo = $tipo;
        }
    }


    //Metodos de Clase
    public static function unUsuario($legajo){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta = $objetoAccesoDato->RetornarConsulta("SELECT nombre, legajo, tipo, password FROM login WHERE legajo=:legajo");
		$consulta->bindValue(':legajo',$codBarra,PDO::PARAM_INT);
		$consulta->execute();

		return $consulta->fetchAll(PDO::FETCH_CLASS('Usuario'));
	}
}

?>