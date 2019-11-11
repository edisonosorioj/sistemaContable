<?php
require('../conexion/config.php');
require('../validaciones.php');
require('../limpiadores.php');
require('../cargar_funciones.php');
require('../consultas.php');
require('../registros.php');
require('../eliminar_registros.php');

$inicio_img = 1; $num_img = 0; $formato_img = 0; $size_img = 0; $error_charge = 0; $num_carpeta = 0; $finalizar = 0; $img_up_serv = 0; $error_registrar_img = 0; $error_registrar_img_rel = 0;

if (isset($_POST['publicar_propiedad'])) {
	if (!empty($_POST['titulo_publicar_propiedad'])) {

		conectar();

		$_SESSION['publicar_propiedad'] = array('titulo_propiedad' => $_POST['titulo_publicar_propiedad']);
        
        $titulo_limpio = Limpiar::SQL_Injections($mysqli,$_POST['titulo_publicar_propiedad']);
        $titulo_limpio = strtolower($titulo_limpio);
        $nombre_pagina = Cargar::Nombre_Pagina($titulo_limpio);
        $verificar_carpeta_propiedad  = scandir('../../propiedad');
        $carpetas_encontradas = count($verificar_carpeta_propiedad);
        while ($num_carpeta <= $carpetas_encontradas) {
        	if (!empty($verificar_carpeta_propiedad[$num_carpeta])) {
        		if ($verificar_carpeta_propiedad[$num_carpeta] == $nombre_pagina) {
	        		while ($finalizar < 1) {
	        			$nuevo_nombre_pagina = $nombre_pagina."_".Consulta::Codigo(6);
	        			if ($nombre_pagina == $nuevo_nombre_pagina) { $finalizar = 0; }else{ $nombre_pagina = $nuevo_nombre_pagina; $finalizar = 2; }
	        		}
	        	}
        	}
        	$num_carpeta++;
        }

        $ruta_carpeta_propiedad = '../../propiedad/'.$nombre_pagina."/";
        $ruta_carpeta_propiedad_imagenes = '../../propiedad/'.$nombre_pagina."/imagenes/";
        $ruta_carpeta_propiedad_documentos = '../../propiedad/'.$nombre_pagina."/documentos/";

					if ($_POST['tipo_propiedad_publicar_propiedad'] <> 0) {
						$_SESSION['publicar_propiedad'] = array('titulo_propiedad' => $_POST['titulo_publicar_propiedad']);
						if (!empty($_POST['matricula_propiedad_publicar_propiedad'])) {
							$matricula_limpio = Limpiar::SQL_Injections($mysqli,$_POST['matricula_propiedad_publicar_propiedad']);
							$_SESSION['publicar_propiedad'] = array('titulo_propiedad' => $_POST['titulo_publicar_propiedad'], 'matricula_inmobiliaria' => $_POST['matricula_propiedad_publicar_propiedad']);
							if (!empty($_POST['tipo_propiedad_publicar_propiedad']) && $_POST['tipo_propiedad_publicar_propiedad'] <> 0) {
								$tipopropiedad_limpio = Limpiar::SQL_Injections($mysqli,$_POST['tipo_propiedad_publicar_propiedad']);
								//////////////////////////////////// PROPIEDAD DISTINTO A LOTE ///////////////////////////////////////////////
								if ($_POST['tipo_propiedad_publicar_propiedad'] <> 3 && $_POST['tipo_propiedad_publicar_propiedad'] <> 0) {
										//////////////////////////////////// INFORMACION GENERAL PROPIEDAD ///////////////////////////////////////////////
										if (!empty($_POST['numero_niveles_publicar_propiedad'])) {
											$niveles_limpio = Limpiar::SQL_Injections($mysqli,$_POST['numero_niveles_publicar_propiedad']);
											if (!empty($_POST['estrato_publicar_propiedad'])) {
												$estrato_limpio = Limpiar::SQL_Injections($mysqli,$_POST['estrato_publicar_propiedad']);
												if (!empty(['numero_alcobas_publicar_propiedad'])) {
													$alcobas_limpio = Limpiar::SQL_Injections($mysqli,$_POST['numero_alcobas_publicar_propiedad']);
													if (!empty(['numero_banos_publicar_propiedad'])) {
														$banos_limpio = Limpiar::SQL_Injections($mysqli,$_POST['numero_banos_publicar_propiedad']);
														if (!empty($_POST['tipo_cocina_publicar_propiedad']) && $_POST['tipo_cocina_publicar_propiedad'] <> 0) {
															$cocina_limpio = Limpiar::SQL_Injections($mysqli,$_POST['tipo_cocina_publicar_propiedad']);
															if (!empty($_POST['tipo_piso_publicar_propiedad']) && $_POST['tipo_piso_publicar_propiedad'] <> 0) {
																$piso_limpio = Limpiar::SQL_Injections($mysqli,$_POST['tipo_piso_publicar_propiedad']);
																//////////////////////////////////// NUMERO PISO DE PROPIEDAD ///////////////////////////////////////////////
																if ($_POST['tipo_propiedad_publicar_propiedad'] == 8 || $_POST['tipo_propiedad_publicar_propiedad'] == 7 || $_POST['tipo_propiedad_publicar_propiedad'] == 1 || $_POST['tipo_propiedad_publicar_propiedad'] == 2 || $_POST['tipo_propiedad_publicar_propiedad'] == 10) {
																	if (!empty($_POST['numero_piso_casa_apt']) && $_POST['numero_piso_casa_apt'] <> 0) {
																		$numeropiso_limpio = Limpiar::SQL_Injections($mysqli,$_POST['numero_piso_casa_apt']);
																	}else{echo '<script>alert("Por favor ingrese el número de piso de la propiedad");window.location.href = "../../publicar";</script>';  } // numero piso propiedad
																}

															}else{echo '<script>alert("Por favor ingrese el tipo de piso de la propiedad");window.location.href = "../../publicar";</script>';  } // tipo piso propiedad
														}else{echo '<script>alert("Por favor ingrese el tipo de cocina de la propiedad");window.location.href = "../../publicar";</script>';  } // tipo cocina propiedad
													}else{echo '<script>alert("Por favor ingrese el número de baños de la propiedad");window.location.href = "../../publicar";</script>';  } // numero baños propiedad
												}else{echo '<script>alert("Por favor ingrese el número de alcobas de la propiedad");window.location.href = "../../publicar";</script>';  } // numero alcobas propiedad
											}else{echo '<script>alert("Por favor ingrese el número de niveles de la propiedad");window.location.href = "../../publicar";</script>';  } // numero niveles propiedad
										}else{echo '<script>alert("Por favor ingrese el número de niveles de la propiedad");window.location.href = "../../publicar";</script>';  } // numero niveles propiedad

								}elseif ($_POST['tipo_propiedad_publicar_propiedad'] <> 0) {}else{echo '<script>alert("Por favor seleccione el tipo de la propiedad");window.location.href = "../../publicar";</script>';  } // validar tipo propiedad

								//////////////////////////////////// INFORMACION GENERAL DE LA PROPIEDAD ///////////////////////////////////////////////
								if (!empty($_POST['descripcion_publicar_propiedad'])) {
									$descripcion_limpio = Limpiar::SQL_Injections($mysqli,$_POST['descripcion_publicar_propiedad']);
									$_SESSION['publicar_propiedad'] = array('titulo_propiedad' => $_POST['titulo_publicar_propiedad'], 'matricula_inmobiliaria' => $_POST['matricula_propiedad_publicar_propiedad'], 'descripcion_propiedad' => $_POST['descripcion_publicar_propiedad']);
									if (!empty($_POST['pais_publicar_propiedad']) && $_POST['pais_publicar_propiedad'] <> 0) {
										if (!empty($_POST['departamento_publicar_propiedad']) && $_POST['departamento_publicar_propiedad'] <> 0) {
										    if (!empty($_POST['ciudad_publicar_propiedad']) && $_POST['ciudad_publicar_propiedad'] <> 0) {
										    	if (!empty($_POST['sector_publicar_propiedad_select']) && $_POST['sector_publicar_propiedad_select'] <> 0) {
										    		$sector_limpio = Limpiar::SQL_Injections($mysqli,$_POST['sector_publicar_propiedad_select']);
										    		if (!empty($_POST['val_arriendo_publicar_propiedad']) && !empty($_POST['val_venta_publicar_propiedad']) || $_POST['val_venta_publicar_propiedad'] == 0 || $_POST['val_arriendo_publicar_propiedad'] == 0) {
										    			$venta_limpio = Limpiar::SQL_Injections($mysqli,$_POST['val_venta_publicar_propiedad']);
										    			$arriendo_limpio = Limpiar::SQL_Injections($mysqli,$_POST['val_arriendo_publicar_propiedad']);
										    			$_SESSION['publicar_propiedad'] = array('titulo_propiedad' => $_POST['titulo_publicar_propiedad'], 'matricula_inmobiliaria' => $_POST['matricula_propiedad_publicar_propiedad'], 'descripcion_propiedad' => $_POST['descripcion_publicar_propiedad'],'valor_arriendo_propiedad' => $_POST['val_arriendo_publicar_propiedad'],'valor_venta_propiedad' => $_POST['val_venta_publicar_propiedad']);
										    			if (!empty($_POST['direccion_publicar_propiedad'])) {
										    				$direccion_limpio = Limpiar::SQL_Injections($mysqli,$_POST['direccion_publicar_propiedad']);
										    				$_SESSION['publicar_propiedad'] = array('titulo_propiedad' => $_POST['titulo_publicar_propiedad'], 'matricula_inmobiliaria' => $_POST['matricula_propiedad_publicar_propiedad'], 'descripcion_propiedad' => $_POST['descripcion_publicar_propiedad'],'valor_arriendo_propiedad' => $_POST['val_arriendo_publicar_propiedad'],'valor_venta_propiedad' => $_POST['val_venta_publicar_propiedad'],'direccion_propiedad' => $_POST['direccion_publicar_propiedad']);
										    				//////////////////////////////////// INFORMACION ADICIONAL PROPIEDAD ///////////////////////////////////////////////
															if (!empty($_POST['constructora_publicar_propiedad']) && $_POST['constructora_publicar_propiedad'] <> 0) {
																$constructora_limpio = Limpiar::SQL_Injections($mysqli,$_POST['constructora_publicar_propiedad']);
															}else{ $constructora_limpio = 'NULL'; } // constructora propiedad

																if (!empty($_POST['copropiedad_publicar_propiedad']) && $_POST['copropiedad_publicar_propiedad'] <> 0) {
																	if ($_POST['copropiedad_publicar_propiedad'] == 1) {
																		$copropiedad_limpio = Limpiar::SQL_Injections($mysqli,$_POST['copropiedad_publicar_propiedad']);
																		//////////////////////////////////// INFORMACION COPROPIEDAD ///////////////////////////////////////////////
																		if (!empty($_POST['nombre_copropiedad_publicar_propiedad']) && $_POST['nombre_copropiedad_publicar_propiedad'] <> 0) {
																			$nombre_copropiedad_limpio = Limpiar::SQL_Injections($mysqli,$_POST['nombre_copropiedad_publicar_propiedad']);
																		}else{echo '<script>alert("Por favor seleccione la copropiedad/unidad residencial");window.location.href = "../../publicar";</script>';  } // seleccion copropiedad propiedad
																	}else{ $copropiedad_limpio = 'NULL'; }

															    }else{$copropiedad_limpio = 'NULL';} // pertenece copropiedad propiedad

															    if (!empty($_POST['area_total_publicar_propiedad']) && $_POST['area_total_publicar_propiedad'] <> 0) {
															    	$areatotal_limpio = Limpiar::SQL_Injections($mysqli,$_POST['area_total_publicar_propiedad']);
															    	$_SESSION['publicar_propiedad'] = array('titulo_propiedad' => $_POST['titulo_publicar_propiedad'], 'matricula_inmobiliaria' => $_POST['matricula_propiedad_publicar_propiedad'], 'descripcion_propiedad' => $_POST['descripcion_publicar_propiedad'],'valor_arriendo_propiedad' => $_POST['val_arriendo_publicar_propiedad'],'valor_venta_propiedad' => $_POST['val_venta_publicar_propiedad'],'direccion_propiedad' => $_POST['direccion_publicar_propiedad'], 'area_total_propiedad' => $_POST['area_total_publicar_propiedad']);
																	if (!empty($_POST['area_bruta_publicar_propiedad']) && $_POST['area_bruta_publicar_propiedad'] <> 0) {
																		$areabruta_limpio = Limpiar::SQL_Injections($mysqli,$_POST['area_bruta_publicar_propiedad']);
																		$_SESSION['publicar_propiedad'] = array('titulo_propiedad' => $_POST['titulo_publicar_propiedad'], 'matricula_inmobiliaria' => $_POST['matricula_propiedad_publicar_propiedad'], 'descripcion_propiedad' => $_POST['descripcion_publicar_propiedad'],'valor_arriendo_propiedad' => $_POST['val_arriendo_publicar_propiedad'],'valor_venta_propiedad' => $_POST['val_venta_publicar_propiedad'],'direccion_propiedad' => $_POST['direccion_publicar_propiedad'], 'area_total_propiedad' => $_POST['area_total_publicar_propiedad'], 'area_total_bruta_propiedad' => $_POST['area_bruta_publicar_propiedad']);
																		if (!empty($_POST['parqueadero_publicar_propiedad']) && $_POST['parqueadero_publicar_propiedad'] <> 0) {
																			if ($_POST['parqueadero_publicar_propiedad'] == 1) {
																				$parqueadero_limpio = Limpiar::SQL_Injections($mysqli,$_POST['parqueadero_publicar_propiedad']);
																				if (!empty($_POST['cuarto_util_parqueadero_select']) && $_POST['cuarto_util_parqueadero_select'] <> 0) {
																					if ($_POST['cuarto_util_parqueadero_select'] == 1) {
																						$parqueadero_cuartoutil_limpio = Limpiar::SQL_Injections($mysqli,$_POST['cuarto_util_parqueadero_select']);
																					}elseif ($_POST['cuarto_util_parqueadero_select'] == 2) {
																						$parqueadero_cuartoutil_limpio = 2;
																					}else{
																						$parqueadero_cuartoutil_limpio = 'NULL';
																					}
																				}else{$parqueadero_cuartoutil_limpio = 'NULL';} // cuarto util parqueadero propiedad
																			}elseif($_POST['parqueadero_publicar_propiedad'] == 2) {
																				$parqueadero_limpio = 2;
																				$parqueadero_cuartoutil_limpio = 'NULL';
																			}else{
																				$parqueadero_limpio = 'NULL';
																				$parqueadero_cuartoutil_limpio = 'NULL';
																			}
																        }else{echo '<script>alert("Por favor seleccione si tiene parqueadero");window.location.href = "../../publicar";</script>';  } // parqueadero propiedad
																    }else{echo '<script>alert("Por favor escriba el área bruta de su propiedad");window.location.href = "../../publicar";</script>';  } // area bruta propiedad
																}else{echo '<script>alert("Por favor escriba el área total de su propiedad");window.location.href = "../../publicar";</script>';  } // area total propiedad

																if (!empty($_POST['url_video_propiedad'])) { $url_video_limpio = Limpiar::SQL_Injections($mysqli,$_POST['url_video_propiedad']); }else{ $url_video_limpio = 'NULL'; }

																if ($_POST['tipo_propiedad_publicar_propiedad'] == 3) {
																	$niveles_limpio = 0; $estrato_limpio = 0; $alcobas_limpio = 0; $banos_limpio = 0; $cocina_limpio = 'NULL'; $piso_limpio = 'NULL'; $numeropiso_limpio = 'NULL';
																}

																if (Register::Property($mysqli,1094958193,$titulo_limpio,$descripcion_limpio,$sector_limpio,$direccion_limpio,$areatotal_limpio,$areabruta_limpio,$fecha_actual,$tipopropiedad_limpio,$estrato_limpio,$cocina_limpio,$piso_limpio,1,$niveles_limpio,$numeropiso_limpio,$constructora_limpio,$alcobas_limpio,$banos_limpio,$url_video_limpio,$copropiedad_limpio,$parqueadero_limpio,$parqueadero_cuartoutil_limpio,1,'NULL','NULL',$arriendo_limpio,$venta_limpio,$matricula_limpio,$nombre_pagina)) {

																	$codigo_propiedad = Consulta::Codigo_Propiedad($mysqli,$matricula_limpio);

																	//////////////////////////////////// CONTAR IMAGENES PROPIEDAD ///////////////////////////////////////////////
															        if (mkdir($ruta_carpeta_propiedad,0777)) {
															        	if (mkdir($ruta_carpeta_propiedad_imagenes,0777)) {
															        		if (mkdir($ruta_carpeta_propiedad_documentos,0777)) {
															        			while ($inicio_img <= 20) {
																					$nombre_imagen = "img".$inicio_img;
																					if (is_uploaded_file($_FILES[$nombre_imagen]['tmp_name'])) {
																						$num_img++; 
																						if ((($_FILES[$nombre_imagen]["type"] == "image/jpeg") || ($_FILES[$nombre_imagen]["type"] == "image/png") || ($_FILES[$nombre_imagen]["type"] == "image/jpg"))) {
																							
																							if ((($_FILES[$nombre_imagen]["type"] == "image/jpeg") || ($_FILES[$nombre_imagen]["type"] == "image/jpg"))){
																		                        $new_name_img = Consulta::Codigo(11).'.jpg';
																		                        if (move_uploaded_file($_FILES[$nombre_imagen]['tmp_name'], $ruta_carpeta_propiedad_imagenes.$new_name_img)) {
																									require('../../libreria/redimensionar_imagenes/redimensionar_imagen.php');
																								}else{ $img_up_serv++; }
																						    }elseif ((($_FILES[$nombre_imagen]["type"] == "image/png"))) {
																		                        $new_name_img = Consulta::Codigo(11).'.png';
																		                        if (move_uploaded_file($_FILES[$nombre_imagen]['tmp_name'], $ruta_carpeta_propiedad_imagenes.$new_name_img)) {
																									require('../../libreria/redimensionar_imagenes/redimensionar_imagen.php');
																								}else{ $img_up_serv++; }
																						    }

																						    if (Register::Imagenes_Propiedad($mysqli,$new_name_img) == true) {
																						    	$codigo_imagen = Consulta::Codigo_Imagen($mysqli,$new_name_img);
																								if (Register::Imagenes_Propiedad_Relacion($mysqli,$codigo_propiedad,$codigo_imagen) == true) {
																									
																								}else{ $error_registrar_img_rel++;}
																							}else{$error_registrar_img++;}
																							
																						}else{$formato_img++;}

																						if ($_FILES[$nombre_imagen]["size"] >= 5 || $_FILES[$nombre_imagen]["size"] < 5 * 1000 * 1000) {}else{$size_img++;}
																					} 
																					$inicio_img++;
																				}

																				if ($size_img >= 1) { 
																					if (Delete::Property($mysqli,$matricula_limpio) == true) {
																		        		echo '<script>alert("Por favor suba imágenes que pesen menos de 5MB");window.location.href = "../../publicar";</script>'; 
																		        	}else{
																		        		echo '<script>alert("Hubo un error al eliminar el registro de la propiedad");window.location.href = "../../publicar";</script>';
																		        	}
																				} // cargar imagenes servidor

																				if ($img_up_serv >= 1) { 
																					if (Delete::Property($mysqli,$matricula_limpio) == true) {
																		        		echo '<script>alert("Hubo un error al cargar la imagen al servidor");window.location.href = "../../publicar";</script>'; 
																		        	}else{
																		        		echo '<script>alert("Hubo un error al eliminar el registro de la propiedad");window.location.href = "../../publicar";</script>';
																		        	}
																				} // cargar imagenes servidor
															        		
															        		}else{
															        			if (Delete::Property($mysqli,$matricula_limpio) == true) {
																	        		echo '<script>alert("Hubo un error al crear la carpeta de documentos de su propiedad");window.location.href = "../../publicar";</script>'; 
																	        	}else{
																	        		echo '<script>alert("Hubo un error al eliminar el registro de la propiedad");window.location.href = "../../publicar";</script>';
																	        	}	
															        		} // Crear carpeta propiedad
															        	}else{
															        		if (Delete::Property($mysqli,$matricula_limpio) == true) {
																        		echo '<script>alert("Hubo un error al crear la carpeta de imagenes de su propiedad");window.location.href = "../../publicar";</script>';  
																        	}else{
																        		echo '<script>alert("Hubo un error al eliminar el registro de la propiedad");window.location.href = "../../publicar";</script>';
																        	}	
															        	} // Crear carpeta propiedad
															        }else{
															        	if (Delete::Property($mysqli,$matricula_limpio) == true) {
															        		echo '<script>alert("Hubo un error al crear la carpeta de su propiedad");window.location.href = "../../publicar";</script>';
															        	}else{
															        		echo '<script>alert("Hubo un error al eliminar el registro de la propiedad");window.location.href = "../../publicar";</script>';
															        	}															          
															        } // Crear carpeta propiedad

															        if ($_POST['copropiedad_publicar_propiedad'] == 1) {
                                                                        //////////////////////////////////// COMODIDADES COPROPIEDAD ///////////////////////////////////////////////
																		if (!empty($_POST['nombre_copropiedad_publicar_propiedad']) && $_POST['nombre_copropiedad_publicar_propiedad'] <> 0) {

																			if ($_POST['ascensor_publicar_propiedad'] == 1) {
																				if (Register::Comodidades_Copropiedad($mysqli,$nombre_copropiedad_limpio,1) == true) {}else{echo '<script>alert("Hubo un error al registrar la comodidad de la copropiedad");window.location.href = "../../publicar";</script>';} // error comodidad propiedad
																			}

																			if ($_POST['citofono_publicar_propiedad'] == 1) {
																				if (Register::Comodidades_Copropiedad($mysqli,$nombre_copropiedad_limpio,2) == true) {}else{echo '<script>alert("Hubo un error al registrar la comodidad de la copropiedad");window.location.href = "../../publicar";</script>';} // error comodidad propiedad
																			}

																			if ($_POST['shut_basura_publicar_propiedad'] == 1) {
																				if (Register::Comodidades_Copropiedad($mysqli,$nombre_copropiedad_limpio,3) == true) {}else{echo '<script>alert("Hubo un error al registrar la comodidad de la copropiedad");window.location.href = "../../publicar";</script>';} // error comodidad propiedad
																			}

																			if ($_POST['parqueadero_visitante_publicar_propiedad'] == 1) {
																				if (Register::Comodidades_Copropiedad($mysqli,$nombre_copropiedad_limpio,4) == true) {}else{echo '<script>alert("Hubo un error al registrar la comodidad de la copropiedad");window.location.href = "../../publicar";</script>';} // error comodidad propiedad
																			}

																			if ($_POST['salon_social_publicar_propiedad'] == 1) {
																				if (Register::Comodidades_Copropiedad($mysqli,$nombre_copropiedad_limpio,5) == true) {}else{echo '<script>alert("Hubo un error al registrar la comodidad de la copropiedad");window.location.href = "../../publicar";</script>';} // error comodidad propiedad
																			}

																			if ($_POST['cancha_polideportiva_publicar_propiedad'] == 1) {
																				if (Register::Comodidades_Copropiedad($mysqli,$nombre_copropiedad_limpio,6) == true) {}else{echo '<script>alert("Hubo un error al registrar la comodidad de la copropiedad");window.location.href = "../../publicar";</script>';} // error comodidad propiedad
																			}

																			if ($_POST['zona_bbq_publicar_propiedad'] == 1) {
																				if (Register::Comodidades_Copropiedad($mysqli,$nombre_copropiedad_limpio,7) == true) {}else{echo '<script>alert("Hubo un error al registrar la comodidad de la copropiedad");window.location.href = "../../publicar";</script>';} // error comodidad propiedad
																			}

																			if ($_POST['juegos_infantiles_publicar_propiedad'] == 1) {
																				if (Register::Comodidades_Copropiedad($mysqli,$nombre_copropiedad_limpio,8) == true) {}else{echo '<script>alert("Hubo un error al registrar la comodidad de la copropiedad");window.location.href = "../../publicar";</script>';} // error comodidad propiedad
																			}

																			if ($_POST['zonas_verdes_publicar_propiedad'] == 1) {
																				if (Register::Comodidades_Copropiedad($mysqli,$nombre_copropiedad_limpio,9) == true) {}else{echo '<script>alert("Hubo un error al registrar la comodidad de la copropiedad");window.location.href = "../../publicar";</script>';} // error comodidad propiedad
																			}

																			if ($_POST['pista_trote_publicar_propiedad'] == 1) {
																				if (Register::Comodidades_Copropiedad($mysqli,$nombre_copropiedad_limpio,10) == true) {}else{echo '<script>alert("Hubo un error al registrar la comodidad de la copropiedad");window.location.href = "../../publicar";</script>';} // error comodidad propiedad
																			}

																			if ($_POST['jacuzzi_publicar_propiedad'] == 1) {
																				if (Register::Comodidades_Copropiedad($mysqli,$nombre_copropiedad_limpio,11) == true) {}else{echo '<script>alert("Hubo un error al registrar la comodidad de la copropiedad");window.location.href = "../../publicar";</script>';} // error comodidad propiedad
																			}

																			if ($_POST['turco_publicar_propiedad'] == 1) {
																				if (Register::Comodidades_Copropiedad($mysqli,$nombre_copropiedad_limpio,12) == true) {}else{echo '<script>alert("Hubo un error al registrar la comodidad de la copropiedad");window.location.href = "../../publicar";</script>';} // error comodidad propiedad
																			}

																			if ($_POST['gim_publicar_propiedad'] == 1) {
																				if (Register::Comodidades_Copropiedad($mysqli,$nombre_copropiedad_limpio,13) == true) {}else{echo '<script>alert("Hubo un error al registrar la comodidad de la copropiedad");window.location.href = "../../publicar";</script>';} // error comodidad propiedad
																			}

																			if ($_POST['piscina_publicar_propiedad'] == 1) {
																				if (Register::Comodidades_Copropiedad($mysqli,$nombre_copropiedad_limpio,14) == true) {}else{echo '<script>alert("Hubo un error al registrar la comodidad de la copropiedad");window.location.href = "../../publicar";</script>';} // error comodidad propiedad
																			}

																			if ($_POST['tv_publicar_propiedad'] == 1) {
																				if (Register::Comodidades_Copropiedad($mysqli,$nombre_copropiedad_limpio,15) == true) {}else{echo '<script>alert("Hubo un error al registrar la comodidad de la copropiedad");window.location.href = "../../publicar";</script>';} // error comodidad propiedad
																			}

																			if ($_POST['porteria_publicar_propiedad'] == 1) {
																				if (Register::Comodidades_Copropiedad($mysqli,$nombre_copropiedad_limpio,16) == true) {}else{echo '<script>alert("Hubo un error al registrar la comodidad de la copropiedad");window.location.href = "../../publicar";</script>';} // error comodidad propiedad
																			}

																		}else{echo '<script>alert("Por favor seleccione la copropiedad/unidad residencial");window.location.href = "../../publicar";</script>';  } // seleccion copropiedad propiedad
															        }

																	
																	if ($_POST['tipo_propiedad_publicar_propiedad'] <> 3) {
																		//////////////////////////////////// COMODIDADES PROPIEDAD ///////////////////////////////////////////////
																		if ($_POST['balcon_publicar_propiedad'] == 1) {
																			if (Register::Comodidades_Propiedad($mysqli,$codigo_propiedad,1) == true) {}else{echo '<script>alert("Hubo un error al registrar la comodidad de la propiedad");window.location.href = "../../publicar";</script>';} // error comodidad propiedad
																		}

																		if ($_POST['patio_publicar_propiedad'] == 1) {
																			if (Register::Comodidades_Propiedad($mysqli,$codigo_propiedad,2) == true) {}else{echo '<script>alert("Hubo un error al registrar la comodidad de la propiedad");window.location.href = "../../publicar";</script>';} // error comodidad propiedad
																		}

																		if ($_POST['biblioteca_publicar_propiedad'] == 1) {
																			if (Register::Comodidades_Propiedad($mysqli,$codigo_propiedad,3) == true) {}else{echo '<script>alert("Hubo un error al registrar la comodidad de la propiedad");window.location.href = "../../publicar";</script>';} // error comodidad propiedad
																		}

																		if ($_POST['closet_publicar_propiedad'] == 1) {
																			if (Register::Comodidades_Propiedad($mysqli,$codigo_propiedad,4) == true) {}else{echo '<script>alert("Hubo un error al registrar la comodidad de la propiedad");window.location.href = "../../publicar";</script>';} // error comodidad propiedad
																		}

																		if ($_POST['alarma_publicar_propiedad'] == 1) {
																			if (Register::Comodidades_Propiedad($mysqli,$codigo_propiedad,5) == true) {}else{echo '<script>alert("Hubo un error al registrar la comodidad de la propiedad");window.location.href = "../../publicar";</script>';} // error comodidad propiedad
																		}

																		if ($_POST['aire_acondicionado_publicar_propiedad'] == 1) {
																			if (Register::Comodidades_Propiedad($mysqli,$codigo_propiedad,6) == true) {}else{echo '<script>alert("Hubo un error al registrar la comodidad de la propiedad");window.location.href = "../../publicar";</script>';} // error comodidad propiedad
																		}

																		if ($_POST['domotica_publicar_propiedad'] == 1) {
																			if (Register::Comodidades_Propiedad($mysqli,$codigo_propiedad,7) == true) {}else{echo '<script>alert("Hubo un error al registrar la comodidad de la propiedad");window.location.href = "../../publicar";</script>';} // error comodidad propiedad
																		}

																		if ($_POST['red_gas_publicar_propiedad'] == 1) {
																			if (Register::Comodidades_Propiedad($mysqli,$codigo_propiedad,8) == true) {}else{echo '<script>alert("Hubo un error al registrar la comodidad de la propiedad");window.location.href = "../../publicar";</script>';} // error comodidad propiedad
																		}

																		if ($_POST['zona_ropa_publica_propiedad'] == 1) {
																			if (Register::Comodidades_Propiedad($mysqli,$codigo_propiedad,9) == true) {}else{echo '<script>alert("Hubo un error al registrar la comodidad de la propiedad");window.location.href = "../../publicar";</script>';} // error comodidad propiedad
																		}

																		if ($_POST['calentador_agua_publicar_propiedad'] == 1) {
																			if (Register::Comodidades_Propiedad($mysqli,$codigo_propiedad,10) == true) {}else{echo '<script>alert("Hubo un error al registrar la comodidad de la propiedad");window.location.href = "../../publicar";</script>';} // error comodidad propiedad
																		}
																	}
                                                                    
                                                                    $_SESSION['codigo_propiedad'] = $codigo_propiedad;
																	echo '<script>window.location.href = "../propiedad/crear_pagina_propiedad";</script>';

																}else{
																	echo "no registrado: ".mysqli_error($mysqli);
																}

										    			}else{echo '<script>alert("Por favor escriba la dirección de la propiedad");window.location.href = "../../publicar";</script>';  } // direccion propiedad
										    		}else{echo '<script>alert("Por favor escriba el valor de arriendo o de venta de la propiedad");window.location.href = "../../publicar";</script>';  } // valor propiedad
									            }else{echo '<script>alert("Por favor seleccione el sector a la que pertenece la propiedad");window.location.href = "../../publicar";</script>';  } // sector propiedad
									        }else{echo '<script>alert("Por favor seleccione la ciudad a la que pertenece la propiedad");window.location.href = "../../publicar";</script>';  } // ciudad propiedad
									    }else{echo '<script>alert("Por favor seleccione la provincia a la que pertenece la propiedad");window.location.href = "../../publicar";</script>';  } // provincia propiedad
									}else{echo '<script>alert("Por favor seleccione el país al que pertenece la propiedad");window.location.href = "../../publicar";</script>';  } // pais propiedad
								}else{echo '<script>alert("Por favor ingrese la descripción de la propiedad");window.location.href = "../../publicar";</script>';  } // descripcion propiedad

							}else{echo '<script>alert("Por favor seleccione el tipo de la propiedad");window.location.href = "../../publicar";</script>';  } // validar tipo propiedad
						}else{echo '<script>alert("Por favor escriba la matricula de la propiedad");window.location.href = "../../publicar";</script>';  } // validar matricula propiedad
					}else{echo '<script>alert("Por favor seleccione el tipo de propiedad");window.location.href = "../../publicar";</script>';  } // validar tipo propiedad

		desconectar();

	}else{echo '<script>alert("Por favor ingrese un título para la propiedad");window.location.href = "../../publicar";</script>';  } // validar titulo
}else{echo '<script>alert("No se envió el formulario.");window.location.href = "../../publicar";</script>';  } // boton formulario