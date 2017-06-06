<?php

require_once "AccesoDatos.php";

class Usuario
{
    #Atributos
    private $nombre;
    private $legajo;
    private $tipo;
    private $password;

    #Getter y Setter
    public function getNombre(){
        return $this->nombre;
    }

    public function getLegajo(){
        return $this->legajo;
    }

    public function getTipo(){
        return $this->tipo;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setNombre($value){
        $this->nombre = $value;
    }

    public function setLegajo($value){
        $this->Legajo = $value;
    }

    public function setTipo($value){
        $this->tipo = $value;
    }

    public function setPassword($value){
        $this->password = $value;
    }

    #Constructor
    public function __construct($nombre=NULL,$legajo=NULL, $tipo=NULL, $password=NULL){
        if($nombre !== NULL && $legajo !== NULL && $tipo !== NULL && $password !== NULL){
            $this->nombre = $nombre;
            $this->legajo = $legajo;
            $this->tipo = $tipo;
            $this->password = $password;
        }
    }

    //Metodos de Clase
    public static function TraerUsuario($legajo){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta = $objetoAccesoDato->RetornarConsulta("SELECT nombre, legajo, tipo, password FROM login WHERE legajo=:legajo");
		$consulta->bindValue(':legajo',$legajo,PDO::PARAM_INT);
		$consulta->execute();

		//return $consulta->fetchAll();
        return $consulta->fetchAll(PDO::FETCH_CLASS,'Usuario');
	}
}

/// test ///
$unUsuario = new Usuario("mario",3,"administrador","123");
$dosUsuario = new Usuario("marito",4,"usuario");
//var_dump($unUsuario);
//var_dump($dosUsuario);
echo"<br>";
var_dump(Usuario::TraerUsuario(1));
?>