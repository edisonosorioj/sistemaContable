<?php
conectar();

$informacion_propiedad = Consulta::Informacion_Propiedad($mysqli, $codigo_propiedad);
$carpeta = $informacion_propiedad[22];

$cantidad_imagenes = Consulta::Imagenes_Propiedad($mysqli,$codigo_propiedad);
$cantidad_imagenes_grandes = count($cantidad_imagenes);
$inicio_img_grandes = 0;
while ($inicio_img_grandes < $cantidad_imagenes_grandes) {
	?><div id='reset_img_swiper' class='swiper-slide' style='background-image:url(https://www.brokersfast.com.co/propiedad/<? echo $carpeta; ?>/imagenes/<?php echo $cantidad_imagenes[$inicio_img_grandes]; ?>)'></div><?
	$inicio_img_grandes++;
}
desconectar();
?>