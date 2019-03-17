<?php

class Mascota extends Database{
         
    public function obtenerRazas(){
           $this -> query("SELECT RAZAMASCOTA FROM tipomascota");         
           return $this->resultSet();
    }

    public function obtenerMascotas($id){
           $this->query("SELECT ID, EDAD, RAZA, NOMBRE FROM mascota WHERE IDCLIENTE = :id");
           $this->bind(":id", $id);
           return $this->resultSet();
    }

    public function borrarMascota($id){
             $this->query("DELETE FROM mascota WHERE id=:id");
             $this->bind(":id", $id);
             $this->execute();
             return  $this->rowCount();
    }

    
    public function obtenerTotalMascotas(){ 
       $this->query("SELECT COUNT(M.ID) AS 'NUMEROTOTALMASCOTAS' FROM mascota M");
       return $this->single();
 }


       

}