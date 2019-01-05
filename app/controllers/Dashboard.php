<?php 
      class Dashboard extends Controller{
          private $mascotaModel, $clienteModel;  
          
          public function __construct(){
                if(!isset($_SESSION["empleadoUsuario"])){
                        redirect("");
                }else{   
                    $this->mascotaModel = $this->model("Mascota");
                    $this->clienteModel = $this->model("Cliente");
                }
          }


           public function index(){
               //  die(var_dump($this->mascotaModel->listarRazas()[0]->RAZAMASCOTA));
               $razas = $this->mascotaModel->obtenerRazas();

               $data = ["razas" => $razas];  

               $this->view("dashboard/clientes/inicio", $data);
           }

           public function agregarMascota(){
               $razas = $this->mascotaModel->obtenerRazas();

               $clientes = $this->clienteModel->obtenerClientes();

               $data = ["razas" => $razas,
                         "clientes" => $clientes];  
               $this->view("dashboard/clientes/agregarMascota", $data);
           }

           public function registrarServicio(){
                 $this->view("dashboard/servicios/registrarServicio");  
           }

           public function registrarVeterinario(){
            $this->view("dashboard/controles/registrarVeterinario");  
           }

      }

?>