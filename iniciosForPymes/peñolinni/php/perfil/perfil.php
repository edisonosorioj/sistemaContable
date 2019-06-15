
<?php
session_start();


if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.html");
	exit();
	
}

if (isset($_SESSION['idadmin'])){

	$idadmin = $_SESSION['idadmin'];
	
}
if (isset($_SESSION['idrol'])){

	$idrol = $_SESSION['idrol'];
	
}


require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

if ($idrol == 0) {
	include "../menu.php";
}elseif ($idrol == 1) {
	include "../menu2.php";
}else{
	include "../menu3.php";
}


// Realiza una consulta para verificar unos parametros en la base de datos y asi permitir la actualización de la información.
 $query = mysqli_query($result,"select * from administradores where idadmin = '" . $idadmin . "';");

// Lo organiza en un array y permite utilizar cada uno de los parametros
 $row = $query->fetch_assoc();

 $id 		= $row['idadmin'];
 $documento = $row['documento'];
 $nombre 	= $row['nombre'];
 $apellido 	= $row['apellido'];
 $login 	= $row['login'];


$html="
<!DOCTYPE html>
<head>
<title>Perfil</title>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<meta name='keywords' content='Sistema Administrativo' />
<script type='application/x-javascript'> addEventListener('load', function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script src='../../js/jquery2.0.3.min.js'></script>
<script src='../../js/modernizr.js'></script>
<script src='../../js/jquery.cookie.js'></script>
<script src='../../js/screenfull.js'></script>
<script>
	$(function () {
		$('#supported').text('Supported/allowed: ' + !!screenfull.enabled);

		if (!screenfull.enabled) {
			return false;
		}

		$('#toggle').click(function () {
			screenfull.toggle($('#container')[0]);
		});	
	});
</script>
<!-- tables -->
<link rel='stylesheet' type='text/css' href='../../css/table-style.css' />
<link rel='stylesheet' type='text/css' href='../../css/basictable.css' />
<script type='text/javascript' src='../../js/jquery.basictable.min.js'></script>
<script type='text/javascript'>
    $(document).ready(function() {
      $('#table').basictable();
    }); 
	function abrir(url) { 
	open(url,'','top=100,left=100,width=900,height=700') ; 
	}
</script>
<!-- //tables -->
</head>
<body class='dashboard-page'>

		<div class='main-grid'>
			<div class='agile-grids'>	
				<!-- input-forms -->
					<div class='panel panel-widget forms-panel'>
						<div class='progressbar-heading grids-heading'>
							<h2>Mi Perfil</h2>
						</div>
						<div class='progressbar-heading general-heading'>
							<h4>Datos Básicos :</h4>
						</div>
						<div class='forms'>
								<h3 class='title1'></h3>
								<div class='form-three widget-shadow'>
									<form class='form-horizontal' action='actPerfil.php' method='post'>
										<div class='form-group'>
											<label for='disabledinput' class='col-sm-2 control-label'>ID</label>
											<div class='col-sm-8'>
												<input disabled='' type='text' name='id' value='$id' class='form-control1' id='disabledinput'>
											</div>
										</div>
										<div class='form-group'>
											<label for='focusedinput' class='col-sm-2 control-label'>Documento</label>
											<div class='col-sm-8'>
												<input type='text' class='form-control1' name='documento' value='$documento' id='focusedinput' placeholder='Documento'>
											</div>
											<div class='col-sm-2'>
												<p class='help-block'>CC, Nit, TI</p>
											</div>
										</div>
										<div class='form-group'>
											<label for='focusedinput' class='col-sm-2 control-label'>Nombres</label>
											<div class='col-sm-8'>
												<input type='text' class='form-control1' value='$nombre' name='nombre' id='focusedinput' placeholder='Nombres'>
											</div>
										</div>
										<div class='form-group'>
											<label for='focusedinput' class='col-sm-2 control-label'>Apellidos</label>
											<div class='col-sm-8'>
												<input type='text' class='form-control1' value='$apellido' name='apellido' id='focusedinput' placeholder='Apellido'>
											</div>
										</div>
										<div class='form-group'>
											<label for='focusedinput' class='col-sm-2 control-label'>Login</label>
											<div class='col-sm-8'>
												<input type='text' class='form-control1' value='$login' name='login' id='focusedinput' placeholder='Apellido'>
											</div>
											<div class='col-sm-2'>
												<p class='help-block'>Nuevo Login</p>
											</div>
										</div>
										<div class='form-group'>
											<label for='inputPassword' class='col-sm-2 control-label'>Password</label>
											<div class='col-sm-8'>
												<input type='password' class='form-control1' id='inputPassword' placeholder='Password' name='password'>
											</div>
											<div class='col-sm-2'>
												<p class='help-block'>Nuevo Password</p>
											</div>
										</div>
										<button type='submit' class='btn btn-default w3ls-button'>Actualizar</button>
										<button type='button' onclick='history.back()' class='btn btn-default w3ls-button'>Cancelar</button> 
									</form>
								</div>
						</div>
					</div>
				</div>
				<!-- //input-forms -->
			</div>
		</div>
		<!-- footer -->
		<div class='footer'>
			<p>© 2017 AdminSoft . All Rights Reserved . Design by <a href='edisonosorioj.com'></a>AlDía</p>
		</div>
		<!-- //footer -->
	</section>
	<script src='../../js/bootstrap.js'></script>
	<script src='../../js/proton.js'></script>
</body>
</html>";

echo $html;

?>