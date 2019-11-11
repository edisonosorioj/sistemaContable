<?php
conectar();

$informacion_propiedad = Consulta::Informacion_Propiedad($mysqli, $codigo_propiedad);
$carpeta = $informacion_propiedad[22];

$cantidad_imagenes_thumbs = Consulta::Imagenes_Propiedad($mysqli,$codigo_propiedad);
$cantidad_imagenes_thumbs_dpl = count($cantidad_imagenes_thumbs);
$inicio_img_thumbs = 0;
while ($inicio_img_thumbs < $cantidad_imagenes_thumbs_dpl) {
	?><div id='espaciado_swipe_prop' class='swiper-slide' style='background-image:url(https://www.brokersfast.com.co/propiedad/<? echo $carpeta; ?>/imagenes/<?php echo $cantidad_imagenes_thumbs[$inicio_img_thumbs]; ?>)'></div><?
	$inicio_img_thumbs++;
}
desconectar();
?>