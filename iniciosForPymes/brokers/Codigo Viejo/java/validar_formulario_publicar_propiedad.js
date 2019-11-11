function ocultar_burbujas(){$('#cont_error_titulo_publicar_propiedad').fadeOut(600);$('#cont_error_cocina_propiedad').fadeOut(600);$('#cont_error_imagen_select').fadeOut(600);$('#cont_error_venta_propiedad').fadeOut(600);$('#cont_error_descripcion_propiedad').fadeOut(600);$('#cont_error_matricula_propiedad').fadeOut(600);$('#cont_error_arriendo_propiedad').fadeOut(600);$('#cont_error_tipo_propiedad').fadeOut(600);$('#cont_error_estrato_propiedad').fadeOut(600);$('#cont_error_alcobas_propiedad').fadeOut(600);$('#cont_error_banos_propiedad').fadeOut(600);$('#cont_error_pais_propiedad').fadeOut(600);$('#cont_error_pais_propiedad').fadeOut(600);$('#cont_error_provincia_propiedad').fadeOut(600);$('#cont_error_ciudad_propiedad').fadeOut(600);$('#cont_error_sector_propiedad').fadeOut(600);$('#cont_error_direccion_propiedad').fadeOut(600);$('#cont_error_area_total_propiedad').fadeOut(600);$('#cont_error_area_bruta_propiedad').fadeOut(600);$('#cont_error_piso_propiedad').fadeOut(600);$('#cont_error_niveles_propiedad').fadeOut(600);$('#cont_error_parqueadero_propiedad').fadeOut(600);}
function desplegar_acordeon(val){$( "#accordion" ).accordion({ active: val });}

