<?php

require_once "../../php/conexion.php";

$conex = new conection();
$result = $conex->conex();

$query = mysqli_query($result, "select * from pagos order by pago_id desc limit 1");

$row=$query->fetch_assoc();

$fecha_ultimo_pago = $row['fecha'];


$query4 = mysqli_query($result, "select * from variables;");

$rows = mysqli_num_rows ($query4);  
          
if ($rows > 0)  
{  
    for ($i=0; $i<$rows; $i++)  
    {  
        $row4 = mysqli_fetch_array($query4);  
        $rows4[$i] = $row4["nombre"];  
        $datos[$rows4[$i]] = $row4["detalle"];  
    }  
              
}  

$plan 				= $datos['plan'];
$dia_contrato		= substr($fecha_ultimo_pago,8,2);
$mes_contrato		= substr($fecha_ultimo_pago,5,2);
$ano_contrato		= substr($fecha_ultimo_pago,0,4);
$fecha_actual		= strtotime(date('d-m-Y'));
$fecha_contrato		= strtotime(date($fecha_ultimo_pago));

if ($mes_contrato == '01') {
		$mes_texto = 'Enero';
} else if ($mes_contrato == '02') {
		$mes_texto = 'Febrero';
} else if ($mes_contrato == '03') {
		$mes_texto = 'Marzo';
} else if ($mes_contrato == '04') {
		$mes_texto = 'Abril';
} else if ($mes_contrato == '05') {
		$mes_texto = 'Mayo';
} else if ($mes_contrato == '06') {
		$mes_texto = 'Junio';
} else if ($mes_contrato == '07') {
		$mes_texto = 'Julio';
} else if ($mes_contrato == '08') {
		$mes_texto = 'Agosto';
} else if ($mes_contrato == '09') {
		$mes_texto = 'Septiembre';
} else if ($mes_contrato == '10') {
		$mes_texto = 'Octubre';
} else if ($mes_contrato == '11') {
		$mes_texto = 'Noviembre';
} else if ($mes_contrato == '12') {
		$mes_texto = 'Diciembre';
}

$renovacion = $fecha_contrato - $fecha_actual;

$cinco_dias = 432000;

if($fecha_actual > $fecha_contrato){
	$mensaje = "Su renovación era el $dia_contrato de $mes_texto de $ano_contrato. Por favor realizarlo ahora para continuar con el servicio.";
}else if ($renovacion <= $cinco_dias) {
	$mensaje = "Esta próxima su fecha de renovación no olvide estar atento.";
}else{
	$mensaje = "Estas al día. Muchas gracias.";
}

if ($fecha_ultimo_pago == '') {
	$mensaje = 'Debes realizar el primer pago por el valor establecido mas abajo.';
}

$html = "<!DOCTYPE html>
<head>
<title>Actualización Datos</title>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<meta name='keywords' content='AdminSoft' />
<script type='application/x-javascript'> addEventListener('load', function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel='stylesheet' href='../../css/bootstrap.css'>
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href='../../css/style.css' rel='stylesheet' type='text/css' />
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel='stylesheet' href='../../css/font.css' type='text/css'/>
<link href='../../css/font-awesome.css' rel='stylesheet'> 
<!-- //font-awesome icons -->
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
		
</head>
<body class='dashboard-page'>

	<section class='wrapper scrollable'>
		<nav class='user-menu'>
			<a href='javascript:;' class='main-menu-access'>
			<i class='icon-proton-logo'></i>
			<i class='icon-reorder'></i>
			</a>
		</nav>
		<div class='main-grid'>
			<div class='agile-grids'>	
				<!-- input-forms -->
				<div class='grids'>
					<div class='progressbar-heading grids-heading'>
						<h2>Actualización de Datos</h2>
					</div>
					<div class='panel panel-widget forms-panel'>
						<div class='forms'>
							<div class='form-grids widget-shadow' data-example-id='basic-forms'> 
								<div class='form-title'>
									<h4>Datos Básicos :</h4>
								</div>
								<div class='form-body'>
									<form action='../../php/configuracion/actDatosEmpresa.php' method='post'> 
										<div class='form-group'> 
											<label>$mensaje</label>
											<label>El valor de renovación es $ " . number_format($plan, 0, ",", ".") . " mensuales.</label><br /><br />
											<input type='text' name='pago' class='form-control' value='$plan' disabled/> 
											<label><b>Importante:</b> Guardar el comprobante de la transacción para confirmar la compra al final de la transacción.</label>
										</div>
										<a mp-mode='dftl' href='https://www.mercadopago.com/mco/checkout/start?pref_id=134487234-fd472276-c019-48c8-9bd4-254a73f3f412' name='MP-payButton' class='blue-ar-l-sq-coall'>Pagar</a>
										<script type='text/javascript'>
										(function(){function \$MPC_load(){window.\$MPC_loaded !== true && (function(){var s = document.createElement('script');s.type = 'text/javascript';s.async = true;s.src = document.location.protocol+'//secure.mlstatic.com/mptools/render.js';var x = document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s, x);window.\$MPC_loaded = true;})();}window.\$MPC_loaded !== true ? (window.attachEvent ?window.attachEvent('onload', \$MPC_load) : window.addEventListener('load', \$MPC_load, false)) : null;})();
										</script>
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
	<script src='../../js/bootstrap.js'></script>
	<script src='../../js/proton.js'></script>
</body>
</html>";

echo $html;
