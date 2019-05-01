<?php

	function mandarSolicitud($id, $email){
        $path = $_SERVER['DOCUMENT_ROOT'];
        include_once $path . '/wp-load.php';

		$to = "enyamanina@gmail.com";
		$subject = "Notificación de solicitud";

		$message = "
		<html>
		<head>
		<title>Se ha registrado una nueva solicitud</title>
		</head>
		<body>
		<h3>Link a la solicitud: </h3>
		<h2><a href='".get_home_url()."/solicitud?id=".$id."' id='solicitud'>Aquí</a></h2>
		</body>
		</html>
		";

		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		$headers .= 'From: <TEKEHU>' . "\r\n";

		mail($to,$subject,$message,$headers);


		$to = "julen.miner@magnasis.com";
		$subject = "Confirmación de solicitud";

		$message = "
		<html>
		<head>
		<title>Se ha registrado correctamente tu solicitud</title>
		</head>
		<body>
		<h3>Link a la solicitud: </h3>
		<h2><a href='".get_home_url()."/solicitud?id=".$id."' id='solicitud'>Aquí</a></h2>
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