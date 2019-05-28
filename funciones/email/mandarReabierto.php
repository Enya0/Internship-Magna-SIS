<?php

	function mandarReabierto($id, $motivo){
        $path = $_SERVER['DOCUMENT_ROOT'];
        include_once $path . '/wp-load.php';


        $to = "julen.miner@magnasis.com";
		$subject = "Berriro zabaldutako eskaera jakinarazpena / Notificación de solicitud reabierta";

		$message = "
		<html>
		<head>
		<title>Berriro zabaldutako eskaera abisua! / ¡Aviso de solicitud reabierta!</title>
		</head>
		<body>
		[EU] <br/>
		Hurrengo arrazoiagatik eskaera bat berriro zabaldu da:<br/>
		$motivo <br/>
		Bere egoera ikuska dezakezu <a href='".get_home_url()."/solicitud?id=".$id."' id='solicitud'>hemen</a> sakatuz.<br/>
		<br/>
		----------------------------------------------------------<br/>
		<br/>
		[ES]<br/>
		Una solicitud ha sido reabierta por el siguiente motivo:<br/>
		$motivo <br/>
		Puedes revisar su estado pulsando <a href='".get_home_url()."/solicitud?id=".$id."' id='solicitud'>aquí</a>.<br/>
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