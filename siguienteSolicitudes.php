<?php

	include('./traducciones.php');

	$path = $_SERVER['DOCUMENT_ROOT']; 
	include_once $path . '/wp-load.php';

	$asignatura = $_POST['asig'];
	$aula = $_POST['aula'];
	$sistemaOperativo = $_POST['sistOp'];
	$nSoftware = $_POST['nSoftware'];


	if(sizeof($aula) == 0){
		echo obtenerTraduccion("erAulaValida");
	}
	elseif(sizeof($sistemaOperativo) == 0){
		echo obtenerTraduccion("erSistemaOperativoValido");;
	}
	elseif (!(isset($_POST['nSoftware']) && is_numeric($nSoftware) && (int)$nSoftware>0 )){
		echo obtenerTraduccion("erNSoftwareValido");
	}
	else{
		echo "Todo estupendo";
	}

	return 0;

?>