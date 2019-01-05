<?php 
    
    function mostrarError($data){
    if($data["errorInicioSesion"]!=""){
          echo ' <div class="col-12 mt-0">
          <div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
          <i class="far fa-exclamation-triangle"></i> '.$data["errorInicioSesion"].' <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
             </button>
           </div>
        </div>';
    }
}
    