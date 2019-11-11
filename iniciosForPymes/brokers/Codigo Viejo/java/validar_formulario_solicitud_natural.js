
    function ocultar_burbujas(){$('#cont_error_cod_uno_tipo_doc').fadeOut(600);}
    $("#form_solicitud_arrendamiento").submit(function(){
        var tipo_doc_cod_uno = $("#tipo_doc_cod_uno").val();
        var numero_doc_codeudor_uno = $("#numero_doc_codeudor_uno").val();
        var lugar_expedicion_codeudor_uno = $("#lugar_expedicion_codeudor1_solicitante").val();
        var fecha_expedicion_codeudor_uno = $("#fecha_expedicion_codeudor1_solicitante").val();
        var nombre_codeudor_uno = $("#nombre_codeudor_uno").val();
        var apellidos_codeudor1_solicitante = $("#apellidos_codeudor1_solicitante").val();
        var tel_codeudor_uno = $("#tel_codeudor_uno").val();
        var trabaja_codeudor_uno = $("#trabaja_codeudor_uno").val();
        var info_trabajo_codeudor1_solicitante = $("#info_trabajo_codeudor1_solicitante").val();
        var nombre_empresa_em_codeudor = $("#nombre_empresa_em_codeudor").val();
        var telefono_oficina_labora_codeudor1 = $("#telefono_oficina_labora_codeudor1").val();
        var ciudad_codeudor_uno_trabajo_em = $("#ciudad_codeudor_uno_trabajo_em").val();
        var salario_trabajo_codeudor_uno_solicitante = $("#salario_trabajo_codeudor_uno_solicitante").val();
        var egreso_em_codeudor_uno= $("#egreso_em_codeudor_uno").val();
        var dir_em_codeudor_uno = $("#dir_em_codeudor_uno").val();
        var profesion_codeudor_uno= $("#profesion_codeudor_uno").val();
        var fecha_ingreso_coddeudor_uno = $("#fecha_ingreso_coddeudor_uno").val();
        var select_actividad_economica_codeudor_uno = $("#select_actividad_economica_codeudor_uno").val();
        var des_actividad_economica_otro = $("#des_actividad_economica_otro").val();
        var nombre_empresa_in_codeudor_uno = $("#nombre_empresa_in_codeudor_uno").val();
        var desc_in_codeudor_uno = $("#desc_in_codeudor_uno").val();
        var dir_empresa_codeudor_uno_id = $("#dir_empresa_codeudor_uno_id").val();
        var ciudad_codeudor_uno_in = $("#ciudad_codeudor_uno_in").val();
        var ingreso_codeudor_uno_independiente = $("#ingreso_codeudor_uno_independiente").val();
        var egresos_codeudor_uno_in = $("#egresos_codeudor_uno_in").val();
        var tipo_doc_codeudor2_solicitante = $("#tipo_doc_codeudor2_solicitante").val();
        var numero_doc_codeudor2_solicitante = $("#numero_doc_codeudor2_solicitante").val();
        var lugar_expedicion_codeudor2_solicitante = $("#lugar_expedicion_codeudor2_solicitante").val();
        var fecha_expedicion_codeudor2_solicitante = $("#fecha_expedicion_codeudor2_solicitante").val();
        var apellidos_codeudo2_solicitante = $("#apellidos_codeudo2_solicitante").val();
        var nombres_codeudor2_solicitante = $("#nombres_codeudor2_solicitante").val();
        var telefono_per_codeudor2 = $("#telefono_per_codeudor2").val();
        var trabajo_codeudor2_solicitante= $("#trabajo_codeudor2_solicitante").val();
        var nombre_empresa_codeudor_dos_em = $("#nombre_empresa_codeudor_dos_em").val();
        var tel_empresa_codeudor_dos_em = $("#tel_empresa_codeudor_dos_em").val();
        var ciudad_codeudor_dos_trabajo_em = $("#ciudad_codeudor_dos_trabajo_em").val();
        var salario_trabajo_codeudor2_solicitante = $("#salario_trabajo_codeudor2_solicitante").val();
        var egresos_codeudor_dos_em = $("#egresos_codeudor_dos_em").val();
        var dir_trabajocodeudor2_solicitante = $("#dir_trabajocodeudor2_solicitante").val();
        var profesion_codeudor_dos_em = $("#profesion_codeudor_dos_em").val();
        var fecha_ingreso_coddeudor_dos = $("#fecha_ingreso_coddeudor_dos").val();
        var select_actividad_economica_codeudor_dos = $("#select_actividad_economica_codeudor_dos").val();
        var descripcion_negocio_independiente_dos = $("#descripcion_negocio_independiente_dos").val();
        var tel_independiente_codeudor_dos = $("#tel_independiente_codeudor_dos").val();
        var dir_empresa_codeudor_dos = $("#dir_empresa_codeudor_dos").val();
        var ciudad_codeudor_dos = $("#ciudad_codeudor_dos").val();
        var ingresos_independiente_codeudor_dos = $("#ingresos_independiente_codeudor_dos").val();
        var egreso_independiente_codeudor_dos = $("#egreso_independiente_codeudor_dos").val();
        var nombres_apellidos_referencia_par = $("#nombres_apellidos_referencia_par").val();
        var dir_referencias_particulares = $("#dir_referencias_particulares").val();
        var telefono_referencias_particulares = $("#telefono_referencias_particulares").val();
        var ciudad_referencias_particulares = $("#ciudad_referencias_particulares").val();
        var parentesco_referencia_particular = $("#parentesco_referencia_particular").val();
        var nombres_apellidos_referencia_familiar = $("#nombres_apellidos_referencia_familiar").val();
        var dir_referencias_familiar = $("#dir_referencias_familiar").val();
        var tel_referencia_familiar = $("#tel_referencia_familiar").val();
        var ciudad_referencias_familiares = $("#ciudad_referencias_familiares").val();
        var perentesco_referencia_familiar = $("#perentesco_referencia_familiar").val();
        if (tipo_doc_cod_uno == '') {
            ocultar_burbujas();
            burbuja_error('Por seleccione el tipo de documento','#cont_error_cod_uno_tipo_doc','#codeudor_uno_solicitante');
            $("#tipo_doc_cod_uno").focus();
            return false;
        }else{
            return false;
        }
       
    });
