<?php
// Requisito: Las filas tienen que estar ordenadas por el laboratorio
if(isset($_FILES["fileToUpload"])) {
    $path = $_SERVER['DOCUMENT_ROOT'];
    include_once $path . '/wp-load.php';
    global $wpdb;

    echo '<pre>';

    $aulas = array();
    $last_id = 0;
    if (($gestor = fopen($_FILES["fileToUpload"]["tmp_name"], "r")) !== FALSE) {
        fgetcsv($gestor, 1000, ";");
        while (($datos = fgetcsv($gestor, 10000, ";")) !== FALSE) {
            $aula = utf8_encode ($datos[1]);
            if(!in_array($aula, $aulas)){
                $wpdb->insert($wpdb->prefix . 'aula_solicitudes',array('nombre'=>$aula,'nombre_eus'=>$aula,'mapa'=>""),array('%s','%s','%s'));
                $last_id = $wpdb->insert_id;
                array_push($aulas, $aula);
            }
            $nombre = utf8_encode ($datos[0]);
            $memoria = utf8_encode ($datos[2]);
            $procesador = utf8_encode ($datos[3]);
            $grafica = utf8_encode ($datos[4]);
            $idioma = utf8_encode ($datos[5]);
            $imagen = utf8_encode ($datos[6]);
            $antiguedad = utf8_encode ($datos[7]);

            $wpdb->insert($wpdb->prefix . 'hardware_solicitudes',array('nombre'=>$nombre, 'id_aula'=>$last_id,'memoria'=>$memoria,'procesador'=>$procesador,'grafica'=>$grafica,'idioma'=>$idioma,'imagen'=>$imagen,'antiguedad'=>$antiguedad),array('%s','%s','%s','%s','%s','%s','%s','%s'));
        }
        fclose($gestor);
    }

    echo '</pre>';
}
?>