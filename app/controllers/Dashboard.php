<?php 
      class Dashboard extends Controller{
          private $mascotaModel, $clienteModel, $servicioModel, $veterinarioModel;  
          
          public function __construct(){
                if(!isset($_SESSION["empleadoUsuario"])){
                        redirect("");
                }else{   
                    $this->mascotaModel = $this->model("Mascota");
                    $this->clienteModel = $this->model("Cliente");
                    $this->servicioModel = $this->model("Servicio");
                    $this->veterinarioModel = $this->model("Veterinario");
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

           public function registrarControl(){
                $clientes = $this->clienteModel->obtenerClientes();
                $servicios = $this->servicioModel->obtenerServicios();
                $veterinarios = $this->veterinarioModel->obtenerVeterinarios();
                
                $data = ["clientes" => $clientes,
                         "servicios" => $servicios,
                        "veterinarios" => $veterinarios];
                $this->view("dashboard/controles/registrarControl", $data);

           }
               
           public function clientes(){
                $this->view("dashboard/clientes/modificarCliente");
           }

      }

?>