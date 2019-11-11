<?php
require_once("../../libreria/tinify-php-master/lib/Tinify/Exception.php");
require_once("../../libreria/tinify-php-master/lib/Tinify/ResultMeta.php");
require_once("../../libreria/tinify-php-master/lib/Tinify/Result.php");
require_once("../../libreria/tinify-php-master/lib/Tinify/Source.php");
require_once("../../libreria/tinify-php-master/lib/Tinify/Client.php");
require_once("../../libreria/tinify-php-master/lib/Tinify.php");

$nuevoNombre_sin_repetir = $new_name_img;
$ruta_imagenes_cargadas = $ruta_carpeta_propiedad_imagenes;

$ruta_completa = $ruta_carpeta_propiedad_imagenes.$new_name_img;
$estampa = imagecreatefromjpeg('../../imagenes/marca_agua.jpg');

\Tinify\setKey("4bQJMjLcQ6ZiIiPHtCxU6LomDfrKnzId"); // uzZt8fEWrajhUqJH6CzAw2SLYz1LnROT
$ruta_img_tyny_compress = $ruta_imagenes_cargadas.$nuevoNombre_sin_repetir;
$imagen = explode(".", $nuevoNombre_sin_repetir);
switch ($imagen[1]) {
case "jpg": 
/////////////////////// MARCA DE AGUA JPG ///////////////////////////////////////
$im = imagecreatefromjpeg($ruta_completa);
$margen_dcho = 10; $margen_inf = 10;
$sx = imagesx($estampa); $sy = imagesy($estampa);
imagecopymerge($im, $estampa, 0, imagesy($im) - $sy, 0, 0, $sx, $sy, 50);
imagejpeg($im, $ruta_completa);
//////////////////////////////////////////////////////////////////////////////
$rutaImagenOriginal = $ruta_imagenes_cargadas.$nuevoNombre_sin_repetir;
$img_original = imagecreatefromjpeg($rutaImagenOriginal);
$max_ancho = 400;
$max_alto = 400;
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
$directorio_descargas_salida = $ruta_imagenes_cargadas;
imagejpeg($tmp,$directorio_descargas_salida.$nuevoNombre_sin_repetir,$calidad);
$source = \Tinify\fromFile($ruta_img_tyny_compress);
$source->toFile($ruta_img_tyny_compress);
break; 
case "png":
/////////////////////// MARCA DE AGUA JPG ///////////////////////////////////////
$im = imagecreatefrompng($ruta_completa);
$margen_dcho = 10; $margen_inf = 10;
$sx = imagesx($estampa); $sy = imagesy($estampa);
imagecopymerge($im, $estampa, 0, imagesy($im) - $sy, 0, 0, $sx, $sy, 50);
imagepng($im, $ruta_completa);
//////////////////////////////////////////////////////////////////////////////
$rutaImagenOriginal = $ruta_imagenes_cargadas.$nuevoNombre_sin_repetir;
$img_original = imagecreatefrompng($rutaImagenOriginal);
$max_ancho = 400;
$max_alto = 400;
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
imagedestroy($img_original); $calidad=7;
$directorio_descargas_salida = $ruta_imagenes_cargadas;
imagepng($tmp,$directorio_descargas_salida.$nuevoNombre_sin_repetir,$calidad);
$source = \Tinify\fromFile($ruta_img_tyny_compress);
$source->toFile($ruta_img_tyny_compress);
break;
$rutaImagenOriginal = $ruta_imagenes_cargadas.$nuevoNombre_sin_repetir;
}
?>