<?php
class Cargar{
	function Tipo_Documento($mysqli){
		if ($consulta = mysqli_query($mysqli, "SELECT * FROM tbl_tipo_documento ORDER BY nombre")) {
			if ($resultado = mysqli_fetch_array($consulta)) {
				$var_session_doc = $_SESSION['temClie']['tipo_documento'];
				do{
					if (isset($var_session_doc)) {
						if ($var_session_doc == $resultado['codigo']) {
							?><option value='<?php echo $resultado['codigo']; ?>' selected='selected'><?php echo $resultado['nombre']; ?></option><?php
						}else{
							?><option value='<?php echo $resultado['codigo']; ?>'><?php echo $resultado['nombre']; ?></option><?php
						}
					}else{
						?><option value='<?php echo $resultado['codigo']; ?>'><?php echo $resultado['nombre']; ?></option><?php
					}
				}while ($resultado = mysqli_fetch_array($consulta));			
			}else{ ?> <option>Error #1</option> <?php }
		}else{ ?> <option>Error #2</option> <?php }
	}
	function Pais($mysqli){
		if ($consulta = mysqli_query($mysqli, 'SELECT * FROM tbl_pais ORDER BY nombre ASC')) {
			if ($resultado = mysqli_fetch_array($consulta)) {
				do{
					if ($val_pais_sesion == $resultado['codigo']) {
						?><option value='<?php echo $resultado['codigo']; ?>' selected><?php echo $resultado['nombre']; ?></option><?
					}else{
						?><option value='<?php echo $resultado['codigo']; ?>'><?php echo $resultado['nombre']; ?></option><?php
					}
				}while ($resultado = mysqli_fetch_array($consulta_pais));
			}else{ ?><option>Error #1</option><?php }
		}else{ ?><option>Error #2</option><?php }
	}
	function Tipo_Propiedad($mysqli){
		if ($consulta = mysqli_query($mysqli, 'SELECT * FROM tbl_tipo_propiedad ORDER BY nombre ASC')) {
			if ($resultado = mysqli_fetch_array($consulta)) {
				$var_session_tipo_propiedad = $_SESSION['publicar_propiedad']['tipo_propiedad'];
				do{
					if (isset($var_session_tipo_propiedad)) {
						if ($var_session_tipo_propiedad == $resultado['codigo']) {
							?><option value='<?php echo $resultado['codigo']; ?>' selected='selected'><?php echo $resultado['nombre']; ?></option><?php
						}else{
							?><option value='<?php echo $resultado['codigo']; ?>'><?php echo $resultado['nombre']; ?></option><?php
						}
					}else{
						?><option value='<?php echo $resultado['codigo']; ?>'><?php echo $resultado['nombre']; ?></option><?php
					}
				}while ($resultado = mysqli_fetch_array($consulta));		
			}
		}
	}
	function Tipo_Cocina($mysqli){
		if ($consulta = mysqli_query($mysqli, 'SELECT * FROM tbl_cocina ORDER BY nombre ASC')) {
			if ($resultado = mysqli_fetch_array($consulta)) {
				$var_session_tipo_cocina = $_SESSION['publicar_propiedad']['tipo_cocina'];
				do{
					if (isset($var_session_tipo_cocina)) {
						if ($var_session_tipo_cocina == $resultado['codigo']) {
							?><option value='<?php echo $resultado['codigo']; ?>' selected='selected'><?php echo $resultado['nombre']; ?></option><?php
						}else{
							?><option value='<?php echo $resultado['codigo']; ?>'><?php echo $resultado['nombre']; ?></option><?php
						}
					}else{
						?><option value='<?php echo $resultado['codigo']; ?>'><?php echo $resultado['nombre']; ?></option><?php
					}
				}while ($resultado = mysqli_fetch_array($consulta));		
			}
		}
	}
	function Tipo_Piso($mysqli){
		if ($consulta = mysqli_query($mysqli, 'SELECT * FROM tbl_piso ORDER BY nombre ASC')) {
			if ($resultado = mysqli_fetch_array($consulta)) {
				$var_session_tipo_piso = $_SESSION['publicar_propiedad']['tipo_piso'];
				do{
					if (isset($var_session_tipo_piso)) {
						if ($var_session_tipo_piso == $resultado['codigo']) {
							?><option value='<?php echo $resultado['codigo']; ?>' selected='selected'><?php echo $resultado['nombre']; ?></option><?php
						}else{
							?><option value='<?php echo $resultado['codigo']; ?>'><?php echo $resultado['nombre']; ?></option><?php
						}
					}else{
						?><option value='<?php echo $resultado['codigo']; ?>'><?php echo $resultado['nombre']; ?></option><?php
					}
				}while ($resultado = mysqli_fetch_array($consulta));		
			}
		}
	}
	function Comodidad_Propiedad($mysqli){
		if ($consulta = mysqli_query($mysqli, 'SELECT * FROM tbl_comodidad_general_propiedad ORDER BY nombre ASC')) {
			if ($resultado = mysqli_fetch_array($consulta)) {
				$var_session_comodidad_propiedad = $_SESSION['publicar_propiedad']['comodidad_propiedad'];
				do{
					if (isset($var_session_comodidad_propiedad)) {
						if ($var_session_comodidad_propiedad == $resultado['codigo']) {
							?><option value='<?php echo $resultado['codigo']; ?>' selected='selected'><?php echo $resultado['nombre']; ?></option><?php
						}else{
							?><option value='<?php echo $resultado['codigo']; ?>'><?php echo $resultado['nombre']; ?></option><?php
						}
					}else{
						?><option value='<?php echo $resultado['codigo']; ?>'><?php echo $resultado['nombre']; ?></option><?php
					}
				}while ($resultado = mysqli_fetch_array($consulta));		
			}
		}
	}
	function Constructora($mysqli){
		if ($consulta = mysqli_query($mysqli, 'SELECT * FROM tbl_constructora ORDER BY nombre ASC')) {
			if ($resultado = mysqli_fetch_array($consulta)) {
				$var_session_constructora = $_SESSION['publicar_propiedad']['constructora_propiedad'];
				do{
					if (isset($var_session_constructora)) {
						if ($var_session_constructora == $resultado['codigo']) {
							?><option value='<?php echo $resultado['codigo']; ?>' selected='selected'><?php echo $resultado['nombre']; ?></option><?php
						}else{
							?><option value='<?php echo $resultado['codigo']; ?>'><?php echo $resultado['nombre']; ?></option><?php
						}
					}else{
						?><option value='<?php echo $resultado['codigo']; ?>'><?php echo $resultado['nombre']; ?></option><?php
					}
				}while ($resultado = mysqli_fetch_array($consulta));		
			}
		}
	}
	function Copropiedad($mysqli){
		if ($consulta = mysqli_query($mysqli, 'SELECT * FROM tbl_copropiedad ORDER BY nombre ASC')) {
			if ($resultado = mysqli_fetch_array($consulta)) {
				$var_session_copropiedad = $_SESSION['publicar_propiedad']['copropiedad'];
				do{
					if (isset($var_session_copropiedad)) {
						if ($var_session_copropiedad == $resultado['codigo']) {
							?><option value='<?php echo $resultado['codigo']; ?>' selected='selected'><?php echo $resultado['nombre']; ?></option><?php
						}else{
							?><option value='<?php echo $resultado['codigo']; ?>'><?php echo $resultado['nombre']; ?></option><?php
						}
					}else{
						?><option value='<?php echo $resultado['codigo']; ?>'><?php echo $resultado['nombre']; ?></option><?php
					}
				}while ($resultado = mysqli_fetch_array($consulta));		
			}
		}
	}
	function Imagen_Servidor($ruta_carga){ 
        $inicio_img = 1;
        $num_img = 0;
        $error_charge = 0;
		while ($inicio_img <= 20) {
			$nombre_imagen = "img".$inicio_img;
			if (is_uploaded_file($_FILES[$nombre_imagen]['tmp_name'])) {
				if (move_uploaded_file($_FILES[$nombre_imagen]['tmp_name'],"$ruta_carga")) {}else{ $error_charge++; }
			} 
			$inicio_img++;
		}
		return $error_charge;

	}

	function titulo_organizado($titulo){$letra_mayuscula = substr($titulo, 0, 1);$titulo_restante = substr($titulo, 1);$cadena_devuelta_minuscula = strtolower($titulo_restante);$titulo_completo_organizado_funcion = $letra_mayuscula.$cadena_devuelta_minuscula;return $titulo_completo_organizado_funcion;}

	public static function Nombre_Pagina($titulo){ 
		$nombre_pagina = Limpiar::Caracteres_Especiales($titulo); 
		return $nombre_pagina; 
	}
}