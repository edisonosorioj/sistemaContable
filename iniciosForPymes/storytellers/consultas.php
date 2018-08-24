<?php
class Consulta{

    public static function Codigo_Activacion($mysqli,$codigo){
        if ($consulta = mysqli_query($mysqli, "SELECT codigo_activacion FROM tbl_usuario WHERE codigo_activacion = '.$codigo.' ")) {
            if ($resultado = mysqli_fetch_array($consulta)) { 
                return 1;
            }else{ return 2; }
        }else{ return 3; }
    }

    public static function Codigo_Activacion_Cuenta($mysqli,$usuario,$codigo){
        if ($consulta = mysqli_query($mysqli, "SELECT documento,codigo_activacion,estado FROM tbl_usuario WHERE documento = ".$usuario." AND codigo_activacion= '".$codigo."'")) {
            if ($resultado = mysqli_fetch_array($consulta)) { return true; }else{ return false; }
        }
    }

    public static function Codigo($longitud) {
     $key = ''; $pattern = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_'; $max = strlen($pattern)-1; for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)}; return $key;
    }

    public static function Correo($mysqli, $correo){
        if ($consulta = mysqli_query($mysqli, "SELECT email FROM tbl_usuario WHERE email = '".$correo."' ")) {
            if ($resultado = mysqli_fetch_array($consulta)) { return true; }else{ return false; }
        }else{ return 1; }
    }

    public static function Cod_Pais($mysqli,$cod_departamento){
        if ($consulta = mysqli_query($mysqli, "SELECT pais FROM tbl_provincia WHERE codigo = '".$cod_departamento."' ")) {
            if ($resultado = mysqli_fetch_array($consulta)) { return $resultado['pais']; }else{ return 1;}
        }else{return 2;}
    }

    public static function Cod_Departamento($mysqli,$cod_ciudad){
        if ($consulta = mysqli_query($mysqli, "SELECT provincia FROM tbl_ciudad WHERE codigo = '".$cod_ciudad."' ")) {
            if ($resultado = mysqli_fetch_array($consulta)) { return $resultado['provincia']; }else{ return 1;}
        }else{return 2;}
    }

    public static function Cod_Ciudad($mysqli,$cod_sector){
        if ($consulta = mysqli_query($mysqli,"SELECT ciudad FROM tbl_sector_barrio WHERE codigo = '".$cod_sector."' ")) {
            if ($resultado = mysqli_fetch_array($consulta)) { return $resultado['ciudad']; }else{return false;}
        }else{return false;}
    }

    public static function Nombre_Tabla($mysqli,$tabla,$condicion,$parametro){
        if ($consulta = mysqli_query($mysqli,"SELECT nombre FROM ".$tabla." WHERE ".$condicion." = '".$parametro."' ")) {
            if ($resultado = mysqli_fetch_array($consulta)) { return $resultado['nombre']; }else{return false;}
        }else{return false;}
    }

    public static function Comodidades_Propiedad($mysqli,$codigo_propiedad){
        if ($consulta = mysqli_query($mysqli,"SELECT codigo_comodidad_propiedad FROM tbl_propiedad_comodidad_propiedad WHERE codigo_propiedad = '".$codigo_propiedad."' ")) {
            if ($resultado = mysqli_fetch_array($consulta)) {
                $inicio = 0;
                do{
                    $comodidades_propiedad[$inicio] = $resultado['codigo_comodidad_propiedad'];
                    $inicio++;
                }while ($resultado = mysqli_fetch_array($consulta));
                return $comodidades_propiedad;
            }
        }
    }

    public static function Comodidades_Copropiedad($mysqli,$codigo_copropiedad){
        if ($consulta = mysqli_query($mysqli,"SELECT codigo_comodidad_copropiedad FROM tbl_copropiedad_comodidades_copropiedad WHERE codigo_comodidad_copropiedad = '".$codigo_copropiedad."' ")) {
            if ($resultado = mysqli_fetch_array($consulta)) {
                $inicio = 0;
                do{
                    $comodidades_propiedad[$inicio] = $resultado['codigo_comodidad_propiedad'];
                    $inicio++;
                }while ($resultado = mysqli_fetch_array($consulta));
                return $comodidades_propiedad;
            }
        }
    }

