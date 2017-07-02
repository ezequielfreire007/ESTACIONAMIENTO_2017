<?php

require_once "AccesoDatos.php";

class Auto
{
    ### Atributos
    private $_id;
    private $_marca;
    private $_patente;
    private $_color;

    ### Getter y Setter
    public function getId(){
        return $this->_id;
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

    public function setId($value){
        $this->_id = $value;
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

    public function __construct($id = NULL,$marca = NULL, $patente = NULL,$color = NULL){
        if($id != NULL && $marca != NULL && $patente != NULL && $color != NULL){
            $this->_id = $id;
            $this->_marca = $marca;
            $this->_patente = $patente;
            $this->_color = $color;
        }
    }

    ###Metodos de clase
    ///// INSERTAR AUTO //////
    public static function insertarAuto($marca,$patente,$color)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        try{
            $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO auto(marca, patente, color)VALUES(:marca,:patente,:color)");
            $consulta->bindValue(':marca', $marca, PDO::PARAM_STR);
            $consulta->bindValue(':patente', $patente, PDO::PARAM_STR);
            $consulta->bindValue(':color', $color, PDO::PARAM_STR);

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
			$consulta = $objetoAccesoDato->RetornarConsulta("DELETE FROM auto WHERE patente=:patente");
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
			$consulta = $objetoAccesoDato->RetornarConsulta("UPDATE auto SET marca=:marca ,color=:color WHERE patente=:patente");
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
		$consulta =$objetoAccesoDato->RetornarConsulta("select id,marca,patente,color from auto");
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_CLASS, "Auto");		
	}

    ///// TRAER UN AUTO /////
    public static function TraerUnAuto($patente)
	{
	    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select id,marca,patente,color from auto where patente=:patente");
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
Auto::modificarAuto($auto);
*/
?>