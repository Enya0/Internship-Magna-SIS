<?php

	function mandarSolicitud($id, $email){
        $path = $_SERVER['DOCUMENT_ROOT'];
        include_once $path . '/wp-load.php';

		$to = "dif.informatika-lab.teknikaria@ehu.eus";
		$subject = "Eskaera-jakinarazpena / Notificación de solicitud";

		$message = "
		<html>
		<head>
		<title>Eskaera berriko abisua! / ¡Aviso de nueva solicitud!</title>
		</head>
		<body>
		[EU]<br/>
		Eskaera berria erregistratu da. Hura lor dezakezu <a href='".get_home_url()."/solicitud?id=".$id."' id='solicitud'>hemen</a> sakatuz.<br/>
		<br/>
		----------------------------------------------------------<br/>
		<br/>
		[ES]<br/>
		Se ha registrado una nueva solicitud. Puedes acceder a ella pulsando <a href='".get_home_url()."/solicitud?id=".$id."' id='solicitud'>aquí</a>.<br/>
		</body>
		</html>
		";

		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		$headers .= 'From: <TEKEHU>' . "\r\n";

		mail($to,$subject,$message,$headers);


		$to = $email;
		$subject = "Eskaera berriaren berrespena / Confirmación de nueva solicitud";

		$message = "
		<html>
		<body>
		[EU]<br/>
		Zure eskaera zuzenki erregistratu da. Bere egoera ikuska dezakezu <a href='".get_home_url()."/solicitud?id=".$id."' id='solicitud'>hemen</a> sakatuz.<br/>
		<br/>
		----------------------------------------------------------<br/>
		<br/>
		[ES]<br/>
		Tu solicitud se ha registrado correctamente. Puedes revisar su estado pulsando <a href='".get_home_url()."/solicitud?id=".$id."' id='solicitud'>aquí</a>.<br/>
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