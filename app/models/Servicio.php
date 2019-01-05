<?php 

class Servicio extends Database{
       
    public function registrarServicio($data){
            $this -> query("CALL `registroServicio`(:nombre, :valor, @resp);");
            $this-> bind(":nombre", $data["nombre"]);
            $this->bind(":valor", $data["valor"]);   
            $this->execute();
            $this->query("SELECT @resp AS `_resp`;");      
            return $this->single()->_resp;                     
    }

    public function obtenerServicios(){
          $this->query("SELECT * FROM servicio");
          return $this->resultSet();
    }

    
    public function borrarServicio($codigo){
        $this->query("DELETE FROM servicio WHERE codigo=:codigo");
        $this->bind(":codigo", $codigo);
        $this->execute();
        return  $this->rowCount();
}

}