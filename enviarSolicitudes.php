<?php

	include('./traducciones.php');

	$path = $_SERVER['DOCUMENT_ROOT']; 
	include_once $path . '/wp-load.php';

	$asignatura = $_POST['asig'];
	$aula = $_POST['aula']; // separadas por comas
	$sistemaOperativo = $_POST['sistOp']; // separadas por comas
    $nSoftware = $_POST['nSoftware'];
    $email = $_POST['email'];

    $programas = [];
    $versiones = [];
    $descripciones = [];


    function campoValido($str){
        return ($str != '');
    }

    for($i = 0; $i < $nSoftware; $i++) {
        if(isset($_POST['programa' . $i]) && isset($_POST['version' . $i]) && isset($_POST['descrip' . $i])
            && campoValido($_POST['programa' . $i]) && campoValido($_POST['version' . $i])
            && campoValido($_POST['descrip' . $i])){

            array_push($programas, $_POST['programa' . $i]);
            array_push($versiones, $_POST['version' . $i]);
            array_push($descripciones, $_POST['descrip' . $i]);
        }else{
            $return = array('status'=>0, 'msg'=>"Error software: " . ($i+1));
            echo json_encode($return);
            return 0;
        }

    }


    global $wpdb;
    $wpdb->insert($wpdb->prefix . 'solicitud_solicitudes',array('email'=>$email,'id_asignatura'=>$asignatura),array('%s','%s'));

    $return = array('status'=>1, 'msg'=>obtenerTraduccion("solicitudOK"));
    echo json_encode($return);

	return 0;

?>