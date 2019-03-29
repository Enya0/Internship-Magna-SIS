<?php
/**
* Plugin Name: Solicitudes
* Description: :)
* Version: 1.0
* Author: Magna SIS
* Author URI: http://magnasis.com/
**/

function solicitudes_activate(){
	global $wpdb;
	$table_name = $wpdb->prefix.'solicitud_solicitudes';
	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
	     //table not in database. Create new table
	     $charset_collate = $wpdb->get_charset_collate();
	 
	     $sql = "CREATE TABLE $table_name (
	          id mediumint(9) NOT NULL AUTO_INCREMENT,
	          email text NOT NULL,
	          id_asignatura text NOT NULL,
	          UNIQUE KEY id (id)
	     ) $charset_collate;";
	     require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	     dbDelta( $sql );


		 $table_name = $wpdb->prefix.'softwareSolicitud_solicitudes';
	     $charset_collate = $wpdb->get_charset_collate();
	 
	     $sql = "CREATE TABLE $table_name (
	          id mediumint(9) NOT NULL AUTO_INCREMENT,
	          id_solicitud mediumint(9) NOT NULL,
	          nombre text NOT NULL,
	          version text NOT NULL,
	          notas text NOT NULL,
	          estado text NOT NULL,
	          UNIQUE KEY id (id)
	     ) $charset_collate;";
	     dbDelta( $sql );


	     $table_name = $wpdb->prefix.'motivo_solicitudes';
	     $charset_collate = $wpdb->get_charset_collate();
	 
	     $sql = "CREATE TABLE $table_name (
	          id mediumint(9) NOT NULL AUTO_INCREMENT,
	          texto text NOT NULL,
	          fecha text NOT NULL,
	          id_sw_S text NOT NULL,
	          UNIQUE KEY id (id)
	     ) $charset_collate;";
	     dbDelta( $sql );


	     $table_name = $wpdb->prefix.'aula_solicitudes';
	     $charset_collate = $wpdb->get_charset_collate();
	 
	     $sql = "CREATE TABLE $table_name (
	      	  id mediumint(9) NOT NULL AUTO_INCREMENT,
	          nombre text NOT NULL,
	          nombre_eus text NOT NULL,
	          mapa text NOT NULL,
	          UNIQUE KEY id (id)
	     ) $charset_collate;";
	     dbDelta( $sql );


	     $table_name = $wpdb->prefix.'so_solicitudes';
	     $charset_collate = $wpdb->get_charset_collate();
	 
	     $sql = "CREATE TABLE $table_name (
	          id mediumint(9) NOT NULL AUTO_INCREMENT,
	          nombre text NOT NULL,
	          UNIQUE KEY id (id)
	     ) $charset_collate;";
	     dbDelta( $sql );


	     $table_name = $wpdb->prefix.'software_solicitudes';
	     $charset_collate = $wpdb->get_charset_collate();
	 
	     $sql = "CREATE TABLE $table_name (
	          id mediumint(9) NOT NULL AUTO_INCREMENT,
	          nombre text NOT NULL,
	          version text NOT NULL,
	          notas text NOT NULL,
	          UNIQUE KEY id (id)
	     ) $charset_collate;";
	     dbDelta( $sql );


	     $table_name = $wpdb->prefix.'hardware_solicitudes';
	     $charset_collate = $wpdb->get_charset_collate();
	 
	     $sql = "CREATE TABLE $table_name (
	          id mediumint(9) NOT NULL AUTO_INCREMENT,
	          nombre text NOT NULL,
	          id_aula mediumint(9) NOT NULL,
	          memoria text NOT NULL,
	          procesador text NOT NULL,
	          grafica text NOT NULL,
	          idioma text NOT NULL,
	          imagen text NOT NULL,
	          antiguedad text NOT NULL,
	          UNIQUE KEY id (id)
	     ) $charset_collate;";
	     dbDelta( $sql );


	     $table_name = $wpdb->prefix.'incidencia_solicitudes';
	     $charset_collate = $wpdb->get_charset_collate();
	 
	     $sql = "CREATE TABLE $table_name (
	          id mediumint(9) NOT NULL AUTO_INCREMENT,
	          email text NOT NULL,
	          nombre text NOT NULL,
	          estado text NOT NULL,
	          notas text NOT NULL,
	          id_aula mediumint(9) NOT NULL,
	          tipo text NOT NULL,
	          UNIQUE KEY id (id)
	     ) $charset_collate;";
	     dbDelta( $sql );


	     $table_name = $wpdb->prefix.'asignatura_solicitudes';
	     $charset_collate = $wpdb->get_charset_collate();
	 
	     $sql = "CREATE TABLE $table_name (
	          id mediumint(9) NOT NULL AUTO_INCREMENT,
	          nombre text NOT NULL,
	          nombre_eus text NOT NULL,
	          curso text NOT NULL,
	          UNIQUE KEY id (id)
	     ) $charset_collate;";
	     dbDelta( $sql );


	     $table_name = $wpdb->prefix.'solicitud_aula_solicitudes';
	     $charset_collate = $wpdb->get_charset_collate();
	 
	     $sql = "CREATE TABLE $table_name (
	          id mediumint(9) NOT NULL AUTO_INCREMENT,
			  id_solicitud mediumint(9) NOT NULL,
	          id_aula mediumint(9) NOT NULL,
	          UNIQUE KEY id (id)
	     ) $charset_collate;";
	     dbDelta( $sql );


	     $table_name = $wpdb->prefix.'solicitud_so_solicitudes';
	     $charset_collate = $wpdb->get_charset_collate();
	 
	     $sql = "CREATE TABLE $table_name (
	          id mediumint(9) NOT NULL AUTO_INCREMENT,
	          id_solicitud mediumint(9) NOT NULL,
	          id_so mediumint(9) NOT NULL,
	          UNIQUE KEY id (id)
	     ) $charset_collate;";
	     dbDelta( $sql );


	     $table_name = $wpdb->prefix.'software_aula_solicitudes';
	     $charset_collate = $wpdb->get_charset_collate();
	 
	     $sql = "CREATE TABLE $table_name (
	          id mediumint(9) NOT NULL AUTO_INCREMENT,
	          id_software mediumint(9) NOT NULL,
	          id_aula mediumint(9) NOT NULL,
	          UNIQUE KEY id (id)
	     ) $charset_collate;";
	     dbDelta( $sql );


	     $table_name = $wpdb->prefix.'software_asignatura_solicitudes';
	     $charset_collate = $wpdb->get_charset_collate();
	 
	     $sql = "CREATE TABLE $table_name (
	          id mediumint(9) NOT NULL AUTO_INCREMENT,
	          id_software mediumint(9) NOT NULL,
	          id_asignatura mediumint(9) NOT NULL,
	          UNIQUE KEY id (id)
	     ) $charset_collate;";
	     dbDelta( $sql );


	     $table_name = $wpdb->prefix.'software_so_solicitudes';
	     $charset_collate = $wpdb->get_charset_collate();
	 
	     $sql = "CREATE TABLE $table_name (
	          id mediumint(9) NOT NULL AUTO_INCREMENT,
	          id_software mediumint(9) NOT NULL,
	          id_so mediumint(9) NOT NULL,
	          UNIQUE KEY id (id)
	     ) $charset_collate;";
	     dbDelta( $sql );


	     $table_name = $wpdb->prefix.'so_aula_solicitudes';
	     $charset_collate = $wpdb->get_charset_collate();
	 
	     $sql = "CREATE TABLE $table_name (
	          id mediumint(9) NOT NULL AUTO_INCREMENT,
	          id_so mediumint(9) NOT NULL,
	          id_aula mediumint(9) NOT NULL,
	          UNIQUE KEY id (id)
	     ) $charset_collate;";
	     dbDelta( $sql );
	}

}

register_activation_hook( __FILE__, 'solicitudes_activate' );

include( 'wp-content/plugins/solicitudes/formularios.php' );

include( 'wp-content/plugins/solicitudes/incidencia.php' );

add_shortcode('form_incidencias', 'form_incidencias');

add_shortcode('form_solicitud', 'form_solicitud');

add_shortcode('form_so', 'form_so');

add_shortcode('form_asignatura', 'form_asignatura');

add_shortcode('verIncidencia', 'verIncidencia');


?>