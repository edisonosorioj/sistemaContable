<?php
	
// Datos que vienen desde el enlace
$id 		= $_POST['id'];
$directorio = $_POST['directorio'];
$count		= 1;
$msg		= '';


//Como el elemento es un arreglos utilizamos foreach para extraer todos los valores
foreach($_FILES["imagen"]['tmp_name'] as $key => $tmp_name)
{
	//Validamos que el imagen exista
	if($_FILES["imagen"]["name"][$key]) {
		$filename = $_FILES["imagen"]["name"][$key]; //Obtenemos el nombre original del imagen
		$source = $_FILES["imagen"]["tmp_name"][$key]; //Obtenemos un nombre temporal del imagen
		$cero = ($count < 9)?'0':'';

		$directorio = $directorio; //Declaramos un  variable con la ruta donde guardaremos los archivos

		//Validamos si la ruta de destino existe, en caso de no existir la creamos
		if(!file_exists($directorio)){
			mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");	
		}
		
		$dir=opendir($directorio); //Abrimos el directorio de destino
		$target_path = '../'.$directorio.'/'.$cero.$count.substr($filename, -4); //Indicamos la ruta de destino, así como el nombre del archivo
		
		//Movemos y validamos que el archivo se haya cargado correctamente
		//El primer campo es el origen y el segundo el destino
		if(move_uploaded_file($source, $target_path)) {	
			$msg .= "El archivo $filename se ha almacenado en forma exitosa.<br>";
			} else {	
			$msg .= "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
		}
		closedir($dir); //Cerramos el directorio de destino
		$count = $count + 1;
	}
}

$html = "<script>
			window.alert('$msg');
			javascript:history.back();
		</script>";
	
echo $html;	

?>