<?php
include('../traducciones.php');



if ((isset($_POST['nombre']) && isset($_POST['version']) && isset($_POST['notas']) && isset($_POST['sistOp']) && isset($_POST['aulas']))) {
    $path = $_SERVER['DOCUMENT_ROOT'];
    include_once $path . '/wp-load.php';

    $nombre = $_POST['nombre'];
    $version = $_POST['version'];
    $notas = $_POST['notas'];
    $sistOp = explode(",", $_POST['sistOp']);
    $aulas = $_POST['aulas'];

    global $wpdb;
    $wpdb->insert($wpdb->prefix . 'software_solicitudes',array('nombre'=>$nombre, 'version'=>$version, 'notas'=>$notas),array('%s', '%s', '%s'));
    $softwareID = $wpdb->insert_id;

    foreach ($sistOp as $sist){
        $wpdb->insert($wpdb->prefix . 'software_so_solicitudes',array('id_so'=>$sist, 'id_software'=>$softwareID),array('%s', '%s'));
    }

    if(in_array(0, $aulas)){
        $results = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'aula_solicitudes');
        $aulas = [];
        foreach ($results as $result){
            array_push($aulas, $result->id);
        }
    }
    foreach ($aulas as $aula) {
        $wpdb->insert($wpdb->prefix . 'software_aula_solicitudes', array('id_aula' => $aula, 'id_software' => $softwareID), array('%s', '%s'));
    }
    $msg = obtenerTraduccion("softwareOK");
    $return = array('status'=>1, 'msg'=>$msg);
    echo json_encode($return);
}else{
    $msg = obtenerTraduccion('erAulaValida');
    $return = array('status'=>0, 'msg'=>$msg);
    echo json_encode($return);
}
return 0;
?>