<?php 
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

$ids = [$_POST['ids']];
	
if (isset($_POST['delete'])) {
    if (is_array($ids)) {
        $selected = '';
        $num_ids = count($ids);
        $current = 0;
        foreach ($ids as $key => $value) {
            if ($current != $num_ids-1)
                $selected .= $value.', ';
            else
                $selected .= $value.'';
            $current++;
        }
    }
    else {
        $selected = 'Debes seleccionar uno o varios registros';
    }

	$query = mysqli_query($result,"delete from compras where idcompras in ($selected)");
	 
	if($query > 0){
		$msg = 'El egreso fue eliminado con exito';
	}else{
		$msg = 'Error al eliminar el egreso. Contacte al Administrador!';
	}
		
}    
		$html = "<script>
			window.alert('$msg');
		</script>";

	echo $html;	


// http://www.forosdelweb.com/f18/borrar-varios-registros-mismo-tiempo-189435/
			// self.location='compras.php';