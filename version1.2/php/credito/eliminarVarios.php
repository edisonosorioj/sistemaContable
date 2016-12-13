<?php 
require_once "../conexion.php";

error_reporting(E_ALL ^ E_NOTICE);

$conex = new conection();
$result = $conex->conex();

$id = $_POST['idcreditos'];
$query2 = mysqli_query($result, "SELECT * FROM creditos where idcreditos = '$id' limit 1;");
$row=$query2->fetch_assoc();
$idcliente = $row['idclientes'];

$ids = [$_POST['ids']];
$num_ids = count($ids[0]);


if ($num_ids > 0) {
		$selected = '';
		$current = 0;
		foreach ($ids[0] as $key => $value) {
            if ($current != $num_ids-1)
                $selected .= $value.', ';
            else
                $selected .= $value.'';
            $current++;
        }

		$query = mysqli_query($result,"delete from compras where idcreditos in($selected)");
		 
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
		self.location='creditos.php?id=" . $idcliente . "';
	</script>";

echo $html;	