<?php  include APPROOT."/views/inc/header.php"; ?>

<title>Pluto</title>
<div class="full-width-1">
  <div class="container">
    <div class="row">
      <div class="jumbotron jumbotron-fluid pb-0 mb-3 full-width-1">
        <div class="col">
           <?php mostrarError($data); ?>
          <div class="row">
            <div class="col-lg-6 col-xl-6">
              <img
                src="<?php echo URLROOT;?>img/inicio/vet-final.png"
                alt=""
                class="img-fluid mt-5 mt-sm-3 imagen-encabezado"
              />
            </div>
            <div class="col-lg-6 col-xl-6">
              <h1 class="display-4 text-center text-lg-left">
                Veterinaria Pluto
              </h1>
              <p class="lead text-justify">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                Delectus, vitae fugit? Vitae illum est ullam minima, fuga
                aliquid nemo illo at? Quidem consequatur eveniet doloribus
                quas laboriosam cupiditate. Consequatur pariatur dicta
                laborum odit sint et dolor est velit, enim
                voluptates!laboriosam cupiditate. Consequatur pariatur
                dicta laborum odit sint et dolor est velit, enim
                voluptates!
              </p>
            </div>
          </div>
          <div class="row">
            <div class="col mb-2">
              <a href="#" class="btn btn-primary btn-block"
                ><i class="far fa-info-circle"></i> Nuestros servicios</a
              >
            </div>
            <div class="col">
              <a href="#" class="btn btn-success btn-block"
                ><i class="fal fa-question-circle"></i> Sobre nosotros</a
              >
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="full-width-2 pt-3">
  <div class="container">
    <div class="row">
      <div class="col text-center mb-3">
        <img src="<?php echo URLROOT;?>img/inicio/1.png" />
        <p class="h5 mt-2">Vacunación</p>
      </div>
      <div class="col text-center mb-3">
        <img src="<?php echo URLROOT;?>img/inicio/2.png" />
        <p class="h5 mt-2">Peluqueria</p>
      </div>
      <div class="col text-center mb-3">
        <img src="<?php echo URLROOT;?>img/inicio/3.png" />
        <p class="h5 mt-2">Consulta Veterinaria</p>
      </div>
      <div class="col text-center mb-3">
        <img src="<?php echo URLROOT;?>img/inicio/4.png" />
        <p class="h5 mt-2">Guarderia</p>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo URLROOT;?>js/validarLogin.js"></script>
<?php include APPROOT."/views/inc/footer.php"; ?>
