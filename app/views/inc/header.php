<!DOCTYPE html>
<html lang="es">
  <!--
    NO MODIFICAR EL HEAD, YA QUE ASÍ LO PIDE BOOTSTRAP PARA QUE FUNCIONEN CORRECTAMENTE LOS ESTILOS
  -->
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="<?php echo URLROOT;?>css/fontawesome.css" />
    <link rel="stylesheet" href="<?php echo URLROOT;?>css/style.css" />
  </head>
  <body>
    <!--
      ENCABEZADO DE LA PÁGINA, AQUI SE ENCUENTRA EL FORMULARIO DE INICIO DE SESIÓN
    -->

    <header>
        <?php include APPROOT."/views/inc/navbar.php"; ?>
    </header>

<!-- CONTENIDO DE LA PÁGINA -->

<section>
