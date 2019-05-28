<?php
include('../traducciones.php');



if ((isset($_POST['nombre']) && isset($_POST['version']) && isset($_POST['notas']) && isset($_POST['sistOp']) && isset($_POST['aulas']))) {
    $path = $_SERVER['DOCUMENT_ROOT'];
    include_once $path . '/wp-load.php';

    $id_software = $_POST['id_software'];
    $nombre = $_POST['nombre'];
    $version = $_POST['version'];
    $notas = $_POST['notas'];
    $sistOp = $_POST['sistOp'];
    $aulas = $_POST['aulas'];

    global $wpdb;

    $table = $wpdb->prefix . 'software_solicitudes';
    $data = array('nombre'=>$nombre, 'version'=>$version, 'notas'=>$notas);
    $where = array("id"=>$id_software);
    $format = array('%s', '%s', '%s');
    $where_format = array('%s', '%s', '%s');

    $wpdb->update( $table, $data, $where, $format, $where_format);

    $wpdb->delete($wpdb->prefix . 'software_so_solicitudes', array( 'id_software' => $id_software ), array( '%d' ) );

    foreach ($sistOp as $sist){
        $wpdb->insert($wpdb->prefix . 'software_so_solicitudes',array('id_so'=>$sist, 'id_software'=>$id_software),array('%s', '%s'));
    }

    $wpdb->delete($wpdb->prefix . 'software_aula_solicitudes', array( 'id_software' => $id_software ), array( '%d' ) );

    foreach ($aulas as $aula){
        $wpdb->insert($wpdb->prefix . 'software_aula_solicitudes',array('id_aula'=>$aula, 'id_software'=>$id_software),array('%s', '%s'));
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