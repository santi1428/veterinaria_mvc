<?php 

class Controles extends Controller{
    private $controlModel;

    public function __construct(){
          $this->controlModel = $this->model("Control");
    }

    public function registrarControl(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
                  if ($contentType === "application/json") {
                    $content = trim(file_get_contents("php://input"));
                          
                    $data = json_decode($content, true);

                    $numeroControl =$this->controlModel->registrarControl($data["fechaActual"], $data["fechaProxima"], $data["metodoPago"], $data["valorTotal"]);

                     $resp = $this->registrarServicioMascotaYControl($numeroControl, $data["serviciosEnvio"], $data["mascota"]);

                     $respuesta = ["resp" => $resp];
                     
                     echo json_encode($respuesta);
                  }
                }
    }

    public function registrarServicioMascotaYControl($numeroControl, $serviciosEnvio, $idMascota){
       $c = 0;       
        forEach($serviciosEnvio as $servicio => $valor){
            $resp = $this->controlModel->registrarServicioMascotaYControl($numeroControl, $valor["codigoServicio"], $idMascota, $valor["idVeterinario"]);
            if($resp != 1){
              $c++;   
            }  

        }

        return $c;
    }
  



}