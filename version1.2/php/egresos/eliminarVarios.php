<?php 
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	
	$id=$_GET['id'];
	
	$query = mysqli_query($result,"delete from compras where idcompras='$id'");
	 
	if($query > 0){
		$msg = 'El egreso fue eliminado con exito';
	}else{
		$msg = 'Error al eliminar el egreso. Contacte al Administrador!';
	}
		
	$html = "<script>
		window.alert('$msg');
		self.location='compras.php';
	</script>";

echo $html;	
			

<?php
	if (isset($_POST['enviar'])) {
	    if (is_array($_POST['countries'])) {
	        $selected = '';
	        $num_countries = count($_POST['countries']);
	        $current = 0;
	        foreach ($_POST['countries'] as $key => $value) {
	            if ($current != $num_countries-1)
	                $selected .= $value.', ';
	            else
	                $selected .= $value.'.';
	            $current++;
	        }
	    }
	    else {
	        $selected = 'Debes seleccionar un país';
	    }

	    echo '<div>Has seleccionado: '.$selected.'</div>';
	}    
?>