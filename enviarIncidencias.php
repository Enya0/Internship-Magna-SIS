<?php

	include('wp-content/plugins/solicitudes/traducciones.php');
	include('wp-content/plugins/solicitudes/mandarIncidencias.php');

	$path = $_SERVER['DOCUMENT_ROOT']; 
	include_once $path . '/wp-load.php';

	$email = $_POST['email'];
	$nombre = $_POST['nombre'];
	$aula = $_POST['aula'];
	$problema = $_POST['problema'];
	$descripcion = $_POST['descrip'];

	function emailValido($str){
		return (filter_var($str, FILTER_VALIDATE_EMAIL));
	}

	function nombreValido($str){
		return ($str != '');
	}

	function descripcionValida($str){
		return ($str != '');
	}

	function camposRellenados(){
		return (isset($_POST['email']) && isset($_POST['nombre']) && isset($_POST['descrip']));
	}

	if (!emailValido($email)){
		echo obtenerTraduccion("erEmailIncorrecto");
	}
	elseif (!nombreValido($nombre)){
		echo obtenerTraduccion("erNombreValido");
	}
	elseif (!descripcionValida($descripcion)){
		echo obtenerTraduccion("erDescripValida");
	}
	elseif(camposRellenados()){
		global $wpdb;
		$wpdb->insert($wpdb->prefix . 'incidencia_solicitudes',array('email'=>$email,'nombre'=>$nombre, 'estado'=>'Abierta', 'notas'=>$descripcion, 'id_aula'=>$aula,'tipo'=>$problema),array('%s','%s','%s','%s','%s','%s'));
		echo obtenerTraduccion("incidenciaOK");

		mandarIncidencia($id, $email);

	}
	else{
		echo obtenerTraduccion("incidenciaNoOK");
	}

	return 0;

?>