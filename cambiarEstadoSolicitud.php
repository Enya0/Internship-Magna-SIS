<?php

if(isset($_POST['nuevoEstado']) && isset($_POST['idSoftware'])){
    $nuevoEstado = $_POST['nuevoEstado'];
    $idSoftware = $_POST['idSoftware'];

    $path = $_SERVER['DOCUMENT_ROOT'];
    include_once $path . '/wp-load.php';
    global $wpdb;

    $table = $wpdb->prefix . 'softwareSolicitud_solicitudes';
    $data = array("estado"=>$nuevoEstado);
    $where = array("id"=>$idSoftware);
    $format = array('%d');
    $where_format = array('%d');

    $wpdb->update( $table, $data, $where, $format, $where_format);
}

?>