$("#form_publicar_propiedad").submit(function() {

	var titulo_publicar_propiedad = $("#titulo_publicar_propiedad").val();
	var imagen_publicar_propiedad = $("#1").val();
	var descripcion_publicar_propiedad = $("#summernote").val();
	var matricula_propiedad_publicar_propiedad = $("#matricula_propiedad_publicar_propiedad").val();
	var val_arriendo_publicar_propiedad = $("#val_arriendo_publicar_propiedad").val();
	var val_venta_publicar_propiedad = $("#val_venta_publicar_propiedad").val();
	var tipo_propiedad_publicar_propiedad = $("#tipo_propiedad_publicar_propiedad").val();
	var estrato_publicar_propiedad = $("#estrato_publicar_propiedad").val();
	var numero_alcobas_publicar_propiedad = $("#numero_alcobas_publicar_propiedad").val();
	var numero_banos_publicar_propiedad = $("#numero_banos_publicar_propiedad").val();
	var pais_publicar_propiedad = $("#pais_publicar_propiedad").val();
	var departamento_publicar_propiedad = $("#departamento_publicar_propiedad_select").val();
	var ciudad_publicar_propiedad = $("#ciudad_publicar_propiedad_select").val();
	var sector_publicar_propiedad = $("#sector_publicar_propiedad_select").val();
	var direccion_publicar_propiedad = $("#direccion_publicar_propiedad").val();
	var area_total_publicar_propiedad = $("#area_total_publicar_propiedad").val();
	var area_bruta_publicar_propiedad = $("#area_bruta_publicar_propiedad").val();
	var tipo_cocina_publicar_propiedad = $("#tipo_cocina_publicar_propiedad").val();
	var tipo_piso_publicar_propiedad = $("#tipo_piso_publicar_propiedad").val();
	var numero_niveles_publicar_propiedad = $("#numero_niveles_publicar_propiedad").val();
	var parqueadero_publicar_propiedad = $("#parqueadero_publicar_propiedad").val();

	if (titulo_publicar_propiedad == '' || titulo_publicar_propiedad == 0) {
		ocultar_burbujas();
		burbuja_error('Por favor escriba un título para la publicación de su propiedad','#cont_error_titulo_publicar_propiedad','#form_publicar_propiedad');
		$("#titulo_publicar_propiedad").focus();
		return false;
	}else{
		if (titulo_publicar_propiedad.length <= 5 || titulo_publicar_propiedad.length > 100) {
			ocultar_burbujas();
			$('#cont_error_titulo_publicar_propiedad').css({'top':'85px'});
			burbuja_error('Por favor escriba un título que contenga más de 5 y menos de 100 caracteres','#cont_error_titulo_publicar_propiedad','#form_publicar_propiedad');
			$("#titulo_publicar_propiedad").focus();
			return false;
		}else{
			if (imagen_publicar_propiedad == '' || imagen_publicar_propiedad == 0) {
				ocultar_burbujas(); desplegar_acordeon(0);
				burbuja_error('Por favor seleccione mínimo 1 imagen para la publicación de su propiedad','#cont_error_imagen_select','#titulo_publicar_propiedad');
				return false;
			}else{
				if (descripcion_publicar_propiedad == '' || descripcion_publicar_propiedad == 0) {
					ocultar_burbujas(); desplegar_acordeon(1);
					burbuja_error('Por favor describa su propiedad, mínimo 50 caracteres','#cont_error_descripcion_propiedad','#titulo_publicar_propiedad');
					return false;
				}else{
					if (descripcion_publicar_propiedad.length < 50 || descripcion_publicar_propiedad.length > 2000) {
						ocultar_burbujas(); desplegar_acordeon(1);
						burbuja_error('Por favor ingrese una descripción de mínimo 50 caracteres y máximo 2000 caracteres','#cont_error_descripcion_propiedad','#titulo_publicar_propiedad');
						return false;
					}else{
						if (matricula_propiedad_publicar_propiedad == '' || matricula_propiedad_publicar_propiedad == 0) {
							ocultar_burbujas(); desplegar_acordeon(1);
							burbuja_error('Por favor ingrese el número de la matricula inmobiliaria','#cont_error_matricula_propiedad','#ui-id-4');
							return false;
						}else{
							if (matricula_propiedad_publicar_propiedad.length < 5) {
								ocultar_burbujas(); desplegar_acordeon(1);
								burbuja_error('Por favor ingrese un número de matrícula inmobiliaria valido','#cont_error_matricula_propiedad','#ui-id-4');
								return false;
							}else{
								if (val_arriendo_publicar_propiedad.length < 1) {
									ocultar_burbujas(); desplegar_acordeon(1);
									burbuja_error('Por favor ingrese un valor de arriendo correcto','#cont_error_arriendo_propiedad','#ui-id-4');
									return false;
								}else{
									if (val_venta_publicar_propiedad.length < 1) {
										ocultar_burbujas(); desplegar_acordeon(1);
										burbuja_error('Por favor ingrese un valor de venta correcto','#cont_error_venta_propiedad','#ui-id-4');
										return false;
									}else{
										if (tipo_propiedad_publicar_propiedad == '' || tipo_propiedad_publicar_propiedad == 0) {
											ocultar_burbujas(); desplegar_acordeon(1);
											burbuja_error('Por favor seleccione el tipo de propiedad','#cont_error_tipo_propiedad','#matricula_propiedad_publicar_propiedad');
											return false;
										}else{
											if (estrato_publicar_propiedad == '' || estrato_publicar_propiedad == 0) {
												ocultar_burbujas(); desplegar_acordeon(1);
												burbuja_error('Por favor seleccione el estrato de la propiedad','#cont_error_estrato_propiedad','#matricula_propiedad_publicar_propiedad');
												return false;
											}else{
												if (numero_alcobas_publicar_propiedad == '' || numero_alcobas_publicar_propiedad.length < 1) {
													ocultar_burbujas(); desplegar_acordeon(1);
													burbuja_error('Por favor escriba el número de alcobas que contiene la propiedad','#cont_error_alcobas_propiedad','#matricula_propiedad_publicar_propiedad');
													return false;
												}else{
													if (numero_banos_publicar_propiedad == '' || numero_banos_publicar_propiedad < 1) {
														ocultar_burbujas(); desplegar_acordeon(1);
														burbuja_error('Por favor escriba el número de baños que contiene la propiedad','#cont_error_banos_propiedad','#matricula_propiedad_publicar_propiedad');
														return false;
													}else{
														if (pais_publicar_propiedad == 0) {
															ocultar_burbujas(); desplegar_acordeon(1);
															burbuja_error('Por favor seleccione el país donde se encuentra la propiedad','#cont_error_pais_propiedad','#matricula_propiedad_publicar_propiedad');
															return false;
														}else{
															if (departamento_publicar_propiedad == 0) {
																ocultar_burbujas(); desplegar_acordeon(1);
																burbuja_error('Por favor seleccione la provincia donde se encuentra la propiedad','#cont_error_provincia_propiedad','#matricula_propiedad_publicar_propiedad');
																return false;
															}else{
																if (ciudad_publicar_propiedad == 0) {
																	ocultar_burbujas(); desplegar_acordeon(1);
																	burbuja_error('Por favor seleccione la ciudad donde se encuentra la propiedad','#cont_error_ciudad_propiedad','#matricula_propiedad_publicar_propiedad');
																	return false;
																}else{
																	if (sector_publicar_propiedad == 0) {
																		ocultar_burbujas(); desplegar_acordeon(1);
																		burbuja_error('Por favor seleccione el sector donde se encuentra la propiedad','#cont_error_sector_propiedad','#matricula_propiedad_publicar_propiedad');
																		return false;
																	}else{
																		if (direccion_publicar_propiedad == '' || direccion_publicar_propiedad == 0) {
																			ocultar_burbujas(); desplegar_acordeon(1);
																			burbuja_error('Por favor escriba la dirección exacta de la propiedad','#cont_error_direccion_propiedad','#matricula_propiedad_publicar_propiedad');
																			return false;
																		}else{
																			if (direccion_publicar_propiedad.length < 5) {
																				ocultar_burbujas(); desplegar_acordeon(1);
																				burbuja_error('Por favor ingrese una dirección de mínimo 5 caracteres','#cont_error_direccion_propiedad','#matricula_propiedad_publicar_propiedad');
																				return false;
																			}else{
																				if (area_total_publicar_propiedad == '') {
																					ocultar_burbujas(); desplegar_acordeon(3);
																					burbuja_error('Por favor ingrese el área total de la propiedad','#cont_error_area_total_propiedad','#titulo_publicar_propiedad');
																					return false;
																				}else{
																					if (area_bruta_publicar_propiedad == '') {
																						ocultar_burbujas(); desplegar_acordeon(3);
																						burbuja_error('Por favor ingrese el área bruta de la propiedad','#cont_error_area_bruta_propiedad','#titulo_publicar_propiedad');
																						return false;
																					}else{
																						if (tipo_cocina_publicar_propiedad == 0) {
																							ocultar_burbujas(); desplegar_acordeon(3);
																							burbuja_error('Por favor seleccione el tipo de cocina de la propiedad','#cont_error_cocina_propiedad','#titulo_publicar_propiedad');
																							return false;
																						}else{
																							if (tipo_piso_publicar_propiedad == 0) {
																								ocultar_burbujas(); desplegar_acordeon(3);
																								burbuja_error('Por favor seleccione el tipo de piso de la propiedad','#cont_error_piso_propiedad','#titulo_publicar_propiedad');
																								return false;
																							}else{
																								if (numero_niveles_publicar_propiedad == '' || numero_niveles_publicar_propiedad.length < 1) {
																									ocultar_burbujas(); desplegar_acordeon(3);
																									burbuja_error('Por favor escriba el número de niveles de la propiedad','#cont_error_niveles_propiedad','#titulo_publicar_propiedad');
																									return false;	
																								}else{
																									if (parqueadero_publicar_propiedad == '' || parqueadero_publicar_propiedad < 1) {
																										ocultar_burbujas(); desplegar_acordeon(3);
																										burbuja_error('Por favor seleccione si la propiedad cuenta con parqueadero ','#cont_error_parqueadero_propiedad','#titulo_publicar_propiedad');
																										return false;	
																									}else{
																										ocultar_burbujas();
																										return true;
																									}
																								}
																							}
																						}
																					}
																				}
																			}
																		}
																	}
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
});