<?php
if ($_GET['msn']) {
    if ($_GET['msn'] == 1) {
            $titulo_dpl_estado_cuenta = 'Brokers Soluciones';
            $txt_dpl_estado_cuenta = 'Bienvenido '.$_SESSION["nombres"].' a Brokers ';
            $img_icon_val_ingr = $dominio.'imagenes/usuario/default.png';
            $url_redirec = './index';
            $url_perf_us_ingr = '';
    }elseif ($_GET['msn'] == 2) {
        $titulo_dpl_estado_cuenta = 'Estado de la cuenta inactivo';
        $txt_dpl_estado_cuenta = 'Su cuenta se encuentra deshabilitada, por favor verifique en su correo electrónico el mensaje de activación o <a href="./recuperar">clic aquí</a> para enviar un nuevo mensaje de validación a su correo electrónico';
        $img_icon_val_ingr = $dominio.'imagenes/iconos/error.png';
        $url_redirec = './recuperar';
    }elseif ($_GET['msn'] == 3) {
        $titulo_dpl_estado_cuenta = 'Error al consultar cuenta';
        $txt_dpl_estado_cuenta = 'Lo sentimos no pudimos verificar el estado de su cuenta, intente nuevamente';
        $img_icon_val_ingr = $dominio.'imagenes/iconos/error.png';
        $url_redirec = './ingreso';
    }elseif ($_GET['msn'] == 4) {
        $titulo_dpl_estado_cuenta = 'Información incorrecta';
        $txt_dpl_estado_cuenta = 'Por favor verifique que su correo este correcto';
        $img_icon_val_ingr = $dominio.'imagenes/iconos/warning.png';
        $url_redirec = './ingreso';
    }elseif ($_GET['msn'] == 5) {
        $titulo_dpl_estado_cuenta = 'Error al consultar cuenta';
        $txt_dpl_estado_cuenta = 'Hubo un error al consultar su cuenta';
        $img_icon_val_ingr = $dominio.'imagenes/iconos/error.png';
        $url_redirec = './ingreso';
    }elseif ($_GET['msn'] == 6) {
        $titulo_dpl_estado_cuenta = 'Información incorrecta';
        $txt_dpl_estado_cuenta = 'Su correo electrónico es incorrecto, verifique e intente nuevamente';
        $img_icon_val_ingr = $dominio.'imagenes/iconos/warning.png';
        $url_redirec = './ingreso';
    }elseif ($_GET['msn'] == 7) {
        $titulo_dpl_estado_cuenta = 'Información incorrecta';
        $txt_dpl_estado_cuenta = 'Por favor verifique que su clave sea la correcta';
        $img_icon_val_ingr = $dominio.'imagenes/iconos/warning.png';
        $url_redirec = './ingreso';
    }elseif ($_GET['msn'] == 8) {
        $titulo_dpl_estado_cuenta = 'Información incorrecta';
        $txt_dpl_estado_cuenta = 'Hubo un error al consultar su clave';
        $img_icon_val_ingr = $dominio.'imagenes/iconos/warning.png';
        $url_redirec = './ingreso';
    }elseif ($_GET['msn'] == 9) {
        $titulo_dpl_estado_cuenta = 'Información incorrecta';
        $txt_dpl_estado_cuenta = 'Hubo un error al ejecutar la consulta de su clave';
        $img_icon_val_ingr = $dominio.'imagenes/iconos/warning.png';
        $url_redirec = './ingreso';
    }
}else{
    $titulo_dpl_estado_cuenta = 'Intente nuevamente o ponte en contacto';
    $txt_dpl_estado_cuenta = 'Por favor inicie sesion';
    $img_icon_val_ingr = $dominio.'imagenes/iconos/warning.png';
    $url_redirec = './ingreso';
}