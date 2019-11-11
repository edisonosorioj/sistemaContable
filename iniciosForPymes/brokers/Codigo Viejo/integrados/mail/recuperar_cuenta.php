<?php
require '../../libreria/PHPMailer-master/PHPMailerAutoload.php';
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Host = $host_webmail; // SMTP a utilizar. Por ej. smtp.elserver.com
$mail->Username = $usuario_webmail; // Correo completo a utilizar
$mail->Password = $pass_usuario_webmail; // Contraseña
$mail->Port = 26; // Puerto a utilizar
$mail->From = $usuario_webmail; // Desde donde enviamos (Para mostrar)
$mail->FromName = "Correo de recuperación de la cuenta";
$mail->AddAddress($correo); // Esta es la dirección a donde enviamos
$mail->AddCC($email_brokers); // Copia
$mail->AddBCC($email_brokers); // Copia oculta
$mail->IsHTML(true); // El correo se envía como HTML
$mail->Subject = "Recuperar cuenta Brokers "; // Este es el titulo del email.
$body = "<div style='background:#0078d7;width:98%;padding:10px;border-top-left-radius: 5px;border-top-right-radius: 5px;display:flex;'><img src='".$dominio."imagenes/logo.jpg' style='width:50px;' /><p style='font-size:1.5rem;color: white;margin:10px;'>Link de recuperación<p></div><br><br><div style='margin:10px;width:98%;'>Para realizar la recuperación de su cuenta satisfactoriamente dar clic en el siguiente enlace: <a href='".$link_conf."'>Cambiar Contraseña</a><br><br><p style='border-top:1px solid #6d6d6d;padding-top:5px;text-align:left;color:#6d6d6d;width:100%;'>Centro de Negocios Brokers Soluciones<br><br>Arrendamientos / Compra / Ventas / Avalúos / Remates / Asesoría Jurídicas en bienes raíces / Hipotecas / Construcción / Remodelación / Mantenimiento Residencial y Comercial<br><br>Teléfono móvil: 300 400 42 72 - 314 623 10 59<br>E-mail: ".$email_brokers."<br><br>Síguenos en las redes sociales:<br><a href='".$url_pag_facebook."'>Facebook</a> / <a href='".$url_pag_instagram."'>Instagram</a> / <a href='".$url_pag_youtube."'>Youtube</a><br><br>Rionegro - Antioquia<br><br><a href='".$dominio."'> © Brokers</a><br><br> No responder a este mensaje es generado automáticamente</p></div>";
$mail->Body = $body; // Mensaje a enviar
$mail->AltBody = "Hola mundo. Esta es la primer línean Acá continuo el mensaje"; // Texto sin html
$mail->CharSet = 'UTF-8';
$exito = $mail->Send(); // Envía el correo.
if($exito){
        echo "<header><script>alert('Se envio correctamente el correo con el link de recuperación.');window.location.href = '".$dominio."recuperar';</script></header>";
}else{
        echo "<header><script>alert('Lo sentimos hubo un error al enviar el link de recuperación, intente mas tarde o ponte en contacto con el administrador.');window.location.href = '".$dominio."recuperar';</script></header>";
}