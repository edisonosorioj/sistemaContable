<?php
class Actualizar{
	function Estado_Cuenta_Activo($mysqli,$usuario){
		if (mysqli_query($mysqli, "UPDATE tbl_usuario SET estado = 1 WHERE documento = '".$usuario."' ")) { return true; }else{ return false; }
	}
	function Codigo_Activacion($mysqli,$campo,$parametro,$valor){
		if (mysqli_query($mysqli, "UPDATE tbl_usuario SET codigo_activacion = '".$valor."' WHERE ".$campo." = '".$parametro."' ")) { return true; }else{ return false; }
	}
	function Campo_Usuario($mysqli,$campo,$val_campo,$condicion,$parametro){
		if (mysqli_query($mysqli, "UPDATE tbl_usuario SET ".$campo." = '".$val_campo."' WHERE ".$condicion." = '".$parametro."' ")) { return true; }else{ return false; }
	}
	function Clave_Usuario($mysqli,$clave,$condicion,$parametro){
		if (mysqli_query($mysqli, "UPDATE tbl_usuario SET clave = '".$clave."' WHERE ".$condicion." = '".$parametro."' ")) { return true; }else{ return false; }
	}
}