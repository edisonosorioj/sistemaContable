<?php 

$archivo    =   $_POST['archivo']; 
$ruta       =   $_POST['ruta'];

$carpeta = "$ruta/adjuntos/";
opendir($carpeta);
$destino = $carpeta.$archivo;
copy($_FILES['foto']['tmp_name'], $destino);


$html = "<script>
			window.alert('Archivo guardado!!');
			opener.location.reload();
			window.close();
		</script>";	
	
echo $html;	

?>