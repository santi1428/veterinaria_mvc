<?php
      
      class Clientes extends Controller{
         private $clienteModel, $mascotaModel;
            
         public function __construct(){
            $this->clienteModel = $this->model("Cliente");
            $this->mascotaModel = $this->model("Mascota");
         }


          public function ingresarCliente(){
                  if($_SERVER["REQUEST_METHOD"] == "POST"){
                  $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
                        if ($contentType === "application/json") {
                        
                              $content = trim(file_get_contents("php://input"));
                        
                              $data = json_decode($content, true);
                              
                              $respuesta = ["msg" => "",
                                    "resp" => 0];
                              if(is_array($data)) {
                              $resp =  $this->clienteModel->registrarCliente($data["cliente"]);
                              if($resp == 1){      
                              if($this->registrar($data["cliente"][2], $data["mascotas"], "registrarMascota")==0){
                                    $respuesta["msg"] = "Registro de mascotas exitoso";
                                          if($this->registrar($data["cliente"][2], $data["datosAdicionales"], "registrarDireccion")==0){
                                                $respuesta["msg"] = "Registro de direcciones exitoso";
                                                if($this->registrar($data["cliente"][2], $data["datosAdicionales"], "registrarTelefono")==0){
                                                      $respuesta["msg"] = "Todos los datos se han registrado con éxito";
                                                      $respuesta["resp"] = 1;
                                                }
                                          }else{
                                          $respuesta["msg"] = "Ha ocurrido un error al registrar las direcciones"; 
                                          }
                              }else{
                                    $respuesta["msg"] = "Ha ocurrido un error al registrar las mascotas";     
                              }
                              }else if($resp == 0){
                                    $respuesta["msg"] = "El cliente ya existe en la base de datos";
                              }else{
                                    $respuesta["msg"] = "Ocurrio un error en el registro";
                              }
                                    
                              } else {
                                    $respuesta["msg"] = "Error al recibir los datos"; 
                              }
                              echo json_encode($respuesta);
                        }
                  }
            }
            
            public function registrar($id, $data, $method){
                  $contador = 0;
                  if(isset($data)){
                   foreach ($data as $item) {
                           if($this->clienteModel->$method($id, $item)!=1){
                                  $contador = $contador + 1;
                           }
                   } 
                  }
                   return $contador;
            }

            public function mascotas($id){
                  if($_SERVER["REQUEST_METHOD"] == "GET"){    
                  echo json_encode($this->mascotaModel->obtenerMascotas($id));
                  }else if ($_SERVER["REQUEST_METHOD"] == "DELETE"){       
                        $respuesta =  $this->mascotaModel -> borrarMascota($id);
                        $resp = ["resp" => $respuesta];
                        echo json_encode($resp);
                  }

            }

            public function anadirMascota(){
                  if($_SERVER["REQUEST_METHOD"] == "POST"){
                        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
                              if ($contentType === "application/json") {
                              
                                    $content = trim(file_get_contents("php://input"));
                              
                                    $data = json_decode($content, true);
                                    
                                    $respuesta = ["msg" => "",
                                          "resp" => 0];
                                    if(is_array($data)) {
                                        $respuesta = $this->clienteModel->registrarMascota($data["clienteId"], $data);
                                        $resp = ["resp" => $respuesta]; 
                                        echo json_encode($resp);
                                    }
                              }
                        }
            }
          
               

      } 


?>