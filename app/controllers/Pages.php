<?php 

class Pages extends Controller{
      
        public function index(){
        
            $_SESSION["currentInclude"] = "pages/inicio";
            
            $data = ["errorInicioSesion" => ""];
            $this->view("pages/inicio", $data);    

            
        
        }

}