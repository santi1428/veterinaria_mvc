<?php 

class Veterinario extends Database{
      
      
     public function registrarVeterinario($data){
           
            $this -> query("CALL `registroVeterinario`(:id, :nombre, :tipoDocumento, @resp);");
            $this-> bind(":id", $data["id"]);
            $this->bind(":nombre", $data["nombre"]);   
            $this->bind(":tipoDocumento", $data["tipoDocumento"]);   
            $this->execute();
            $this->query("SELECT @resp AS `_resp`;");      
            return $this->single()->_resp;                     
     
     }

     public function obtenerVeterinarios(){
        $this->query("SELECT * FROM veterinario");
        return $this->resultSet();
     }

     public function borrarVeterinario($id){       
          $this->query("DELETE FROM veterinario WHERE ID = :id");
          $this->bind(":id", $id);
          $this->execute();
          return $this->rowCount();
     }


}