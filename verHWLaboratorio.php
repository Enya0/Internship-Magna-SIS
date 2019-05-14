<?php
function ver_hw_laboratorio(){
    $idioma = get_locale();

    global $wpdb;

    $id_lab = $_GET['id'];

    $results_aula = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'aula_solicitudes WHERE id='. $id_lab);

    foreach ($results_aula as $result_aula) {
        if($idioma == "eu_ES"){
            echo '<h4>Hardware '. $result_aula->nombre_eus .'</h4>';
        }else{
            echo '<h4>Hardware '. $result_aula->nombre .'</h4>';
        }

    }

    echo '<table><tr><th>'.obtenerTraduccion('nombre').'</th>
    <th>Memoria (MB)</th>
    <th>'.obtenerTraduccion('procesador').'</th>
    <th>'.obtenerTraduccion('grafica').'</th>
    <th>'.obtenerTraduccion('idioma').'</th>
    <th>'.obtenerTraduccion('antiguedad').'</th></tr>';

    $results = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'hardware_solicitudes WHERE id_aula='. $id_lab);

    foreach ($results as $result) {
            echo '<tr><td style="text-align: center;">';
            echo $result->nombre;
            echo '</td><td style="text-align: center;">';
            echo $result->memoria;
            echo '</td><td style="text-align: center;">';
            echo $result->procesador;
            echo '</td><td style="text-align: center;">';
            echo $result->grafica;
            echo '</td><td style="text-align: center;">';
            echo $result->idioma;
            echo '</td><td style="text-align: center;">';
            echo $result->antiguedad;
            echo '</td></tr>';


    }
    echo '</table>';
}
?>