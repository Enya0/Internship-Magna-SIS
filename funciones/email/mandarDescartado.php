<?php

	function mandarDescartado($id, $email, $motivo){
        $path = $_SERVER['DOCUMENT_ROOT'];
        include_once $path . '/wp-load.php';


		$to = $email;
		$subject = "Baztertutako eskaera jakinarazpena / Notificación de solicitud descartada";

		$message = "
		<html>
		<body>
		[EU]<br/>
		Hurrengo arrazoiagatik zure eskaera edo zure eskaeretako bat baztertu da:<br/>
		$motivo <br/>
		Ados ez bazaude eta zure eskaera berriro zabaltzea nahi duzu, <a href='".get_home_url()."/solicitud?id=".$id."' id='solicitud'>hemen</a> sartu.<br/>
		<br/>
		----------------------------------------------------------<br/>
		<br/>
		[ES]<br/>
		Tu solicitud o una de tus solicitudes ha sido descartada por el siguiente motivo:<br/>
		$motivo <br/>
		Si no estás de acuerdo y quieres reabrir tu solicitud, pulsa <a href='".get_home_url()."/solicitud?id=".$id."' id='solicitud'>aquí</a>.<br/>
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