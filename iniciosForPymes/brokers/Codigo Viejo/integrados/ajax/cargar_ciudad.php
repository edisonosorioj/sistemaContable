<?php 
header("Access-Control-Allow-Origin: *");
require('../conexion/config.php');
require('../limpiadores.php');
conectar();
$lugar= Limpiar::SQL_Injections($mysqli, $_POST["departamento"]);
$consulta=mysqli_query($mysqli, "SELECT * FROM tbl_ciudad where provincia='".$lugar."'");
echo '<option value="0" selected>Seleccione una Ciudad</option>';
while ($resultado=mysqli_fetch_row($consulta)) { ?><option value="<?php echo $resultado[0] ?>"><?php echo $resultado[1] ?></option><?php }
desconectar();
?>