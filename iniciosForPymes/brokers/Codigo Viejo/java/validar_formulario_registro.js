    function ocultar_burbujas(){ $('#cont_error_genero_reg_us').fadeOut(600);$('#cont_error_ciudad_expedicion_doc_reg_us').fadeOut(600);$('#cont_error_departamento_expedicion_doc_reg_us').fadeOut(600);$('#cont_error_pais_expedicion_doc_reg_us').fadeOut(600);$('#cont_error_fecha_expedicion_doc_reg_us').fadeOut(600);$('#cont_error_tipo_doc_reg_us').fadeOut(600);$('#cont_error_documento_reg_us').fadeOut(600);$("#cont_error_nombre_reg_us").fadeOut(600);$('#cont_error_apellido_reg_us').fadeOut(600);$('#cont_error_clave_reg_us').fadeOut(600);$('#cont_error_conf_clave_reg_us').fadeOut(600);$('#cont_error_email_reg_us').fadeOut(600);$('#cont_error_conf_email_reg_us').fadeOut(600);$('#cont_error_fecha_reg_us').fadeOut(600);$('#cont_error_pais_reg_us').fadeOut(600);$('#cont_error_departamento_reg_us').fadeOut(600);$('#cont_error_ciudad_reg_us').fadeOut(600);$('#cont_error_dir_reg_us').fadeOut(600); }
    function desplegar_acordeon(val){$( "#accordion" ).accordion({ active: val });}

    $("#formulario_registro_usuario").submit(function() {
        var tipo_documento = $("#tipo_documento").val();
        var documento_us = $("#documento_us").val();
        var fecha_expedicion_doc = $("#fecha_expedicion_doc").val();
        var pais_us_doc = $("#pais_expedicion_cargar_departamento").val();
        var departamento_us_doc = $("#departamento_expedicion_cargar_ciudad").val();
        var ciudad_us_doc = $("#cargar_expedicion_ciudad").val();
        var nombres_us = $("#nombres_us").val();
        var apellidos_us = $("#apellidos_us").val();
        var pass = $("#pass").val();
        var pass1 = $("#pass1").val();
        var email_us = $("#email_us").val();
        var conf_email_us = $("#conf_email_us").val();
        var fecha_nacimiento = $("#fecha_nacimiento").val();
        var pais_us = $("#pais_cargar_departamento").val();
        var departamento_us = $("#departamento_cargar_ciudad").val();
        var ciudad_us = $("#cargar_ciudad").val();
        var dir_us = $("#dir_us").val();
        var genero_us = $("#genero_us").val();

        if (tipo_documento == '' || tipo_documento == 0) {
            ocultar_burbujas(); desplegar_acordeon(0);
            burbuja_error('Por seleccione el tipo de documento','#cont_error_tipo_doc_reg_us','#formulario_registro_usuario');
            $("#tipo_documento").focus();
            return false;
        }else{
            if (documento_us == '' || documento_us == 0) {
                ocultar_burbujas(); desplegar_acordeon(0);
                burbuja_error('Por favor digite su número de documento','#cont_error_documento_reg_us','#formulario_registro_usuario');
                $("#documento_us").focus();
                return false;
            }else{
                if (documento_us.length <= 4 || documento_us.length > 15) {
                    ocultar_burbujas(); desplegar_acordeon(0);
                    burbuja_error('Su número de documento debe contener mínimo 5 caracteres, máximo 15','#cont_error_documento_reg_us','#formulario_registro_usuario');
                    $("#documento_us").focus();
                    return false;
                }else{
                    if (fecha_expedicion_doc == '' || fecha_expedicion_doc == 0) {
                        ocultar_burbujas(); desplegar_acordeon(0);
                        burbuja_error('Por ingrese a fecha de expedicion del documento','#cont_error_fecha_expedicion_doc_reg_us','#formulario_registro_usuario');
                        $("#fecha_expedicion_doc").focus();
                        return false;
                    }else{
                        if (pais_us_doc == '' || pais_us_doc == 0) {
                            ocultar_burbujas(); desplegar_acordeon(0);
                            burbuja_error('Por seleccione el pais de expedicion del documento','#cont_error_pais_expedicion_doc_reg_us','#formulario_registro_usuario');
                            $("#pais_us_doc").focus();
                            return false;
                        }else{
                            if (departamento_us_doc == '' || departamento_us_doc == 0) {
                                ocultar_burbujas(); desplegar_acordeon(0);
                                burbuja_error('Por seleccione el departamento de expedicion del documento','#cont_error_departamento_expedicion_doc_reg_us','#formulario_registro_usuario');
                                $("#departamento_us_doc").focus();
                                return false;
                            }else{
                                if (ciudad_us_doc == '' || ciudad_us_doc == 0) {
                                    ocultar_burbujas(); desplegar_acordeon(0);
                                    burbuja_error('Por seleccione la ciudad de expedicion del documento','#cont_error_ciudad_expedicion_doc_reg_us','#formulario_registro_usuario');
                                    $("#ciudad_us_doc").focus();
                                    return false;
                                }else{
                                    if (nombres_us == '' || nombres_us == 0) {
                                        ocultar_burbujas(); desplegar_acordeon(1);
                                        burbuja_error('Por favor digite su nombre correctamente','#cont_error_nombre_reg_us','#formulario_registro_usuario');
                                        $("#nombres_us").focus();
                                        return false;
                                    }else{
                                        if (nombres_us.length <= 2 || nombres_us.length > 30) {
                                            ocultar_burbujas(); desplegar_acordeon(1);
                                            burbuja_error('Su nombre debe contener mínimo 3 caracteres, máximo 30','#cont_error_nombre_reg_us','#formulario_registro_usuario');
                                            $("#nombres_us").focus();
                                            return false;
                                        }else{
                                            if (apellidos_us == '' || apellidos_us == 0) {
                                                ocultar_burbujas(); desplegar_acordeon(1);
                                                burbuja_error('Por favor digite su apellido correctamente','#cont_error_apellido_reg_us','#formulario_registro_usuario');
                                                $("#apellidos_us").focus();
                                                return false;
                                            }else{
                                                if (apellidos_us.length <= 2 || apellidos_us.length > 30) {
                                                    ocultar_burbujas(); desplegar_acordeon(1);
                                                    burbuja_error('Su apellido debe contener mínimo 3 caracteres, máximo 30','#cont_error_apellido_reg_us','#formulario_registro_usuario');
                                                    $("#apellidos_us").focus();
                                                    return false;
                                                }else{
                                                    if (pass == '' || pass == 0) {
                                                        ocultar_burbujas(); desplegar_acordeon(1);
                                                        burbuja_error('Por favor digite su clave correctamente','#cont_error_clave_reg_us','#formulario_registro_usuario');
                                                        $("#pass").focus();
                                                        return false;
                                                    }else{
                                                        if (pass.length <= 3 || pass.length > 10) {
                                                            ocultar_burbujas(); desplegar_acordeon(1);
                                                            burbuja_error('Su clave debe contener mínimo 4 caracteres, máximo 10','#cont_error_clave_reg_us','#formulario_registro_usuario');
                                                            $("#pass").focus();
                                                            return false;
                                                        }else{
                                                            if (pass1 == '' || pass1 == 0) {
                                                                ocultar_burbujas(); desplegar_acordeon(1);
                                                                burbuja_error('Por favor digite su confirmación de clave correctamente','#cont_error_conf_clave_reg_us','#formulario_registro_usuario');
                                                                $("#pass1").focus();
                                                                return false;
                                                            }else{
                                                                if (pass1.length <= 3 || pass1.length > 10) {
                                                                    ocultar_burbujas(); desplegar_acordeon(1);
                                                                    burbuja_error('Su confirmación de clave debe contener mínimo 4 caracteres, máximo 10','#cont_error_conf_clave_reg_us','#formulario_registro_usuario');
                                                                    $("#pass1").focus();
                                                                    return false;
                                                                }else{
                                                                    if (email_us == '' || email_us == 0 || email_us.indexOf('@') == false) {
                                                                        ocultar_burbujas(); desplegar_acordeon(1);
                                                                        burbuja_error('Por favor digite su correo electrónico correctamente','#cont_error_email_reg_us','#formulario_registro_usuario');
                                                                        $("#email_us").focus();
                                                                        return false;
                                                                    }else{
                                                                        if (email_us.length <= 4 || email_us.length > 50) {
                                                                            ocultar_burbujas(); desplegar_acordeon(1);
                                                                            burbuja_error('Su correo electrónico debe contener mínimo 5 caracteres, máximo 50','#cont_error_email_reg_us','#formulario_registro_usuario');
                                                                            $("#email_us").focus();
                                                                            return false;
                                                                        }else{
                                                                            if (conf_email_us == '' || conf_email_us == 0 || conf_email_us.indexOf('@') == false) {
                                                                                ocultar_burbujas(); desplegar_acordeon(1);
                                                                                burbuja_error('Por favor digite su confirmación de correo electrónico correctamente','#cont_error_conf_email_reg_us','#formulario_registro_usuario');
                                                                                $("#conf_email_us").focus();
                                                                                return false;
                                                                            }else{
                                                                                if (conf_email_us.length <= 4 || conf_email_us.length > 50) {
                                                                                    ocultar_burbujas(); desplegar_acordeon(1);
                                                                                    burbuja_error('Su confirmación de correo electrónico debe contener mínimo 5 caracteres, máximo 50','#cont_error_conf_email_reg_us','#formulario_registro_usuario');
                                                                                    $("#conf_email_us").focus();
                                                                                    return false;
                                                                                }else{
                                                                                    if (fecha_nacimiento == '') {
                                                                                        ocultar_burbujas(); desplegar_acordeon(1);
                                                                                        burbuja_error('Por favor seleccione su fecha de nacimiento','#cont_error_fecha_reg_us','#formulario_registro_usuario');
                                                                                        $("#fecha_nacimiento").focus();
                                                                                        return false;
                                                                                    }else{
                                                                                        if (pais_us == '0' || pais_us == '') {
                                                                                            ocultar_burbujas(); desplegar_acordeon(1);
                                                                                            burbuja_error('Por favor seleccione su país de residencia','#cont_error_pais_reg_us','#formulario_registro_usuario');
                                                                                            $("#pais_us").focus();
                                                                                            return false;
                                                                                        }else{
                                                                                            if (departamento_us == '0' || departamento_us == '') {
                                                                                                ocultar_burbujas(); desplegar_acordeon(1);
                                                                                                burbuja_error('Por favor seleccione su departamento de residencia','#cont_error_departamento_reg_us','#formulario_registro_usuario');
                                                                                                $("#departamento_us").focus();
                                                                                                return false;
                                                                                            }else{
                                                                                                if (ciudad_us == '0' || ciudad_us == '') {
                                                                                                    ocultar_burbujas(); desplegar_acordeon(1);
                                                                                                    burbuja_error('Por favor seleccione su ciudad de residencia','#cont_error_ciudad_reg_us','#formulario_registro_usuario');
                                                                                                    $("#ciudad_us").focus();
                                                                                                    return false;
                                                                                                }else{
                                                                                                    if (genero_us == '0' || genero_us == '') {
                                                                                                        ocultar_burbujas(); desplegar_acordeon(1);
                                                                                                        burbuja_error('Por favor seleccione su genero','#cont_error_genero_reg_us','#formulario_registro_usuario');
                                                                                                        $("#genero_us").focus();
                                                                                                        return false;  
                                                                                                    }else{
                                                                                                        if (dir_us == '' || dir_us == 0) {
                                                                                                            ocultar_burbujas(); desplegar_acordeon(2);
                                                                                                            burbuja_error('Por favor digite la dirección donde reside','#cont_error_dir_reg_us','#formulario_registro_usuario');
                                                                                                            $("#dir_us").focus();
                                                                                                            return false;
                                                                                                        }else{
                                                                                                            if (dir_us.length <= 4 || dir_us.length > 255) {
                                                                                                                ocultar_burbujas(); desplegar_acordeon(2);
                                                                                                                burbuja_error('Su dirección de residencia debe contener mínimo 5 caracteres, máximo 255','#cont_error_dir_reg_us','#formulario_registro_usuario');
                                                                                                                $("#dir_us").focus();
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
        }
    });