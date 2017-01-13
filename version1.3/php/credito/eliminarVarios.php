<?php
// Version 1.3 of Edison Osorio
session_start();


// Verifica que la sesion este correcta. Sino existe lo saca del sistema.
if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.php");
	exit();
	
}

require_once "../conexion.php";

// Quita el reporte notice del navegador
// error_reporting(E_ALL ^ E_NOTICE);

$conex = new conection();
$result = $conex->conex();

// Trae los IDS seleccionado y les hace un conteo
$ids = [$_GET['ids']];
$num_ids = count($ids[0]);

print_r($num_ids);die();

// Lista los IDS seleccionados para eliminacion masiva
if ($num_ids > 0) {
		$selected = '';
		$current = 0;
		foreach ($ids[0] as $key => $value) {
            if ($current != $num_ids-1)
                $selected .= $value.',';
            else
                $selected .= $value.'';
            $current++;
        }
// Realiza la consulta de eliminacion y valida si se hace o no el proceso
		$query = mysqli_query($result,"delete from creditos where idcreditos in($selected);");
		 
		if($query > 0){
			$msg = 'Lo seleccionado fue eliminado';

		}else{
			$msg = 'Error al eliminar lo seleccionado. Intentalo de nuevo';
	      }

    }else {
// Mensaje en caso que no se seleccione ningun ID a eliminar
    	$msg = 'Debes seleccionar como minimo un registro';
    }

$html = "<script>
		window.alert('$msg');
		javascript:history.back();
	</script>";
	echo $html;

   