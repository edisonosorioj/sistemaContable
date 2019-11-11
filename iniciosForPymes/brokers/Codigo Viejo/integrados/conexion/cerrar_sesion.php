<?php
$ruta = 'https://www.brokersfast.com.co/ingreso';
session_start();
if (isset($_SESSION["doc"])) {
	if (isset($_GET['logout'])) {
		if ($_GET['logout'] == 'close') {
			session_unset();
            session_destroy();
            echo "<script>window.location.href = '".$ruta."';</script>";
		}else{ echo "<script>window.location.href = '".$ruta."';</script>"; }
	}else{ echo "<script>window.location.href = '".$ruta."';</script>"; }
}else{ echo "<script>window.location.href = '".$ruta."';</script>"; }