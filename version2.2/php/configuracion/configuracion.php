<?php

session_start();

if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.php");
	exit();
	
}
if (isset($_SESSION['idrol'])){

	$idrol = $_SESSION['idrol'];
	
}

require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

// Realiza una consulta para saber la cantidad de usuarios
 $query2 = mysqli_query($result,'select count(nombre) as user from administradores');

// Lo organiza en un array y permite utilizar cada uno de los parametros
 $usuario = $query2->fetch_array(MYSQLI_BOTH);
 $user = $usuario['user'];

if ($idrol == 0) {
	include "../menu.php";
}else{
	include "../menu2.php";
}


$html= "<!DOCTYPE html>
<head>
<title>Configuración</title>
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
<script>
    var theme = $.cookie('protonTheme') || 'default';
    $('body').removeClass (function (index, css) {
        return (css.match (/\btheme-\S+/g) || []).join(' ');
    });
    if (theme !== 'default') $('body').addClass(theme);
</script>
<script type='text/javascript'>
    $(document).ready(function() {
      $('#table').basictable();
    }); 
	function abrir(url) { 
	open(url,'','top=50,left=100,width=900,height=650') ; 
	}
</script>
<!-- //tables -->
<!-- charts -->
<script src='../../js/raphael-min.js'></script>
<script src='../../js/morris.js'></script>
<link rel='../../stylesheet' href='../../css/morris.css'>
<!-- //charts -->
<!--skycons-icons-->
<script src='../../js/skycons.js'></script>
<!--//skycons-icons-->
</head>
	<body class='dashboard-page'>
		<div class='main-grid'>
			<div class='agile-grids'>
				<!-- grids -->
				<div class='grids'>
					<div class='progressbar-heading grids-heading'>
						<h2>Configuración</h2>
					</div>
					<div class='codes'>
						<div class='agile-container'>
							<div class='grid_3 grid_4'>
								<div class='bs-example'>
									<table class='table'>
										<tbody>
											<tr>
												<td>
													<h4>1. Crear nuevo usuario Administrador. Existen<b> $user </b> Usuarios. <a href='verUsuarios.php'> Ver</a></h4>
												</td>
												<td class='type-info'>
													<button type='button' class='btn-hover btn-xs btn-block hvr-icon-float-away' onclick='javascript:abrir(\"../../html/configuracion/crearUsuario.html\")'>Crear</button>
												</td>	
											</tr>
											<tr>
												<td>
													<h4>2. Datos Básicos de la Empresa o Persona</h4>
												</td>
												<td class='type-info'>
													<button type='button' class='btn-hover btn-xs btn-block hvr-icon-float-away' onclick='javascript:abrir(\"../../html/configuracion/datosEmpresa.php\")'>Actualizar</button>
												</td>	
											</tr>
											<tr>
												<td>
													<h4>3. Consecutivo Cuenta de Cobros</h4>
												</td>
												<td class='type-info'>
													<button type='button' class='btn-hover btn-xs btn-block hvr-icon-float-away' onclick='javascript:abrir(\"../../html/configuracion/consecutivo.php\")'>Actualizar</button>
												</td>	
											</tr>
											<tr>
												<td>
													<h4>3. Revisar el estado de tu plan.</h4>
												</td>
												<td class='type-info'>
													<button type='button' class='btn-hover btn-xs btn-block hvr-icon-float-away' onclick='javascript:abrir(\"../../html/configuracion/pagos.php\")'>Revisar</button>
												</td>	
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- footer -->
		<div class='footer'>
			<p>© 2019 ForPymes. All Rights Reserved . Design by <a href='https://forpymes.co'></a>ForPymes</p>
		</div>
		<!-- //footer -->
	</section>
	<script src='../../js/bootstrap.js'></script>
	<script src='../../js/proton.js'></script>
</body>
</html>
";

echo $html;

?>