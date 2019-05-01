<?php 

	include('../traducciones.php');

	$path = $_SERVER['DOCUMENT_ROOT']; 
	include_once $path . '/wp-load.php';

	$nombre = $_POST['nombre'];

	function soExiste($nombre){
	    global $wpdb;
	    $sql = "SELECT nombre FROM " . $wpdb->prefix . "so_solicitudes WHERE nombre='$nombre'";
	    $results = $wpdb->get_results($sql);
	    $check = 0;
	    foreach ($results as $result){
	        $check = 1;
	    }
	    return($check == 1);
	}

	function camposRellenados(){
		return (isset($_POST['nombre']) && ($_POST['nombre'] != '') && !soExiste($_POST['nombre']));
	}

	if(camposRellenados()){
		global $wpdb;
		$wpdb->insert($wpdb->prefix . 'so_solicitudes',array('nombre'=>$nombre),array('%s'));
		echo obtenerTraduccion("sistemaOperativoOK");
	}else{
		echo obtenerTraduccion("sistemaOperativoNoOK");

	}

	return 0;
	
?>
