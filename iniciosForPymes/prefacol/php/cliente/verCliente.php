<?php
	
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	
// Con el ID que se trae de clientes permite abrir un nuevo html y con información existente
$id=$_GET['id'];

$query = mysqli_query($result, "select id, documento, empresa, nombres, telefono, correo, direccion from clientes where id='$id'");

$row=$query->fetch_assoc();
	
?>
<!-- Se crea el HTML con la información del Cliente -->
<!DOCTYPE html>
<head>
<title>Editar Cliente</title>
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
					<div class="panel panel-widget forms-panel">
						<div class="forms">
							<div class="form-grids widget-shadow" data-example-id="basic-forms"> 
								<div class="form-title">
									<h4>Datos :</h4>
								</div>
								<div class="form-body">
									<form action='editarCliente.php?id=<?php echo $row['id']; ?>' method="post"> 
										<div class="form-group"> 
											<label>Nombres</label> 
											<input type="text" name="nombres" class="form-control" placeholder="Nombres" value="<?php echo $row['nombres']; ?>" disabled/> 
										</div> 
										<div class="form-group"> 
											<label>Empresa</label> 
											<input type="text" name="empresa" class="form-control" placeholder="Empresa" value="<?php echo $row['empresa']; ?>" disabled/> 
										</div> 
										<div class="form-group"> 
											<label>CC / NIT</label> 
											<input type="text" name="documento" class="form-control" placeholder="Documento" value="<?php echo $row['documento']; ?>" disabled/> 
										</div>
										<div class="form-group"> 
											<label>Telefono</label> 
											<input type="text" name="telefono" class="form-control" placeholder="Telefono" value="<?php echo $row['telefono']; ?>" disabled/> 
										</div>
										<div class="form-group"> 
											<label>Dirección</label> 
											<input type="text" name="direccion" class="form-control" placeholder="Dirección" value="<?php echo $row['direccion']; ?>" disabled/> 
										</div> 
										<div class="form-group"> 
											<label>Email</label> 
											<input type="text" name="correo" class="form-control" placeholder="Correo" value="<?php echo $row['correo']; ?>" disabled/> 
										</div> 

										<button type="submit" class="btn btn-default w3ls-button">Editar</button> 
										<button type="button" class="btn btn-default w3ls-button" onclick="window.close();">Cerrar</button> 
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
