<?php

	function mandarPendienteDeValidacion($id, $email, $mensaje){
        $path = $_SERVER['DOCUMENT_ROOT'];
        include_once $path . '/wp-load.php';


		$to = $email;
		$subject = "Notificación de solicitud pendiente de validación";

		$message = "
		<html>
		<head>
		<title>Tu solicitud está pendiente de validación</title>
		</head>
		<body>
		<h3>Tu solicitud o una de tus solicitudes está pendiente de validación: </h3>
		<h4>$mensaje</h4>
		<h2>Para ver tu solicitud, pulsa:
		<a href='".get_home_url()."/solicitud?id=".$id."' id='solicitud'>Aquí</a></h2>
		</body>
		</html>
		";

		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		$headers .= 'From: <TEKEHU>' . "\r\n";

		mail($to,$subject,$message,$headers);
	}

	return 0;
	
?>