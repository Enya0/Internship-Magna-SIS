<?php
function ver_laboratorios(){
    $idioma = get_locale();

    global $wpdb;

    $results = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'aula_solicitudes');

    echo '<table><tr><th>'. obtenerTraduccion("imagenes") .'</th><th>'. obtenerTraduccion("laboratorios") .'</th><th>'. obtenerTraduccion("puestos") .'</th></tr>';

    foreach ($results as $result) {
        $results_hardware = $wpdb->get_results('SELECT count(imagen) AS puestos, imagen FROM ' . $wpdb->prefix . 'hardware_solicitudes WHERE id_aula='. $result->id .' ORDER BY imagen ASC');
        foreach ($results_hardware as $result_hardware) {
            echo '<tr><td style="text-align: center;">';
            echo $result_hardware->imagen;
            echo '</td><td style="text-align: center;"><a href="ver-hw-laboratorio?id='.$result->id.'">';
            if ($idioma == "eu_ES") {
                echo $result->nombre_eus;
            } else {
                echo $result->nombre;
            }
            echo '</a></td>';
            echo '</td><td style="text-align: center;">';
            echo $result_hardware->puestos;
            echo '</td></tr>';

        }
    }
    echo '</table>';
}
?>