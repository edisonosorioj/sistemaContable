<?php

$id = $_GET['id'];

?>

<!DOCTYPE html>
<head>
<title>Nuevo Item</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="forpymes" />
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
						<h2>Nuevo Producto</h2>
					</div>
					<div class="panel panel-widget forms-panel">
						<div class="forms">
							<div class="form-grids widget-shadow" data-example-id="basic-forms"> 
								<div class="form-title">
									<h4>Datos Básicos :</h4>
								</div>
								<div class="form-body">
									<form action="../../php/productos/addItem.php" method="post">
										<div class="form-group"> 
											<input type="hidden" name="id" value="<?php echo $id; ?>" class="form-control"> 
										</div>
										<div class="form-group"> 
											<label>Nombre</label> 
											<input type="text" name="nombre" class="form-control" placeholder="Nombre"> 
										</div>
										<div class="form-group"> 
											<label>Valor</label> 
											<input type="number" name="valor" class="form-control" placeholder="Valor"> 
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
