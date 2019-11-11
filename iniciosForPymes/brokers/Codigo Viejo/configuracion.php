<?php 
require('./integrados/conexion/config.php'); 
require('./libreria/xajax/xajax.inc.php'); 
require('./libreria/xajax/xajax_cargar_xajax.php');
require('./libreria/xajax/formulario/configuracion/onload.php');
require('./libreria/xajax/formulario/configuracion/desplegar_departamento.php');
require('./libreria/xajax/formulario/configuracion/desplegar_ciudad.php');
require('./libreria/xajax/formulario/configuracion/funciones.php');

require('./integrados/funciones/cargar_pais.php');
require './integrados/funciones/cargar_informacion_profesional_laboral.php';
require('./integrados/funciones/cargar_tipo_documento.php');
require('./integrados/funciones/funciones_configuracion.php');
session_start(); 
conectar_bd();
$consulta_cod_empresa=mysql_query("SELECT * FROM tbl_usuario WHERE documento = '".$_SESSION['doc']."'");
if ($resultado_cod_empresa=mysql_fetch_array($consulta_cod_empresa)) {
  $consulta_empresa=mysql_query("SELECT * FROM tbl_empresa_trabajo WHERE codigo='".$resultado_cod_empresa['empresa_trabajo']."'");
  if ($resultado_empresa=mysql_fetch_array($consulta_empresa)) {
    $nombre_empresa = $resultado_empresa['nombre'];
    $descripcion_empresa = $resultado_empresa['descripcion'];
    $direccion_empresa = $resultado_empresa['direccion'];
    $tel_empresa = $resultado_empresa['telefono'];
    $cargo_empresa = $resultado_empresa['cargo'];
    $fecha_ingreso_empresa = $resultado_empresa['fecha_ingreso'];
    $ciudad_empresa = $resultado_empresa['ciudad'];
    $actividad_economica=$resultado_empresa['actividad_economica'];
  }else{
    $nombre_empresa = '';
    
  }
}else{
}
$sql_nombre_campos="select COLUMN_NAME from INFORMATION_SCHEMA.COLUMNS where TABLE_NAME = 'tbl_usuario'";
$sql_usuario="SELECT * FROM tbl_usuario WHERE documento = '".$_SESSION['doc']."'";
if (!isset($_SESSION['tmp_usuario_config'])) {
  $consulta_usuario=mysql_query($sql_usuario);
  $resultado_usuario=mysql_fetch_array($consulta_usuario);
}

$datos_conyuge=mysql_query("select * from tbl_conyuge where usuario_relacion = '".$_SESSION['doc']."'");
if ($resultado_datos_conyuge=mysql_fetch_array($datos_conyuge)) {
  $disabled="readonly";
  $nombre_empresa_conyuge=mysql_query("select * from tbl_empresa_trabajo where codigo='".$resultado_datos_conyuge['empresa_trabajo']."'");
  $resultado_empresa_trabajo=mysql_fetch_array($nombre_empresa_conyuge);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="./libreria/theme/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./logo.ico">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Configuracion de la Cuenta
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <link href="./libreria/theme/css/material-kit.css" rel="stylesheet" />
  <link href="./libreria/theme/demo/demo.css" rel="stylesheet" />
  <link href="./estilos/general.css" rel="stylesheet" />
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script> $( function() { $( "#accordion" ).accordion({ heightStyle: "content" }); } ); </script>
</head>

<body class="login-page sidebar-collapse">
  <?php require('./integrados/internas/menu.php'); ?>
  <div class="page-header header-filter" style="background-image: url('./libreria/theme/img/street_city.jpg'); background-size: cover; background-position: top center;">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-9 ml-auto mr-auto">
          <div class="card card-login">
              <div class="card-header card-header-primary text-center">
                <h4 class="card-title">Configuracion de la Cuenta</h4>
                <?php require('./integrados/internas/social_line.php'); ?>
              </div>
              <p class="description text-center">En esta sección podrás modificar y agregar información personal, establecer control de privacidad de acerca de tus datos y de las publicaciones que realices en Brokers</p>
              <div class="card-body">

                <div id="contenedor_info_config_perf_us" class="caja_titulos_a">
                  <a href="<?php echo $url_perf_us_ingr; ?>"><div class="contenedor_mensajes_sis_brks_img"><img src="./imagenes/usuario/<?php echo $_SESSION["imagen_perfil"]; ?>"></div></a>
                  <p id="nombre_configuracion">Bienvenido <?php echo $_SESSION['nombres']; ?></p>
                </div>

              </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <script src="./libreria/theme/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="./libreria/theme/js/core/popper.min.js" type="text/javascript"></script>
  <script src="./libreria/theme/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
  <script src="./libreria/theme/js/plugins/moment.min.js"></script>
  <script src="./libreria/theme/js/plugins/nouislider.min.js" type="text/javascript"></script>
  <script src="./libreria/theme/js/plugins/jquery.sharrre.js" type="text/javascript"></script>
  <script src="./libreria/theme/js/material-kit.js" type="text/javascript"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <?php $xajax->printJavascript('./libreria/xajax/') ?>
    <script type="text/javascript" src="./java/menu.js"></script>
    <script type="text/javascript" src="./java/burbuja_error.js"></script>
    <script type="text/javascript" src="./java/validar_formulario_configuracion.js"></script> 
    <script>
      function abrir_pg(url) {

        var myWindow = window.open(url, "google", "width=750,height=750");
      }
    </script>
</body>

</html>