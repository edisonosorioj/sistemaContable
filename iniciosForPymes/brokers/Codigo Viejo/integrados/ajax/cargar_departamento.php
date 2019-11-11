<?php 
header("Access-Control-Allow-Origin: *");
require('../conexion/config.php');
require('../limpiadores.php');
conectar();
$lugar= Limpiar::SQL_Injections($mysqli, $_POST["pais"]);
$consulta=mysqli_query($mysqli, "SELECT * FROM tbl_provincia where pais='".$lugar."'");
echo '<option value="0" selected>Seleccione un Departamento</option>';
while ($resultado=mysqli_fetch_row($consulta)) { ?><option value="<?php echo $resultado[0] ?>"><?php echo $resultado[1] ?></option><?php }
desconectar();
?>