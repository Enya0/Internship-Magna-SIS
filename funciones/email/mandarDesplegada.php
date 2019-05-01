<?php

	function mandarDesplegada($id, $email){
        $path = $_SERVER['DOCUMENT_ROOT'];
        include_once $path . '/wp-load.php';


		$to = $email;
		$subject = "Notificación de solicitud desplegada";

		$message = "
		<html>
		<head>
		<title>Se ha desplegado tu solicitud</title>
		</head>
		<body>
		<h3>Tu solicitud o una de tus solicitudes ha sido desplegada.</h3>
		<h2>Para conocer más sobre el estado de tu solicitud, pulsa:
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