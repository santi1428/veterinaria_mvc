<?php 

class Empleado extends Database{
     
     public function registro($data){
             $this->query("CALL `registro`(:usuario, :nombre, :contrasena, @resp);");
             $this->bind(":usuario", $data["usuarioRegistro"]);
             $this->bind(":nombre", $data["nombreRegistro"]);
             $this->bind(":contrasena", $data["contrasenaRegistro"]);
             $this->execute();
             $this->query("SELECT @resp AS `_resp`;");
             return $this->single() -> _resp;
     }

     public function login($data){
         $this -> query("CALL `inicioSesion`(:usuario, :contrasena, @resp);");
         $this-> bind(":usuario", $data["usuarioLogin"]);
         $this->bind(":contrasena", $data["contrasenaLogin"]);   
         $this->execute();
         $this->query("SELECT @resp AS `_resp`;");      
         return $this->single()->_resp;
     }

           



}