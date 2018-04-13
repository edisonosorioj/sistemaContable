<?php 
require_once "../conexion.php";

// error_reporting(E_ALL ^ E_NOTICE);

$conex = new conection();
$result = $conex->conex();

$ids = array();

if (isset($_POST['ids']) > 0) {
	$idss = $_POST['ids'];
}else{
	$idss = $ids;
}

$num_idss = count($idss);


if ($num_idss > 0) {
		$selected = '';
		$current = 0;
		foreach ($idss as $key => $value) {
            if ($current != $num_idss-1)
                $selected .= $value.', ';
            else
                $selected .= $value.'';
            $current++;
        }

		$query = mysqli_query($result,"delete from ingresos where idingresos in($selected)");
		 
		if($query > 0){
			$msg = 'Lo seleccionado fue eliminado';
		}else{
			$msg = 'Error al eliminar lo seleccionado. Intentalo de nuevo';
	      }

    }else {
    	$msg = 'Debes seleccionar como minimo un registro';
    }

   
	$html = "<script>
		window.alert('$msg');
		self.location='ingresos.php';
	</script>";

echo $html;	