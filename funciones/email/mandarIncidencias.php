<?php

	function mandarIncidencia($id, $email){
        $path = $_SERVER['DOCUMENT_ROOT'];
        include_once $path . '/wp-load.php';

		$to = "dif.informatika-lab.teknikaria@ehu.eus";
		$subject = "Intzidentzia-jakinarazpena / Notificación de incidencia";

		$message = "
		<html>
		<head>
		<title>Intzidentzia berriko abisua! / ¡Aviso de nueva incidencia!</title>
		</head>
		<body>
		[EU]<br/>
		Intzidentzia berria erregistratu da. Hura lor dezakezu <a href='".get_home_url()."/incidencia?id=".$id."' id='incidencia'>hemen</a> sakatuz.<br/>
		<br/>
		----------------------------------------------------------<br/>
		<br/>
		[ES]<br/>
		Se ha registrado una nueva incidencia. Puedes acceder a ella pulsando <a href='".get_home_url()."/incidencia?id=".$id."' id='incidencia'>aquí</a>.<br/>
		</body>
		</html>
		";

		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		$headers .= 'From: <TEKEHU>' . "\r\n";

		mail($to,$subject,$message,$headers);


		$to = $email;
		$subject = "Intzidentziaren berrespena / Confirmación de incidencia";

		$message = "
		<html>
		<body>
		[EU]<br/>
		Zure intzidentzia zuzenki erregistratu da. Bere egoera ikuska dezakezu <a href='".get_home_url()."/incidencia?id=".$id."' id='incidencia'>hemen</a> sakatuz.<br/>
		<br/>
		----------------------------------------------------------<br/>
		<br/>
		[ES]<br/>
		Tu incidencia se ha registrado correctamente. Puedes revisar su estado pulsando <a href='".get_home_url()."/incidencia?id=".$id."' id='incidencia'>aquí</a>.<br/>
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