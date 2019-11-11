<nav class="navbar navbar-transparent navbar-color-on-scroll fixed-top navbar-expand-lg" color-on-scroll="100" id="sectionsNav">
  <div class="container">
    <div class="navbar-translate">
      <a class="navbar-brand" href="<?php echo $dominio; ?>">
      <img src="https://www.brokersfast.com.co/imagenes/brokersLogo.png" width="200px"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="sr-only">Navegación Movil</span>
        <span class="navbar-toggler-icon"></span>
        <span class="navbar-toggler-icon"></span>
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
        <a class="nav-link" href="javascript:void(0)" onclick="scrollToDownload()">
          <i class="material-icons">star</i> NUESTROS SERVICIOS
        </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contacto">
            <i class="material-icons">email</i> CONTACTO
          </a>
        </li>

      <?php if (!isset($_SESSION["doc"])) {}else{
         ?>
         <li class="dropdown nav-item">
          <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
            <i class="material-icons">apps</i> Menú
          </a>
          <div class="dropdown-menu dropdown-with-icons">
            <a href="<?php echo $dominio; ?>publicar" class="dropdown-item">
              <i class="material-icons">location_city</i> PUBLICAR PROPIEDAD
            </a>
            <a href="#" class="dropdown-item">
              <i class="material-icons">domain</i> ADMINISTRAR PROPIEDAD
            </a>
            <a href="#" class="dropdown-item">
              <i class="material-icons">home</i> ARRENDAR PROPIEDAD
            </a>
            <a href="#" class="dropdown-item">
              <i class="material-icons">home</i> ADMINISTRAR ARRIENDOS
            </a>
          </div>
        </li>
        <?
      } ?>        

      <?php if (!isset($_SESSION["doc"])) {
        ?>
        <li class="dropdown nav-item">
          <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
            <i class="material-icons">account_circle</i> ENTRAR
          </a>
          <div class="dropdown-menu dropdown-with-icons">
            <a href="<?php echo $dominio; ?>ingreso" class="dropdown-item">
              <i class="material-icons">lock</i> INGRESAR
            </a>
            <a href="<?php echo $dominio; ?>registro" class="dropdown-item">
              <i class="material-icons">home</i> ARRENDAR PROPIEDAD
            </a>
            <a href="<?php echo $dominio; ?>registro" class="dropdown-item">
              <i class="material-icons">domain</i> PUBLICAR PROPIEDAD
            </a>
          </div>
        </li>
        <?
      }else{} ?>
    
      <?php if (!isset($_SESSION["doc"])) {}else{
        ?>
        <li class="dropdown nav-item">
          <a href="#pablo" class="dropdown-toggle nav-link" data-toggle="dropdown">
            <i class="material-icons">settings</i>
            <b class="caret"></b>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <h6 class="dropdown-header">Cuenta</h6>
            <a href="#pablo" class="dropdown-item">Actualizar Paquete</a>
            <a href="<?php echo $dominio; ?>configuracion" class="dropdown-item">Configurarción</a>
            <div class="dropdown-divider"></div>
            <a href="<?php echo $dominio; ?>configuracion" class="dropdown-item">Ayuda</a>
            <div class="dropdown-divider"></div>
            <a href="<?php echo $dominio; ?>integrados/conexion/cerrar_sesion?logout=close" class="dropdown-item">Cerrar Sesion</a>
          </div>
        </li>
        <?
      }?>
      
        <li class="nav-item">
          <a class="nav-link" rel="tooltip" title="" data-placement="bottom" href="https://www.instagram.com/brokerssoluciones/" target="_blank" data-original-title="Síguenos en Instagram">
            <i class="fa fa-instagram"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" rel="tooltip" title="Brokers Soluciones" data-placement="bottom" href="https://www.facebook.com/BrokersSoluciones/" target="_blank" data-original-title="Síguenos en Facebook">
            <i class="fa fa-facebook-square"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" rel="tooltip" title="" data-placement="bottom" href="https://www.youtube.com/channel/UCEgniSW3pS5pUiGhwIqLA4Q?view_as=subscriber" target="_blank" data-original-title="Síguenos en Youtube">
            <i class="fa fa-youtube"></i>
          </a>
        </li>

    </ul>
  </div>
</div>
</nav>