var dominio = 'https://www.sgsst-col.com.co/brokers/';
var posicion_menu = 0;
function barra_lateral_menu(){
	if (posicion_menu == 0) {
        $('#slide_opciones_menu').css({'left':'0px'});
        $('#icon_menu_dpl').attr('src',dominio + 'imagenes/iconos/cerrar_menu.png');
        posicion_menu = 1;
	}else{
		if (posicion_menu == 1) {
			$('#slide_opciones_menu').css({'left':'-300px'});
			$('#icon_menu_dpl').attr('src',dominio + 'imagenes/iconos/menu.png');
            posicion_menu = 0;
		}
	}
}
function ocultar_barra_lateral_menu(){
	if (posicion_menu == 1) {
		$('#slide_opciones_menu').css({'left':'-300px'});
		$('#icon_menu_dpl').attr('src',dominio + 'imagenes/iconos/menu.png');
		posicion_menu = 0;
	}
}