<?php 
require_once('../conexion.php');

$conex = new conection();
$result = $conex->conex();

// Utilizamos esta consulta para obtener la información del contrato
$query = mysqli_query($result, "select * from contrato_base;");

 $conteo = mysqli_num_rows($query);

$row = $query->fetch_assoc();

$contenido = urldecode($row['contrato']);

 ?>

<!DOCTYPE html>
<html lang='es'
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
	<title>CONTRATO GENERAL</title>
	<link rel='stylesheet' type='text/css' href='../../css/informes/style.css' media='screen' />
	<link rel='stylesheet' type='text/css' href='../../css/informes/print.css' media='print' />
	<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css'>
	<link rel='stylesheet' type='text/css' href='../../asset/summernote.css' rel='stylesheet' />
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.10/summernote-bs4.css'>
	<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js'></script> 
	<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js'></script> 
	<script src='https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.10/summernote-bs4.min.js'></script>
	<script type='text/javascript' src='../../asset/summernote.js'></script>
	<script type='text/javascript'>
	    $(document).ready(function() {
	      $('#table').basictable();
	    }); 
		function abrir(url) { 
		open(url,'','top=100,left=100,width=900,height=700') ; 
		}
	</script>

	</head>
<body>
	<div class='hoja' style='margin-top: 50px !important;'>
		<form action='../configuracion/guardarContratoGeneral.php' method='post'>
			<textarea id='summernote' name='contenido'>
				<?php echo $contenido; ?>
			</textarea>
		<div class='botones'>
			<button type='submit' id='btn' class='btn btn-primary'>Guardar</button>
			<button type='button' id='btn' class='btn btn-primary' onclick='window.close();'>Cerrar</button>
		</div>
	</form>
	</div>
	<script type='text/javascript'>
		$(document).ready(function() {
		  $('#summernote').summernote({
		  	height: 400,
        	toolbar: [
        	  ['style', ['style']],
	          ['font', ['bold', 'underline', 'clear']],
	          ['fontname', ['fontname']],
              ['color', ['color']],
              ['para', ['ul', 'ol', 'paragraph']],
              ['table', ['table']],
              ['insert', ['link', 'picture', 'video']],
	          ['misc', ['print']]
	        ]
		  });
		});
	</script>
	<script type='text/javascript' src='../../asset/summernote-ext-print.js'></script>
</body>
</html>