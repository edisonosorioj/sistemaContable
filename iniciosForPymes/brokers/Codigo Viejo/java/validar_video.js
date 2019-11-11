//// FUNCION VALIDAR URL VIDEO /////////////////////////////////////////////////////////////////////////////////
function validar_video(){
        $('#cont_error_text_not_vid').fadeOut(100);
        $('#espacio_video').html("<img id='cargando_act_vid' src='./imagenes/cargando.gif'/>");

        function Url_video_pub(){
        $('#cont_error_text_not_vid').fadeOut(600);
        var url_vid = $('#fomr_pub_input_url_vid_doc_us').val();
        var https_youtube = url_vid.substr(8,15);
        var https_m_youtube = url_vid.substr(8,13);
        var https_facebook = url_vid.substr(8,16);
        var https_vimeo = url_vid.substr(8,9);
        var cod_vimeo;
        var cod_youtube;

        if (https_youtube === 'www.youtube.com' || https_m_youtube === 'm.youtube.com') {

        	    $('#cont_error_text_not_vid').css({'top':'295px'});
                $('#cont_error_text_not_titulo').css({'top':'360px'});
                $('#cont_error_text_not_txt').css({'top':'420px'});
                $('#cont_error_text_not_pais').css({'top':'810px'});
                $('#cont_error_text_not_tags').css({'top':'830px'});
                $('#cont_error_text_not_fuente').css({'top':'910px'});
                
                if (https_m_youtube === 'm.youtube.com') { cod_youtube = url_vid.substr(30,11); }else{ cod_youtube = url_vid.substr(32,11); }

                if (cod_youtube.length == 11) {}else{
                	$('#cont_error_text_not_vid').fadeIn(600);                    	
                    burbuja_error('La URL de youtube es incorrecta','#cont_error_text_not_vid',' .cont_logo_sg_dpl_comp_us_explici');
                    $('input[type="submit"]').removeAttr('disabled');
                }

                $('#espacio_video').html('<iframe id="frame_video_pub_index_youtube" src="https://www.youtube.com/embed/'+ cod_youtube +'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>');
        }else{
            if (https_facebook === 'www.facebook.com') {

            	$('#cont_error_text_not_vid').css({'top':'415px'});
                $('#cont_error_text_not_titulo').css({'top':'485px'});
                $('#cont_error_text_not_txt').css({'top':'585px'});
                $('#cont_error_text_not_pais').css({'top':'940px'});
                $('#cont_error_text_not_tags').css({'top':'960px'});
                $('#cont_error_text_not_fuente').css({'top':'1030px'});

                $('#espacio_video').html("<iframe id='frame_video_facebook_pub' src='https://www.facebook.com/plugins/video.php?href="+url_vid+"&show_text=0' width='100%' style='border:none;overflow:hidden' scrolling='no' frameborder='0' allowTransparency='true' allowFullScreen='true'></iframe>");       
            }else{
            if (https_vimeo === 'vimeo.com') {
            
                https_vimeo_a = url_vid.substr(8);
                https_vimeo_b = url_vid.substr(8,30);
            
                if (https_vimeo_b === 'vimeo.com/channels/staffpicks/') {
                    cod_vimeo = url_vid.substr(38);
                }else{
                    cod_vimeo = url_vid.substr(18);
                }

                $('#espacio_video').html('<iframe id="frame_video_pub_index_youtube" src="https://player.vimeo.com/video/'+ cod_vimeo +'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>');
            }else{
                if (url_vid === '') {
                	$('#cont_error_text_not_vid').css({'top':''});
                	$('#cont_error_text_not_titulo').css({'top':''});
                	$('#cont_error_text_not_txt').css({'top':''});
                	$('#cont_error_text_not_pais').css({'top':''});
                	$('#cont_error_text_not_tags').css({'top':''});
                	$('#cont_error_text_not_fuente').css({'top':''});

                    $('#espacio_video').html('<div class="error_vid_not_charge"><img src="../img/iconos/error.png"/><p>Por favor ingrese una URL</p></div>');
                    $('#cont_error_text_not_vid').fadeIn(600);
                    burbuja_error('Por favor ingrese una URL','#cont_error_text_not_vid',' .cont_logo_sg_dpl_comp_us_explici');
                    $('input[type="submit"]').removeAttr('disabled');
                }else{

                	$('#cont_error_text_not_vid').css({'top':''});
                	$('#cont_error_text_not_titulo').css({'top':''});
                	$('#cont_error_text_not_txt').css({'top':''});
                	$('#cont_error_text_not_pais').css({'top':''});
                	$('#cont_error_text_not_tags').css({'top':''});
                	$('#cont_error_text_not_fuente').css({'top':''});

                    $('#espacio_video').html('<div class="error_vid_not_charge"><img src="../img/iconos/error.png"/><p>Error al cargar el video, revise la URL</p></div>');
                    $('#cont_error_text_not_vid').fadeIn(600);
                    burbuja_error('Por favor escriba la URL correctamente','#cont_error_text_not_vid',' .cont_logo_sg_dpl_comp_us_explici');
                    $('input[type="submit"]').removeAttr('disabled');
                }
            }
            }
        }
        }    

        window.setTimeout( Url_video_pub, 1000 ); // 1 seconds  
}
$("#fomr_pub_input_url_vid_doc_us").bind('paste', function(e) { validar_video(); });
$("#fomr_pub_input_url_vid_doc_us").keyup(function() { validar_video(); });