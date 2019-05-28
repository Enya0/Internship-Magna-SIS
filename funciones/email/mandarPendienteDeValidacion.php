<?php

	function mandarPendienteDeValidacion($id, $email, $mensaje){
        $path = $_SERVER['DOCUMENT_ROOT'];
        include_once $path . '/wp-load.php';


		$to = $email;
		$subject = "Eskaera jakinarazpen balidatzeko pendientea / Notificación de solicitud pendiente de validación";

		$message = "
		<html>
		<body>
		[EU]<br/>
		Zure eskaera edo zure eskaeretako bat balidatuaren zain dago:<br/>
		$mensaje <br/>
		Bere egoera ikuska dezakezu <a href='".get_home_url()."/solicitud?id=".$id."' id='solicitud'>hemen</a> sakatuz.<br/>
		<br/>
		----------------------------------------------------------<br/>
		<br/>
		[ES]<br/>
		Tu solicitud o una de tus solicitudes está pendiente de validación:<br/>
		$mensaje <br/>
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