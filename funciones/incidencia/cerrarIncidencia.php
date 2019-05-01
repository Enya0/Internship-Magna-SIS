<?php

$path = $_SERVER['DOCUMENT_ROOT'];
include_once $path . '/wp-load.php';
global $wpdb;

$id_incidencia = $_POST['id_incidencia'];
$table = $wpdb->prefix . 'incidencia_solicitudes';
$data = array("estado"=>0);
$where = array("id"=>$id_incidencia);
$format = array('%d');
$where_format = array('%d');

$wpdb->update( $table, $data, $where, $format, $where_format);
?>