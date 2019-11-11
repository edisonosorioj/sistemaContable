<?php
class Register{
	function User($mysqli,$tipo_doc,$num_doc,$fecha_exp_doc,$ciudad_exp_doc,$nombres,$apellidos,$password,$correo,$fecha_nacimiento,$ciudad_us,$genero_us,$direccion_us,$tel_fijo,$tel_movil,$tel_alternativo,$codigo){
		if (mysqli_query($mysqli, "INSERT INTO tbl_usuario (documento,tipo_documento,lugar_expedicion,fecha_expedicion,nombres,apellidos,email,fecha_nacimiento,rol,ciudad,tel_movil,tel_fijo,tel_alternativo,direccion,clave,codigo_activacion,estado,genero) VALUES ('".$num_doc."', '".$tipo_doc."', '".$ciudad_exp_doc."', '".$fecha_exp_doc."','".$nombres."','".$apellidos."','".$correo."','".$fecha_nacimiento."',2,'".$ciudad_us."','".$tel_movil."','".$tel_fijo."','".$tel_alternativo."','".$direccion_us."','".$password."','".$codigo."',0,'".$genero_us."') ")) { return true; }else{return false;}
	}

	public static function Property($mysqli,$propietario,$titulo,$descripcion,$sector_barrio,$direccion,$area_total,$area_construida,$fecha_registro_propiedad,$tipo_propiedad,$estrato,$tipo_cocina,$tipo_piso,$estado_propiedad,$numero_niveles,$numero_piso,$constructora,$numero_alcoba,$numero_bano,$video,$copropiedad,$parqueadero,$cuarto_util_parqueadero,$destacado,$visitas,$archivo_documento,$valor_arriendo,$valor_venta,$numero_matricula_inmobiliaria,$nombre_carpeta){
		if (mysqli_query($mysqli, "INSERT INTO tbl_propiedad (propietario,titulo,descripcion,sector_barrio,direccion,area_total,area_construida,fecha_registro_propiedad,tipo_propiedad,estrato,tipo_cocina,tipo_piso,estado_propiedad,numero_niveles,numero_piso,constructora,numero_alcoba,numero_bano,video,copropiedad,parqueadero,cuarto_util_parqueadero,destacado,visitas,archivo_documento,valor_arriendo,valor_venta,numero_matricula_inmobiliaria,nombre_carpeta) VALUES (".$propietario.",'".$titulo."','".$descripcion."',".$sector_barrio.",'".$direccion."',".$area_total.",".$area_construida.",'".$fecha_registro_propiedad."',".$tipo_propiedad.",".$estrato.",".$tipo_cocina.",".$tipo_piso.",".$estado_propiedad.",".$numero_niveles.",".$numero_piso.",".$constructora.",".$numero_alcoba.",".$numero_bano.",'".$video."',".$copropiedad.",".$parqueadero.",".$cuarto_util_parqueadero.",".$destacado.",".$visitas.",".$archivo_documento.",".$valor_arriendo.",".$valor_venta.",'".$numero_matricula_inmobiliaria."','".$nombre_carpeta."') ")) {
			return true;
		}else{
			return false;
		}
	}

	public static function Comodidades_Propiedad($mysqli,$propiedad,$comodidad){
		if (mysqli_query($mysqli,"INSERT INTO tbl_propiedad_comodidad_propiedad (codigo_propiedad,codigo_comodidad_propiedad) VALUES ('".$propiedad."','".$comodidad."')")) {
			return true;
		}else{
			return false;
		}
	}

	public static function Comodidades_Copropiedad($mysqli,$copropiedad,$comodidad){
		if (mysqli_query($mysqli,"INSERT INTO tbl_copropiedad_comodidades_copropiedad (codigo_copropiedad,codigo_comodidad_copropiedad)  VALUES (".$copropiedad.",".$comodidad.") ")) {
			return true;
		}else{
			return false;
		}
	}

	public static function Imagenes_Propiedad_Relacion($mysqli,$propiedad,$imagen){
		if (mysqli_query($mysqli,"INSERT INTO tbl_imagen_propiedad (codigo_propiedad,codigo_imagen) VALUES(".$propiedad.",".$imagen.") ")) {
			return true;
		}else{
			return false;
		}
	}

	public static function Imagenes_Propiedad($mysqli,$imagen){
		if (mysqli_query($mysqli,"INSERT INTO tbl_imagen (nombre) VALUES ('".$imagen."') ")) {
			return true;
		}else{
			return false;
		}
	}

}