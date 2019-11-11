<?php 
$imagen = explode(".", $nuevoNombre_sin_repetir);//separo el nombre del archivo por el punto de forma que queda la extension en $imagen[1] 
switch ($imagen[1]) {//voy verificando todas las posibilidades... 
case "jpg": 
       //Ruta de la imagen original
$rutaImagenOriginal = $ruta_imagenes_cargadas.$nuevoNombre_sin_repetir;

$img_original = imagecreatefromjpeg($rutaImagenOriginal);

$max_ancho = 150;
$max_alto = 150;

list($ancho,$alto)=getimagesize($rutaImagenOriginal);

$x_ratio = $max_ancho / $ancho;
$y_ratio = $max_alto / $alto;

if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){
$ancho_final = $ancho;
$alto_final = $alto;
}elseif (($x_ratio * $alto) < $max_alto){
$alto_final = ceil($x_ratio * $alto);
$ancho_final = $max_ancho;
}else{
$ancho_final = ceil($y_ratio * $ancho);
$alto_final = $max_alto;
}

$tmp=imagecreatetruecolor($ancho_final,$alto_final);
imagecopyresampled($tmp,$img_original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);
imagedestroy($img_original); $calidad=75;
$directorio_descargas_salida = $ruta_imagenes_icono_cargadas;
imagejpeg($tmp,$directorio_descargas_salida.$nuevoNombre_sin_repetir,$calidad);
break; 

case "png":
$rutaImagenOriginal = $ruta_imagenes_cargadas.$nuevoNombre_sin_repetir;

$img_original = imagecreatefrompng($rutaImagenOriginal);

$max_ancho = 150;
$max_alto = 150;

list($ancho,$alto)=getimagesize($rutaImagenOriginal);

$x_ratio = $max_ancho / $ancho;
$y_ratio = $max_alto / $alto;

if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){
$ancho_final = $ancho;
$alto_final = $alto;
}elseif (($x_ratio * $alto) < $max_alto){
$alto_final = ceil($x_ratio * $alto);
$ancho_final = $max_ancho;
}else{
$ancho_final = ceil($y_ratio * $ancho);
$alto_final = $max_alto;
}

$tmp=imagecreatetruecolor($ancho_final,$alto_final);
imagecopyresampled($tmp,$img_original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);
imagedestroy($img_original); $calidad=9;
$directorio_descargas_salida = $ruta_imagenes_icono_cargadas;
imagepng($tmp,$directorio_descargas_salida.$nuevoNombre_sin_repetir,$calidad);
break;
       
$rutaImagenOriginal = $ruta_imagenes_cargadas.$nuevoNombre_sin_repetir;
}
?>