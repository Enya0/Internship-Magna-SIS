<?php

	function mandarDescartado($id, $email, $motivo){
        $path = $_SERVER['DOCUMENT_ROOT'];
        include_once $path . '/wp-load.php';


		$to = $email;
		$subject = "Notificación de solicitud descartada";

		$message = "
		<html>
		<head>
		<title>Se ha descartado tu solicitud</title>
		</head>
		<body>
		<h3>Tu solicitud o una de tus solicitudes ha sido descartada por el siguiente motivo: </h3>
		<h4>$motivo</h4>
		<h2>Si no estás de acuerdo y quieres reabrir tu solicitud, pulsa:
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