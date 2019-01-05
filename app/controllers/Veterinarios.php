<?php

class Veterinarios extends Controller{
         
       private $veterinarioModel;

       public function __construct(){
           $this->veterinarioModel = $this->model("Veterinario");
       }


       public function registrarVeterinario(){
               
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
                  if ($contentType === "application/json") {
                  
                        $content = trim(file_get_contents("php://input"));
                  
                        $data = json_decode($content, true);
                        

                        if(is_array($data)) {
                           $resp = $this->veterinarioModel->registrarVeterinario($data);
                           $respuesta = ["resp" => $resp];
                           echo json_encode($respuesta);
                        }
                  }
            }
          
       }

}