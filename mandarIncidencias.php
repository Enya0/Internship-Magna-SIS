<?php 

	function mandarIncidencia($id, $email){

		$to = "enyamanina@gmail.com";
		$subject = "Notificación de incidencia";

		$message = "
		<html>
		<head>
		<title>Se ha registrado una nueva incidencia</title>
		</head>
		<body>
		<h3>Link a la incidencia:</h3>
		<h2><a href='XXXXXXXXXXXXXXXXXXXXXXXX' id='incidencia'></a></h2>
		</body>
		</html>
		";

		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		$headers .= 'From: <TEKEHU>' . "\r\n";

		mail($to,$subject,$message,$headers);


		$to = $email;
		$subject = "Confirmación de incidencia";

		$message = "
		<html>
		<head>
		<title>Se ha registrado correctamente tu incidencia</title>
		</head>
		<body>
		<h3>Link a la incidencia:</h3>
		<h2><a href='XXXXXXXXXXXXXXXXXXXXXXXX' id='incidencia'>Aquí</a></h2>
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