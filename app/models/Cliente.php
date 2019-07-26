<?php 

class Cliente extends Database{
           
       public function registrarCliente($data){
                    $this -> query("CALL `registroCliente`(:id, :nombre, :tipodocumento, @resp);");
                    $this-> bind(":id", $data[2]);
                    $this->bind(":tipodocumento", $data[1]);   
                    $this->bind(":nombre", $data[0]);   
                    $this->execute();
                    $this->query("SELECT @resp AS `_resp`;");      
                    return $this->single()->_resp;
       }

       public function registrarMascota($id, $data){
                    $this -> query("CALL `registroMascota`(:edad, :raza, :nombre, :id, @resp);");
                    $this-> bind(":edad", $data["edad"]);
                    $this->bind(":raza", $data["raza"]);   
                    $this->bind(":nombre", $data["nombre"]);  
                    $this->bind(":id", $id);   
                    $this->execute();
                    $this->query("SELECT @resp AS `_resp`;");      
                    return $this->single()->_resp;
       }

       public function registrarDireccion($id, $data){
                if(isset($data["direccion"]) || isset($data["ciudad"])){
                    $this -> query("CALL `registroDireccion`(:id, :direccion, :ciudad, @resp);");
                    $this-> bind(":id", $id);
                    if(isset($data["direccion"])){
                        $this->bind(":direccion", $data["direccion"]);  
                    }else{
                        $this->bind(":direccion", "NULL");
                    }
                    
                    if(isset($data["ciudad"])){
                        $this->bind(":ciudad", $data["ciudad"]);   
                    }else{
                        $this->bind(":ciudad", "NULL");   
                    }
                    $this->execute();
                    $this->query("SELECT @resp AS `_resp`;");      
                    return $this->single()->_resp;
                }else{
                    return 1;
                }
      }
      
      public function registrarTelefono($id, $data){
                if(isset($data["telefono"])){
                    $this -> query("CALL `registroTelefono`(:id, :telefono, @resp);");
                    $this-> bind(":id", $id);
                    if(isset($data["telefono"])){
                        $this->bind(":telefono", $data["telefono"]);   
                    }else{
                        $this->bind(":telefono", "NULL");  
                    }
                    $this->execute();
                    $this->query("SELECT @resp AS `_resp`;");      
                    return $this->single()->_resp;
                }else{
                    return 1;
                }
      }

      public function obtenerClientes(){
              $this->query("SELECT * FROM cliente");
             return $this->resultSet();
      }

      public function obtenerClientesConMascotas(){
        $this->query("SELECT C.ID, C.NOMBRE, C.TIPODOCUMENTO, COUNT(M.IDCLIENTE) AS `NUMEROMASCOTAS` FROM cliente C INNER JOIN mascota M on M.IDCLIENTE = C.ID GROUP BY (C.ID)");
       return $this->resultSet();
}

} 