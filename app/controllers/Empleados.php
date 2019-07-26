<?php   


class Empleados extends Controller{
      
   private $empleadoModel;  

   public function __construct(){   
         if(isset($_SESSION["empleadoUsuario"])){
               redirect("dashboard");
         }else{
            $this->empleadoModel = $this->model("Empleado");   
         }   
   }


   public function index(){
       $data = [
            "usuarioRegistro" => "",
            "nombreRegistro" =>"",
            "contrasenaRegistro" =>"",
            "concontrasenaRegistro" => "",
            "errorUsuario" => "border-primary",
            "errorUsuarioMensaje" => "",
            "errorInicioSesion" => ""
       ];
          $_SESSION["currentInclude"] = "empleados/registro";
         
          $this->view("empleados/registro", $data);     


   }

   //Registro de empleado
   public function registro(){
        
           if($_SERVER["REQUEST_METHOD"] == "POST"){
                 $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                  "usuarioRegistro" => trim($_POST["usuarioRegistro"]),
                  "nombreRegistro" => trim($_POST["nombreRegistro"]),
                  "contrasenaRegistro" => trim($_POST["contrasenaRegistro"]),
                  "concontrasenaRegistro" => trim($_POST["concontrasenaRegistro"]),
                  "errorUsuario" => "is-invalid",
                  "errorUsuarioMensaje" => "Este usuario ya existe",
                  "errorInicioSesion" => ""
            ];
             
            if($data["usuarioRegistro"]!="" && $data["nombreRegistro"]!="" && $data["contrasenaRegistro"]!="" && $data["concontrasenaRegistro"]!=""){
                  if($data["contrasenaRegistro"] == $data["concontrasenaRegistro"]){
                     $resp =  $this->empleadoModel->registro($data);
                     if($resp == 1){
                           die("Usuario registrado con éxito");
                     }else if($resp == 2){
                           die("ocurrio un error durante el registro");
                     }else{
                           $_SESSION["currentInclude"] = "empleados/registro";
                           $this->view("empleados/registro", $data);
                     }
                  }
            }else{
                  die("ocurrio un error durante el registro");
            }
        

           }
        
   }

   public function login(){
         if($_SERVER["REQUEST_METHOD"]=="POST"){
               $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
               
               $data = ["usuarioLogin" => trim($_POST["usuarioLogin"]),
                        "contrasenaLogin" => trim($_POST["contrasenaLogin"])];

                if($data["usuarioLogin"]!="" && $data["contrasenaLogin"]){
                      $resp = $this->empleadoModel -> login($data);
                      if($resp == 1){
                             $this-> createUserSession($data);
                      }else{
                        $data = [
                              "usuarioRegistro" => "",
                              "nombreRegistro" =>"",
                              "contrasenaRegistro" =>"",
                              "concontrasenaRegistro" => "",
                              "errorUsuario" => "border-primary",
                              "errorUsuarioMensaje" => "",
                              "errorInicioSesion" => "<strong>Datos erróneos.</strong> Si no tienes cuenta, puedes registrarte."
                         ];
                            $this->view($_SESSION["currentInclude"], $data);
                      }
                }        

         }

   }
 
   public function createUserSession($user){
      $_SESSION['empleadoUsuario'] = $user["usuarioLogin"];
      redirect('dashboard');
    }

    public function logout(){
      unset($_SESSION['empleadoUsuario']);
      session_destroy();
      redirect('');
    }



}
