<?php

	include('wp-content/plugins/solicitudes/traducciones.php');

	$path = $_SERVER['DOCUMENT_ROOT']; 
	include_once $path . '/wp-load.php';

	$asignatura = $_POST['asig'];
	$aula = $_POST['aula'];
	$sistemaOperativo = $_POST['sistOp'];
	$programa = $_POST['programa'];
	$version = $_POST['version'];
	$descripcion = $_POST['descrip'];

	function programaValido($str){
		return ($str != '');
	}

	function versionValida($str){
		return ($str != '');
	}

	function descripcionValida($str){
		return ($str != '');
	}

	function camposRellenados(){
		return (isset($_POST['programa']) && isset($_POST['version']) && isset($_POST['descrip']));
	}

	if (!programaValido($email)){
		echo obtenerTraduccion("erProgramaValido");
	}
	elseif (!versionValida($nombre)){
		echo obtenerTraduccion("erVersionValida");
	}
	elseif (!descripcionValida($descripcion)){
		echo obtenerTraduccion("erDescripValida");
	}
	elseif(camposRellenados()){
		global $wpdb;
		$wpdb->insert($wpdb->prefix . 'solicitud_solicitudes',array('email'=>$email,'nombre'=>$nombre, 'estado'=>'Abierta', 'notas'=>$descripcion, 'id_aula'=>$aula,'tipo'=>$problema),array('%s','%s','%s','%s','%s','%s'));
		echo obtenerTraduccion("solicitudOK");
	}
	else{
		echo obtenerTraduccion("solicitudNoOK");
	}

	return 0;

?>