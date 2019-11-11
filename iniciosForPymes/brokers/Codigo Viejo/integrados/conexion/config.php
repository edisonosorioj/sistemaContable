<?php 
session_start();
ini_set('date.timezone','America/Bogota');
$fecha_actual = date("Y-m-d");

function conectar(){ global $mysqli; $mysqli = mysqli_connect("localhost", "brokersf_adm", "Brokersfast_2018", "brokersf_co"); }
function desconectar(){ global $mysqli; mysqli_close($mysqli); }

function redirigir_sesion($sesion){
	@$pagina_anterior = $_SERVER['HTTP_REFERER'];
	if (isset($sesion)) {
		if (isset($pagina_anterior)) {
			if ($pagina_anterior == $dominio.'ingreso' || $pagina_anterior == $dominio.'recuperar') {
				header('Location: '.$dominio.'index ');
			}else{
				header('Location: '.$dominio.'index ');
			}
		}else{
			header('Location: '.$dominio.'index ');
		}
	}
}

///////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////// CONFIGURACIONES GENERALES //////////////////////////////////////////
$dominio="https://www.brokersfast.com.co/";
///////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////// CONFIGURACION URL REDES SOCIALES //////////////////////////////////////////
$url_pag_facebook = 'https://es-la.facebook.com/BrokersSoluciones/';
$url_pag_instagram = 'https://www.instagram.com/brokerssoluciones/';
$url_pag_youtube = 'https://www.youtube.com/channel/UCEgniSW3pS5pUiGhwIqLA4Q';
///////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////// CONFIGURACION SERVIDOR MENSAJES DE SALIDA /////////////////////////////////
$usuario_webmail = 'admin@brokersfast.com.co';
$pass_usuario_webmail = 'brokersfast_2018';
$host_webmail = 'mail.brokersfast.com.co';
$email_brokers = 'ayuda@brokersfast.com.co';
///////////////////////////////////////////////////////////////////////////////////////////////////

?>