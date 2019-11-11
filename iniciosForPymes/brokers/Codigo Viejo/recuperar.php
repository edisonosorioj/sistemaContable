<?php 
require('./integrados/conexion/config.php');
require('./integrados/consultas.php');
require('./integrados/actualizaciones.php');
session_start(); 
if (isset($_SESSION['doc'])) {redirigir_sesion($_SESSION['doc']);}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="./libreria/theme/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./logo.ico">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Recuperar cuenta
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
  <div class="page-header header-filter" style="background-image: url('./libreria/theme/img/city.jpg'); background-size: cover; background-position: top center;">
    <div class="container">
      <div class="row">
        <div class="col-lg-10 col-md-10 ml-auto mr-auto">
          <div class="card card-login">
            <div class="card-header card-header-primary text-center">
              <h4 class="card-title">Recuperar cuenta</h4>
              <?php require('./integrados/internas/social_line.php'); ?>
            </div>
            <p class="description text-center">Por favor seleccione la opción que mejor se adapte a tu requerimiento </p>
            <div class="card-body">

              <?php 
              if (isset($_GET['activacion']) && isset($_GET['usuario'])) {
                ?>
                <div id='cambiar_clave' class="block col-md-12 col-lg-12" data-move-y="400px" data-move-x="-200px">
                    <div class="card card-nav-tabs">
	                    <div class="card-header card-header-primary">
	                        <div class="nav-tabs-navigation">
		                        <div class="nav-tabs-wrapper">
		                            <ul class="nav nav-tabs" data-tabs="tabs">
			                            <li class="nav-item">
			                                <a class="nav-link active" href="#codigo_activacion" data-toggle="tab">
			                                	<i class="material-icons">fiber_pin</i> Activación de la cuenta
			                                </a>
			                            </li>
		                            </ul>
		                        </div>
	                        </div>
	                    </div>

                    	<div class="card-body ">
                      		<div class="tab-content text-center">
				                <?
				                conectar();
				                if (Consulta::Codigo_Activacion_Cuenta($mysqli, $_GET['usuario'], $_GET['activacion']) !== false) {
				                  if (Consulta::Estado_Cuenta($mysqli, 'documento', $_GET['usuario']) == true) {
				                    if (Actualizar::Estado_Cuenta_Activo($mysqli,$_GET['usuario']) == true) {
				                      ?>
				                        <div class="tab-pane active" id="codigo_activacion">
				                          <img class="img_activacion_cuenta" src="./imagenes/iconos/mano_estrella.png"/>
				                          <p>Su cuenta fue activada correctamente</p>
				                        </div>
				                      <?
				                    }else{
				                      ?>
				                        <div class="tab-pane active" id="codigo_activacion">
				                          <img class="img_activacion_cuenta" src="./imagenes/iconos/mano_estrella.png"/>
				                          <p>Hubo un problema al actualizar el estado de su cuenta!</p>
				                        </div>
				                      <?
				                    }
				                  }else{
				                    ?>
				                      <div class="tab-pane active" id="codigo_activacion">
				                        <img class="img_activacion_cuenta" src="./imagenes/iconos/mano_estrella.png"/>
				                        <p>Su cuenta ya se encuentra activa!</p>
				                      </div>
				                    <?
				                  }
				                }else{
				                  echo "<script>alert('el codigo de activación es viejo ó ya fue usado, intente nuevamente!');</script>";echo "<script>window.location.href = '".$dominio."recuperar';</script>";
				                }
				                desconectar();

				                ?>
                       			<a href="./ingreso" class="btn btn-primary btn-link btn-wd btn-lg" >Continuar</a>
                      		</div>
                    	</div>
                    </div>
                </div>
                <?
              }elseif (isset($_GET['codigo']) && isset($_GET['doc'])) {
                conectar();
              	if (Consulta::Codigo_Activacion_Cuenta($mysqli, $_GET['doc'], $_GET['codigo']) == true) {
                desconectar();
              		?>
              		<div id='cambiar_clave' class="block col-md-12 col-lg-12" data-move-y="400px" data-move-x="-200px">
                          <div class="card card-nav-tabs">
                            <div class="card-header card-header-primary">
                              <div class="nav-tabs-navigation">
                                <div class="nav-tabs-wrapper">
                                  <ul class="nav nav-tabs" data-tabs="tabs">
                                    <li class="nav-item">
                                      <a class="nav-link active" href="#codigo_activacion" data-toggle="tab">
                                        <i class="material-icons">fiber_pin</i> Cambiar Contraseña
                                      </a>
                                    </li>
                                  </ul>
                                </div>
                              </div>
                            </div>

                            <div class="card-body ">
                              <div class="tab-content text-center">

                                <div class="tab-pane active" id="codigo_activacion">
                                  <form method="POST" action='./integrados/validar/cambio_clave'>
                                    <div class="row">

                                      <div class="block col-md-6 col-lg-6" data-move-y="400px" data-move-x="-200px">
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text">
                                              <i class="material-icons">lock</i>
                                            </span>
                                          </div>
                                          <input type="hidden" name="doc" value="<?php conectar(); echo Consulta::Informacion_Usuario($mysqli, 'documento', 'codigo_activacion', $_GET['codigo']); desconectar(); ?>">
                                          <input type="hidden" name="codigo" value="<?php echo $_GET['codigo']; ?>">
                                          <input id="cambiar_pass" class="form-control" type="password" name="password_uno" placeholder="Escriba aquí su nueva contraseña" required>
                                        </div>
                                      </div>

                                      <div class="block col-md-6 col-lg-6" data-move-y="400px" data-move-x="-200px">
                                       <div class="input-group">
                                        <input id="cambiar_pass_conf" class="form-control" type="password" name="password_dos" placeholder="Confirme aquí su nueva contraseña" required>
                                      </div>
                                    </div>

                                  </div>

                                  <input type="submit" class="btn btn-primary btn-link btn-wd btn-lg" name="form_cambio_contrasena" value="Cambiar contraseña">
                                </form>
                              </div>

                            </div>
                          </div>
                        </div>
                      </div>
              		<?
              	}else{
              		?>
                        <div id='cambiar_clave' class="block col-md-12 col-lg-12" data-move-y="400px" data-move-x="-200px">
                          <div class="card card-nav-tabs">
                            <div class="card-header card-header-primary">
                              <div class="nav-tabs-navigation">
                                <div class="nav-tabs-wrapper">
                                  <ul class="nav nav-tabs" data-tabs="tabs">
                                    <li class="nav-item">
                                      <a class="nav-link active" href="#codigo_activacion" data-toggle="tab">
                                        <i class="material-icons">fiber_pin</i> Cambiar Contraseña
                                      </a>
                                    </li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                            <div class="card-body ">
                              <div class="tab-content text-center">
                                <div class="tab-pane active" id="codigo_activacion">
                                  <p>Este código de validación ya fue usado, intente nuevamente, si el problema persiste, envie un mensaje de <a href="./contacto">Contacto</a> con su problema.</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    <?
              	}
              }else{
                ?>
                <div id='menu_recuperar_cuenta_us' class="block col-md-12 col-lg-12" data-move-y="400px" data-move-x="-200px">

                  <div class="card card-nav-tabs">
                    <div class="card-header card-header-primary">
                      <div class="nav-tabs-navigation">
                        <div class="nav-tabs-wrapper">
                          <ul class="nav nav-tabs" data-tabs="tabs">
                            <li class="nav-item">
                              <a class="nav-link active" href="#codigo_activacion" data-toggle="tab">
                                <i class="material-icons">fiber_pin</i> Activar Cuenta
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="#informacion_cuenta" data-toggle="tab">
                                <i class="material-icons">contact_mail</i> Recuperar Contraseña
                              </a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>

                    <div class="card-body ">
                      <div class="tab-content text-center">
                        <div class="tab-pane active" id="codigo_activacion">
                          <form method="POST" action='./integrados/validar/activar_cuenta'>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="material-icons">email</i>
                                </span>
                              </div>
                              <input id="titulo_contacto" class="form-control" type="email" name="correo" placeholder="Escriba aquí su correo electrónico registrado" required>
                            </div>
                            <input type="submit" class="btn btn-primary btn-link btn-wd btn-lg" name="form_activacion" value="Enviar codigo Activación">
                          </form>
                        </div>
                        <div class="tab-pane" id="informacion_cuenta">
                          <form method="POST" action='./integrados/validar/recuperar_cuenta'>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="material-icons">email</i>
                                </span>
                              </div>
                              <input id="titulo_contacto" class="form-control" type="email" name="correo_recov" placeholder="Escriba aquí su correo electrónico registrado" required>
                            </div>
                            <input type="submit" class="btn btn-primary btn-link btn-wd btn-lg" name="form_recuperacion" value="Enviar Información">
                          </form>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                </div>
                <?
              }

            ?>

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