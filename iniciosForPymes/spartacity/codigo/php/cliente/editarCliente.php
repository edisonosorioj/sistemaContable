<?php
	
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	
// Con el ID que se trae de clientes permite abrir un nuevo html y con información existente
$id=$_GET['id'];

$query = mysqli_query($result, "select * from clientes where id = '$id'");

$row=$query->fetch_assoc();

if ($row['estado'] == 1) {
	$estado = 'Activo';
} else if($row['estado'] == 2) {
	$estado = 'Becado';
} else {
	$estado = 'Inactivo';
}

	
?>
<!-- Se crea el HTML con la información del Cliente -->
<!DOCTYPE html>
<head>
<title>Editar Estudiante</title>
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
<body class="dashboard-page">

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
						<h2>Editar Estudiante</h2>
					</div>
					<div class="panel panel-widget forms-panel">
						<div class="forms">
							<div class="form-grids widget-shadow" data-example-id="basic-forms"> 
								<div class="form-title">
									<h4>Datos Básicos :</h4>
								</div>
								<div class="form-body">
									<form action="actCliente.php" method="post"> 
										<div class="form-group"> 
											<input type="hidden" name="id" class="form-control" value="<?php echo $row['id']; ?>"/> 
											<label>Estudiante</label> 
											<input type="text" name="nombres" class="form-control" placeholder="Nombres" value="<?php echo $row['nombres']; ?>"/> 
										</div> 
										<div class="form-group"> 
											<label>CC / NIT</label> 
											<input type="text" name="documento" class="form-control" placeholder="Documento" value="<?php echo $row['documento']; ?>"/> 
										</div> 
										<div class="form-group"> 
											<label>Acudiente</label> 
											<input type="text" name="empresa" class="form-control" placeholder="Empresa" value="<?php echo $row['empresa']; ?>"/> 
										</div> 
										<div class="form-group"> 
											<label>CC / NIT</label> 
											<input type="text" name="doc_empresa" class="form-control" placeholder="Documento Acudiente" value="<?php echo $row['doc_empresa']; ?>"/> 
										</div>
										<div class="form-group"> 
											<label>Telefono</label> 
											<input type="text" name="telefono" class="form-control" placeholder="Telefono" value="<?php echo $row['telefono']; ?>"/> 
										</div> 
										<div class="form-group"> 
											<label>Email</label> 
											<input type="text" name="correo" class="form-control" placeholder="Correo" value="<?php echo $row['correo']; ?>"/> 
										</div> 
										<div class="form-group"> 
											<label>Dirección</label> 
											<input type="text" name="direccion" class="form-control" placeholder="Dirección" value="<?php echo $row['direccion']; ?>"/> 
										</div>
										<div class="form-group"> 
											<label>Fecha Nacimiento</label> 
											<input type="text" name="fecha_nacimiento" class="form-control" placeholder="Fecha Nacimiento" value="<?php echo $row['fecha_nacimiento']; ?>"/> 
										</div>
										<div class="form-group"> 
											<label>RH</label> 
											<input type="text" name="rh" class="form-control" placeholder="RH" value="<?php echo $row['rh']; ?>"/> 
										</div>
										<div class="form-group"> 
											<label>Categoría</label> 
											<input type="text" name="categoria" class="form-control" placeholder="Categoría" value="<?php echo $row['categoria']; ?>"/> 
										</div>
										<div class="form-group"> 
											<label>Seguro Social</label> 
											<input type="text" name="seguro_social" class="form-control" placeholder="Seguro Social" value="<?php echo $row['seguro_social']; ?>"/> 
										</div>
										<div class="form-group"> 
											<label>Estado</label> 
											<select name='estado' class="form-control">
												<option value="<?php echo $row['estado'] ?>"><?php echo $estado ?></option>
												<option value='1'>Activo</option>
												<option value='2'>Becado</option>
												<option value='0'>Inactivo</option>
											</select>
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
