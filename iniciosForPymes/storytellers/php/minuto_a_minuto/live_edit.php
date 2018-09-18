<?php
require_once "../conexion.php";

$input = filter_input_array(INPUT_POST);

if ($input['action'] == 'edit') {
$update_field='';
if(isset($input['hora'])) {
$update_field.= "hora='".$input['hora']."'";
} else if(isset($input['actividad'])) {
$update_field.= "actividad='".$input['actividad']."'";
} else if(isset($input['proveedor'])) {
$update_field.= "proveedor='".$input['proveedor']."'";
} else if(isset($input['comentarios'])) {
$update_field.= "comentarios='".$input['comentarios']."'";
} else if(isset($input['orden'])) {
$update_field.= "orden='".$input['orden']."'";
}
if($update_field && $input['id']) {
$sql_query = "UPDATE minuto_a_minuto SET $update_field WHERE id='" . $input['id'] . "'";
mysqli_query($result, $sql_query) or die("database error:". mysqli_error($result));
}
}
?>