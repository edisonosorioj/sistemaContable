<?php 
require('./integrados/conexion/config.php'); 
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="./libreria/theme/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./logo.ico">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Contacto
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <link href="./libreria/theme/css/material-kit.css" rel="stylesheet" />
  <link href="./libreria/theme/demo/demo.css" rel="stylesheet" />
  <link href="./estilos/general.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
</head>

<body class="login-page sidebar-collapse">
  <?php require('./integrados/internas/menu.php'); ?>
  <div class="header-filter" style=" background-image: url('./libreria/theme/img/city.jpg'); background-size: cover; background-position: top center;position: fixed;top: 0px;left: 0px;height: 100%;width: 100%;"></div>
  <div style="height: auto;" class="page-header header-filter">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-9 ml-auto mr-auto">
          <div id="formulario_contacto_us" class="card card-login">
            <form id="formulario_de_contacto" action="./integrados/validar/formulario_contacto" class="style_forms sombra_caja" autocomplete="off" method="post">
              <div class="card-header card-header-primary text-center">
                <h4 class="card-title">Formulario de Contacto</h4>
                <?php require('./integrados/internas/social_line.php'); ?>
              </div>
              <p class="description text-center">Formulario de contacto Brokers</p>
              <div style="margin-bottom: 70px;" class="card-body">
                
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">title</i>
                    </span>
                  </div>
                  <input id="titulo_contacto" class="form-control" type="text" name="text-titulo" placeholder="Escriba aquí el titulo del mensaje" spellcheck="true" required>
                </div>
                <div id="cont_error_titulo_contact_us" class="left_burbuja_error_der burbuja_alerta"></div>

                <div class="form-row">

                  <div class="form-group col-md-6">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="material-icons">person</i>
                        </span>
                      </div>
                      <input id="nombres_us" type="text" class="form-control" name="text-nombre" placeholder="Ingrese aquí sus Nombres" required>
                    </div>
                  </div>

                  <div class="form-group col-md-6">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="material-icons">person</i>
                        </span>
                      </div>
                      <input id="apellidos_us" type="text" class="form-control" name="text-apellido" placeholder="Ingrese aquí sus Apellidos" required>
                    </div>
                  </div>

                </div>
                <div id="cont_error_nombre_contact_us" class="burbuja_alerta left_burbuja_error_izq"></div>
                <div id="cont_error_apellido_contact_us" class="burbuja_alerta left_burbuja_error_der"></div>

                <div class="form-row">

                  <div class="form-group col-md-6">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="material-icons">email</i>
                        </span>
                      </div>
                      <input id="correo_contac" type="email" name="correo" class="form-control" required placeholder="Ingrese aquí su correo electrónico">
                    </div>
                  </div>

                  <div class="form-group col-md-6">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="material-icons">phone</i>
                        </span>
                      </div>
                      <input id="tel_contacto" type="number" class="form-control" name="tel_contacto" placeholder="Ingrese aquí un teléfono de contacto">
                    </div>
                  </div>

                </div>
                <div id="cont_error_email_contact_us" class="burbuja_alerta left_burbuja_error_izq"></div>

                <div class="input-group">
                  <div class="correcion_input_forms">
                      <label for="summernotee">Mensaje</label>
                      <textarea id="summernote" class="form-control" name="texto-comentario" spellcheck="true"></textarea>
                  </div>
                </div>
                <div id="cont_error_mensaje_contact_us" class="burbuja_alerta left_burbuja_error_der"></div>

                <div class="pie_pagina_forms">Al utilizar este formulario de contacto está aceptando nuestros <a href="#">términos y condiciones</a></div>

              </div>

              <div class="footer text-center">
                <input type="submit" name="form_contactenos" value="Enviar Mensaje" class="btn btn-primary btn-link btn-wd btn-lg">
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>

<div id="altura_ventana"></div>
<a style="text-decoration: none;" href="javascript:void(0)" onclick="desplazar_pagina_arriba()"><div id="button_up_pag"><img src="<?php echo $dominio; ?>imagenes/iconos/page_up.png"></div></a>

  </div>
  <script src="./libreria/theme/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="./libreria/theme/js/core/popper.min.js" type="text/javascript"></script>
  <script src="./libreria/theme/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
  <script src="./libreria/theme/js/plugins/moment.min.js"></script>
  <script src="./libreria/theme/js/plugins/nouislider.min.js" type="text/javascript"></script>
  <script src="./libreria/theme/js/plugins/jquery.sharrre.js" type="text/javascript"></script>
  <script src="./libreria/theme/js/material-kit.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
  <script type="text/javascript" src="./java/summernote.js"></script>
  <script type="text/javascript" src="./java/burbuja_error.js"></script>
  <script type="text/javascript" src="./java/validar_formulario_contacto.js"></script>
</body>

</html>