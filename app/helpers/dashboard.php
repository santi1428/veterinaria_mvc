<?php 

 function listarRazas($data){
     foreach ($data as $raza) {        
           echo '<option value = "'.$raza -> RAZAMASCOTA.'">'.$raza -> RAZAMASCOTA.'</option>';
     }          
}

function listarClientes($data){
      foreach ($data as $cliente) {        
            echo '<option value = "'.$cliente -> ID.'">'.$cliente -> NOMBRE.' - '.$cliente -> TIPODOCUMENTO.' - '.$cliente -> ID.'</option>';
      }   
}