<?php

require_once "AccesoDatos.php";

date_default_timezone_set("America/Argentina/Buenos_Aires");

class Auto
{
    ### Atributos
    private $_idLugar;
    private $_patente;
    private $_marca;
    private $_color;
    private $_horaIngreso;

    ### Getter y Setter
    public function getIdLugar(){
        return $this->_idLugar;
    }

    public function getMarca(){
        return $this->_marca;
    }

    public function getPatente(){
        return $this->_patente;
    }

    public function getColor(){
        return $this->_color;
    }

    public function getHoraIngreso(){
        return $this->_horaIngreso;
    }

    public function setIdLugar($value){
        $this->_idLugar = $value;
    }

    public function setMarca($value){
        $this->_marca = $value;
    }

    public function setPatente($value){
        $this->_patente = $value;
    }

    public function setColor($value){
        $this->_color = $value;
    }

    public function setHoraIngreso($value){
        $this->_horaIngreso = $value;
    }

    public function __construct($idLugar = NULL,$marca = NULL, $patente = NULL,$color = NULL, $hora=NULL){
        if($idLugar != NULL && $marca != NULL && $patente != NULL && $color != NULL && $hora!=NULL){
            $this->_idLugar = $idLugar;
            $this->_marca = $marca;
            $this->_patente = $patente;
            $this->_color = $color;
            $this->_horaIngreso = $hora;
        }
    }

    ###Metodos de clase
    ///// INSERTAR AUTO //////
    public static function insertarAuto($lugar,$patente,$marca,$color,$hora)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        try{
            $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO autos(lugar, patente, marca, color, hora)VALUES(:lugar,:patente,:marca,:color,:hora)");
            $consulta->bindValue(':lugar', $lugar, PDO::PARAM_INT);
            $consulta->bindValue(':patente', $patente, PDO::PARAM_STR);
            $consulta->bindValue(':marca', $marca, PDO::PARAM_STR);
            $consulta->bindValue(':color', $color, PDO::PARAM_STR);
            $consulta->bindValue(':hora',$hora,PDO::PARAM_STR);
            $consulta->execute(); 
        }catch(Ecxeption $e){
            return false;
        }
        return true;   
	}

    ///// ELIMINAR AUTO /////
    public static function eliminarAuto($patente){

		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		try
		{
			$consulta = $objetoAccesoDato->RetornarConsulta("DELETE FROM autos WHERE patente=:patente");
			$consulta->bindValue(':patente', $patente, PDO::PARAM_STR);
			$consulta->execute();
		}
		catch(Ecxeption $e)
		{
			return false;
		}
		return true;
		
	}
    ///// MODIFICAR AUTO /////
    public static function modificarAuto($auto){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		try{
			$consulta = $objetoAccesoDato->RetornarConsulta("UPDATE autos SET marca=:marca ,color=:color WHERE patente=:patente");
			//$consulta->bindValue(':id', $auto->getId(), PDO::PARAM_INT);
            $consulta->bindValue(':marca',$auto->getMarca(),PDO::PARAM_STR);
			$consulta->bindValue(':patente',$auto->getPatente(),PDO::PARAM_STR);
			$consulta->bindValue(':color',$auto->getColor(),PDO::PARAM_STR);
			$consulta->execute();
		}catch(Ecxeptrion $e){
			return false;
		}
		return true;		
	}

    ///// TRAER TODOS LOS AUTOS /////
    public static function TraerTodosAutos()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select lugar,patente,marca,color,hora from autos");
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_CLASS, "Auto");		
	}

    ///// TRAER UN AUTO /////
    public static function TraerUnAuto($patente)
	{
	    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select lugar,marca,patente,color from autos where patente=:patente");
		$consulta->bindValue(':patente',$patente,PDO::PARAM_STR);
        $consulta->execute();	
        $autoBuscado= $consulta->fetchObject('Auto');		
		return $autoBuscado;	
	}
}
//// test

/*$auto = new Auto();
$auto->setMarca("LOTUS");
$auto->setPatente("HTS 987");
$auto->setColor("VERDE");
$auto->setIdLugar(4);
$auto->setHoraIngreso(time());*/
/*date_default_timezone_set("America/Argentina/Buenos_Aires");
$hora = date("Y-m-d H:i:s");
Auto::insertarAuto(4,"HTS 987","LOTUS","VERDE",$hora);*/

?>