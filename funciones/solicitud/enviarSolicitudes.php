<?php

	include('../../traducciones.php');
    include('../email/mandarSolicitudes.php');

	$path = $_SERVER['DOCUMENT_ROOT']; 
	include_once $path . '/wp-load.php';

	$asignatura = $_POST['asig'];
	$aulas = explode(",", $_POST['aula']); // separadas por comas
	$sistemasOperativos = explode(",", $_POST['sistOp']); // separadas por comas
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
    $solicitudID = $wpdb->insert_id;
    for($i = 0; $i < $nSoftware; $i++){
        $wpdb->insert($wpdb->prefix . 'softwareSolicitud_solicitudes',array('id_solicitud'=>$solicitudID,'nombre'=>$programas[$i], 'version'=>$versiones[$i], 'notas'=>$descripciones[$i],'estado'=>0),array('%s','%s','%s','%s','%s'));
    }
    for ($j = 0; $j < sizeof($aulas); $j++) {
        $wpdb->insert($wpdb->prefix . 'solicitud_aula_solicitudes',array('id_solicitud'=>$solicitudID,'id_aula'=>$aulas[$j]),array('%s','%s'));
    }
    for ($l = 0; $l < sizeof($sistemasOperativos); $l++) {
        $wpdb->insert($wpdb->prefix . 'solicitud_so_solicitudes',array('id_solicitud'=>$solicitudID,'id_so'=>$sistemasOperativos[$l]),array('%s','%s'));
    }

    $return = array('status'=>1, 'msg'=>obtenerTraduccion("solicitudOK"));
    echo json_encode($return);
    mandarSolicitud($solicitudID, $email);

	return 0;

?>