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

function listarServicios($data){
        foreach ($data as $servicio){
            echo '<option value = "'.$servicio -> CODIGO.'">'.$servicio -> TIPO.' - '.$servicio -> VALOR.'$'.'</option>';
        }
}

function listarVeterinarios($data){
       foreach($data as $veterinario){
            echo '<option value = "'.$veterinario -> ID.'">'.$veterinario -> NOMBRE.' - '.$veterinario -> TIPODOCUMENTO.' - '.$veterinario -> ID.'</option>';
       }
}