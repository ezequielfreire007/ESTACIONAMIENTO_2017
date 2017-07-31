<?php

require_once "AccesoDatos.php";

date_default_timezone_set("America/Argentina/Buenos_Aires");

class Fichada
{
    ###Atributos
    private $_legajo;
	private $_ingresoHora;
	private $_salidaHora;
    
    ###Getter y Setter
     public function getLegajo(){
        return $this->_legajo;
    }

     public function getIngreso(){
        return $this->_ingresoHora;
    }

     public function getSalida(){
        return $this->_salidaHora;
    }

    public function setLegajo($value){
        $this->_legajo = $value;
    }

    public function setIngreso($value){
        $this->_ingresoHora = $value;
    }

    public function setSalida($value){
        $this->_salidaHora = $value;
    }

    ###Constructor
    public function __construct($legajo=NULL,$ingreso=NULL, $salida=NULL){
        if($legajo !== NULL && $ingreso !== NULL && $salida !== NULL){
            $this->_legajo = $legajo;
            $this->_ingresoHora = $ingreso;
            $this->_salidaHora = $salida;
        }
    }
    ###Metodos de clase

     ///// INSERTAR FICHADA //////
    public static function ingreso($legajo,$ingreso)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        try{
            $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO fichadas(legajo, ingreso)VALUES(:legajo,:ingreso)");
            $consulta->bindValue(':legajo', $legajo, PDO::PARAM_INT);
            $consulta->bindValue(':ingreso', $ingreso);
            $consulta->execute(); 
        }catch(Ecxeption $e){
            return false;
        }
        return true;   
	}

    ///// MODIFICAR FICHADA /////
    public static function salida($legajo,$salida){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		try{
			$consulta = $objetoAccesoDato->RetornarConsulta("UPDATE fichadas SET salida=:salida WHERE legajo=:legajo");
			//$consulta->bindValue(':id', $auto->getId(), PDO::PARAM_INT);
            $consulta->bindValue(':legajo', $legajo, PDO::PARAM_INT);
            $consulta->bindValue(':salida', $salida);

			$consulta->execute();
		}catch(Ecxeptrion $e){
			return false;
		}
		return true;		
	}

      ///// TRAER TODOS LAS FICHADAS /////
    public static function TraerFichadas()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select legajo,ingreso,salida from fichadas");
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_CLASS, "Fichada");		
	}
}
?>