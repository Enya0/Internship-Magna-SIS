<?php 

	include('../traducciones.php');

	$path = $_SERVER['DOCUMENT_ROOT']; 
	include_once $path . '/wp-load.php';

	$nombre = $_POST['nombre'];
	$nombre_eus = $_POST['nombre_eus'];
	$curso = $_POST['curso'];

	function asignaturaExiste($nombre, $curso){
	    global $wpdb;
	    $sql = "SELECT curso FROM " . $wpdb->prefix . "asignatura_solicitudes WHERE nombre='$nombre'";
	    $results = $wpdb->get_results($sql);
	    $check = 0;
	    foreach ($results as $result){
	        if($result->curso == $curso){
	            $check = 1;
	        }
	    }
	    return($check == 1);
	}

	function camposRellenados(){
		return (isset($_POST['nombre']) && ($_POST['nombre'] != '') && isset($_POST['nombre_eus']) && ($_POST['nombre_eus'] != '') && !asignaturaExiste($_POST['nombre'], $_POST['curso']));
	}

	if(camposRellenados()){
		global $wpdb;
		$wpdb->insert($wpdb->prefix . 'asignatura_solicitudes',array('nombre'=>$nombre,'nombre_eus'=>$nombre_eus,'curso'=>$curso),array('%s','%s','%s'));
		echo obtenerTraduccion("asignaturaOK");
	}else{
		echo obtenerTraduccion("asignaturaNoOK");

	}

	return 0;
	
?>
