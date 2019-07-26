<?php 

class Servicios extends Controller{

    private $servicioModel;

    public function __construct(){
        $this->servicioModel = $this->model("Servicio");
    }
      
      public function anadirServicio(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
                  if ($contentType === "application/json") {
                  
                        $content = trim(file_get_contents("php://input"));
                  
                        $data = json_decode($content, true);
                        

                        if(is_array($data)) {
                           $resp = $this->servicioModel->registrarServicio($data);
                           $respuesta = ["resp" => $resp];
                           echo json_encode($respuesta);
                        }
                  }
            }

      }

      public function servicios(){
           
            if($_SERVER["REQUEST_METHOD"] == "GET"){           
                     
                echo json_encode($this->servicioModel->obtenerServicios());
            }
      }

      public function eliminarServicio($codigo){
            if($_SERVER["REQUEST_METHOD"] == "DELETE"){                              
                
                  $resp =  $this->servicioModel->borrarServicio($codigo);

                  $respuesta = ["resp" => $resp];

                  echo json_encode($respuesta);
              }
      }

}