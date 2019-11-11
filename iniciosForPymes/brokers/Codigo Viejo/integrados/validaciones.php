<?php
class Validar{

	function Inputs_Requeridos($array){
		$inicio = 0; $num_array = count($array);
		while ($inicio < $num_array) {
			$array[$inicio] = trim($array[$inicio]);
			if (empty($array[$inicio])) { $log_error = 1; }
			$inicio++;
		}
		if ($log_error == 1) { return "Por favor complete los campos requeridos"; }else{ return "true"; }
	}

	function Correo($correo){ if (strpos($correo, "@")) { return true; }else{ return false; } }

}