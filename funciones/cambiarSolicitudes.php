<?php

$path = $_SERVER['DOCUMENT_ROOT'];
include_once $path . '/wp-load.php';

global $wpdb;
$sql = "SELECT abierto FROM " . $wpdb->prefix . "abierto_solicitudes";
$results = $wpdb->get_results($sql);

foreach ($results as $result) {
    if($result->abierto == 1) {
        $table = $wpdb->prefix . 'abierto_solicitudes';
        $data = array("abierto"=>0);
        $where = array("id"=>1);
        $format = array('%d');
        $where_format = array('%d');

        $wpdb->update( $table, $data, $where, $format, $where_format);
    }else{
        $table = $wpdb->prefix . 'abierto_solicitudes';
        $data = array("abierto"=>1);
        $where = array("id"=>1);
        $format = array('%d');
        $where_format = array('%d');

        $wpdb->update( $table, $data, $where, $format, $where_format);
    }
}
?>