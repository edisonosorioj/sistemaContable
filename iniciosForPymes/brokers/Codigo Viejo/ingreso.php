<?php 
require('./integrados/conexion/config.php'); 
if (isset($_SESSION['doc'])) {redirigir_sesion($_SESSION['doc']);}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="icon" type="image/png" href="./logo.ico">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Ingreso
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <link href="./libreria/theme/css/material-kit.css" rel="stylesheet" />
  <link href="./libreria/theme/demo/demo.css" rel="stylesheet" />
  <link href="./estilos/general.css" rel="stylesheet" />
</head>

<body class="login-page sidebar-collapse">
  <!-- MENU SUPERIROR DE NAVEGACION -->
  <?php require('./integrados/internas/menu.php'); ?>
  <div class="page-header header-filter" style="background-image: url('./libreria/theme/img/profile_city.jpg'); background-size: cover; background-position: top center;">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-6 ml-auto mr-auto">
          <div class="card card-login">
            <form class="form" action="./validando_ingreso" method="POST">
              <div class="card-header card-header-primary text-center">
                <h4 class="card-title">Ingreso</h4>
                <?php require('./integrados/internas/social_line.php'); ?>
              </div>
              <p class="description text-center">Por favor ingrese su información registrada</p>
              <div class="card-body">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">email</i>
                    </span>
                  </div>
                  <input type="email" class="form-control" name="correo_ingresar" placeholder="Correo Electrónico...">
                </div>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">lock_outline</i>
                    </span>
                  </div>
                  <input type="password" class="form-control" name="password_ingresar" placeholder="Contraseña...">
                </div>

                <div id="foot_fomr_ingreso">
                        <div class="pie_pagina_forms">¿Tienes problemas para iniciar sesión?<br><a href="./recuperar">Clic aquí para recuperar su cuenta</a></div>
                        <div class="separador"></div>
                        <div class="pie_pagina_forms">¿No estas registrado?<br><a href="./registro">Regístrate dando clic aquí</a></div>
                    </div>

              </div>
              <div class="footer text-center">
                <input type="submit" class="btn btn-primary btn-link btn-wd btn-lg" name="ingreso_brokers" value="ENTRAR">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

<?php require('./integrados/internas/foot.php'); ?>
  </div>
  <script src="./libreria/theme/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="./libreria/theme/js/core/popper.min.js" type="text/javascript"></script>
  <script src="./libreria/theme/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
  <script src="./libreria/theme/js/plugins/moment.min.js"></script>
  <script src="./libreria/theme/js/plugins/nouislider.min.js" type="text/javascript"></script>
  <script src="./libreria/theme/js/plugins/jquery.sharrre.js" type="text/javascript"></script>
  <script src="./libreria/theme/js/material-kit.js" type="text/javascript"></script>
</body>

</html>