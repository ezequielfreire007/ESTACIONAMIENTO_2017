<?php

require_once "AccesoDatos.php";

class Estacionamiento
{
    ###Atributo
    private $_id;
    private $_piso;
    private $_lugar;
    private $_ocupado;
    private $_discapacitado;

    ###Getter y Setter
    public function getId(){
        return $this->_id;
    }

    public function getPiso(){
        return $this->_piso;
    }

    public function getLugar(){
        return $this->_lugar;
    }

    public function getOcupado(){
        return $this->_ocupado;
    }

    public function getDiscapacitado(){
        return $this->_discapacitado;
    }

    public function setId($value){
        $this->_id = $value;
    }

    public function setPiso($value){
        $this->_piso = $value;
    }

    public function setLugar($value){
        $this->_lugar = $value;
    }

    public function setOcupado($value){
        $this->_ocupado= $value;
    }

    public function setDiscapacitado($value){
        $this->_discapacitado = $value;
    }

    ###Constructor
    public function __construct($piso=NULL, $lugar=NULL, $ocupado=NULL, $discapacitado=NULL){
        if($piso!=NULL && $lugar!=NULL && $ocupado!=NULL && $discapacitado!=NULL){
            $this->_piso = $piso;
            $this->_lugar = $lugar;
            $this->_ocupado = $ocupado;
            $this->_discapacitado = $discapacitado;
        }
    }
    ###Metodos de clase
    //TRAER UN PISOS 
    public static function traerPisos(){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta = $objetoAccesoDato->RetornarConsulta("SELECT DISTINCT piso FROM estacionamiento");
		$consulta->execute();

		return $consulta->fetchAll();
        //return $consulta->fetchAll(PDO::FETCH_CLASS,'Usuario');
	}

    //TRAER LUGAR POR PISO
    public static function traerLugar($piso){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta = $objetoAccesoDato->RetornarConsulta("SELECT lugar FROM estacionamiento where piso=:piso");
		$consulta->bindValue(':piso',$piso,PDO::PARAM_INT);
        $consulta->execute();

		return $consulta->fetchAll();
        //return $consulta->fetchAll(PDO::FETCH_CLASS,'Usuario');
	}

    //TRAER todos
    public static function traerTodos(){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta = $objetoAccesoDato->RetornarConsulta("SELECT piso,lugar,ocupado,discapacitado FROM estacionamiento");
        $consulta->execute();

		return $consulta->fetchAll();
        //return $consulta->fetchAll(PDO::FETCH_CLASS,'Usuario');
	}

    ///// MODIFICAR AUTO /////
    public static function modificarOcupado($lugar,$ocupado){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		try{
			$consulta = $objetoAccesoDato->RetornarConsulta("UPDATE estacionamiento SET ocupado=:ocupado WHERE lugar=:lugar");
            $consulta->bindValue(':lugar',$lugar,PDO::PARAM_INT);
			$consulta->bindValue(':ocupado',$ocupado,PDO::PARAM_INT);
			$consulta->execute();
		}catch(Ecxeptrion $e){
			return false;
		}
		return true;		
	}
}
//test
//var_dump(Estacionamiento::traerPisos());
Estacionamiento::modificarOcupado(9,1);
?>