<?php 
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	
$id=$_GET['id'];

// Obtiene la información del productopedido por medio del PEPRODUCTO ID
	$query3 = mysqli_query($result,"SELECT * FROM grupoNomina WHERE idgrupo= '$id';");
	$row3 	= $query3->fetch_assoc();

	$idnomina = $row3['idnomina'];

// Obtiene la información del total del pedido por medio del PEDIDO ID
	$query2 = mysqli_query($result,"SELECT * FROM nomina WHERE idnomina = '$idnomina';");
	$row2 	= $query2->fetch_assoc();

	$estado = $row2['estado'];
	
// Realiza la eliminación del producto.


if ($estado == 1) {

 	$msg = "El usuario no puede ser eliminado de la nomina porque ya fue liquidada, debes cancelarla primero";

	$html = "<script>
		window.alert('$msg');
		history.back(1);
	</script>";

	echo $html;	


}else{
		
	$query = mysqli_query($result,"delete from grupoNomina where idgrupo = '$id'");

	if($query > 0){
		$msg = 'El usuario fue eliminado de la nomina';
	}else{
		$msg = 'Error al eliminar el usuario. Intentelo de nuevo';
	}
		
	// Este alert se muestra con el mensaje correspondiente a la acción realizada en el IF
			
		$html = "<script>
			window.alert('$msg');
			history.back(1);
			opener.location.reload();
		</script>";
		
	echo $html;	
}