    public static function Con_Propiedad($mysqli,$cod_ciudad){
        if ($consulta = mysqli_query($mysqli, "SELECT p.titulo as titulo, c.nombre as ciudad, pr.nombre as provincia, valor_arriendo, valor_venta, p.descripcion as descripcion, p.codigo as cod_propiedad, p.nombre_carpeta as nombre_carpeta FROM tbl_propiedad p 
            INNER JOIN tbl_sector_barrio sb ON p.sector_barrio = sb.codigo 
            INNER JOIN tbl_ciudad c ON sb.ciudad = c.codigo
            INNER JOIN tbl_provincia pr ON c.provincia = pr.codigo
            WHERE sb.ciudad = '".$cod_ciudad."' ")) {
            $suma = 1;
            if ($resultado = mysqli_fetch_array($consulta)) {

                do{
                    $resultado_cons[$suma][0] = $resultado['titulo'];
                    $resultado_cons[$suma][1] = $resultado['ciudad'];
                    $resultado_cons[$suma][2] = $resultado['provincia'];
                    $resultado_cons[$suma][3] = $resultado['valor_arriendo'];
                    $resultado_cons[$suma][4] = $resultado['valor_venta'];
                    $resultado_cons[$suma][5] = $resultado['descripcion'];
                    $resultado_cons[$suma][6] = $resultado['cod_propiedad'];
                    $resultado_cons[$suma][7] = $resultado['nombre_carpeta'];
                    $suma++;
                }while ($resultado = mysqli_fetch_assoc($consulta));
                return $resultado_cons;
            }else{return false;
            }

        }else{return 2;}
    }

    public static function Imagenes_Propiedad($mysqli,$propiedad){
        if ($consulta = mysqli_query($mysqli,"SELECT codigo_imagen FROM tbl_imagen_propiedad WHERE codigo_propiedad = '".$propiedad."' ")) {
            if ($resultado = mysqli_fetch_array($consulta)) {
                $n_img = 0;
                do{
                    if ($consulta_img = mysqli_query($mysqli,"SELECT nombre FROM tbl_imagen WHERE codigo = '".$resultado['codigo_imagen']."' ")) {
                        if ($resultado_img = mysqli_fetch_array($consulta_img)) {
                            $resultado_imagenes[$n_img] = $resultado_img['nombre'];
                        }
                    }
                    $n_img++;
                }while($resultado = mysqli_fetch_array($consulta));


                return $resultado_imagenes;
            }
        }        
    }


    public static function Informacion_Propiedad($mysqli,$codigo_propiedad){
        if ($consulta = mysqli_query($mysqli,"SELECT tbl_propiedad.titulo, tbl_propiedad.descripcion, tbl_sector_barrio.nombre as 'sector_barrio', tbl_propiedad.direccion, tbl_propiedad.area_total, tbl_propiedad.area_construida, tbl_propiedad.fecha_registro_propiedad, tbl_tipo_propiedad.nombre as 'tipo_propiedad', tbl_propiedad.estrato, tbl_propiedad.numero_niveles, tbl_propiedad.numero_piso, tbl_propiedad.numero_alcoba, tbl_propiedad.numero_bano, tbl_propiedad.video, tbl_propiedad.parqueadero, tbl_propiedad.cuarto_util_parqueadero, tbl_propiedad.valor_arriendo, tbl_propiedad.valor_venta, tbl_propiedad.tipo_cocina, tbl_propiedad.tipo_piso, tbl_propiedad.constructora, tbl_propiedad.copropiedad, tbl_propiedad.nombre_carpeta, tbl_propiedad.codigo as 'codigo_propiedad', tbl_propiedad.sector_barrio as 'sector_propiedad' FROM tbl_propiedad INNER JOIN tbl_sector_barrio ON tbl_propiedad.sector_barrio = tbl_sector_barrio.codigo
            INNER JOIN tbl_tipo_propiedad ON tbl_propiedad.tipo_propiedad = tbl_tipo_propiedad.codigo
            WHERE tbl_propiedad.codigo = '".$codigo_propiedad."' ")) {
            if ($resultado = mysqli_fetch_array($consulta)) {
                
                $informacion_propiedad[0] = $resultado['titulo'];
                $informacion_propiedad[1] = $resultado['descripcion'];
                $informacion_propiedad[2] = $resultado['sector_barrio'];
                $informacion_propiedad[3] = $resultado['direccion'];
                $informacion_propiedad[4] = $resultado['area_total'];
                $informacion_propiedad[5] = $resultado['area_construida'];
                $informacion_propiedad[6] = $resultado['fecha_registro_propiedad'];
                $informacion_propiedad[7] = $resultado['tipo_propiedad'];
                $informacion_propiedad[8] = $resultado['estrato'];
                $informacion_propiedad[9] = $resultado['numero_niveles'];
                $informacion_propiedad[10] = $resultado['numero_piso'];
                $informacion_propiedad[11] = $resultado['numero_alcoba'];
                $informacion_propiedad[12] = $resultado['numero_bano'];
                $informacion_propiedad[13] = $resultado['video'];
                $informacion_propiedad[14] = $resultado['parqueadero'];
                $informacion_propiedad[15] = $resultado['cuarto_util_parqueadero'];
                $informacion_propiedad[16] = $resultado['valor_arriendo'];
                $informacion_propiedad[17] = $resultado['valor_venta'];

                $informacion_propiedad[18] = $resultado['tipo_cocina'];
                $informacion_propiedad[19] = $resultado['tipo_piso'];
                $informacion_propiedad[20] = $resultado['constructora'];
                $informacion_propiedad[21] = $resultado['copropiedad'];

                $informacion_propiedad[22] = $resultado['nombre_carpeta'];
                $informacion_propiedad[23] = $resultado['codigo_propiedad'];

                $informacion_propiedad[24] = $resultado['sector_propiedad'];

                return $informacion_propiedad;

            }else{return false;}
        }else{return false;}
    }

    
    public static function Tipo_Cocina($mysqli,$codigo){
        if ($consulta = mysqli_query($mysqli,"SELECT nombre FROM tbl_cocina WHERE codigo = '".$codigo."'")) {
            if ($resultado = mysqli_fetch_array($consulta)) {
                return $resultado['nombre'];
            }else{
                return false;
            }
        }
    }

    public static function Tipo_Piso($mysqli,$codigo){
        if ($consulta = mysqli_query($mysqli,"SELECT nombre FROM tbl_piso WHERE codigo = '".$codigo."'")) {
            if ($resultado = mysqli_fetch_array($consulta)) {
                return $resultado['nombre'];
            }else{
                return false;
            }
        }
    }

    public static function Tipo_Constructora($mysqli,$codigo){
        if ($consulta = mysqli_query($mysqli,"SELECT nombre FROM tbl_constructora WHERE codigo = '".$codigo."'")) {
            if ($resultado = mysqli_fetch_array($consulta)) {
                return $resultado['nombre'];
            }else{
                return false;
            }
        }
    }

    public static function Tipo_Copropiedad($mysqli,$codigo){
        if ($consulta = mysqli_query($mysqli,"SELECT nombre FROM tbl_copropiedad WHERE codigo = '".$codigo."'")) {
            if ($resultado = mysqli_fetch_array($consulta)) {
                return $resultado['nombre'];
            }else{
                return false;
            }
        }
    }

    public static function Codigo_Propiedad($mysqli,$matricula){
        if ($consulta = mysqli_query($mysqli,"SELECT codigo FROM tbl_propiedad WHERE numero_matricula_inmobiliaria = '".$matricula."' ")) {
            if ($resultado = mysqli_fetch_array($consulta)) {
                return $resultado['codigo'];
            }else{
                return false;
            }
        }
    }

    public static function Codigo_Imagen($mysqli,$codigo_imagen){
        if ($consulta = mysqli_query($mysqli, "SELECT codigo FROM tbl_imagen WHERE nombre = '".$codigo_imagen."' ")) {
            if ($resultado = mysqli_fetch_array($consulta)) {
                return $resultado['codigo'];
            }else{
                return false;
            }
        }
    }

    public static function Estado_Cuenta($mysqli,$condicion,$parametro){
        if ($consulta = mysqli_query($mysqli, "SELECT estado FROM tbl_usuario WHERE ".$condicion." = '".$parametro."' ")) {
            if ($resultado = mysqli_fetch_array($consulta)) {
                if ($resultado['estado'] == 0) { return true; }elseif ($resultado['estado'] == 1) { return false; }
            }
        }
    }

    public static function Informacion_Usuario($mysqli,$campo,$condicion,$parametro){
        if ($consulta = mysqli_query($mysqli, "SELECT ".$campo." FROM tbl_usuario WHERE ".$condicion." = '".$parametro."' ")) {
            if ($resultado = mysqli_fetch_array($consulta)) {
                return $resultado[$campo];
            }else{return 1;}
        }else{return 2;}
    }

    public static function Password_Usuario($mysqli,$correo){
        if ($consulta = mysqli_query($mysqli,"SELECT clave FROM tbl_usuario WHERE email = '".$correo."' ")) {
            if ($resultado = mysqli_fetch_array($consulta)) {
                return $resultado['clave'];
            }else{return 1;}
        }else{return 2;}
    }

    public static function Password($password){ $password = password_hash($password, PASSWORD_DEFAULT); return $password;  }

    public static function Ingresar($mysqli,$correo,$password){
        if (self::Password_Usuario($mysqli,$correo) <> 2 ) {
            if (self::Password_Usuario($mysqli,$correo) <> 1) {
                $password_hash = self::Password_Usuario($mysqli,$correo);
                if (password_verify($password, $password_hash)) { 
                    if ($consulta = mysqli_query($mysqli, 'SELECT tbl_usuario.documento,tbl_usuario.imagen_perfil,tbl_usuario.fecha_expedicion,tbl_usuario.nombres,tbl_usuario.apellidos,tbl_usuario.email,tbl_usuario.fecha_nacimiento,tbl_usuario.ciudad,tbl_usuario.tel_movil,tbl_usuario.tel_fijo,tbl_usuario.tel_alternativo,tbl_usuario.direccion,tbl_usuario.situacion_laboral,tbl_usuario.empresa_trabajo,tbl_usuario.numero_personas_acargo,tbl_usuario.profesion,tbl_usuario.estado,tbl_tipo_documento.nombre as tipo_doc,tbl_ciudad.nombre as ciudad_doc,tbl_rol.nombre as rol_nombre, tbl_genero.nombre as genero, tbl_estado_civil.nombre as estado_civil FROM tbl_usuario INNER JOIN tbl_tipo_documento ON tbl_usuario.tipo_documento = tbl_tipo_documento.codigo
                        INNER JOIN tbl_rol ON tbl_usuario.rol = tbl_rol.codigo
                        INNER JOIN tbl_ciudad ON tbl_usuario.lugar_expedicion = tbl_ciudad.codigo
                        INNER JOIN tbl_genero ON tbl_usuario.genero = tbl_genero.codigo
                        INNER JOIN tbl_estado_civil ON tbl_usuario.estado_civil = tbl_estado_civil.codigo
                        WHERE email = "'.$correo.'"')) {
                        if ($resultado = mysqli_fetch_array($consulta)) {
                            if ($resultado['estado'] == 1) {

                                $_SESSION["doc"]=$resultado["documento"];
                                $_SESSION["imagen_perfil"]=$resultado["imagen_perfil"];
                                $_SESSION["nombres"]=$resultado["nombres"];
                                $_SESSION["apellidos"]=$resultado["apellidos"];
                                $_SESSION["tipo_documento"]=$resultado["tipo_doc"];
                                $_SESSION["ciudad_doc"]=$resultado["ciudad_doc"];
                                $_SESSION["rol_nombre"]=$resultado["rol_nombre"];
                                $_SESSION["fecha_expedicion"]=$resultado["fecha_expedicion"];
                                $_SESSION["fecha_nacimiento"]=$resultado["fecha_nacimiento"];
                                $_SESSION["genero"]=$resultado["genero"];
                                $_SESSION["correo"]=$resultado['email'];
                                $_SESSION["tel_movil"]=$resultado['tel_movil'];
                                $_SESSION["tel_fijo"]=$resultado['tel_fijo'];
                                $_SESSION["tel_alternativo"]=$resultado['tel_alternativo'];
                                $_SESSION["direccion"]=$resultado['direccion'];
                                $_SESSION["profesion"]=$resultado['profesion'];
                                $_SESSION["situacion_laboral"]=$resultado['situacion_laboral'];
                                $_SESSION["estado_civil"]=$resultado['estado_civil'];
                                $_SESSION["empresa_trabajo"]=$resultado['empresa_trabajo'];
                                $_SESSION["numero_personas_acargo"]=$resultado['numero_per_acargo'];
                                $_SESSION['cod_ciudad_res_us']=$resultado['ciudad'];

                                if (self::Cod_Departamento($mysqli, $resultado['ciudad']) === 1) { return "error 1"; }elseif (self::Cod_Departamento($mysqli, $resultado['ciudad']) === 2) { return "error 2"; }else{$cod_departamento = self::Cod_Departamento($mysqli, $resultado['ciudad']); $_SESSION['cod_departamento_res_us']=$cod_departamento;}
                                if (self::Cod_Pais($mysqli, $cod_departamento) === 1) { return "error 1"; }elseif (self::Cod_Pais($mysqli, $cod_departamento) === 2) { return "error 2"; }else{ $cod_pais = self::Cod_Pais($mysqli, $cod_departamento); $_SESSION['cod_pais_res_us']=$cod_pais;}

                                return "msn=1";

                            }elseif ($resultado['estado'] == 0) {return "msn=2";}else{return "msn=3";}
                        }else{return "msn=4";}
                    }else{return "msn=5";} 
                }else{ return "msn=7"; }
            }else{ return "msn=8"; }
        }else{ return "msn=9"; }
    }

//////////////////////////// END OF CLASS //////////////////////////////////////////////////////    
}
//////////////////////////// END OF CLASS //////////////////////////////////////////////////////