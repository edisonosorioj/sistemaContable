<?php 

require('./integrados/conexion/config.php'); 
require('./integrados/cargar_funciones.php');

// echo $_SESSION['temClie']['nombres'];
// echo $_SESSION['temClie']['apellidos'];
// echo  $_SESSION['temClie']['clave'];
// echo  $_SESSION['temClie']['correo'];
// echo $_SESSION['temClie']['conf_correo'];
// echo $_SESSION['temClie']['fecha_nacimiento'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="icon" type="image/png" href="./logo.ico">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Registro
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <link href="./libreria/theme/css/material-kit.css" rel="stylesheet" />
  <link href="./libreria/theme/demo/demo.css" rel="stylesheet" />
  <link href="./estilos/general.css" rel="stylesheet" />
  <link rel="stylesheet" href="./estilos/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

  <script> $( function() { $( "#accordion" ).accordion({ heightStyle: "content" }); } ); </script>
</head>

<body class="login-page sidebar-collapse">
  <?php require('./integrados/internas/menu.php'); ?>
  <div class="header-filter" style=" background-image: url('./libreria/theme/img/city.jpg'); background-size: cover; background-position: top center;position: fixed;top: 0px;left: 0px;height: 100%;width: 100%;"></div>
  <div style="height: auto;" class="page-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-10 col-md-10 ml-auto mr-auto">
          <div id="contenedor_form_registro" class="card card-login">
            <form id="formulario_registro_usuario" class="style_forms sombra_caja" action="./integrados/registro/usuario.php" method="post" autocomplete="off">
              <div class="card-header card-header-primary text-center">
                <h4 class="card-title">Formulario de Registro</h4>
                <?php require('./integrados/internas/social_line.php'); ?>
              </div>
              <p class="description text-center">Por favor ingrese su información registrada</p>
              <div class="card-body">

                <div id="accordion">
                  <h3>Documento</h3>
                  <div>
                    <div class="form-row">
                      
                      <div class="form-group col-md-6">
                        <div class="input-group">
                          <div id="icon_tipo_doc_reg" class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="material-icons">contacts</i>
                            </span>
                          </div>
                          <select id="tipo_documento" onchange="ocultar_burbujas()" name="tipo_documento" class="form-control">
                            <option value="0" selected>Seleccione tipo documento</option>
                            <?php conectar(); echo Cargar::Tipo_Documento($mysqli); desconectar(); ?>
                          </select>
                        </div>
                      </div>

                      <div class="form-group col-md-6">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="material-icons">face</i>
                            </span>
                          </div>
                          <input id="documento_us" type="number" class="form-control" name="text-doc"  pattern="[0-9]*{15}" maxlength="15" minlength="7" min="0000000" max="999999999999999" placeholder="Ingrese aquí su documento de identidad" title="Solo se puede llenar con numeros" onkeypress="ocultar_burbujas()" value="<?php echo $_SESSION['temClie']['documento']; ?>">
                        </div>
                      </div>

                    </div>              
                    <div id="cont_error_tipo_doc_reg_us" class="burbuja_alerta left_burbuja_error_izq"></div>
                    <div id="cont_error_documento_reg_us" class="burbuja_alerta left_burbuja_error_der"></div>

                    <div class="form-row">

                      <div class="form-group col-md-6">
                        <div class="input-group">
                          <div class="input-group-prepend reset_display_icon">
                            <span class="input-group-text">
                              <i class="material-icons">date_range</i>
                            </span>
                          </div>
                          <div class="form-group reset_display">
                            <label for="fecha_expedicion_doc">Fecha expedición</label>
                            <input id="fecha_expedicion_doc" type="date" class="form-control" name="fecha_expedicion_doc" onkeypress="ocultar_burbujas()" onclick="ocultar_burbujas()" value="<?php echo $_SESSION['temClie']['fecha_expedicion_doc']; ?>">
                          </div>
                        </div>
                      </div>

                      <div class="form-group col-md-6">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span id="icon_pais_reg" class="input-group-text">
                              <i class="material-icons">public</i>
                            </span>
                          </div>
                          <select id="pais_expedicion_cargar_departamento" name="pais_us_doc" class="form-control" onchange='cargar_expedicion_departamento(); ocultar_burbujas()'>
                           <option value="0" selected>Seleccione país de expedición</option>
                            <?php conectar(); echo Cargar::Pais($mysqli); desconectar(); ?>
                          </select>
                        </div>
                      </div>

                    </div>
                    <div id="cont_error_fecha_expedicion_doc_reg_us" class="burbuja_alerta left_burbuja_error_izq"></div>
                    <div id="cont_error_pais_expedicion_doc_reg_us" class="burbuja_alerta left_burbuja_error_der"></div>

                    <div class="form-row">
                      
                      <div class="form-group col-md-6">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="material-icons">business</i>
                            </span>
                          </div>
                          <select id='departamento_expedicion_cargar_ciudad' name="departamento_us_doc" class="form-control" onchange='cargar_expedicion_ciudades(); ocultar_burbujas()' disabled>
                           <option value="0" selected>Seleccione el departamento de expedición</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group col-md-6">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="material-icons">home</i>
                            </span>
                          </div>
                          <select id='cargar_expedicion_ciudad' name="ciudad_us_doc" class="form-control" onchange="ocultar_burbujas()" value="<?php echo  $_SESSION['temClie']['ciudad_us_doc']; ?>" disabled>
                           <option value="0" selected>Seleccione la ciudad de expedición</option>
                          </select>
                        </div>
                      </div> 

                    </div>
                    <div id="cont_error_departamento_expedicion_doc_reg_us" class="burbuja_alerta left_burbuja_error_izq"></div>
                    <div id="cont_error_ciudad_expedicion_doc_reg_us" class="burbuja_alerta left_burbuja_error_der"></div>
                  </div>
                  <h3>Información personal</h3>
                  <div>
                    <div class="form-row">
                      
                      <div class="form-group col-md-6">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="material-icons">person</i>
                            </span>
                          </div>
                          <input id="nombres_us" type="text" class="form-control" name="text-nombre" onkeypress="ocultar_burbujas()" placeholder="Ingrese aquí sus Nombres" spellcheck="true" value="<?php if (isset($_SESSION['temClie']['nombres'])) {echo $_SESSION['temClie']['nombres'];}else{echo "";}?>">
                        </div>
                      </div>

                      <div class="form-group col-md-6">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="material-icons">create</i>
                            </span>
                          </div>
                          <input id="apellidos_us" type="text" class="form-control" name="text-apellido" onkeypress="ocultar_burbujas()" placeholder="Ingrese aquí sus Apellidos" spellcheck="true" value="<?php if (isset($_SESSION['temClie']['apellidos'])) {echo $_SESSION['temClie']['apellidos'];}else{echo "";}?>">
                        </div>
                      </div> 

                    </div>
                    <div id="cont_error_nombre_reg_us" class="burbuja_alerta left_burbuja_error_izq"></div>
                    <div id="cont_error_apellido_reg_us" class="burbuja_alerta left_burbuja_error_der"></div>

                    <div class="form-row">
                      
                      <div class="form-group col-md-6">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="material-icons">lock</i>
                            </span>
                          </div>
                          <input type="password" class="form-control" onkeypress="ocultar_burbujas()" placeholder="Ingrese aquí su contraseña" name="pass" id="pass" value="<?php if (isset($_SESSION['temClie']['clave'])) {echo $_SESSION['temClie']['clave'];}else{echo "";}?>">
                        </div>
                      </div>

                      <div class="form-group col-md-6">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="material-icons">lock</i>
                            </span>
                          </div>
                          <input type="password" class="form-control" onkeypress="ocultar_burbujas()" placeholder="Confirme aquí su contraseña" name="pass1" id="pass1" value="<?php if (isset($_SESSION['temClie']['clave'])) {echo $_SESSION['temClie']['clave'];}else{echo "";}?>">
                        </div>
                      </div> 

                    </div>
                    <div id="cont_error_clave_reg_us" class="burbuja_alerta left_burbuja_error_izq"></div>
                    <div id="cont_error_conf_clave_reg_us" class="burbuja_alerta left_burbuja_error_der"></div>

                    <div class="form-row">
                      
                      <div class="form-group col-md-6">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="material-icons">email</i>
                            </span>
                          </div>
                          <input id="email_us" type="email" class="form-control" name="correo" onkeypress="ocultar_burbujas()" placeholder="Ingrese aquí su correo electrónico" value="<?php if (isset($_SESSION['temClie']['correo'])) {echo $_SESSION['temClie']['correo'];}else{echo "";}?>">
                        </div>
                      </div>

                      <div class="form-group col-md-6">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="material-icons">email</i>
                            </span>
                          </div>
                          <input id='conf_email_us' type="email" class="bloquear_pegar form-control" name="conf_correo" onkeypress="ocultar_burbujas()" placeholder="Confirme aquí su correo electrónico"  value="<?php if (isset($_SESSION['temClie']['conf_correo'])) {echo $_SESSION['temClie']['conf_correo'];}else{echo "";}?>">
                        </div>
                      </div> 

                    </div>
                    <div id="cont_error_email_reg_us" class="burbuja_alerta left_burbuja_error_izq"></div>
                    <div id="cont_error_conf_email_reg_us" class="burbuja_alerta left_burbuja_error_der"></div>

                    <div class="form-row">

                      <div class="form-group col-md-6">
                        <div class="input-group">
                          <div class="input-group-prepend reset_display_icon">
                            <span class="input-group-text">
                              <i class="material-icons">date_range</i>
                            </span>
                          </div>
                          <div class="form-group reset_display">
                            <label for="fecha_expedicion_doc">Fecha de nacimiento</label>
                            <input id="fecha_nacimiento" type="date" class="form-control" name="fecha_nacimiento" onkeypress="ocultar_burbujas()" onclick="ocultar_burbujas()" value="<?php if (isset($_SESSION['temClie']['fecha_nacimiento'])) {echo $_SESSION['temClie']['fecha_nacimiento'];}else{echo "";}?>">
                          </div>
                        </div>
                      </div>

                      <div class="form-group col-md-6">
                        <div class="input-group">
                          <div id="icon_pais_reg_per" class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="material-icons">public</i>
                            </span>
                          </div>
                          <select id="pais_cargar_departamento" name="pais_us" class="form-control" onchange='cargar_departamento(); ocultar_burbujas()'>
                           <option value="0" selected>Seleccione país de residencia</option>
                            <?php conectar(); echo Cargar::Pais($mysqli); desconectar(); ?>
                          </select>
                        </div>
                      </div> 

                    </div>
                    <div id="cont_error_fecha_reg_us" class="burbuja_alerta left_burbuja_error_izq"></div>
                    <div id="cont_error_pais_reg_us" class="burbuja_alerta left_burbuja_error_der"></div>

                    <div class="form-row">
                      
                      <div class="form-group col-md-6">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="material-icons">domain</i>
                            </span>
                          </div>
                          <select id='departamento_cargar_ciudad' name="departamento_us" class="form-control" onchange='cargar_ciudades(); ocultar_burbujas()' disabled>
                           <option value="0" selected>Seleccione departamento de residencia</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group col-md-6">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="material-icons">home</i>
                            </span>
                          </div>
                          <select id='cargar_ciudad' name="ciudad" class="form-control" onchange="ocultar_burbujas()" disabled>
                           <option value="0" selected>Seleccione la ciudad de residencia</option>
                          </select>
                        </div>
                      </div> 

                    </div>
                    <div id="cont_error_departamento_reg_us" class="burbuja_alerta left_burbuja_error_izq"></div>
                    <div id="cont_error_ciudad_reg_us" class="burbuja_alerta left_burbuja_error_der"></div>

                    <div class="form-row">
                      
                      <div class="form-group col-md-12">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="material-icons">wc</i>
                            </span>
                          </div>
                          <select id='genero_us' name="genero_us" class="form-control" onchange='ocultar_burbujas()'>
                              <option value="0" selected>Seleccione su Genero</option>
                          <?php 
                          if (isset($_SESSION['temClie']['genero_us'])) {
                            if ($_SESSION['temClie']['genero_us'] == 1) {
                              ?>
                              <option value="1" selected>Masculino</option>
                              <option value="2">Femenino</option>
                              <option value="3">Otro</option>
                              <?
                            }elseif ($_SESSION['temClie']['genero_us'] == 2) {
                              ?>
                              <option value="1">Masculino</option>
                              <option value="2" selected>Femenino</option>
                              <option value="3">Otro</option>
                              <?
                            }elseif ($_SESSION['temClie']['genero_us'] == 3) {
                              ?>
                              <option value="1">Masculino</option>
                              <option value="2">Femenino</option>
                              <option value="3" selected>Otro</option>
                              <?
                            }
                          }else{
                            ?>
                            <option value="1">Masculino</option>
                            <option value="2">Femenino</option>
                            <option value="3">Otro</option>
                            <?
                          }
                          ?>
                          </select>
                        </div>
                      </div>

                    </div>
                    <div id="cont_error_genero_reg_us" class="burbuja_alerta left_burbuja_error_der"></div>

                  </div>

                  <h3>Información de contacto</h3>
                  <div>
                    <div class="form-row">
                      
                      <div class="form-group col-md-6">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="material-icons">phone</i>
                            </span>
                          </div>
                          <input id="numero_tel_fijo" type="number" class="form-control" name="text-telFijo" maxlength="15" minlength="7" min="0000000" max="999999999999999" pattern="[0-9]*{10}" placeholder="Ingrese aquí si tiene número fijo" title="Solo se puede llenar con numeros." onkeypress="ocultar_burbujas()" value="<?php if (isset($_SESSION['temClie']['telF'])) {echo $_SESSION['temClie']['telF'];}else{echo "";}?>">
                        </div>
                      </div>

                      <div class="form-group col-md-6">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="material-icons">stay_current_portrait</i>
                            </span>
                          </div>
                          <input id="numero_tel_movil" type="number" class="form-control" name="text-telMovil" maxlength="15" minlength="7" min="0000000" max="999999999999999" placeholder="Ingrese aquí si tiene número móvil" pattern="[0-9]*{10}" title="Solo se puede llenar con numeros." onkeypress="ocultar_burbujas()" value="<?php if (isset($_SESSION['temClie']['telM'])) {echo $_SESSION['temClie']['telM'];}else{echo "";}?>" >
                        </div>
                      </div> 

                    </div>

                    <div class="form-row">
                      
                      <div class="form-group col-md-6">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="material-icons">contact_phone</i>
                            </span>
                          </div>
                          <input id='numero_tel_alternativo' type="number" class="form-control" name="text-telAlter" maxlength="15" minlength="7" min="0000000" max="999999999999999" pattern="[0-9]*{10}" placeholder="Ingrese aquí un número alternativo" title="Solo se puede llenar con numeros." onkeypress="ocultar_burbujas()" value="<?php if (isset($_SESSION['temClie']['telA'])) {echo $_SESSION['temClie']['telA'];}else{echo "";}?>" >
                        </div>
                      </div>

                      <div class="form-group col-md-6">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="material-icons">location_on</i>
                            </span>
                          </div>
                          <input id='dir_us' type="text" class="form-control" name="text-dir" placeholder="Ingrese aquí su dirección de residencia" onkeypress="ocultar_burbujas()" value="<?php if (isset($_SESSION['temClie']['direccion'])) {echo $_SESSION['temClie']['direccion'];}else{echo "";}?>" >
                        </div>
                      </div> 

                    </div>
                    <div id="cont_error_dir_reg_us" class="burbuja_alerta left_burbuja_error_der"></div>

                  </div>

                </div>
              </div>
              <div class="footer text-center">
                <input type="submit" class="btn btn-primary btn-link btn-wd btn-lg" name="registrar_usuario" value="REGISTRARME">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

<div id="altura_ventana"></div>
<a style="text-decoration: none;" href="javascript:void(0)" onclick="desplazar_pagina_arriba()"><div id="button_up_pag"><img src="<?php echo $dominio; ?>imagenes/iconos/page_up.png"></div></a>

  </div>

</body>

</html>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="./libreria/theme/js/core/popper.min.js" type="text/javascript"></script>
<script src="./libreria/theme/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
<script src="./libreria/theme/js/plugins/moment.min.js"></script>
<script src="./libreria/theme/js/plugins/nouislider.min.js" type="text/javascript"></script>
<script src="./libreria/theme/js/plugins/jquery.sharrre.js" type="text/javascript"></script>
<script src="./libreria/theme/js/material-kit.js" type="text/javascript"></script>

<script type="text/javascript" src="./java/page_up.js"></script>
<script type="text/javascript" src="./java/menu.js"></script>
<script type="text/javascript" src="./java/formularios.js"></script>
<script type="text/javascript" src="./java/burbuja_error.js"></script>
<script type="text/javascript" src="./java/validar_formulario_registro.js"></script>
<script type="text/javascript" src="./java/ajax_cargar_departamento.js"></script>
<script type="text/javascript" src="./java/ajax_cargar_ciudad.js"></script>