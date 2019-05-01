<?php

	function mandarDescartado($id, $motivo){
        $path = $_SERVER['DOCUMENT_ROOT'];
        include_once $path . '/wp-load.php';


        $to = "enyamanina@gmail.com";
		$subject = "Notificación de solicitud reabierta";

		$message = "
		<html>
		<head>
		<title>Se ha reabierto una solicitud</title>
		</head>
		<body>
		<h3>Una solicitud ha sido reabierta por el siguiente motivo: </h3>
		<h4>$motivo</h4>
		<h2>Si quieres cambiar el estado, pulsa:
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