<?php
	
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	
// Con el ID que se trae de clientes permite abrir un nuevo html y con información existente
$id=$_GET['id'];

$query = mysqli_query($result, "select * from administradores where idadmin='$id'");

$row=$query->fetch_assoc();

$rol = $row['idrol'];
if ($rol == 0) {
	$txtRol = 'Administrador';
	$options = "<option value='1'>Comercial</option>
				<option value='2'>Otro</option>";
} else if ($rol == 1) {
	$txtRol = 'Comercial';
	$options = "<option value='0'>Administrador</option>
				<option value='2'>Otro</option>";
} else {
	$txtRol = 'Otro';
	$options = "
				<option value='0'>Administrador</option>
				<option value='1'>Comercial</option>
				";
}

	
?>
<!-- Se crea el HTML con la información del Cliente -->
<!DOCTYPE html>
<head>
<title>Editar Usuario</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Administración de Negocios, Admin, Negocios" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="../../css/bootstrap.css">
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="../../css/style.css" rel='stylesheet' type='text/css' />
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="../../css/font.css" type="text/css"/>
<link href="../../css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<script src="../../js/jquery2.0.3.min.js"></script>
<script src="../../js/modernizr.js"></script>
<script src="../../js/jquery.cookie.js"></script>
<script src="../../js/screenfull.js"></script>
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
		
</head>
<body class="dashboard-page" style='overflow: scroll !important;'>

	<section class="wrapper scrollable">
		<nav class="user-menu">
			<a href="javascript:;" class="main-menu-access">
			<i class="icon-proton-logo"></i>
			<i class="icon-reorder"></i>
			</a>
		</nav>
		<div class="main-grid">
			<div class="agile-grids">	
				<!-- input-forms -->
				<div class="grids">
					<div class="progressbar-heading grids-heading">
						<h2>Editar Usuario</h2>
					</div>
					<div class="panel panel-widget forms-panel">
						<div class="forms">
							<div class="form-grids widget-shadow" data-example-id="basic-forms"> 
								<div class="form-title">
									<h4>Datos Básicos :</h4>
								</div>
								<div class="form-body">
									<form action="actUsuario.php" method="post"> 
										<div class="form-group"> 
											<input type="hidden" name="id" value="<?php echo $id; ?>" class="form-control"> 
										</div>
										<div class="form-group"> 
											<label>Documento</label> 
											<input type="text" name="documento" class="form-control" placeholder="Documento" value="<?php echo $row['documento']; ?>"> 
										</div>
										<div class="form-group"> 
											<label>Nombres</label> 
											<input type="text" name="nombre" class="form-control" placeholder="Nombres" value="<?php echo $row['nombre']; ?>"> 
										</div> 
										<div class="form-group"> 
											<label>Apellido</label> 
											<input type="text" name="apellido" class="form-control" placeholder="Apellido" value="<?php echo $row['apellido']; ?>"> 
										</div> 
										<div class="form-group"> 
											<label>Rol</label>
											<select class="form-control" name='rol'>
												<option value='<?php echo $row['idrol']; ?>'><? echo $txtRol; ?></option>
												<? echo $options ?>
											</select>
										</div>
										<div class="form-group"> 
											<label>Login</label> 
											<input type="text" name="login" class="form-control" placeholder="Login" value="<?php echo $row['login']; ?>"> 
										</div> 
										<div class="form-group"> 
											<label>Cambiar Contraseña</label> 
											<input type="text" name="contrasena" class="form-control" placeholder="Nueva Contraseña"> 
										</div> 

										<button type="submit" class="btn btn-default w3ls-button">Guardar</button> 
										<button type="button" class="btn btn-default w3ls-button" onclick="window.close();">Cancelar</button> 
									</form> 
								</div>
							</div>
						</div>
					</div>

				</div>
				<!-- //input-forms -->
			</div>
		</div>
	</section>
	<script src="../../js/bootstrap.js"></script>
	<script src="../../js/proton.js"></script>
</body>
</html>
