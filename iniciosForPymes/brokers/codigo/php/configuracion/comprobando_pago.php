<?
$empresa 	= $_POST['empresa']; 
$valor 		= $_POST['valor']; 
$fecha 		= date('y-m-d h:i'); 
$archivo 	= 'comprobante-'.$fecha.'.jpg';

$carpeta="../../comprobantes/";
opendir($carpeta);
$destino = $carpeta.$archivo;
copy($_FILES['foto']['tmp_name'], $destino);

$msg = 'El archivo ha sido subido correctamente';

$para = 'edisonosorioj@gmail.com';
$asunto = 'Pago forpymes de '.$empresa;
$mensaje = 'Formulario enviado desde Plataforma Forpymes<br />';
$mensaje .= 'Se hizo un cargue de archivo desde la plataforma de $empresa por un valor de $valor<br />';
$mensaje .= 'Verifica el pago y accede al sistema para darle continuidad a la renovación del cliente.<br />';

$cabeceras = 'From: edisonosorioj@gmail.com\r\n';
$cabeceras .= 'Reply-To: edisonosorioj@gmail.com\r\n';
$cabeceras .= 'MIME-Version: 1.0\r\n';
$cabeceras .= 'Content-type: text/html; charset=ISO-8859-1\r\n';

mail($para, $asunto, $mensaje, $cabeceras);

$query 	= mysqli_query($result, "select * from pagos order by pago_id desc limit 1");

$row 	= $query->fetch_assoc();

$fecha_ultimo_pago = $row['fecha'];


$html = "<script>
			window.alert('$msg');
			opener.location.reload();
			window.close();
		</script>";	
	
echo $html;	


?>