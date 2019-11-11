<?php 
require('./integrados/conexion/config.php');
require('./integrados/validar/ingreso.php');
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
  <?php require('./integrados/internas/menu.php'); ?>
  <div class="page-header header-filter" style="background-image: url('./libreria/theme/img/profile_city.jpg'); background-size: cover; background-position: top center;">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-6 ml-auto mr-auto">
          <div class="card card-login">
              <div class="card-header card-header-primary text-center">
                <h4 class="card-title">Validando Ingreso</h4>
                <?php require('./integrados/internas/social_line.php'); ?>
              </div>
              <p class="description text-center"><?php echo $titulo_dpl_estado_cuenta; ?></p>
              <div class="card-body">

                <div class="contenedor_mensajes_sis_brks">
                  <a href="<?php echo $url_perf_us_ingr; ?>"><div class="contenedor_mensajes_sis_brks_img"><img src="<?php echo $img_icon_val_ingr; ?>"></div></a>
                  <div id="cont_inf_us_sesion_ini">
                    <?php if ($_GET['msn'] == 1) { ?>
                      <div class="row">
                        <div class="col-md-2 col-lg-6">
                          <p><strong><span class="text-primary"><?php echo $_SESSION["tipo_documento"]; ?>:</span></strong>&nbsp&nbsp<strong><span class="text-secondary"><?php echo $_SESSION["doc"]; ?></span></strong></p>
                          <p><strong><span class="text-primary">E-mail:</span></strong> <strong><span class="text-secondary"><?php echo $_SESSION["correo"]; ?></span></strong></p>
                        </div>
                        <div class="col-md-2 col-lg-6">
                          <p><strong><span class="text-primary">Cuenta:</span></strong> <strong><span class="text-secondary"><?php echo $_SESSION["rol_nombre"]; ?></span></strong></p>
                        </div>
                      </div>
                    <?php }else{
                      ?><p><?php echo $txt_dpl_estado_cuenta; ?></p><?
                    } ?>
                  </div>
                </div>


              </div>
              <div class="footer text-center">
                <a style="text-decoration: none;" class="btn btn-primary btn-link btn-wd btn-lg" href="<?php echo $url_redirec; ?>"><div class="buttton_enviar">Continuar</div></a>
              </div>
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