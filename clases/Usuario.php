<?php

class Usuario
{
    #Atributos
    private $_nombre;
    private $email;
    private $_tipo;
    private $_password

    #Getter y Setter
    public function getNombre(){
        return $this->_nombre;
    }

    public function getEmail(){
        return $this->email;
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

    public function setEmail($value){
        $this->_email = $value;
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
}

?>