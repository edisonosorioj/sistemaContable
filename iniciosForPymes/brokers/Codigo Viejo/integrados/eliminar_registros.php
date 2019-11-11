<?php
Class Delete{
	public static function Property($mysqli,$matricula){
		if (mysqli_query($mysqli,"DELETE FROM tbl_propiedad WHERE numero_matricula_inmobiliaria = '".$matricula."' ")) {
			return true;
		}else{
			return false;
		}
	}
}