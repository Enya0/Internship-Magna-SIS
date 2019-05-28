<?php

	function mandarValidado($id, $email){
        $path = $_SERVER['DOCUMENT_ROOT'];
        include_once $path . '/wp-load.php';


		$to = $email;
		$subject = "Baliozkotutako eskaera jakinarazpena / Notificación de solicitud validada";

		$message = "
		<html>
		<body>
		[EU]<br/>
		Zure eskaera edo zure eskaeretako bat balioztatu da.<br/>
		Bere egoera ikuska dezakezu <a href='".get_home_url()."/solicitud?id=".$id."' id='solicitud'>hemen</a> sakatuz.<br/>
		<br/>
		----------------------------------------------------------<br/>
		<br/>
		[ES]<br/>
		Tu solicitud o una de tus solicitudes ha sido validada.<br/>
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