<?php 

class Control extends Database{

      public function registrarControl($fechaActual, $fechaProxima, $metodoPago, $valorTotal){
            $this -> query("CALL `registroControl`(:fechaActual, :fechaProxima, :metodoPago, :valorTotal, @resp);");
            $this-> bind(":fechaActual", $fechaActual);
            $this->bind(":fechaProxima", $fechaProxima);   
            $this->bind(":metodoPago", $metodoPago);   
            $this->bind(":valorTotal", $valorTotal);  
            $this->execute();
            $this->query("SELECT @resp AS `_resp`;");      
            return $this->single()->_resp;                  
      }

      public function registrarServicioMascotaYControl($numeroControl, $codigoServicio, $idMascota, $idVeterinario){
            $this -> query("CALL `registroServicioMascotaYControl`(:idMascota, :codigoServicio, :idVeterinario, :numeroControl, @resp);");
            $this-> bind(":idMascota", $idMascota);
            $this->bind(":codigoServicio", $codigoServicio);   
            $this->bind(":idVeterinario", $idVeterinario);   
            $this->bind(":numeroControl", $numeroControl);  
            $this->execute();
            $this->query("SELECT @resp AS `_resp`;");      
            return $this->single()->_resp;      
      }


}