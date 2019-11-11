<?php
require('../conexion/config.php');
require('../consultas.php');
conectar();
if (Consulta::Informacion_Propiedad($mysqli,$_SESSION['codigo_propiedad'])) {
	$info_prop = Consulta::Informacion_Propiedad($mysqli,$_SESSION['codigo_propiedad']);

	$titulo = $info_prop[0];
	$descripcion = html_entity_decode($info_prop[1]);
	$sector_barrio = $info_prop[2];
	$direccion = $info_prop[3];
	$area_total = $info_prop[4];
	$area_construida = $info_prop[5];
	$fecha_registro_propiedad = $info_prop[6];
	$tipo_propiedad = strtoupper($info_prop[7]);
	$estrato = $info_prop[8];
	$numero_niveles = $info_prop[9];
	$numero_piso = $info_prop[10];
	$numero_alcoba = $info_prop[11];
	$numero_bano = $info_prop[12];
	$video = $info_prop[13];
	$parqueadero = $info_prop[14];
	$cuarto_util_parqueadero = $info_prop[15];
	$valor_arriendo = $info_prop[16];
	$valor_venta = $info_prop[17];

	$tipo_cocina = $info_prop[18];
	$tipo_piso = $info_prop[19];
	$constructora = $info_prop[20];
	$copropiedad = $info_prop[21];

	$nombre_carpeta = $info_prop[22];
	$codigo_propiedad = $info_prop[23];

	$codigo_sector = $info_prop[24];

	$codigo_ciudad = Consulta::Cod_Ciudad($mysqli,$codigo_sector);
	$nombre_ciudad = Consulta::Nombre_Tabla($mysqli,'tbl_ciudad','codigo',$codigo_ciudad);
	$codigo_provincia = Consulta::Cod_Departamento($mysqli,$codigo_ciudad);
	$nombre_provincia = Consulta::Nombre_Tabla($mysqli,'tbl_provincia','codigo',$codigo_provincia);
	$codigo_pais = Consulta::Cod_Pais($mysqli,$codigo_provincia);
	$nombre_pais = Consulta::Nombre_Tabla($mysqli,'tbl_pais','codigo',$codigo_pais);

	if (!empty($tipo_cocina)) { $tipo_cocina = Consulta::Tipo_Cocina($mysqli,$tipo_cocina); }else{$tipo_cocina = 'No tiene';}
	if (!empty($tipo_piso)) { $tipo_piso = Consulta::Tipo_Piso($mysqli,$tipo_piso); }else{$tipo_piso = 'No tiene';}
	if (!empty($constructora)) { $constructora = Consulta::Tipo_Constructora($mysqli,$constructora); }else{$constructora = 'No tiene';}
	if (!empty($copropiedad)) { $copropiedad = Consulta::Tipo_Copropiedad($mysqli,$copropiedad); }else{$copropiedad = 'No tiene';}

	if ($parqueadero == 1) {
		if ($cuarto_util_parqueadero == 1) { $txt_parqueadero = '1 + Cuarto util.'; }elseif ($cuarto_util_parqueadero == 2) { $txt_parqueadero = '1'; }
	}elseif ($parqueadero == 2) { $txt_parqueadero = 'No tiene'; }

	if ($archivo = fopen("../../propiedad/".$nombre_carpeta."/".$nombre_carpeta.".php", "w")){
		require('../../integrados/propiedad/script_propiedad.php');
		if (isset($_SESSION['codigo_propiedad'])) { unset($_SESSION["codigo_propiedad"]); }
		echo "<script>window.location.href = '../../propiedad/".$nombre_carpeta."/".$nombre_carpeta."';</script>";
	}

}else{
	echo "codigo sesion: ".$_SESSION['codigo_propiedad']."<br>";
	echo "error: ".mysqli_error($mysqli);
}
desconectar();